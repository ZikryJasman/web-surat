<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

function unionPaginate($queries, $queryCallbacks, $transformers, $return_query = false, $sort = 'created_at', $dir = 'desc')
{
    $per_page = 10;
    $page = Request::input('page', 1);
    $allQuery = null;
    $types = [];
    foreach ($queries as $k => $query) {
        $table = $query->getModel()->getTable();
        $type = Str::of(str_replace("_", " ", $table))->singular()->snake() . '';
        $types[] = $type;
        if ($sort == 'created_at')
            $orders = DB::table($table)->select("$table.id", 'created_at', DB::raw("'$type' as type"));
        else
            $orders = DB::table($table);
        if (isset($queryCallbacks[$k])) $orders = $queryCallbacks[$k]->call($orders);
        if ($allQuery == null) $allQuery = $orders;
        else $allQuery->unionAll($orders);
    }
    $allQuery = $allQuery->orderBy($sort, $dir);
    if ($return_query) return $allQuery;
    $total = $allQuery->count();
    $data = $allQuery->limit($per_page)->offset(($page - 1) * $per_page)->get();
    $fdata = collect();
    foreach ($queries as $k => $query) {
        $orders = $data->where("type", $types[$k])->pluck('id');
        // dd($query->toSql());
        $orders = $query->whereIn("id", $orders)->get();
        foreach ($orders as $order) {
            $tmp = new \stdClass;
            $tmp->id = $order->id;
            $tmp->created_at = $order->created_at;
            if ($sort != 'created_at') $tmp->{$sort} = $order->{$sort};
            $tmp->type = $types[$k];
            if (!isset($transformers[$k]))
                $tmp->data = $order;
            elseif (is_array($transformers[$k]))
                $tmp->data = fractalTransformItem($order, $transformers[$k][0], $transformers[$k][1]);
            else
                $tmp->data = fractalTransformItem($order, $transformers[$k]);
            $fdata[] = $tmp;
        }
    }
    if ($dir == 'desc')
        $fdata = $fdata->sortByDesc($sort);
    else
        $fdata = $fdata->sortBy($sort);
    return ResponseAPI(['data' => array_values($fdata->toArray()), 'meta' => [
        'types' => $types,
        'pagination' => [
            'total' => $total,
            'count' => count($fdata),
            'per_page' => $per_page,
            'current_page' => $page,
            'total_pages' => ceil($total / $per_page),
        ]
    ]]);
}
function rupiah($angka)
{
    return "Rp " . number_format($angka, 0, ',', '.');
}
function thousand($angka)
{
    return number_format($angka, 0, ',', '.');
}
function dateData($date)
{
    return $date->diffForHumans(Carbon::now());

}
function dateId($date)
{
    return $date->isoFormat("LL");

}
function dateFullId($date)
{
    return $date->isoFormat("LLLL");

}

function phoneRegulation($phone)
{
    if (substr($phone, 0, 2) == "08") $phone = Str::replaceFirst("08", "+628", $phone);
    if (substr($phone, 0, 1) == "8") $phone = Str::replaceFirst("8", "+628", $phone);
    return '+' . preg_replace("/[^0-9]/", "", $phone);
}

function getSetting($name)
{
    $s = App\Setting::where("name", $name)->first();
    if ($s == null) return false;
    return $s->value;
}

function getSettingRudi($name, $default = false, $multiple = false, $names = [])
{
    if ($multiple == false) {
        $s = DB::table('settings')->where("name", $name)->first();
        if ($s == null) return $default;
        return $s->value;
    } else {
        $imploded_strings = implode("','", $names);
        $s = DB::table('settings')->whereNull('deleted_at')->whereIn("name", $names)->orderByRaw(DB::raw("FIELD(name, '$imploded_strings')"))->get();
        // $s = App\Setting::whereIn("name", $names)->orderByRaw(DB::raw("FIELD(name, '$imploded_strings')"))->get();
        if ($s == null) return $default;
        return $s->pluck('value');
    }
}

function uploadFoto($file, $folder = "uploads", $resize = false)
{
    $filename = time() . '-' . $file->getClientOriginalName();
    $path = $folder . '/' . $filename;
    $image = Image::make($file);
    $image = $image->orientate();
    if ($image->width() > $image->height()) {
        $image = $image->resize(2048, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
    } else {
        $image = $image->resize(null, 2048, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
    }
    Storage::disk('public')->put($path, (string) $image->encode());
    if ($resize != false) {
        if (is_array($resize)) {
            $image = Image::make($file)->fit($resize[0], $resize[1]);
            $image = $image->orientate();
            Storage::disk('public')->put($path, (string) $image->encode());
        }
        if ($resize === true) {
            $thumbnail = Image::make($file)->fit(300, 300);
            $preview = Image::make($file)->fit(600, 400);
            $thumbnail = $thumbnail->orientate();
            $preview = $preview->orientate();
            Storage::disk('public')->put(generateInFolderFilename($path, 'preview'), (string) $preview->encode());
            Storage::disk('public')->put(generateInFolderFilename($path, 'thumbnail'), (string) $thumbnail->encode());
        }
        if ($resize === 'book') {
            $thumbnail = Image::make($file)->fit(300, 300);
            $preview = Image::make($file)->fit(400, 600);
            $thumbnail = $thumbnail->orientate();
            $preview = $preview->orientate();
            Storage::disk('public')->put(generateInFolderFilename($path, 'preview'), (string) $preview->encode());
            Storage::disk('public')->put(generateInFolderFilename($path, 'thumbnail'), (string) $thumbnail->encode());
        }
    }
    return '/storage/' . $path;
}


function uploadFile($file, $folder)
{
    if ($file == null or !$file->isValid()) {
        // dd($file);
        return null;
    }
    $filename = time() . Str::random(10) . '_' . $file->getClientOriginalName();
    $path = $file->storeAs($folder, $filename, 'public');
    return '/storage/' . $path;
}

function generateInFolderFilename($path, $folder, $windows = false)
{
    $d = $windows ? "\\" : "/";
    $pathArr = explode($d, $path);
    $filename = $pathArr[count($pathArr) - 1];
    $pathArr[count($pathArr) - 1] = $folder;
    $pathArr[] = $filename;
    return implode($d, $pathArr);
}
function fractalTransformItem($item, $transformer, $includes = '', $is_serialize = true)
{
    $a = fractal()->parseIncludes($includes)->item($item)->transformWith($transformer);
    if ($is_serialize) return $a->serializeWith(new App\Transformers\MySerializer());
    return $a;
}

function fractalTransformCollection($collection, $transformer, $includes = '', $pagination = null)
{
    $a = fractal()->parseIncludes($includes)->collection($collection)->transformWith($transformer);
    if ($pagination == null) return $a->serializeWith(new App\Transformers\MySerializer());
    return ['data' => $a->serializeWith(new App\Transformers\MySerializer()), 'meta' => ['pagination' => [
        "total" => $pagination->total(),
        "count" => $pagination->count(),
        "per_page" => $pagination->perPage(),
        "current_page" => $pagination->currentPage(),
        "total_pages" => $pagination->lastPage(),
        "links" => $pagination->links()
    ]]];
}

function fileInput($name, $title, $required = false, $val = '', $accept = 'image/*', $class = '')
{
    return '<div class="file-field input-field ' . $class . '">
        <div class="btn">
            <span>' . $title . '</span>
            <input name="' . $name . '" accept="' . $accept . '" type="file">
        </div>
        <div class="file-path-wrapper">
           <input class="file-path validate" ' . ($required ? 'required="required"' : '') . ' value="' . $val . '" type="text">
        </div>
    </div>';
}


function generateSlug($title)
{
    // replace non letter or digits by -
    $title = preg_replace('~[^\pL\d]+~u', '-', $title);
    // transliterate
    $title = iconv('utf-8', 'us-ascii//TRANSLIT', $title);
    // remove unwanted characters
    $title = preg_replace('~[^-\w]+~', '', $title);
    // trim
    $title = trim($title, '-');
    // remove duplicate -
    $title = preg_replace('~-+~', '-', $title);
    // lowercase
    $title = strtolower($title);
    if (empty($title)) {
        return 'n-a';
    }
    return $title;
}

function parseDate($date, $format = "l, d F Y")
{
    setlocale(LC_TIME, 'id_ID.utf8');
    $format = str_replace("D", "%a", $format);
    $format = str_replace("l", "%A", $format);
    $format = str_replace("j", "%e", $format);
    $format = str_replace("d", "%d", $format);
    $format = str_replace("N", "%u", $format);
    $format = str_replace("w", "%w", $format);
    $format = str_replace("M", "%b", $format);
    $format = str_replace("m", "%m", $format);
    $format = str_replace("F", "%B", $format);
    $format = str_replace("Y", "%Y", $format);
    $format = str_replace("y", "%y", $format);
    $format = str_replace("H", "%H", $format);
    $format = str_replace("i", "%M", $format);
    $format = str_replace("s", "%S", $format);
    try {
        // $ret = Carbon\Carbon::parse($date)->format($format);
        $ret = Carbon::parse($date)->formatLocalized($format);
    } catch (Exception $e) {
        $ret = false;
    }
    return $ret;
}
function getYoutubeEmbedUrl($url)
{
     $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
     $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';

    if (preg_match($longUrlRegex, $url, $matches)) {
        $youtube_id = $matches[count($matches) - 1];
    }

    if (preg_match($shortUrlRegex, $url, $matches)) {
        $youtube_id = $matches[count($matches) - 1];
    }
    return 'https://www.youtube.com/embed/' . $youtube_id ;
}
function parseDateId($date, $format = 'l, j F Y')
{
    \Carbon\Carbon::setLocale('id_ID');

    return \Carbon\Carbon::parse($date)->translatedFormat($format);
}
function parseDateIdFull($date, $format = 'l, j F Y, H:H')
{
    \Carbon\Carbon::setLocale('id_ID');

    return \Carbon\Carbon::parse($date)->translatedFormat($format);
}
function ResponseAPI($data, $status = 200)
{
    if ($status === false)
        $status = 403;
    if ($status === true)
        $status = 200;
    if (is_string($data))
        $data = ['message' => $data];
    return response()->json($data, $status);
}


function sendMessage($title, $message, $data, $device_id, $send_all = false, $image = null, $buttons = null)
{
    $content = array("en" => $message);
    $heading = ['en' => $title];

    $device_ids = is_array($device_id) ? $device_id : [$device_id];
    if (!$send_all && count($device_ids) > 2000) {
        $device_ids_wrap = array_chunk($device_ids, 2000);
        foreach ($device_ids_wrap as $deviceids) {
            sendMessage($title, $message, $data, $deviceids, false, $image, $buttons);
        }
        return true;
    }
    $app_id = "4b859343-dd1d-4d7e-a7e2-63ace6ef7275";
    $rest_api_key = "ZTJlMGM0OWUtZmJmZC00ZjYxLWJlNDItNjVlZGFhMjhhZmRj";

    if ($send_all) {
        $fields = array(
            'app_id' => $app_id,
            'included_segments' => ['All Users'],
            'data' => $data,
            'contents' => $content,
            'headings' => $heading
        );
    } else {
        $fields = array(
            'app_id' => $app_id,
            'include_player_ids' => $device_ids,
            'data' => $data,
            'contents' => $content,
            'headings' => $heading
        );
    }

    if ($image != null) {
        $fields['big_picture'] = $image;
    }
    if ($buttons != null) {
        $fields['buttons'] = $buttons;
    }

    $fields = json_encode($fields);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        "Authorization: Basic $rest_api_key"
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

function rupiahFormat($price, $decimal = true)
{
    if ($decimal == true) {
        return "Rp. " . \number_format($price, 0, ',', '.');
    }
    return "Rp. " . \number_format($price);
}

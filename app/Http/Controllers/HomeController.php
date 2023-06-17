<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\City;
use App\Models\Village;
use App\Models\District;
use App\Models\User;
use App\Models\Surat;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Mail\SendMail;

class HomeController extends Controller
{
    public function index()
    {
        $data = User::where('level', 'Desa')->limit('1')->first();
        return redirect(route('home_desa',$data->title_user));
    }
    public function home_desa($title)
    {
        $dt = User::join('biodata_desa', 'biodata_desa.user_id', '=', 'users.id')->join('indonesia_provinces', 'indonesia_provinces.code', '=', 'biodata_desa.province_codes')->join('indonesia_cities', 'indonesia_cities.code', '=', 'biodata_desa.city_codes')->join('indonesia_districts', 'indonesia_districts.code', '=', 'biodata_desa.district_codes')->join('indonesia_villages', 'indonesia_villages.code', '=', 'biodata_desa.village_codes')->join('profil_desa', 'profil_desa.user_id', '=', 'users.id')->where('users.title_user', $title)->where('users.status_user', 'True')->first();
        $surat = DB::table('surat')->orderBy(DB::RAW('RAND()'))->get();
        $layanan = DB::table('layanan')->get();
        $prosedur = DB::table('prosedur')->get();
        if ($dt == NULL) {
            return redirect(route('index'));
        } else {
            return view('desa/home/home', compact('dt', 'surat', 'layanan', 'prosedur'));
        }
    }
    public function register($title)
    {
        $data = User::where('title_user', $title)->where('users.status_user', 'True')->get();
        return view('desa/register', compact('data'));
    }
    public function daftar(Request $request)
    {
        $users = new User();
        if (DB::table('users')->where('email', $request->email)->first()) {
            return redirect()->back()->with('niksama', '-');
        } elseif ($request->confirm !== $request->password) {
            return redirect()->back()->with('confirm', '-');
        } else {
            $users = new User();
            $users->name = $request->name;
            $users->email = $request->email;
            $users->password = Hash::make($request->password);
            $users->level = 'Pengaju';
            $users->status_user = 'True';
            $users->save();
            DB::table('info_lengkap')->insert([
                'user_id' => $users->id,
            ]);
            $title = User::where('level', 'Desa')->first();
            return redirect(route('login', $title->title_user))->with('yes', '-');
        }
    }
    public function login($title)
    {
        $data = User::where('title_user', $title)->where('users.status_user', 'True')->get();
        return view('desa/login', compact('data'));
    }
    public function ceklogin(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $cek = DB::table('info_lengkap')->join('users', 'users.id', '=', 'info_lengkap.user_id')
                ->where('users.email', $request->email)
                ->first();
            $title = Auth::user()->title_user;
            if (Auth::user()->level == "Desa") {
                return response()->json([
                    'admin_desa' => $title
                ]);
            } elseif (Auth::user()->level == "Pengaju") {
                return response()->json([
                    'masuk_pengaju' => '-'
                ]);
            } elseif (Auth::user()->level == "Staff") {
                return response()->json([
                    'masuk_staff' => '-'
                ]);
            } else {
                return response()->json([
                    'masuk_kpldesa' => '-'
                ]);
            }
        } else {
            return response()->json([
                'notmasuk' => '-'
            ]);
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect(route('index'));
    }

    public function forgot($title)
    {
        $data = User::where('title_user', $title)->where('users.status_user', 'True')->get();
        return view('desa/verifikasi', compact('data'));
    }
    public function proses_forgot(Request $request)
    {
        $data = User::where('email', $request->email)->first();
        if ($data == null) {
            $request->session()->forget('kodeverif');
            return redirect()->back()->with('salah', '-');
        } else {
            $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $shuffle  = substr(str_shuffle($karakter), 0, 6);
            $kode = $shuffle . $data->id;
            DB::table('users')->where('id', $data->id)->update([
                'verifikasi' => $kode,
            ]);
            $request->session()->put('kodeverif', $kode);
            // $details= [
            //     'status'=>'Lupa Password',
            //     'email'=>$data->email,
            //     'verifikasi'=>$kode,
            // ];
            // \Mail::to($data->email)->send(new \App\Mail\SendMail($details));
            return redirect()->back()->with('benar', '-');
        }
    }
    public function cek_verifikasi(Request $request)
    {
        $data = DB::table('users')->where('verifikasi', $request->token)->first();
        if ($data == null) {
            return redirect()->back()->with('tokensalah', '-');
        } else {
            $request->session()->forget('kodeverif');
            $request->session()->put('pss', $data->id);
            return redirect()->back()->with('tokenbenar', '-');
        }
    }
    public function ubah_password(Request $request, $title)
    {
        User::where('id', session('pss'))->update([
            'password' => hash::make($request->password),
        ]);
        User::where('id', session('pss'))->update([
            'verifikasi' => '',
        ]);
        $request->session()->forget('pss');
        return redirect(route('login', $title));
    }
}

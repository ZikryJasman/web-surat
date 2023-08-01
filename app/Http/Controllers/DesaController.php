<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\User;
use App\Models\Surat;
use App\Models\Layanan;
use App\Models\Pengajuan;
use App\Models\Program;
use App\Models\Prosedur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DesaController extends Controller
{
    public function dashboard($title)
    {
        $data = User::where('title_user', $title)->select('id', 'title_user')->firstOrFail();
        $data['total_user'] = User::where('id', '!=', $data['id'])->count();
        $data['total_surat'] = Pengajuan::count();
        $data['layanan'] = Layanan::get();
        $data['prosedur'] = Prosedur::get();
        return view('desa/dashboard/dashboard', compact('data'));
    }
    public function user_pengaju(Request $request)
    {
        $program = Program::all();
        if ($request->search) {
            $data = User::where('name', 'like', "%$request->search%")->with(['program:id,nama'])->join('info_lengkap', 'info_lengkap.user_id', '=', 'users.id')->where('users.level', 'Pengaju')->orderByDesc('id')->paginate(5)->withQueryString();
        } else if ($request->program_id) {
            $data = User::where('program_id', $request->program_id)->with(['program:id,nama'])->join('info_lengkap', 'info_lengkap.user_id', '=', 'users.id')->where('users.level', 'Pengaju')->orderByDesc('id')->paginate(5)->withQueryString();
        } else if ($request->search && $request->program_id) {
            $data = User::where('name', 'like', "%$request->search%")->where('program_id', $request->program_id)->with(['program:id,nama'])->join('info_lengkap', 'info_lengkap.user_id', '=', 'users.id')->where('users.level', 'Pengaju')->orderByDesc('id')->paginate(5)->withQueryString();
        } else
            $data = User::with(['program:id,nama'])->join('info_lengkap', 'info_lengkap.user_id', '=', 'users.id')->where('users.level', 'Pengaju')->orderByDesc('id')->paginate(5)->withQueryString();
        return view('desa/user/pengaju', compact('data', 'program'));
    }
    public function user_pengurus(Request $request)
    {
        $kota = City::all();
        if ($request->search) {
            $data = User::where('name', 'like', "%$request->search%")->join('info_lengkap', 'info_lengkap.user_id', '=', 'users.id')->paginate(5)->withQueryString();
        } else
            $data = User::join('info_lengkap', 'info_lengkap.user_id', '=', 'users.id')->paginate(5);
        return view('desa/user/pengurus', compact('data', 'kota'));
    }
    public function cek_user($title, $id)
    {
        $data = User::join('info_lengkap', 'info_lengkap.user_id', '=', 'users.id')->where('users.id', $id)->get();
        return view('desa/user/detail', compact('data'));
    }
    public function data_surat()
    {
        $data = Surat::all();
        return view('desa/surat/surat', compact('data'));
    }
    public function tambah_surat(Request $request)
    {
        foreach ($request->nama_surat as $key => $value) {
            $string = $request->nama_surat[$key];
            $arr = explode(' ', $string);
            $singkatan = '';
            foreach ($arr as $kata) {
                $singkatan .= substr($kata, 0, 1);
            }
            $surat = new Surat();
            $surat->nama_surat = $request->nama_surat[$key];
            $surat->singkatan = $singkatan;
            $surat->bg = $request->bg[$key];
            $surat->persyaratan = $request->persyaratan[$key];
            $surat->save();
        }
        return back()->with('add', '-');
    }
    public function edit_surat(Request $request, $id_surat)
    {
        $string = $request->nama_surat;
        $arr = explode(' ', $string);
        $singkatan = '';
        foreach ($arr as $kata) {
            $singkatan .= substr($kata, 0, 1);
        }
        Surat::where('id_surat', $id_surat)->update([
            'nama_surat' => $request->nama_surat,
            'singkatan' => $singkatan,
            'bg' => $request->bg,
            'persyaratan' => $request->persyaratan,
        ]);
        return back()->with('up', '-');
    }
    public function hapus_surat($id_surat)
    {
        Surat::where('id_surat', $id_surat)->delete();
        return back()->with('del', '-');
    }
    public function waktu_layanan()
    {
        $data = Layanan::all();
        return view('desa/layanan/layanan', compact('data'));
    }
    public function tambah_layanan(Request $request)
    {
        foreach ($request->hari as $key => $value) {
            $layanan = new Layanan();
            $layanan->hari = $request->hari[$key];
            $layanan->waktu = $request->waktu[$key];
            $layanan->sampai = $request->sampai[$key];
            $layanan->save();
        }
        return redirect()->back()->with('add', '-');
    }
    public function edit_layanan(Request $request, $id_layanan)
    {
        Layanan::where('id_layanan', $id_layanan)->update([
            'hari' => $request->hari,
            'waktu' => $request->waktu,
            'sampai' => $request->sampai,
        ]);
        return redirect()->back()->with('up', '-');
    }
    public function hapus_layanan($id_layanan)
    {
        Layanan::where('id_layanan', $id_layanan)->delete();
        return redirect()->back()->with('del', '-');
    }
    public function prosedur()
    {
        $data = Prosedur::all();
        $cek = Prosedur::count();
        return view('desa/prosedur/prosedur', compact('data', 'cek'));
    }
    public function tambah_prosedur(Request $request)
    {
        $prosedur = new Prosedur();
        $prosedur->prosedur = $request->prosedur;
        $prosedur->save();
        return redirect()->back()->with('add', '-');
    }
    public function edit_prosedur(Request $request, $id_prosedur)
    {
        Prosedur::where('id_prosedur', $id_prosedur)->update([
            'prosedur' => $request->prosedur,
        ]);
        return redirect()->back()->with('up', '-');
    }
    public function hapus_prosedur($id_prosedur)
    {
        Prosedur::where('id_prosedur', $id_prosedur)->delete();
        return redirect()->back()->with('del', '-');
    }
    public function profil_desa($title)
    {
        $data = User::join('biodata_desa', 'biodata_desa.user_id', '=', 'users.id')->join('indonesia_provinces', 'indonesia_provinces.code', '=', 'biodata_desa.province_codes')->join('indonesia_cities', 'indonesia_cities.code', '=', 'biodata_desa.city_codes')->join('indonesia_districts', 'indonesia_districts.code', '=', 'biodata_desa.district_codes')->join('indonesia_villages', 'indonesia_villages.code', '=', 'biodata_desa.village_codes')->join('profil_desa', 'profil_desa.user_id', '=', 'users.id')->where('users.title_user', $title)->where('users.id', Auth::user()->id)->get();
        return view('desa/profildesa/profil', compact('data'));
    }
    public function lengkapi(Request $request, $id)
    {
        if ($request->hasFile('foto')) {
            $namaFileBaru = uploadFoto($request->foto, 'admin/' . Auth::user()->id, true);
            // $ambil = $request->file('foto');
            // $name = $ambil->getClientOriginalName();
            // $namaFileBaru = uniqid();
            // $namaFileBaru .= $name;
            // $ambil->move(\base_path() . "/public/foto", $namaFileBaru);
            DB::table('profil_desa')->where('user_id', $id)->update([
                'lokasi_desa' => $request->lokasi_desa,
                'telepon_desa' => $request->telepon_desa,
                'logo' => $namaFileBaru,
            ]);
            DB::table('users')->where('id', $id)->update([
                'email' => $request->email,
            ]);
        } else {
            DB::table('profil_desa')->where('user_id', $id)->update([
                'lokasi_desa' => $request->lokasi_desa,
                'telepon_desa' => $request->telepon_desa,
            ]);
            DB::table('users')->where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }
        return redirect()->back()->with('up', '-');
    }
    public function ganti_password(Request $request, $id)
    {
        DB::table('users')->where('id', $id)->update([
            'password' => Hash::make($request->password),
        ]);
        return redirect()->back()->with('up', '-');
    }
    public function tambah_pengurus(Request $request)
    {
        $cek = User::where('email', $request->email)->first();
        if ($cek == NULL) {
            // $ambil = $request->file('foto');
            // $name = $ambil->getClientOriginalName();
            // $namaFileBaru = uniqid();
            // $namaFileBaru .= $name;
            // $ambil->move(\base_path() . "/public/profil", $namaFileBaru);
            if($request->file('foto')){
                $namaFileBaru = uploadFoto($request->foto, 'admin/' . Auth::user()->id, true);
            }
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = hash::make($request->password);
            $user->level = $request->level;
            $user->status_user = 'True';
            $user->save();
            DB::table('info_lengkap')->insert([
                'user_id' => $user->id,
                'nim' => $request->nim,
                'alamat' => $request->alamat,
                'tahun_ajaran' => $request->tahun_ajaran,
                'telepon' => $request->telepon,
                'jenis_kelamin' => $request->jenis_kelamin,
                'pangkat' => $request->pangkat,
                'tempat' => $request->tempat,
                'tgl_lahir' => $request->tgl_lahir,
                'foto_profil' => $namaFileBaru,
            ]);
            return redirect()->back()->with('add', '-');
        } else {
            return redirect()->back()->with('email', '-');
        }
    }

    public function template($title_user, $id_surat)
    {
        $data = DB::table('template')->orderBy('id_template', 'ASC')->get();
        $surat = Surat::where('id_surat', $id_surat)->get();
        return view('desa/template/pilih', compact('data', 'surat'));
    }
    public function custom_template(Request $request, $template_id)
    {
        DB::table('surat')->where('id_surat', $request->id_surat)->update([
            'template_id' => $template_id,
        ]);
        return redirect(route('data_surat', Auth::user()->title_user))->with('up', '-');
    }

    public function programIndex(Request $request)
    {
        $data = Program::orderByDesc('id')->paginate(5)->withQueryString();
        return view('desa.program.index', compact('data'));
    }

    public function programStore(Request $request)
    {
        $program = new Program();
        $program->nama = $request->nama;
        // $program->dosen = $request->dosen;
        $program->save();
        $data = Program::orderByDesc('id')->paginate(5)->withQueryString();
        return view('desa.program.index', compact('data'));
    }

    public function programUpdate(Request $request, $id)
    {
        Program::where('id', $id)->update([
            'nama' => $request->nama,
            // 'dosen' => $request->dosen,
        ]);
        $data = Program::orderByDesc('id')->paginate(5)->withQueryString();
        return view('desa.program.index', compact('data'));
    }
    public function programDelete($id)
    {
        $te = Program::where('id', $id)->firstOrFail();
        $te->delete();
        $data = Program::orderByDesc('id')->paginate(5)->withQueryString();
        return view('desa.program.index', compact('data'));
    }
}

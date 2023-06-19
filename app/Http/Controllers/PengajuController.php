<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\City;
use App\Models\Village;
use App\Models\District;
use App\Models\User;
use App\Models\Pengajuan;
use App\Models\Program;
use App\Models\Surat;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

date_default_timezone_set('Asia/Jakarta');

class PengajuController extends Controller
{
    public function dashboard_pengaju()
    {
        $surat = Surat::all();
        return view('pengaju/home/home', compact('surat'));
    }
    public function request($surat)
    {
        $data = User::join('info_lengkap', 'info_lengkap.user_id', '=', 'users.id')->where('users.id', Auth::user()->id)->get();
        $surat = Surat::where('nama_surat', $surat)->first();
        return view('pengaju/request/index', compact('data', 'surat'));
    }
    public function add_request(Request $request)
    {
        $bulan = date('m');
        if ($bulan == '1') {
            $bulan = 'I';
        } elseif ($bulan == '2') {
            $bulan = 'II';
        } elseif ($bulan == '3') {
            $bulan = 'III';
        } elseif ($bulan == '4') {
            $bulan = 'IV';
        } elseif ($bulan == '5') {
            $bulan = 'V';
        } elseif ($bulan == '6') {
            $bulan = 'VI';
        } elseif ($bulan == '7') {
            $bulan = 'VII';
        } elseif ($bulan == '8') {
            $bulan = 'VIII';
        } elseif ($bulan == '9') {
            $bulan = 'IX';
        } elseif ($bulan == '10') {
            $bulan = 'X';
        } elseif ($bulan == '11') {
            $bulan = 'XI';
        } elseif ($bulan == '12') {
            $bulan = 'XI';
        }
        $pengajuan = new Pengajuan();
        $pengajuan->user_id = Auth::user()->id;
        $pengajuan->surat_id = $request->id_surat;
        $pengajuan->status_pengajuan = 'Pengecekan Permohonan';
        $pengajuan->tgl_req = now();
        $pengajuan->keperluan = $request->keperluan;
        $pengajuan->nomor_surat = $bulan . '-' . date('d-Y');
        $pengajuan->save();

        $files = $request->file('berkas');
        foreach ($files as $file) {
            $foto = $file->getClientOriginalName();
            $namaFileBaru = uniqid();
            $namaFileBaru .= $foto;
            DB::table('berkas_pengajuan')->insert([
                'pengajuan_id' => $pengajuan->id_pengajuan,
                'data_berkas' => $namaFileBaru,
                'path' => $file->move(\base_path() . "/public/pengajuan_berkas", $namaFileBaru),
            ]);
        }
        return redirect(route('data_request', $request->singkatan))->with('add', '-');
    }
    public function data_request($singkatan)
    {
        // $data=User::join('info_lengkap','users.id','=','info_lengkap.user_id')->join('pengajuan','pengajuan.desa_id','=','info_lengkap.desa_id')->join('surat','surat.id_surat','=','pengajuan.surat_id')->where('pengajuan.user_id',Auth::user()->id)->where('surat.singkatan',$singkatan)->where('pengajuan.desa_id',session('desaid'))->where('users.level','Pengaju')->get();
        $data = DB::table('pengajuan')->join('users', 'users.id', '=', 'pengajuan.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('surat.singkatan', $singkatan)->join('info_lengkap', 'info_lengkap.user_id', '=', 'users.id')->where('users.id', Auth::user()->id)->where('users.level', 'Pengaju')->orderByDesc('id_pengajuan')->paginate(5);
        $pelengkap = DB::table('berkas_pengajuan')->get();
        return view('pengaju.data.data', compact('data', 'pelengkap'));
    }
    public function profil_pengaju()
    {
        $program = Program::all();
        $data = User::with(['program:id,nama'])->join('info_lengkap', 'info_lengkap.user_id', '=', 'users.id')->where('users.id', Auth::user()->id)->get();
        return view('pengaju/profil/profil', compact('data', 'program'));
    }
    public function update_profil_pengurus(Request $request)
    {
        if ($request->hasFile('foto')) {
            $ambil = $request->file('foto');
            $name = $ambil->getClientOriginalName();
            $namaFileBaru = uniqid();
            $namaFileBaru .= $name;
            $ambil->move(\base_path() . "/public/profil", $namaFileBaru);

            User::where('id', Auth::user()->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'program_id' => $request->program_id,
            ]);
            DB::table('info_lengkap')->where('user_id', Auth::user()->id)->update([
                'nim' => $request->nim,
                'alamat' => $request->alamat,
                'tahun_ajaran' => $request->tahun_ajaran,
                'telepon' => $request->telepon,
                'pangkat' => $request->pangkat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat' => $request->tempat,
                'tgl_lahir' => $request->tgl_lahir,
                'foto_profil' => $namaFileBaru,
            ]);
            return redirect()->back()->with('up', '-');
        } else {
            User::where('id', Auth::user()->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'program_id' => $request->program_id,
            ]);
            DB::table('info_lengkap')->where('user_id', Auth::user()->id)->update([
                'nim' => $request->nim,
                'alamat' => $request->alamat,
                'tahun_ajaran' => $request->tahun_ajaran,
                'pangkat' => $request->pangkat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat' => $request->tempat,
                'tgl_lahir' => $request->tgl_lahir,
            ]);
            return redirect()->back()->with('up', '-');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Surat;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDF;
use Barryvdh\DomPDF\Facade\Pdf as pp;


class StaffController extends Controller
{
    public function dashboard_staff()
    {
        $data = Surat::all();
        return view('staff/home/home', compact('data'));
    }
    public function staff_acc($surat)
    {
        $data = User::join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('surat.singkatan', $surat)->where('pengajuan.selesai', '=', NULL)->get();
        return view('staff/acc/acc', compact('data'));
    }
    public function staff_cek_berkas($surat, $id_pengajuan)
    {
        $data = User::join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('surat.singkatan', $surat)->where('pengajuan.id_pengajuan', $id_pengajuan)->where('pengajuan.selesai', '=', NULL)->get();
        $berkas = DB::table('berkas_pengajuan')->join('pengajuan', 'pengajuan.id_pengajuan', '=', 'berkas_pengajuan.pengajuan_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('surat.singkatan', $surat)->where('pengajuan.id_pengajuan', $id_pengajuan)->where('pengajuan.selesai', '=', NULL)->get();
        return view('staff/acc/cek', compact('data', 'berkas'));
    }
    public function keterangan(Request $request, $id_pengajuan)
    {
        $files = $request->file('upload_berkas');
        $foto = $files->getClientOriginalName();
        $namaFileBaru = uniqid();
        $namaFileBaru .= $foto;
        // $pengajuan->upload_berkas = $namaFileBaru;
        // $pengajuan->path_upload = $files->move(\base_path() . "/public/pengajuan_berkas", $namaFileBaru);
        DB::table('pengajuan')->where('id_pengajuan', $id_pengajuan)->update([
            'status_pengajuan' => $request->keterangan,
            'upload_berkas' => $namaFileBaru,
            'path_upload' => $files->move(\base_path() . "/public/pengajuan_berkas", $namaFileBaru)
        ]);
        return redirect()->back()->with('up', '-');
    }
    public function konfirmasi($singkatan, $id_pengajuan)
    {
        DB::table('pengajuan')->where('id_pengajuan', $id_pengajuan)->update([
            'selesai' => 'Sudah di Konfirmasi',
            'status_pengajuan' => 'Data Sudah Lengkap',
        ]);
        return redirect(route('staff_acc', $singkatan))->with('up', '-');
    }


    public function staff_cetak($surat)
    {
        $data = User::join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('surat.singkatan', $surat)->where('pengajuan.selesai', '=', 'Surat Selesai')->get();
        return view('staff/cetak/cetak', compact('data'));
    }
    public function cetak($surat, $id_pengajuan)
    {
        $data = User::join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->join('template', 'template.id_template', '=', 'surat.template_id')->where('surat.singkatan', $surat)->where('pengajuan.id_pengajuan', $id_pengajuan)->get();
        $desa = User::join('biodata_desa', 'biodata_desa.user_id', '=', 'users.id')->join('indonesia_provinces', 'indonesia_provinces.code', '=', 'biodata_desa.province_codes')->join('indonesia_cities', 'indonesia_cities.code', '=', 'biodata_desa.city_codes')->join('indonesia_districts', 'indonesia_districts.code', '=', 'biodata_desa.district_codes')->join('indonesia_villages', 'indonesia_villages.code', '=', 'biodata_desa.village_codes')->join('profil_desa', 'profil_desa.user_id', 'biodata_desa.user_id')->get();
        $kepala = User::join('info_lengkap', 'info_lengkap.user_id', '=', 'users.id')->where('users.level', 'Kepala Desa')->limit('1')->get();
        return view('staff/cetak/cek', compact('data', 'desa', 'kepala'));
    }
    public function cetak_surat($surat, $id_pengajuan)
    {
        if (Auth::user()->level == "Staff") {
            $data = array();
            $data['user'] = User::join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->join('template', 'template.id_template', '=', 'surat.template_id')->where('surat.singkatan', $surat)->where('pengajuan.id_pengajuan', $id_pengajuan)->get();
            $data['desa'] = User::join('biodata_desa', 'biodata_desa.user_id', '=', 'users.id')->join('indonesia_provinces', 'indonesia_provinces.code', '=', 'biodata_desa.province_codes')->join('indonesia_cities', 'indonesia_cities.code', '=', 'biodata_desa.city_codes')->join('indonesia_districts', 'indonesia_districts.code', '=', 'biodata_desa.district_codes')->join('indonesia_villages', 'indonesia_villages.code', '=', 'biodata_desa.village_codes')->join('profil_desa', 'profil_desa.user_id', 'biodata_desa.user_id')->get();
            $data['kepala'] = User::join('info_lengkap', 'info_lengkap.user_id', '=', 'users.id')->where('users.level', 'Kepala Desa')->limit('1')->get();
        } elseif (Auth::user()->level == "Pengaju") {
            $data = array();
            $data['user'] = User::join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->join('template', 'template.id_template', '=', 'surat.template_id')->where('surat.singkatan', $surat)->where('pengajuan.id_pengajuan', $id_pengajuan)->where('pengajuan.user_id', Auth::user()->id)->get();
            $data['desa'] = User::join('biodata_desa', 'biodata_desa.user_id', '=', 'users.id')->join('indonesia_provinces', 'indonesia_provinces.code', '=', 'biodata_desa.province_codes')->join('indonesia_cities', 'indonesia_cities.code', '=', 'biodata_desa.city_codes')->join('indonesia_districts', 'indonesia_districts.code', '=', 'biodata_desa.district_codes')->join('indonesia_villages', 'indonesia_villages.code', '=', 'biodata_desa.village_codes')->join('profil_desa', 'profil_desa.user_id', 'biodata_desa.user_id')->get();
            $data['kepala'] = User::join('info_lengkap', 'info_lengkap.user_id', '=', 'users.id')->where('users.level', 'Kepala Desa')->limit('1')->get();
        }
        $pdf = pp::loadview('staff.cetak.pdf', compact('data'))->setPaper('A4', 'potrait');
        foreach ($data['user'] as $dt) {
            if ($dt->level == "Pengaju") {
                // return $pdf->stream();
                return $pdf->download($dt->nama_surat . ' ' . $dt->name . '.pdf');
            }
        }
    }
    public function surat_selesai()
    {
        $data = User::join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->get();
        return view('staff/selesai/index', compact('data'));
    }
    public function laporan(Request $request)
    {
        $data = User::join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->whereBetween('pengajuan.tgl_req', [$request->awal, $request->akhir])->get();
        return view('staff/selesai/laporan', compact('data'));
    }
    public function print($awal, $akhir)
    {
        $data = User::join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->whereBetween('pengajuan.tgl_req', [$awal, $akhir])->get();
        $desa = User::join('biodata_desa', 'biodata_desa.user_id', '=', 'users.id')->join('indonesia_provinces', 'indonesia_provinces.code', '=', 'biodata_desa.province_codes')->join('indonesia_cities', 'indonesia_cities.code', '=', 'biodata_desa.city_codes')->join('indonesia_districts', 'indonesia_districts.code', '=', 'biodata_desa.district_codes')->join('indonesia_villages', 'indonesia_villages.code', '=', 'biodata_desa.village_codes')->join('profil_desa', 'profil_desa.user_id', '=', 'users.id')->where('users.level', 'Desa')
            ->limit('1')
            ->first();
        $pdf = PDF::loadview('staff/selesai/print', compact('data', 'desa'))->setPaper('A4', 'landscape');
        return $pdf->stream();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Program;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Surat;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDF;
use Barryvdh\DomPDF\Facade\Pdf as pp;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\App;

class StaffController extends Controller
{
    public function dashboard_staff(Request $request)
    {
        $data = Surat::all();
        foreach ($data as $dt) {
            if ($request->date) {
                $dt['2'] = Pengajuan::where('surat_id', $dt->id_surat)->whereDate('created_at', $request->date)->where('selesai', 'Surat Selesai')->count();
                $dt['3'] = Pengajuan::where('surat_id', $dt->id_surat)->whereDate('created_at', $request->date)->where('status_pengajuan', 'Pengecekan Permohonan')->count();
                $dt['4'] = Pengajuan::where('surat_id', $dt->id_surat)->whereDate('created_at', $request->date)->where('status_pengajuan', 'Data Belum Lengkap')->where('selesai', 'Lengkapi data')->count();
            } else {
                $dt['2'] = Pengajuan::where('surat_id', $dt->id_surat)->where('selesai', 'Surat Selesai')->count();
                $dt['3'] = Pengajuan::where('surat_id', $dt->id_surat)->where('status_pengajuan', 'Pengecekan Permohonan')->count();
                $dt['4'] = Pengajuan::where('surat_id', $dt->id_surat)->where('status_pengajuan', 'Data Belum Lengkap')->where('selesai', 'Lengkapi data')->count();
            }
        }

        return view('staff/home/home', compact('data'));
    }
    public function staff_acc(Request $request, $surat)
    {
        $program = Program::all();
        if ($request->search) {
            $data = User::where('name', 'like', "%$request->search%")->join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('surat.singkatan', $surat)->where('pengajuan.selesai', '=', NULL)->orWhere('pengajuan.selesai', '=', 'Lengkapi data')->orderByDesc('pengajuan.id_pengajuan')->paginate(5)->withQueryString();
        } else if ($request->program_id) {
            $data = User::where('program_id', $request->program_id)->join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('surat.singkatan', $surat)->where('pengajuan.selesai', '=', NULL)->orWhere('pengajuan.selesai', '=', 'Lengkapi data')->orderByDesc('pengajuan.id_pengajuan')->paginate(5)->withQueryString();
        } else if ($request->search && $request->program_id) {
            $data = User::where('name', 'like', "%$request->search%")->where('program_id', $request->program_id)->join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('surat.singkatan', $surat)->where('pengajuan.selesai', '=', NULL)->orWhere('pengajuan.selesai', '=', 'Lengkapi data')->orderByDesc('pengajuan.id_pengajuan')->paginate(5)->withQueryString();
        } else
            $data = User::join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->whereNull('pengajuan.selesai')->orWhere('pengajuan.selesai', 'Lengkapi data')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('surat.singkatan', $surat)->orderByDesc('pengajuan.id_pengajuan')->paginate(5);
        return view('staff/acc/acc', compact('data', 'program'));
    }
    public function staff_cek_berkas($surat, $id_pengajuan)
    {
        $data = User::join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('surat.singkatan', $surat)->where('pengajuan.id_pengajuan', $id_pengajuan)->firstOrFail();
        $berkas = DB::table('berkas_pengajuan')->join('pengajuan', 'pengajuan.id_pengajuan', '=', 'berkas_pengajuan.pengajuan_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('surat.singkatan', $surat)->where('pengajuan.id_pengajuan', $id_pengajuan)->get();
        return view('staff/acc/cek', compact('data', 'berkas'));
    }
    public function keterangan(Request $request, $id_pengajuan)
    {
        if ($request->upload_berkas) {
            // $files = $request->file('upload_berkas');
            // $foto = $files->getClientOriginalName();
            // $namaFileBaru = uniqid();
            // $namaFileBaru .= $foto;
            $namaFileBaru = uploadFile($request->upload_berkas, 'admin/' . Auth::user()->id, true);

            // $pengajuan->upload_berkas = $namaFileBaru;
            // $pengajuan->path_upload = $files->move(\base_path() . "/public/pengajuan_berkas", $namaFileBaru);
            DB::table('pengajuan')->where('id_pengajuan', $id_pengajuan)->update([
                'status_pengajuan' => $request->keterangan,
                'upload_berkas' => $namaFileBaru,
            ]);
        } else {
            if ($request->keterangan == 'Data Belum Lengkap') {
                DB::table('pengajuan')->where('id_pengajuan', $id_pengajuan)->update([
                    'status_pengajuan' => $request->keterangan,
                    'selesai' => 'Lengkapi data',
                    'note' => $request->note ?? '',
                ]);
                return redirect(route('staff_acc', $request->singkatan))->with('up', '-');
            } else {
                DB::table('pengajuan')->where('id_pengajuan', $id_pengajuan)->update([
                    'status_pengajuan' => $request->keterangan,
                ]);
            }
        }
        return redirect()->back()->with('up', '-');
    }
    public function konfirmasi($singkatan, $id_pengajuan)
    {
        DB::table('pengajuan')->where('id_pengajuan', $id_pengajuan)->update([
            'selesai' => 'Surat Selesai',
            'status_pengajuan' => 'Data Sudah Lengkap',
        ]);
        return redirect(route('staff_acc', $singkatan))->with('up', '-');
    }

    public function surat_selesai(Request $request)
    {
        $program = Program::all();
        if ($request->search) {
            $data = User::where('name', 'like', "%$request->search%")->join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->orderByDesc('pengajuan.id_pengajuan')->paginate(5)->withQueryString();
        } else if ($request->program_id) {
            $data = User::where('program_id', $request->program_id)->join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->orderByDesc('pengajuan.id_pengajuan')->paginate(5)->withQueryString();
        } else if ($request->search && $request->program_id) {
            $data = User::where('name', 'like', "%$request->search%")->where('program_id', $request->program_id)->join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->orderByDesc('pengajuan.id_pengajuan')->paginate(5)->withQueryString();
        } else
            $data = User::join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->orderByDesc('pengajuan.id_pengajuan')->paginate(5)->withQueryString();
        return view('staff/selesai/index', compact('data', 'program'));
    }
    public function laporan(Request $request)
    {
        $program = Program::all();
        if (isset($request->awal) && isset($request->akhir) && !isset($request->program_id)) {
            $data = User::join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->whereBetween('pengajuan.tgl_req', [$request->awal, $request->akhir])->orderByDesc('pengajuan.id_pengajuan')->paginate(5)->withQueryString();
            $count = User::join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->whereBetween('pengajuan.tgl_req', [$request->awal, $request->akhir])->orderByDesc('pengajuan.id_pengajuan')->count();
        } else if (isset($request->program_id) && !isset($request->awal) && !isset($request->akhir)) {
            $data = User::where('program_id', $request->program_id)->join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->orderByDesc('pengajuan.id_pengajuan')->paginate(5)->withQueryString();
            $count = User::where('program_id', $request->program_id)->join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->orderByDesc('pengajuan.id_pengajuan')->count();
        } else if (isset($request->awal) && isset($request->akhir) && isset($request->program_id)) {
            $data = User::where('program_id', $request->program_id)->join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->whereBetween('pengajuan.tgl_req', [$request->awal, $request->akhir])->orderByDesc('pengajuan.id_pengajuan')->paginate(5)->withQueryString();
            $count = User::where('program_id', $request->program_id)->join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->whereBetween('pengajuan.tgl_req', [$request->awal, $request->akhir])->orderByDesc('pengajuan.id_pengajuan')->count();
        } else if (isset($request->akhir) && !isset($request->awal)  && isset($request->program_id)) {
            $data = User::where('program_id', $request->program_id)->join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->whereDate('pengajuan.tgl_req', '<=', $request->akhir)->orderByDesc('pengajuan.id_pengajuan')->paginate(5)->withQueryString();
            $count = User::where('program_id', $request->program_id)->join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->whereDate('pengajuan.tgl_req', '<=', $request->akhir)->orderByDesc('pengajuan.id_pengajuan')->count();
        } else if (!isset($request->akhir) && isset($request->awal)  && isset($request->program_id)) {
            $data = User::where('program_id', $request->program_id)->join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->whereDate('pengajuan.tgl_req', $request->awal)->orderByDesc('pengajuan.id_pengajuan')->paginate(5)->withQueryString();
            $count = User::where('program_id', $request->program_id)->join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->whereDate('pengajuan.tgl_req', $request->awal)->orderByDesc('pengajuan.id_pengajuan')->count();
        } else if (isset($request->awal)  && !isset($request->akhir) && !isset($request->program_id)) {
            $data = User::join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->whereDate('pengajuan.tgl_req', $request->awal)->orderByDesc('pengajuan.id_pengajuan')->paginate(5)->withQueryString();
            $count = User::join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->whereDate('pengajuan.tgl_req', $request->awal)->orderByDesc('pengajuan.id_pengajuan')->count();
        } else if (!isset($request->awal)  && isset($request->akhir) && !isset($request->program_id)) {
            $data = User::join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->whereDate('pengajuan.created_at', '<', $request->akhir)->orderByDesc('pengajuan.id_pengajuan')->paginate(5)->withQueryString();
            $count = User::join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->whereDate('pengajuan.created_at', '<', $request->akhir)->orderByDesc('pengajuan.id_pengajuan')->count();
        } else {
            $data = User::join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->orderByDesc('pengajuan.id_pengajuan')->paginate(5)->withQueryString();
            $count = User::join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->count();
        }
        return view('staff/selesai/laporan', compact('data', 'program', 'count'));
    }

    public function exportPdf(Request $request)
    {
        if (isset($request->awal) && isset($request->akhir) && !isset($request->program_id)) {
            $data['user'] = User::with(['program:id,nama'])->join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->whereBetween('pengajuan.tgl_req', [$request->awal, $request->akhir])->orderByDesc('pengajuan.id_pengajuan')->get();
            $data['count'] = User::join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->whereBetween('pengajuan.tgl_req', [$request->awal, $request->akhir])->orderByDesc('pengajuan.id_pengajuan')->count();
        } else if (isset($request->program_id) && !isset($request->awal) && !isset($request->akhir)) {
            $data['user'] = User::with(['program:id,nama'])->where('program_id', $request->program_id)->join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->orderByDesc('pengajuan.id_pengajuan')->get();
            $data['count'] = User::where('program_id', $request->program_id)->join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->orderByDesc('pengajuan.id_pengajuan')->count();
        } else if (isset($request->awal) && isset($request->akhir) && isset($request->program_id)) {
            $data['user'] = User::with(['program:id,nama'])->where('program_id', $request->program_id)->join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->whereBetween('pengajuan.tgl_req', [$request->awal, $request->akhir])->orderByDesc('pengajuan.id_pengajuan')->get();
            $data['count'] = User::where('program_id', $request->program_id)->join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->whereBetween('pengajuan.tgl_req', [$request->awal, $request->akhir])->orderByDesc('pengajuan.id_pengajuan')->count();
        } else if (isset($request->akhir) && !isset($request->awal)  && isset($request->program_id)) {
            $data['user'] = User::with(['program:id,nama'])->where('program_id', $request->program_id)->join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->whereDate('pengajuan.tgl_req', '<=', $request->akhir)->orderByDesc('pengajuan.id_pengajuan')->get();
            $data['count'] = User::where('program_id', $request->program_id)->join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->whereDate('pengajuan.tgl_req', '<=', $request->akhir)->orderByDesc('pengajuan.id_pengajuan')->count();
        } else if (!isset($request->akhir) && isset($request->awal)  && isset($request->program_id)) {
            $data['user'] = User::with(['program:id,nama'])->where('program_id', $request->program_id)->join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->whereDate('pengajuan.tgl_req', $request->awal)->orderByDesc('pengajuan.id_pengajuan')->get();
            $data['count'] = User::where('program_id', $request->program_id)->join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->whereDate('pengajuan.tgl_req', $request->awal)->orderByDesc('pengajuan.id_pengajuan')->count();
        } else if (isset($request->awal)  && !isset($request->akhir) && !isset($request->program_id)) {
            $data['user'] = User::with(['program:id,nama'])->join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->whereDate('pengajuan.tgl_req', $request->awal)->orderByDesc('pengajuan.id_pengajuan')->get();
            $data['count'] = User::join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->whereDate('pengajuan.tgl_req', $request->awal)->orderByDesc('pengajuan.id_pengajuan')->count();
        } else if (!isset($request->awal)  && isset($request->akhir) && !isset($request->program_id)) {
            $data['user'] = User::with(['program:id,nama'])->join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->whereDate('pengajuan.created_at', '<', $request->akhir)->orderByDesc('pengajuan.id_pengajuan')->get();
            $data['count'] = User::join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->whereDate('pengajuan.created_at', '<', $request->akhir)->orderByDesc('pengajuan.id_pengajuan')->count();
        } else {
            $data['user'] = User::with(['program:id,nama'])->join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->orderByDesc('pengajuan.id_pengajuan')->get()->toArray();
            $data['count'] = User::join('info_lengkap', 'users.id', '=', 'info_lengkap.user_id')->join('pengajuan', 'pengajuan.user_id', '=', 'info_lengkap.user_id')->join('surat', 'surat.id_surat', '=', 'pengajuan.surat_id')->where('pengajuan.selesai', '=', 'Surat Selesai')->count();
        }
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.exports', $data);
        return $pdf->stream('export.pdf');
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

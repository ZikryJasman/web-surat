<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pengajuan;
use App\Models\Program;
use App\Models\Surat;
use App\PengajuanUser;
use Carbon\Carbon;
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
        if ($surat->id == 3) {
            $users = User::where('level', 'Pengaju')->get();
        } else {
            $users = [];
        }
        return view('pengaju/request/index', compact('data', 'surat', 'users'));
    }
    public function updateRequest($surat, $idPengajuan)
    {
        if ($surat->id == 3) {
            $users = User::where('level', 'Pengaju')->get();
        } else {
            $users = [];
        }
        $data = User::join('info_lengkap', 'info_lengkap.user_id', '=', 'users.id')->where('users.id', Auth::user()->id)->join('pengajuan', 'pengajuan.user_id', '=', 'users.id')->where('users.id', Auth::user()->id)->where('id_pengajuan', $idPengajuan)->get();
        $surat = Surat::where('id_surat', $data[0]->surat_id)->first();
        return view('pengaju/data/update', compact('data', 'surat', 'users'));
    }
    public function exportWord($idPengajuan)
    {
        $doc = User::join('info_lengkap', 'info_lengkap.user_id', '=', 'users.id')->where('users.id', Auth::user()->id)->join('pengajuan', 'pengajuan.user_id', '=', 'users.id')->where('users.id', Auth::user()->id)->where('id_pengajuan', $idPengajuan)->first();
        if ($doc->surat_id) $users = PengajuanUser::where('pengajuan_id', $doc->id_pengajuan)->get();
        else $users = [];
        if ($doc->surat_id == 1) { //S. Keterangan Masih Kuliah
            $path = 'Format_Surat/Surat_Keterangan_Masih_Kuliah.docx';
        } elseif ($doc->surat_id == 2) { //S. Rekomendasi Beasiswa
            $path = 'Format_Surat/Surat_Rekomendasi.docx';
        } elseif ($doc->surat_id == 3) { //Surat Dispensasi
            $path = 'Format_Surat/Surat_Dispensasi_Kuliah.docx';
        } elseif ($doc->surat_id == 4) { //Surat Tugas Mahasiswa
            $path = 'Format_Surat/Surat_Tugas.docx';
        } elseif ($doc->surat_id == 5) { //Surat Peryataan Tidak Menerima Beasiswa
            $path = 'Format_Surat/Surat_Pernyataan_Tidak_Menerima_Beasiswa_Manapun.docx';
        } elseif ($doc->surat_id == 8) { //Surat Magang Indonesia Bersertifikat
            $path = 'Format_Surat/Surat_Rekomendasi_Magang_Studi_Independen_Bersertifikat.docx';
        }
        $program = Program::where('id', $doc->program_id)->firstOrFail();
        $nama_dekan = User::where('level', 'Kepala Desa')->latest()->first();
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(public_path($path));

        $nameSPA = $doc->name ?? '';
        $alamat = $doc->alamat ?? '';
        $nim = $doc->nim ?? '';
        $pangkat = $doc->pangkat ?? '';
        $pangkat = $doc->pangkat ?? '';
        $ttl = $doc->tempat . ' ' . parseDateId($doc->tgl_lahir) ?? '';
        $parents_name = $doc->parents_name ?? '';
        $parents_nopen = $doc->parents_nopen ?? '';
        $parents_group = $doc->parents_group ?? '';
        $why = $doc->why ?? '';
        $parents_ocupation = $doc->parents_ocupation ?? '';
        $dosen = $program->dosen ?? '';
        if ($program) {
            $fakultas = $program->fakultas;
            $prodi = $program->nama;
        }
        $reason = $doc->reason ?? '';
        $nomor_surat = $doc->nomor_surat ?? '';
        $now = parseDateId(Carbon::now());

        $templateProcessor->setValue('namaPengaju', $nameSPA);
        $templateProcessor->setValue('nim', $nim);
        $templateProcessor->setValue('pangkat', $pangkat);
        $templateProcessor->setValue('fakultas', $fakultas);
        $templateProcessor->setValue('prodi', $prodi);
        $templateProcessor->setValue('ttl', $ttl);
        $templateProcessor->setValue('parents_name', $parents_name);
        $templateProcessor->setValue('parents_nopen', $parents_nopen);
        $templateProcessor->setValue('parents_group', $parents_group);
        $templateProcessor->setValue('parents_ocupation', $parents_ocupation);
        $templateProcessor->setValue('dosen', $dosen);
        $templateProcessor->setValue('reason', $reason);
        $templateProcessor->setValue('alamat', $alamat);
        $templateProcessor->setValue('now', $now);
        $templateProcessor->setValue('nama_dekan', $nama_dekan->name);
        $templateProcessor->setValue('why', $why);
        $templateProcessor->setValue('nip_dekan', $nama_dekan->nim);
        $templateProcessor->setValue('email', $nama_dekan->email);
        $templateProcessor->setValue('telepon', $nama_dekan->telepon);
        $templateProcessor->setValue('nomor_surat', $nomor_surat);


        if ($doc->surat_id == 1) { //S. Keterangan Masih Kuliah
            $fileName = 'Surat_Keterangan_Masih_Kuliah ' . $nameSPA;
        } elseif ($doc->surat_id == 2) { //S. Rekomendasi Beasiswa
            $fileName = 'Surat_Rekomendasi ' . $nameSPA;
        } elseif ($doc->surat_id == 3) { //Surat Dispensasi
            $fileName = 'Surat_Dispensasi_Kuliah ' . $nameSPA;
        } elseif ($doc->surat_id == 4) { //Surat Tugas Mahasiswa
            $fileName = 'Surat_Tugas ' . $nameSPA;
        } elseif ($doc->surat_id == 5) { //Surat Peryataan Tidak Menerima Beasiswa
            $fileName = 'Surat_Pernyataan_Tidak_Menerima_Beasiswa_Manapun ' . $nameSPA;
        } elseif ($doc->surat_id == 8) { //Surat Magang Indonesia Bersertifikat
            $fileName = 'Surat_Rekomendasi_Magang_Studi_Independen_Bersertifikat ' . $nameSPA;
        }
        $templateProcessor->saveAs($fileName . '.docx');
        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
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
        $pengajuan = null;
        if ($request->id_pengajuan) {
            $pengajuan = Pengajuan::where('id_pengajuan', $request->id_pengajuan)->firstOrFail();
        } else {
            $pengajuan = new Pengajuan();
        }
        if ($request->id_surat == 1) {
            $pengajuan->semester = $request->semester;
            $pengajuan->academy_year = $request->academy_year;
            $pengajuan->parents_name = $request->parents_name;
            $pengajuan->parents_nopen = $request->parents_nopen;
            $pengajuan->parents_group = $request->parents_group;
            $pengajuan->parents_ocupation = $request->parents_ocupation;
        } elseif ($request->id_surat == 2) {
            $pengajuan->ips = $request->ips;
            $pengajuan->sks = $request->sks;
            $pengajuan->dosen = $request->dosen;
        } elseif ($request->id_surat == 4) {
        } elseif ($request->id_surat == 5) {
            $pengajuan->ips = $request->ips;
            $pengajuan->sks = $request->sks;
            $pengajuan->reason = $request->reason;
            $pengajuan->why = $request->why;
            $pengajuan->semester = $request->semester;
            $pengajuan->academy_year = $request->academy_year;
        } elseif ($request->id_surat == 8) {
            $pengajuan->ips = $request->ips;
            $pengajuan->sks = $request->sks;
            $pengajuan->why = $request->why;
            $pengajuan->semester = $request->semester;
            $pengajuan->nisn = $request->nisn;
        }
        $pengajuan->user_id = Auth::user()->id;
        $pengajuan->surat_id = $request->id_surat;
        if ($request->id_pengajuan) {
            $pengajuan->status_pengajuan = 'Pengajuan Ulang';
            $pengajuan->selesai = null;
        } else {
            $pengajuan->status_pengajuan = 'Pengecekan Permohonan';
        }
        $pengajuan->tgl_req = now();
        $pengajuan->keperluan = $request->keperluan;
        if ($request->path_upload) {
            $path = uploadFile($request->path_upload, 'admin/' . Auth::user()->id, true);
        } else {
            $path = null;
        }
        $pengajuan->path_upload =  $path;
        $pengajuan->nomor_surat = $bulan . '-' . date('d-Y');
        $pengajuan->save();
        if ($request->id_surat == 3 || $request->id_surat == 4) {
            if (!empty($request->users)) {
                foreach ($request->users as $key => $category) {
                    $usersData[$key]['pengajuan_id'] = (int) $category['id'];
                    $usersData[$key]['user_id'] = $pengajuan->id;
                }

                $pengajuan->users()->sync($usersData);
            }
        }

        $files = $request->file('berkas');
        foreach ($files as $file) {
            $namaFileBaru = uploadFoto($file, 'admin/' . Auth::user()->id, true);
            DB::table('berkas_pengajuan')->insert([
                'pengajuan_id' => $pengajuan->id_pengajuan,
                'data_berkas' => $namaFileBaru,
                'path' => $namaFileBaru,
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
            // $ambil = $request->file('foto');
            // $name = $ambil->getClientOriginalName();
            // $namaFileBaru = uniqid();
            // $namaFileBaru .= $name;
            // $ambil->move(\base_path() . "/public/profil", $namaFileBaru);
            $namaFileBaru = uploadFoto($request->file('foto'), 'admin/' . Auth::user()->id, true);

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

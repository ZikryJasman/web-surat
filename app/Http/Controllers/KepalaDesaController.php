<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Surat;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class KepalaDesaController extends Controller
{
	public function dashboard_kepaladesa()
	{
		$data=Surat::all();
		return view('kepaladesa/home/home',compact('data'));
	}
	public function kepaladesa_acc(Request $request,$surat)
	{
        $program = Program::all();
        if ($request->search) {
            $data = User::where('name', 'like', "%$request->search%")->join('info_lengkap','users.id','=','info_lengkap.user_id')->join('pengajuan','pengajuan.user_id','=','info_lengkap.user_id')->join('surat','surat.id_surat','=','pengajuan.surat_id')->where('surat.singkatan',$surat)->where('pengajuan.selesai','=','Sudah di Konfirmasi')->orderByDesc('pengajuan.id_pengajuan')->paginate(5)->withQueryString();
        }else if ($request->program_id) {
            $data = User::where('program_id', $request->program_id)->join('info_lengkap','users.id','=','info_lengkap.user_id')->join('pengajuan','pengajuan.user_id','=','info_lengkap.user_id')->join('surat','surat.id_surat','=','pengajuan.surat_id')->where('surat.singkatan',$surat)->where('pengajuan.selesai','=','Sudah di Konfirmasi')->orderByDesc('pengajuan.id_pengajuan')->paginate(5)->withQueryString();
        }else if ($request->search && $request->program_id) {
            $data = User::where('name', 'like', "%$request->search%")->where('program_id', $request->program_id)->join('info_lengkap','users.id','=','info_lengkap.user_id')->join('pengajuan','pengajuan.user_id','=','info_lengkap.user_id')->join('surat','surat.id_surat','=','pengajuan.surat_id')->where('surat.singkatan',$surat)->where('pengajuan.selesai','=','Sudah di Konfirmasi')->orderByDesc('pengajuan.id_pengajuan')->paginate(5)->withQueryString();
        } else
		$data=User::join('info_lengkap','users.id','=','info_lengkap.user_id')->join('pengajuan','pengajuan.user_id','=','info_lengkap.user_id')->join('surat','surat.id_surat','=','pengajuan.surat_id')->where('surat.singkatan',$surat)->where('pengajuan.selesai','=','Sudah di Konfirmasi')->orderByDesc('pengajuan.id_pengajuan')->paginate(5)->withQueryString();
		return view('kepaladesa/acc/acc',compact('data','program'));
	}
	public function ttd($surat,$id_pengajuan)
	{
		$data=User::join('info_lengkap','users.id','=','info_lengkap.user_id')->join('pengajuan','pengajuan.user_id','=','info_lengkap.user_id')->join('surat','surat.id_surat','=','pengajuan.surat_id')->join('template','template.id_template','=','surat.template_id')->where('surat.singkatan',$surat)->where('pengajuan.id_pengajuan',$id_pengajuan)->get();
        $desa=User::join('biodata_desa','biodata_desa.user_id','=','users.id')->join('indonesia_provinces','indonesia_provinces.code','=','biodata_desa.province_codes')->join('indonesia_cities','indonesia_cities.code','=','biodata_desa.city_codes')->join('indonesia_districts','indonesia_districts.code','=','biodata_desa.district_codes')->join('indonesia_villages','indonesia_villages.code','=','biodata_desa.village_codes')->join('profil_desa','profil_desa.user_id','biodata_desa.user_id')->where('users.level','Desa')->get();
		return view('kepaladesa/acc/ttd',compact('data','desa'));
	}
	public function ttd_upload(Request $request,$id_pengajuan)
	{
		$folderPath= public_path();
		$image_parts=explode(";base64,", $request->ttd);
		$image_type_aux=explode("image/", $image_parts[0]);
		$image_type=$image_type_aux[1];
		$image_base64=base64_decode($image_parts[1]);
		$file=$folderPath.uniqid().'.'.$image_type;
		$name=uniqid().'.'.$image_type;
		file_put_contents($name, $image_base64);

		DB::table('pengajuan')->where('id_pengajuan',$id_pengajuan)->update([
			'ttd'=>$name,
		]);
		$tempat=public_path($request->lama);
		File::delete($tempat);
		return redirect
		(
			route('ttd',['surat'=>$request->singkatan,'id_pengajuan'=>$id_pengajuan,'keyword=cek-surat'])
		)->with('up','-');
	}
	public function confirm_ttd(Request $request,$id_pengajuan)
	{
		DB::table('pengajuan')->where('id_pengajuan',$id_pengajuan)->update([
			'selesai'=>'Surat Selesai',
		]);
		return redirect(route('kepaladesa_acc',$request->singkatan))->with('up','-');
	}
	public function form_ttd($id_pengajuan)
	{
		$data=User::join('info_lengkap','users.id','=','info_lengkap.user_id')->join('pengajuan','pengajuan.user_id','=','info_lengkap.user_id')->join('surat','surat.id_surat','=','pengajuan.surat_id')->where('pengajuan.id_pengajuan',$id_pengajuan)->get();
		$desa=User::join('biodata_desa','biodata_desa.user_id','=','users.id')->join('indonesia_provinces','indonesia_provinces.code','=','biodata_desa.province_codes')->join('indonesia_cities','indonesia_cities.code','=','biodata_desa.city_codes')->join('indonesia_districts','indonesia_districts.code','=','biodata_desa.district_codes')->join('indonesia_villages','indonesia_villages.code','=','biodata_desa.village_codes')->join('profil_desa','profil_desa.user_id','biodata_desa.user_id')->where('users.level','Desa')->get();
		return view('kepaladesa/form_ttd',compact('data','desa'));
	}
}

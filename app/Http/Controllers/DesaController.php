<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\City;
use App\Models\Village;
use App\Models\District;
use App\Models\User;
use App\Models\Surat;
use App\Models\Layanan;
use App\Models\Prosedur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DesaController extends Controller
{
    public function dashboard($title)
    {
        $data=User::where('title_user',$title)->get();
        return view('desa/dashboard/dashboard',compact('data'));    
    }
    public function user_pengaju()
    {
        $data=User::join('info_lengkap','info_lengkap.user_id','=','users.id')->where('users.level','Pengaju')->get();
        return view('desa/user/pengaju',compact('data'));
    }
    public function user_pengurus()
    {
        $kota=City::all();
        $data=User::join('info_lengkap','info_lengkap.user_id','=','users.id')->get();
        return view('desa/user/pengurus',compact('data','kota'));
    }
    public function cek_user($title,$id)
    {
        $data=User::join('info_lengkap','info_lengkap.user_id','=','users.id')->where('users.id',$id)->get();
        return view('desa/user/detail',compact('data'));
    }
    public function data_surat()
    {
        $data=Surat::all();
        return view('desa/surat/surat',compact('data'));
    }
    public function tambah_surat(Request $request)
    {
        foreach ($request->nama_surat as $key => $value) {
            $string = $request->nama_surat[$key];
            $arr = explode(' ', $string);
            $singkatan = '';
            foreach($arr as $kata)
            {
                $singkatan .= substr($kata, 0, 1);
            }
            $surat = new Surat();
            $surat -> nama_surat = $request -> nama_surat[$key];
            $surat -> singkatan = $singkatan;
            $surat -> bg = $request -> bg[$key];
            $surat -> persyaratan = $request -> persyaratan[$key];
            $surat -> save();
        }
        return back()->with('add','-');
    }
    public function edit_surat(Request $request,$id_surat)
    {
        $string = $request->nama_surat;
        $arr = explode(' ', $string);
        $singkatan = '';
        foreach($arr as $kata)
        {
            $singkatan .= substr($kata, 0, 1);
        }
        Surat::where('id_surat',$id_surat)->update([
            'nama_surat'=>$request->nama_surat,
            'singkatan'=>$singkatan,
            'bg'=>$request->bg,
            'persyaratan'=>$request->persyaratan,
        ]);
        return back()->with('up','-');
    }
    public function hapus_surat($id_surat)
    {
        Surat::where('id_surat',$id_surat)->delete();
        return back()->with('del','-');
    }
    public function waktu_layanan()
    {
        $data=Layanan::all();
        return view('desa/layanan/layanan',compact('data'));
    }
    public function tambah_layanan(Request $request)
    {
        foreach ($request->hari as $key => $value) {
            $layanan = new Layanan();
            $layanan -> hari = $request -> hari[$key];
            $layanan -> waktu = $request -> waktu[$key];
            $layanan -> sampai = $request -> sampai[$key];
            $layanan -> save();
        }
        return redirect()->back()->with('add','-');
    }
    public function edit_layanan(Request $request,$id_layanan)
    {
        Layanan::where('id_layanan',$id_layanan)->update([
            'hari'=>$request->hari,
            'waktu'=>$request->waktu,
            'sampai'=>$request->sampai,
        ]);
        return redirect()->back()->with('up','-');
    }
    public function hapus_layanan($id_layanan)
    {
        Layanan::where('id_layanan',$id_layanan)->delete();
        return redirect()->back()->with('del','-');
    }
    public function prosedur()
    {
        $data=Prosedur::all();
        $cek=Prosedur::count();
        return view('desa/prosedur/prosedur',compact('data','cek'));
    }
    public function tambah_prosedur(Request $request)
    {
        $prosedur = new Prosedur();
        $prosedur -> prosedur = $request->prosedur;
        $prosedur -> save();
        return redirect()->back()->with('add','-');
    }
    public function edit_prosedur(Request $request,$id_prosedur)
    {
        Prosedur::where('id_prosedur',$id_prosedur)->update([
            'prosedur'=>$request->prosedur,
        ]);
        return redirect()->back()->with('up','-');
    }
    public function hapus_prosedur($id_prosedur)
    {
        Prosedur::where('id_prosedur',$id_prosedur)->delete();
        return redirect()->back()->with('del','-');
    }
    public function profil_desa($title)
    {
        $data=User::join('biodata_desa','biodata_desa.user_id','=','users.id')->join('indonesia_provinces','indonesia_provinces.code','=','biodata_desa.province_codes')->join('indonesia_cities','indonesia_cities.code','=','biodata_desa.city_codes')->join('indonesia_districts','indonesia_districts.code','=','biodata_desa.district_codes')->join('indonesia_villages','indonesia_villages.code','=','biodata_desa.village_codes')->join('profil_desa','profil_desa.user_id','=','users.id')->where('users.title_user',$title)->where('users.id',Auth::user()->id)->get();
        return view('desa/profildesa/profil',compact('data'));
    }
    public function lengkapi(Request $request,$id)
    {
        if ($request->hasFile('foto')) {
            $ambil=$request->file('foto');
            $name=$ambil->getClientOriginalName();
            $namaFileBaru = uniqid();
            $namaFileBaru .= $name;
            $ambil->move(\base_path()."/public/foto", $namaFileBaru);
            DB::table('profil_desa')->where('user_id',$id)->update([
                'lokasi_desa'=>$request->lokasi_desa,
                'telepon_desa'=>$request->telepon_desa,
                'logo'=>$namaFileBaru,
            ]);
            DB::table('users')->where('id',$id)->update([
                'email'=>$request->email,
            ]);     
        }else{
            DB::table('profil_desa')->where('user_id',$id)->update([
                'lokasi_desa'=>$request->lokasi_desa,
                'telepon_desa'=>$request->telepon_desa,
            ]);
            DB::table('users')->where('id',$id)->update([
                'name'=>$request->name,
                'email'=>$request->email,
            ]);
        }
        return redirect()->back()->with('up','-');
    }
    public function ganti_password(Request $request,$id)
    {
        DB::table('users')->where('id',$id)->update([
            'password'=>Hash::make($request->password),
        ]);
        return redirect()->back()->with('up','-');
    }
    public function tambah_pengurus(Request $request)
    {
        $cek=User::where('email',$request->email)->first();
        if ($cek==NULL) {
            $ambil=$request->file('foto');
            $name=$ambil->getClientOriginalName();
            $namaFileBaru = uniqid();
            $namaFileBaru .= $name;
            $ambil->move(\base_path()."/public/profil", $namaFileBaru);

            $user=new User();
            $user -> name = $request -> name;
            $user -> email = $request -> email;
            $user -> password = hash::make($request -> password);
            $user -> level = $request->level;
            $user -> status_user = 'True';
            $user->save();
            DB::table('info_lengkap')->insert([
                'user_id'=>$user->id,
                'nik'=>$request->nik,
                'alamat'=>$request->alamat,
                'agama'=>$request->agama,
                'telepon'=>$request->telepon,
                'jenis_kelamin'=>$request->jenis_kelamin,
                'tempat'=>$request->tempat,
                'tgl_lahir'=>$request->tgl_lahir,
                'foto_profil'=>$namaFileBaru,
            ]); 
            return redirect()->back()->with('add','-');              
        }else{
            return redirect()->back()->with('email','-');              
        }
    }

    public function template($title_user,$id_surat)
    {
        $data = DB::table('template')->orderBy('id_template','ASC')->get();
        $surat=Surat::where('id_surat',$id_surat)->get();
        return view('desa/template/pilih',compact('data','surat'));
    }
    public function custom_template(Request $request,$template_id)
    {
        DB::table('surat')->where('id_surat',$request->id_surat)->update([
            'template_id'=>$template_id,
        ]);
        return redirect(route('data_surat',Auth::user()->title_user))->with('up','-');
    }
}

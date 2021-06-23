<?php

namespace App\Http\Controllers;

use App\Models\ManageKelas;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ManageKelasController extends Controller
{

    public function Add(Request $request){
        if($validate = $this->validing($request->all(), [
            'pelajaran_id' => 'required',
            'kelas_id' => 'required',
            'discount' => 'required',
            'harga_awal' => 'required',
            'harga_akhir' => 'required',
        ]))
            return $validate;
        
        $manage = ManageKelas::create($request->all());
        return $this->resSuccess($manage);
    }

    public function ShowAll(){
        return $this->resSuccess(ManageKelas::with(['pelajaran','kelas'])->get());
    }

    public function Details(Request $request){
        if($validator = Validator::make($request->all(), [
            'id' => 'required',
        ]));
            return $validator;
        
        $detail = ManageKelas::find($request->id);
        if(!$detail) return $this->resFailed(1,'Data tidak ditemukan');
        return $this->resSuccess($detail->with(['kelas','pelajaran'])->get());
    }

    public function delete(Request $request){
        if ($validate = $this->validing($request->all(),[
            'id' => 'required',
        ]))
            return $validate;
        try{
            ManageKelas::find($request->id)->delete();
        }catch(Exception $st){
            return $this->resFailed(1,'Data gagal dihapus!');
        }
        return $this->resSuccess('Data berhasil dihapus!');
    }

    public function Update(Request $request){
        if ($validate = $this->validing($request->all(),[
            'id' => 'required',
        ]))
            return $validate;
        try{
            ManageKelas::find($request->id)->update();
        }catch(Exception $st){
            return $this->resFailed(1,'Data gagal di update!');
        }
        return $this->resSuccess('Data berhasil di update!');
    }
}

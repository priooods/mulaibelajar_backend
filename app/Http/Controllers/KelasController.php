<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    public function Add(Request $request){
        if($validator = $this->validing($request->all(), [
            'nama_kelas' => 'required',
            'deskripsi' => 'required',
        ]))
            return $validator;

        $kelas = Kelas::create($request->all());
        return $this->resSuccess($kelas);
    }

    public function ShowAll(){
        return $this->resSuccess(Kelas::all());
    }

    public function Update(Request $request){
        if($validator = $this->validing($request->all(), [
            'id' => 'required',
        ]))
            return $validator;
        
        $kelas = Kelas::find($request->id);
        if(!$kelas) return $this->resFailed(1,'Kelas Tidak Ditemukan');
        
        $kelas->update($request->all());
        return $this->resSuccess($kelas);
    }
}

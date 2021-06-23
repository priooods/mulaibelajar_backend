<?php

namespace App\Http\Controllers;

use App\Models\Pelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PelajaranController extends Controller
{
    public function Add(Request $request){
        if($validator = $this->validing($request->all(), [
            'nama_pelajaran' => 'required',
            'deskripsi' => 'required',
        ]))
            return $validator;

        $pelajaran = Pelajaran::create($request->all());
        return $this->resSuccess($pelajaran);
    }

    public function ShowAll(){
        return $this->resSuccess(Pelajaran::all());
    }

    public function Update(Request $request){
        if($validator = $this->validing($request->all(), [
            'id' => 'required',
        ]))
            return $validator;
        
        $pelajaran = Pelajaran::find($request->id);
        if(!$pelajaran) return $this->resFailed(1,'Pelajaran Tidak Ditemukan');
        
        $pelajaran->update($request->all());
        return $this->resSuccess($pelajaran);
    }
}

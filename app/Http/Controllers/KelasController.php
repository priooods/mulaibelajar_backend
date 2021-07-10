<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    public function add(Request $request){
        if($validator = $this->validing($request->all(), [
            'kls' => 'required',
            'tgkt' => 'required',
        ]))
            return $validator;
        $kelas = Kelas::create($request->all());
        return $this->resSuccess($kelas);
    }

    public function all(){
        return $this->resSuccess(Kelas::all());
    }

    public function update(Request $request){
        if($validator = $this->validing($request->all(), [
            'id' => 'required',
        ]))
            return $validator;
        
        $kelas = Kelas::find($request->id);
        if(!$kelas) return $this->resFailed(1,'Kelas Tidak Ditemukan');
        
        $kelas->update($request->all());
        return $this->resSuccess($kelas);
    }

    public function delete(Request $request){
        if ($validate = $this->validing($request->all(),[
            'id' => 'required',
        ]))
            return $validate;
        try{
            Kelas::find($request->id)->delete();
        }catch(Exception $st){
            return $this->resFailed(1,'Data gagal dihapus!');
        }
        return $this->resSuccess('Data berhasil dihapus!');
    }
}

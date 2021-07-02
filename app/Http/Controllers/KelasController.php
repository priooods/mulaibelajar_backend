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
            'kelas' => 'required',
            'level' => 'required',
        ]))
            return $validator;
        $statement = DB::select("SHOW TABLE STATUS LIKE 'kelas'");
        $nextId = $statement[0]->Auto_increment;

        $request['code'] = "KLS".str_pad($nextId,6-floor(log10($nextId)),"0",STR_PAD_LEFT);
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

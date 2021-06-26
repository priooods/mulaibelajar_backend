<?php

namespace App\Http\Controllers;

use App\Models\Pelajaran;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PelajaranController extends Controller
{
    public function add(Request $request){
        if($validator = $this->validing($request->all(), [
            'nama_pelajaran' => 'required',
            'deskripsi' => 'required',
            'subtitle' => 'required'
        ]))
            return $validator;

        $statement = DB::select("SHOW TABLE STATUS LIKE 'pelajarans'");
        $nextId = $statement[0]->Auto_increment;

        $request['kode_pelajaran'] = "PLJ".str_pad($nextId,6-floor(log10($nextId)),"0",STR_PAD_LEFT);
        $pelajaran = Pelajaran::create($request->all());
        return $this->resSuccess($pelajaran);
    }

    public function all(){
        return $this->resSuccess(Pelajaran::all());
    }

    public function update(Request $request){
        if($validator = $this->validing($request->all(), [
            'id' => 'required',
        ]))
            return $validator;
        
        $pelajaran = Pelajaran::find($request->id);
        if(!$pelajaran) return $this->resFailed(1,'Pelajaran Tidak Ditemukan');
        
        $pelajaran->update($request->all());
        return $this->resSuccess($pelajaran);
    }

    public function delete(Request $request){
        if ($validate = $this->validing($request->all(),[
            'id' => 'required',
        ]))
            return $validate;
        try{
            Pelajaran::find($request->id)->delete();
        }catch(Exception $st){
            return $this->resFailed(1,'Data gagal dihapus!');
        }
        return $this->resSuccess('Data berhasil dihapus!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Harga;
use App\Models\Pelajaran;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PelajaranController extends Controller
{
    public function add(Request $request){
        if($validator = $this->validing($request->all(), [
            'kelas_id' => 'required',
            'titl' => 'required',
            'desc' => 'required',
            'nick' => 'required',
            'type' => 'required',
        ]))
            return $validator;

        $statement = DB::select("SHOW TABLE STATUS LIKE 'pelajarans'");
        $nextId = $statement[0]->Auto_increment;

        $request['cde'] = 'PLJ'.str_pad($nextId,3-floor(log10($nextId)),"0",STR_PAD_LEFT);
        $pelajaran = Pelajaran::create($request->all());
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = $pelajaran->id . '_'.$pelajaran->type.'_' . $file->getClientOriginalName();
            $file->move(public_path('file'), $filename);
            $pelajaran->update(['img' => $filename]);
        }
        return $this->resSuccess($pelajaran);
    }

    public function all(){
        return $this->resSuccess(Pelajaran::with(['harga','kelas'])->get());
    }

    public function find(Request $request){
        if ($validate = $this->validing($request->all(),[
            'type' => 'required',
        ]))
            return $validate;
        return $this->resSuccess(Pelajaran::where('type', $request->type)->with(['harga'])->get());
    }

    public function update(Request $request){
        if($validator = $this->validing($request->all(), [
            'id' => 'required',
        ]))
            return $validator;
        
        $pelajaran = Pelajaran::find($request->id);
        if(!$pelajaran) return $this->resFailed(1,'Pelajaran Tidak Ditemukan');

        if ($request->img != null){
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $filename = $pelajaran->id . '_pel_' . $file->getClientOriginalName();
                if ($pelajaran->img) {
                    $file_loc = public_path('file/') . $pelajaran->img;
                    unlink($file_loc);
                }
                $file->move(public_path('file'), $filename);
                $pelajaran->img = $request->img = $filename;
            }
        }
        
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

    public function hargaadd(Request $request){
        if($validator = $this->validing($request->all(), [
            'pelajaran_id' => 'required',
            'prc' => 'required',
            'prcd' => 'required',
            'dsc' => 'required',
        ]))
            return $validator;

        $harga = Harga::create($request->all());
        return $this->resSuccess($harga);
    }
}

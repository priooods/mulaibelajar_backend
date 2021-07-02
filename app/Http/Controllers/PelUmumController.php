<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PelUmum;
use Exception;

class PelUmumController extends Controller
{
    public function add(Request $request){
        if($validator = $this->validing($request->all(), [
            'nama' => 'required'
        ]))
            return $validator;

        // $statement = DB::select("SHOW TABLE STATUS LIKE 'pelajarans'");
        // $nextId = $statement[0]->Auto_increment;

        // $request['code'] = "PLJ".str_pad($nextId,6-floor(log10($nextId)),"0",STR_PAD_LEFT);
        $pelajaran = PelUmum::create($request->all());
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = $pelajaran->id . '_umum_' . $file->getClientOriginalName();
            $file->move(public_path('file'), $filename);
            $pelajaran->update(['img' => $filename]);
        }
        return $this->resSuccess($pelajaran);
    }

    public function all(){
        return $this->resSuccess(PelUmum::with('pelajaran')->get());
    }

    public function update(Request $request){
        if($validator = $this->validing($request->all(), [
            'id' => 'required',
        ]))
            return $validator;
        
        if(!$pelajaran = PelUmum::find($request->id))
            return $this->resFailed(1,'Pelajaran Tidak Ditemukan');

        if ($request->img != null){
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $filename = $pelajaran->id . '_umum_' . $file->getClientOriginalName();
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
            PelUmum::find($request->id)->delete();
        }catch(Exception $st){
            return $this->resFailed(1,'Data gagal dihapus!');
        }
        return $this->resSuccess('Data berhasil dihapus!');
    }
}

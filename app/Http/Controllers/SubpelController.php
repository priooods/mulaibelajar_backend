<?php

namespace App\Http\Controllers;

use App\Models\Subspelajaran;
use Exception;
use Illuminate\Http\Request;

class SubpelController extends Controller
{
    public function add(Request $request){
        if($validator = $this->validing($request->all(), [
            'title' => 'required',
            'subs' => 'required',
            'level' => 'required'
        ]))
            return $validator;

        $pelajaran = Subspelajaran::create($request->all());
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = $pelajaran->id . '_subpel_' . $file->getClientOriginalName();
            $path = $file->move(public_path('file'), $filename);
            $pelajaran->update(['img' => $filename]);
        }
        return $this->resSuccess($pelajaran);
    }

    public function all(){
        return $this->resSuccess(Subspelajaran::with(['kelas'])->get());
    }

    public function update(Request $request){
        if($validator = $this->validing($request->all(), [
            'id' => 'required',
        ]))
            return $validator;
        
        $pelajaran = Subspelajaran::find($request->id);
        if(!$pelajaran) return $this->resFailed(1,'Pelajaran Tidak Ditemukan');

        if ($request->img != null){
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $filename = $pelajaran->id . '_subpel_' . $file->getClientOriginalName();
                if ($pelajaran->img) {
                    $file_loc = public_path('file/') . $pelajaran->img;
                    unlink($file_loc);
                }
                $path = $file->move(public_path('file'), $filename);
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
            Subspelajaran::find($request->id)->delete();
        }catch(Exception $st){
            return $this->resFailed(1,'Data gagal dihapus!');
        }
        return $this->resSuccess('Data berhasil dihapus!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Pelajaran;
use App\Models\PelUmum;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PelajaranController extends Controller
{
    public function add(Request $request){
        if($validator = $this->validing($request->all(), [
            'title' => 'required',
            'subs' => 'required'
        ]))
            return $validator;

        $statement = DB::select("SHOW TABLE STATUS LIKE 'pelajarans'");
        $nextId = $statement[0]->Auto_increment;

        $request['code'] = "PLJ".str_pad($nextId,6-floor(log10($nextId)),"0",STR_PAD_LEFT);
        $pelajaran = Pelajaran::create($request->all());
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = $pelajaran->id . '_pel_' . $file->getClientOriginalName();
            $path = $file->move(public_path('file'), $filename);
            $pelajaran->update(['img' => $filename]);
        }
        return $this->resSuccess($pelajaran);
    }

    public function all(){
        // $array = array_merge(PelUmum::all()->toArray(),Pelajaran::whereNull('umum_id')->get()->toArray());

        return $this->resSuccess([
            'umum'=> PelUmum::all()->toArray(),
            'sekolah'=> Pelajaran::whereNull('umum_id')->get()->toArray(),
        ]);
        return $this->resSuccess(PelUmum::all());
        return $this->resSuccess(Pelajaran::whereNull('umum_id')->get());
        // return $this->resSuccess(Pelajaran::with(['subpel' => function($es){
        //     $es->with(['kelas','harga'])->get();
        // }])->->get());
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
            Pelajaran::find($request->id)->delete();
        }catch(Exception $st){
            return $this->resFailed(1,'Data gagal dihapus!');
        }
        return $this->resSuccess('Data berhasil dihapus!');
    }
}

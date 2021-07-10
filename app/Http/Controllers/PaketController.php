<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\PaketList;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaketController extends Controller
{
    public function add(Request $request){
        if($validator = $this->validing($request->all(), [
            'kls' => 'required',
            'nme' => 'required',
            'dsc' => 'required',
            'jrs' => 'required',
            'prc' => 'required',
            'pplr' => 'required',
            'paket' => 'required'
        ]))
            return $validator;

        $statement = DB::select("SHOW TABLE STATUS LIKE 'pakets'");
        $nextId = $statement[0]->Auto_increment;

        $request['cde'] = 'PKT'.str_pad($nextId,3-floor(log10($nextId)),"0",STR_PAD_LEFT);
        
        $paket = Paket::create($request->all());
        $paket->pelajaran()->attach($request->paket);
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = $paket->id . '_'.$paket->type.'_' . $file->getClientOriginalName();
            $file->move(public_path('file'), $filename);
            $paket->update(['img' => $filename]);
        }
        return $this->resSuccess($paket);
    }

    public function all(){
        return $this->resSuccess(Paket::with(['pelajaran'])->get());
    }

    public function update(Request $request){
        if ($validate = $this->validing($request->all(),[
            'id' => 'required',
        ]))
            return $validate;
        $paket = Paket::find($request->id);
        if ($request->img != null){
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $filename = $paket->id . '_' . $file->getClientOriginalName();
                if ($paket->img) {
                    $file_loc = public_path('file/') . $paket->img;
                    unlink($file_loc);
                }
                $file->move(public_path('file'), $filename);
                $paket->img = $request->img = $filename;
            }
        }
        $paket->update($request->all());
        if($request->paket)
            $paket->pelajaran()->sync($request->paket, true);
        return $this->resSuccess($paket);
    }

    public function delete(Request $request){
        if ($validate = $this->validing($request->all(),[
            'id' => 'required',
        ]))
            return $validate;
        try{
            Paket::find($request->id)->delete();
        }catch(Exception $st){
            return $this->resFailed(1,'Data gagal dihapus!');
        }
        return $this->resSuccess('Data berhasil dihapus!');
    }
}

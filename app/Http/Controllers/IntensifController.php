<?php

namespace App\Http\Controllers;

use App\Models\Intensif;
use App\Models\ManageIntensif;
use Exception;
use Illuminate\Http\Request;

class IntensifController extends Controller
{
    public function new_intensif(Request $request){
        if($validate = $this->validing($request->all(), [
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'kelas' => 'required',
            'jenjang' => 'required'
        ]))
            return $validate;
        
        $manage = Intensif::create($request->all());
        return $this->resSuccess($manage);
    }

    public function all_intensif(){
        return $this->resSuccess(Intensif::all());
    }

    public function delete_intensif(Request $request){
        if ($validate = $this->validing($request->all(),[
            'id' => 'required',
        ]))
            return $validate;
        try{
            Intensif::find($request->id)->delete();
        }catch(Exception $st){
            return $this->resFailed(1,'Data gagal dihapus!');
        }
        return $this->resSuccess('Data berhasil dihapus!');
    }

    public function update_intensif(Request $request){
        if ($validate = $this->validing($request->all(),[
            'id' => 'required',
        ]))
            return $validate;
        try{
            Intensif::find($request->id)->update();
        }catch(Exception $st){
            return $this->resFailed(1,'Data gagal di update!');
        }
        return $this->resSuccess('Data berhasil di update!');
    }

    public function new_manage_intensif(Request $request){
        if($validate = $this->validing($request->all(), [
            'intensif_id' => 'required',
            'manage_kelas_id' => 'required'
        ]))
            return $validate;
        
        $manage = ManageIntensif::create($request->all());
        return $this->resSuccess($manage);
    }

    public function all_manage_intensif(){
        return $this->resSuccess(ManageIntensif::with(['detail','pelajaran'])->get());
    }

    public function update_manage_intensif(Request $request){
        if ($validate = $this->validing($request->all(),[
            'id' => 'required',
        ]))
            return $validate;
        try{
            ManageIntensif::find($request->id)->update();
        }catch(Exception $st){
            return $this->resFailed(1,'Data gagal di update!');
        }
        return $this->resSuccess('Data berhasil di update!');
    }

    public function delete_manage_intensif(Request $request){
        if ($validate = $this->validing($request->all(),[
            'id' => 'required',
        ]))
            return $validate;
        try{
            ManageIntensif::find($request->id)->delete();
        }catch(Exception $st){
            return $this->resFailed(1,'Data gagal dihapus!');
        }
        return $this->resSuccess('Data berhasil dihapus!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ManagePaket;
use App\Models\PaketPelajaran;
use Exception;
use Illuminate\Http\Request;

class PaketPelajaranController extends Controller
{
    public function new_paket(Request $request){
        if($validate = $this->validing($request->all(), [
            'jurusan' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'kelas_id' => 'required',
            'pelajaran' => 'required'
        ]))
            return $validate;
        if (sizeof($request->pelajaran)!=3)
            return $this->resFailed(1, "Pelajaran tidak berjumlah 3!");
        $manage = PaketPelajaran::create($request->all());
        $manage->detail_pelajaran()->createMany($request->pelajaran);
        return $this->resSuccess($manage);
    }

    public function all_paket(){
        $now = gmdate('Y-m-d', time() + 3600*(7+date("I")));
        return $this->resSuccess(PaketPelajaran::with(['detail_pelajaran'=>function($q){
            $q->with(['pelajaran'=>function($q){
                $q->with('pelajaran');
            }]);
        },'kelas', 'voucher'=>function($q)use($now){
            $q->where('mulai','<',$now)->where('selesai','>',$now);
        }])->get());
    }

    public function delete_paket(Request $request){
        if ($validate = $this->validing($request->all(),[
            'id' => 'required',
        ]))
            return $validate;
        try{
            PaketPelajaran::find($request->id)->delete();
        }catch(Exception $st){
            return $this->resFailed(1,'Data gagal dihapus!');
        }
        return $this->resSuccess('Data berhasil dihapus!');
    }

    public function update_paket(Request $request){
        if ($validate = $this->validing($request->all(),[
            'id' => 'required',
        ]))
            return $validate;
        try{
            PaketPelajaran::find($request->id)->update();
        }catch(Exception $st){
            return $this->resFailed(1,'Data gagal di update!');
        }
        return $this->resSuccess('Data berhasil di update!');
    }

    public function new_manage_paket(Request $request){
        if($validate = $this->validing($request->all(), [
            'paket_pelajaran_id' => 'required',
            'manage_kelas_id' => 'required'
        ]))
            return $validate;
        
        $manage = ManagePaket::create($request->all());
        return $this->resSuccess($manage);
    }

    public function all_manage_paket(){
        return $this->resSuccess(ManagePaket::with(['detail','pelajaran'])->get());
    }

    public function update_manage_paket(Request $request){
        if ($validate = $this->validing($request->all(),[
            'id' => 'required',
        ]))
            return $validate;
        try{
            ManagePaket::find($request->id)->update();
        }catch(Exception $st){
            return $this->resFailed(1,'Data gagal di update!');
        }
        return $this->resSuccess('Data berhasil di update!');
    }

    public function delete_manage_paket(Request $request){
        if ($validate = $this->validing($request->all(),[
            'id' => 'required',
        ]))
            return $validate;
        try{
            ManagePaket::find($request->id)->delete();
        }catch(Exception $st){
            return $this->resFailed(1,'Data gagal dihapus!');
        }
        return $this->resSuccess('Data berhasil dihapus!');
    }
}

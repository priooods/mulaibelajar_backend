<?php

namespace App\Http\Controllers;

use App\Models\ManagePesanan;
use App\Models\Pesanan;
use Exception;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function add_pesanan(Request $request){
        if($validator = $this->validing($request->all(), [
            'user_id' => 'required',
            'paket' => 'required',
            'type' => 'required',
            'token' => 'required',
            'harga' => 'required',
        ]))
            return $validator;

        $pesanan = Pesanan::create($request->all());
        return $this->resSuccess($pesanan);
    }

    public function all_pesanan(){
        return $this->resSuccess(Pesanan::with(
            ['detail_pesanan'=> function($dt){
                $dt->with(['detail_pelajaran']);
            },'detail' => function($dt){
                $dt->with(['detailkelas']);
            }])
            ->get());
    }

    public function find_pesanan(Request $request){
       if($validator = $this->validing($request->all(), [
            'id' => 'required',
        ]))
            return $validator;
        
        $detail = Pesanan::find($request->id);
        if(!$detail) return $this->resFailed(1,'Pesanan tidak ditemukan');
        return $this->resSuccess($detail->with(['kelas','pelajaran'])->get());
    }

    public function update_pesanan(Request $request){
        if($validator = $this->validing($request->all(), [
            'id' => 'required',
        ]))
            return $validator;
        
        $pesanan = Pesanan::find($request->id);
        if(!$pesanan) return $this->resFailed(1,'Pesanan tidak ditemukan');
        
        $pesanan->update($request->all());
        return $this->resSuccess($pesanan);
    }

    public function delete_pesanan(Request $request){
        if ($validate = $this->validing($request->all(),[
            'id' => 'required',
        ]))
            return $validate;
        try{
            Pesanan::find($request->id)->delete();
        }catch(Exception $st){
            return $this->resFailed(1,'Pesanan gagal dihapus!');
        }
        return $this->resSuccess('Pesanan berhasil dihapus!');
    }

    public function add_manage_pesanan(Request $request){
        if($validator = $this->validing($request->all(), [
            'pesanan_id' => 'required',
            'manage_kelas_id' => 'required',
        ]))
            return $validator;

        $pesanan = ManagePesanan::create($request->all());
        return $this->resSuccess($pesanan);
    }
}

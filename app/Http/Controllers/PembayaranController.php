<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function add(Request $request){
        if($validator = $this->validing($request->all(), [
            // 'status' => 'required',
            'user_id' => 'required',
            'pesanan_id' => 'required'
        ]))
            return $validator;
        // $now = gmdate('Y-m-d', time() + 3600*(7+date("I")) + 259200);
        // $request['expired'] = $now;
        $pembayaran = Pembayaran::create($request->all());
            // return $pembayaran;
        foreach($request->pesanan_id as $id){
            Pesanan::find($id)->update(["pembayaran_id"=>$pembayaran->id]);
            // return Pesanan::find($id);
        }
        return $this->resSuccess($pembayaran);
    }

    public function update(Request $request){
        if($validator = $this->validing($request->all(), [
            'token' => 'required',
            'user_id' => 'required',
            'id' => 'required'
        ]))
            return $validator;
        
        $bayar = Pembayaran::find('id', $request->id);
        if(!$bayar) return $this->resFailed(1,'Data tidak ditemukan !');
        $bayar->update($request->all());
        return $this->resSuccess($bayar);
    }

    public function all(){
        return $this->resSuccess(Pembayaran::with(['users','pesanan'])->get());
    }

    public function delete(Request $request){
        if($validator = $this->validing($request->all(), [
            'token' => 'required',
            'id' => 'required'
        ]))
            return $validator;
        
        $bayar = Pembayaran::find('id', $request->id);
        if(!$bayar) return $this->resFailed(1,'Data tidak ditemukan !');

        $bayar->delete();
        return $this->resSuccess('Data berhasil di hapus');
    }

    public function detail(Request $request){
        if($validator = $this->validing($request->all(), [
            'token' => 'required',
            'id' => 'required'
        ]))
            return $validator;
        
        $bayar = Pembayaran::find('id', $request->id);
        if(!$bayar) return $this->resFailed(1,'Data tidak ditemukan !');

        return $this->resSuccess($bayar->with(['users'])->get());
    }

}

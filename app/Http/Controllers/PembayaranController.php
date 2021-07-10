<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function add(Request $request){
        if($validator = $this->validing($request->all(), [
            'sts' => 'required',
            'user_id' => 'required',
            'cde' => 'required',
            'wktln' => 'required',
            'bktf' => 'required',
            'prc' => 'required'
        ]))
            return $validator;
        $pembayaran = Pembayaran::create($request->all());
        $file = $request->file('bktf');
        $filename = $pembayaran->id . '_' . $file->getClientOriginalName();
        $file->move(public_path('file'), $filename);
        $pembayaran->update(['bktf' => $filename]);
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

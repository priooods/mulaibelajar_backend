<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Exception;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function add(Request $request){
        if($validator = $this->validing($request->all(), [
            'nama' => 'required',
            'kode' => 'required',
            'potongan' => 'required',
            'mulai' => 'required|date',
            'selesai' => 'required|date',
            'paket' => 'required',
        ]))
            return $validator;

        $voucher = Voucher::create($request->all());
        return $this->resSuccess($voucher);
    }

    public function all(){
        return $this->resSuccess(Voucher::all());
    }

    public function update(Request $request){
        if($validator = $this->validing($request->all(), [
            'id' => 'required',
        ]))
            return $validator;
        
        $voucher = Voucher::find($request->id);
        if(!$voucher) return $this->resFailed(1,'Voucher tidak ditemukan');
        
        $voucher->update($request->all());
        return $this->resSuccess($voucher);
    }

    public function delete(Request $request){
        if ($validate = $this->validing($request->all(),[
            'id' => 'required',
        ]))
            return $validate;
        try{
            Voucher::find($request->id)->delete();
        }catch(Exception $st){
            return $this->resFailed(1,'Data gagal dihapus!');
        }
        return $this->resSuccess('Data berhasil dihapus!');
    }
}

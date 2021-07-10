<?php

namespace App\Http\Controllers;

use App\Models\Afiliate;
use Illuminate\Http\Request;

class AfiliateController extends Controller
{
    
    public function add(Request $request)
    {
        if ($validate = $this->validing($request->all(),[
            'users_id' => 'required',
            'cde' => 'required',
        ]))
            return $validate;
        
        $afiliate = Afiliate::create($request->all());
        return $this->resSuccess($afiliate);
    }

    public function find(Request $request)
    {
        $afiliate = Afiliate::where('users_id',$request->users_id)->first();
        return $this->resSuccess($afiliate);
    }

    public function destroy(Request $request)
    {
        if ($validate = $this->validing($request->all(),[
            'id' => 'required'
        ]))
            return $validate;
        $checkout = Afiliate::find($request->id);
        $checkout->delete();
        return $this->resSuccess('Berhasil di hapus');
    }
}

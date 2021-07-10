<?php

namespace App\Http\Controllers;

use App\Models\Silabus;
use Illuminate\Http\Request;

class SilabusController extends Controller
{
    public function add(Request $request){
        if ($validate = $this->validing($request->all(),[
            'ptmn' => 'required',
            'pelajaran_id' => 'required',
            'point' => 'required',
        ]))
            return $validate;

        $silabus = Silabus::create($request->all());
        $silabus->point()->createMany($request->point);
        return $this->resSuccess($silabus);
    }

    public function all(Request $request){
        $silabus = Silabus::where('pelajaran_id',$request->pelajaran_id)->with('point')->get();
        return $this->resSuccess($silabus);
    }

}

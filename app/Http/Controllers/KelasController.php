<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\KelasContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    public function addclass(Request $request){
        $validate = Validator::make($request->all(),[
            'nama_kelas' => 'required',
            'harga_awal' => 'required|int',
            'harga_akhir' => 'required|int',
            'discount' => 'required|int',
            'desc_kelas' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
        ]);

        if($validate->fails()){
            return response()->json($validate->errors(), 200);
        }

        $kelas = Kelas::create($request->toArray());
        return $this->resSuccess($kelas);
    }

    public function showkelas(){
        return $this->resSuccess(Kelas::with('content')->get());
    }

    public function addContent(Request $request){
        $validate = Validator::make($request->all(),[
            'context_text' => 'required',
            'kelas_id' => 'required|int',
            'pertemuan' => 'required|int',
        ]);

        if($validate->fails()){
            return response()->json($validate->errors()->all(), 200);
        }

        if ($request->content_file!=null){
            if ($request->hasFile('content_file')) {
                $file = $request->file('content_file');
                $filename = 'content_'.$request->kelas_id.'_'.$file->getClientOriginalName();
                $path = $file->move(public_path('content'), $filename);
                $request['content_file'] = $filename;
            }else
                return $this->resFailed("3","content file extention not supported!");
        }

        $content = KelasContent::create($request->all());
        return $this->resSuccess(compact('content'),201);
    }
}

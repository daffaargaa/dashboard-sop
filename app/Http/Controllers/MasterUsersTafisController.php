<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterUsersTafisController extends Controller
{
    public function index() {
        $data['dept'] = DB::table('depts')->get();
        $data['tafis_ms_users_hdr'] = DB::table('tafis_ms_users_hdr as a')
                                    ->join('depts as b', 'a.kode_dept', '=', 'b.id')
                                    ->select('a.id', 'b.departemen', 'a.sub_dept', 'a.status')
                                    ->get();

        return view('masterUsersTafis.index', $data);
    }
    
    public function masterUsersTafisStore(Request $request) {
        
        if(!$request->active) {
            $request->active = 'DISABLED';
        }

        $insertHdr = DB::table('tafis_ms_users_hdr')->insert([
            'kode_dept' => $request->kode_dept,
            'sub_dept' => $request->sub_dept,
            'status' => $request->active,
            'created_at' => Carbon::now(),
        ]);

        if($insertHdr) {
            return back()->with('input_success', 'Input berhasil!!');
        }
        else {
            return back()->with('input_failed', 'Input gagal!');
        }
    }  
}

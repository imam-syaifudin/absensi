<?php

namespace App\Http\Controllers;

use App\Laporan;
use Illuminate\Http\Request;

use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;


class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function usercheck(){
       
        $tanggalsaiki = date('Y-m-d');
        $userId = User::find(auth()->user()->id);
        $userLaporan = $userId->laporan;
        
        foreach( $userLaporan as $ok){
            return view('home',["keterangan" => $ok->keterangan]);
        }
       

        // $oi = Laporan::where('tanggalHadir','like',"%".$tanggalsaiki."%")->get();
    }

    
}

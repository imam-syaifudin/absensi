<?php


namespace App\Http\Controllers;

date_default_timezone_set('Asia/Jakarta');

use Illuminate\Http\Request;
use App\Models\Pengaturan;
use Illuminate\Support\Facades\DB;

class PengaturanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Pengaturan::all();


        return view('setting',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        return view('pengaturan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $pengaturan = new Pengaturan;

        $pengaturan->sesi = $request->sesi;
        $pengaturan->jam_mulai = $request->jammulai;
        $pengaturan->jam_selesai = $request->jamselesai;
        $pengaturan->durasi_waktu = $request->durasi_waktu;
        $pengaturan->save();

        return redirect('setting');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $md = Pengaturan::findOrFail($id);
        return view('pengaturan.edits',compact('md'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $pengaturan = Pengaturan::find($id);
        $pengaturan->sesi = $request->sesi;
        $pengaturan->jam_mulai = $request->jammulai;
        $pengaturan->jam_selesai = $request->jamselesai;
        $pengaturan->durasi_waktu = $request->durasi_waktu;
        $pengaturan->save();
        return redirect('setting');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = Pengaturan::findOrFail($id);
        $data->delete();
        return redirect('setting');


    }
}

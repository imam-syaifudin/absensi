<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Laporan;
use Illuminate\Support\Facades\DB;
use App\Exports\LaporanExport;
use App\Imports\UserImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

date_default_timezone_set('Asia/Jakarta');


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user =  User::paginate(10)->withQueryString();
        return view('home',compact('user'));
    }

    public function absen($id){
        $realid = auth()->user()->id;
        if ( $realid != $id ){
            return redirect('home');
        }

        $data = User::find($id);
        $laporan = $data->laporan;
        $jam_mulai = $data->pengaturan->jam_mulai;
        $jam_selesai = $data->pengaturan->jam_selesai;
        $tanggalsaiki = date('Y-m-d');
        $jamSekarang = date('H:i');
        $waktuSesiBerakhir = explode(":",$jam_mulai)[0] + 2;
        // $arr = array(
        //     "value" => "tidak hadir"
        // );

        
        
        // cek apakah sekarang waktunya absen ( sesi )
        if ( explode(":",$jamSekarang)[0] < explode(":",$jam_mulai)[0] OR explode(":",$jamSekarang)[0] > $waktuSesiBerakhir){
            return "
            <script>
                alert('bukan sesi anda sekarang')
            </script>
            " . redirect('home');
        }

        if ( count($laporan) == 0){
            if ( explode(":",$jam_selesai)[0] == explode(":",$jamSekarang)[0] ){
                if ( explode(":",$jam_selesai)[1] >= explode(":",$jamSekarang)[1]){
                    $arr = array(
                        "value" => "hadir",
                        "data" => User::find($id)
                    );
                } else {
                    $arr = array(
                        "value" => "hadir ( telat )",
                        "data" => User::find($id)
                    );
                }
            } else {
                $arr = array(
                    "value" => "hadir ( telat )",
                    "data" => User::find($id)
                );
            }
        }

        // cek apakah sudah absen hari ini
        foreach( $laporan as $lapor){
            $pecah = explode(" ",$lapor->tanggalHadir);
            if ( in_array($tanggalsaiki,$pecah)){
                $arr = array(
                    "value" => "anda sudah absen",
                    "status" => "disabled",
                    "data" => User::find($id)
                );
            } else {
                // cek keterlambatan
                if ( explode(":",$jam_selesai)[0] == explode(":",$jamSekarang)[0] ){
                    if ( explode(":",$jam_selesai)[1] >= explode(":",$jamSekarang)[1]){
                        $arr = array(
                            "value" => "hadir",
                            "data" => User::find($id)
                        );
                    } else {
                        $arr = array(
                            "value" => "hadir ( telat )",
                            "data" => User::find($id)
                        );
                    }
                } else {
                    $arr = array(
                        "value" => "hadir ( telat )",
                        "data" => User::find($id)
                    );
                }
            }
        }
 
        return view('users.absen',compact('arr'));
    }

    public function userimport(Request $request){
        $file = $request->file('file');
        $namaFile = $file->getClientOriginalName();
        $file->move('DataUser',$namaFile);

        Excel::import(new UserImport,public_path('/DataUser/'.$namaFile));
        return redirect('home');
    }

   
    public function tambahlaporan(Request $request){
        if ( $request->realid != $request->id){
            return "
            <script>
                alert('Id tidak valid!!!!')
            </script>
            " . redirect('home');
        };
        $tanggalsaiki = date('Y-m-d');
        $jamSekarang = date('H:i:s');
        
        $laporan = new Laporan;
        $laporan->user_id = $request->id;
        $laporan->name = $request->name;
        $laporan->level = "user";
        $laporan->keterangan = $request->keterangan;
        $laporan->jam_hadir = $jamSekarang;
        $laporan->tanggalHadir = $tanggalsaiki;
        $laporan->absen_pulang = "belum pulang"; 
        $laporan->save();

        return redirect('home');
    }

    public function absenpulang($id){
        
        $data = User::find($id);
        $laporan = $data->laporan;
        $jam_mulai = $data->pengaturan->jam_mulai;
        $jam_selesai = $data->pengaturan->jam_selesai;
        $tanggalsaiki = date('Y-m-d');
        $jamSekarang = date('H:i');
        $waktuSesiBerakhir = explode(":",$jam_mulai)[0] + $data->pengaturan->durasi_waktu;

        $dataPulang = Laporan::where('tanggalHadir',$tanggalsaiki)->where('user_id',$id)->get();

        // cek apakah sudah absen
        if ( count($dataPulang) == 0){
            return "
            <script>
                alert('anda belum absen')
            </script>
            " . redirect('home');
        }

        // cek apakah waktunya pulang
        if ( explode(":",$jamSekarang)[0] < $waktuSesiBerakhir){
            return "
            <script>
                alert('belum waktunya pulang')
            </script>
            " . redirect('home');
        }

        // check apakah sudah absen pulang
        if ( count($laporan) == 0){
            $arr = array(
                "value" => "sudah pulang",
                "data" => User::find($id)
            );
        } 

        foreach ( $dataPulang as $dpulang){
            if ( $dpulang->absen_pulang == "belum pulang"){
                $arr = array(
                    "value" => "sudah pulang",
                    "data" => User::find($id)
                );
            } else {
                $arr = array(
                    "value" => "anda sudah absen pulang",
                    "data" => User::find($id)
                );
            }
        }


        return view('users.pulang',compact('arr'));
    }

    public function updatelaporan(Request $request,$id){
        if ( $request->realid != $request->id){
            return "
            <script>
                alert('id tidak valid!!');
            </script>.
            " . redirect('home');
        }
        $tanggalsaiki = date('Y-m-d');
        $dataLaporan = Laporan::where('user_id',$id)->where('tanggalHadir',$tanggalsaiki)->first();

            $dataLaporan->user_id = $dataLaporan->user_id;
            $dataLaporan->name = $dataLaporan->name;
            $dataLaporan->level = $dataLaporan->level;
            $dataLaporan->keterangan = $dataLaporan->keterangan;
            $dataLaporan->jam_hadir = $dataLaporan->jam_hadir;
            $dataLaporan->tanggalHadir = $dataLaporan->tanggalHadir;
            $dataLaporan->absen_pulang = $request->absenpulang;
            $dataLaporan->save();
        
            return redirect('home');
    }

    public function usercheck(){
       
        $tanggalsaiki = date('Y-m-d');
        $userId = User::find(auth()->user()->id);
        $userLaporan = $userId->laporan;
        
        foreach( $userLaporan as $ok){
            return view('user',["keterangan" => $ok->keterangan]);
        }
       

        // $oi = Laporan::where('tanggalHadir','like',"%".$tanggalsaiki."%")->get();
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        date_default_timezone_set('Asia/Jakarta');

        $user = new User;
        $user->pengaturan_id = $request->pengaturanid;
        $user->name = $request->name;
        $user->nip = $request->nip;
        $user->level = $request->level;
        $user->password = $request->password;
        $user->remember_token = $request->remember_token;
        $user->save();

        $laporan = new Laporan;
        $laporan->user_id = $id;
        $laporan->name = $request->name;
        $laporan->level = "user";
        $laporan->keterangan = $request->keterangan;
        $laporan->jam_hadir = $request->jamhadir;
        $laporan->tanggalHadir = $request->tanggalhadir;
        $laporan->absen_pulang = $request->absenpulang;
        $laporan->save();

        return redirect('home');        
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
        $md = User::find($id);
        
        return view('users.edit',compact('md'));
        
    }


    public function laporan(Request $request){
        $cari = $request->tanggal;

        $md = Laporan::paginate(10)->withQueryString();
        return view('laporan',compact('md','cari'));
          
    }

    public function laporanexport(){
        return Excel::download(new LaporanExport,'laporan.xlsx');
    }

    public function cariLaporan(Request $request){
       	// menangkap data pencarian
            	// menangkap data pencarian
                $cari = $request->tanggal;
                $angka = 1;
                
                // mengambil data dari table laporan sesuai pencarian data
                $md = Laporan::where('tanggalHadir','like',"%".$cari."%")->paginate(30);
            
                // mengirim data laporan ke view 
                return view('laporan',compact('md','cari'));  
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
        $tanggalsaiki = date('Y-m-d');

        $user = User::find($id);
        $user->pengaturan_id = $request->pengaturanid;
        $user->name = $request->name;
        $user->nip = $request->nip;
        $user->level = "user";
        $user->password = bcrypt("12345");
        $user->remember_token = "random";
        $user->save();

        return redirect('home');

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
        $dataLaporan = Laporan::where('user_id',$id);
        

        $data = User::findOrFail($id);
        $data->delete();
        $dataLaporan->delete();
        return redirect('home');
    }
}

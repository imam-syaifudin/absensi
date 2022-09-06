<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Laporan;

date_default_timezone_set('Asia/Jakarta');

class LoginController extends Controller
{

    public function index(){
        $user = Users::all();
        return view('users',compact('user'));
    }

    public function halamanlogin(){
        return view('Login.Login-aplikasi');
    }

    public function adminlogin(){
        return view('Login.admin-login');
    }

    public function postlogin(Request $request){
        if ( Auth::attempt($request->only('nip','password'))){
            return redirect('home');
        } 
        return redirect('/home');
    }

    public function postadmin(Request $request){
        if ( Auth::attempt($request->only('name','password'))){
            return redirect('home');
        } 
        return redirect('/home');
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

    public function register(){
        return view('Login.register');
    }

    public function simpanregister(Request $request){

       $data = User::all();
       $name = $request->name;
       
       $oi = User::where('name',$request->name)->get('name');
           if ( count($oi) == 0 ){
                User::create([
                'pengaturan_id' => $request->pengaturanid,
                'name' => $request->name,
                'nip' => $request->nip,
                'level' => 'user',
                'password' => bcrypt('12345'),
                'remember_token' => Str::random(60),

                 ]);
                return redirect('register');
            } else if (count($oi) == 1){
               return "
               <script>
                alert('User $name Telah Dipakai');
               </script>
               " . redirect('register');
            } else {
               echo "error";
            }


        }

}

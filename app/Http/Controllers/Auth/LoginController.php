<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Socialite;
use App\User;
use App\Profile;
use App\Kaderisasi;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected function redirectTo(){
        return '/home';
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function google_callback()
    {
        try {

            $user = Socialite::driver('google')->stateless()->user();

            $isUser = User::where('email', $user->email)->first();

            if($isUser){

                Auth::login($isUser);
                return redirect('/home');

            } else { 

                $createUser = new User;
                $createUser->name =  $user->getName();

                if($user->getEmail() != null){
                    $createUser->email = $user->getEmail();
                    $createUser->email_verified_at = \Carbon\Carbon::now();
                }  

                $rand = rand(111111,999999);
                $createUser->password = Hash::make($user->getName().$rand);

                $createUser->level = 1;

                $createUser->save();

                $id = $createUser->id; // Get current user id

                Kaderisasi::create([
                    'id_user' => $id,
                    'komisariat' => '-',
                    'rayon' => '-',
                    'tahun_bergabung' => '-',
                    'angkatan_ke' => '-',
                    'kaderisasi_terakhir' => '-',
                ]);

                Profile::create([
                    'id_user' => $id,
                    'nama_lengkap' => '-',
                    'tanggal_lahir' => '-',
                    'jenis_kelamin' => '-',
                    'provinsi' => '-',
                    'kota_kabupaten' => '-',
                    'kecamatan' => '-',
                    'alamat_lengkap' => '-',
                    'status_pernikahan' => '-',
                    'pendidikan_terakhir' => '-',
                    'pekerjaan' => '-',
                    'no_hp' => '-',
                    'foto_terbaru' => '-',
                ]);               

                Auth::login($createUser);
                return redirect('/home');
            }

        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
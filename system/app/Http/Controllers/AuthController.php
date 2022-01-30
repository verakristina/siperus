<?php namespace App\Http\Controllers; 

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Input;
use Redirect;
use App;
use Socialite;
use Session;

/**
* 
*/
class AuthController extends Controller
{
	/* Fatchur */
	public function viewLogin()
	{
		return view('main.login');
	}
	public function prosesLogin()
	{
		$user = Input::get('user');
		$pass = Input::get('pass');

		$cekUsername = DB::table('m_users')
			->where('username',$user)
			->get();
		$cekLogin = DB::table('m_users')
			->where('username',$user)
			->where('password',$pass)
			->get();
		if(count($cekUsername) != 0){
			if(count($cekLogin) != 0){
				foreach ($cekLogin as $key) {
					if($key->role == 1 || $key->role == 2 || $key->role == 3)
					{
						session()->put('cl_admin',$key->id);
						session()->put('idLogin',$key->id);
						session()->put('idRole',$key->role);
						session()->put('idProvinsi2',$key->geo_prov_id2);
						session()->put('idProvinsi',$key->geo_prov_id);
						$prosesLog = DB::table('ref_log')
							->insert([
								'bio_id' => $key->id,
								'log_time' => date('Y-m-d H:i:s')
							]);
						echo 'Success';
					} else {
						echo 'Akses Tidak Ada';
					}
				}
			} else {
				echo 'Password salah. Coba lagi';
			}
		} else {
			echo 'Akun tidak dikenali';
		}
	}
	
	public function logout()
	{
		session()->forget('cl_admin');
		session()->forget('idLogin');
		return redirect('/login');
	}
	
	public function viewRegister(){
		return view('register.index');
	}
	
	public function viewRegisterForm(){
		$dataProvinsi = DB::table('m_geo_prov')
			->get();
		$dataIdentitas = DB::table('ref_identitas')
			->get();
		$dataPekerjaan = DB::table('ref_pekerjaan')
			->get();
		$dataAgama = DB::table('ref_agama')
			->get();
		$dataJk = DB::table('ref_jk')
			->get();
		$dataStatus = DB::table('ref_status')
			->get();
		$dataBio = DB::table('m_bio')
			->get();
		return view('register.form.index',array(
			'dataBio' => $dataBio,
			'dataProvinsi' => $dataProvinsi,
			'dataIdentitas' => $dataIdentitas,
			'dataPekerjaan' => $dataPekerjaan,
			'dataAgama' => $dataAgama,
			'dataJk' => $dataJk,
			'dataStatus' => $dataStatus
		));		
	}
	
	// Redirect our user to the facebook
	public function prosesSosialLogin($sosial) 
	{
		if($sosial != 'guest'){			
			return Socialite::driver($sosial)->redirect();
		} else {
			session()->put('sosial', $sosial);
			return redirect('register/form');
		}
	}

	// Handle callback from facebook
	public function prosesSosialCallback($sosial)
	{
		try {
			$socialUser = Socialite::driver('facebook')->user();
		}catch(\Exception $e) {
			return redirect('/');
		}
		
		/* $user = User::where('facebook_id', $socialUser->getId())->first();
			
		session()->put('id', $socialUser->getId());
		session()->put('sosial', $sosial);
		session()->put('name', $provider->getName());
		session()->put('email', $provider->getEmail());
		
		return redirect('register/form'); */
	}
	/* Fatchur */
	
}
<?php namespace App\Http\Controllers;

use DB;
use Input;
use Redirect;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

	public function getData($session = 'belum')
	{
		$d_admin = DB::table('m_users')
			->where('id',session($session))
			->get();

		return $d_admin;
	}
	public function getMenu($session = '')
	{
		$d_menu  = DB::table('m_role_menus')
			->join('m_users', 'm_users.role','=','m_role_menus.role_id')
			->join('m_menus', 'm_menus.id','=','m_role_menus.menu_id')
			->where('m_users.id', session($session))
			->where('m_menus.pos_menu',0)
			->orderBy('m_menus.menu_order')
			->get();

		return $d_menu;
	}
	public function getParentMenu($parent = 0, $session = '')
	{
		$dParentMenu = DB::table('m_role_menus')
			->join('m_users','m_users.role','=','m_role_menus.role_id')
			->join('m_menus','m_menus.id','=','m_role_menus.menu_id')
			->where('m_users.id',session($session))
			->where('m_menus.pos_menu',$parent)
			->get();
		return $dParentMenu;
	}
	public static function getLatLng($latlng){

		$API = array(
			'AIzaSyAOiVUskIMhtW0F-iuUdIZB5BlCcCv15L0',
			'AIzaSyARRoRCq1MhYM75binMUr1yrHL6dCMP1M4',
			'AIzaSyBxxg7GU970GNltY8nKbDBfHBwupPCxilw',
			'AIzaSyBOl44-_pE5C_iJqkG92-ZgvLG1qR-2s_8',
			'AIzaSyBoI_HtUeYAAD54BztKOcNCzBxMrjVuesI',
			'AIzaSyBVnrDPRsyvdQ5EDLGgxAHsoOKYKPWzxwQ',
			'AIzaSyACTKWr3kPIOnE0NvroZt4apoI-UC_jxYw',
			'AIzaSyD9tMCzv7Dwan8ALr_3fXLkEds1QR8zaOc',
			'AIzaSyDeaJmIyw2gnwRXTiFdVRIDXrpSp7x7WBY',
			'AIzaSyDtx1Uyl4wIx7NHywHiAcaD0_R853PAnPQ',
			'AIzaSyCHqPlwwWPm9u0imL0mx_np6ynPGKarNsE',
			'AIzaSyDjqTndhIJrDg_1jgkSiQsiEmy41cmiceQ',
			'AIzaSyBpoSqpnaO1_oyLVG-tNnom7PECYSRDXD4',
			'AIzaSyDN8hm14-acSTYEtX2qGAGgzGiA838ts9o',
			'AIzaSyCBd_YW5npyGGR_vnkmLuKqHih3dOk3wAw',
			'AIzaSyBO880JJbz6Kqag9DVVa0rHacGAYYHVuhQ',
			'AIzaSyB3xFGOmJvIkdlkd4-1Yb1mjfX3Wlhxgdc',
			'AIzaSyCpnG5fCkbeFw2GuvMxZY6S7lPthfgb0UQ',
			'AIzaSyB2lAxhdBncPhaFROgXr2C13YewfDHesnQ',
			'AIzaSyDH9ofN8YNJXlM8vUAAE7wwq3pW_L7QlQQ',
			'AIzaSyDABTScFEh6XWv43KRiFL_G-tGWLLYKwE0',
			'AIzaSyAmoG4IBp0vp6NkilEbh93xHj2YTYgFz60'
		);

		do {
			$latlng = urlencode($latlng);
		    // google map geocode api url
			
			$url = "https://maps.googleapis.com/maps/api/geocode/json?key=".$API[rand(0,count($API)-1)]."&address=".$latlng."&sensor=true";
		    // get the json response
			
		    $resp_json = file_get_contents($url);
		     
		    // decode the json
		    $resp = json_decode($resp_json, true);
		 
		    // response status will be 'OK', if able to geocode given address 
		    if($resp['status']=='OK'){
		 
		        // get the important data
		        $geo['lat'] = $resp['results'][0]['geometry']['location']['lat'];
		        $geo['lng'] = $resp['results'][0]['geometry']['location']['lng'];
		        $geo['api'] = $API[rand(0,count($API)-1)];
		         
		        // verify if data is complete
		  
		        return $geo;
		    }else{
		        return false;
		    }
		} while ($resp['status'] != 'OK');
	}

}

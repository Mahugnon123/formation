<?php

/**
 *
 */
namespace App;
use App\Models\User;

class Helpers{
	
	public static function generateSlug($lenght = 23) {
		    if (function_exists("random_bytes")) {
		        $bytes = random_bytes(ceil($lenght / 2));
		    }
		    elseif (function_exists("openssl_random_pseudo_bytes")) {
		        $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
		    }
		    else {
		    	$bytes = uniqid() ;
		        // throw new Exception("no cryptographically secure random function available");
		    }
		    return substr(bin2hex($bytes), 0, $lenght);
		}
	


	
	    function convertirDate($date)
	    {
	        return \Carbon\Carbon::parse($date)->format('d/m/Y H:i:s');
	    }
	

	
	    function convertirDateOnly($date)
	    {
	        return \Carbon\Carbon::parse($date)->format('d/m/Y');
	    }
		
		public static function seachUserById() {
			$user_id=[];
			$users = User::all();
			foreach($users as $user){
				$user_id[$user->id] = $user;
			}
			return $user_id;
	}
	
  }
?>

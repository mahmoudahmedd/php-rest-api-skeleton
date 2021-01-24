<?php


namespace Core;


include("app\utilities\libs\jwt\BeforeValidException.php");
include("app\utilities\libs\jwt\ExpiredException.php");
include("app\utilities\libs\jwt\SignatureInvalidException.php");
include("app\utilities\libs\jwt\JWT.php");

use \Firebase\JWT\JWT;




class Authorizer
{
	/**
     * Handle the incoming request.
     *
     * @param  Request  $request
     * @param  string  $roles
     * @return bool
     */
    public static function isAuthorized($_request, $_roles)
    {
    	
		
    	
		$key = "aaaaaaaf";
		
		$payload = array(
		    "sub" => "1234567890",
		    "role" => "admin",
		    "iat" => 1516239022
		);

		// Authorization:Bearer eyJraWQiOiJDT2N...
		/*
				function getToken($user, $expTime){
		    $key = "secretkey";
		    $token = array(
		      'iss' => request()->getBaseUrl(),
		      'sub' => "{$user['id']}",
		      'exp' => $expTime,
		      'iat' => time(),
		      'nbf' => time(),
		      'is_admin' => $user['role_id'] == 1
		  );
		  return JWT::encode($token, $key);
		}
		*/
		$jwt = JWT::encode($payload, $key);
		//$jwt = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwidHlwZSI6ImFkbWluIiwiaWF0IjoxNTE2MjM5MDIyfQ.jQU_lt-UGklp0P2DCrk3pt";
		//echo $jwt."</br>";
		try 
		{
			$decoded = JWT::decode($jwt, $key, array('HS256'));

			//echo $decoded->role;
			if (in_array($decoded->role, $_roles))
			{
			    return true;
			}
			else
			{
				return false;
			}
		}
		catch (\Exception $e)
		{
			return false;
		}
		
	
    	if(!isset($_SERVER['Authorization']))
    		return false;

    
        // if(!$request->user()->hasRole($role))
        // {
        //     // Redirect...
        // }

        // return $next($request);
    }

}
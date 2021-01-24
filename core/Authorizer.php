<?php

namespace Core;

use \Firebase\JWT\JWT;

class Authorizer
{
	/**
     * Authorize for the incoming request.
     *
     * @param  Request  $_request
     * @param  string  $_roles
     * @return bool
     */
    public static function isAuthorized($_request, $_roles)
    {
    	$headers = apache_request_headers();
    	
    	if(!isset($headers['Authorization']))
    		return false;

    	$arr = explode(" ", $headers['Authorization']);
    	if(!isset($arr[1]))
    		return false;

    	$jwt = $arr[1];
    	
		try
		{
			$decoded = JWT::decode($jwt, $GLOBALS["app"]["key"], array($GLOBALS["app"]["cipher"]));
            print_r($decoded);
			if(in_array($decoded->role, $_roles))
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
    }

}
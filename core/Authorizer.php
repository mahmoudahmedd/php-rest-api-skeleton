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
		try
		{
            $jwt = Authorizer::getJWT();
           
            if(!isset($jwt))
                return false;

			$payload = Authorizer::getPayload($jwt);
            
			if(in_array($payload->role, $_roles))
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

    /**
     * retrun PAYLOAD
     * @param  string  $_jwt
     * @return string
     */
    public static function getPayload($_jwt)
    {
        $payload = JWT::decode($_jwt, $GLOBALS["app"]["JWT_secret_key"], array($GLOBALS["app"]["JWT_cipher"]));
        return $payload;
    }

    /**
     * retrun JWT
     *
     * @return bool | NULL
     */
    public static function getJWT()
    {
        $headers = apache_request_headers();
        
        if(!isset($headers['Authorization']))
            return NULL;

        $arr = explode(" ", $headers['Authorization']);

        if(!isset($arr[0]) || $arr[0] != "Bearer")
            return NULL;

        if(!isset($arr[1]))
            return NULL;

        // JWT
        return $arr[1];
    }

}
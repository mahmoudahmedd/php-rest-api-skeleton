<?php
/*
include("JWT.php");
use \Firebase\JWT\JWT;

$key = "af";
// The "iat" (issued at) claim identifies the time at which the JWT was issued. This claim can be used to determine the age of the JWT. Its value MUST be a number containing a NumericDate value. Use of this claim is OPTIONAL.
$payload = array(
    "sub" => "1234567890",
    "name" => "John Doe",
    "iat" => 1516239022
);

/**
 * IMPORTANT:
 * You must specify supported algorithms for your application. See
 * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
 * for a list of spec-compliant algorithms.
 */
/**
$jwt = JWT::encode($payload, $key);
echo $jwt;
$decoded = JWT::decode($jwt, $key, array('HS256'));

print_r($decoded);

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
		
		$jwt = JWT::encode($payload, $key);
		//$jwt = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwidHlwZSI6ImFkbWluIiwiaWF0IjoxNTE2MjM5MDIyfQ.jQU_lt-UGklp0P2DCrk3pt";
		//echo $jwt."</br>";
*/

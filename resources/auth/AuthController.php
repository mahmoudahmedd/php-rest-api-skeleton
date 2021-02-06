<?php

namespace Resources\Auth;
use \Firebase\JWT\JWT;

class AuthController extends \Core\Controller
{
    public function authMe()
    {
        $input = $this->request->getInput();
        
        $validator = new \Core\Validation\Validator();
        $rules = [
            'email' => 'required',
            'password' => 'required'
        ];

        if(!$validator->isValid($input, $rules))
        {
            $this->response->renderFail($this->response::HTTP_BAD_REQUEST, $validator->getError());
        }

        $model = new AuthModel();
        $user = $model->findByEmail($input["email"]);

        if($user && password_verify($input["password"], $user["password"]))
        {
            $issuedAtTime = time();

            $payload = array(
                "email" => $user["email"],
                "role" => $user["role"],
                "iat" => $issuedAtTime,
                "exp" => $issuedAtTime + $GLOBALS["app"]["JWT_time_to_live"],
            );

            $jwt = JWT::encode($payload, $GLOBALS["app"]["JWT_secret_key"]);
            
            $data = array("email" => $user["email"], "role" => $user["role"], "jwt" => $jwt);

            $this->response->renderOk($this->response::HTTP_OK, $data);
        }
        else
        {
            $this->response->renderFail($this->response::HTTP_BAD_REQUEST, "Invalid login credentials provided.");
        }
    }

    public function register()
    {
        $input = $this->request->getInput();
        
        $validator = new \Core\Validation\Validator();
        $rules = [
            "email" => "required",
            "password" => "required",
            "role" => "required"
        ];

        if(!$validator->isValid($input, $rules))
        {
            $this->response->renderFail($this->response::HTTP_BAD_REQUEST, $validator->getError());
        }

        $hashedPassword = password_hash($input["password"], PASSWORD_DEFAULT);

        $model = new AuthModel();
        $user = $model->insert($input["email"], $hashedPassword, $input["role"]);

        if($user)
        {
            $issuedAtTime = time();

            $payload = array(
                "email" => $input["email"],
                "role" => $input["role"],
                "iat" => $issuedAtTime,
                "exp" => $issuedAtTime + $GLOBALS["app"]["JWT_time_to_live"],
            );

            $jwt = JWT::encode($payload, $GLOBALS["app"]["JWT_secret_key"]);
            
            $data = array("email" => $input["email"], "role" => $input["role"], "jwt" => $jwt);

            $this->response->renderOk($this->response::HTTP_CREATED, $data);
        }
        else
        {
            $this->response->renderFail($this->response::HTTP_BAD_REQUEST, "Invalid data provided.");
        }
    }


}
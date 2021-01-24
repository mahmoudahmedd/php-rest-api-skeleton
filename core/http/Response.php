<?php

namespace Core\HTTP;

class Response
{
    public function statusCode(int $_code)
    {
        http_response_code($_code);
    }

    public function render($_data, int $_code)
    {
    	header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: *");

    	$this->statusCode($_code);
    	echo json_encode($_data, JSON_PRETTY_PRINT);
    }
}
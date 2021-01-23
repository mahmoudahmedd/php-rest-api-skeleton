<?php

namespace Core\HTTP;

class Response
{
    public function statusCode(int $code)
    {
        http_response_code($code);
    }
}
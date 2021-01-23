<?php

return
[
    // Default Mailer
    "default" => "smtp",

    // Mailer Configurations
    "mailers" =>
    [
        "smtp" =>
        [
            "transport" => "smtp",
            "host" => "smtp.example.com",
            "port" => "587",
            "encryption" => "tls",
            "username" => "",
            "password" => "",
        ],
    ],

    /**
     *  From Address
     *  A name and address that is used globally for all e-mails that are sent by your application.
     */
    "from" =>
    [
        "address" => "hello@example.com",
        "name" => "",
    ],
];
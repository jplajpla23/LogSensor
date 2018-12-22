<?php
return array(
    "driver" => "smtp",
    "host" => "smtp.sapo.pt",
    "port" => 587,
    "from" => array(
        "address" => "logsensor@sapo.pt",
        "name" => "Log Sensor"
    ),
    "encryption" => "tls",
    "username" => "logsensor@sapo.pt",
    "password" => "password1A.",
    "sendmail" => "/usr/sbin/sendmail -bs",
    "pretend" => false
);
?>
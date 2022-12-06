<?php

// Copy this to test.php (which is not under version control)


// Copy config.example.php to config.php (which is not under version control)
// config.php is included by CreateSend.php directly



define ( 'CREATESEND_CLASS',    '/home/blotto/createsend-php/csrest_transactional_smartemail.php' );

require CREATESEND_CLASS;

require __DIR__.'/CreateSend.php';



// 1. Send an email


try {

// Set up some variables and then

    $cm = \Whitelamp\CreateSend::send ($key,$campaign_id,$to,$data);


}
catch (\Exception $e) {
    echo $e->getMessage()."\n";
    exit ($e->getCode());
}

print_r ($cm);



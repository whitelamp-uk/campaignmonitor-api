<?php


// blotto2 config and functions
require '/home/blotto/config/ffm.cfg.php';
require '/home/mark/blotto/blotto2/scripts/functions.php';

// Get an instance of this class
$api = email_api ();

// Set the API key
$api->keySet ('QqNAjYIjEqk+9vwQHhR+WemuwHjuQrZawpY4s3WPkTzle3ubB0r1MoFxohbKKsLwvi8wRWCf9ger/hjAPpvn0sKC/lpJq2x8c/1goee3Epj9xVpTTd0rlVFsTFgYpeFRjR1hvscAio2P2SDmyFqGog==');
/*
$ref = $api->send (
    '7708203d-cfc2-4240-a568-9093f05e32ca',
    'banana.republics.totally.suck@thefundraisingfoundry.com',
    [
        'To'                => 'Mark Page <mark.page@thefundraisingfoundry.com>',
        'Title'             => 'Mr',
        'Name'              => 'Mark Page',
        'Email'             => 'mark.page@thefundraisingfoundry.com',
        'Mobile'            => '07234561890',
        'First_Name'        => 'Mark',
        'Last_Name'         => 'Page',
        'Reference'         => 'CC1234_123456',
        'Chances'           => '2',
        'Tickets'           => '654321,654123',
        'Draws'             => '4',
        'First_Draw_Closed' => 'Nth of Next Month',
        'First_Draw_Day'    => '(N+1)th of Next Month',
        'First_Draw'        => '(N+1)th of Next Month',
    ]
);

if ($ref) {
    echo $ref."\n";
}
else {
    echo $api->errorLast."\n";
}

sleep (180);
*/

// My email
//$ref = 'e154a92f-9b2d-11ed-a75f-517398f27bc6';

// banana.republics.totally.suck@thefundraisingfoundry.com
$ref = '093b9d4c-9b2f-11ed-8ab0-3092f4aebddb';

$received = $api->received (
    '7708203d-cfc2-4240-a568-9093f05e32ca',
    $ref
);

echo "received = $received\n";


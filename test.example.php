<?php

// Copy this to test.php (which is not under version control)


// These will be defined in blotto2 global config
define ( 'BLOTTO_EMAIL_API_CAMPAIGNMONITOR',        '/opt/createsend-php/csrest_transactional_smartemail.php'   );
define ( 'BLOTTO_EMAIL_API_CAMPAIGNMONITOR_CLASS',  '\Blotto\CampaignMonitor'                                   );

// Use of blotto2 functions
require '/opt/blotto2/scripts/functions.php';
$api = class_api_instance ('EMAIL');

print_r ($api);



<?php

namespace Whitelamp;

require __DIR__.'/config.php';

class CreateSend {

    public function __construct ( ) {
    }

    public function bounces ( ) {
        // Get a list of relevant bounces (what is relevant?)
    }

    public static function send ($key,$campaign_id,$to,$data) {
        if (!class_exists('\CS_REST_Transactional_SmartEmail')) {
            throw new \Exception ('Class \CS_REST_Transactional_SmartEmail not found');
            return false;
        }
        $cm         = new \CS_REST_Transactional_SmartEmail (
            $campaign_id,
            ['api_key'=>$key]
        );
        return $cm->send (
            [
                "To"    => $to,
                "Data"  => $data
            ],
            'unchanged'
        );
    }

}


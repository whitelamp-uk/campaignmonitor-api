<?php

namespace Blotto;


require __DIR__.'/config.php';
require CAMPAIGNMONITOR_CREATESEND_CLASS;


class CampaignMonitor {

    public function __construct ( ) {
    }

    public function received ($ref) {
        // How is this scoped?
        // Just by a $ref?
        // Or should we use a persistent "campaign" (as defined by CreateSend) instead?
        // What will the return look like?
        // A fake return could be temporarily used here to allow black-boxing for parallel development
        $bounced = false;
        if ($bounced) {
            return false;
        }
        return true;
    }

    public static function send ($key,$campaign_id,$to,$data) {
        // Lifted from blotto2 function campaign_monitor() as the time this class was first defined
        if (!class_exists('\CS_REST_Transactional_SmartEmail')) {
            throw new \Exception ('Class \CS_REST_Transactional_SmartEmail not found');
            return false;
        }
        $cm = new \CS_REST_Transactional_SmartEmail (
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


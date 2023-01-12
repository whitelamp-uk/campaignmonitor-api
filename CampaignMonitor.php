<?php

namespace Blotto;


require __DIR__.'/config.php';
require CAMPAIGN_MONITOR;


class CampaignMonitor {

    private $key;
    public  $errorLast;

    public function __construct ( ) {
    }

    public function keySet ($key) {
        $this->key = $key;
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

    public function send ($template_ref,$email_to,$data) {
        // $data is a simple associative array [ template_var_name_1 => value_1, ... ]
        if (!class_exists('\CS_REST_Transactional_SmartEmail')) {
            throw new \Exception ('Class \CS_REST_Transactional_SmartEmail not found');
            return false;
        }
        // In CM land, the template to be used is stored within the "campaign" and is referenced by its "Campaign ID"
        $campaign_id = $template_ref;
        $this->errorLast = null;
        $cm = new \CS_REST_Transactional_SmartEmail (
            $campaign_id,
            ['api_key'=>$this->apiKey]
        );
        $rtn =  $cm->send (
            [
                "To"    => $email_to,
                "Data"  => $data
            ],
            'unchanged'
        );
        if (in_array ($rtn->http_status_code,[200,201,202])) {
            return $rtn->response[0]->MessageID;
        }
        $this->errorLast  = "CMID=$campaign_id Email=$email_to\ndata=".print_r($data,true)."return=".print_r($rtn,true);
        return false;
    }

}


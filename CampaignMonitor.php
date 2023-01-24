<?php

namespace Blotto;


require __DIR__.'/config.php';
require CAMPAIGN_MONITOR;
require CAMPAIGN_MONITOR_TIMELINE;


class CampaignMonitor {

    private $key;
    protected $errorLast;

    public function __construct ( ) {
    }

    public function keySet ($key) {
        $this->key = $key;
    }

    public function received ($template_ref,$message_ref) {
        $cm = new \CS_REST_Transactional_Timeline (
            ['api_key'=>$this->key]
        );
        $result = $cm->details ($message_ref,true);
        if (property_exists($result,'response') && property_exists($result->response,'Status')) {
            return ($result->response->Status!='Bounced');
        }
        return false;
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
            ['api_key'=>$this->key]
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


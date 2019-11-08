<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Auth {

    public function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->library('session');
    }

    public function create($usersId = "") {
        $token = sha1($this->ci->put('device_type') . $this->ci->put('device_id'));
        $auth_token = sha1(CURRENT_TIME . $this->ci->put('device_type') . $this->ci->put('device_id'));
        $platform = $this->ci->put('device_type');
        $auth_arr = array(
            "user_id" => $usersId,
            "auth_token" => $auth_token,
            "token" => $token,
            "platform" => $platform,
            "status" => 'ACTIVE',
            "date" => date("Y-m-d H:i:s", CURRENT_TIME)
        );
        $this->ci->Common_model->updateData(TBL_AUTH, array('status' => "EXPIRED"), array('token' => $token, 'platform' => $platform, 'user_id' => $usersId));
        $this->ci->Common_model->insertData(TBL_AUTH, $auth_arr);
        $auth_send_token = $token . SEPARATE_KEY . $auth_token;
        return $auth_send_token;
    }

    public function verify_token() {
        $headers = apache_request_headers();
        $authToken = isset($headers['Authorization']) ? $headers['Authorization'] : null;
        if (!isset($authToken)) {
            $authToken = $this->ci->post('auth_token');
        }
        if (!isset($authToken)) {
            $authToken = $this->ci->put('auth_token');
        }
        $token_arr = explode(SEPARATE_KEY, $authToken);
        $flag = FALSE;
        if (count($token_arr) > 1) {
            $is_token_exists = $this->ci->Common_model->getDataById('date,user_id,platform', TBL_AUTH, array('token' => $token_arr[0], 'auth_token' => $token_arr[1], 'status' => 'ACTIVE'));
            if (!empty($is_token_exists)) {
                $current_timestamp = date("Y-m-d H:i:s", time());
                $max_time = 60 * 60; // 1 hour
                if ((strtotime($current_timestamp) - strtotime($is_token_exists->date)) < $max_time) {
                    $flag = $is_token_exists->user_id;
                }
            }
        }
        return $flag;
    }

    public function refresh_token($usersId = "") {
        $token = sha1($this->ci->put('device_type') . $this->ci->put('device_id'));
        $auth_token = sha1(CURRENT_TIME . $this->ci->put('device_type') . $this->ci->put('device_id'));
        $platform = $this->ci->put('device_type');
        $auth_arr = array(
            "user_id" => $usersId,
            "auth_token" => $auth_token,
            "token" => $token,
            "platform" => $platform,
            "status" => 'ACTIVE',
            "date" => date("Y-m-d H:i:s", CURRENT_TIME)
        );
        $this->ci->Common_model->updateData(TBL_AUTH, array('status' => "EXPIRED"), array('token' => $token, 'platform' => $platform, 'user_id' => $usersId));
        $this->ci->Common_model->insertData(TBL_AUTH, $auth_arr);
        $auth_send_token = $token . SEPARATE_KEY . $auth_token;
        return $auth_send_token;
    }

    function browser() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $browsers = array(
            'Chrome' => array('Google Chrome', 'Chrome/(.*)\s'),
            'MSIE' => array('Internet Explorer', 'MSIE\s([0-9\.]*)'),
            'Firefox' => array('Firefox', 'Firefox/([0-9\.]*)'),
            'Safari' => array('Safari', 'Version/([0-9\.]*)'),
            'Opera' => array('Opera', 'Version/([0-9\.]*)')
        );

        $browser_details = array();

        foreach ($browsers as $browser => $browser_info) {
            if (preg_match('@' . $browser . '@i', $user_agent)) {
                $browser_details['name'] = $browser_info[0];
                preg_match('@' . $browser_info[1] . '@i', $user_agent, $version);
                $browser_details['version'] = $version[1];
                break;
            } else {
                $browser_details['name'] = 'Unknown';
                $browser_details['version'] = 'Unknown';
            }
        }

        return $browser_details['name'] . ' Version: ' . $browser_details['version'];
    }

    function get_user_info() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
            //Is it a proxy address
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $pdata['ip_address'] = $ip;
        if ($ip != '') {
            $details = json_decode(file_get_contents(IPINFO_URL . "{$ip}/json"));
            $locStr = '';
            if (isset($details->city)) {
                $locStr .= $details->city;
            }
            if (isset($details->region)) {
                if ($locStr != '') {
                    $locStr .= ", ";
                }
                $locStr .= $details->region;
            }
            if (isset($details->country)) {
                if ($locStr != '') {
                    $locStr .= ", ";
                }
                $locStr .= $details->country;
            }
            $pdata['locationInfo'] = $locStr;
            if (isset($details->loc)) {
                $pdata['latlong'] = $details->loc;
            } else {
                $pdata['latlong'] = '';
            }
        } else {
            $pdata['locationInfo'] = '';
            $pdata['latlong'] = '';
        }
        return $pdata;
    }

}

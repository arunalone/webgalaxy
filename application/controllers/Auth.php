<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin/User_model', 'A');
        $this->load->helper(array('cookie'));
    }

    public function index() {
        if ($this->Common_model->is_user_logged_in()) {
            redirect(base_url() . "admin/Store");
        } else {
            $this->load->view('admin/auth/login');
        }
    }

    public function logout() {
        $this->session->userdata = array();
        $this->session->sess_destroy();
        redirect(base_url());
    }

    function check_login() {
        $user_row = $this->A->check_login($this->make_safe_post('usr_email'), $this->make_safe_post('usr_password'));
        if ($user_row) {
            if ($user_row->status == "ACTIVE") {
                if ($this->make_safe_post('remember_me') == 'on') {
                    set_cookie('user', $this->make_safe_post('usr_email_id'), time() + (10 * 365 * 24 * 60 * 60));
                    set_cookie('password', $this->make_safe_post('usr_password'), time() + (10 * 365 * 24 * 60 * 60));
                } else {
                    if (isset($_COOKIE["user"])) {
                        setcookie("user", "");
                    }

                    if (isset($_COOKIE["password"])) {
                        setcookie("password", "");
                    }
                }
                $this->set_session_data($user_row->emp_id, $user_row->role_id);
                echo "admin";
            } else {
                echo "User is not Active";
            }
        } else {
            echo "Entered Password or email id is invalid.";
        }
    }

    function forgot_password() {
        $check_user = $this->Common_model->getDataById("*", TBL_EMPLOYEE, array('email_id' => $this->make_safe_post('forgot_email_id'), 'status !=' => "DELETED"));
        if (!empty($check_user)) {
            if ($check_user->status !== "ACTIVE") {
                echo "inactive";
            } else {
                $expirelinkDate = date("Y-m-d H:i:s", strtotime('+24 hours', strtotime(TODAY_DATE_TIME)));
                $token = random_string('alnum', 8);
                $resetPasswordToken = md5($token . date("YmdHis"));
                $this->Common_model->updateData(TBL_EMPLOYEE, array('reset_password_token' => $resetPasswordToken, 'reset_pwd_expiredate' => $expirelinkDate), array('emp_id' => $check_user->emp_id));
                $this->load->helper('email_id');
                sendResetPasswordEmail(array('email_id' => $this->make_safe_post('forgot_email_id'), 'resetPasswordToken' => $resetPasswordToken, 'userName' => $check_user->first_name . " " . $check_user->last_name));
                echo "success";
            }
        } else {
            echo "not_exists";
        }
    }

    function resetpassword($token) {
        $data['page_title'] = 'Reset Password';
        $data['page_code'] = 'resetpassword';
        $check_user = $this->Common_model->getDataById("*", TBL_EMPLOYEE, array('reset_password_token' => $token, 'status' => 'ACTIVE'));
        if (!empty($check_user)) {
            if (strtotime($check_user->reset_pwd_expiredate) >= strtotime(TODAY_DATE_TIME)) {
                $data['usr_id'] = $check_user->emp_id;
                $this->load->view('admin/auth/resetpassword', $data);
            } else {
                $this->session->set_userdata('ExpiredLink', 'error');
                redirect(base_url());
            }
        } else {
            $this->session->set_userdata('InactiveLink', 'error');
            redirect(base_url());
        }
    }

    function resetCustomerpassword($token) {
        $data['page_title'] = 'Reset Password';
        $data['page_code'] = 'resetpassword';
        $check_user = $this->Common_model->getDataById("*", TBL_USER, array('reset_password_token' => $token, 'status' => 'ACTIVE'));
        if (!empty($check_user)) {
            if (strtotime($check_user->reset_pwd_expiredate) >= strtotime(TODAY_DATE_TIME)) {
                $data['usr_id'] = $check_user->emp_id;
                $this->load->view('admin/auth/resetCustomerpassword', $data);
            } else {
                $this->session->set_userdata('ExpiredLink', 'error');
                redirect(base_url());
            }
        } else {
            $this->session->set_userdata('InactiveLink', 'error');
            redirect(base_url());
        }
    }

    function updatepassword() {
        $pass = $this->Common_model->password_hash_conversion($this->make_safe_post('usr_password'));
        $this->Common_model->updateData(TBL_EMPLOYEE, array('reset_password_token' => '', 'reset_pwd_expiredate' => '', 'password' => $pass), array('emp_id' => $this->make_safe_post('usr_id')));
        echo "success";
    }

    function updateCustomerpassword() {
        $pass = $this->Common_model->password_hash_conversion($this->make_safe_post('usr_password'));
        $this->Common_model->updateData(TBL_USER, array('reset_password_token' => '', 'reset_pwd_expiredate' => '', 'password' => $pass), array('emp_id' => $this->make_safe_post('usr_id')));
        echo "success";
    }

    function set_session_data($emp_id, $type) {
        $user_row = $this->Common_model->getDataById("*", TBL_EMPLOYEE, array('emp_id' => $emp_id));
        if (!empty($user_row)) {
            $user_role = $this->Common_model->getDataById('role_name', TBL_ROLE, array('status' => "ACTIVE", 'role_id' => $user_row->role_id));
            $this->Common_model->updateData(TBL_EMPLOYEE, array('modified_on' => date("Y-m-d H:i:s")), array('emp_id' => $emp_id));
            $this->session->set_userdata('full_name', $user_row->first_name . " " . $user_row->last_name);
            $this->session->set_userdata('email_id', $user_row->email_id);
            $this->session->set_userdata('emp_id', $user_row->emp_id);
            $this->session->set_userdata('dept_id', $user_row->dept_id);
            $this->session->set_userdata('role_id', $user_row->role_id);
            $this->session->set_userdata('access_level', $user_row->access_level);
            $this->session->set_userdata('modules', $user_row->modules);
            $this->session->set_userdata('is_user_logged_in', TRUE);
            $this->session->set_userdata('user_role', ($user_role) ? $user_role->role_name : "");
        }
    }

    function get_state_city_list() {
        $city_list = $this->Common_model->getAllData('city_id,city_name', TBL_CITY, array('city_state_id' => make_safe_post('state_id'), 'city_status' => "ACTIVE"), "", "", "");
        $option = "";
        foreach ($city_list as $key => $row) {
            $option .= '<option value="' . $row->city_id . '">' . $row->city_name . '</option>';
        }
        echo $option;
    }

    private function make_safe_post($variable) {
        if (is_array($this->input->post($variable))) {
            $variable = $this->input->post($variable);
            foreach ($variable as $key => $value) {
                if (is_array($value)) {
                    foreach ($value as $key1 => $value1) {
                        $variable1[$key][$key1] = strip_tags((trim($this->security->xss_clean($value1))));
                    }
                } else {
                    $variable1[$key] = strip_tags((trim($this->security->xss_clean($value))));
                }
            }
            $variable = $variable1;
        } else
            $variable = strip_tags((trim($this->security->xss_clean($this->input->post($variable)))));

        return $variable;
    }

    private function make_safe_get($variable) {
        $variable1 = strip_tags(strip_quotes(trim($this->security->xss_clean($this->input->get($variable)))));
        return $variable1;
    }

}

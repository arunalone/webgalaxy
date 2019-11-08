<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->Common_model->is_user_logged_in()) {
            redirect(base_url());
        }

        $this->load->model('admin/User_model', 'U');
    }

    public function index() {
        if ($this->session->userdata('user_role') != "Admin") {
            redirect(base_url() . 'admin/user/profile/' . $this->session->userdata('emp_id'));
        }
        $data['page_title'] = 'Employee List';
        $data['page_code'] = 'users';
        $data['all_roles'] = $this->Common_model->getAllData('role_id,role_name', TBL_ROLE, array('status' => "ACTIVE"), "", "", "");
        $data['dept_list'] = $this->Common_model->getAllData('dept_id,dept_name', TBL_DEPT, array('status' => "ACTIVE"), "", "", "");
        $data['all_roles'] = $this->Common_model->getAllData('*', TBL_ROLE, array('status' => "ACTIVE"));
        $this->load->view('admin/user/user_list', $data);
    }

    function user_list() {
        $data['page_title'] = 'Employees';
        $data['page_code'] = 'users';
        $data['page'] = make_safe_post('page');
        $data['per_page'] = (make_safe_post('show_records') !== "undefined") ? (make_safe_post('show_records')) : PER_PAGE_RECORDS;
        $data['search_val'] = (make_safe_post('search_val') !== "undefined") ? addslashes(make_safe_post('search_val')) : "";
        $data['start'] = ($data['page'] - 1) * $data['per_page'];
        $data['previous_btn'] = TRUE;
        $data['next_btn'] = TRUE;
        $data['first_btn'] = TRUE;
        $data['last_btn'] = TRUE;
        $data['cur_page'] = $data['page'];
        $data['user_status'] = (make_safe_post('user_status')) ? make_safe_post('user_status') : "";
        $data['user_type'] = (make_safe_post('user_type') !== "undefined") ? make_safe_post('user_type') : 0;
        $data['colname'] = (make_safe_post('colname') !== "undefined") ? make_safe_post('colname') : "first_name";
        $data['dept_id'] = (make_safe_post('dept_id') !== "undefined") ? make_safe_post('dept_id') : "";
        $data['sort'] = (make_safe_post('sort') !== "undefined") ? make_safe_post('sort') : "DESC";
        $data['list_count'] = $this->U->getUserCount($data['user_status'], $data['search_val'], $data['user_type'], $data['dept_id']);
        $data['list_res'] = $this->U->getUserList($data['user_status'], $data['search_val'], $data['per_page'], $data['start'], $data['colname'], $data['sort'], $data['user_type'], $data['dept_id']);
        $this->load->view('admin/user/user_pagi', $data, FALSE);
    }

    function profile($id = 0) {
        $data['emp_id'] = $id;
        $data['page_title'] = 'Edit Profile';
        $data['page_code'] = 'users';
        $data['is_profile'] = "YES";
        $data['cur_page'] = "";
        $data['row'] = $this->Common_model->getDataById("", TBL_EMPLOYEE, array('emp_id' => $id));
        $data['all_roles'] = $this->Common_model->getAllData('role_id,role_name', TBL_ROLE, array('status' => "ACTIVE"), "", "", "");
        $data['dept_list'] = $this->Common_model->getAllData('dept_id,dept_name', TBL_DEPT, array('status' => "ACTIVE"), "", "", "");
        $this->load->view('admin/user/manage_user', $data, FALSE);
    }

    function update_data() {
        $modules = implode(",", make_safe_post('modules'));
        $data = array(
            'first_name' => make_safe_post('first_name'),
            'last_name' => make_safe_post('last_name'),
            'mobile_no' => make_safe_post('mobile_no'),
            'dept_id' => make_safe_post('dept_id'),
            'role_id' => make_safe_post('role_id'),
            'modules' => $modules,
            'access_level' => make_safe_post('access_level'),
            'status' => make_safe_post('status'),
            'modified_on' => TODAY_DATE_TIME
        );
        if (make_safe_post('password') !== "") {
            $data['password'] = md5(make_safe_post('password'));
        }
        if (make_safe_post('emp_id') > 0) {
            $this->Common_model->updateData(TBL_EMPLOYEE, $data, array('emp_id' => make_safe_post('emp_id')));
        } else {
            $data['email_id'] = make_safe_post('email');
            $data['created_on'] = date('Y-m-d H:i:s');
            $this->Common_model->insertData(TBL_EMPLOYEE, $data);
        }
        redirect(base_url() . 'admin/user');
    }

    function update_customer() {
        $data = array(
            'status' => make_safe_post('status'),
            'updated_date' => TODAY_DATE_TIME
        );
        if (make_safe_post('password') !== "") {
            $data['password'] = $this->Common_model->password_hash_conversion(make_safe_post('password'));
        }
        $this->Common_model->updateData(TBL_EMPLOYEE, $data, array('emp_id' => make_safe_post('emp_id')));
        redirect(base_url() . 'admin/User');
    }

    function update_password() {
        if (make_safe_post('password') !== "") {
            $data['password'] = md5(make_safe_post('password'));
        }
        $this->Common_model->updateData(TBL_EMPLOYEE, $data, array('emp_id' => make_safe_post('user_id')));
        redirect(base_url() . 'admin/user');
    }

    public function check_email() {
        $email = make_safe_post('email');
        $emp_id = make_safe_post('emp_id');
        $row = 0;
        if ($emp_id > 0) {
            $row = $this->Common_model->getCountRows("", TBL_EMPLOYEE, array('email_id' => $email, 'status !=' => 'DELETED', 'emp_id !=' => $emp_id));
        } else {
            $row = $this->Common_model->getCountRows("", TBL_EMPLOYEE, array('email_id' => $email, 'status !=' => 'DELETED'));
        }
        if ($row == 0) {
            echo "true";
        } else {
            echo "false";
        }
    }

}

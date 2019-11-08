<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->Common_model->is_user_logged_in()) {
            redirect(base_url());
        }
        $this->load->model('admin/Role_model', "R");
    }

    public function index() {
        $data['page_title'] = 'Role';
        $data['page_code'] = 'role';
        $data['page_val'] = 'role';
        $this->load->view('admin/role/role_list', $data);
    }

    function role_list() {
        $data['page_title'] = 'Roles';
        $data['page_code'] = 'role';
        $data['page'] = make_safe_post('page');
        $data['per_page'] = (make_safe_post('show_records') !== "undefined") ? (make_safe_post('show_records')) : PER_PAGE_RECORDS;
        $data['search_keyword'] = (make_safe_post('search_keyword') !== "undefined") ? addslashes(make_safe_post('search_keyword')) : "";
        $data['start'] = ($data['page'] - 1) * $data['per_page'];
        $data['previous_btn'] = TRUE;
        $data['next_btn'] = TRUE;
        $data['first_btn'] = TRUE;
        $data['last_btn'] = TRUE;
        $data['cur_page'] = $data['page'];
        $data['status'] = (make_safe_post('status') !== "") ? make_safe_post('status') : "";
        $data['colname'] = (make_safe_post('colname') !== "undefined") ? make_safe_post('colname') : "first_name";
        $data['sort'] = (make_safe_post('sort') !== "undefined") ? make_safe_post('sort') : "DESC";
        $data['list_count'] = $this->R->getRoleCount($data['status'], $data['search_keyword']);
        $data['list_res'] = $this->R->getRoleList($data['status'], $data['search_keyword'], $data['colname'], $data['sort'], $data['per_page'], $data['start']);
        $this->load->view('admin/role/role_pagi', $data, FALSE);
    }

    function delete_role() {
        $is_used = $this->Common_model->checkCount('user_id', TBL_ADMIN_USERS, array('role_id' => make_safe_post('module_id'), 'status !=' => 'DELETED'));
        if ($is_used) {
            echo "This role cannot be deleted because it is being used by one or more users.";
        } else {
            $this->Common_model->updateData(TBL_ROLE, array('status' => "DELETED"), array('role_id' => make_safe_post('module_id')));
            echo "success";
        }
    }

    function manage_role($id = 0) {
        $data['role_id'] = $id;
        $data['page_title'] = ($id) ? 'Edit Role' : "Add Role";
        $data['page_code'] = 'role';
        $data['row'] = $this->Common_model->getDataById('role_id,role_name,status', TBL_ROLE, array('role_id' => $id));
        $this->load->view('admin/role/manage_role', $data, FALSE);
    }

    function update_data() {
        $data = array(
            'role_name' => make_safe_post('role_name'),
            'status' => make_safe_post('status'),
            'modified_on' => TODAY_DATE_TIME
        );
        if (make_safe_post('role_id')) {
            $this->Common_model->updateData(TBL_ROLE, $data, array('role_id' => make_safe_post('role_id')));
        } else {
            $data['created_on'] = TODAY_DATE_TIME;
            $this->Common_model->insertData(TBL_ROLE, $data);
        }
        redirect(base_url() . 'admin/Role');
    }

    function check_duplicate() {
        if (make_safe_post('role_id')) {
            $is_exists = $this->Common_model->getDataById('role_id', TBL_ROLE, array('role_name' => make_safe_post('role_name'), 'role_id !=' => make_safe_post('role_id'), 'status !=' => "DELETED"));
        } else {
            $is_exists = $this->Common_model->getDataById('role_id', TBL_ROLE, array('role_name' => make_safe_post('role_name'), 'status !=' => "DELETED"));
        }
        if ($is_exists) {
            echo "false";
        } else {
            echo "true";
        }
    }

}

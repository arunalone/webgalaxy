<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->Common_model->is_user_logged_in()) {
            redirect(base_url());
        }
        $this->load->model('admin/Category_model', "C");
    }

    public function index() {
        $data['page_title'] = 'Category';
        $data['page_code'] = 'category';
        $data['page_val'] = 'category';
        $this->load->view('admin/category/category_list', $data);
    }

    function category_list() {
        $data['page_title'] = 'Category';
        $data['page_code'] = 'category';
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
        $data['list_count'] = $this->C->getCategoryCount($data['status'], $data['search_keyword']);
        $data['list_res'] = $this->C->getCategoryList($data['status'], $data['search_keyword'], $data['colname'], $data['sort'], $data['per_page'], $data['start']);
        $this->load->view('admin/category/category_pagi', $data, FALSE);
    }

    function delete_category() {
        $this->Common_model->updateData(TBL_DEPT, array('status' => "DELETED"), array('dept_id' => make_safe_post('module_id')));
        echo "success";
    }

    function manage_category($id = 0) {
        $data['category_id'] = $id;
        $data['page_title'] = ($id) ? 'Edit Category' : "Add Category";
        $data['page_code'] = 'category';
        $data['row'] = $this->Common_model->getDataById('dept_id,dept_name,status', TBL_DEPT, array('dept_id' => $id));
        $this->load->view('admin/category/manage_category', $data, FALSE);
    }

    function update_data() {
        $data = array(
            'dept_name' => make_safe_post('category_name'),
            'status' => make_safe_post('status'),
            'modified_on' => TODAY_DATE_TIME
        );
        if (make_safe_post('category_id')) {
            $this->Common_model->updateData(TBL_DEPT, $data, array('dept_id' => make_safe_post('category_id')));
        } else {
            $data['created_on'] = TODAY_DATE_TIME;
            $this->Common_model->insertData(TBL_DEPT, $data);
        }
        redirect(base_url() . 'admin/Category');
    }

    function check_duplicate() {
        if (make_safe_post('category_id')) {
            $is_exists = $this->Common_model->getDataById('dept_id', TBL_DEPT, array('dept_name' => make_safe_post('category_name'), 'dept_id !=' => make_safe_post('category_id'), 'status !=' => "DELETED"));
        } else {
            $is_exists = $this->Common_model->getDataById('dept_id', TBL_DEPT, array('dept_name' => make_safe_post('category_name'), 'status !=' => "DELETED"));
        }
        if ($is_exists) {
            echo "false";
        } else {
            echo "true";
        }
    }

}

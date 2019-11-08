<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category_model extends CI_Model {

    function __construct() {
        parent:: __construct();
    }

    function getCategoryList($status, $keyword, $colname, $sort, $page, $start) {
        $this->db->select();
        $this->db->from(TBL_DEPT . ' AS R');
        if ($status) {
            $this->db->where('R.status', $status);
        } else {
            $this->db->where('R.status !=', "DELETED");
        }
        if ($keyword) {
            $this->db->like('R.dept_name', $keyword, 'both');
        }
        $this->db->order_by($colname, $sort);
        $this->db->limit($page, $start);
        $query = $this->db->get();
        return ($query->num_rows()) ? $query->result() : FALSE;
    }

    function getCategoryCount($status, $keyword) {
        $this->db->select();
        $this->db->from(TBL_DEPT . ' AS R');
        if ($status) {
            $this->db->where('R.status', $status);
        } else {
            $this->db->where('R.status !=', "DELETED");
        }
        if ($keyword) {
            $this->db->like('R.dept_name', $keyword, 'both');
        }
        $this->db->order_by('R.dept_name');
        $query = $this->db->get();
        return ($query->num_rows()) ? $query->num_rows() : FALSE;
    }

}

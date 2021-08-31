<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
class Board_m extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    public function getList($search_type, $word)
    {
	    echo $search_type."/".$word;
			if($search_type == 'title'){ // title
				$this->db->select('*');
				$this->db->from('List');
				$this->db->order_by('ID', 'DESC');
				$this->db->like('title', $word);
			}
			else if($search_type == 'ID'){ // ID
				$this->db->select('*');
				$this->db->from('List');
				$this->db->order_by('ID', 'DESC');
				$this->db->like('ID', $word);
			}
			else { // User일때
				$this->db->select('*');
				$this->db->from('List');
				$this->db->order_by('ID', 'DESC');
				$this->db->like('created_user', $word);
			}
			return $this->db->get()->result();
	}
}

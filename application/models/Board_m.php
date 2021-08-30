<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
class Board_m extends CI_Model {
    function __construct() {
        parent::__construct();
    }

public function getList($type, $offset, $limit, $search_type, $word)
	{
//		echo "type : ".$type."offset : ".$offset."limit : ".$limit."search_type : ".$search_type."word : ".$word; 
		if ($type == 'cnt') {
			if($search_type == 'title'){
				$this->db->select('*');
				$this->db->from('List');
				$this->db->like('title', $word);
				return $this->db->get()->num_rows();
			}
			else if($search_type == 'ID'){
				$this->db->select('*');
				$this->db->from('List');
				$this->db->like('ID', $word);
				return $this->db->get()->num_rows();
			}
			else { // User일때
				$this->db->select('*');
				$this->db->from('List');
				$this->db->like('created_user', $word);
				return $this->db->get()->num_rows();
			}
		} else {
			if($search_type == 'title'){
				$this->db->select('*');
				$this->db->from('List');
				$this->db->order_by('ID', 'DESC');
				$this->db->like('title', $word);
			}
			else if($search_type == 'ID'){
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
			if ($offset!= null || $limit != null) {
				$this->db->limit($limit, $offset);
			}

			return $this->db->get()->result();
		}
	}
}

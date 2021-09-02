<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
class Board_m extends CI_Model {
	
    function __construct() {
        parent::__construct();
    }


    public function getList($search_type, $word)
    {
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


    public function add_list($option)
    {


                $this->db->set('title', $option->title);
                $this->db->set('description', $option->description);
                $this->db->set('created_user', $option->created_user);
                $this->db->set('created', 'NOW()', false);
 
		$this->db->insert('List');

                $result = $this->db->insert_id();

                return $result;
    }


    public function get_forum($id)
    {
	    return $this->db->query('SELECT * FROM List WHERE ID = ?', array($id))->row();
    }

}

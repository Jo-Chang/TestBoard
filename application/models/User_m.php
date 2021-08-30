<?php

class User_m extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function add($option)
	{
		$this->db->set('ID', $option['id']);
		$this->db->set('password', $option['password']);
		$this->db->set('name', $option['name']);
		//$this->db->set('email', $option['email']);
		$this->db->set('created', 'NOW()', false);

		$this->db->insert('User');
		$result = $this->db->insert_id();

		return $result;
	}

	public function getById($option)
	{
		$result = $this->db->get_where('User', array('ID' => $option['id']))->row();
		return $result;
	}

	public function sessionDestroy($user_id, $ip_address)
	{
//              $sql = "SELECT session_id FROM ci_sessions WHERE (user_data LIKE '%".$this->db->escape_like_str($user_id)."%') and (user_data LIKE '%".$this->db->escape_like_str($ip_address)."%') ";
		$sql = "SELECT id FROM ci_sessions WHERE (data LIKE '%" . $this->db->escape_like_str($user_id) . "%')";
		$session_id = $this->db->query($sql)->result();

		foreach ($session_id as $entry) {
			$this->db->delete('ci_sessions', array('id' => $entry->id));
		}
	}

	public function deleteaccount($user_id)
	{
		$this->db->delete('User', array('ID' => $user_id));
	}

	public function modify_info($data)
	{
		$this->db->where('ID', $data['ID']);
		$this->db->update('User', $data);
	}

	public function getUserinfo($user_id)
	{
		$sql = 'SELECT * FROM User WHERE ID = ?';
		return $this->db->query($sql, array($user_id))->row();
	}



	public function getNotice(){
		return $this->db->get('notice')->row();
	}

}

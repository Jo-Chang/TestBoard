<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {


	function __construct() {
		parent::__construct();
//		$this -> load -> database();
		$this -> load -> model('board_m');
		$this -> load -> helper(array('url', 'date'));
	}


	public function index()
	{
	
		$this->lists();

	}


	public function lists()
	{
	
		if (!$this->session->userdata('is_login')) {
			$this->load->helper('url');
                        redirect('/auth/login');
                }
	
                $this->load->view('header_v');


		$uid = $this->session->userdata('user_id');

		$search_type = '';
		$search_word = $page_url = '';
		
		$post = array("type" => $this->input->get('type'),
			"word" => $this->input->get('search_word'));

		$uri_array = $this->segment_explode($this->uri->uri_string());	
	
		if (in_array('q', $uri_array)) {
		
			$search_type = rawurldecode($this->url_explode($uri_array, 'p'));

			$search_word = rawurldecode($this->url_explode($uri_array, 'q'));

			$post = array("type" => $search_type, "word"=>$search_word);

			$page_url = '/q/' . $search_word . '/p/' . $search_type;

		}
		
		$data['list'] = $this->board_m->getList($search_type, $search_word);

	 	$this->load->view('board_v', array('data' => $data, 'post' => $post));

		$this->load->view('footer_v');
	}

	
	public function segment_explode($seg)
	{
		$len = strlen($seg);

		if (substr($seg, 0, 1) == '/') {
			$seg = substr($seg, 1, $len);
		}

		$len = strlen($seg);

		if (substr($seg, -1) == '/') {
			$seg = substr($seg, 0, $len - 1);
		}

		$seg_exp = explode("/", $seg);
		return $seg_exp;
	}


	public function url_explode($url, $key)
	{

		$cnt = count($url);

		for ($i = 0; $cnt > $i; $i++) {
			if ($url[$i] == $key) {
				$k = $i + 1;
				return $url[$k];
			}
		}

	}


	public function add_list_page()
	{
		$this->load->view('header_v');
		
		$this->load->view('add_list_v');
 
		$this->load->view('footer_v');
	}


	public function add_list()
	{
		$uid=$this->session->userdata('user_id');

		$option=new stdClass();
		$option->title=$this->input->post('title');
		$option->description=$this->input->post('description');
		$option->created_user=$this->session->userdata('user_id');

		$this->board_m->add_list($option);

		redirect("/main");
	}


	public function edit_list()
	{


	}


	public function delete_list()
	{


	}
	

	public function show_forum($id)
	{
		$this->load->view('header_v');


		$forum=$this->board_m->get_forum($id);
		$this->load->view('show_forum_v',array('forum'=>$forum));

		$this->load->view('footer_v');
	}

}


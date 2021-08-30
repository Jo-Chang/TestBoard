<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 *              http://example.com/index.php/welcome
	 *      - or -
	 *              http://example.com/index.php/welcome/index
	 *      - or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct() {
		parent::__construct();
		$this -> load -> database();
		$this -> load -> model('board_m');
		$this -> load -> helper(array('url', 'date'));
		//session_start();
	}


	public function index()
	{
		$this->load->view('header_v');

		$this->lists();

		$this->load->view('footer_v');
	}


	public function lists()
	{

	//	$uid = $this->session->userdata('user_id');

		$search_type = '';
		$search_word = $page_url = '';
		$uri_segment = 5;
		
		
		$post = array("type" => $this->input->get('type'),
			"word" => $this->input->get('search_word'));

		$uri_array = $this->segment_explode($this->uri->uri_string());

		if (in_array('q', $uri_array)) {
			$search_type = rawurldecode($this->url_explode($uri_array, 'p'));

			$search_word = rawurldecode($this->url_explode($uri_array, 'q'));

			$post = array("type" => $search_type, "word"=>$search_word);

			$page_url = '/q/' . $search_word . '/p/' . $search_type;

			$uri_segment = 5;
		}
		

		$this->load->library('pagination');
		$url = "testBoard/index.php/Main/lists/".$page_url."/page/";

		$config['base_url'] = base_url() . $url;
		$config['uri_segment'] = $uri_segment;
		$config['per_page'] = 5;
		$config = $this->_pagenationDesignConfig($config);
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$page = $this->uri->segment($uri_segment, 1);

		if ($page > 1) {
			$start = (($page / $config['per_page'])) * $config['per_page'];
		} else {
			$start = ($page - 1) * $config['per_page'];
		}

		$limit = $config['per_page'];

		
		$data['problems'] = $this->board_m->getList('', $start, $limit, $search_type, $search_word);

		$this->load->view('board_v', array('data' => $data, 'id' => '', 'mode' => '', 'post' => $post));
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

	public function _pagenationDesignConfig($config)
	{

		$config['full_tag_open'] = '<nav><ul class="pagination">';
		$config['full_tag_close'] = '</ul></nav>';

		$config['first_link'] = '&laquo;';
		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = '&raquo;';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>';

		//$config['next_link'] = '&rarr;';
		$config['next_link'] = false;
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';

		//$config['prev_link'] = '&larr;';
		$config['prev_link'] = false;
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';

		return $config;

	}
}


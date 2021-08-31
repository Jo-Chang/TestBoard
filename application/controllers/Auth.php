<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
                $this -> load -> model('user_m');
//                $this -> load -> helper(array('url', 'date'));
	}

	/* 로그인페이지 출력 */
	public function login()
	{
		$this->load->view('header_v');

		$this->load->view('login_v', array('returnURL' => $this->input->get('returnURL')));

		$this->load->view('footer_v');
	}

	/* log-out 처리 */
	public function logout()
	{
		$this->session->sess_destroy();
		$this->load->helper('url');
		redirect('/main');
	}

	/* 회원가입 처리 */
	public function register()
	{
		$this->load->view('header_v');

		$this->load->library('form_validation');

		$this->form_validation->set_rules('id', 'Student ID', 'trim|required|min_length[4]|max_length[10]|is_unique[User.ID]|alpha_dash');
		$this->form_validation->set_rules('password', 'PASSWORD', 'required|min_length[6]|max_length[30]|matches[re_password]');
		$this->form_validation->set_rules('re_password', 'RE-PASSWORD', 'required');
		$this->form_validation->set_rules('name', 'NAME', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('register_v');
		} else {
			$this->user_m->add(array('id'=>$this->input->post('id'),'password'=>$this->input->post('password'),'name'=>$this->input->post('name')));
			$this->session->set_flashdata('message','Register Success !!');
			$this->load->helper('url');
			redirect('/main');
		}
		$this->load->view('footer_v');
	}

	/* login authentication */
	public function authentication(){
			$user = $this->user_m->getById(array('id' => $this->input->post('id')));

			if (!($this->input->post('id') == $user->ID && $this->input->post('password') == $user->password)){//ID,password 불일치
				$this->session->set_flashdata('message', '가입하지 않은 아이디이거나, 잘못된 비밀번호입니다.');
				$this->login_failed();
			}else{//ID,password 일치

				$this->login_success();
		}
	}

	public function login_success(){
		$user = $this->user_m->getById(array('id' => $this->input->post('id')));
		$this->user_m->sessionDestroy($user->ID, $this->input->ip_address());

		$this->session->set_userdata('is_login', true);
		$this->session->set_userdata('user_id', $user->ID);
		$this->session->set_userdata('ip', $this->input->ip_address());

		$returnURL = $this->input->get('returnURL');
		if ($returnURL == false) {
			$returnURL = '/main';
		}
		redirect($returnURL);
	}

	public function login_failed(){
		$returnURL = $this->input->get('returnURL');
		redirect('/auth/login/?returnURL=' . $returnURL);
	}

	public function mypage()
	{
		if (!$this->session->userdata('is_login')) {
			redirect('/auth/login/');
		}

		$this->load->view('header_v');
		$uid = $this->session->userdata('user_id');

		$user_info = $this->user_m->getUserinfo($uid);

		$this->load->view('mypage_v', array('user_id' => $uid, 'user_info' => $user_info));
		$this->load->view('footer_v');
	}

	public function modify_myinfo()
	{
		if (!$this->session->userdata('is_login')) {
			redirect('/auth/login/');
		}

		$uid = $this->session->userdata('user_id');
		$user_info = $this->user_m->getUserinfo($uid);
		$newpassword = $this->input->post('newpassword');
		if (!isset($newpassword) || trim($newpassword) == '' || strlen($newpassword) < 6) {
			$this->session->set_flashdata('message', '비밀번호가 잘못되었습니다. 6글자 이상');
			redirect('/auth/mypage');
		}

		if ($this->input->post('password') == $user_info->password) {
			$data = array(
				'ID' => $uid,
				'password' => $this->input->post('newpassword'),
				'name' => $this->input->post('name'),
			);
			$this->user_m->modify_info($data);
			$this->session->set_flashdata('message', 'Complete !!');
			redirect('/main');
		} else {
			$this->session->set_flashdata('message', '비밀번호가 일치하지 않습니다 !!');
			redirect('/auth/mypage');
		}
	}
}

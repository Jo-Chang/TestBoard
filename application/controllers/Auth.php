<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_m');
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
			$hash = password_hash($this->input->post('password'), PASSWORD_BCRYPT);

			$this->user_m->add(array(
				'id' => $this->input->post('id'),
				'password' => $hash,
				'name' => $this->input->post('name'),
		//		'email' => $this->input->post('email'),
			));
			$this->session->set_flashdata('message', 'Welcome to Online Judge !!');
			$this->load->helper('url');
			redirect('/main');
		}

		$this->load->view('footer_v');
	}

	/* login authentication */
	public function authentication(){
			$user = $this->user_m->getById(array('id' => $this->input->post('id')));

			if (!($this->input->post('id') == $user->ID && password_verify($this->input->post('password'), $user->password))){//ID,password 불일치
				$this->user_m->addloginlog($this->input->post('id'), $this->input->ip_address(), false);
				$this->session->set_flashdata('message', '가입하지 않은 아이디이거나, 잘못된 비밀번호입니다.');
				$this->login_failed();
			}else{//ID,password 일치
				$ip = $this->input->ip_address();
				$uid = $this->input->post('id');

				$this->login_success();
				/*
				if($user->sysmgr==1){
					$this->login_success();
				}else{
				if($this->user_m->isExamingIP($ip)){//Exam 테이블에 지금 접속하려는 IP와 같은 IP가 있다.
					if($this->user_m->isExamingID($uid)){//Exam 테이블에 지금 접속하려는 ID와 같은 ID가 있다.
						if($this->user_m->isExamingIDIP($uid,$ip)){//접속하려는 IP와 ID를 갖는 튜플이 있다.
							if($this->user_m->isValidByIDAndException($uid,0)){
								$this->login_success();
							}elseif($this->user_m->isValidByIDAndException($uid,1)){
								$this->session->set_flashdata('message', '[시스템 에러]\r\n발생할 수 없는 경우입니다.\n');
								$this->login_failed();
							}elseif($this->user_m->isValidByIDAndException($uid,3)){
								$this->session->set_flashdata('message', '[로그인 차단]\r\n이미 1회에 한하여 로그인이 허용되었던 사용자입니다.\n');
								$this->login_failed();
							}
						}else{//접속하려는 IP와 ID를 갖는 튜플이 없다.
							if($this->user_m->isValidByIDAndException($uid,0)){
								$this->session->set_flashdata('message', '[로그인 차단]\r\n이미 사용 중인 ID입니다.\n직전에 사용했던 IP만이 로그인이 허용됩니다.');
								$this->login_failed();
							}elseif($this->user_m->isValidByIDAndException($uid,1)){
								$this->login_success();
							}elseif($this->user_m->isValidByIDAndException($uid,3)){
								$this->session->set_flashdata('message', '[로그인 차단]\r\n이미 1회에 한하여 로그인이 허용되었던 사용자입니다.\n');
								$this->login_failed();
							}
						}
					}else{//Exam 테이블에 지금 접속하려는 ID와 같은 ID가 없다.
						$this->session->set_flashdata('message', '[로그인 차단]\r\n이미 사용 중인 IP입니다.\n현재 WiFi 환경일 경우, 다른 WiFi나 유선 랜 사용을 권장합니다.');
						$this->login_failed();
					}
				}else{//Exam 테이블에 지금 접속하려는 IP와 같은 IP가 없다.
					if($this->user_m->isExamingID($uid)){//Exam 테이블에 지금 접속하려는 ID와 같은 ID가 있다.
						if($this->user_m->isValidByIDAndException($uid,0)){
							$this->session->set_flashdata('message', '[로그인 차단]\r\n이미 사용 중인 ID입니다.\n직전에 사용했던 IP만이 로그인이 허용됩니다.');
							$this->login_failed();
						}elseif($this->user_m->isValidByIDAndException($uid,1)){
							$this->login_success();
						}elseif($this->user_m->isValidByIDAndException($uid,3)){
							$this->session->set_flashdata('message', '[로그인 차단]\r\n이미 1회에 한하여 로그인이 허용되었던 사용자입니다.\n');
							$this->login_failed();
						}
					}else{//Exam 테이블에 지금 접속하려는 ID와 같은 ID가 없다.
						$this->login_success();
					}
				}
				}*/
		}
	}

	public function login_success(){
		$user = $this->user_m->getById(array('id' => $this->input->post('id')));
		$this->user_m->sessionDestroy($user->ID, $this->input->ip_address());
		$this->user_m->addloginlog($user->ID, $this->input->ip_address(), true);

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

		if (password_verify($this->input->post('password'), $user_info->password)) {
			$data = array(
				'ID' => $uid,
				'password' => password_hash($this->input->post('newpassword'), PASSWORD_BCRYPT),
				'name' => $this->input->post('name'),
			//	'email' => $this->input->post('email'),
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

<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
    }

	public function index()
	{	
		$data['title'] = "Login page - Swift Studio";
		$this->load->view('pages/login', $data);
	}
	public function log(){
		$checkLogin = $this->login_model->loginAuthentication($this->input->post('email'), $this->input->post('pass'));

		if ($checkLogin){
            $this->session->set_userdata('backend', $checkLogin);
            $ip = $_SERVER['REMOTE_ADDR'];
            $sess_id = $this->session->userdata('backend');

            redirect('Dashboard');
        }else{
        	redirect('Login');
        }
	}
	function logout(){
        unset($_SESSION['backend']);
        redirect('Login');
    }

}
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

        $checkLogin = $this->login_model->loginAuthentication($_POST['email'], $_POST['pass']);
        if ($checkLogin){
            $this->session->set_userdata('backend', $checkLogin);
            $ip = $_SERVER['REMOTE_ADDR'];
            $sess_id = $this->session->userdata('backend');

            $array[] = [
                    'session' => $sess_id,
                    'logado' =>  'sim',
                 ];
            $json['data'] = $array;
            echo json_encode($json, true);
        }else{
            $array[] = ['logado' =>  'nao',];
            $json['data'] = $array;
            echo json_encode($json, true);
        }
	}

	public function logout(){
        unset($_SESSION['backend']);
        redirect('Login');
    }

}

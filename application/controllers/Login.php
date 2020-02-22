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
		$data['title'] = "Login page - Meu dinheiro";
		$this->load->view('pages/login', $data);
	}

    public function cadastrar(){
        $data['title'] = "Cadastrar - Meu dinheiro";
        $this->load->view('pages/cadastrar', $data);
    }

    public function cadastrar_novo()
    {
        $email = $_POST['email'];
        $pass  = $_POST['pass'];
        $tel   = $_POST['tel'];
        $nome  = $_POST['nome'];

        $data = array( 
            'username'   =>  $nome,
            'tel'    =>  $tel,
            'password'   =>  $pass,
            'permission'   =>  1,
            'enabled'   =>  1,
            'email'  => $email
        );
        $this->db->insert('user', $data);

        $user_id = $this->db->insert_id();

        $data_ = array( 
            'user_id'  =>  $user_id
        );
        $this->db->where('id', $user_id);
        $this->db->update('user', $data_);
        
        $this->log($email, $pass);

    }

	public function log($email=null, $pass=null){
        if($email && $pass){
            $checkLogin = $this->login_model->loginAuthentication($email, $pass); 
        }else{
            $checkLogin = $this->login_model->loginAuthentication($_POST['email'], $_POST['pass']);
        }

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

<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
    }

	public function index(){
		return;
	}

	public function loginAuthentication($mail, $pass){

		$query = $this->db->get_where('user', array('email' => $mail, 'password' => $pass))->result();
		
		if (isset($query[0]->id)){
			$currentSession = session_id();
			$clintIpAddress = $this->get_client_ip_server();
			$currentTime = time();

			$session_data = array(
				'userid' => $query[0]->id,
				'username' => $query[0]->username,
            // 'enabled' => $result[0]->enabled,
				'currentSessionId' => $currentSession,
				'clintIpAddress' => $clintIpAddress,
				'currentTime' => $currentTime,
			);
			
			$dt = date('Y-m-d H:i:s');
			$this->db->query("update user set `last_login_date` ='" . $dt . "' where id=" . $query[0]->id);

			return $session_data;
		}
		else
			{
			return false;
		}
	}

	function get_client_ip_server(){
		$ipaddress = '';
		if ($_SERVER['REMOTE_ADDR'])
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';

		return $ipaddress;
	}
}



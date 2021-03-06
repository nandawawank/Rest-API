<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class EmiModel extends CI_Model{
	
	var $client_service = "fortend-client";
	var $auth_key = "mapro";

	public function __construct(){
		parent::__construct();
		$this->load->helper('jsonoutput');
	}

	public function check_auth_client(){
		$client_service = $this->input->get_request_header('Client-Service',TRUE);
		$auth_key =  $this->input->get_request_header('Auth-Key',TRUE);

		if($client_service == $this->client_service && $auth_key == $this->auth_key){
			return true;
		} else{
			return jsonoutput(401,array('status' => 401,'message' => 'Unauthorized.'));
		}
	}

	public function login($uname_dkm, $pass_dkm){
		$q = $this->db->select('pass_dkm,id_dkm')->from('dkm')->where('uname_dkm',$uname_dkm)->get()->row();
		
		if($q == ''){
			return array('status' => 204,'message' => 'Username not found.');
		} else{
			$hashed_password	= $q->pass_dkm;
			$id_dkm				= $q->id_dkm;
				echo $hashed_password." ".$pass_dkm;

			if(hash_equals($hashed_password, crypt($pass_dkm, $hashed_password))){
				$last_login = date('Y-m-d H:i:s');
				$token = crypt(substr(md5(rand()), 0, 7));
				$expired_at = date("Y-m-d H:i:s", strtotime('+12 hours'));

				$this->db->trans_begin();
				$this->db->where('id_dkm',$id_dkm)->update('dkm',array('last_login' => $last_login));
				$this->db->insert('dkm_authentication',array('id_udkm' => $id_dkm, 'token' => $token,'expired_at' => $expired_at));
				if($this->db->trans_status() === FALSE){
					$this->db->trans_rollback();
					return array('status' => 500,'message' => 'Internal server error.');
				} else{
					$this->db->trans_commit();
					return array('status' => 200,'message' => 'Successfully login.','id_dkm' => $id_dkm,'token' => $token);
				}
			} else{
				echo "Wrong Password";
				exit();
				return array('status' => 2014,'message' => 'Wrong password');
			}
		}
	}

	public function logout(){
		$user_id 	= $this->input->get_request_headers('User-ID', TRUE);
		$token		= $this->input->get_request_headers('Authorization', TRUE);
		$this->db->where('id_udkm',$user_id)->where('token',$token)->delete('user_authentication');
		return array('status' => 200,'message' => 'Successfully logout');
	}

	public function auth(){
		$user_id	= $this->input->get_request_headers('User-ID', TRUE);
		$token		= $this->input->get_request_headers('Authorization', TRUE);
		$q			= $this->db->select('expired_at')->from('dkm_authentication')->where('id_udkm',$user_id)->where('token',$token)->get()->row();

		if($q == ''){
			return jsonoutput('401',array('status' => 401,'message' => 'Yoursession has been expired.'));
		} else{
			$updated_at = date('Y-m-d H:i:s');
			$expired_at = date('Y-m-d H:i:s', strtotime('+12 hours'));

			$this->db->where('id_udkm',$user_id)->where('token',$token)->update('dkm_authentication',array('expired_at' => $expired_at,'updated_at' => $updated_at));
			return array('status' => 200,'message' => 'Authorized.');
		}
	}
}
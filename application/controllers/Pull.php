<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Pull extends REST_Controller {

	public function __construct($config = 'rest'){
		parent::__construct($config);
		$this->load->database();
	}

	public function event_get(){
		$id_event = $this->get('id_event');
		if($id_event == ''){
			$event = $this->db->get('event')->result();
		} else{
			$this->db->where('id_event',$id);
			$event = $this->db->get('event')->result();
		}
	}

	public function index_get(){
		$id_dkm = $this->get('id_dkm');
		if($id_dkm == ''){
			$kontak = $this->db->get('dkm')->result();
		} else{
			$this->db->where('id_dkm',$id);
			$kontak = $this->db->get('dkm')->result();
		}
		$this->response($kontak, 200);
	}

	public function event_post(){
		$data = array(
			'id_event'		=> $this->post('id'),
			'nama_event'	=> $this->post('nama'),
			'pemateri'		=> $this->post('pemateri'),
			'lokasi_event'	=> $this->post('lokasi'),
			'tlp_event'		=> $this->post('telpon'),
			'waktu_event'	=> $this->post('waktu')
		);
		$insert = $this->db->insert('event', $data);
		if($insert){
			$this->response($data,200);
		} else{
			$this->response(array('status' => 'fail', 502));
		}

	}

	public function index_post(){
		$data = array(
			'id_dkm'		=> $this->post('id'),
			'uname_dkm'		=> $this->post('username'),
			'pass_dkm'		=> $this->post('password'),
			'alamat_dkm'	=> $this->post('alamat'),
			'tlp_dkm'		=> $this->post('telepon'),
			'email_dkm'		=> $this->post('email'),
			'ketua_dkm'		=> $this->post('ketua'),
			'masjid_dkm'	=> $this->post('masjid')
		);

		$insert = $this->db->insert('dkm',$data);
		if($insert){
			$this->response($data,200);
		} else{
			$this->response(array('status' => 'fail', 502));
		}
	}

	public function event_put(){
		$id_event = $this->put('id');
		$data = array(
			'id_event'		=> $this->put('id'),
			'nama_event'	=> $this->put('nama'),
			'pemateri'		=> $this->put('pemateri'),
			'lokasi_event'	=> $this->put('lokasi'),
			'tlp_event'		=> $this->put('telpon'),
			'waktu_event'	=> $this->put('waktu')
		);

		$this->db->where('id_event', $id_event);
		$update = $this->db->update('event', $data);

		if($update){
			$this->response($data,200);
		} else{
			$this->response(array('status' => 'fail', 502));
		}
	}

	public function index_put(){
		$id_dkm = $this->put('id');
		$data = array(
			'id_dkm'		=> $this->put('id'),
			'uname_dkm'		=> $this->put('username'),
			'pass_dkm'		=> $this->put('password'),
			'alamat_dkm'	=> $this->put('alamat'),
			'tlp_dkm'		=> $this->put('telepon'),
			'email_dkm'		=> $this->put('email'),
			'ketua_dkm'		=> $this->put('ketua'),
			'masjid_dkm'	=> $this->put('masjid')
		);

		$this->db->where('id_dkm',$id_dkm);
		$update = $this->db->update('dkm',$data);
		if($update){
			$this->response($data,200);
		} else{
			$this->response(array('status' => 'fail', 502));
		}
	}

	public function index_delete(){
		$id_dkm = $this->delete('id');
		
		$this->db->where('id_dkm',$id_dkm);
		$delete = $this->db->delete('dkm');
		if($delete){
			$this->response(array('status' => 'success', 201));
		} else{
			$this->response(array('status' => 'fail', 502));
		}
	}
}
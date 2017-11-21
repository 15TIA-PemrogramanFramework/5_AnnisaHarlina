<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Pegawai_model');
	}

	public function index()
	{
		
		
		if(!$this->input->post())
		{
			$this->load->view('login');
		}
		else
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			if($username == 'admin' && $password == 'admin'){
				$this->session->set_userdata('logined', true);
				$this->session->set_userdata('username', 'admin');
				$this->session->set_userdata('status', 'admin');
				redirect("home");
			}
			else{
				$cek_login=$this->Pegawai_model->cek_login(
					$this->input->post('username'),
					$this->input->post('password')
					);

				if(!empty($cek_login))
				{
					$this->session->set_userdata('logined', true);
					$this->session->set_userdata('username',$cek_login->username);
					$this->session->set_userdata('status', 'pegawai');

					redirect("home");
				}
				else 
				{
					$this->session->set_flashdata('gagal',' <div class="alert alert-danger">
						<strong>Gagal Login!</strong> username dan Password Anda Salah.
					</div>');

					redirect("/");
				}
			}
			

		}

	} 
	
	public function logout()
	{
		$this->session->unset_userdata('logined');
		redirect("/");
	} 
}

/* End of file Workflows.php */
/* Location: ./application/controllers/Workflows.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-04-15 00:43:10 */
/* http://harviacode.com */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reg extends CI_Controller {
	public function index()
	{
		if($this->session->userdata('logged_in')==TRUE){
			$header = 'header2.php';
			$link = '/users/show/'.$this->session->userdata('id');
		}
		else{
			$header = 'header.php';
			$link = '/signin';
		}
		$data = array(
					'link' => $link,
					'header' => $header,
					'text' => $this->session->flashdata('message')
		);
		$this->load->view('home',$data);
	}
	public function signin()
	{
		$this->load->view('signin');
	}
	public function register()

	{
		$data = array(
				'errors' => $this->session->flashdata('errors'),
				'logged_in' => $this->session->userdata('logged_in'),
				'button_text' => 'Register',
				'from' => 'register',
			);
		if($data['logged_in']){
		    redirect('/');
			die();
		}
		$this->load->view('register',$data);
	}
	public function signup()
	{
		date_default_timezone_set('America/Los_Angeles');
		$this->load->model('User');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[dashboard_users.email]');
		$this->form_validation->set_rules('first_name', 'First Name', 'required|alpha');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|alpha');
		$this->form_validation->set_rules('password', 'Password', 'required|alpha_dash');
		$this->form_validation->set_rules('pass_confirm', 'Password Confirmation', 'required|matches[password]');
		if($this->form_validation->run()){
			if(!$this->User->check_empty_table()){
				$user_level = 9;
			}else{
				$user_level = 1;
			}
			$email = $this->input->post('email');
			$firstname = $this->input->post('first_name');
			$lastname = $this->input->post('last_name');
			$password = md5($this->input->post('password') . 'asdf' . date('Y-m-d H:i:s'));
			$created = date('Y-m-d H:i:s');
			$data = array($email, $firstname, $lastname, $password, $user_level, $created);
			$this->User->add_user($data);
			$this->session->set_flashdata('message', 'User Successfully Registered');
			redirect('/');
		}else{
			$errors = array(
						'email_error' => form_error('email'),
						'first_name_error' => form_error('first_name'),
						'last_name_error' => form_error('last_name'),
						'password_error' => form_error('password'),
						'pass_confirm_error' => form_error('pass_confirm')
					);
			$this->session->set_flashdata('errors', $errors);
		}
		if($this->input->post('from') == 'admin_add'){
			redirect('/users/new');
		}else{
			redirect('/register');
		}
	}
	public function login(){
		$email = $this->input->post('email');
		$half = $this->input->post('password');
		$this->load->model('User');
		$user = $this->User->get_user_by_email($email);
		$password = md5($half . 'asdf' . $user['created_at']);


		if($user) {
			if($user["password"] == $password) {
				$data = array(
					'id' => $user['id'],
					'email' => $user['email'],
					'first_name' => $user['first_name'],
					'last_name' => $user['last_name'],
					'user_level' => $user['user_level'],
					'logged_in' => TRUE
				);
				$this->session->set_userdata($data);
				redirect('/users/show/'.$user['id']);
			} else {
				$this->session->set_flashdata('message', 'Invalid Email and/or Password');
				redirect('/signin');
			}
		} else {
			$this->session->set_flashdata('message', 'Invalid Email and/or Password');
			redirect('/signin');
		}
	}
	public function logoff(){
		$this->session->sess_destroy();
		redirect('/');
	}
}

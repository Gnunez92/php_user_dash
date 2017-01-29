<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	public function show($id = null)
	{
		if(!$this->session->userdata('logged_in')){
		    redirect('/');
		}
		if(!$id){
			$id = $this->session->userdata('id');
		}
		$this->load->model('User');
		$this->load->model('Text');
		$data = $this->User->get_user_profile($id);
		$data['messages'] = $this->Text->get_messages_by_id($id);
		foreach($data['messages'] as $message){
			$data['comments'][$message['id']] = $this->Text->get_comments_by_message_id($message['id']);
		}
		$data['created_at'] = date('F jS Y', strtotime($data['created_at']));
		$this->load->view('profile',$data);
	}
	public function new()
	{
		$data = array(
			'user' => $this->session->userdata(),
			'errors' => $this->session->flashdata('errors'),
			'button_text' => 'Create',
			'from' => 'admin_add'
		);
		if($data['user']['user_level'] != '9'){
				redirect('/');
				die();
		}
		$this->load->view('admin_add', $data);
	}
	public function edit($id = null)
	{
		$this->load->model('User');
		$data = array( 'user' => $this->session->userdata(),
						'message' => $this->session->flashdata('message'));
		if(!$this->session->userdata('logged_in')){
			redirect('/');
		}
		if($this->session->userdata('user_level') == '9' && $this->User->get_user_by_id($id)){
			$data['to_edit'] = $this->User->get_user_by_id($id);
			$this->load->view('admin_edit', $data);
		}elseif($id){
			redirect('/');
		}else{
			$data['to_edit'] = $this->User->get_user_by_id($data['user']['id']);
			$this->load->view('profile_edit', $data);
		}
	}
	public function update()
	{
		date_default_timezone_set('America/Los_Angeles');
		$this->load->model('User');
		if($this->input->post('update') == 'info'){
			$data = array(
					$this->input->post('email'), $this->input->post('first_name'),
					$this->input->post('last_name'),
					date("Y-m-d H:i:s"),
					$this->input->post('id')
			);
			$this->User->update_info($data);
			if($this->input->post('user_level')){
				$temp = array(
					$this->input->post('user_level'),
					date("Y-m-d H:i:s"),
					$this->input->post('id'));
				$this->User->change_user_level($temp);
			}
		}
		elseif($this->input->post('update') == 'password'){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('password', 'Password', 'required|alpha_dash');
			$this->form_validation->set_rules('pass_confirm', 'Password Confirmation', 'required|matches[password]');
			if($this->form_validation->run()){
				$user = $this->User->get_user_profile($this->input->post('id'));
				$now = date("Y-m-d H:i:s");
				$newpass = md5($this->input->post('password') . 'asdf' .$user['created_at']);
				$this->User->update_password(array($newpass, $now, $this->input->post('id')));
				$this->session->set_flashdata('message', 'Success');
				if($this->session->userdata('user_level') == '9'){
					redirect('/users/edit/'.$this->input->post('id'));
				}else{
					redirect('/users/edit/');
				}
			}else{
				$this->session->set_flashdata('message', validation_errors());
				if($this->session->userdata('user_level') == '9'){
					redirect('/users/edit/'.$this->input->post('id'));
				}else{
					redirect('/users/edit/');
				}
			}
		}elseif($this->input->post('update') == 'description'){
				$data = array(
							$this->input->post('description'),
							date("Y-m-d H:i:s"),
							$this->input->post('id')
						);
				$this->User->update_desc($data);
				redirect('/users/show/');
		}
	}
	public function remove($id){
		$this->load->model('User');
		if($this->session->userdata('user_level') != '9'){
			redirect('/');
		}
		$data = $this->User->get_user_profile($id);
		$data['created_at'] = date('F jS Y', strtotime($data['created_at']));
		$this->load->view('remove_conf',$data);
	}
	public function delete($id){
		if($this->session->userdata('user_level') != '9'){
			redirect('/');
		}
		$this->load->model('User');
		$this->User->delete_user($id);
	}
}

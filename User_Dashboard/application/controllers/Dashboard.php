<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function index(){
        if(!$this->session->userdata('logged_in')){
            redirect('/');
        }
        if($this->session->userdata('user_level') == '9'){
            redirect('/dashboard/admin');
        }
        $this->load->model('User');
        $data = array(
                    'user' => $this->session->userdata(),
                    'tabledata' =>$this->User->get_all_users()
                    );
        $this->load->view('user_dash',$data);
    }
    public function admin(){
        if(!$this->session->userdata('logged_in') || $this->session->userdata('user_level') != '9'){
            redirect('/');
        }
        $this->load->model('User');
        $data = array(
                'user' => $this->session->userdata(),
                'tabledata' => $this->User->get_all_users()
                );
        $this->load->view('admin_dash',$data);
    }
}

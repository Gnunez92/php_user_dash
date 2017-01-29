<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Texts extends CI_Controller {
    public function new_message(){
        if($this->input->post('message')){
            $this->load->model('Text');
            $data = array(
                'message' => $this->input->post('message'),
                'user_id' => $this->input->post('id'),
                'posted_by' => $this->session->userdata('id')
            );
            $this->Text->add_message($data);
        }
        redirect('/users/show/'.$this->input->post('id'));
    }
    public function new_comment(){
        if($this->input->post('comment') && $this->input->post('comment') != 'Leave a comment'){
            $this->load->model('Text');
            $data= array(
                'comment' => $this->input->post('comment'),
                'message_id' => $this->input->post('message_id'),
                'posted_by' => $this->session->userdata('id')
                );
            $this->Text->add_comment($data);
        }
        redirect('/users/show/'.$this->input->post('id'));
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petemail extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('Pet');
    }

    public function send_mail(){
        //configuration for smtp
        // $config = array();
        $config['useragent'] = 'CodeIgniter';
        $config['protocol'] = 'smtp';
        //$config['mailpath'] = '/usr/sbin/sendmail';
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        $config['smtp_user'] = 'lokiprime4420@gmail.com';
        $config['smtp_pass'] = '09208354057';
        $config['smtp_port'] = 465; 
        $config['smtp_timeout'] = 5;
        $config['wordwrap'] = TRUE;
        $config['wrapchars'] = 76;
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['validate'] = FALSE;
        $config['priority'] = 3;
        $config['crlf'] = "\r\n";
        $config['newline'] = "\r\n";
        $config['bcc_batch_mode'] = FALSE;
        $config['bcc_batch_size'] = 200;
        // $this->email->initialize($config);
        // $this->email->set_newline("\r\n");

        extract($_SESSION['user']);
        $code = $this->Pet->get_code($email);
        $from_email = $email;
        $to_email = 'lokiprime4420@gmail.com';
        //Load email library
        $this->load->library('email', $config); // Note: no $config param needed
        $this->email->from($from_email, $from_email);
        $this->email->to($to_email);
        $this->email->subject('Confirmation Code for ');
        $this->email->message('Ampogi mo sobra. This is your code ' .$code);
        $this->email->send();
        //Send mail
        if($this->email->send()){
            $this->session->set_flashdata("email_sent","Congragulation Email Send Successfully.");
        }else{
            $this->session->set_flashdata("email_sent","You have encountered an error");
        }
        // redirect('/pets/login');
        
    }

    public function edit($id){
        $data = $this->input->post();
        $data['id'] = $id;
        $this->Pet->update_pet($data);
        redirect('pets/pet');
    }

    public function uploadPicofPet($petid){
        //extract user to use for database
		extract($_SESSION['user']);
        // make directory if not existing yet
        if(!is_dir('./images/'.$email.'/pets/')){
			mkdir('./images/'.$email.'/pets/', 0777, true);
		}
		//configuration for picture upload
		$the_path_for_images = './images/'.$email.'/pets';
		$config['upload_path'] = $the_path_for_images;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 5000;
        $config['max_width'] = 5500;
        $config['max_height'] = 5500;

		// load library for uploading
		$this->load->library('upload', $config);
		//check for errors
		if (!$this->upload->do_upload('image')) {
            $error = array('error' => $this->upload->display_errors());
            var_dump($error);
			$this->load->view('pet/pet', $error);
        } else {
			$data = array(
				'user_id' => $id,
                'pet_id' => $petid,
				'path' => $the_path_for_images,
				'image_name' => $this->upload->data('file_name'),
				'type' => 'pet_profile'
			);
			$picture = $this->Pet->add_pet_picture($data);
            $this->Pet->update_pet_pic($data);
			$this->session->set_flashdata('message', 'Success! You just uploaded your profile picture!');
			redirect('/pets/pet');
            // var_dump($data);
			// $this->load->view('pet/pet');
        }
    }


}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	public function index(){
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|alpha|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'alpha|required');
        $this->form_validation->set_rules('contact', 'Contact Number', 'is_unique[users.contact]|numeric|trim|required');
        $this->form_validation->set_rules('password', 'Password', 'min_length[8]|required');
        $this->form_validation->set_rules('confirm', 'Confirm Password', 'matches[password]|required');
        if($this->form_validation->run() === FALSE){
			$this->load->view('auth/register');
		}
	}
	
	public function login(){
		$this->load->model('User');
		$contact = $this->input->post('contact');
		$password_from_input_field = $this->input->post('password');
		$salt = $this->User->get_salt($contact);
		$password_from_table = $this->User->get_password($contact);
		$contact_from_table = $this->User->login_user($contact);
		$password_from_input_field = md5($password_from_input_field.$salt);
		if($contact_from_table){
			$this->session->set_userdata('user', $contact_from_table );
		}
		if($password_from_input_field != $password_from_table){
			redirect('/users');
		}else{
			echo 'Hooray';
		}
		$this->load->view('auth/profile');
	}

	public function validate(){
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|alpha|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'alpha|required');
		$this->form_validation->set_rules('contact', 'Contact Number', 'is_unique[users.contact]|numeric|trim|required');
		$this->form_validation->set_rules('password', 'Password', 'min_length[8]|required');
		$this->form_validation->set_rules('confirm', 'Confirm Password', 'matches[password]|required');
		if($this->form_validation->run() === FALSE){
			$this->load->view('auth/register');
			// redirect('/users');
		}else{
			$this->load->model('User');
			$first_name = $this->input->post('first_name');
			$last_name = $this->input->post('last_name');
			$contact = $this->input->post('contact');
			$password = $this->input->post('password');
			$salt = bin2hex(openssl_random_pseudo_bytes(22));
			$encrypted_password = md5($password . '' . $salt);
			$user_array = array(
				'first_name' => $first_name, 
				'last_name' => $last_name, 
				'contact' => $contact, 
				'password' => $encrypted_password,
				'salt' => $salt);
			$this->User->add_user($user_array);
			redirect('/users');
		}
	}
	public function logout(){
		$this->session->unset_userdata('user');
		redirect('/users');
	}

	public function new(){
		$this->load->view('phonebook/new');
	}
	
	public function edit($id){
		$this->load->Model('Contact');
		$show_one_data['data'] = $this->Contact->get_contact_by_id($id);
		$this->load->view('phonebook/edit', $show_one_data);
		
	}

	public function show($id){
		$this->load->Model('Contact');
		$show_one_data['data'] = $this->Contact->get_contact_by_id($id);
		$this->load->view('phonebook/show', $show_one_data);
	}
	
	public function create(){
		//handle post data here and redirect to contacts mah brutha
		$this->load->model('Contact');
		$name = $this->input->post('name');
		$contact = $this->input->post('contact');
		$contact_array = array('name' => $name, 'contact' => $contact);
		$create_contact = $this->Contact->add_contact($contact_array);
		redirect('/contacts');
	}
	
	public function destroy($id){
		//handle the post data from index to remove and redirect to contacts mah brutha
		$this->load->model('Contact');
		$this->Contact->delete_contact($id);
		redirect('/contacts');
	}

	public function update($id){
		//edit the info here redirect to contacts after mah brutha
		$this->load->model('Contact');
		$contact_id = $id;
		$name = $this->input->post('name');
		$contact = $this->input->post('contact');
		$contact = array('name' => $name, 'contact' => $contact, 'id' => $id);
		$updated_contact = $this->Contact->update_contact($contact);
		redirect('/contacts');
	}

	public function add(){
		$this->load->model('Bookmark');
		$name = $this->input->post('name');
		$url = $this->input->post('URL');
		$folder = $this->input->post('folder');
		$bookmark_array = array('name' => $name, 'url' => $url, 'folder' => $folder);
		$add_bookmark = $this->Bookmark->add_bookmark($bookmark_array);
		if($add_bookmark === TRUE){
			$this->session->set_userdata('message', 'Bookmark added!');
			$message['message'] = $this->session->userdata('message');
			$this->index();
		}
	}
	


	// public function add(){
	// 	$this->load->model('Bookmark');
	// 	$name = $this->input->post('name');
	// 	$url = $this->input->post('URL');
	// 	$folder = $this->input->post('folder');
	// 	$bookmark_array = array('name' => $name, 'url' => $url, 'folder' => $folder);
	// 	$add_bookmark = $this->Bookmark->add_bookmark($bookmark_array);
	// 	if($add_bookmark === TRUE){
	// 		$this->session->set_userdata('message', 'Bookmark added!');
	// 		$message['message'] = $this->session->userdata('message');
	// 		$this->index();
	// 	}
	// }


	public function show1($id){
		$this->load->model("Bookmark");
		$bookmark_id = $id;
		$bookmark = $this->Bookmark->get_bookmark_by_id($bookmark_id);
		return $bookmark;
	}

	public function delete($id){
		$this->load->model("Bookmark");
		$bookmark_id = $id;
		$this->Bookmark->delete_bookmark($bookmark_id);
		redirect('bookmarks/index');
	}


}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pets extends CI_Controller {
    public function index(){
        $this->load->view('pet/landing');
    }
	//show view of pet owners to see list of clinics 
    public function clinic(){
		$this->load->model('Pet');
		$clinics_array['data'] = $this->Pet->get_all_clinics();
        $this->load->view('pet/show/clinic', $clinics_array);
    }

	public function get_clinic($id){

		// $data = array(
		// 	'user_id' => $_SESSION['user']['id'],
		// 	'type' => 'profile'
		// );
		$this->load->model('Pet');
		$client_id = $this->Pet->get_user_id_for_show_clinic($id);
		$clinics_array['email_ni_clinic'] = $this->Pet->get_email_for_session_in_show_clinic($client_id);
		$clinics_array['data'] = $this->Pet->get_clinic_by_id($id);
		$clinics_array['products'] = $this->Pet->get_all_products_via_clinic_id($id);
		$clinics_array['services'] = $this->Pet->get_all_services_via_clinic_id($id);
		$prefs = array(
			'show_next_prev'  => TRUE,
        	'next_prev_url'   => 'http://localhost/pets/get/'.$id.'/',
			'start_day'    => 'saturday',
			'month_type'   => 'long',
			'day_type'     => 'long'
		);	
		$this->load->library('calendar', $prefs);
		$year = $this->uri->segment(4);
		$month = $this->uri->segment(5);
		$clinics_array['calendar'] = $this->calendar->generate($year, $month);
		$this->load->view('pet/clinic_show', $clinics_array);
	}

	public function get($id){

		$data = array(
			'user_id' => $_SESSION['user']['id'],
			'type' => 'profile'
		);
		$this->load->model('Pet');
		$client_id = $this->Pet->get_user_id_for_show_clinic($id);
		$profile['profile'] = $this->Pet->get_profile_picture($data);
		$this->session->set_userdata('picture', $profile);
		$clinics_array['email_ni_clinic'] = $this->Pet->get_email_for_session_in_show_clinic($client_id);
		$clinics_array['pets'] = $this->Pet->get_pets_of_users_by_id($_SESSION['user']['id']);
		$clinics_array['data'] = $this->Pet->get_clinic_by_id($id);
		$clinics_array['products'] = $this->Pet->get_all_products_via_clinic_id($id);
		$clinics_array['services'] = $this->Pet->get_all_services_via_clinic_id($id);
		$prefs = array(
			'show_next_prev'  => TRUE,
        	'next_prev_url'   => 'http://localhost/pets/get/'.$id.'/',
			'start_day'    => 'saturday',
			'month_type'   => 'long',
			'day_type'     => 'long'
		);	
		$this->load->library('calendar', $prefs);
		$year = $this->uri->segment(4);
		$month = $this->uri->segment(5);
		$clinics_array['calendar'] = $this->calendar->generate($year, $month);
		$this->load->view('pet/show_clinic', $clinics_array);
	}

	//load the view for registration
    public function signup(){
        $this->load->view('pet/signup');
    }

	//method for registration validations and loading it to the model
	public function validate(){
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|alpha|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|alpha|required');
		$this->form_validation->set_rules('email', 'Email', 'is_unique[users.email]|valid_email|trim|required');
		$this->form_validation->set_rules('password', 'Password', 'min_length[8]|required');
		$this->form_validation->set_rules('confirm', 'Confirm Password', 'matches[password]|required');
		if($this->form_validation->run() === FALSE){
			$this->load->view('pet/signup');
		}else{
			$this->load->model('Pet');
			$type = $this->input->post('type');
			$first_name = $this->input->post('first_name');
			$last_name = $this->input->post('last_name');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$salt = bin2hex(openssl_random_pseudo_bytes(22));
			$encrypted_password = md5($password . '' . $salt);
			// sending email if all fields are correct
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

        $code = mt_rand(1111,9999);
        $from_email = 'lokiprime4420@gmail.com';
        $to_email = $email;
        //Load email library
        $this->load->library('email', $config); // Note: no $config param needed
        $this->email->from($from_email);
        $this->email->to($to_email);
        $this->email->subject('Confirmation Code for ePetCare');
        $this->email->message(' This is your code ' .$code);
        $this->email->send();
        //Send mail
        if($this->email->send()){
            $this->session->set_flashdata("email_sent","Congragulations Email Send Successfully.");
        }else{
            $this->session->set_flashdata("email_sent","You have encountered an error");
        }
		$user_array = array(
			'first_name' => $first_name, 
			'last_name' => $last_name, 
			'email' => $email, 
			'password' => $encrypted_password,
			'salt' => $salt,
			'type' => $type,
			'code' => $code
		);
		
		$this->Pet->add_user($user_array);
		if($this->input->post('type') == '2' || $this->input->post('type') == 2){
			//edit this
			$id_from_ctrl = $this->Pet->get_id_by_email($this->input->post('email'));
			$clinic_array = array(
				'name' => 'Clinic Name',
				'user_id' => $id_from_ctrl,
				'country' => 'Philippines',
				'unit_number' => '1000',
				'street' => 'Juan St.',
				'municipality' => 'Municipality',
				'city' => 'Manila',
				'telephone' => '1002321231',
				'contact' => '0909090912'
			);
			// edit this
			$this->Pet->add_clinic($clinic_array);
		}
			redirect('/pets/login');
		}
	}
	//login view
	public function login(){
		$this->load->Model('Pet');
		$clinics_array['clinics'] = $this->Pet->get_all_clinics();
		if(isset($_SESSION['user'])){
			extract($_SESSION['user']);
			if($type==1 && $is_verified==1){
				$this->load->view('pet/owner', $clinics_array);
			}else if($type == 2 && $is_verified==1){
				//start session for clinic
				$data['clinic'] = $this->Pet->get_clinic_by_user_id($id);
				$this->session->set_userdata('klinik', $data['clinic']['id']);
				$_SESSION['klinik'] = $this->session->userdata('klinik');
				$data['products'] = $this->Pet->get_all_products_via_clinic_id($_SESSION['klinik']);
				$data['services'] = $this->Pet->get_all_services_via_clinic_id($_SESSION['klinik']);
				$data['employee'] = $this->Pet->get_all_employees($_SESSION['user']['id']);
				$this->load->view('pet/vet', $data);
			}else{
				$this->load->view('pet/confirmation');
			}
		}else{
			$this->load->view('pet/login');
		}
	}

	//method for logging users in
	public function login_users(){
		$this->load->model('Pet');
		if(isset($_SESSION['user'])){
			extract($_SESSION['user']);
			var_dump($is_verified);
			if($type==1 && $is_verified==1){
				$this->load->view('pet/owner');
			}else if($type == 2 && $is_verified==1){
				$data['clinic'] = $this->Pet->get_clinic_by_user_id($id);
				$data['products'] = $this->Pet->get_all_products_via_clinic_id($_SESSION['klinik']);
				$data['services'] = $this->Pet->get_all_services_via_clinic_id($_SESSION['klinik']);
				$data['clinic'] = $this->Pet->get_clinic_by_user_id($_SESSION['user']['id']);
				$this->load->view('pet/vet', $data);
			}else{
				$this->load->view('pet/confirmation');
			}
		}
		//load model for database
		$this->load->model('Pet');
		//set validation rules
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if($this->form_validation->run() === FALSE){
			$this->load->view('pet/login');
		}else{
		$email = $this->input->post('email');
		$password_from_input_field = $this->input->post('password');
		$salt = $this->Pet->get_salt($email);
		$password_from_table = $this->Pet->get_password($email);
		$email_from_table = $this->Pet->login_user($email);
		$password_from_input_field = md5($password_from_input_field.$salt);
		// get type to correctly redirect users
		$type = $this->Pet->get_type($email);
			if($email_from_table == NULL){
				// $this->session->set_userdata('user', $email_from_table );
			}
			if($password_from_input_field != $password_from_table){
				$this->session->set_flashdata('password', 'Wrong password');
				$this->session->set_flashdata('email', $email);
				redirect('/pets/login');
			}else if($type == 1){
				$this->session->set_userdata('user', $email_from_table );
				$_SESSION['user'] = $this->session->userdata('user');
				if(isset($_SESSION['user'])){
					extract($_SESSION['user']);
					//data to pass to model
					$data = array(
						'user_id' => $id,
						'type' => 'profile'
					);
					//call method from model
					$profile['profile'] = $this->Pet->get_profile_picture($data);
					$this->session->set_userdata('picture', $profile);
				}
				// $this->load->view('pet/owner');
				// return true;
				header('Location: '.base_url().'pets/login');
			}else{
				//load view to vet
				$this->session->set_userdata('user', $email_from_table );
				$_SESSION['user'] = $this->session->userdata('user');
				if(isset($_SESSION['user'])){
					extract($_SESSION['user']);
					$clinic['clinic'] = $this->Pet->get_clinic_by_id($id);
					//data to pass to model
					$data = array(
						'user_id' => $id,
						'type' => 'profile'
					);
					//call method from model
					$profile['profile'] = $this->Pet->get_profile_picture($data);
					$this->session->set_userdata('picture', $profile);
				}
				// $this->load->view('pet/vet');
				// return false;
				header('Location: '.base_url().'pets/login');
			}
		}
	}

	//show the pets inside the owners.php view page
	public function pet(){
		//extract user session for database
		extract($_SESSION['user']);
		//load model 
		$this->load->model('Pet');
		//data to pass to model
		$data = array(
			'user_id' => $id,
			'type' => 'profile'
		);
		//call method from model
		$profile['profile'] = $this->Pet->get_profile_picture($data);
		$this->session->set_userdata('picture', $profile);

		if(isset($_SESSION['user'])){
			$peta['peta'] = $this->Pet->get_pets_of_users_by_id($id);
			$peta2['picha'] = $this->Pet->get_pet_profile_picture($data);
			$new_array = array_merge($peta,$peta2);
			// echo "<pre>";
			// // var_dump($peta);
			// var_dump($new_array);
			// echo "</pre>";
			$this->load->view('pet/pet', $new_array);
		}else{
			redirect('/pets/login');
		}
	}

	//show profile of the users
	public function profile(){
		//extract user session for database
		extract($_SESSION['user']);
		//load model 
		$this->load->model('Pet');
		//data to pass to model
		$data = array(
			'user_id' => $id,
			'type' => 'profile'
		);
		//call method from model
		$profile['profile'] = $this->Pet->get_profile_picture($data);
		if(isset($_SESSION['user'])){
			if($type == 1){
				$this->load->view('pet/profile', $profile);
			}else{

			}
		}else{
			redirect('/pets/login');
		}
	}

	public function upload(){
		//extract user to use for database
		extract($_SESSION['user']);
		//make directory if not created yet 
		if(!is_dir('./images/'.$email.'/profile')){
			mkdir('./images/'.$email.'/profile');
		}
		//configuration for picture upload
		$the_path_for_images = './images/'.$email.'/profile';
		$config['upload_path'] = $the_path_for_images;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 5000;
        $config['max_width'] = 5500;
        $config['max_height'] = 5500;
		//load model
		$this->load->model('Pet');
		// load library for uploading
		$this->load->library('upload', $config);
		//check for errors
		if (!$this->upload->do_upload('profile_image')) {
            $error = array('error' => $this->upload->display_errors());
			$this->load->view('pet/profile', $error);
        } else {
			$data = array(
				'user_id' => $id,
				'path' => $the_path_for_images,
				'image_name' => $this->upload->data('file_name'),
				'type' => 'profile'
			);
			$picture = $this->Pet->add_picture($data);
			$this->session->set_flashdata('message', 'Success! You just uploaded your profile picture!');
			// redirect('/pets/profile');
			$this->profile();
        }
	}

	public function show_orders(){
		$this->load->model('Pet');
		$orders['order'] = $this->Pet->show_order_by_user_id($_SESSION['user']['id']);
		$this->load->view('pet/show_order', $orders);
	}

	public function items(){
		$this->load->model('Pet');
		$orders['orders'] = $this->Pet->get_paid_orders($_SESSION['user']['id']);
		$this->load->view('pet/items', $orders);
	}

	public function your_clinic(){
		$this->load->model('Pet');
		$appointments['appointments'] = $this->Pet->get_appointments($_SESSION['user']['id']);
		// calendar
		$prefs = array(
			'show_next_prev'  => TRUE,
        	'next_prev_url'   => 'http://localhost/pets/your_clinic',
			'start_day'    => 'saturday',
			'month_type'   => 'long',
			'day_type'     => 'long'
		);

		$this->load->library('calendar', $prefs);
		$year = $this->uri->segment(3);
		$month = $this->uri->segment(4);
		$appointments['calendar'] = $this->calendar->generate($year, $month);
		$this->load->view('pet/your_clinic', $appointments);
	}

	public function pet_history(){
		$this->load->model('Pet');
		$pet['history'] = $this->Pet->load_pet_history($_SESSION['user']['id']);
		$this->load->view('pet/pet_history', $pet);
	}


	//logouts sessions
	public function logout(){
		$this->session->unset_userdata('user');
		$this->session->unset_userdata('picture');
		$this->session->unset_userdata('clinic');
		// $this->session->sess_destroy();
		redirect('/');
	}

	

	public function terms(){
		$this->load->view('pet/terms');
	}

	public function location(){
		$this->load->model('Pet');
		$data['data'] = $this->Pet->get_all_clinics_by_city($this->input->post('city'));
		echo json_encode($data);
	}
}

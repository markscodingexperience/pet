<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('vendor/stripe/stripe-php/init.php');
require_once('vendor/autoload.php');
class Petshits extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('Pet');
    }

    public function add_pet(){
        //validation
        $birthdate = $this->input->post('birth');
        if(date_create($birthdate) >= date_create(date("Y-m-d"))){
            $this->session->set_flashdata('error', 'The birthdate should not be in the future');
        }else{
            //add user id to pet post data
            $user_id = $_SESSION['user']['id'];
            $data = $this->input->post();
            $data['user_id'] = $user_id;
            $data = $this->Pet->add_pet($data);
            redirect('pets/pet');
        }
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

    public function confirm(){
        $code = $this->Pet->get_code($this->input->post('email'));
        if($code != $this->input->post('code')){
            $this->session->set_flashdata('code', 'Wrong Code!');
            $this->Pet->update_code($this->input->post('email'));
            // send updated code
            $this->send_mail();
            // redirect to confirmation
            $this->session->set_flashdata('confirm_wrong', "Wrong Code");
            redirect('pets/login');
        }else if($code == $this->input->post('code')){
            echo "correct code!";
            $this->Pet->update_status($this->input->post('email'));
            $this->Pet->get_verify($this->input->post('email'));
            redirect('pets/logout');
        }
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
        // redirect('/pets/login');
        
    }

    public function services(){
        $data['services'] = $this->Pet->get_all_services_via_clinic_id($_SESSION['klinik']);
        $this->load->view('pet/services', $data);
    }

    public function add_services(){
        // var_dump($this->input->post());
        if($this->input->post('minute') == '' || $this->input->post('minute') == NULL){
            $this->input->post('minute') == '00';
        }
        $data = array(
            'clinic_id' => $_SESSION['klinik'],
            'name' => $this->input->post('service'),
            'hour' => $this->input->post('hour'),
            'minute' => $this->input->post('minute'),
            'price' => $this->input->post('price')
        );
        $this->Pet->add_service($data);
        $this->session->set_flashdata('clinic_success', 'You successfully added a service!');
        redirect('/petshits/services');
    }

    public function update_services($id){
        $data = array(
            'id' => $id,
            'name' => $this->input->post('service'),
            'hour' => $this->input->post('hour'),
            'minute' => $this->input->post('minute'),
            'price' => $this->input->post('price')
        );
        $this->Pet->update_service($data);
        $this->session->set_flashdata('clinic_success', 'You successfully updated a service!');
        redirect('/petshits/services');
    }

    public function edit_clinics(){

            //extract session here
            extract($_SESSION['user']);
            //check clinic via email
            // $clinic['clinic'] = $this->Pet->get_clinic_by_id($id);
            // // $ur_clinic['urclinic'] = $this->Pet->get_clinic_by_id($id);
            // $this->session->set_userdata('clinic', $clinic);
            // if ($ur_clinic['urclinic']) {
            //     $this->load->view('pet/vet', $ur_clinic);
            // }

                $schedule = implode(", ", $_POST['schedule']);
            
            $data = array(
                'name' => $this->input->post('name'),
                'user_id' => $id,
                'country' => $this->input->post('country'),
                'unit_number' => $this->input->post('unit_number'),
                'street' => $this->input->post('street'),
                'municipality' => $this->input->post('municipality'),
                'city' => $this->input->post('city'),
                'telephone' => $this->input->post('telephone'),
                'contact' => $this->input->post('contact'),
                'schedule' => $schedule,
                'mondayopening' => $this->input->post('mondayopening'),
                'mondayclosing' => $this->input->post('mondayclosing'),
                // 'tuesday' => $this->input->post('tuesday'),
                'tuesdayopening' => $this->input->post('tuesdayopening'),
                'tuesdayclosing' => $this->input->post('tuesdayclosing'),
                // 'wednesday' => $this->input->post('wednesday'),
                'wednesdayopening' => $this->input->post('wednesdayopening'),
                'wednesdayclosing' => $this->input->post('wednesdayclosing'),
                // 'thursday' => $this->input->post('thursday'),
                'thursdayopening' => $this->input->post('thursdayopening'),
                'thursdayclosing' => $this->input->post('thursdayclosing'),
                // 'friday' => $this->input->post('friday'),
                'fridayopening' => $this->input->post('fridayopening'),
                'fridayclosing' => $this->input->post('fridayclosing'),
                // 'saturday' => $this->input->post('saturday'),
                'saturdayopening' => $this->input->post('saturdayopening'),
                'saturdayclosing' => $this->input->post('saturdayclosing'),
                // 'sunday' => $this->input->post('sunday'),
                'sundayopening' => $this->input->post('sundayopening'),
                'sundayclosing' => $this->input->post('sundayclosing')
            );
            $this->Pet->update_clinic($data);
            
            // echo "<pre>";
            // var_dump($this->input->post());
            // echo "</pre>";
            // $this->load->view('pet/vet', $data);
            header('Location: '.base_url().'pets/login');
        
    }

    public function products(){
        $data['services'] = $this->Pet->get_all_products_via_clinic_id($_SESSION['klinik']);
        $this->load->view('pet/products', $data);
    }

    public function add_products(){
        // array of data to pass on to the model
        $data = array(
            'clinic_id' => $_SESSION['klinik'],
            'product_name' => $this->input->post('product_name'),
            'brand' => $this->input->post('brand'),
            'price' => $this->input->post('price'),
            'quantity' => $this->input->post('quantity'),
            'description' => $this->input->post('description')
        );
        $this->Pet->add_product($data);
        $this->session->set_flashdata('clinic_success', 'You successfully added a product!');
        redirect('/petshits/products');
    }

    public function update_products($id){
        $data = array(
            'id' => $id,
            'product_name' => $this->input->post('product_name'),
            'brand' => $this->input->post('brand'),
            'price' => $this->input->post('price'),
            'quantity' => $this->input->post('quantity'),
            'description' => $this->input->post('description')
        );
        $this->Pet->update_product_by_id($data);
        $this->session->set_flashdata('clinic_success', 'You successfully updated a product!');
        redirect('/petshits/products');
    }

    public function uploadPicofProduct($productid){
        //extract user to use for database
		extract($_SESSION['user']);
        // make directory if not existing yet
        if(!is_dir('./images/'.$email.'/product/')){
			mkdir('./images/'.$email.'/product/', 0777, true);
		}
		//configuration for picture upload
		$the_path_for_images = './images/';
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
			$this->load->view('pet/products', $error);
        } else {
			$data = array(
				'id' => $productid,
				'image' => $this->upload->data('file_name'),
                'path' => $the_path_for_images,
			);
            $this->Pet->update_product_pic($data);
			// $this->session->set_flashdata('message', 'Success! You just uploaded your profile picture!');
			redirect('/petshits/products');
            // var_dump($data);
			// $this->load->view('pet/pet');
        }
    }

    // employees page of clinic owner view
    public function employees(){
        $data['clinic'] = $this->Pet->get_clinic_by_user_id($_SESSION['user']['id']);
        $data['employee'] = $this->Pet->get_all_employees($_SESSION['user']['id']);
        $this->load->view('pet/employees', $data);
        // var_dump($data);
    }

    public function add_employees(){
        
        // array of data to pass on to the model
        $employee = array(
            'user_id' => $_SESSION['user']['id'],
            'clinic_id' => $_SESSION['klinik'],
            'email' => $this->input->post('email_employee'),
            'name' => $this->input->post('first_name_employee').' '.$this->input->post('last_name_employee'),
            'role' => $this->input->post('role_employee'),
        );

        $user = array(
            'first_name' => $this->input->post('first_name_employee'),
            'last_name' => $this->input->post('last_name_employee'),
            'role' => $this->input->post('role_employee'),
            'email' => $this->input->post('email_employee'),
            'password' => $this->input->post('password_employee'),
        );
        $this->Pet->add_user_via_clinic_owner($user);
        $this->Pet->add_employee($employee);
        $this->session->set_flashdata('clinic_success', 'You successfully added an employee');
        redirect('/petshits/employees');
    }

    public function update_employees($employees){
        $employee = array(
            'id' => $employees,
            'role' => $this->input->post('role_employee'),
        );
        $user = array(
            'email' => $this->input->post('email'),
            'type' => $this->input->post('role_employee'),
        );
        $this->Pet->update_employee_by_id($employee);
        $this->Pet->update_users_table_role_type($user);
        $this->session->set_flashdata('clinic_success', 'You successfully updated an employee!');
        redirect('/petshits/employees');
    }

    public function data(){
        $data['data'] = $this->Pet->get_schedule($id);
        echo json_encode($data);
    }
    
    public function set_appointment($id){

        $data = array(
            'user_id' => $_SESSION['user']['id'],
            'clinic_id' => $id,
            'pet_id' => $this->input->post('pet_id'),
            'name' => $this->input->post('name_of_pet_user'),
            'pet' => $this->input->post('pets'),
            'date' => $this->input->post('date'),
            'time' => $this->input->post('time'),
            'note' => $this->input->post('note')
        );
        $this->Pet->add_appointment($data);
        $this->session->set_flashdata('appointment', 'Success! You just set an appointment! Check your clinics to see all your appointments');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function add_to_cart($product_id){
        // var_dump($this->input->post('clinic_id'));
        $data = array(
            'user_id' => $_SESSION['user']['id'],
            'clinic_id' => $this->input->post('clinic_id'),
            'product_id' => $product_id,
            'name' => $_SESSION['user']['first_name'] . ' '. $_SESSION['user']['last_name'],
            'product' => $this->input->post('product_name'),
            'price' => $this->input->post('sub_total_price'),
            'quantity' => $this->input->post('ordered_quantity'),
            'image' => $this->Pet->load_image($product_id),
        );
        $quantity = array(
            'id' => $product_id,
            'quantity' => (int)$this->input->post('quantity')-(int)$this->input->post('ordered_quantity'),
        );
        $this->Pet->add_order($data);
        $this->Pet->update_quantity($quantity);
        $this->session->set_flashdata('appointment', 'Success! You just added a product to your cart!');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function checkout(){
        if($this->input->post('checkout') == NULL || $this->input->post('checkout') == ''){
            redirect('/pets/show_orders');
        }
        $_SESSION['total'] = $this->Pet->calculate_order($this->input->post('checkout'));
        $_SESSION['cart'] = $this->Pet->get_selected_items($this->input->post('checkout'));
        $_SESSION['product_id'] = $this->Pet->get_product_id($this->input->post('checkout'));
        $_SESSION['order_id'] = $this->Pet->get_selected_items_id($this->input->post('checkout'));
        $this->load->view('pet/checkout');
    }

    public function charge(){
		// Set your secret key. Remember to switch to your live secret key in production.
		// See your keys here: https://dashboard.stripe.com/apikeys
		$stripe = \Stripe\Stripe::setApiKey(

            'sk_test_51KeEneFp9N6Yc1V9fAcse0Ew11wz4JQ5DQTPWxuRXGTeayVRpSCOKrkYSbV8N9byzhcdV1krccXcYtDbcCuylY6f00tuWISAar'
            );
		// Token is created using Stripe Checkout or Elements!
		// Get the payment token ID submitted by the form:
		$token = $_POST['stripeToken'];
        $name = $this->input->post('first_name'). ' '. $this->input->post('last_name');
        $email = $_SESSION['user']['email'];
        extract($_SESSION['total']);
		$charge = \Stripe\Charge::create([
			'amount' => (int)$total * 100,
			'currency' => 'php',
			'source' => $token,
			'description' => $this->input->post('description'),
            'receipt_email' => $_SESSION['user']['email'],
            'shipping' => [
                'address' => [
                    'city' => $this->input->post('municipality'),
                    'country' => 'PH',
                    'line1' => 'address here',
                    'postal_code' => 'zip',
                ],
                'name' => $name,
                'carrier' => $this->input->post('courier'),
            ]
		  ]);
            extract($_SESSION['order_id']);
            $order_id =[];
            foreach ($_SESSION['order_id'] as $key => $value) {
                array_push($order_id, $value['id']);
            }
            extract($_SESSION['cart']);
            $data = [
                'amount' => $total,
                'name' => $name,
                'email' => $this->input->post('email_buyer'),
                'user_id' => $_SESSION['user']['id'],
                'order_id' => $order_id,
                'product_id' => $_SESSION['product_id'],
                'clinic_id' => $_SESSION['clinicid'],
                'courier' => $this->input->post('courier'),
                'description' => $this->input->post('description'),
                'line1' => $this->input->post('line1'),
                'line2' => $this->input->post('line2'),
                'postal_code' => $this->input->post('zip'),
                'municipality' => $this->input->post('municipality'),
                'phone' => $this->input->post('telephone'),
            ];
            $is_paid = [
                'id' => $order_id,
                'is_paid' => 'yes',
            ];
            $this->Pet->update_status_of_order($is_paid);
            $this->Pet->insert_payment($data);
		$this->load->view('pet/success', $data);
	}

    public function delete_services($service_id){
        $this->Pet->delete_service($service_id);
        $this->session->set_flashdata('clinic_success', 'You successfully deleted a service!');
        redirect('petshits/services');
    }

    public function upload_pic_for_clinic($id){
        // make directory if not existing yet

		//configuration for picture upload
		$the_path_for_images = './images/';
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
			$this->load->view('pet/products', $error);
        } else {
			$data = array(
				'id' => $id,
				'image' => $this->upload->data('file_name'),
                'path' => $the_path_for_images,
			);
        $this->Pet->upload_picture_for_clinic($data);
        $this->session->set_flashdata('clinic_success', 'You successfully uploaded a picture for your clinic!');
        redirect('pets/login');
    }
}
    public function frontdesk(){
        $clinic['employee'] = $this->Pet->get_clinic_by_id_frontdesk_by_email($_SESSION['user']['email']);
        $clinic['clinic'] = $this->Pet->get_clinic_by_id($clinic['employee']['clinic_id']);
        $clinic['services'] = $this->Pet->get_all_services_via_clinic_id($clinic['employee']['clinic_id']);
        $clinic['products'] = $this->Pet->get_all_products_via_clinic_id($clinic['employee']['clinic_id']);
        $clinic['appointments'] = $this->Pet->get_appointments_for_frontdesk($clinic['employee']['clinic_id']);
        $this->load->view('pet/frontdesk', $clinic);
    }

    public function frontdesk_login(){
        $this->load->view('pet/frontdesk_login');
    }

    public function validate_login_employee(){
        // echo "hello!!";
        if(isset($_SESSION['user'])){
			extract($_SESSION['user']);
			if($type==3){
				$this->load->view('pet/frontdesk');
			}}
            // else if($type == 4){
		// 		$data['clinic'] = $this->Pet->get_clinic_by_user_id($id);
		// 		$data['products'] = $this->Pet->get_all_products_via_clinic_id($_SESSION['klinik']);
		// 		$data['services'] = $this->Pet->get_all_services_via_clinic_id($_SESSION['klinik']);
		// 		$data['clinic'] = $this->Pet->get_clinic_by_user_id($_SESSION['user']['id']);
		// 		$this->load->view('pet/vet', $data);
		// 	}else{
		// 		$this->load->view('pet/confirmation');
		// 	}
		// }
            // var_dump($this->input->post());
		//set validation rules
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if($this->form_validation->run() === FALSE){
			$this->load->view('pet/frontdesk_login');
		}else{
		$email = $this->input->post('email');
		$password_from_input_field = $this->input->post('password');
		$password_from_table = $this->Pet->get_password($email);
		$email_from_table = $this->Pet->login_user($email);
		// get type to correctly redirect users
		$type = $this->Pet->get_type($email);
			// if($email_from_table == NULL){
			// 	// $this->session->set_userdata('user', $email_from_table );
			// }
			if($password_from_input_field != $password_from_table){
				$this->session->set_flashdata('password', 'Wrong password');
				$this->session->set_flashdata('email', $email);
                // echo "hello";
				redirect('/pets/frontdesk_login');
			}else if($type == 3){
				$this->session->set_userdata('user', $email_from_table );
				$_SESSION['user'] = $this->session->userdata('user');
				if(isset($_SESSION['user'])){
                    extract($_SESSION['user']);
					$clinic['clinic'] = $this->Pet->get_clinic_by_id($id);
                    $_SESSION['clinic_id'] = $this->Pet->get_clinic_by_id($id);
                    // echo "hi";
				}
                header('Location: '.base_url().'petshits/frontdesk');
            
			}
		}
    }

    public function dashboard(){
        $clinic['employee'] = $this->Pet->get_clinic_by_id_frontdesk_by_email($_SESSION['user']['email']);
        $clinic['clinic'] = $this->Pet->get_clinic_by_id($clinic['employee']['clinic_id']);
        $clinic['services'] = $this->Pet->get_all_services_via_clinic_id($clinic['employee']['clinic_id']);
        $clinic['products'] = $this->Pet->get_all_products_via_clinic_id($clinic['employee']['clinic_id']);
        $clinic['appointments'] = $this->Pet->get_appointments_for_frontdesk($clinic['employee']['clinic_id']);
        $clinic['sales'] = $this->Pet->get_amount_paid_by_clinic_id($_SESSION['clinicid']);
        $clinic['monthly'] = $this->Pet->get_monthly_sales($_SESSION['clinicid']);
        $clinic['yearly'] = $this->Pet->get_yearly_sales($_SESSION['clinicid']);
        $clinic['pie'] = $this->Pet->get_count_of_items($_SESSION['clinicid']);
        $this->load->view('pet/dashboard', $clinic);
    }

    public function dashboard2(){
        $clinic['employee'] = $this->Pet->get_clinic_by_id_frontdesk_by_email($_SESSION['user']['email']);
        $clinic['clinic'] = $this->Pet->get_clinic_by_user_id($_SESSION['user']['id']);
        $clinicid = $this->Pet->get_clinic_by_user_id2($_SESSION['user']['id']);
        $clinic['services'] = $this->Pet->get_all_services_via_clinic_id($clinic['employee']['clinic_id']);
        $clinic['products'] = $this->Pet->get_all_products_via_clinic_id($clinic['employee']['clinic_id']);
        $clinic['appointments'] = $this->Pet->get_appointments_for_frontdesk($clinic['employee']['clinic_id']);
        $clinic['sales'] = $this->Pet->get_amount_paid_by_clinic_id($clinicid);
        $clinic['monthly'] = $this->Pet->get_monthly_sales($clinicid);
        $clinic['yearly'] = $this->Pet->get_yearly_sales($clinicid);
        $clinic['pie'] = $this->Pet->get_count_of_items($clinicid);
        $this->load->view('pet/dashboard2', $clinic);
    }

    public function history(){
        $clinic['employee'] = $this->Pet->get_clinic_by_id_frontdesk_by_email($_SESSION['user']['email']);
        $clinic['clinic'] = $this->Pet->get_clinic_by_id($clinic['employee']['clinic_id']);
        $clinic['appointments'] = $this->Pet->get_appointment($clinic['employee']['clinic_id']);
        $this->load->view('pet/history', $clinic);
    }

    public function medical($pet_id){
        $data = array(
            'pet_id' => $pet_id,
            'title' => $this->input->post('title'),
            'comments' => $this->input->post('comments')
        );
        $this->Pet->insert_medical_history($data);
        $this->session->set_flashdata('medical', 'You have successfully inserted a record!');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

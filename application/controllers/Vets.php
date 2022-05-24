<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vets extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('Pet');
    }

    public function add_clinic(){
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

    public function show($id){
        $pet_array['pet_array'] = $this->Pet->get_pets_by_id($id);
        $this->load->view('pet/edit', $pet_array);
    }

}

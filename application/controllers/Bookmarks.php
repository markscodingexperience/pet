<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BookMarks extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    // public function index(){
	// 	$this->load->view('bookmark/index');
    // }
	public function index(){
		// $this->output->enable_profiler(TRUE); //enables the profiler
		$this->load->model("Bookmark"); //loads the model
		$bookmarks['bookmarks'] = $this->Bookmark->get_all_bookmarks(); 
		$this->load->view('bookmark/index', $bookmarks);
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

	public function validate(){
		$this->form_validation->set_rules('URL', 'Url of the book', 'required|valid_url');
		$this->form_validation->set_rules('name', 'Name of Book', 'trim|required');
		if($this->form_validation->run() === FALSE){
			echo $this->view_data["errors"] = validation_errors();
		}else{
			$this->add();
		}
	}

	public function destroy($id){
		// $data = array('id' => $id);
		$bookmark['bookmark'] = $this->show1($id);
		$this->load->view('bookmark/destroy', $bookmark);
	}

}

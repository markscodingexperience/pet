<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Countdown extends CI_Controller {

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
    public function main(){
        $date = strtotime("December 31, 2022 12 AM");
        $remaining = $date - time();
        $days_remaining = floor($remaining / 86400);
        $hours_remaining = floor(($remaining % 86400) / 3600);
        $seconds_remaining = $remaining % 60;
        echo "There are $days_remaining days and $hours_remaining hours and $seconds_remaining left";
        $data = array(
            'title' => 'Countdown to Newyear',
            'time' => array($days_remaining, $hours_remaining, $seconds_remaining)
        );
        $this->load->view('countdown/countdown', $data);
    }

}

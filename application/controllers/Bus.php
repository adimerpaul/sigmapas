<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bus extends CI_Controller {
	public function index()
	{
        if($_SESSION['user']==''){
            header('Location: '.base_url()."Admin");
        }
		$this->load->view('templates/header');
		$this->load->view('bus');
		$this->load->view('templates/footer');
	}

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	public function index()
	{
        if($_SESSION['user']==''){
            header('Location: '.base_url()."Admin");
        }
		$this->load->view('templates/header');
		$this->load->view('main');
		$this->load->view('templates/footer');
	}

}

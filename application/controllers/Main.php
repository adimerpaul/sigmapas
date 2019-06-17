<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	public function index()
	{
        if($_SESSION['user']==''){
            header('Location: '.base_url()."Admin");
        }
        if ( isset($_POST['lat']) && isset($_POST['long'])){
            $lat= $_POST['lat'];
            $long= $_POST['long'];
            $zum=19;
        }else{
            $lat= -17.9647;
            $long= -67.106;
            $zum=14;
        }
        $data['lat']=$lat;
        $data['long']=$long;
        $data['zum']=$zum;
		$this->load->view('templates/header');
		$this->load->view('main',$data);
		$this->load->view('templates/footer');
	}

}

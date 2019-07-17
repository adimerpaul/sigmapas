<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index()
	{
        if ( isset($_POST['lat']) && isset($_POST['long'])){
            $lat= $_POST['lat'];
            $long= $_POST['long'];
            $bufer="si";
            $zum=19;
        }else{
            $lat= -17.9647;
            $long= -67.106;
            $zum=14;
            $bufer="no";
        }
        $data['lat']=$lat;
        $data['long']=$long;
        $data['zum']=$zum;
        $data['bufer']=$bufer;
        $this->load->view('templates/header2');
        $this->load->view('main',$data);
        $this->load->view('templates/footer');
	}
}

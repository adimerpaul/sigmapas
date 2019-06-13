<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function index()
	{
		$this->load->view('admin');
	}
	function login(){
		$user=$_POST['user'];
		$password=$_POST['password'];
		$query=$this->db->query("SELECT * FROM usuario WHERE user='$user' AND password='$password'");
		if($query->num_rows()==1){
			$row=$query->row();
            $_SESSION['user']=$row->user;
			header("Location: ".base_url()."Main");
		}else{
			header("Location: ".base_url()."Admin");
		}
	}
	function logout(){
		session_destroy();
		header("Location: ".base_url()."Admin");
	}
}

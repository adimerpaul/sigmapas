<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Colegios2 extends CI_Controller {
	public function index(){

		$this->load->view('templates/header2');
		$this->load->view('colegios2');
		$this->load->view('templates/footer');
	}
    public function insert()
    {
        $nombre=$_POST['nombre'];
        $lat=$_POST['lat'];
        $long=$_POST['long'];
        $this->db->query("INSERT INTO colegio SET nombre='$nombre',lat='$lat',`long`='$long',idusuario='".$_SESSION['idusuario']."'");
        header("Location: ".base_url()."Colegios");
    }
    function delete($id){
        $this->db->query("DELETE FROM colegio WHERE idcolegio='$id'");
        header("Location: ".base_url()."Colegios");
    }
}

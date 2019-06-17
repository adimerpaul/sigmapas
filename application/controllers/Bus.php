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
	function insert(){
        $nombre=$_POST['nombre'];
        $orientacion=$_POST['orientacion'];
        $color=$_POST['color'];
        $this->db->query("INSERT INTO minibus SET nombre='$nombre',orientacion='$orientacion',`color`='$color',idusuario='".$_SESSION['idusuario']."'");
        $idminibus=$this->db->insert_id();
        for ($i=0;$i<=200;$i++){
            if (isset($_POST['lat'.$i])){
                $lat=$_POST['lat'.$i];
                $long=$_POST['long'.$i];
                $this->db->query("INSERT INTO puntos SET idminibus='$idminibus',lat='$lat',`long`='$long'");
            }
        }
    }

}

<?php 
defined('BASEPATH') or exit('No direc script access allowed');

class Main extends MY_Controller{

	public function __construct(){
		parent::__construct();
	}


	public function index(){
		$this->data['title']="Главная страница";

		$this->load->view('templates/header',$this->data);
		$this->load->view('main/index',$this->data);
		$this->load->view('templates/footer');
	}


}

 ?>
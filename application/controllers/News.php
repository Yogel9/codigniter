<?php  

defined('BASEPATH') or exit('No direc script access allowed');

class News extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data['title']="Все новости";

		$this->load->view('templates/header',$data);//передаем дату в views
		$this->load->view('news/index',$data);
		$this->load->view('templates/footer');
	}
}
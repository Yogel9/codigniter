<?php  

defined('BASEPATH') or exit('No direc script access allowed');

class News extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('News_model');//подключаем модель к конструктору 
	}

	public function index(){
		$data['title']="Все новости";
		$data['news'] =$this->News_model->getNews();

		$this->load->view('templates/header',$data);//передаем дату в views
		$this->load->view('news/index',$data);
		$this->load->view('templates/footer');
	}

	public function view($slug = NULL){
		$data['news_item']= $this->News_model->getNews($slug);
		
		if (empty($data['news_item'])) {
			show_404();
		}

		$data['title'] = $data['news_item']['title'];
		$data['content'] = $data['news_item']['text'];

		$this->load->view('templates/header',$data);//передаем дату в views
		$this->load->view('news/view',$data);
		$this->load->view('templates/footer');
	}
}
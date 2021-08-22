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

	public function create(){
		$data['title']= "Добавить новость";

		if($this->input->post('slug') && $this->input->post('title') && $this->input->post('text')){
		//потом нужны проверки на вводимые символы
			$slug  =$this->input->post('slug');
			$title =$this->input->post('title');
			$text  =$this->input->post('text');

			if($this->News_model->setNews($slug,$title,$text)){
				$this->load->view('templates/header',$data);
				$this->load->view('news/success',$data);
				$this->load->view('templates/footer');
			}
		}
		else{
			$this->load->view('templates/header',$data);
			$this->load->view('news/create',$data);
			$this->load->view('templates/footer');
			 }
	}

	public function edit($slug = NULL){
		$data['title']="Редактировать новость";
		$data['news_item'] = $this->News_model->getNews($slug);

		if (empty($data['news_item'])) {
			show_404();
		}
		
		$data['title_news'] = $data['news_item']['title'];
		$data['content_news'] = $data['news_item']['text'];
		$data['slug_news'] = $data['news_item']['slug'];

		if($this->input->post('slug') && $this->input->post('title') && $this->input->post('text')){
			$slug  =$this->input->post('slug');
			$title =$this->input->post('title');
			$text  =$this->input->post('text');
			if($this->News_model->updateNews($slug,$title,$text)){
				echo "Новость успешно изменена";
			}
		}

		$this->load->view('templates/header',$data);
		$this->load->view('news/edit',$data);
		$this->load->view('templates/footer');
	}

	public function delete($slug = NULL){
		$data['news'] = $this->News_model->getNews($slug);

		if (empty($data['news'])) {
			show_404();
		}
		$data['title']="Удаление";
		$data['result']="Ошибка удаления".$data['news']['title'];

		if($this->News_model->deleteNews($slug)){
			$data['result']=$data['news']['title']." успешно удалена";
		}
		$this->load->view('templates/header',$data);
		$this->load->view('news/delete',$data);
		$this->load->view('templates/footer');
	}
}
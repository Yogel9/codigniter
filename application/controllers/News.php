<?php  

defined('BASEPATH') or exit('No direc script access allowed');

class News extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('News_model');//подключаем модель к конструктору 
	}

	public function index(){
		$this->data['title']="Все новости";
		$this->data['news'] =$this->News_model->getNews();

		$this->load->view('templates/header',$this->data);//передаем дату в views
		$this->load->view('news/index',$this->data);
		$this->load->view('templates/footer');
	}

	public function view($slug = NULL){
		$this->data['news_item']= $this->News_model->getNews($slug);
		
		if (empty($this->data['news_item'])) {
			show_404();
		}

		$this->data['title'] = $this->data['news_item']['title'];
		$this->data['content'] = $this->data['news_item']['text'];

		$this->load->view('templates/header',$this->data);//передаем дату в views
		$this->load->view('news/view',$this->data);
		$this->load->view('templates/footer');
	}

	public function create(){
		$this->data['title']= "Добавить новость";

		if($this->input->post('slug') && $this->input->post('title') && $this->input->post('text')){
		//потом нужны проверки на вводимые символы
			$slug  =$this->input->post('slug');
			$title =$this->input->post('title');
			$text  =$this->input->post('text');

			if($this->News_model->setNews($slug,$title,$text)){
				$this->load->view('templates/header',$this->data);
				$this->load->view('news/success',$this->data);
				$this->load->view('templates/footer');
			}
		}
		else{
			$this->load->view('templates/header',$this->data);
			$this->load->view('news/create',$this->data);
			$this->load->view('templates/footer');
			 }
	}

	public function edit($slug = NULL){
		$this->data['title']="Редактировать новость";
		$this->data['news_item'] = $this->News_model->getNews($slug);

		
		
		$this->data['title_news'] = $this->data['news_item']['title'];
		$this->data['content_news'] = $this->data['news_item']['text'];
		$this->data['slug_news'] = $this->data['news_item']['slug'];

		if($this->input->post('slug') && $this->input->post('title') && $this->input->post('text')){
			$slug  =$this->input->post('slug');
			$title =$this->input->post('title');
			$text  =$this->input->post('text');
			if($this->News_model->updateNews($slug,$title,$text)){
				echo "Новость успешно изменена";
			}
		}

		$this->load->view('templates/header',$this->data);
		$this->load->view('news/edit',$this->data);
		$this->load->view('templates/footer');
	}

	public function delete($slug = NULL){
		$this->data['news_delete'] = $this->News_model->getNews($slug);

		if (empty($this->data['news_delete'])) {
			show_404();
		}
		$this->data['title']="Удаление";
		$this->data['result']="Ошибка удаления".$this->data['news_delete']['title'];

		if($this->News_model->deleteNews($slug)){
			$this->data['result']=$this->data['news_delete']['title']." успешно удалена";
		}
		$this->load->view('templates/header',$this->data);
		$this->load->view('news/delete',$this->data);
		$this->load->view('templates/footer');
	}
}
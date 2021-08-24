<?php 

class MY_Controller extends CI_Controller{
	public function __construct(){
		parent::__construct();

		$this->data['title'] = "Кино";


		$this->load->model('News_model');
		$this->data['news']=$this->News_model->getNews();
	}
}

 ?>

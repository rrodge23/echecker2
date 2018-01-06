
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MY_Controller {


	public function index()
	{
		$this->load->view('welcome_message');
	}
    public function view($pages='home'){
		if($pages == 'dashboard'){
			$this->load->model('mdl_dashboards');
			$scheduleData = $this->mdl_dashboards->getMessage();
		}
		if(isset($scheduleData)){
			$this->_view($pages,$scheduleData);
		}else{
			$this->_view($pages);
		}
		
		
    }

	public function postMessage($data=false){
		$this->load->model('mdl_dashboards');
		$message = $this->mdl_dashboards->postMessage($_POST);
		echo json_encode($message);
	}
}

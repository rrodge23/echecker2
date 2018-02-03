
<?php


class Notifications extends MY_Controller {

    function __contruct(){
        parent::__contruct();
    }

	public function index()
	{
		$this->load->model('mdl_notifications');
		$questionaireList = $this->mdl_notifications->unapprovedQuestionaireList();
		$this->_view('notification',$questionaireList);
    }
    
	public function viewquestionnaire($id=false)
	{
		$this->load->model('mdl_notifications');
		$questionaireInfo = $this->mdl_notifications->viewquestionnaireById($id);
		$this->_view('questionnaireinfo',$questionaireInfo);
	}


}

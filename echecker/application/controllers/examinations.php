
<?php


class Examinations extends MY_Controller {

    function __contruct(){
        parent::__contruct();
    }

	public function index()
	{
        $this->load->model('mdl_examinations');
		$subjectList = $this->mdl_examinations->getAllCurrentUserSubjects($_SESSION['users']['idusers']);
		$this->_view('examination',$subjectList);
	}
    
    public function userQuestionaireList($data=false){
		$this->load->model('mdl_Examinations');
		$questionaireList = $this->mdl_Examinations->userQuestionaireList($_POST['id']);
		$this->_view('questionairelist',$questionaireList);
	}
    
}


<?php


class Examinations extends MY_Controller {

    function __contruct(){
        parent::__contruct();
    }
    
	public function index()
	{
        $this->load->model('mdl_Examinations');
		$subjectList = $this->mdl_Examinations->getAllCurrentUserSubjects($_SESSION['users']['idusers']);
		$this->_view('examination',$subjectList);
	}
    
    public function userQuestionaireList($data=false){
		$this->load->model('mdl_Examinations');
		$questionaireList = $this->mdl_Examinations->userQuestionaireList($data);
		$this->_view('questionairelist',$questionaireList);
	}
    
    public function addQuestionaire($data=false){
		$this->_view('addquestionaire');
	}

}

?>

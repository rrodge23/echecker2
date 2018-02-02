
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
		
		$this->_view('questionairelist',array('idsubject'=> $data,'data'=>$questionaireList));
	}

    public function subjectclassinformation($data=false){
		
		$this->load->model('mdl_Examinations');
		$subjectclassinformation = $this->mdl_Examinations->subjectclassinformation($data);
		$subjectclassinformation[0]['idsubject'] = $data;
		$this->_view('subjectclassinformation',$subjectclassinformation);
	}
    
    public function addQuestionaire($data=false){
		$this->_view('addquestionaire',$data);
	}

	public function postQuestionnaireInformation(){
		
		$this->load->model('mdl_Examinations');
		$isInserted = $this->mdl_Examinations->postQuestionnaireInformation($_POST["data"]);
		echo json_encode($isInserted);
	}

	public function deleteQuestionaire(){
		
		$this->load->model('mdl_Examinations');
		$isDeleted = $this->mdl_Examinations->deleteQuestionaire($_POST["id"]);
		echo json_encode($isDeleted);
	}

	public function examine($id=false){
		$this->load->model('mdl_Examinations');
		$questionnaireData = $this->mdl_Examinations->getQuestionnaireInfoById($id);
		$this->_view('examine',$questionnaireData);
	}

	public function submitexamine(){
		$this->load->model('mdl_Examinations');
		$submitResult = $this->mdl_Examinations->submitexamine($_POST["data"]);
		echo json_encode($submitResult);
	}

	public function updateQuestionnaire($id){
		$this->load->model('mdl_Examinations');
		$questionaireInfoResult = $this->mdl_Examinations->getQuestionnaireInfoById($id);
		$this->_view('updateQuestionnaire',$questionaireInfoResult);
	}

	public function postUpdateQuestionnaire(){
		$this->load->model('mdl_Examinations');
		$isQuestionnaireUpdated = $this->mdl_Examinations->postUpdateQuestionnaire($_POST["data"]);
		echo json_encode($isQuestionnaireUpdated);
	}
}

?>

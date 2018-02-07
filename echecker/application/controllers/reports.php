
<?php


class Reports extends MY_Controller {

    function __contruct(){
        parent::__contruct();
    }

	public function index()
	{
		$this->_view('report');
	}

	public function questionnairelistreports($id=false){
		$this->load->model('mdl_reports');
		$questionaireList = $this->mdl_reports->questionnairelistreports($id);
		
		$this->_view('questionnairelistreports',$questionaireList);
	}
	public function reportquestionnaireinfo($id=false){
	
		$this->load->model('mdl_examinations');
		$reportquestionnaireinfo = $this->mdl_examinations->getQuestionnaireInfoById($id);
		
		$this->_view('reportquestionnaireinfo',$reportquestionnaireinfo);
	}

	public function reportstudentquestionnaireinfo($id){
		$this->load->model('mdl_examinations');
		$reportquestionnaireinfo = $this->mdl_examinations->getQuestionnaireInfoById($id);
		
		$this->_view('reportquestionnaireinfo',$reportquestionnaireinfo);
	}

	public function reportstudentlistquestionnaire($id=false){
		$this->load->model('mdl_reports');
		$reportstudentlistquestionnaire = $this->mdl_reports->reportstudentlistquestionnaire($id);
		
		$this->_view('reportstudentlistquestionnaire',$reportstudentlistquestionnaire);
	}

	public function updatequestionscore(){
		$this->load->model('mdl_reports');
		$updatequestionscore = $this->mdl_reports->updatequestionscore($_POST);
		echo json_encode($updatequestionscore);
	}
    
}

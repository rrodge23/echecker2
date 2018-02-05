
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
    
}

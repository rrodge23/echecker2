
<?php


class Subjects extends MY_Controller {

    function __contruct(){
        parent::__contruct();
    }

	public function index()
	{
		$this->load->model('mdl_subjects');
		$subjectList = $this->mdl_subjects->getAllSubjectList();
		$this->_view('subject',$subjectList);

	}

    public function addSubject($data=false){
		$this->load->model('mdl_subjects');
		$isSubjectAdded = $this->mdl_subjects->addSubject($_POST);
		echo json_encode($isSubjectAdded);
	}

    public function getSubjectInfoById($data=false){
		$this->load->model('mdl_subjects');
		$subject = $this->mdl_subjects->getSubjectInfoById($_POST);
		echo json_encode($subject);
	}

	public function updateSubject($data=false){
		$this->load->model('mdl_subjects');
		$isSubjectUpdated = $this->mdl_subjects->updateSubject($_POST);
		echo json_encode($isSubjectUpdated);
	}

	public function deleteSubject($data=false){
		$this->load->model('mdl_subjects');
		$isSubjectDeleted = $this->mdl_subjects->deleteSubject($_POST['id']);
		echo json_encode($isSubjectDeleted);
	}

}

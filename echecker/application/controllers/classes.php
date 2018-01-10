
<?php


class Classes extends MY_Controller {

    function __contruct(){
        parent::__contruct();
    }

	public function index()
	{
		$this->load->model('mdl_classes');
		$classes = $this->mdl_classes->getAllClasses();
		$this->_view('classes',$classes);
	}


	public function getAllClasses($data=false){
		$this->load->model('mdl_classes');
		$isClassesAdded = $this->mdl_classes->getAllClasses();
		echo json_encode($isClassesAdded);
	}

	public function addClasses($data=false){
		$this->load->model('mdl_classes');
		$isClassesAdded = $this->mdl_classes->addClasses($_POST);
		echo json_encode($isClassesAdded);
	}


	public function deleteClasses($data=false){
		$this->load->model('mdl_classes');
		$isClassesDeleted = $this->mdl_classes->deleteClasses($_POST['id']);
		echo json_encode($isClassesDeleted);
	}

	public function updateClasses($data=false){
		$this->load->model('mdl_Classes');
		$isClassesUpdated = $this->mdl_Classes->updateClasses($_POST);
		echo json_encode($isClassesUpdated);
	}

	public function getClassesInfoById($data=false){
		$this->load->model('mdl_Classes');
		$Classes = $this->mdl_Classes->getClassesInfoById($_POST);
		echo json_encode($Classes);
	}

}


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

}

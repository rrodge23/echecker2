
<?php


class Courses extends MY_Controller {

    function __contruct(){
        parent::__contruct();
    }

	public function index()
	{
		$this->load->model('mdl_courses');
		$course = $this->mdl_courses->getAllcourses();
		$this->_view('course',$course);
	}

    public function addcourse($data=false){
		$this->load->model('mdl_courses');
		$iscourseAdded = $this->mdl_courses->addcourse($_POST);
		echo json_encode($iscourseAdded);
	}

    public function getcourseInfoById($data=false){
		$this->load->model('mdl_courses');
		$course = $this->mdl_courses->getcourseInfoById($_POST);
		echo json_encode($course);
	}

	public function updatecourse($data=false){
		$this->load->model('mdl_courses');
		$iscourseUpdated = $this->mdl_courses->updatecourse($_POST);
		echo json_encode($iscourseUpdated);
	}

	public function deletecourse($data=false){
		$this->load->model('mdl_courses');
		$iscourseDeleted = $this->mdl_courses->deletecourse($_POST['id']);
		echo json_encode($iscourseDeleted);
	}

}

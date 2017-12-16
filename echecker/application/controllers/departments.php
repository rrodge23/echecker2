
<?php


class Departments extends MY_Controller {

    function __contruct(){
        parent::__contruct();
    }

	public function index()
	{
		$this->load->model('mdl_departments');
		$department = $this->mdl_departments->getAllDepartments();
		$this->_view('department',$department);
	}

	public function getAllDepartments($data=false){
		$this->load->model('mdl_Departments');
		$departmentList = $this->mdl_Departments->getAllDepartments($_POST);
		echo json_encode($departmentList);
	}

    public function addDepartment($data=false){
		$this->load->model('mdl_Departments');
		$isDepartmentAdded = $this->mdl_Departments->addDepartment($_POST);
		echo json_encode($isDepartmentAdded);
	}

    public function getDepartmentInfoById($data=false){
		$this->load->model('mdl_Departments');
		$Department = $this->mdl_Departments->getDepartmentInfoById($_POST);
		echo json_encode($Department);
	}

	public function updateDepartment($data=false){
		$this->load->model('mdl_Departments');
		$isDepartmentUpdated = $this->mdl_Departments->updateDepartment($_POST);
		echo json_encode($isDepartmentUpdated);
	}

	public function deleteDepartment($data=false){
		$this->load->model('mdl_Departments');
		$isDepartmentDeleted = $this->mdl_Departments->deleteDepartment($_POST['id']);
		echo json_encode($isDepartmentDeleted);
	}

}


<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

    function __contruct(){
        parent::__contruct();
    }

	public function index()
	{
        $this->load->model('mdl_Users');
        $proffessors = $this->mdl_Users->getAllProfessorsList();
        $students = $this->mdl_Users->getAllStudentsList();
        $users = array($proffessors,$students);
		$this->_view('users',$users);
	}

    public function importUsers(){
        if(isset($_POST['userfield'])){
            $this->load->library("Excelfile");
            $object = PHPExcel_IOFactory::load($_FILES["usersFile"]["tmp_name"]);
            $isInsertSuccess = false;
            foreach($object->getWorksheetIterator() as $worksheet){
                $highestRow = $worksheet->getHighestRow();
                $highestColumnLetter = $worksheet->getHighestDataColumn();
                $highestColumn = PHPExcel_Cell::columnIndexFromString($highestColumnLetter);
                $header = array('code','user','firstname','middlename','lastname');
                for($row=2; $row<=$highestRow; $row++){
                    $colDatas = array();
                    for($col=0;$col<count($header);$col++){ 
                        $colDatas[$header[$col]] = $worksheet->getCellByColumnAndRow($col,$row)->getFormattedValue();
                    }
                    if($_POST['userfield'] == 1){
                        $colDatas['course'] = $worksheet->getCellByColumnAndRow(5,$row)->getFormattedValue();
                        $colDatas['year_level'] = $worksheet->getCellByColumnAndRow(6,$row)->getFormattedValue();
                        $colDatas['department'] = $worksheet->getCellByColumnAndRow(7,$row)->getFormattedValue();

                    }else if($_POST['userfield'] == 2){
                        $colDatas['position'] = $worksheet->getCellByColumnAndRow(5,$row)->getFormattedValue();
                        $colDatas['department'] = $worksheet->getCellByColumnAndRow(6,$row)->getFormattedValue();
                    }else{
                        return false;
                    }
                    $colDatas['pass'] = $colDatas['code'];
                    $colDatas['user_level'] = $_POST['userfield'];
                    $this->load->model("mdl_Users");
                    $result = $this->mdl_Users->insertUsers($colDatas);
                    if($result){
                        $isInsertSuccess = true;    
                    }                    
                    
                }
                break;
            }
            echo json_encode($isInsertSuccess);
        }else{
            echo json_encode(false);
        }
        
       
    }
    
    public function deleteUser(){
        $this->load->model('mdl_Users');
        $result = $this->mdl_Users->deleteUserById($_POST['id']);
        echo json_encode($result);
    }
    public function addTeacher(){
        $this->load->model('mdl_Users');
        $_POST['pass'] = $_POST['code'];
        $_POST['user_level'] = "2";
        $result = $this->mdl_Users->insertUsers($_POST);
        echo json_encode($result);
    }
    public function addStudent(){
        $this->load->model('mdl_Users');
        $_POST['pass'] = $_POST['code'];
        $_POST['user_level'] = "1";
        $result = $this->mdl_Users->insertUsers($_POST);
        echo json_encode($result);
    }

    public function updateUser(){
        $this->load->model('mdl_Users');
        $query = $this->mdl_Users->updateUser($_POST);
        echo json_encode($query);
    }

    public function getUserInfoById($data=false){
        $this->load->model('mdl_Users');
        $result = $this->mdl_Users->getUserInfoById($_POST['id']);
        echo json_encode($result);
    }

    public function modalAddTeacher(){
        $header = array("code","user","firstname","middlename","lastname","position");
        $htmlbody = '<form action="users/addteacher" method="post" onsubmit="return false;" class="mdl-frm-add-users" id="mdl-frm-add-teacher">';
        foreach($header as $h){
            $htmlbody .= '<div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;text-align:right">'.ucwords($h).'</div></span>
                            <input type="text" class="form-control" name="'.$h.'" aria-describedby="basic-addon1" required="required">
                        </div>';   
        }
        $this->load->model('mdl_departments');
        $department = $this->mdl_departments->getAllDepartments();
        $htmlbody .= '<div class="input-group">
                        <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;text-align:right;">Department</div></span>
                        <select name="department" data-placeholder="Choose Department" class="chzn-select" required="required">';
              foreach($department as $d){
                  $htmlbody .= '<option value="'.$d['department_name'].'">'.$d['department_name'].'</option>';
              }          
              $htmlbody .='</select></div></form>';
        
        $htmlfooter = '<button type="submit" form="mdl-frm-add-teacher" class="btn btn-primary btn-post-add-subject"><i class="material-icons">playlist_add_check</i></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="material-icons">close</i></button>';
        echo json_encode(array('body'=>$htmlbody,'footer'=>$htmlfooter));
    }

    public function modalAddStudent(){
        $header = array("code","user","firstname","middlename","lastname","year_level");
        $htmlbody = '<form action="users/addstudent" method="post" onsubmit="return false;" class="mdl-frm-add-users" id="mdl-frm-add-student">';
        foreach($header as $h){
            $htmlbody .= '<div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;text-align:right;">'.ucwords($h).'</div></span>
                            <input type="text" class="form-control" name="'.$h.'" aria-describedby="basic-addon1" required="required">
                        </div>';   
        }
        $this->load->model('mdl_departments');
        $this->load->model('mdl_courses');
        
        $course = $this->mdl_courses->getAllcourses();
      
        $htmlbody .= '<div class="input-group">
                        <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;text-align:right;">Course</div></span>
                        <select name="course" data-placeholder="Choose Course" class="chzn-select" required="required">';
              foreach($course as $c){
                  $htmlbody .= '<option value="'.$c['course_name'].'">'.$c['course_name'].'</option>';
              }          
              $htmlbody .='</select></div>';
        $department = $this->mdl_departments->getAllDepartments();
        $htmlbody .= '<div class="input-group">
                        <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;text-align:right;">Department</div></span>
                        <select name="department" data-placeholder="Choose Department" class="chzn-select" required="required">';
              foreach($department as $d){
                  $htmlbody .= '<option value="'.$d['department_name'].'">'.$d['department_name'].'</option>';
              }          
              $htmlbody .='</select></div></form>';
        
        $htmlfooter = '<button type="submit" form="mdl-frm-add-student" class="btn btn-primary btn-post-add-subject"><i class="material-icons">playlist_add_check</i></button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="material-icons">close</i></button>';
        echo json_encode(array('body'=>$htmlbody,'footer'=>$htmlfooter));
    }

    public function modalUpdateUser(){
        if($_POST['user_level'] == 1){
            $header = array("code","user","firstname","middlename","lastname","year_level");
        }else if($_POST['user_level'] == 2){
            $header = array("code","user","firstname","middlename","lastname","position");
        }
        $htmlbody = '<form action="users/updateUser" method="POST" id="mdl-frm-update-user">
                        <input type="hidden" value="'.$_POST['user_level'].'" name="user_level">
                        <input type="hidden" value="'.$_POST['idusers'].'" name="idusers">';
       
        foreach($header as $h){
            $htmlbody .= '<div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;text-align:right;">'.ucwords($h).'</div></span>
                            <input type="text" class="form-control" value="'.$_POST[$h].'" name="'.$h.'" aria-describedby="basic-addon1" required="required">
                        </div>';   
        }
        if($_POST['user_level'] == 1){
            $this->load->model('mdl_courses');
            $course = $this->mdl_courses->getAllcourses();
      
            $htmlbody .= '<div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;text-align:right;">Course</div></span>
                            <select name="course" data-placeholder="Choose course" class="chzn-select" required="required">';
                foreach($course as $c){
                    if($c['idcourse'] == $_POST['idcourse']){
                        $htmlbody .= '<option selected="selected" value="'.$c['idcourse'].'">'.$c['course_name'].'</option>';
                    }else{
                        $htmlbody .= '<option value="'.$c['idcourse'].'">'.$c['course_name'].'</option>';
                    }
                    
                }
                $htmlbody .='</select></div>';
        }
        $this->load->model('mdl_departments');
        $department = $this->mdl_departments->getAllDepartments();
        $htmlbody .= '<div class="input-group">
                        <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;text-align:right;">Department</div></span>
                        <select name="department" data-placeholder="Choose Department" class="chzn-select" required="required">';
              foreach($department as $d){
                  if($d['iddepartment'] == $_POST['iddepartment']){

                    $htmlbody .= '<option selected="selected" value="'.$d['iddepartment'].'">'.$d['department_name'].'</option>';
                  }
                    $htmlbody .= '<option value="'.$d['iddepartment'].'">'.$d['department_name'].'</option>';
              }          
              $htmlbody .='</select></div></form>';
        
        $htmlfooter = '<button type="submit" form="mdl-frm-update-user" class="btn btn-primary btn-post-user-update">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
        echo json_encode(array('body'=>$htmlbody,'footer'=>$htmlfooter));
    }


}

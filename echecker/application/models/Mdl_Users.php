
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_Users extends CI_Model {

    function __construct(){
        parent::__construct();
    }
    public function validateLogin($data=array()){
        
        $query = $this->db->where('user', $data['username'])
                        ->where('pass', $data['password'])
                        ->join('user_leveltbl', 'users.user_level = user_leveltbl.user_level')
                        ->get('users');
        $usersData = $query->first_row('array');
        if($usersData['user_level'] == "99"){
            $query = $this->db->where('idadmin',$usersData['idusers'])->get('admin_informationtbl');
            $result = $query->first_row('array');
            if(!$result){
                return false;
            }
        }else if($usersData['user_level'] == "1"){
            $query = $this->db->where('idstudent',$usersData['idusers'])->get('student_informationtbl');
            $result = $query->first_row('array');
            if(!$result){
                return false;
            }
        }else if($usersData['user_level'] == "2"){
            $query = $this->db->where('idteacher',$usersData['idusers'])->get('teacher_informationtbl');
            $result = $query->first_row('array');
            if(!$result){
                return false;
            }
        }else{
            return false;
        }

        if($usersData){
            
            $result = array($usersData,$result);
            return $result;
        }
       
        return false;
    }       

    public function getAllUserList(){
        $query=$this->db->join('user_leveltbl','user_leveltbl.user_level = users.user_level')
                    ->get('users');
        return $query->result_array();
    }

    public function getAllStudentsList(){
        $query=$this->db->join('user_leveltbl','user_leveltbl.user_level = users.user_level','left')
                    ->join('user_coursetbl','users.idusers = user_coursetbl.iduser_course','left')
                    ->join('coursetbl','user_coursetbl.idcourse = coursetbl.idcourse','left')
                    ->join('student_informationtbl','student_informationtbl.id = users.idusers','left')
                    ->join('user_departmenttbl','users.idusers = user_departmenttbl.UID','left')
                    ->join('departmenttbl','user_departmenttbl.iddepartment = departmenttbl.iddepartment','left')
                    ->where('users.user_level','1')
                    ->get('users');
        return $query->result_array();
    }

    public function getAllProfessorsList(){
        $query=$this->db->join('user_leveltbl','user_leveltbl.user_level = users.user_level')
                    ->join('teacher_informationtbl','teacher_informationtbl.id = users.idusers')
                    ->join('user_departmenttbl','users.idusers = user_departmenttbl.UID','left')
                    ->join('departmenttbl','user_departmenttbl.iddepartment = departmenttbl.iddepartment','left')
                    ->where('users.user_level', '2')
                    ->get('users');
        return $query->result_array();
    }

    public function insertUsers($data=array()){
        
        $isDataValid = false;
        $studentDataIndex = array('firstname','middlename','lastname','year_level');
        $teacherDataIndex = array('firstname','middlename','lastname','position');
        
        if($data['user_level'] == 1 || $data['user_level'] == 2){
            if($data['user'] != "" && $data['pass'] != "" && $data['firstname'] != "" && $data['lastname'] != ""){
                if($this->db->where('user_level', $data['user_level'])->get('user_leveltbl')){
                    $isUserCodeDuplicate = $this->db->where('code',$data['code'])->get('users');
                    if($isUserCodeDuplicate->num_rows > 0){
                        return false;
                    }else{
                        $isDataValid = true;
                        $userInfo = array(  'code'=>$data['code'],
                                            'user'=>$data['user'],
                                            'pass'=>$data['pass'],
                                            'user_level'=>$data['user_level'],
                                            'status'=>'inactive'
                                        );
                        $this->db->insert('users',$userInfo);
                        $last_insert = $this->db->insert_id();

                        if($data['user_level'] == 1){
                            $studentInfo['id'] = $last_insert;
                            for($i = 0; $i< count($studentDataIndex); $i++){
                               
                                    $studentInfo[$studentDataIndex[$i]] = $data[$studentDataIndex[$i]];
                                
                            }
                            
                            if(!($this->db->insert('student_informationtbl',$studentInfo))){
                                return false;
                            }
                            
                        }else if($data['user_level'] == 2){
                            $teacherInfo['id'] = $last_insert;
                            for($i = 0; $i < count($teacherDataIndex); $i++){
                               
                                    $teacherInfo[$teacherDataIndex[$i]] = $data[$teacherDataIndex[$i]];
                            }
                            if(!($this->db->insert('teacher_informationtbl',$teacherInfo))){
                                return false;
                            }
                        }

                        if(array_key_exists('department',$data)){
                            $getDepartmentInfo = $this->db->where('department_name',$data['department'])->limit(1)->get('departmenttbl');
                            
                            if($departmentData = $getDepartmentInfo->row_array()){
                                $userDepartment = array('iddepartment' => $departmentData['iddepartment'],'UID' => $last_insert);
                                $result = $this->db->insert('user_departmenttbl',$userDepartment);
                            }
                            
                        }
                        
                        if(array_key_exists('course',$data)){
                            
                            $getCourseInfo = $this->db->where('course_name',$data['course'])->limit(1)->get('coursetbl');
                           
                            if($courseData = $getCourseInfo->row_array()){
                                
                                $userCourse = array('iduser_course'=>$last_insert, 'idcourse' => $courseData['idcourse']);
                                
                                $result = $this->db->insert('user_coursetbl',$userCourse);
                                
                            }
                        }
                    }
                }
            }
        }
        
         return $isDataValid;
    }

    public function deleteUserById($id=false){
        $getQuery = $this->db->where('idusers',$id)->get('users');
        $userInfo = $getQuery->row_array();
        if($userInfo['user_level'] == 1){
            $deleteQuery = $this->db->where('id',$id)->delete('student_informationtbl');
            if(!($deleteQuery)){
                return false;
            }
            $deleteQuery = $this->db->where('iduser_course',$id)->delete('user_coursetbl');
            if(!($deleteQuery)){
                return false;
            }
            
        }
        if($userInfo['user_level'] == 2){
            $deleteQuery = $this->db->where('id',$id)->delete('teacher_informationtbl');
        }
        $deleteUserDepartment = $this->db->where('UID',$id)->delete('user_departmenttbl');
        if(!($deleteUserDepartment)){
            return false;
        }
        $deleteUser = $this->db->where('idusers', $id)->delete('users');
        if($deleteQuery){
            return true;
        }
        return false;
    }

    public function getUserInfoById($data=false){
        $getQuery = $this->db->where('idusers',$data)
                            ->join('user_coursetbl','users.idusers = user_coursetbl.iduser_course','left')
                            ->join('coursetbl','user_coursetbl.idcourse = coursetbl.idcourse','left')
                            ->join('user_departmenttbl','users.idusers = user_departmenttbl.UID','left')
                            ->get('users');
        $userInfo = $getQuery->row_array();
        if($userInfo['user_level'] == 1){
        
            if(!$userQuery = $this->db->where('id',$userInfo['idusers'])->get('student_informationtbl')){
                return false;
            }
        }else if($userInfo['user_level'] == 2){
            if(!$userQuery = $this->db->where('id',$userInfo['idusers'])->get('teacher_informationtbl')){
                return false;
            }
        }else{
            return false;
        }
        $getDataItems = $userInfo;
        $userInformationQuery = $userQuery->row_array();
        foreach($userInformationQuery as $k => $v){
            $getDataItems[$k] = $v;
        }
        if($getDataItems){
            return $getDataItems;
        }
        return false;
    }

    public function updateUser($data=false){
        
        if($getQuery = $this->db->where('idusers',$data['idusers'])->get('users')){            
            $userData = $getQuery->row_array();
            $this->db->set('code',$data['code'])
                    ->where('idusers',$data['idusers'])
                    ->update('users');
            if(array_key_exists('department',$data)){
                $isUpdated = $this->db->set('iddepartment',$data['department'])
                    ->where('UID',$data['idusers'])
                    ->update('user_departmenttbl');
                if(!($isUpdated)){
                    return false;
                }
            }
            
            if($userData['user_level'] == 1){
                
                if(array_key_exists('course',$data)){
                    
                    $courseData = $this->getUserInfoById($data['idusers']);
                    if($courseData){
                        $setCourseData = array('iduser_course' => $data['idusers'],'idcourse'=>$courseData['idcourse']);
                        $isUpdated = $this->db->set('idcourse',$data['course'])
                        ->where($setCourseData)
                        ->update('user_coursetbl');
                        //->get_compiled_update('user_coursetbl');
           
                        if(!($isUpdated)){
                            return false;
                        }
                    }
                    
                }
                $setStudentInformation = array( 
                                    'firstname'=>$data['firstname'],
                                    'middlename' => $data['middlename'],
                                    'lastname' => $data['lastname'],
                                    'year_level' => $data['year_level']
                            );
                $isUpdated = $this->db->set($setStudentInformation)->where('id',$data['idusers'])->update('student_informationtbl');
            }else if($userData['user_level'] == 2){
                $setTeacherInformation = array('firstname'=>$data['firstname'],
                                    'middlename' => $data['middlename'],
                                    'lastname' => $data['lastname'],
                                    'position' => $data['position'],
                            );
                $isUpdated = $this->db->set($setTeacherInformation)->where('id',$data['idusers'])->update('teacher_informationtbl');
            }

            if($isUpdated){
                return true;
            }else{
                return false;
            }
        }
        return false;
    }

    public function changePassword($data=array()){
        $query = $this->db->set('pass',$data['newPassword'])->set('status','active')->where('idusers',$data['idusers'])->update('users');
        if($query){ 
            return $data['newPassword'];
        }else
        {
            return false;
        }
    }
    
}


?>
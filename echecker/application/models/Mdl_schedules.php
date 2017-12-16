
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_schedules extends CI_Model {

    function __construct(){
        parent::__construct();
    }
   
    public function getAllschedules(){
        $query=$this->db->get('subject_scheduletbl');
        return $query->result_array();
    }

    public function addschedule($data=false){
        $data['status'] = 'available';
        if((int)$data['time_start'] >= (int)$data['time_end']){
            return array("Time Start Should be earlier than Time End.", false);
        }
        $tmpData = "";
        foreach($data['day'] as $d){
            $tmpData .= $d . ',';
        }

        $data['day'] = rtrim($tmpData, ',');
        $query=$this->db->where('schedule_code',$data['schedule_code'])
                    ->get('subject_scheduletbl');
        if($query->num_rows > 0){
            return array('schedule Already Exist', false);   
        }else{
            return array($this->db->insert('subject_scheduletbl',$data),true);
        }
        return array("",false);
    }
    
    public function getscheduleInfoById($data=false){
      
        $query=$this->db->where('idschedule',$data['id'])
                    ->get('subject_scheduletbl');
        $getschedule = $query->row_array();
        if($getschedule){
            return array($getschedule, true);   
        }else{
            return array("No Found",false);
        }
        return array("",false);
    }

    public function updateschedule($data=false){
     
        if((int)$data['time_start'] >= (int)$data['time_end']){
            return array("Time Start Should be earlier than Time End.", false);
        }
        $tmpData = "";
        foreach($data['day'] as $d){
            $tmpData .= $d . ',';
        }
        $data['day'] = rtrim($tmpData, ',');

        $query=$this->db->not_like('idschedule',$data['idschedule'])
                    ->where('schedule_code',$data['schedule_code'])
                    ->get('subject_scheduletbl');
         if($getschedule = $query->row_array()){
            return array("schedule Already Exist", false);   
        }else{
            if($isUpdated = $this->db->set($data)->where('idschedule',$data['idschedule'])->update('subject_scheduletbl')){
                return array($isUpdated,true);
            }else{
                return array("Failed to Update", false);
            }
        }               
        return array("",false);
    }
    
    public function deleteschedule($data=false){
        $isScheduleNotAvailable = $this->db->where('idschedule',$data)->limit(1)->get('subject_scheduletbl');
        $getIsScheduleAvailable = $isScheduleNotAvailable->row_array();
        if($getIsScheduleAvailable['status'] != 'available'){
            return array("Cannot Delete Unavailable Schedule", false);
        }
        $query=$this->db->where('idschedule',$data)
                    ->delete('subject_scheduletbl');
        if($query){
            return array("", true);   
        }else{
            return array("Error in Record Deletion", false);   
        }               
        return array("",false);
    }

}


?>
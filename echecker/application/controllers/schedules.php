
<?php


class Schedules extends MY_Controller {

    function __contruct(){
        parent::__contruct();
    }

	public function index()
	{
		$this->load->model('mdl_schedules');
		$scheduleList = $this->mdl_schedules->getAllschedules();
		$this->_view('schedule',$scheduleList);
	}
    public function getAllschedules($data=false){
		$this->load->model('mdl_schedules');
		$schedules = $this->mdl_schedules->getAllschedules();
		echo json_encode($schedules);
	}
    public function addschedule($data=false){
		$this->load->model('mdl_schedules');
		$isscheduleAdded = $this->mdl_schedules->addschedule($_POST);
		echo json_encode($isscheduleAdded);
	}

    public function getscheduleInfoById($data=false){
		$this->load->model('mdl_schedules');
		$schedule = $this->mdl_schedules->getscheduleInfoById($_POST);
		echo json_encode($schedule);
	}

	public function updateschedule($data=false){
		$this->load->model('mdl_schedules');
		$isscheduleUpdated = $this->mdl_schedules->updateschedule($_POST);
		echo json_encode($isscheduleUpdated);
	}

	public function deleteschedule($data=false){
		$this->load->model('mdl_schedules');
		$isscheduleDeleted = $this->mdl_schedules->deleteschedule($_POST['id']);
		echo json_encode($isscheduleDeleted);
	}

	public function modalAddShedule(){
        $header = array("schedule_code");
        $htmlbody = '<form action="schedules/addschedule" method="post" onsubmit="return false;" id="mdl-frm-add-schedule">';
        foreach($header as $h){
            $htmlbody .= '<div class="input-group">
                           <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;">' . ucwords($h) . '</div></span>
                           <input type="text" class="form-control" name="' . $h . '" aria-describedby="basic-addon1" required="required">
                        </div>';
        }
        
        $htmlbody .= '<div class="input-group">
                       <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;">Day</div></span>
                       <select name="day[]" data-placeholder="Choose a day ..." style="width:350px;" multiple class="chzn-select">';
        $dayList = array("","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
        foreach($dayList as $d){
            $htmlbody .= '<option value="'.$d.'">'.$d.'</option>';
        }               
        $htmlbody .=' </select>
                    </div>';
        $timeHeader = array('time_start','time_end');
        foreach($timeHeader as $t){
            $htmlbody .= '<div class="input-group">
                       <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;">'.$t.'</div></span>
                       <input type="text" class="form-control datepicker" name="'.$t.'" aria-describedby="basic-addon1" required="required">
                    </div>
                    ';
        }
        $htmlbody .= '</form>';
        $footer = '<button type="submit" form="mdl-frm-add-schedule" class="btn btn-primary btn-post-add-schedule"><i class="material-icons">playlist_add_check</i></button>
                   <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="material-icons">close</i></button>';
        echo json_encode(array('body'=>$htmlbody, 'footer'=>$footer));
    }

    public function modalUpdateSchedule(){
        $this->load->model('mdl_schedules');
		$scheduleData = $this->mdl_schedules->getscheduleInfoById($_POST);
        
        $header = array("schedule_code");
        $htmlbody = '<form action="schedules/updateschedule" method="post" onsubmit="return false;" id="mdl-frm-update-schedule">'
                    . '<input type="hidden" value="'.$scheduleData[0]['idschedule'].'" name="idschedule">';
        foreach($header as $h){
            $htmlbody .= '<div class="input-group">
                           <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;">' . ucwords($h) . '</div></span>
                           <input type="text" value="'.$scheduleData[0][$h].'" class="form-control" name="' . $h . '" aria-describedby="basic-addon1" required="required">
                        </div>';
        }
        
        $htmlbody .= '<div class="input-group">
                       <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;">Day</div></span>
                       <select name="day[]" style="width:350px;" multiple class="chzn-select" required="required">';
        $dayList = array("","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
        $getDayList = explode(',',$scheduleData[0]['day']);
        foreach($dayList as $d){
            if(in_array($d, $getDayList)){
                $htmlbody .= '<option selected="selected" value="'.$d.'">'.$d.'</option>';
            }else{
                $htmlbody .= '<option value="'.$d.'">'.$d.'</option>';
            }
            
        }               
        $htmlbody .=' </select>
                    </div>';
        $timeHeader = array('time_start','time_end');
        foreach($timeHeader as $t){
            $htmlbody .= '<div class="input-group">
                       <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;">'.$t.'</div></span>
                       <input type="text" value="'.$scheduleData[0][$t].'" class="form-control datepicker" name="'.$t.'" aria-describedby="basic-addon1" required="required">
                    </div>';
        }
        
            $htmlbody .= '</form>';
        $footer = '<button type="submit" form="mdl-frm-update-schedule" class="btn btn-primary btn-post-update-schedule"><i class="material-icons">playlist_add_check</i></button>
                   <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="material-icons">close</i></button>';
        echo json_encode(array('body'=>$htmlbody, 'footer'=>$footer));
    }

}

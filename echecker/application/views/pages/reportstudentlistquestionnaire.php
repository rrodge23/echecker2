<?php
   print_r($data);
?>


<?php 
    if(isset($data[0]['subject_code'])){ 
?>
<h6><i><b>SUBJECT CODE:</b> <?=$data[0]['subject_code'];?></i></h6>
<h6><i><b>DESCRIPTION :</b> <?=$data[0]['subject_description'];?></i></h6>
<?php 
    }//dont erase this
?>
<div class="row">
<h5><b>STUDENT LIST:</b></h5>

<table id="table-studentslist" class="table table-striped" style='width:100%;'>        
    <thead>
        <tr>
            <td class="text-center font-roboto color-a2">ID</td>
            <td class="text-center font-roboto color-a2">CODE</td>
            <td class="text-center font-roboto color-a2">NAME</td>
            <td class="text-center font-roboto color-a2">DEPARTMENT</td>
            <td class="text-center font-roboto color-a2">SCORE</td>
            <td class="text-center font-roboto color-a2">ACTION</td>
        </tr>
    </thead>
    <tbody class="student-list-tablebody">
        <?php
            if($data){
                foreach($data as $u){
                    $id = $u['idusers'];
                    $idsubject = $u["idsubject"];
                    $code = $u['code'];
                    $firstname = $u['firstname'];
                    $middlename = $u['middlename'];
                    $lastname = $u['lastname'];
                    $department = $u['department_name'];
                    $user_level = $u['user_level'];
                    $score = $u['user_total_score'];
                    $idquestionaire = $u["idquestionaire"];
                    if($user_level == '1'){
                        echo "
                            <tr>
                                <td class='text-center'>$id</td>
                                <td class='text-center'>$code</td>
                                <td class='text-center'>$lastname, $firstname $middlename</td>
                                <td class='text-center'>$department</td>
                                <td class='text-center'>$score</td>
                                <td class='text-center'>
                                  
                                        <a href='reports/reportstudentquestionnaireinfo/$idquestionaire' rel='tooltip' data-original-title='Update' class='btn-view-student-subject-questionnaires btn btn-info' type='submit' name='viewStudentSubjectQuestionnaires'>
                                            <i class='material-icons'>remove_red_eye</i>
                                        </a>
                                 
                                   
                                </td>
                            </tr>
                        ";
                    }
                }
            }
         ?>
     </tbody>
</table>
</div>
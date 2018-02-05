<?php

    /*Array ( [0] => Array ( [iduserquestionaire] => 9 [idusers] => 70 [questionaire_id] => 35 [user_total_score] => 7.3333333333333 [idquestionaire] => 35 [idclass] => 0 [idsubject] => 14 [questionaire_title] => zxvzxc [questionaire_description] => vxzcvxzvxcvzxcv [questionaire_status] => approved [approved_user] => [approved_date] => 2018-02-04 22:32:01 [questionaire_score] => [questionaire_total_score] => [questionaire_duration] => 3600 [questionaire_remarks] => [questionaire_date] => 02-03-18 [questionaire_time] => 22:15 [questionaire_instruction] =>
zxvzxvx

[questionaire_type_id] => 0 [subject_code] => IT 999 [subject_description] => Project Management [schedule] => 14 [units] => 3 [status] => ) )*/ 
?>
    
<div class="user-subject-list">

    <?php 
        if($data){
            if(isset($data["subject_code"]) && isset($data["subject_description"])){
                echo '<div class="row">
                        <span>Subject Code:</span><span>'.$data["subject_code"].'</span>
                    </div>
                    <div class="row">
                            <span>Subject Description:</span><span>'.$data["subject_description"].'</span>
                    </div>';
            }
        }
      
    ?>
    <span class="brand" style="font-size:20px;">QUESTIONNAIRE LIST:</span>
    <table id="table-subjectList" class="table table-striped">        
        <thead>
            <tr>
                <td class="text-center font-roboto color-a2">ID</td>
                <td class="text-center font-roboto color-a2">TITLE</td>
                <td class="text-center font-roboto color-a2">DESCRIPTION</td>
                <td class="text-center font-roboto color-a2">DATE</td>
                <td class="text-center font-roboto color-a2">TOTAL SCORE</td>
                <td class="text-center font-roboto color-a2">SCORE</td>
                <?php
                    if($_SESSION['users']['user_level'] == "2"){
                        echo '<td class="text-center font-roboto color-a2">STATUS</td>';
                    }
                ?>
                
                <td class="text-center font-roboto color-a2">ACTION</td>
            </tr>
        </thead>
        <tbody>
            <?php
                if($data){
                    foreach($data as $key=>$questionaire){
                    
                            $id = $questionaire['idquestionaire'];
                            $title = $questionaire['questionaire_title'];
                            $description = $questionaire['questionaire_description'];
                            $date = $questionaire['questionaire_date'];
                            $total_score = $questionaire['questionaire_total_score'];
                            $score = $questionaire['user_total_score'];
                            

                        echo "
                            <tr>
                                <td class='text-center font-roboto color-a2'>$id</td>
                                <td class='text-center font-roboto color-a2'>$title</td>
                                <td class='text-center font-roboto color-a2'>$description</td>
                                <td class='text-center font-roboto color-a2'>$date</td>
                                <td class='text-center font-roboto color-a2'>$total_score</td>
                                <td class='text-center font-roboto color-a2'>$score</td>";
                                
                        echo "<td class='text-center font-roboto color-a2'>
                                
                                <a rel='tooltip' data-original-title='View Questionnaires' class='btn-view-questionaire btn btn-info' href='reports/reportquestionnaireinfo/$id'>
                                    <i class='material-icons'>remove_red_eye</i>
                                </a>";
                     
                        
    
                        echo " 
                                    
                                </td>
                               
                            </tr>
                            ";
                        
                    }
                }
            ?>
                
        </tbody>
    </table>
</div> 
<?php

?>

<table id="table-departmentlist" class="table table-striped">        
    <thead>
        <tr>
            <td class="text-center font-roboto color-a2">ID</td>
            <td class="text-center font-roboto color-a2">TITLE</td>
            <td class="text-center font-roboto color-a2">DESCRIPTION</td>
            <td class="text-center font-roboto color-a2">DATE</td>
            <td class="text-center font-roboto color-a2">TIME</td>
            <td class="text-center font-roboto color-a2">SUBJECT NAME</td>
            <td class="text-center font-roboto color-a2">ACTION</td>

        </tr>
    </thead>
    <tbody>
        <?php
            if($data){
                foreach($data as $i => $questionnaire){
                    $id = $questionnaire['idquestionaire'];
                    $title = $questionnaire['questionaire_title'];
                    $description = $questionnaire['questionaire_description'];
                    $date = $questionnaire['questionaire_date'];
                    $time = $questionnaire['questionaire_time'];
                    $subject = $questionnaire['subject_code'];
                    
                
                echo "
                    <tr>
                        <td class='text-center font-roboto color-a2'>$id</td>
                        <td class='text-center font-roboto color-a2'>$title</td>
                        <td class='text-center font-roboto color-a2'>$description</td>
                        <td class='text-center font-roboto color-a2'>$date</td>
                        <td class='text-center font-roboto color-a2'>$time</td>
                        <td class='text-center font-roboto color-a2'>$subject</td>
                        <td class='text-center font-roboto color-a2'>
                            
                            <a href='notifications/viewquestionnaire/$id' rel='tooltip' data-original-title='View' class='btn-view-questionnaire btn btn-info' name='view'>
                                <i class='material-icons'>remove_red_eye</i>
                            </a>
                            <button href='departments/deletedepartment' data-id='$id' rel='tooltip' data-original-title='approved' class='btn-approved-questionnaire btn btn-success' type='button' name='approved' onclick='return false;'>
                                <i class='material-icons'>playlist_add_check</i>
                            </button>
                        
                        </td>
                    </tr>
                    ";
                }
            }
        ?>
            
    </tbody>
</table>


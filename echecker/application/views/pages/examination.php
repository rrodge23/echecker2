
<?php
  if($_SESSION['users']['user_level'] != "99"){

?>

<div class="user-subject-list">
    <span class="brand" style="font-size:20px;">SUBJECT LIST:</span>
    <table id="table-subjectList" class="table table-striped">        
        <thead>
            <tr>
                <td class="text-center font-roboto color-a2">ID</td>
                <td class="text-center font-roboto color-a2">SUBJECT CODE</td>
                <td class="text-center font-roboto color-a2">DESCRIPTION</td>
                <td class="text-center font-roboto color-a2">UNITS</td>
                <td class="text-center font-roboto color-a2">TIME</td>
                <td class="text-center font-roboto color-a2">ACTION</td>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($data as $subj){
                    $id = $subj['idsubject'];
                    $code = $subj['subject_code'];
                    $description = $subj['subject_description'];
                    $units = $subj['units'];
                    $time_start = $subj['time_start'];
                    $time_end = $subj['time_end'];
                    $idclass = $subj['idclass'];
                
                echo "
                    <tr>
                        <td class='text-center font-roboto color-a2'>$id</td>
                        <td class='text-center font-roboto color-a2'>$code</td>
                        <td class='text-center font-roboto color-a2'>$description</td>
                        <td class='text-center font-roboto color-a2'>$units</td>
                        <td class='text-center font-roboto color-a2' id='sample'>$time_start-$time_end</td>
                        <td class='text-center font-roboto color-a2'>
                        <a rel='tooltip' data-original-title='View Questionaires' class='btn btn-info' href='examinations/userquestionairelist/$idclass'>
                            <i class='material-icons'>remove_red_eye</i>
                        </a>    
                       
                        </td>
                    </tr>
                    ";
                }
            ?>
                
        </tbody>
    </table>
</div> <!-- end user sujbect list div -->
<?php
  }//end if condition for !admin
?>
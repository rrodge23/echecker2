
<?php
  if($_SESSION['users']['user_level'] != "99"){
   
?>

<div class="user-subject-list">
    <a rel='tooltip' data-original-title='Add' class='pull-right btn btn-success' type='button' name='create' href="examinations/addQuestionaire/<?php echo $data["idsubject"];?>">
        <i class='material-icons'>add</i>
  </a>
    <span class="brand" style="font-size:20px;">QUESTIONNAIRE LIST:</span>
    <table id="table-subjectList" class="table table-striped">        
        <thead>
            <tr>
                <td class="text-center font-roboto color-a2">ID</td>
                <td class="text-center font-roboto color-a2">TITLE</td>
                <td class="text-center font-roboto color-a2">DESCRIPTION</td>
                <td class="text-center font-roboto color-a2">DAY</td>
                <td class="text-center font-roboto color-a2">TIME</td>
                <td class="text-center font-roboto color-a2">STATUS</td>
                <td class="text-center font-roboto color-a2">ACTION</td>
            </tr>
        </thead>
        <tbody>
            <?php
                if($data["data"]){
                    foreach($data as $questionaire){
                        $id = $questionaire['idquestionaire'];
                        $title = $questionaire['questionaire_title'];
                        $description = $questionaire['questionaire_description'];
                        $day = $questionaire['questionaire_day'];
                        $time = $questionaire['questionaire_time'];
                        $status = $questionaire['questionaire_status'];
                        
                    
                    echo "
                        <tr>
                            <td class='text-center font-roboto color-a2'>$id</td>
                            <td class='text-center font-roboto color-a2'>$title</td>
                            <td class='text-center font-roboto color-a2'>$description</td>
                            <td class='text-center font-roboto color-a2'>$time</td>
                            <td class='text-center font-roboto color-a2'>$status</td>
                            
                            <td class='text-center font-roboto color-a2'>
                                
                            <form action='examinations/userquestionairelist' method='POST' id='frm-userquestionairelist'>
                                <input type='hidden' value=$id name='id'>
                                <button rel='tooltip' data-original-title='View Questionaires' class='btn-view-questionaire btn btn-info' type='submit' form='frm-userquestionairelist'>
                                    <i class='material-icons'>remove_red_eye</i>
                                </button>
                            </form>
                                
                                
                            
                            </td>
                        </tr>
                        ";
                    }
                }
            ?>
                
        </tbody>
    </table>
</div> <!-- end user sujbect list div -->
<?php
  }//end if condition for !admin
?>

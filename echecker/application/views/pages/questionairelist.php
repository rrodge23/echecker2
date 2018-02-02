
<?php
  if($_SESSION['users']['user_level'] != "99"){
    /*
    echo "<pre>";
    print_r($data["data"]);
    echo "</pre>";
    */
  
?>

<div class="user-subject-list">

    <?php 
        if($data["data"]){
            if(isset($data["data"][0]["subject_code"]) && isset($data["data"][0]["subject_description"])){
                echo '<div class="row">
                        <span>Subject Code:</span><span>'.$data["data"][0]["subject_code"].'</span>
                    </div>
                    <div class="row">
                            <span>Subject Description:</span><span>'.$data["data"][0]["subject_description"].'</span>
                    </div>';
            }
        }
        if($_SESSION['users']['user_level'] == "2"){ 
        echo "
            <a rel='tooltip' data-original-title='Add' class='pull-right btn btn-success' type='button' name='create' href='examinations/addQuestionaire/".$data["idsubject"]."'>
                <i class='material-icons'>add</i>
            </a>
            ";
        }
    ?>
    <span class="brand" style="font-size:20px;">QUESTIONNAIRE LIST:</span>
    <table id="table-subjectList" class="table table-striped">        
        <thead>
            <tr>
                <td class="text-center font-roboto color-a2">ID</td>
                <td class="text-center font-roboto color-a2">TITLE</td>
                <td class="text-center font-roboto color-a2">DESCRIPTION</td>
                <td class="text-center font-roboto color-a2">DAY</td>
                <td class="text-center font-roboto color-a2">TIME</td>
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
                if($data["data"]){
                    foreach($data["data"] as $key=>$questionaire){
                    
                            $id = $questionaire['idquestionaire'];
                            $title = $questionaire['questionaire_title'];
                            $description = $questionaire['questionaire_description'];
                            $day = $questionaire['questionaire_date'];
                            $time = $questionaire['questionaire_time'];
                            $status = $questionaire['questionaire_status'];
                            
                        
                        echo "
                            <tr>
                                <td class='text-center font-roboto color-a2'>$id</td>
                                <td class='text-center font-roboto color-a2'>$title</td>
                                <td class='text-center font-roboto color-a2'>$description</td>
                                <td class='text-center font-roboto color-a2'>$day</td>
                                <td class='text-center font-roboto color-a2'>$time</td>";
                                if($_SESSION['users']['user_level'] == "2"){
                                    echo "<td class='text-center font-roboto color-a2'>$status</td>";
                                }
                                
                        echo        "<td class='text-center font-roboto color-a2'>
                                    
                                <form action='examinations/userquestionairelist' method='POST' id='frm-userquestionairelist'>
                                    <input type='hidden' value=$id name='id'>";
                        if($_SESSION['users']['user_level'] == "1"){
                            echo "<a rel='tooltip' data-original-title='View Questionnaires' class='btn-view-questionaire btn btn-info' href='examinations/examine/$id'>
                                    <i class='material-icons'>remove_red_eye</i>
                                </a>";
                        }
                                    
                        if($_SESSION['users']['user_level'] == "2"){
                            echo "<button href='departments/deletedepartment' data-id='$id' rel='tooltip' data-original-title='Delete' class='btn-delete-questionaire btn btn-danger' type='submit' name='delete' onclick='return false;'>
                                    <i class='material-icons'>delete</i>
                                </button>";
                        }  
    
                        echo "       </form>
                                    
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

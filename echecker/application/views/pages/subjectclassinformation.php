<?php
    
?>
<?php 
    if(isset($data[0]['subject_code'])){ 
?>
<h6><i><b>SUBJECT CODE:</b> <?=$data[0]['subject_code'];?></i></h6>
<h6><i><b>DESCRIPTION :</b> <?=$data[0]['subject_description'];?></i></h6>
<?php 
    }
?>
<div class="row">
<h5><b>STUDENT LIST:</b></h5>
<button rel='tooltip' data-original-title='Add' class='pull-right btn-add-student btn btn-success' type='button' name='create' onclick='return false;' data-isadmin='0' data-idsubject='<?=$data[0]['idsubject'];?>'>
    <i class='material-icons'>add</i>
</button>
<table id="table-studentslist" class="table table-striped" style='width:100%;'>        
    <thead>
        <tr>
            <td class="text-center font-roboto color-a2">ID</td>
            <td class="text-center font-roboto color-a2">CODE</td>
            <td class="text-center font-roboto color-a2">NAME</td>
            <td class="text-center font-roboto color-a2">DEPARTMENT</td>
            <td class="text-center font-roboto color-a2">COURSE</td>
            <td class="text-center font-roboto color-a2">YEAR LEVEL</td>
            <td class="text-center font-roboto color-a2">ACTION</td>
        </tr>
    </thead>
    <tbody class="student-list-tablebody">
        <?php
            if($data){
                foreach($data as $u){
                    $id = $u['idusers'];
                    $code = $u['code'];
                    $firstname = $u['firstname'];
                    $middlename = $u['middlename'];
                    $lastname = $u['lastname'];
                    $department = $u['department_name'];
                    $course = $u['course_name'];
                    $user_level = $u['user_level'];
                    $year_level = $u['year_level'];
                    if($user_level == '1'){
                        echo "
                            <tr>
                                <td class='text-center'>$id</td>
                                <td class='text-center'>$code</td>
                                <td class='text-center'>$lastname, $firstname $middlename</td>
                                <td class='text-center'>$department</td>
                                <td class='text-center'>$course</td>
                                <td class='text-center'>$year_level</td>
                                <td class='text-center'>
                                    <button data-id='$id' data-level='$user_level' rel='tooltip' data-original-title='Update' class='btn-update-user btn btn-info' type='button' name='update' onclick='return false;' data-isadmin='0' data-idsubject='".$data[0]["idsubject"]."'>
                                        <i class='material-icons'>create</i>
                                    </button>
                                    <button href='users/deleteuser' data-id='$id' rel='tooltip' data-original-title='Delete' class='btn-delete-user btn btn-danger' type='submit' name='deleteUser' onclick='return false;'>
                                        <i class='material-icons'>delete</i>
                                    </button>
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
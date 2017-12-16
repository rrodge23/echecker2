<?php

?>
<button rel='tooltip' data-original-title='Add' class='pull-right btn-add-course btn btn-success' type='button' name='create' onclick='return false;'>
    <i class='material-icons'>add</i>
</button>
<table id="table-courselist" class="table table-striped">        
    <thead>
        <tr>
            <td class="text-center font-roboto color-a2">ID</td>
            <td class="text-center font-roboto color-a2">COURSE NAME</td>
            <td class="text-center font-roboto color-a2">DESCRIPTION</td>
            <td class="text-center font-roboto color-a2">ACTION</td>

        </tr>
    </thead>
    <tbody>
        <?php
            foreach($data as $dept){
                $id = $dept['idcourse'];
                $name = $dept['course_name'];
                $description = $dept['course_description'];
                ;
            
            echo "
                <tr>
                    <td class='text-center font-roboto color-a2'>$id</td>
                    <td class='text-center font-roboto color-a2'>$name</td>
                    <td class='text-center font-roboto color-a2'>$description</td>
                    <td class='text-center font-roboto color-a2'>
                        
                        <button data-id='$id' rel='tooltip' data-original-title='Update' class='btn-update-course btn btn-info' type='button' name='update' onclick='return false;'>
                            <i class='material-icons'>update</i>
                        </button>
                        <button href='courses/deletecourse' data-id='$id' rel='tooltip' data-original-title='Delete' class='btn-delete-course btn btn-danger' type='submit' name='deletecourse' onclick='return false;'>
                            <i class='material-icons'>delete</i>
                        </button>
                    
                    </td>
                </tr>
                ";
            }
        ?>
            
    </tbody>
</table>
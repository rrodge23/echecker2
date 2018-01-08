<?php

?>
<button rel='tooltip' data-original-title='Add' class='pull-right btn-add-classes-subject btn btn-success' type='button' name='create' onclick='return false;'>
    <i class='material-icons'>add</i>
</button>
<table id="table-classlist" class="table table-striped">        
    <thead>
        <tr>
            <td class="text-center font-roboto color-a2">ID</td>
            <td class="text-center font-roboto color-a2">CLASS NAME</td>
            <td class="text-center font-roboto color-a2">DESCRIPTION</td>
            <td class="text-center font-roboto color-a2">ROOM</td>
            <td class="text-center font-roboto color-a2">ACTION</td>

        </tr>
    </thead>
    <tbody>
        <?php
            foreach($data as $class){
                $id = $class['idclass'];
                $name = $class['class_name'];
                $description = $class['class_description'];
                $room_name =  $class['room_name'];
                ;
            
            echo "
                <tr>
                    <td class='text-center font-roboto color-a2'>$id</td>
                    <td class='text-center font-roboto color-a2'>$name</td>
                    <td class='text-center font-roboto color-a2'>$description</td>
                    <td class='text-center font-roboto color-a2'>$room_name</td>
                    <td class='text-center font-roboto color-a2'>
                        
                        <button data-id='$id' rel='tooltip' data-original-title='Update' class='btn-update-class btn btn-info' type='button' name='update' onclick='return false;'>
                            <i class='material-icons'>update</i>
                        </button>
                        <button href='classes/deleteclasses' data-id='$id' rel='tooltip' data-original-title='Delete' class='btn-delete-class-subject btn btn-danger' type='submit' name='deleteclass' onclick='return false;'>
                            <i class='material-icons'>delete</i>
                        </button>
                    
                    </td>
                </tr>
                ";
            }
        ?>
            
    </tbody>
</table>
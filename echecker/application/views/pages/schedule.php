<?php

?>


<button rel='tooltip' data-original-title='Add' class='pull-right btn-add-schedule btn btn-success' type='button' name='create' onclick='return false;'>
    <i class='material-icons'>add</i>
</button>
<table id="table-scheduleList-main" class="table table-striped">        
    <thead>
        <tr>
            <td class="text-center font-roboto color-a2">ID</td>
            <td class="text-center font-roboto color-a2">CODE</td>
            <td class="text-center font-roboto color-a2">DAY</td>
            <td class="text-center font-roboto color-a2">TIME START</td>
            <td class="text-center font-roboto color-a2">TIME END</td>
            <td class="text-center font-roboto color-a2">STATUS</td>
            <td class="text-center font-roboto color-a2">ACTION</td>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($data as $sched){
                $id = $sched['idschedule'] ;
                $code = $sched['schedule_code'];
                $day = $sched['day'];
                $time_start = $sched['time_start'];
                $time_end = $sched['time_end'];
                $status = $sched['status'];            
            echo "
                <tr>
                    <td class='text-center font-roboto color-a2'>$id</td>
                    <td class='text-center font-roboto color-a2'>$code</td>
                    <td class='text-center font-roboto color-a2'>$day</td>
                    <td class='text-center font-roboto color-a2'>$time_start</td>
                    <td class='text-center font-roboto color-a2'>$time_end</td>
                    <td class='text-center font-roboto color-a2'>$status</td>
                    <td class='text-center font-roboto color-a2'>
                        <button data-id='$id' rel='tooltip' data-original-title='Update' class='btn-update-schedule btn btn-info' type='button' name='update' onclick='return false;'>
                            <i class='material-icons'>update</i>
                        </button>
                        <button href='schedules/deleteschedule' data-id='$id' rel='tooltip' data-original-title='Delete' class='btn-delete-schedule btn btn-danger' type='submit' name='deleteschedule' onclick='return false;'>
                            <i class='material-icons'>delete</i>
                        </button>
                    </td>
                </tr>
                ";
            }
        ?>
            
    </tbody>
</table>
<?php

        if($_SESSION["users"]["position"] == "2"){
                
        }










        date_default_timezone_set('Asia/Manila');
        
        $d = DateTime::createFromFormat('H:i',Date('H:i'));
        $da = DateTime::createFromFormat('H:i',Date('12:59'));
        print_r($d);
        echo '<br>';
        print_r($da);
        if($d > $da){

        }
        echo '<br>';
        if($d > $da){
                echo "asdfasdfjkshfljkshfljsdhflasdhjf";
        }
       
        
        
?>
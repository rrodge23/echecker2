<?php

        if($_SESSION["users"]["position"] == "2"){
                
        }

        $a = "anak ng tinapa";
        $b = "asdf dfgdgefg asfgf as as/as anak ng tinapaasdasdsasas as";
        $b = preg_replace("/\b($a)\b/",'<span style="background-color:yellow;">$1</span>',$b);
        $c = preg_match_all("/\b($a)\b/",$b);

        echo $c;
?>
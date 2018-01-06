<?php
    if($_SESSION['users']['user_level'] == "2"){
       echo '<div id="splitter">
       <div style="overflow: hidden;">
           <div style="border: none;" id="listbox">
           </div>
       </div>
       <div style="overflow: hidden;" id="ContentPanel">
       </div>
   </div>';
    }


?>
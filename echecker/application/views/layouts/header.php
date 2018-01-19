

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    if($this->uri->segment(1) != "" ){
    ?>
    <title>E Checker</title>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <base href="<?=base_url();?>"> 
    <link href= "assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/> 
    <link href= "assets/css/material-dashboard.css" rel="stylesheet" type="text/css"/> 
    <link href= "assets/css/jqx.base.css" rel="stylesheet" type="text/css"/> 
    <link href= "assets/css/animate.min.css" rel="stylesheet" type="text/css"/> 
    <!-- <link href= "assets/css/paper-dashboard.css" rel="stylesheet" type="text/css"/>  -->
    <link href= "assets/css/demo.css" rel="stylesheet" type="text/css"/> 
    <link href= "assets/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/> 
    <!--<link href= "assets/css/themify-icons.css" rel="stylesheet" type="text/css"/> -->
    <!-- <link href= "assets/css/material.css" rel="stylesheet" type="text/css"/> -->
    <link href= "assets/css/material-icons.css" rel="stylesheet" type="text/css"/>
    <link href= "assets/css/fa.css" rel="stylesheet" type="text/css"/>
    <link href= "assets/css/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
    <link href= "assets/css/datepicker.css" rel="stylesheet" type="text/css"/>
    <link href= "assets/css/dataTables.css" rel="stylesheet" type="text/css"/>
    <link href= "assets/css/sweetalert.css" rel="stylesheet" type="text/css"/>
    <link href= "assets/css/bootstrap-duration-picker.css" rel="stylesheet" type="text/css"/>
    
    <!-- <link href= "assets/css/bootstrap-duallistbox.min.css" rel="stylesheet" type="text/css"/> -->
    <link href= "assets/css/fileinput.min.css" rel="stylesheet" type="text/css"/> 
    <!--<link href= "assets/css/fileinput-rtl.min.css" rel="stylesheet" type="text/css"/> -->
    <link href= "assets/css/ripples.min.css" rel="stylesheet" type="text/css"/> 
    <link href= "assets/css/fonts.css" rel="stylesheet" type="text/css"/> 
    <link href= "assets/css/default.css" rel="stylesheet" type="text/css"/>
    <script src= "assets/js/jquery-3.1.0.min.js" type="text/javascript"></script>
    <script src= "assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src= "assets/js/jqxcore.js" type="text/javascript"></script>
    <script src= "assets/js/jqxsortable.js" type="text/javascript"></script>
    <script src= "assets/js/jqxkanban.js" type="text/javascript"></script>
    <script src= "assets/js/jqxbuttons.js" type="text/javascript"></script>
    <script src= "assets/js/jqxscrollbar.js" type="text/javascript"></script>
    <script src= "assets/js/jqxsplitter.js" type="text/javascript"></script>
    <script src= "assets/js/jqxlistbox.js" type="text/javascript"></script>
    <script src= "assets/js/jqxdata.js"type="text/javascript"></script>
    <?php
    }
    ?>

    <?php
        $userSession = "";
        
        if(array_key_exists('users',$_SESSION)){
            $userSession = $_SESSION['users']['user_level'];
        }else{
            
        }
    ?>
    <script type="text/javascript">
    var __currentPath = '<?php echo $this->uri->segment(1); ?>';
    var __secondCurrentPath = '<?php echo $this->uri->segment(2); ?>';
    if(__secondCurrentPath != null || __secondCurrentPath != ""){
        __currentPath += '/'+ __secondCurrentPath;
    }
    var __userSessionUserLevelData='<?php echo $userSession;?>';
    </script>
    

    
</head>
<body>


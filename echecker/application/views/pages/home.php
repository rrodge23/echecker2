<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>E Checker</title>
    <base href="<?=base_url();?>"> 

    <link rel="stylesheet" href="assets/css/material-icons.css">
    <link rel="stylesheet" href="assets/css/homepage-design.css">
    
    <script src="assets/js/jquery-1.11.1.min.js" type="text/javascript"></script>

    <script src="assets/js/jquery-main.js" type="text/javascript"></script>
    
</head>
<body>
    
    <div id="openMenu">
        <img src="assets/img/menu.ico" alt="" style="height:80px;width:80px;">
    </div>
    <div id="closeMenu">
        <img src="assets/img/close.png" alt="" style="height:80px;width:80px;">
    </div>

    <div id="main">
        <div id="logoSection">
            <img src="assets/img/homelogo.png" alt="" style="height:100px;width:90px;">
            <h1>E CHECKER</h1>
        </div>
        <div id="menuSection">
            <ul>
                <li onmouseover = "anim('login')" class="loginMenu">
                    
                    <div id="login" class="menu">
                        LOGI
                        <div class="rotate">N</div>
                    </div>
                    
                </li>
                <li onmouseover = "anim('about')">
                    <div id="about" class="menu">
                        ABOU
                        <div class="rotate">T</div>
                    </div>
                </li>
                <li onmouseover = "anim('services')">
                    <div id="services" class="menu">
                        SERVICE
                        <div class="rotate">S</div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <script src="assets/js/homepage-script.js" type="text/javascript"></script>
</body>
</html>
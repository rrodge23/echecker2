
    function anim(targetedDiv){
        var targetedLetter = $("#"+targetedDiv+" .rotate").text();
        var asciiValue = targetedLetter.charCodeAt(0);
        var pointer = 65;
        changeChar();
        function changeChar(){
            if(pointer <= asciiValue){
                $("#"+targetedDiv+" .rotate").text(String.fromCharCode(pointer));
                pointer++;
                setTimeout(changeChar, 20);
            }else{
                $(this).stop;
            }
        }
    }

$(document).ready(function(){
    $('#openMenu').click(function(){
        $('#main') .fadeIn(200);
        $("#openMenu").animate({left:"-10%"});
        $('#closeMenu').animate({left:"93%"});
        $('.menu').animate({left:"-1%"});
        
    });
    $('#closeMenu').click(function(){
        $('#main') .fadeOut(200);
        $("#openMenu").animate({left:"0%"});
        $('#closeMenu').animate({left:"100%"});
        $('.menu').animate({left:"-50%"});
    });

    $('#menuSection ul li.loginMenu').click(function(){
        window.location.replace('login');
    });

});

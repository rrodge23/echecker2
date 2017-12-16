<style>

body{
    height: auto;
    width: 100%;
}

.container-fluid{
    padding:0px !important;
}
@media screen and (min-width: 736px){
    .homepage-header{
        height: auto;
        width: 100%;
        display:grid;
        grid-template-columns: repeat(6, 1fr);
        grid-template-rows: 75px 400px auto 300px;
        grid-template-areas:
            "title title title title title title"
            "image image image image image image"
            "cont cont cont cont cont cont"
            "footer footer footer footer footer footer";
            
        -webkit-transition: all .5 ease-in-out;
        -moz-transition: all .5 ease-in-out;
        transition: all .5 ease-in-out;
        grid-gap:10px;
    }

    .homepage-nav-grid{
        display:grid;
        grid-template-columns: repeat(6, 1fr);
        grid-template-rows: 75px 50px 300px 300px;
        grid-template-areas:
            "left left left left center right";
        grid-gap:5px;
    }
}


.homepage-header>div{
    box-shadow:0 1px 4px rgba(0,0,0,.2);
}

.homepage-header-title{
    grid-area:title;
    
}

.homepage-header-image{
    grid-area:image;
    background-image: url("/public/images/home-bg.jpg");
    background-size: cover;
    background-repeat: no-repeat;
    background-position:center;
    padding-top:25px;
   
}

.homepage-header-cont{
    text-align:center;
    grid-area:cont;
    align-items:center;
}

.homepage-header-footer{
    text-align:center;
    grid-area:footer;
    align-items:center;
    background-color:#f5f5f5;
}


/****/

.homepage-nav-left{
    grid-area:left;
}
.homepage-nav-center{
    grid-area:center;
}
.homepage-nav-right{
    grid-area:right;
    align-self:center;
    justify-self:center;
}

.homepage-btn-login{
    background:none;
    border: none;
    font-size:23px;
    color:#009785;
}

.homepage-image-text-title{
    color:white;
    font-size:100px;
    
}

.homepage-image-text-content{
    color:white;
    font-size:23px;
    font-style:italic;
}


/**
 *
 *
 */
 .card{
     box-shadow:0 1px 4px rgba(0,0,0,.2);
 }
 /*
  */

  
/**
  */

</style>





<!DOCTYPE html>
<html>
<head>
<title>UTT - Page Not Found</title>
<style type="text/css">

::selection{ background-color: #E13300; color: white; }
::moz-selection{ background-color: #E13300; color: white; }
::webkit-selection{ background-color: #E13300; color: white; }

body {
    background-color: #fff;
    margin: 40px;
    font: 13px/20px normal Helvetica, Arial, sans-serif;
    color: #4F5155;
}

a {
    color: #003399;
    background-color: transparent;
    font-weight: normal;
}

h1 {
    color: #444;
    background-color: transparent;
    font-size: 19px;
    font-weight: normal;
    margin: 0 0 14px 0;
    padding: 14px 15px 10px 15px;
}

code {
    font-family: Consolas, Monaco, Courier New, Courier, monospace;
    font-size: 12px;
    background-color: #f9f9f9;
    border: 1px solid #D0D0D0;
    color: #002166;
    display: block;
    margin: 14px 0 14px 0;
    padding: 12px 10px 12px 10px;
}

#container {
    margin: 10px;
    border: 1px solid #D0D0D0;
    -webkit-box-shadow: 0 0 8px #D0D0D0;
}

p {
    margin: 12px 15px 12px 15px;
}
</style>
</head>
<body>
    <?php 
        if(ENVIRONMENT == 'development'){
        ?>
        <div id="container">
            <h1><?php echo $heading; ?></h1>
            <?php echo $message; ?>
        </div>
        <?php
        }else{
        ?>
        <script type="text/javascript" src="<?php echo config_item('base_url');?>publics/template/default/js/jquery-1.10.2.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url');?>publics/template/default/bootstrap/css/bootstrap.css"><link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url');?>publics/template/default/style.css">
<script>
    site_id = 1;
    post_id = 20;
</script>

<div class="container">
        <!--<div class="row" style ="height: 300px; text-align: center;background-color: white; margin-top: 10px;">
            <div class="col-md-12">
                <h6 style = "line-height: 300px; font-size: 18px;"> Trang bạn truy cập không tồn tại. <a href = "<?php echo config_item('base_url');?>"><span style = "color:red;">Bấm vào đây</span></a> để quay lại trang chủ.</h6>
            </div>
        </div>-->
        <img title="Trang không tồn tại" src = "<?php echo config_item('base_url');?>/uploads/images/404.png" style = "max-width:100%; max-hight: 100%;"/>
    
    </div>

<script type="text/javascript" src="<?php echo config_item('base_url');?>publics/template/default/bootstrap/js/bootstrap.min.js"></script><script type="text/javascript" src="<?php echo config_item('base_url');?>publics/template/default/js/plugins.js"></script><script type="text/javascript" src="<?php echo config_item('base_url');?>publics/template/default/js/custom.js"></script>

<script>
$(document).ready(function(){
    $(window).scroll(function(){
        el = $('.go-top');
        if($(window).scrollTop() == 0){
            el.stop().animate({right:-70},400);
        }else{
            el.stop().animate({right:20},400);
        }
    });

    $('.go-top').mousedown(function(){
        $(this).css({"width":"55px","height":"55px"});
    });
    $('.go-top').mouseup(function(){
        $(this).css({"width":"60px","height":"60px"});
        $('body,html').animate({scrollTop:0},500);
    });
});
</script>
<style>
.go-top{
    outline:none;
    border-radius: 3px;
    box-shadow: 0 0 3px rgba(0,0,0,0.2);
    width: 60px;
    height: 60px;
    background: url(<?php echo config_item('base_url');?>publics/template/default/images/go_top.png) no-repeat center center #fff;
    display: block;
    position: fixed;
    bottom: 20px;
    right: -70px;
    z-index: 20;
    cursor: pointer;
    border: none;
}
</style>
<button class="go-top" id = "back-top"></button>
        <?php
        }
    ;?>
</body>
</html>
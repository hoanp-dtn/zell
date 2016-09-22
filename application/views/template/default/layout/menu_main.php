<?php
    function displayMenu($dataMenu,$class_ul = false, $langCode=''){
        if($langCode == '_vn'){
            $langCode = '';
        }
        $title = 'title'.$langCode;
        $dataMenu[$title] = $dataMenu[$title] != '' ? $dataMenu[$title] : $dataMenu['title'];

    ?>
        <li data-active="<?php echo slug($dataMenu[$title]);?>"><a href="<?php echo $dataMenu['link'];?>"><?php echo $dataMenu[$title];?></a>
            <?php
                if(isset($dataMenu['children'])){
                    ?>
                    <ul class='<?php echo $class_ul? "submenu" : ""; ?>'>
                    <?php
                    foreach($dataMenu['children'] as $key => $val){
                        displayMenu($val, true, $langCode);
                    }
                    ?>
                    </ul>
                    <?php
                }
            ?>
        </li>
    <?php
    }

?>
<div class="sidebar">
    <div class="bg-white">
        <a class="logo" href="<?php echo base_url(); ?>"><img src="publics/template/default/images/logo.png" alt="logo" />
        </a>
        <div class="menuleft">
            <div class="menu-mobile-icon" style="display:none;"><img src="publics/template/default/images/menu.png"><span>Menu</span></div>
            <ul>
                <li data-active="trang-chu"><a href="<?php echo site_url();?>"><?php echo lang('homepage');?></a>
                <?php 
                    if(!empty($dataMenu)){
                        foreach($dataMenu as $key => $val){
                            displayMenu($val,true, "_".$langCode);
                        }
                    }
                ?>

                <li data-active="thu-vien">
                    <a href="#"><?php echo lang('gallery');?></a>
                    <ul class="submenu">
                        <li><a href="<?php echo base_url(); ?>thu-vien/photo.html"><?php echo lang('photo');?></a></li>
                        <li><a href="<?php echo base_url(); ?>thu-vien/video.html"><?php echo lang('video');?></a></li>
                    </ul>
                </li>

                <li data-active="contact.html">
                    <a href="<?php echo base_url(); ?>contact.html"><?php echo lang('contact');?></a>
                </li>
                <div id="lavalamp"></div>
            </u l>
        </div>
    </div>
    <!-- bg-white -->
    <div class="bg-black">
        <form method="post" name="idForm" action="<?php echo base_url(); ?>contact/support?redirect=<?php echo base64_encode(current_url()) ?>">
            <div class="sidebar-form">
                <div class="sf-row">
                    <label><?php echo lang('sp24');?></label>
                    <div class="div_input">
                        <img src="publics/template/default/images/message.png">
                        <input type="text" name="phone" class="text" value="0973 059 555 " required="" readonly="readonly">
                    </div>
                </div>
                <hr class="sitebar-hr">
                <div class="sf-row">
                    <label style="padding-top:0"><?php echo lang('register');?><span><?php echo lang('get_info');?></span>
                    </label>

                    <div class="div_input">
                        <img src="publics/template/default/images/inbox.png">
                        <input type="email" name="email" class="text" value="" required="">
                    </div>
                </div>
                
                <hr class="sitebar-hr">
            </div>
            <!-- sidebar-form -->
        </form>
        <div class="clearfix"></div>
        <div class="sidebar-footer">
            <p><?php echo lang('company');?></p>
            <p><?php echo lang('company_address');?></p>
            <p>Hotline: 0973 059 555 (<?php echo lang('sp24');?>)</p>
            <p>Email: zellvvietnam@gmail.com</p>
            <span><?php echo lang('company_name');?></span>
        </div>
        <hr class="sitebar-hr">
        <div id="copy-right">Copyright © 2016 ZELL-V</div>
    </div>
    <!-- bg-black -->
</div>
<!-- sidebar -->
<script type="text/javascript">
        var pathname = $(location).attr('pathname');
        var pathArr = pathname.split("/");
        var active = false;
        for(var i = 0; i < 4; i++){
            if(pathArr[i] != ""){
                $(".menuleft ul > li[data-active='"+ pathArr[i] +"']").addClass("active");

                if($(".menuleft ul > li[data-active='"+ pathArr[i] +"']").length > 0){
                    active = true;
                    break;
                }
            }
        }
        
        if(!active){
            $(".menuleft ul > li:first-child").addClass("active");
        }
        $(".sidebar .bg-black").css({
            "height" : (parseInt($(window).height())-330) + "px"
        });
        $(".sidebar").css({
            "height" : (parseInt($(window).height())) + "px"
        });
        $(window).resize(function () {
            $(".sidebar .bg-black").css({
                "height" : (parseInt($(window).height())-330) + "px"
            });
        $(".sidebar").css({
            "height" : (parseInt($(window).height())) + "px"
        });
        });
</script>
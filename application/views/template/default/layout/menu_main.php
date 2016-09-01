<?php
    function displayMenu($dataMenu,$class_ul = false){
    ?>
        <li class="<?php echo slug($dataMenu['title']);?>"><a href="<?php echo $dataMenu['link'];?>"><?php echo $dataMenu['title'];?></a>
            <?php
                if(isset($dataMenu['children'])){
                    ?>
                    <ul class='<?php echo $class_ul? "submenu" : ""; ?>'>
                    <?php
                    foreach($dataMenu['children'] as $key => $val){
                        displayMenu($val, true);
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
        <a class="logo" href="/home/vi.html"><img src="publics/template/default/images/logo.png" alt="logo" />
        </a>
        <div class="menuleft">
            <ul>
                <?php 
                    if(!empty($dataMenu)){
                        foreach($dataMenu as $key => $val){
                            displayMenu($val,true);
                        }
                    }
                ?>

                <li>
                    <a href="#"><?php echo lang('gallery');?></a>
                    <ul class="submenu">
                        <li><a href="<?php echo base_url(); ?>thu-vien/photo.html"><?php echo lang('photo');?></a></li>
                        <li><a href="<?php echo base_url(); ?>thu-vien/video.html"><?php echo lang('video');?></a></li>
                    </ul>
                </li>
                <div id="lavalamp"></div>
            </ul>
        </div>
    </div>
    <!-- bg-white -->
    <div class="bg-black">
        <form name="idForm" target="dispoprice" action="http://www.fastbookings.biz/DIRECTORY/dispoprice.phtml">
            <div class="sidebar-form">
                <div class="sf-row">
                    <label><?php echo lang('sp24');?></label>
                    <div class="div_input">
                        <img src="publics/template/default/images/message.png">
                        <input type="text" name="AccessCode" class="text" value="">
                    </div>
                </div>
                <hr class="sitebar-hr">
                <div class="sf-row">
                    <label><?php echo lang('register');?><span><?php echo lang('get_info');?></span>
                    </label>

                    <div class="div_input">
                        <img src="publics/template/default/images/inbox.png">
                        <input type="text" name="AccessCode" class="text" value="">
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
    $(document).ready(function (argument) {
        var pathname = $(location).attr('pathname');
        var pathArr = pathname.split("/");
        var active = false;
        for(var i = 0; i < 4; i++){
            if(pathArr[i] != ""){
                $(".menuleft ul > li."+pathArr[i]).addClass("active");

                if($(".menuleft ul > li."+pathArr[i]).length > 0){
                    active = true;
                    break;
                }
            }
        }
        
        if(!active){
            $(".menuleft ul > li:first-child").addClass("active");
        }
    });
</script>
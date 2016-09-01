<?php
    function displayMenu($dataMenu,$class_ul = false){
    ?>
        <li data-active="<?php echo slug($dataMenu['title']);?>"><a href="<?php echo $dataMenu['link'];?>"><?php echo $dataMenu['title'];?></a>
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
        <a class="logo" href="<?php echo base_url(); ?>"><img src="publics/template/default/images/logo.png" alt="logo" />
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

                <li data-active="thu-vien">
                    <a href="#">Thư viện</a>
                    <ul class="submenu">
                        <li><a href="<?php echo base_url(); ?>thu-vien/photo.html">Photo</a></li>
                        <li><a href="<?php echo base_url(); ?>thu-vien/video.html">Video</a></li>
                    </ul>
                </li>

                <li data-active="contact.html">
                    <a href="<?php echo base_url(); ?>contact.html">Liên hệ</a>
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
                    <label>Tư vấn 24/24</label>
                    <div class="div_input">
                        <img src="publics/template/default/images/message.png">
                        <input type="text" name="AccessCode" class="text" value="">
                    </div>
                </div>
                <hr class="sitebar-hr">
                <div class="sf-row">
                    <label>Đăng ký<span>nhận thông tin</span>
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
            <p>Cty TNHH đầu tư thương mại & dịch vụ BT Việt Nam</p>
            <p>Lô B9 số 9A, ngõ 233 Xuân Thủy,P. Dịch Vọng Hậu, Q. Cầu Giấy Hà Nội</p>
            <p>Tel: 043-6-43-43-43</p>
            <p>Hotline: 0973 059 555 (Tư vấn 24/24)</p>
            <p>Email: zellvvietnam@gmail.com</p>
            <span>Zell-V Việt Nam</span>
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
        console.log(pathArr);
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
</script>
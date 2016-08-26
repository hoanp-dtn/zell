<?php
    function displayMenu($dataMenu,$class_ul = false){
    ?>
        <li><a href="<?php echo $dataMenu['link'];?>"><?php echo $dataMenu['title'];?></a>
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
                <!-- <li>
                    <a href="home.html">Trang chủ</a>
                </li>
                <li class="active">
                    <a href="#">Giới thiệu</a>
                    <ul class="submenu">
                        <li><a href="zellv-company.html">Công ty Zell-V</a>
                        </li>
                        <li><a href="bt-vetnam.html">BT Việt Nam</a>
                        </li>
                        <li><a href="nhau-thai-cuu.html">Nhau thai cừu</a>
                        </li>
                        <li><a href="lieu-phap-te-bao-goc.html">Liệu pháp tế bào gốc</a>
                        </li>
                        <li><a href="certificate.html">Chứng nhận và chứng chỉ</a>
                        </li>
                    </ul>
                </li>
                <li><a href="product.html">Sản phẩm</a>
                </li>
                <li><a href="#">Dịch vụ</a>
                    <ul class="submenu">
                        <li><a href="service.html">Xét nghiệm máu</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">Thư viện</a>
                    <ul class="submenu">
                        <li><a href="photo.html">Photo</a>
                        </li>
                        <li><a href="video.html">Video</a>
                        </li>
                    </ul>
                </li>
                <li><a href="news.html">Tin tức</a>
                </li>
                <li><a href="contact.html">Liên hệ</a>
                </li> -->
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
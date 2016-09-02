 <div class="footer">
    <div class="box-social">
        <div class="sf-row">
            <span>Follow us</span>
            <a target="_blank" href="https://www.facebook.com/EmeraldaResortNinhbinh?ref=hl"><span class="icon24-facebook"></span></a>
            <a target="_blank" href="https://twitter.com/Emeralda_Group"><span class="icon24-twitter"></span></a>
            <a target="_blank" href="https://www.youtube.com/user/Emeraldagroup"><span class="icon24-youtube"></span></a>
        </div>
    </div><!-- box-social -->
    <div class="mobile-footer">                                     
        <h5>EMERALDA RESORT NINH BINH</h5>
        <p>Khu Bảo Tồn Vân Long, Xã Gia Vân,</p>
        <p>Huyện Gia Viễn, Tỉnh Ninh Bình, Việt Nam</p>
        <p>[ T ] +84 303 658 243   [ F ] +84 303 658 223</p>
        <p>[ E ] info@emeraldaresort.com</p>
        <br />
        <h5>VĂN PHÒNG TẠI HÀ NỘI</h5>
        <p>Tầng 4, Tòa nhà Royal, 180 Triệu Việt Vương,</p>
        <p>Quận Hai Bà Trưng, Hà Nội, Việt Nam</p>
        <p>[ T ] +84 43 935 2502</p>
        <p>[ E ] emgsales@emeraldagroup.com</p>
        <br />
        <h5>VĂN PHÒNG TẠI TP. HỒ CHÍ MINH</h5>
        <p>Tầng 1, Centre Point, 106 Nguyễn Văn Trỗi,</p>
        <p>Quận Phú Nhuận, TP. Hồ Chí Minh, Việt Nam</p>
        <p>[ T ] +84 86 291 3030</p>
        <p>[ E ] emgsales@emeraldagroup.com</p>
        <p>Công ty CP Du lịch Tân Phú, <br />Giấy ĐKKD số 0102792890</p>
    </div><!-- mobile-footer -->
    <div class="mobile-copyright">
        <h5>Emeralda Management Group © 2014</h5>
        <p>Website by 123webdesign.vn</p>
    </div><!-- mobile-copyright -->
</div><!-- footer -->
<?php 
 $message_flashdata = $this->session->flashdata('message_flashdata');
                            if(isset($message_flashdata)&&count($message_flashdata)) {
                                if($message_flashdata['type']=='successful') {
                                ?>  
                                    <div id="noti" class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div><?php echo $message_flashdata['message']; ?></div></div>
                                <?php
                                }
                                else if($message_flashdata['type']=='error'){
                                ?>
                                    <div id="noti" class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div><?php echo $message_flashdata['message']; ?></div></div>
                            <?php
                                }
                            }
                        ?>
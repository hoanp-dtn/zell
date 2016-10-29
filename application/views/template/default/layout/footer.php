
    <footer>
        <form method="post" name="idForm" action="<?php echo site_url();?>contact/support?redirect=aHR0cDovL2xvY2FsaG9zdC96ZWxsLw==">
            <div class="sidebar-form">
                <div class="sf-row">
                    <label>tư vấn 24/24</label>
                    <div class="div_input">
                        <img src="publics/template/default/images/message.png">
                        <input type="text" name="phone" class="text" value="0973 059 555 " required="" readonly="readonly">
                    </div>
                </div>
                <hr class="sitebar-hr">
                <div class="sf-row">
                    <label style="padding-top:0">Đăng ký<span>Nhận thông tin</span>
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
            <p>CTY TNHH ĐẦU TƯ THƯƠNG MẠI &amp; DỊCH VỤ BT VIỆT NAM</p>
            <p>Lô B9 số 9A, ngõ 233 Xuân Thủy,P. Dịch Vọng Hậu, Q. Cầu Giấy Hà Nội</p>
            <p>Hotline: 0973 059 555 (tư vấn 24/24)</p>
            <p>Email: zellvvietnam@gmail.com</p>
            <span>Zell-V Việt Nam</span>
        </div>
         <div class="box-social">
            <div class="sf-row">
                <span style="margin-right:10px;">Follow us</span>
                <a target="_blank" href="https://www.facebook.com/zellvvietnam"><span class="icon24-facebook"></span></a>
                <a target="_blank" href="https://twitter.com/"><span class="icon24-twitter"></span></a>
                <a target="_blank" href="https://www.youtube.com/"><span class="icon24-youtube"></span></a>
            </div>
        </div><!-- box-social -->
        <div id="copy-right">Copyright © 2016 ZELL-V</div>
    </footer>
 <div class="footer">
    <div class="box-social">
        <div class="sf-row">
            <span style="margin-right:10px;">Follow us</span>
            <a target="_blank" href="https://www.facebook.com/zellvvietnam"><span class="icon24-facebook"></span></a>
            <a target="_blank" href="https://twitter.com/"><span class="icon24-twitter"></span></a>
            <a target="_blank" href="https://www.youtube.com/"><span class="icon24-youtube"></span></a>
        </div>
    </div><!-- box-social -->
    <div class="mobile-footer">                                     
    </div><!-- mobile-footer -->
    <div class="mobile-copyright">
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

<script type="text/javascript">
    
    function chooseLang (lang) {

        function setCookie(cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays*24*60*60*1000));
            var expires = "expires="+ d.toUTCString();
            document.cookie = cname + "=" + cvalue + "; " + expires;
        }
        var mapLang = {
            'vi': {
                'cookie_lang': 'vietnamese',
                'langcode':'vn'
            },
            'en': {
                'cookie_lang': 'english',
                'langcode':'en'
            },

        };

        var objLang = typeof mapLang[lang] != 'undefine' ? mapLang[lang] : mapLang['vi'];
        setCookie('language', objLang.cookie_lang, 30);
        location.reload();
    }

</script>

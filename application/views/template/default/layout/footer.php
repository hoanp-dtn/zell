 <div class="footer">
    <div class="box-social">
        <div class="sf-row">
            <span style="margin-right:10px;">Follow us</span>
            <a target="_blank" href="https://www.facebook.com/"><span class="icon24-facebook"></span></a>
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

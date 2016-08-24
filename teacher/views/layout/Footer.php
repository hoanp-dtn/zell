  </div>
</div>
</div>
</div>
<div class="footer-bottom">
  <div class="container">
    <div class="alignright">
    </div>
    <div class="alignleft">
      <a href="<?=base_url()?>" style="color:#33FFFF">UTT </a> © Copyright <?=date('Y')?>, All Rights Reserved - <?=isset($teacher['fullname'])?($teacher['fullname']):null?>
    </div>
    <div class="clear"></div>
  </div><!-- .Container -->
</div>
<div id="topcontrol" class="fa fa-angle-up" title="Lên Đầu Trang" style="bottom: 10px;"></div>
<script>
  $(function(){$(window).scroll(function(){if($(this).scrollTop()!=0){$('#topcontrol').fadeIn();}else{$('#topcontrol').fadeOut();}});$('#topcontrol').click(function(){$('body,html').animate({scrollTop:0},800);});});
</script>

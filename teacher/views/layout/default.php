<!DOCTYPE html>
<head>
	 <base href = '<?php echo site_url();?>'/>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <meta http-equiv="Content-Language" content="vi"/>
   <title><?php echo $title_for_layout; ?></title>
   <meta name="description" content="<?php echo $desc_for_layout; ?>" />
   <?php echo $css_for_layout;?>
   <script>
       site_url = base_url = '<?php echo site_url();?>';
   </script>
   <?php echo $js_for_layout;?>
</head>
<body id="top" class="home blog">
    <?php echo $content_for_layout; ?>
</body>
  <?php echo $js_for_footer;?>
</html>

<script type="text/javascript">
    var jsonMsg = <?php echo json_encode($sesionMsg);?>;
    $.each( jsonMsg, function( key, value ) {
        genNoty(key, value, 'topRight');
    });
</script>
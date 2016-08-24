<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo isset($title_for_layout) ? $title_for_layout : ''; ?></title>
    <meta name="description" content="<?php echo isset($desc_for_layout) ? $desc_for_layout : ''; ?>" />
    <meta name="keywords" content="<?php echo isset($keyword_for_layout) ? $keyword_for_layout : ''; ?>" />
	
	<base href= "<?php echo $this->config->base_url()?>"/>
    <!-- Styles -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,700,800" rel="stylesheet" type="text/css"><!-- Google web fonts -->
    <?php
    assets_css(
        array(
            'font-awesome/css/font-awesome.min.css',//<!-- font-awesome -->
            'js/dropdown-menu/dropdown-menu.css',//<!-- dropdown-menu -->
            'bootstrap/css/bootstrap.min.css',//<!-- Bootstrap -->
            'js/fancybox/jquery.fancybox.css',//<!-- Fancybox -->
            'js/audioplayer/audioplayer.css',//<!-- Audioplayer -->
            'style.css',//<!-- theme styles -->
        ),
        array('media' => 'screen')
    );
    ?>
    <?php echo isset($css_for_layout) ? $css_for_layout : '';?>

</head>

<body role="document">
<?php echo isset($content_for_layout) ? $content_for_layout : ''; ?>
<!-- jQuery -->
<?php
assets_js(
    array(
        'jQuery/jquery-2.1.1.min.js',
        'jQuery/jquery-migrate-1.2.1.min.js',
        'bootstrap/js/bootstrap.min.js',
        'js/dropdown-menu/dropdown-menu.js',
        'js/fancybox/jquery.fancybox.pack.js',
        'js/fancybox/jquery.fancybox-media.js',
        'js/jquery.fitvids.js',
        'js/audioplayer/audioplayer.min.js',
        'js/jquery.easy-pie-chart.js',
        'js/theme.js',
    ),
    array()

);
?>
<!-- Google Maps -->
<script src="https://maps.googleapis.com/maps/api/js?sensor=true"></script>


</body>
</html>
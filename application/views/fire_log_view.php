<!DOCTYPE html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <title>Fire Log Spark</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.2r1/build/base/base-min.css"/>
    <style type="text/css" media="screen">
        body,html{
            background-color:#2b2b2c;
            margin:0;
            padding:0;
            font-family:"Monaco",Verdana,Arial,sans-serif;
        }

        h1{

            font-weight:bold;
            color:#7485a4;
            padding:0px;
            font-size:28px;
            font-family:Georgia,Times,serif;
            margin: 20px;
            display:block;
            background-color:#222;
            padding: 20px 0px 22px 20px;
            border:1px solid #444;
            border-style:outset;
        }

        .logContainer{
            height:auto;
            display:block;
            font-size:13px;
            line-height:18px;
            overflow:auto;
            text-align:left;
            color:#8f9d6a;
            font-weight:normal;
            overflow:auto;
            padding: 10px 20px 20px 0px;
            font-family:"Monaco",Verdana,Arial,sans-serif;
            background-color:#2b2b2c;
            display:block;
            clear:both;
        }


        #nav,
        .paginationWrapper,
        #filterBar{
            display:inline-block;
            height:auto;

            padding: 20px 0px 20px 0px;
            margin: 0px 20px 10px 20px;
            background-color:#222;
            color:#c26549;
            border:1px solid #444;
            border-style:inset;
        }

        #nav{
            float:left;
            width:110px;
            padding:0;
        }

        .paginationWrapper,
        #filterBar{
            display:block;
            margin-left:0;
            padding:0px;
            font-size:12px;
        }

        .container{
            display:block;
            overflow:hidden;
        }

        a{
            display:block;
            padding: 5px;
            color:#666;
            font-size:12px;
            font-weight:normal;
            text-decoration:none;
            text-align:center;
            background-color:#282828;
            border:1px solid #444;
            border-style:outset;
        }

        #filterBar{
            margin-bottom:5px;

        }

        a:hover,
        a.active{
            text-decoration:none;
            color:#c26549;
            background-color:#222;
            border:1px solid #222;
        }

        .paginationWrapper strong{
            display:inline-block;
            padding: 5px 8px 5px 8px;
            margin:0px;
        }

        .paginationWrapper a,
        #filterBar a{
            padding: 5px 8px 5px 8px;
            margin:0px;
            display:inline-block;
        }

        .debug, .error, .info{
            display:block;
            padding:4px;
            margin:0;
            border:1px solid #444;
            border-style:outset;
            border-left:none;
            border-right:none;
            white-space: pre-wrap;
        }

        a.deleteFile{
            float:right;
            color:#c26549;
            background-color:#44393f;
        }

        .debug{
            color:#8f9d6a;
            background-color:#353635;
        }
        .error{
            color:#c26549;
            background-color:#44393f;
        }
        .info{
            color:#d8ce84;
            background-color:#444439;
        }
    </style>


</head>
<body>

    <h1><?php echo $log_file_name ?><?php if( $today ) echo ' - ' .$this->lang->line( 'fire_log_today' ); ?></h1>
    <div class="container">
    <div id="nav">
        <?php
        foreach ( $list as $file ){
            echo build_log_link( $file, $log_file_name );
        }
        ?>
        </div>
            <div class="container">
            <div id="filterBar">
            <?php
            echo build_filter_link( 'all', 'SHOW ALL' );
            echo build_filter_link( 'error', 'ERRORS' );
            echo build_filter_link( 'info', 'INFO' );
            echo build_filter_link( 'debug', 'DEBUG' );

            ?>
            <a href="<?php echo build_spark_url( array( 'delete'=>$log_file_name ), TRUE )?>" onclick="return confirm('Are You Sure?');" class="deleteFile" >DELETE CURRENT FILE</a>
            <a href="<?php echo build_spark_url( array( 'delete_all' => $log_file_name ), TRUE )?>" onclick="return confirm('Are You Sure?');" class="deleteFile" >DELETE ALL FILES</a>
            </div>
            <?php echo str_replace( "&nbsp;", '', $pagination_links ); ?>

        <div class="logContainer"><?php echo $log_contents ?></div>
        <?php echo str_replace( "&nbsp;", '', $pagination_links ); ?>
        </div>
    </div>
</body>
</html>
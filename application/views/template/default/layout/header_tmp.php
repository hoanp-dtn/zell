<!-- This one in here is responsive menu for tablet and mobiles -->
    <div class="responsive-navigation visible-sm visible-xs">
        <a href="javascript:void(0)" class="menu-toggle-btn">
            <i class="fa fa-bars"></i>
        </a>
        <div class="responsive_menu">
            <ul class="main_menu">
                <?php 
                    if(!empty($dataMenu)){
                        foreach($dataMenu as $key => $val){
                            displayMenu($val,$siteName,false);
                        }
                    }
                 ?>
            </ul> <!-- /.main_menu -->
        </div> <!-- /.responsive_menu -->
    </div> <!-- /responsive_navigation -->
<header class="site-header">
    <div class="container">
        <div class="row">
            <div class="col-md-4 header-left">
                <div class="logo">
                    <a href="<?php echo $this->config->base_url(isset($siteName)?$siteName:'utt');?>" title="<?php echo lang('utt');?>" rel="home">
                        <?php
                        $img = (isset($logo_for_site)&&!empty($logo_for_site)) ? $this->config->base_url('uploads')."/images/site/".$logo_for_site : $this->config->base_url().'publics/template/default/images/logo.png';
                        ?>
                        <img style ="width:100%;"src="<?php echo $img;?>" alt="<?php echo lang('utt');?>">
                    </a>
                </div> <!-- /.logo -->
            </div> <!-- /.header-left -->
            <div class="col-md-3">
                <h3 style="color: white; font-size: 28px; text-align: center; font-weight: bold;">
                    <?php
                        echo isset($nameHeader['name_header_'.$langCode])?$nameHeader['name_header_'.$langCode]:'';
                    ?>
                </h3>
            </div> <!-- /.col-md-4 -->

            <div class="col-md-5 header-right">

                <ul class="small-links">
						<li><a target="_blank" href="http://v1.utt.edu.vn">Giao diện cũ</a></li>
                    <?php
                        foreach ($lstCsdt as $key => $value) {
                            $k = 'name_'.$langCode;
                            if(isset($value[$k]) && $value[$k] != '')
                                echo '<li><a href="'.site_url($value['url_name']).'">'.$value[$k].'</a></li>';
                        }
                    ?>
                   
                        
                </ul>

                <ul class="small-links">
                    <li>
                        <?php echo anchor($this->lang->switch_uri('vn'), '<img src ="'.$this->config->base_url('publics/template/default/images').'/vietnamese.gif">');?>
                        <?php echo anchor($this->lang->switch_uri('vn'), lang('language_vn'));?>
                    </li>
                    <li>
                        <?php echo anchor($this->lang->switch_uri('en'), '<img src ="'.$this->config->base_url('publics/template/default/images').'/english.gif">');?>
                        <?php echo anchor($this->lang->switch_uri('en'),lang('language_en'));?></li>
                    <li><a href="<?php echo site_url('teacher.php/login');?>"><?php echo lang('teachsite');?></a>
                    <li><a href="<?php echo $this->config->base_url((isset($siteName)?$siteName:'').'/sitemap.html');?>"><?php echo lang('sitemap');?></a>
                        
                    </li>
                </ul>
                <div class="search-form">
                    <form name="search_form" method="get" action="<?php echo $this->config->base_url($siteName).'/search';?>" class="search_form">
                        <input style = "color: white;" type="text" value = "<?php echo isset($key_search)?$key_search:'';?>" name="s" placeholder="<?php echo lang('search_article');?>..." title="Search the site..." class="field_search">
                    </form>
                </div>
            </div> <!-- /.header-right -->
        </div>
    </div> <!-- /.container -->
    <script>
        $(document).ready(function(){
            $(".nav-bar-main").hover(function(){
                $(".nav-bar-main").css({"overflow":"visible"});
            });
        });
    </script>
    <div class="nav-bar-main" role="navigation" style = "overflow:hidden;">
        <div class="container">
            <nav class="main-navigation clearfix visible-md visible-lg" role="navigation">
                <ul class="main-menu sf-menu">
                    <?php
                        function displayMenu($dataMenu,$siteName,$class_ul = false){
                        ?>
                            <li><a href="<?php echo $dataMenu['link'];?>"><?php echo $dataMenu['title'];?></a>
                                <?php
                                    if(isset($dataMenu['children'])){
                                        ?>
                                        <ul class='<?php echo $class_ul? "sub-menu" : ""; ?>'>
                                        <?php
                                        foreach($dataMenu['children'] as $key => $val){
                                            displayMenu($val,$siteName);
                                        }
                                        ?>
                                        </ul>
                                        <?php
                                    }
                                ?>
                            </li>
                        <?php
                        }
                        if(!empty($dataMenu)){foreach($dataMenu as $key => $val){
                            displayMenu($val,$siteName,true);
                        }
                        }

                    ?>
					<?php
                        if($siteName == 'utt'){
                        ?>
                     <!-- <li><a href="<?php echo $this->config->base_url($siteName.'/gallery.html');?>"><?php echo lang('gallery');?></a></li> -->
					<?php } ?>
                    <?php
                        if($siteName!='utt'){
                        ?>
                        <!-- <li><a href="<?php echo $this->config->base_url($siteName.'/list_teacher.html');?>"><?php echo lang('list_teacher');?></a></li> -->
                        <?php
                        }
                    ?>
                    
                </ul> <!-- /.main-menu -->
            </nav> <!-- /.main-navigation -->
        </div> <!-- /.container -->
    </div> <!-- /.nav-bar-main -->

</header> <!-- /.site-header -->
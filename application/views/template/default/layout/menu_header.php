<div class="header">
    <div class="menu">
        <ul>
            <li>
                <a href="#"><?php echo lang('gallery');?><span class="menu-bullet"></span></a>
                <ul class="top-submenu">
                    <li></li>
                    <li><a href="<?php echo base_url()."thu-vien/photo.html"?>"><?php echo lang('photo');?></a>
                    </li>
                    <li><a href="<?php echo base_url()."thu-vien/video.html"?>"><?php echo lang('video');?></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href=""><?php echo lang('featurednews');?><span class="menu-bullet"></span></a>
                <ul class="top-submenu">
                    <li></li>
                    <?php foreach ($dataMenuNews as $key => $value): ?>
                        <li><a href="<?php echo base_url($value['link']); ?>"><?php echo $value['title']; ?></a></li>
                    <?php endforeach ?>
                </ul>
            </li>
            <li>
                <a href=""><?php echo lang('partner');?><span class="menu-bullet"></span></a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>contact.html"><?php echo lang('contact');?><span class="menu-bullet"></span></a>
            </li>
        </ul>
    </div>
    <!-- menu -->
    <div class="box-language">
        <ul>
            <li class="choose-lang <?php echo $language=='vietnamese' ? 'active' : ''?>">
                <a onclick="chooseLang('vi')"><img src="publics/template/default/images/flag-vie.png" alt="vie" />
                </a>
            </li>
            <li class="choose-lang <?php echo $language=='english' ? 'active' : ''?>">
                <a onclick="chooseLang('en')"><img src="publics/template/default/images/flag-eng.png" alt="eng" />
                </a>
            </li>
            
        </ul>
    </div>
    <!-- box-language -->

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
</div>
<!-- header -->
<section class="cat-box list-box tie-cat-1">
  <div class="cat-box-content">
    <?php
    $msg = $this->session->flashdata('notification');
    if (!empty($msg)) {
      echo '<div class="alert alert-warning alert-dismissable"><b><i class="icon fa fa-'.(isset($msg['type'])?$msg['type']:null).'"></i>Thông báo</b><br>'.(isset($msg['message'])?$msg['message']:null).'</div>';
    }
  ?>
    <?php
      if (isset($post)&&!empty($post))
      {
        foreach ($post as $key => $value) {
          echo '<article class="item-list tie_lightbox">
                <h2 class="post-box-title">
                  <a style = "text-decoration: none;" href="teacher.php/'.slug($value['user']).'-gv'.$value['user_id'].(($value['cate_id']=='998')?'/bao-cao-khoa-hoc/':(($value['cate_id']=='999')?'/tai-lieu-sinh-vien/':null)).(isset($value['id'])?(slug($value['title']).'-a'.$value['id'].'.html'):null).'" rel="bookmark">'.(isset($value['title'])?$value['title']:'Bài Không Có Tiêu đề').'</a>
                </h2>
                <p class="post-meta">
                  <span class="tie-date"><i class="fa fa-user"></i>'.(isset($value['user'])?$value['user']:'Time Post').'</span>
                  <span class="tie-date"><i class="fa fa-clock-o"></i>'.(isset($value['time_create'])?date('H:i:s d/m/y',$value['time_create']):'Time Post').'</span>
                  <span class="post-comments"><i class="fa fa-comments"></i>
                  <a href="teacher.php/'.slug($value['user']).'-gv'.$value['user_id'].(($value['cate_id']=='998')?'/bao-cao-khoa-hoc/':(($value['cate_id']=='999')?'/tai-lieu-sinh-vien/':null)).(isset($value['id'])?(slug($value['title']).'-a'.$value['id'].'.html'):null).'#comments">Bình luận</a></span>
                  '.((isset($checklog)&&!empty($checklog)&&($checklog->id=$value['user_id']))?('<span class="pull-right"><a href="'.base_url().'teacher.php/post/edit/'.$value['id'].'"><i class="fa fa-edit"></i> Chỉnh Sửa</a>&nbsp;
                    <a href="'.base_url().'teacher.php/post/del/'.$value['id'].'?redirect='.curPageURL().'" class="DelPost"><i class="fa fa-remove"></i>Xóa</a></span>'):null).'
                </p>
                <div class="post-thumbnail" >
                  <a href="teacher.php/'.slug($value['user']).'-gv'.$value['user_id'].(($value['cate_id']=='998')?'/bao-cao-khoa-hoc/':(($value['cate_id']=='999')?'/tai-lieu-sinh-vien/':null)).(isset($value['id'])?(slug($value['title']).'-a'.$value['id'].'.html'):null).'" rel="bookmark">
                  <img style = "height:170px; width:300px;" width="310" height="165" src="'.imgExist('uploads/images/news/'.(isset($value['image'])?$value['image']:null)).'" class="attachment-tie-medium wp-post-image" alt="">
                  <span class="fa overlay-icon"></span>
                  </a>
                </div>
                <div class="entry">
                  <p>'.(isset($value['description'])?cutnchar($value['description'],500).'...':'Không có mô tả bài viết').'</p>
                  <a class="more-link" href="teacher.php/'.slug($value['user']).'-gv'.$value['user_id'].(($value['cate_id']=='998')?'/bao-cao-khoa-hoc/':(($value['cate_id']=='999')?'/tai-lieu-sinh-vien/':null)).(isset($value['id'])?(slug($value['title']).'-a'.$value['id'].'.html'):null).'" >Read More »</a>
                  </div>
                  <div class="clear"></div>
                </article>';
        }
      } else echo '<article class="item-list tie_lightbox"><h4>Chưa có bài đăng nào.</h4></article>';
    ?>
    
  </div>
</section>
<?php 
  if(isset($num_row)&&!empty($num_row)){
    echo '<div class="recent-box-pagination">
                <div class="pagination">
                  <span '.(($page<=1)?'class="disabled"':"").'>
                  <a '.(($page<=1)?"":('href="teacher.php/'.slug(isset($teacher['fullname'])?$teacher['fullname']:null).'-gv'.slug(isset($teacher['id'])?$teacher['id']:null).'.page'.($page+1).'.html"')).'">← Prev</a>
                  </span>';

                  $maxpage = (int)ceil(($num_row/$post_in_page));
                  $start = (($page-2)<1)?(1):($page-2);
                  $end = (($page+2)>$maxpage)?($maxpage):($page+2);
                  for ($i=$start; $i <= $end; $i++) { 
                    if ($i==$page) {echo '<span class="current">'.$i.'</span>';}
                    else echo '<a class="page" href="teacher.php/'.slug(isset($teacher['fullname'])?$teacher['fullname']:null).'-gv'.slug(isset($teacher['id'])?$teacher['id']:null).'.page'.$i.'.html">'.$i.'</a>';
                  }

            echo '<span '.(($page>=($num_row/$post_in_page))?'class="disabled"':"").'>
                    <a '.(($page>=($num_row/$post_in_page))?"":('href="teacher.php/'.slug(isset($teacher['fullname'])?$teacher['fullname']:null).'-gv'.slug(isset($teacher['id'])?$teacher['id']:null).'.page'.($page+1).'.html"')).'">Next →</a>
                  </span>
                </div>
          </div>';
    }
?>
<script>
  $('.DelPost').click(function(event) {
      res = confirm('Bạn có chắc muốn xóa bài viết này không?');
      if (res) return true
        else return false;
    });
</script>
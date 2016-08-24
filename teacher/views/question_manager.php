</div>
<article class="post-listing post" id="the-post">
	<div class="post-inner">
  		<div class="entry">
		<div id="modalshow" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
            <form name="reply" action="teacher.php/questionmanager/reply" method="post">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Trả lời</h4>
              </div>
              <div class="modal-body">
                <input id="rfor" name="rfor" type="hidden" value="" style="display:none;">
                <input id="rfrom" name="rfrom" type="hidden" value="" style="display:none;">
                <textarea name="rvalue" id="rvalue" class="form-control" placeholder="Nhập trả lời..."></textarea>
              </div>
              <div class="modal-footer">
                <input type="submit" class="btn2 btn2-primary" value="Trả lời">
                <button type="button" class="btn2 btn2-primary" data-dismiss="modal">Đóng</button>
              </div>
             </form>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div>
			<div class="post-single-outer card-panel">

				<?php
					$msg = $this->session->flashdata('notification');
					if (isset($msg)&&!empty($msg))
					{
						if (isset($msg['success']) && !empty($msg['success'])) 
						{
							echo '<div class="alert alert-success">'.$msg['success'].'</div>';
						} else echo '<div class="alert alert-success">'.(isset($msg['error'])?$msg['error']:null).'</div>';
					}
				?>
				<table class="table table-bordered">
				<thead>
					<th>STT</th>
					<th>Tên người gửi</th>
					<th>Email</th>
					<th>Nội dung</th>
					<th>Thời gian</th>
					<th>Trạng thái</th>
					<th>Lựa chọn</th>
				</thead>
				<tbody>
				<?php
					if (isset($question)&&!empty($question))
					{
						foreach ($question as $key => $value) {
							$status = ($value['status']==1)?('<a title="Đã xét duyệt" href="teacher.php/questionmanager/changeStatus/'.$value['id'].'" class="btn btn-default btn-sm active"><i class="fa fa-square text-green" style="color:green"></i></a>'):('<a title="Chờ xét duyệt" href="teacher.php/questionmanager/changeStatus/'.$value['id'].'" class="btn btn-default btn-sm"><i class="fa fa-square text-red" style="color:red"></i></a>');
							echo '<tr><td>'.($key+1).'</td>';
							echo '<td>'.$value['name'].'</td>';
							echo '<td>'.$value['email'].'</td>';
							echo '<td>'.$value['value'].'</td>';
							echo '<td>'.date('H:i:s d/m/Y',$value['time_create']).'</td>';
							echo '<td>'.$status.'</td>';
							echo '<td><div class="btn-group">
									    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
									      Lựa chọn
									      <span class="caret"></span>
									    </button>
									    <ul class="dropdown-menu" role="menu">
									      <li><a href="teacher.php/questionmanager/edit/'.$value['id'].'">Sửa</a></li>
									      <li><a class="cmt-del" href="teacher.php/questionmanager/del/'.$value['id'].'">Xóa</a></li>
									      <li><a class="cmt-reply" href="javascript:;" reply-from="'.$value['teacher_id'].'" reply-for="'.$value['id'].'">Trả lời</a></li>
									    </ul>
									  </div>
                                  </td></tr>';
						}
					} else echo '<tr><td colspan="6">Chưa có câu hỏi nào được gửi đến</td></tr>';
				?>
				</tbody>
				</table>
				<?php 
                      if(isset($num_row)&&!empty($num_row)){
                        echo '<div class="row">
                                    <ul class="pagination">
                                      <li '.(($page<=1)?'class="disabled"':"").'>
                                      <a '.(($page<=1)?"":('href="teacher.php/questionmanager?page='.($page-1))).'">← Prev</a>
                                      </li>';

                                      $maxpage = (int)($num_row/10)+1;
                                      $start = (($page-2)<1)?(1):($page-2);
                                      $end = (($page+2)>$maxpage)?($maxpage):($page+2);
                                      for ($i=$start; $i <= $end; $i++) { 
                                        if ($i==$page) {echo '<li class="active"><a href="teacher.php/questionmanager?page='.$i.'">'.$i.'</a></li>';}
                                        else echo '<li><a href="teacher.php/questionmanager?page='.$i.'">'.$i.'</a></li>';
                                      }

                                echo '<li '.(($page>=($num_row/10))?'class="disabled"':"").'>
                                        <a '.(($page>=($num_row/10))?"":('href="teacher.php/questionmanager?page='.($page+1))).'">Next →</a>
                                      </li>
                                    </ul></div>';
                      }
                ?>
			</div>
		</div>
	</div>
</article>
<script>
	$('.cmt-del').click(function(event) {
		re = confirm('Bạn có chắc muốn xóa không?');
		if (re) return true;
		else return false;
	});
	$("a.cmt-reply").click(function(event) {
      event.preventDefault();
      var rfor = $(this).attr('reply-for');
      var rfrom = $(this).attr('reply-from');
      $("#modalshow").modal('show');
      $('#rfor').val(rfor);
      $('#rfrom').val(rfrom);
    });
</script>
<div>
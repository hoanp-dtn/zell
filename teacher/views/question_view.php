<style>
.detailBox {
    border:1px solid #bbb;
    margin-bottom: 20px;
}
.titleBox {
    background-color:#fdfdfd;
    padding:10px;
}
.titleBox label{
  color:#444;
  margin:0;
  display:inline-block;
}

.commentBox {
    padding:10px;
    border-top:1px dotted #bbb;
}
.commentBox .form-group:first-child, .actionBox .form-group:first-child {
    width:80%;
}
.commentBox .form-group:nth-child(2), .actionBox .form-group:nth-child(2) {
    width:18%;
}
.actionBox .form-group * {
    width:100%;
}
.taskDescription {
    margin-top:10px 0;
}
.message{
	border-radius: 5px;
    position: relative;
    padding: 5px 10px;
    background: #d2d6de;
    border: 1px solid #d2d6de;
    color: #444;
}
.commentList {
    padding:0;
    list-style:none;
    overflow:auto;
}
.commentList li {
    margin:0;
    margin-top:10px;
}
.commentList li ul {
    margin:0;
    margin-top:10px;
    margin-left: 15px;
}
.commentList li > div {
    display:table-cell;
}
.commenterImage {
    width:32px;
    margin-right:5px;
    height:100%;
    float:left;
}
.commenterImage img {
    border-radius:50%;
    border: 1px solid #D2D6DE;
}
.commentText p {
    margin:0;
}
.sub-text {
    color:#aaa;
    font-family:verdana;
    font-size:11px;
}
.actionBox {
    border-top:1px dotted #bbb;
    padding:10px;
}
</style>

<div class="detailBox">
    <div class="titleBox">
      <label>Câu hỏi đã gửi</label>
    </div>
    <div class="commentBox">
        <p class="taskDescription">Các câu hỏi được phê duyệt sẽ hiển thị tại đây.</p>
    </div>
    <div class="actionBox">
        <ul class="commentList" id="listQuestion">
        <?php 
			if(!empty($questionanswer)){
				foreach($questionanswer as $key => $val){
					displayQuestion($val);
				}
			}		
		?>
        </ul>
    </div>
    <div class="titleBox" id="Loadmore" value="1">
    	<input type="hidden" id="page-load" value="1" style="display:none;">
      <center><label>Load More</label></center>
    </div>
</div>	
<?php if (isset($checklog)&&!empty($checklog)&&($checklog->id==$teacher['id'])) {} else {
?>
<div id="comments">
	<div class="clear"></div>
	<div id="respond" class="comment-respond">
	<form id="commentform" class="comment-form" novalidate="">
	<p class="comment-form-author"><label for="author">Họ Tên <span class="required">*</span></label>
		<input id="qname" name="qname" type="text" class="form-control" placeholder="Nhập họ tên..." required="required">
	</p>
	<p class="comment-form-email"><label for="email">Email <span class="required">*</span></label>
		<input id="qemail" name="qemail"type="email" class="form-control" placeholder="Nhập email..." required="required">
	</p>
	<p class="comment-form-comment"><label for="comment">Nội dung <span class="required">*</span></label>
	<textarea id="qvalue" name="qvalue" class="form-control" rows="4" placeholder="Nhập nội dung..." required="required"></textarea>
	</p>
	<p><label for="captcha">Captcha <span class="required">*</span> <img src="teacher.php/question/captcha" id="imgCaptcha"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEwAACxMBAJqcGAAAAXpJREFUSIm1lbFLXEEQh7/vcscF0gVEBANJYTDaimgpCJYhTVJZp42QP0CwUAshRZoQOLC2EisVQTvxD0h7BBWJgsEUBgz6LHwHj2V97jsvAwNv9/3mm9llmIX/bE+6iHkLDALtHtcCQE29Vm/UFaDR6wR1NSv4PvDysdBhdV7dUn8ECTL1N/CuG/CAupZfRwiN+UIV+Jj6KxHc8aNU+JB6XhH+E5hIgdfUg3sge+pyZH8deJ5a/fsI4BCY7AgK+1fAXCq4E7wVwC+BN4HmUG0D45Xg3PX43yDBl4juGdCsCgd4FV4PMNMNqGj1wnesqosERlNdAoby9VmWZR+Bq1DYFznBbEKCD5G4wahSPQ7Euw/R1e0g5rRM/DVSzecS/qdIW38vK+i1+i8StAqMFHTDaiuiuwZGHzryYslI+KNelPxfKYXnVlc3Ks6iTN2kwgPUUL9VgLeAp6nwok2pO8bfhJu8y6bLACYm6uduHL/IY46AfeCkm6p7arfkXryfRye0UwAAAABJRU5ErkJggg==" title="Làm mới captcha" id="reCaptcha"></label>
		<input id="qcaptcha" type="text" style="max-width:40%" name="qcaptcha" placeholder="Nhập captcha..." required="required">
	</p>
	<p class="form-submit">
		<button id="btnQuestion" type="submit" data-loading-text="Xin chờ..." class="btn btn-default">Gửi Câu Hỏi</button>
	</p>
	<input type="text" name="reply-for" id="reply-for" style="display:none;">
	</form> 
	</div>
</div>
<?php
  }
?>
<script>
	  $('#reCaptcha').click(function(event) {
	  	$('#imgCaptcha').attr('src', 'teacher.php/question/captcha?ini='+$.now());
	  });
	  $(document).ajaxStop($.unblockUI); 
	  $('.sub-text.reply').click(function(event) {
	  	var rid = $(this).attr('reply-for');
	  	var rname = $(this).attr('reply-name');
	  	$('#reply-for').val(rid);
	  	$('#qvalue').html('@'+rname+': ');
	  	$('#qvalue').focus();
	  	$('body').scrollTo('#qvalue');
	  });
	  var page = 1;
	  $('#Loadmore').click(function(event) {
	  	$.blockUI({message: '<h5><b>Xin chờ giây lát...</b></h5>'});
	  	page++;
	  	$.ajax({
          type: "POST",
          url: "teacher.php/question/loadmore<?=(isset($teacher['id'])?'/'.$teacher['id']:null)?>",
          dataType: 'text',
          data: {page : page},
          success: function(res) {
              if (res)
              {
              	$('#listQuestion').html(res);
              } else page--;
          } 
          });
	  });
      $("#btnQuestion").click(function(event) {
      event.preventDefault();
      $.blockUI({ message: '<h5><b>Xin chờ giây lát...</b></h5>',
  					css: { 
		            border: 'none', 
		            padding: '15px', 
		            backgroundColor: '#000', 
		            '-webkit-border-radius': '10px', 
		            '-moz-border-radius': '10px', 
		            opacity: .5, 
		            color: '#fff' 
		        }});
      //setTimeout($.unblockUI, 2000)
      var name = $("#qname").val();
      var email = $("#qemail").val();
      var value = $("#qvalue").val();
      var reply = $("#reply-for").val();
      var captcha = $('#qcaptcha').val();
      $.ajax({
          type: "POST",
          url: "teacher.php/question/send<?=(isset($teacher['id'])?'/'.$teacher['id']:null)?>",
          dataType: 'text',
          data: {name : name, email : email, question : value, captcha: captcha, reply: reply},
          success: function(res) {
              if (res)
              {
              	  var result = $.parseJSON(res);
              	  if (result.error){
              	  	$.each(result.error, function(index, value) {
				      toastr.warning(value);
				    });
              	  }
              	  if (result.success){
				      toastr.success(result.success);
	                  $('#qvalue').val('');
	                  $('#qcaptcha').val('');
	                  $('#reply-for').val('');
	                  $("#reCaptcha").trigger('click');
              	  }
              }
          }
          });
      });
</script>
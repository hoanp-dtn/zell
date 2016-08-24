$(document).ready(function(){
	$("#form_comment").click(function(){
		var email = $("#email_comment").val();
		var name = $("#name_comment").val();
		var detail = $("#detail_comment").val();
		var captcha = $("#captcha").val();
		
		
		if (name.trim() == "") {

			alert("Bạn chưa nhập họ tên");

			$("#name_comment").focus();

			return (false);

		}
		if (email.trim() == "") {

			alert("Bạn chưa nhập email");

			$("#email_comment").focus();

			return (false);

		}
		var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
		
		if (!re.test(email)) {
			alert("Email không hợp lệ");

			$("#email_comment").focus();

			return false;

		}
		if (detail.trim() == "") {

			alert("Bạn chưa nhập nội dung bình luận");

			$("#detail_comment").focus();

			return (false);

		}
		if (captcha.trim() == "") {

			alert("Bạn chưa nhập captcha");

			$("#captcha").focus();

			return (false);

		}
		$.ajax({
			url: base_url+'comment/add',
			type: 'post',
			data: {email:email, name:name,detail:detail, site_id : site_id, post_id:post_id, captcha:captcha},
			success: function(result){
				alert(result);
			}
		});
		$('#imgCaptcha').attr('src', 'comment/captcha?ini='+$.now());
	});
});
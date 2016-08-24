$(function () {
  $('#table_manager').dataTable({
    "bPaginate": true,
    "bLengthChange": false,
    "bFilter": false,
    "bSort": true,
    "bInfo": true,
    "bAutoWidth": false
  });
});

    $("#select_manager").click(function(event) {
    event.preventDefault();
    var user_id = $("select#user_select").val();
    var site_id = $("button#select_manager").val();
    if (user_id == null) return false;
    {
      $.ajax({
          type: "POST",
          url: "admin/ajax/suUpdate",
          dataType: 'text',
          data: {user : user_id, site: site_id},
          success: function(res) {
              if (res)
              {
                  $('#mypopup').html(res);
              }
          }
        });
      }
    });

    $("#table_manager .close").click(function(event) {
    event.preventDefault();
    var user_id = this.value;
    var id = user_id;
    var site_id = $("button#select_manager").val();
    if (user_id == null) return false;
    {
      $.ajax({
          type: "POST",
          url: "admin/ajax/suRemove",
          dataType: 'text',
          data: {user : id , site: site_id},
          success: function(res) {
              if (res)
              {
                  $('#mypopup').html(res);
              }
          }
        });
      }
    });

setTimeout(function() {
$('#notification').fadeOut('fast');
}, 2000);
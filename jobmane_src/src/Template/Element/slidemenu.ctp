

<script>
$(document).ready(function() {

//  alert('slide');

  $('#as_worker').click(function(){
    var action = $("#as_worker").attr('href');
//    alert(action);
    $("#form-slide").attr('action', action);
    $("#form-slide")[0].submit();
    return false;
  });
  $('#as_report').click(function(){
    var action = $("#as_report").attr('href');
//    alert(action);
    $("#form-slide").attr('action', action);
    $("#form-slide")[0].submit();
    return false;
  });
  $('#as_monthly').click(function(){
    var action = $("#as_monthly").attr('href');
//    alert(action);
    $("#form-slide").attr('action', action);
    $("#form-slide")[0].submit();
    return false;
  });
  $('#as_users').click(function(){
    var action = $("#as_users").attr('href');
//    alert(action);
    $("#form-slide").attr('action', action);
    $("#form-slide")[0].submit();
    return false;
  });
  $('#as_projects').click(function(){
    var action = $("#as_projects").attr('href');
//    alert(action);
    $("#form-slide").attr('action', action);
    $("#form-slide")[0].submit();
    return false;
  });
  $('#as_president').click(function(){
    var action = $("#as_president").attr('href');
//    alert(action);
    $("#form-slide").attr('action', action);
    $("#form-slide")[0].submit();
    return false;
  });
  $('#as_materials').click(function(){
    var action = $("#as_materials").attr('href');
//    alert(action);
    $("#form-slide").attr('action', action);
    $("#form-slide")[0].submit();
    return false;
  });
  $('#as_clients').click(function(){
    var action = $("#as_clients").attr('href');
//    alert(action);
    $("#form-slide").attr('action', action);
    $("#form-slide")[0].submit();
    return false;
  });
  $('#as_categories').click(function(){
    var action = $("#as_categories").attr('href');
//    alert(action);
    $("#form-slide").attr('action', action);
    $("#form-slide")[0].submit();
    return false;
  });
  $('#as_presidents').click(function(){
    var action = $("#as_presidents").attr('href');
  //  alert(action);
    $("#form-slide").attr('action', action);
    $("#form-slide")[0].submit();
    return false;
  });
  $('#as_menu').click(function(){
    var action = $("#as_menu").attr('href');
//    alert(action);
    $("#form-slide").attr('action', action);
    $("#form-slide")[0].submit();
    return false;
  });
  $('#as_logout').click(function(){
    var action = $("#as_logout").attr('href');
//    alert(action);
    $("#form-slide").attr('action', action);
    $("#form-slide")[0].submit();
    return false;
  });
});
</script>


<form id="form-slide" class="form-slide" name="form-slide" action='' method='post'>
  <input type="hidden" name="urlfrom" value="urlfrom" />
</form>


<?php
if($auth['role'] == 'operator'):
  echo $this->element('slidemenu_operator');
elseif($auth['role'] == 'president'):
  echo $this->element('slidemenu_president');
elseif($auth['role'] == 'supervisor'):
  echo $this->element('slidemenu_supervisor');
endif
?>

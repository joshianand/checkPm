
<link href="<?php echo base_url();?>common/style/adminstyle.css" rel="stylesheet">
   
<div class="container">
    <div class="row-fluid">
        </div>
<div class="row-fluid">
<div class="span4 well">
<form method="post" action="client-groups.php">
  <fieldset>
    <legend>Add New Group</legend>
    <label>Group Name</label>
    <input name="groupname" type="text" class="input-xlarge" id="title">
    <div class="form-actions">
    <input name="action" type="hidden" value="add">
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  <button type="reset" class="btn">Cancel</button>
</div>
  </fieldset>
</form>
</div>
<div class="span8">
<h4>Client Groups</h4>
<table class="table table-striped">
<tbody><tr>
    <th>S/L</th>
    <th>ID</th>
    <th>Group Name</th>
    <th>Manage <img id="ajxspin" src="<?php echo base_url();?>common/img/blue_spinner.gif" style="visibility: hidden;"></th>
  </tr>
<tr>
    <td>1</td>
    <td>19</td>
    <td>para</td>
    <td><a href="views/bmsapp/ajax/edit.group.php?_cmd=19" data-toggle="modal"><i class="icon-pencil"></i></a> 
    <a href="views/bmsapp/ajax/delete.group.php?_cmd=19" data-toggle="modal"><i class="icon-remove"></i></a></td>
  </tr>  
</tbody></table>

</div>
</div>

    </div><!-- /container -->
   <script src="<?php echo base_url();?>common/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>common/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>common/js/common.js"></script>
 
<script>
$('#ajxspin').css('visibility','hidden');
				$('[data-toggle="modal"]').click(function(e) {
	e.preventDefault();
	$('#ajxspin').css('visibility','visible');
	var url = $(this).attr('href');
	if (url.indexOf('#') == 0) {
		$(url).modal('open');
	} else {
		$.get(url, function(data) {
			$('<div class="modal hide fade">' + data + '</div>').modal();
		}).success(function() {
			$('#ajxspin').css('visibility','hidden');
			 });
	}
});
</script>
  

<script>

	$(document).ready(function(){
		
		$.post('<?php echo base_url();?>address/group/get_count',function(data){
			
			$('#data').html(data);
			
			});
		
		});

</script>

<div id="groupmgmt" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Group Management</h3>
	</div>
	<div class="modal-body">
		<div class="btn-group">
			<a class="btn" data-toggle="dropdown"><i class="icon-plus"></i></a>
			<a class="btn"><i class="icon-trash"></i></a>
		</div>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th><input type="checkbox"></th>
					<th>Group Name</th>
					<th>Members</th>
				<tr>
			</thead>
			<tbody id="data">

			</tbody>
		</table>
		<legend>Add / Edit Group</legend>
		<form class="form-horizontal">
			<div class="control-group">
				<label class="control-label">Group Name</label>
				<div class="controls">
					<input type="text" class="input-small" placeholder="Group Name">
				</div>
				<div class="pull-right controls">
					<button class="btn btn-primary" type="button">Save</button>
				</div>
			</div>
		</form>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Close</a>
	</div>
</div>

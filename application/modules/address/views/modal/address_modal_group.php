<script>

	$(document).ready(function(){
		
		$('#hapus').click(function(){
			var id =  $('.checkbox:checkbox').map(function() {
			if(this.checked){
			   return this.value;
			  }
			}).get();
			$.post('<?php echo base_url();?>address/group/hapus_group',{id:id},function(data){
				
				console.log(data);
				
			});
			
		});
		
		$('#cekall').click(function(){
			
			var action = 'cek';
			if($('#cekall').attr('checked'))
			{
				action = 'uncek';
				$('#cekall').removeAttr('checked');

			}else{
				$('#cekall').attr('checked','checked');
			}
			console.log(action);
			$('.checkbox:checkbox').map(function() {
				if(action == 'cek'){
					$("#"+this.id).attr("checked","checked");
				}else{
					$("#"+this.id).removeAttr("checked");
				}
			});
			
			
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
			<a class="btn" id="hapus" ><i class="icon-trash"></i></a>
		</div>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th><input type="checkbox" id="cekall" ></th>
					<th>Group Name</th>
					<th>Members</th>
				<tr>
			</thead>
			<tbody>
				<?php if($group){?>
				<?php foreach($group as $g) {?>
				
				<tr>
				<td><input class="checkbox" id="id_group_<?php echo $g->id_group; ?>" type="checkbox" name="id_group[]" value="<?php echo $g->id_group; ?>" ></td>
				<td> <?php echo $g->nama_group; ?></td>
				<td><?php echo $g->jml; ?></td>
				</tr>
				<?php }?>
				<?php }?>
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

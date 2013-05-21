	<script type="text/javascript">


		$(function() {
			applyPagination();
		});
		
		function applyPagination() {
			$(".pagination a").click(function() {
				var search = $('#keyword').val();
				var url = $(this).attr("href");
					$.ajax({
						type: "POST",
						data: "ajax=1&reload=1&keyword="+search,
						url: url,
						beforeSend: function() {
								$("#tampil_data").html('');

						},
						success: function(msg) {
								$("#tampil_data").html(msg);
						}
					});
				return false;
			});

		}
			
	</script>

<legend>Filter List</legend>
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th><input type="checkbox" onclick="checkall()" id="checkall_filter"></th>
			<th>Filter Name</th>
			<th>Status</th>
			<th>Action</th>
			<th>Manage</th>
		</tr>
	</thead>
	<tbody>
	<?php if(isset($data)){?>
		<?php foreach($data as $d){?>
		<tr>
			<td><input class="filter_list" type="checkbox" value="<?php echo $d->id_filter;?>" id="filter<?php echo $d->id_filter;?>"></td>
			<td><?php echo $d->filter_name;?></td>
			
			<td><?php if($d->status == '0'){ echo 'Disabled'; }else{ echo 'Enabled'; }?></td>
			<td>
				<?php if($d->status == '1'){?>
					<div class="btn-group" >
					<a href="#" class="btn btn-small btn-success disabled">Enable</a>
					<a href="#" class="btn btn-small btn-warning" onclick="disable_filter('<?php echo $d->id_filter;?>')">Disable</a>
				</div>
				<?php } else { ?>
					<div class="btn-group">
					<a href="#" class="btn btn-small btn-success" onclick="enable_filter('<?php echo $d->id_filter;?>')">Enable</a>
					<a href="#" class="btn btn-small btn-warning disabled">Disable</a>
					</div>				
				<?php } ?>
			</td>
			<td>
			<a href="#" class="btn btn-small btn-info" onclick="edit_filter('<?php echo $d->id_filter;?>')">Edit</a>
			<a href="#" class="btn btn-small btn-danger del_button_filter" data-id_filter="<?php echo $d->id_filter;?>">Delete</a>
			</td>
		</tr>

		<?php }?>
		<?php }?>
	</tbody>
</table>
<div align="center">
<?php if(isset($paging)){ echo $paging;} ?>
</div>

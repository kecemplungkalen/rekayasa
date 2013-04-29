<legend>Filter List</legend>
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th><input type="checkbox"></th>
			<th>Filter Name</th>
			<th>Status</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php if(isset($data)){?>
		<?php foreach($data as $d){?>
		<tr>
			<td><input type="checkbox" value="<?php echo $d->id_filter;?>"></td>
			<td><?php echo $d->filter_name;?></td>
			
			<td><?php if($d->status == '0'){ echo 'Disabled'; }else{ echo 'Enabled'; }?></td>
			<td>
				<?php if($d->status == '1'){?>
					<div class="btn-group" >
					<a href="" class="btn btn-small">Apply</a>
					<a href="" class="btn btn-small btn-warning">Disable</a>
				</div>
				<?php } else { ?>
					<div class="btn-group">
					<a href="" class="btn btn-small disabled">Apply</a>
					<a href="" class="btn btn-small btn-success">Enable</a>
					</div>				
				<?php } ?>
			</td>
		</tr>
		<?php }?>
		<?php }?>
		<!---
		<tr>
			<td><input type="checkbox"></td>
			<td>Filter Udara</td>
			<td>Disabled</td>
			<td>
				<div class="btn-group">
					<a href="" class="btn btn-small disabled">Apply</a>
					<a href="apply" class="btn btn-small btn-success">Enable</a>
				</div>
			</td>
		</tr>
		-->
	</tbody>
</table>
<div align="center">
	<div class="pagination">
		<ul>
		    <li class="disabled"><a href="#">&laquo;</a></li>
		    <li class="active"><a href="#">1</a></li>
		    <li><a href="#">2</a></li>
		    <li><a href="#">3</a></li>
		    <li><a href="#">4</a></li>
		    <li><a href="#">5</a></li>
		    <li><a href="#">&raquo;</a></li>
		</ul>	  
	</div>
</div>

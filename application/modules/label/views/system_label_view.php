<script>
	function edit_label(id_labelname)
	{
		$.get('<?php echo base_url();?>label/edit_system_label/'+id_labelname,function(data){
			if(data != '')
			{
				$('#show_modal').html(data);
				$('#editsystemlabel').modal('show');
			}
			else
			{
				$('#noacc').modal('show');
			}
		
		});
		
	}
</script>
<legend>System Labels</legend>
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th></th>
			<th>Label</th>
			<th>Colour</th>
			<th>Last Message</th>
		</tr>
	</thead>
    <tbody>
	<?php if(isset($data)){ ?>
	<?php for($i=0;$i < count($data);$i++) {?>
		<tr>
			<td>
				<input type="checkbox" value="<?php echo $data[$i]['id_labelname']; ?>" > 
			</td>
			<td>
				<a href="#" onclick="edit_label('<?php echo $data[$i]['id_labelname']; ?>')"><?php echo $data[$i]['name']; ?></a>
			</td>
			<td>
				<a href="#" onclick="edit_label('<?php echo $data[$i]['id_labelname']; ?>')"><span class="label badge-<?php echo $data[$i]['color']; ?>">&nbsp;&nbsp;</span></a>
			</td>
        	<td>
				<?php if($data[$i]['last_recive']){ echo date('d F Y h:i a',$data[$i]['last_recive']->recive_date); } else{ echo 'No Data'; } ?>
			</td>			
		</tr>
	<?php } ?>
	<?php } ?>
	</tbody>
</table>



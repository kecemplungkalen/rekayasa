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
<legend>Additional Labels</legend>
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th><input type="checkbox" onclick="checkall()" id="checkall_label"></th>
			<th>Label</th>
			<th>Colour</th>
			<th>Filter</th>
			<th>Last Message</th>
		</tr>
	</thead>
    <tbody>
	<?php if(isset($data)){ ?>
	<?php for($i=0;$i < count($data);$i++) {?>
		<tr>
			<td>
				<input class="label_list" type="checkbox" value="<?php echo $data[$i]['id_labelname']; ?>" id="<?php echo $data[$i]['id_labelname']; ?>" > 
			</td>
			<td>
				<a href="#" onclick="show_edit('<?php echo $data[$i]['id_labelname']; ?>')"><?php echo $data[$i]['name']; ?></a>
			</td>
			<td>
				<a href="#" onclick="show_edit('<?php echo $data[$i]['id_labelname']; ?>')"><span class="label badge-<?php echo $data[$i]['color']; ?>">&nbsp;&nbsp;</span></a>
			<td>
				<?php if($data[$i]['filter']){ echo $data[$i]['filter']; }else { echo 'No Filter'; } ?>
			</td>
        	<td>
				<?php if($data[$i]['last_recive']){ echo date('d F Y h:i a',$data[$i]['last_recive']->recive_date); } else{ echo 'No Data'; } ?>
			</td>			
		</tr>
	<?php } ?>
	<?php } ?>

	</tbody>
</table>
<div align="center">
<?php if(isset($paging)){ echo $paging;}?>
</div>

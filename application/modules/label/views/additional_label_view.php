<script>

	function show_edit(id_labelname)
	{
		$.get('<?php echo base_url(); ?>label/edit_additional_label/'+id_labelname,function(data){
			
			$('#modal_show').html(data);
			$('#editlabel').modal('show');
		});
	}
	
</script>

<div id="modal_show">

</div>

          <div class="row-fluid">
            <div class="span12">
				

<legend>Additional Labels</legend>
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th><input type="checkbox" id="checkall_label"></th>
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
				Nama Filter
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
<?php //include("label-modal-edit.php"); ?>

            </div>
          </div>
        </div>
      </div>
    </div>

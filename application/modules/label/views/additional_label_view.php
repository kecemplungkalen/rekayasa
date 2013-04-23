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
			<th><input type="checkbox"></th>
			<th>Label</th>
			<th>Colour</th>
			<th>Filter</th>
			<th>Last Message</th>
		</tr>
	</thead>
    <tbody>
	<?php if(isset($data)){ ?>
	<?php foreach($data as $dt) {?>
		<tr>
			<td>
				<input type="checkbox" value="<?php echo $dt->id_labelname; ?>" > 
			</td>
			<td>
				<a href="#" onclick="show_edit('<?php echo $dt->id_labelname; ?>')"><?php echo $dt->name; ?></a>
			</td>
			<td>
				<a href="#" onclick="show_edit('<?php echo $dt->id_labelname; ?>')"><span class="label badge-<?php echo $dt->color; ?>">&nbsp;&nbsp;</span></a>
			<td>
				Nama Filter
			</td>
        	<td>
				19 Mei 1979<br>
				<small>02.00PM</small>
			</td>			
		</tr>
	<?php } ?>
	<?php } ?>
	<!--
		<tr>
			<td>
				<input type="checkbox"> 
			</td>
			<td>
				<a href="#editlabel" data-toggle="modal">Konfirmasi</a>
			</td>
			<td>
				<a href="#editlabel" data-toggle="modal"><span class="label badge-b6cff5">&nbsp;&nbsp;</span></a>
			<td>
				Nama Filter
			</td>
        	<td>
				19 Mei 1979<br>
				<small>02.00PM</small>
			</td>			
		</tr>
		<tr>
			<td>
				<input type="checkbox"> 
			</td>
			<td>
				<a href="#editlabel" data-toggle="modal">TekonTekon</a>
			</td>
			<td>
				<a href="#editlabel" data-toggle="modal"><span class="label badge-e3d7ff">&nbsp;&nbsp;</span></a>
			<td>
				No related filter
			</td>
        	<td>
				19 Mei 1979<br>
				<small>02.00PM</small>
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
<?php //include("label-modal-edit.php"); ?>

            </div>
          </div>
        </div>
      </div>
    </div>

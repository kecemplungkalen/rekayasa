<script>
	function edit_label(id_labelname)
	{
		$.get('<?php echo base_url();?>label/edit_system_label/'+id_labelname,function(data){
			if(data)
			{
				$('#show_modal').html(data);
				$('#editsystemlabel').modal('show');
			}
		
		});
		
	}
</script>
<div id="show_modal"> </div>
          <div class="row-fluid">
            <div class="span12">

				
<legend>System Labels</legend>
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Label</th>
			<th>Colour</th>
			<th>Filter</th>
			<th>Last Message</th>
		</tr>
	</thead>
    <tbody>
	<?php if(isset($data)){ ?>
	<?php foreach($data as $dt){?>
		<tr>
			<td>
				<a href="#" onclick="edit_label('<?php echo $dt->id_labelname; ?>');"><?php echo $dt->name;?></a>
			</td>
			<td>
				<a href="#" onclick="edit_label('<?php echo $dt->id_labelname; ?>');"><span class="label badge-<?php echo $dt->color;?>">&nbsp;&nbsp;</span></a>
			<td>
				No filter
			</td>
        	<td>
				19 Mei 1979<br>
				<small>02.00PM</small>
			</td>			
		</tr>
	<?php }?>
	<?php }?>
	<!--	
		<tr>
			<td>
				<a href="#editsystemlabel" data-toggle="modal">INBOX</a>
			</td>
			<td>
				<a href="#editsystemlabel" data-toggle="modal"><span class="label badge-b6cff5">&nbsp;&nbsp;</span></a>
			<td>
				No filter
			</td>
        	<td>
				19 Mei 1979<br>
				<small>02.00PM</small>
			</td>			
		</tr>
		<tr>
			<td>
				<a href="#editsystemlabel" data-toggle="modal">Sent</a>
			</td>
			<td>
				<a href="#editsystemlabel" data-toggle="modal"><span class="label badge-b6cff5">&nbsp;&nbsp;</span></a>
			<td>
				Nama Filter
			</td>
        	<td>
				19 Mei 1979<br>
				<small>02.00PM</small>
			</td>			
		</tr>
		-->
	</tbody>
</table>
<?php //include("label-system-modal-edit.php"); ?>
<div id="label_system_modal"> </div>
            </div>
          </div>
        </div>
      </div>
    </div>


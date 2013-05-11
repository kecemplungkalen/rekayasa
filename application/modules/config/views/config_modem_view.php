<script type="text/javascript">
	function checkall_modem()
	{		
		var action = 'cek';
		if($('#checkall_modem').attr('checked'))
		{
			action = 'uncek';
			$('#checkall_modem').removeAttr('checked');

		}else{
			$('#checkall_modem').attr('checked','checked');
		}
		
		$('.modem_list:checkbox').map(function() {
			if(action == 'cek'){
				$("#"+this.id).prop('checked', true);
			}else{
				$("#"+this.id).removeAttr("checked");
			}
		});
	}
	
	
	$(document).ready(function(){
		

		$('#hapus_modem').click(function(){
			
			var mod =  $('.modem_list:checkbox').map(function() {
				if(this.checked){
				   return this.value;
				  }
			}).get();
			
			$.post('<?php echo base_url();?>config/modem/hapus_modem',{mod:mod},function(ret){
				if(ret)
				{
					location.reload();
				}
			});
			
		});
		
	});
	

</script>

<div id="modem" class="tab-pane active">
	<legend>
		Modem List
	</legend>
	<div class="btn-group">
		<a class="btn dropdown-toggle" id="add_config_modem">+ <i class="icon-hdd"></i></a>
		<a class="btn" id="hapus_modem"><i class="icon-trash"></i></a>
	</div>
	<hr>
	<div id="warn" class="alert alert-error hide">
	  <strong>Warning!</strong> 
	</div>
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th><input type="checkbox" id="checkall_modem" onclick="checkall_modem()"></th>
				<th>Name</th>
				<th>Phone ID</th>
				<th>Number</th>
				<th>SMS Terkirim</th>
				<th>SMS Diterima</th>
				<th>Signal</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
		<?php if(isset($data)){?>
			<?php for($i=0;$i < count($data);$i++){?>
			<tr>
				<td><input class="modem_list" type="checkbox" id="modem_<?php echo $data[$i]['id_config_modem']; ?>" value="<?php echo $data[$i]['id_config_modem']; ?>"></td>
				<td><a href="#" onclick="edit_config_modem('<?php echo $data[$i]['id_config_modem']; ?>');"><?php echo $data[$i]['name']; ?></a></td>
				<td><?php echo $data[$i]['phoneID']; ?></td>
				<td><?php echo $data[$i]['number']; ?></td>
				<td><?php if(isset($data[$i]['sent'])){ echo $data[$i]['sent']; }?></td>
				<td><?php if(isset($data[$i]['received'])){echo $data[$i]['received'];}?></td>
				<td> <?php if(isset($data[$i]['signal'])){ echo $data[$i]['signal'];} ?> <i class="icon-signal"> </i></td>
				<td > <?php if($data[$i]['status'] == '1'){ ?>
				<i id="status_modem_<?php echo $data[$i]['phoneID']; ?>" class="active icon-ok"> </i><?php } else{ ?>
				<i id="status_modem_<?php echo $data[$i]['phoneID']; ?>" class="icon-ban-circle" ></i><?php } ?> 
				<?php if($data[$i]['default'] == '1'){?>
				<i class="icon-star"></i><?php } ?> </td>
			</tr>
			<script type="text/javascript">
				$(document).ready(function(){
				var cek_phone = $('#status_modem_<?php echo $data[$i]['phoneID']; ?>').hasClass('active');
					if(cek_phone != true)
					{
						$('#warn').show();
						$('#warn').append('<br> Modem <strong><?php echo $data[$i]['phoneID']; ?></strong> Saat ini Offline');

					}
				});
			
			</script>
			<?php }?>
		<?php }?>
		</tbody>
	</table>
</div>

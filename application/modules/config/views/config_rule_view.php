<script type="text/javascript">
	function checkall()
	{		
		var action = 'cek';
		if($('#checkall_rule').attr('checked'))
		{
			action = 'uncek';
			$('#checkall_rule').removeAttr('checked');

		}else{
			$('#checkall_rule').attr('checked','checked');
		}
		
		$('.rule_list:checkbox').map(function() {
			if(action == 'cek'){
				$("#"+this.id).prop('checked', true);
			}else{
				$("#"+this.id).removeAttr("checked");
			}
		});
	}
	
	$(document).ready(function(){
		
		$('#hapus_rule').click(function(){
			
			var value =  $('.rule_list:checkbox').map(function() {
				if(this.checked){
				   return this.value;
				  }
			}).get();
			
			$.post('<?php echo base_url();?>config/rule/hapus_rule',{value:value},function(data){
				
				if(data)
				{
					location.reload();
				}
			});
			
		});
		
	});

</script>

<div id="rule" class="tab-pane">
	<legend>Sending Rule</legend>
	<div class="btn-group">
		<a class="btn dropdown-toggle" id="add_config_rule">+ <i class="icon-th-list"></i></a>
		<a class="btn" id="hapus_rule"><i class="icon-trash"></i></a>
	</div>
	<hr>
	<div class="span6">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th><input id="checkall_rule" type="checkbox" onclick="checkall()"></th>
					<th>Address Book Group</th>
					<th>Modem</th>
				</tr>
			</thead>
			<tbody>
			<?php if($rule){?>
				<?php for($i=0;$i<count($rule);$i++){?>
				<tr>
					<td><input class="rule_list" type="checkbox" id="rule_<?php echo $rule[$i]['id_config_rule'];?>" value="<?php echo $rule[$i]['id_config_rule'];?>"></td>
					<td><a href="#" onclick="edit_config_rule('<?php echo $rule[$i]['id_config_rule'];?>')"><strong><?php echo $rule[$i]['smsc_name'];?></strong></a></td>
					<td><?php echo $rule[$i]['nama_modem'];?></td>
				</tr>
				<?php }?>
			<?php }?>
			</tbody>
		</table>
	</div>
</div>

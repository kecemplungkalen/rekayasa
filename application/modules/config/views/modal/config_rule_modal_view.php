<script type="text/javascript">
	$(document).ready(function(){
		$('#simpan').click(function(){
			$.post('<?php echo base_url();?>config/rule/add',$('#form_rule').serialize(),function(data){
				if(data== 'true')
				{
					//window.location.href += "rule";
					location.reload();
				}
				
			});
			
		});
		
		
	});

</script>

<div id="addrule" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Group Send Rule Management</h3>
	</div>
	<div class="modal-body">
		<form class="form-horizontal" id="form_rule">
			<div class="control-group">
				<label class="control-label"> Group </label>
				<div class="controls">
					<select name="id_smsc_name">
					<?php if(isset($operator)){?>
					<?php foreach($operator as $gen){?>
						<option value="<?php echo $gen->id_smsc_name;?>"><?php echo $gen->operator_name;?></option>
					<?php } ?>
					<?php } ?>
					</select>
				</div>				
			</div>
			
			<div class="control-group">
				<label class="control-label"> Phone </label>
				<div class="controls">
					<select name="id_config_modem">
					<?php if(isset($modem)){?>
					<?php foreach($modem as $md){?>
						<option value="<?php echo $md->id_config_modem;?>"><?php echo $md->nama_modem;?></option>
					<?php } ?>
					<?php } ?>
					</select>
				</div>				
			</div>
		</form>
			<div class="control-group" align="right">
				<button class="btn" data-dismiss="modal" >Batal</button>
				<button class="btn btn-primary" id="simpan">Save</button>
			</div>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Close</a>
	</div>
</div>

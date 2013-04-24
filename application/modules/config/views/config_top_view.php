<ul class="breadcrumb">
	<li>
		<a href="#">Dashboard</a>
		<span class="divider">/</span> 
	</li>
	<li class="active">Configuration</li>
</ul>
<ul class="nav nav-tabs">
	<li class="active"><a href="#modem" data-toggle="tab">Modem</a></li>
	<li><a href="#rule" data-toggle="tab">Rule</a></li>
	<li><a href="#user" data-toggle="tab">User</a></li>
</ul>
<!-- javascriptnya -->
<script>
	$(document).ready(function(){
			
		$('#add_config_modem').click(function(){
			$.get('<?php echo base_url();?>config/config_modem_modal',function(data){
				$('#show_modal').html(data);
				$('#addmodem').modal('show');
				
			});
			
		});

		$('#add_config_rule').click(function(){
			$.get('<?php echo base_url();?>config/config_rule_modal',function(data){
				$('#show_modal').html(data);
				$('#addrule').modal('show');
				
			});
			
		});
		
	});
</script> 

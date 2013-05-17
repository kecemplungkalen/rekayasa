<?php $role_id = $this->session->userdata('level');?>
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
	<li><a href="#smtp" data-toggle="tab">SMTP</a></li>
</ul>
<!-- javascriptnya -->
<script>
	$(document).ready(function(){
			
		$('#add_config_modem').click(function(){
			$.get('<?php echo base_url();?>config/modem/config_modem_modal',function(data){
				$('#show_modal').html(data);
				$('#addmodem').modal('show');
				
			});
			
		});

		$('#add_config_rule').click(function(){
			$.get('<?php echo base_url();?>config/rule/config_rule_modal',function(data){
				$('#show_modal').html(data);
				$('#addrule').modal('show');
				
			});
			
		});
		var url = document.location.toString();
		if (url.match('#')) {
			$('.nav-tabs a[href=#'+url.split('#')[1]+']').tab('show');
			$('.tab-pane').removeClass('active');
			$('#'+url.split('#')[1]).addClass('active');
		} 
	});
	
	function edit_config_rule(id_config_rule)
	{
		$.get('<?php echo base_url();?>config/rule/edit_config_rule_modal',{id_config_rule:id_config_rule},function(data){
			//editrule
			$('#show_modal').html(data);
			$('#editrule').modal('show');
		});
	}
	// Javascript to enable link to tab
	
	
	// Change hash for page-reload
	$('.nav-tabs a').on('shown', function (e) {
		window.location.hash = e.target.hash;
	});
	
	function edit_config_modem(id_config_modem)
	{
		$.get('<?php echo base_url();?>config/modem/edit_config_modem_modal',{id_config_modem:id_config_modem},function(data){
			if(data != '')
			{
				$('#show_modal').html(data);
				$('#editmodem').modal('show');
			}
			else
			{
				$('#noacc').modal('show');
			}
		});
	
	}
</script> 

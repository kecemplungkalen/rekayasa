<?php $role_id = $this->session->userdata('level');?>
<div id="configtab" class="tab-content">
	<?php if($config_modem){ echo $config_modem; } ?>
	<?php if($config_rule){ echo $config_rule;} ?>
	<?php if($config_user){ echo $config_user; } ?>
	<?php if($role_id == '1'){?>
	<?php if($config_smtp){ echo $config_smtp; } ?>
	<?php if($send_limit){ echo $send_limit; } ?>
	<?php if($config_at){ echo $config_at; } ?>
	<?php } ?>
</div>

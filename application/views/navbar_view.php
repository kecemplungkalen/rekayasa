<?php $role_id = $this->session->userdata('level');?>
<div class="navbar navbar-inverse">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="#">Rumahweb Indonesia</a>
			<div class="navbar-content">
				<ul class="nav">
					<li>
						<a href="<?php echo base_url() ?>dashboard">Home</a> 
					</li>
					<li>
						<a href="<?php echo base_url() ?>address">Address Book</a> 
					</li>
					<li>
						<a href="<?php echo base_url() ?>label">Label</a> 
					</li>
				<?php if($role_id == '1' || $role_id == '2'){?>	
					<li>
						<a href="<?php echo base_url() ?>filter">Filter</a> 
					</li>
				<?php }?>
				<?php if($role_id == '1' || $role_id == '2'){?>	
					<li>
						<a href="<?php echo base_url() ?>config">Configuration</a> 
					</li>
				<?php }?>
				</ul>
			</div>
		
			<div class="btn-group btn-inverse pull-right">
			  <a class="btn btn-inverse dropdown-toggle" data-toggle="dropdown" href="#">
				Hallo <?php echo $this->session->userdata('user_data');?>
				<span class="caret"></span>
			  </a>
			  <ul class="dropdown-menu">
				<li>
				<a href="<?php echo base_url();?>login/logoff" > Logout </a>
				</li>
			  </ul>
			</div>
		</div>
	</div>
	
	<?php if($modem){?>
		<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>	
		Modem 
		<?php for($i=0;$i < count($modem);$i++){?>
			 <strong><?php echo $modem[$i];?></strong>,  
		<?php } ?>
		Offline..!
	<?php } ?>
		</div>
</div>

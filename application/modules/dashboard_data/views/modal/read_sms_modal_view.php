<div id="readsms" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>SMS Message</h3>
	</div>
	<div class="modal-body">
		
	<?php $label=false;?>
	<?php $stat=false;?>
	<?php if(isset($data)){?>
	<?php for($d=0;$d < count($data);$d++){?>
			<?php if($data[$d]['label']){ ?>			
				<?php $label=$data[$d]['label']; ?>
					<?php for($j=0;$j < count($label); $j++){ ?>
						<?php if(in_array('sent',$label[$j])){?>
							<?php $stat=true;?>
						<?php } ?>
					<?php } ?>
				<?php if($stat){?>
				<?php $class='alert alert-success'; ?>
				<div class="<?php echo $class;?>" >
					<strong> <?php echo 'System';?></strong> 
					<small> <?php echo date('d F Y h:i a',$data[$d]['recive_date']);?></small> <br>
					<?php echo $data[$d]['content']; ?>
				</div>

				<?php } else {?>
				<?php $class='alert alert-info'; ?>	
				<div class="<?php echo $class;?>" >
				<a href="#editaddress" data-dismiss="modal" data-toggle="modal">	
				<?php if(isset($data[$d]['first_name']) || isset($data[$d]['last_name'])){ ?>
					<strong> <?php echo $data[$d]['first_name'].' '.$data[$d]['last_name'];?> (<?php echo $data[$d]['number'];?>)</strong> 
						<?php } else {?>
								<strong><?php echo $data[$d]['number'];?> </strong> 
						<?php }?></a>
					<small> <?php echo date('d F Y h:i a',$data[$d]['recive_date']);?></small> <br>

					<?php echo $data[$d]['content']; ?>				</div>

				<?php } ?>
				<?php } ?>
		<?php } ?>
			
		
		
	<?php } ?>
		<hr>
		<div>
			<div class="btn-group">
				<a class="btn"><i class="icon-hdd" ></i></a>
				<a class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-tags"></i> <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li>
						<a href=""><input type="checkbox" checked>&nbsp;&nbsp;<span class="label badge-b6cff5">&nbsp;&nbsp;&nbsp;&nbsp;</span> Konfirmasi</a>
					</li>
					<li>
						<a href=""><input type="checkbox">&nbsp;&nbsp;<span class="label badge-e3d7ff">&nbsp;&nbsp;&nbsp;&nbsp;</span> TekonTekon</a>
					</li>
				</ul>
				<a class="btn"><i class="icon-trash"></i></a>
			</div>
			<h5>Reply:</h5>
			<form>  
				<textarea rows="3" style="width:97%;"></textarea>
				<span class="help-inline">x character(s)</span>
			</form>
		</div>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Close</a>
	</div>
</div>

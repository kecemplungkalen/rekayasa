	<?php $label=false;?>
	<?php if(isset($data)){?>
		<?php for($d=0;$d < count($data);$d++){?>
				<?php if(isset($data[$d]['label'])){ ?>			
					<?php $label=$data[$d]['label']; ?>
						<?php $stat=false;?>
						<?php $draft=false;?>
						<?php for($j=0;$j < count($label); $j++){ ?>
						<!-- jika terdapat label sent -->
							<?php if(in_array('sent',$label[$j])){?>
								<?php $stat=true;?>
							<?php } ?>
							
							<?php if(in_array('outbox',$label[$j])){?>
								<?php $draft=true;?>
							<?php } ?>
							<!-- end jika sent -->
						<?php } ?>
					
					
					<?php if($stat || $draft){?>
					<?php $class='alert alert-success'; ?>
					
					<?php if($draft){?>
					
					<?php $class='alert alert-danger'; ?>
					<?php } ?>
					
					<div id="div_inbox_<?php echo $data[$d]['id_inbox']; ?>"> 
						<strong> <?php echo 'System';?></strong> 
						<small> <?php echo date('d F Y - h:i a',$data[$d]['recive_date']);?></small>
						<?php if($draft){?>
						<a  class="btn btn-mini pull-right" data-placement="bottom" rel="tooltip" data-title="Send This Message"  ><i class="icon-envelope"></i></a> 	
						<a  class="edit_draft btn btn-mini pull-right" data-placement="bottom" rel="tooltip" data-title="Edit This Message" data-content="<?php echo $data[$d]['content']; ?>" data-id_inbox="<?php echo $data[$d]['id_inbox']; ?>"><i class="icon-edit"></i></a>
						<?php } else { ?>
						<a data-placement="left" rel="tooltip" class="pull-right hapus btn btn-mini" data-toggle="tooltip" data-title="Delete" data-id_inbox="<?php echo $data[$d]['id_inbox']; ?>" ><i class="icon-trash"></i></a>
						<?php }?>
						<br><br>
					
						<div class="<?php echo $class;?>" id="id_inbox_<?php echo $data[$d]['id_inbox']; ?>">
							<?php echo $data[$d]['content']; ?>
						</div>
					
						<div class="alert alert-block hide" id="warning_delete_<?php echo $data[$d]['id_inbox']; ?>">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Warning!</strong><br>
							Are you sure you want to delete this message?
							<a class="move_trash btn btn-danger pull-right" data-id_ib="<?php echo $data[$d]['id_inbox']; ?>">Yes</a>  
							<a class="btn pull-right" data-dismiss="alert">No</a>
						</div>
					</div>

					<?php } else {?>
					<div id="div_inbox_<?php echo $data[$d]['id_inbox']; ?>"> 
					<?php $class='alert alert-info'; ?>	
					<a href="#editaddress" data-dismiss="modal" data-toggle="modal">	
					<?php if(isset($data[$d]['first_name']) || isset($data[$d]['last_name'])){ ?>
						<strong> <?php echo $data[$d]['first_name'].' '.$data[$d]['last_name'];?> (<?php echo $data[$d]['number'];?>)</strong> 
							<?php } else {?>
									<strong><?php echo $data[$d]['number'];?> </strong> 
							<?php }?></a>
						<small> <?php echo date('d F Y - h:i a',$data[$d]['recive_date']);?></small> 
						<a data-placement="bottom" rel="tooltip" class="pull-right btn hapus btn-mini" data-toggle="tooltip" data-title="Delete" data-id_inbox="<?php echo $data[$d]['id_inbox']; ?>" ><i class="icon-trash"></i></a> 
						<a data-placement="bottom" rel="tooltip" class="pull-right btn forward btn-mini" data-toggle="tooltip" data-title="Forward" data-id_inbox="<?php echo $data[$d]['id_inbox']; ?> "data-content="<?php echo $data[$d]['content']; ?>" ><i class="icon-arrow-right" ></i></a> 
						<br><br>
						<div class="<?php echo $class;?>" id="id_inbox_<?php echo $data[$d]['id_inbox']; ?>" >
							<?php echo $data[$d]['content']; ?>				
						</div>
						<div class="alert alert-block hide" id="warning_delete_<?php echo $data[$d]['id_inbox']; ?>">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Warning!</strong><br>
							Are you sure you want to delete this message?
							<a class="move_trash btn btn-danger pull-right" data-id_ib="<?php echo $data[$d]['id_inbox']; ?>" >Yes</a>  
							<a class="btn pull-right" data-dismiss="alert">No</a>
						</div>
					</div>
					<?php } ?>
					<?php } ?>
			
		<?php } ?>
		
	<?php } ?>
		<hr>
	
		<div id="balas" class="hide">
			<div id="act"> </div>
			<form id="reply"> 
				<div id="number_fwd"> 
				</div>
				<textarea id="text" name="text" rows="3" style="width:97%;" onkeyup="countChar(this)"></textarea>
				<span class="help-inline" id="charNum"> </span>
				<button type="submit"  class="btn btn-success pull-right">Send</button>
			</form>
		</div>
	

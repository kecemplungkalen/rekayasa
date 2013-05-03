<div id="readsms" class="modal hide fade " data-backdrop="static" >
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" onclick="reloadz()" aria-hidden="true">&times;</button>
		<h3>Mbah Bob Marley</h3>
	</div>
	<div class="modal-body" style="overflow-y: scroll;height:400px">
	<!-- start modal body -->
	<?php $draft=false; ?>
	<?php if($data){?>
		<?php $class=false; ?>
		
		<?php for($d=0;$d < count($data);$d++){?>
			<?php $draft = $d['tempat']; ?>
			<?php if($data[$d]['read_status'] != '0'){?>
				<?php $class='alert'; ?>
			<?php } else { ?>
				<?php $class='alert alert-success'; ?>
			<?php } ?>
			
		<!-- jika pesan lama -->
		<!-- start alert -->
		<div class="<?php echo $class ;?>">
				<?php if(isset($data[$d]['first_name']) || isset($data[$d]['last_name'])){ ?>
						<b> <?php echo $data[$d]['first_name'].' '.$data[$d]['last_name'];?></b> 
				<?php } else {?>
						<b> <?php echo $data[$d]['number'];?> </b>
				<?php }?>
		<span class="label"> <?php echo date('d F Y h:i a',$data[$d]['recive_date']);?> </span>
				<?php $label = $data[$d]['label']; if(isset($label)){ ?>
					<?php for($i=0;$i < count($label);$i++){?>
			
					<span class="label pull-right badge-<?php echo $label[$i]['color'];?>"><?php echo $label[$i]['name'];?></span> 
					<?php }?>
				<?php } ?>
		</div>
		<!-- end alert -->
		<!-- start content -->
      <div class="well">
        <p ><?php echo  $data[$d]['content']; ?></p>
      </div>
      <!-- end content -->
		<?php } ?>
    <?php } ?>
      <!--end modal body -->
	</div>
	
	<div class="modal-footer">
		<?php if($draft){?>
		<a href="#" class="btn btn-primary" id="send" >Send</a>
		<?php } else {?>
		<a class="btn btn-success">Reply</a>
		<?php } ?>	
		<a href="#" class="btn" data-dismiss="modal" aria-hidden="true" onclick="reloadz()">Close</a>
	</div>
</div>

<div id="readsms" class="modal hide fade " data-backdrop="static" >
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" onclick="reloadz()" aria-hidden="true">&times;</button>
	
	<script type="text/javascript">
	
		function load_body(thread,label)
		{
			$('#datadata').load('<?php echo base_url();?>dashboard_data/modal_body/'+thread+'/'+label);
		}
	
	</script>
	<?php if($data){?>
	<?php if(isset($data[0]['first_name']) || isset($data[0]['last_name'])){ ?>
						<h3> <?php echo $data[0]['first_name'].' '.$data[0]['last_name'];?></h3> 
				<?php } else {?>
						<h3> <?php echo $data[0]['number'];?> </h3>
				<?php }?>
	</div>
	<div class="modal-body" style="overflow-y: scroll;height:400px">
	<!-- start modal body -->
	<div id="datadata">
		<?php $class=false; ?>
		
		<?php for($d=0;$d < count($data);$d++){?>
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
				<?php  if(isset($data[$d]['label'])){ $label = $data[$d]['label'];?>
					<?php for($i=0;$i < count($label);$i++){?>
			
					<span class="label pull-right badge-<?php echo $label[$i]['color'];?>"><?php echo $label[$i]['name'];?></span> 
					<?php }?>
				<?php } ?>
		<button type="button" onclick="" aria-hidden="true"> Hapus Pesan &times;</button>
		</div>
		<!-- end alert -->
		<!-- start content -->
      <div class="well">
        <p ><?php echo  $data[$d]['content']; ?></p>
      </div>
      <!-- end content -->
		<?php } ?>
		
		<a href="#" onclick="load_body('<?php echo $data[0]['thread']?>','1')"> Tets</a>
    <?php } ?>
      <!--end modal body -->
      </div>
	</div>
	
	<div class="modal-footer">
		<a class="btn btn-success">Reply</a>
		<a href="#" class="btn" data-dismiss="modal" aria-hidden="true" onclick="reloadz()">Close</a>
	</div>
</div>

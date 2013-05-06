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
				<div id="tempat_label">
					<?php if(isset($data[0]['label'])){?>
					<?php $lbl = $data[0]['label'];?>
						<?php for($l=0;$l < count($lbl);$l++){?>
						<?php // :P ?>
						<span class="label pull-right badge-<?php echo $lbl[$l]['color'];?>"><?php echo $lbl[$l]['name'];?></span> 
						<?php }?>
						<br>
					<?php }?>
				</div>
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
			
		<!-- start content -->
	<div class="accordion" id="_<?php echo $data[$d]['id_inbox'];?> ">
		<div class="accordion-group">
			<div class="accordion-heading">
				<div class="<?php echo $class;?>">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#content" href="#content_<?php echo $data[$d]['id_inbox'];?>">
					<?php if(isset($data[$d]['first_name']) || isset($data[$d]['last_name'])){ ?>
							<b> <?php echo $data[$d]['first_name'].' '.$data[$d]['last_name'];?></b> 
					<?php } else {?>
							<b> <?php echo $data[$d]['number'];?> </b>
					<?php }?>

		
					</a>
				</div>			
			</div>
			<div id="content_<?php echo $data[$d]['id_inbox'];?>" class="accordion-body collapse in">
				
				<pre>
				<p class="text-info" ><?php echo $data[$d]['content']; ?></p>
				</pre>
			</div>
		</div>
	</div>
      <!-- end content -->
		<?php } ?>
		
		<a href="#" onclick="load_body('<?php echo $data[0]['thread']?>','1')"> Tets</a>
    <?php } ?>
      <!--end modal body -->
      </div>
	</div>
	
	<div class="modal-footer">
		<a class="btn btn-warning">Archive</a>
		<a class="btn btn-success">Reply</a>
		<a href="#" class="btn" data-dismiss="modal" aria-hidden="true" onclick="reloadz()">Close</a>
	</div>
</div>

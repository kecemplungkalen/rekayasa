	<?php if(isset($data)){?>

	<!-- start modal body -->

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
	

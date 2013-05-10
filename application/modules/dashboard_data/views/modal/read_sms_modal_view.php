<div id="readsms" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>SMS Message</h3>
	</div>
	<script type="text/javascript">
		
	$(document).ready(function(){
		$('.dropdown-menu a#labelcek').click(function(e) {
		  e.stopPropagation();
		});
		
		$('#reply').submit(function(event){
			console.log($('#submit').serialize());
			<?php if(isset($data)){?>
			var thread = '<?php echo $data[0]['thread'];?>';
			var lbl = '<?php echo $data[0]['lbl'];?>';
			<?php } ?>
			$.post('<?php echo base_url();?>dashboard/insert',$('#reply').serialize(),function(data){
				if(data == 'true')
				{
					//location.reload();
					//$('#reply').reset();
					$.get('<?php echo base_url();?>dashboard_data/modal_body',{thread:thread,label:lbl},function(data){
						$('#modal_body').html(data);
						//$('#readsms').modal('show');
			
					});
				}
			});		
			event.preventDefault();
		});
		
		$('#edit_draft').click(function(){
			var content = $(this).data('content');
			$('#text').html(content);
			
		});
		
		if($("[rel=tooltip]").length) {
			$("[rel=tooltip]").tooltip();
		}
		
	});
	

	
	function countChar(val) {
	  var len = val.value.length;
	  if (len >= 160) {
		 $('#charNum').html('<p class="text-error"> '+ len +' character(s) <p>');
	  } else {
		$('#charNum').html('<p id="jumchar"> '+len+' character(s) <p>');
	  }
	};
	</script>
	<div id="modal_body" class="modal-body">
		
	<?php $label=false;?>
	<?php if(isset($data)){?>
	<?php //var_dump($data);?>
	
		<?php for($d=0;$d < count($data);$d++){?>
				<?php if($data[$d]['label']){ ?>			
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
					<div class="<?php echo $class;?>" >
						<strong> <?php echo 'System';?></strong> 
						<small> <?php echo date('d F Y h:i a',$data[$d]['recive_date']);?></small> <br>
						<?php if($draft){?>
						<a  class="close" data-placement="bottom" rel="tooltip" data-title="Send This Message"  ><i class="icon-envelope"></i></a> 	
						<a id="edit_draft" class="close" data-placement="bottom" rel="tooltip" data-title="Edit This Message" data-content="<?php echo $data[$d]['content']; ?>" ><i class="icon-edit"></i></a>
						<?php } else { ?>
						<a class="close"><i class="icon-trash"></i></a>
						<?php }?>
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
						<a class="close"><i class="icon-trash"></i></a>
						<?php echo $data[$d]['content']; ?>				
					
					</div>

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
				<?php if(isset($list_label)){?>

				<?php foreach($list_label as $ll){?>
					<?php $attr=false;?>
					<?php for($x=0;$x< count($label);$x++){ ?>
						<?php if($label[$x]['id_labelname'] == $ll->id_labelname){?>
							<?php $attr=true ;?>
						<?php } ?>					
					<?php } ?>
						<li>
							<a id="labelcek"><input class="labelcek" id="label_to_<?php echo $ll->id_labelname;?>"type="checkbox" value="<?php echo $ll->id_labelname;?>" <?php if($attr) { echo 'checked="checked"'; }?> >&nbsp;&nbsp;<span class="label badge-<?php echo $ll->color;?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <?php echo $ll->name;?></a>
						</li>
				<?php }?>
				<?php }?>
				</ul>
				<a class="btn"><i class="icon-trash"></i></a>
			</div>
			<h5>Reply:</h5>
			<form id="reply"> 
				<input type="hidden" name="number" value="<?php echo $data[0]['number'];?>">
				<textarea id="text" name="text" rows="3" style="width:97%;" onkeyup="countChar(this)"></textarea>
				<span class="help-inline" id="charNum"> </span>
				<button type="submit"  class="btn btn-success pull-right">Send</button>
			</form>
		</div>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Close</a>
	</div>
</div>

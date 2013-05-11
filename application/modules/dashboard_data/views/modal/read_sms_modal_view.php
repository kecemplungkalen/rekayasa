<div id="readsms" class="modal hide fade" data-backdrop="static" >
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="reloadz()" >&times;</button>
		<h3>SMS Message</h3>
			<div class="btn-group">
				<a data-placement="bottom" rel="tooltip" class="show_balas btn" data-toggle="tooltip" data-title="Reply" ><i class="icon-share-alt" ></i></a> 
				<a class="move_archive btn" data-placement="bottom" rel="tooltip" data-toggle="tooltip" data-thread="<?php echo $data[0]['thread'];?>" data-title="Move To Archive"><i class="icon-hdd" ></i></a>
				<a class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-tags"></i> <span class="caret"></span></a>
				<ul class="dropdown-menu">
				<?php if(isset($list_label)){?>

				<?php foreach($list_label as $ll){?>
					<?php $attr=false;?>
					<?php for($x=0;$x< count($data);$x++){ ?>
						<?php if(isset($data[$x]['label'])){?>
						<?php $haslabel = $data[$x]['label']; ?>
							<?php for($i=0;$i < count($haslabel);$i++ ){?>
								<?php if($haslabel[$i]['id_labelname'] == $ll->id_labelname){?>
									<?php $attr=true ;?>
								<?php }?>
							<?php }?>
							
						<?php } ?>					
					<?php } ?>
						<li>
							<a id="labelcek"><input class="labelcek" id="label_to_<?php echo $ll->id_labelname;?>"type="checkbox" value="<?php echo $ll->id_labelname;?>" <?php if($attr) { echo 'checked="checked"'; }?> >&nbsp;&nbsp;<span class="label badge-<?php echo $ll->color;?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <?php echo $ll->name;?></a>
						</li>
				<?php }?>
				<?php }?>
				<li class="divider"></li>
				<li>
					<a href="#" id="terapkan_label" onclick="terapkan_label()">Apply Label</a>
				</li>
				</ul>
				<?php if($data[0]['lbl'] != 'trash'){ ?>
				<a class="btn trash" data-thread="<?php echo $data[0]['thread'];?>" data-placement="bottom" rel="tooltip" data-toggle="tooltip" data-title="Move To Trash" ><i class="icon-trash"></i></a>
				<?php } else {?>
				<a data-placement="bottom" rel="tooltip" data-toggle="tooltip" data-title="Move from Trash" class="btn move_from_trash" data-thread="<?php echo $data[0]['thread'];?>" ><i class="icon-share"></i></a>
				<?php } ?>
				<?php if($data[0]['lbl'] != 'spam'){ ?>
				<a class="mark_spam btn btn-danger" data-thread="<?php echo $data[0]['thread'];?>" >Mark as SPAM</a>
				<?php } else { ?>
				<a class="not_spam btn btn-success" data-thread="<?php echo $data[0]['thread'];?>" >Not SPAM</a>
				<?php } ?>
			</div>
			
			
		<div class="alert alert-danger hide" id="delete_<?php echo $data[0]['thread']; ?>">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Warning!</strong><br>
		Are you sure you want to delete this Thread?
		<a class="thread_trash btn btn-danger pull-right" data-id_ib="<?php echo $data[0]['thread']; ?>" >Yes</a>  
		<a class="btn pull-right" data-dismiss="alert">No</a>
		</div>		
	</div>
	
	<script type="text/javascript">
	
	$(document).ready(function(){
		
		$('.show_balas').click(function(){
			$('#balas').show();
			$('#act').append('<h5>Reply:</h5>');
			$('#reply').append('<input type="hidden" name="number" value="<?php echo $data[0]['number'];?>">');
		});
		
		$('.dropdown-menu a#labelcek').click(function(e) {
		  e.stopPropagation();
		});
		
		$('#reply').submit(function(event){
			event.preventDefault();
			<?php if(isset($data)){?>
			var thread = '<?php echo $data[0]['thread'];?>';
			var lbl = '<?php echo $data[0]['lbl'];?>';
			<?php } ?>
			$.post('<?php echo base_url();?>dashboard/insert',$('#reply').serialize(),function(data){
				if(data == 'true')
				{
					location.reload();
					// di set untuk interaktif modal 
					//$.get('<?php echo base_url();?>dashboard_data/modal_body',{thread:thread,label:lbl},function(data){
					//	$('#modal_body').html(data);
			
					//});
				}
			});		
		});
		
		$('.trash').click(function(){
			$('#delete_<?php echo $data[0]['thread']; ?>').show();
			
		});
		
		// individual move trash
		$('.move_trash').click(function(){	
			var id_ib = $(this).data('id_ib');
			$('#div_inbox_'+id_ib).hide();
			$.post('<?php echo base_url();?>dashboard_data/hapus_message',{id:id_ib},function(data){
				if(data =='true')
				{
					location.reload();
				}	
					
			});
			
		});
		
		$('.move_archive').click(function(){
			var dt = $(this).data('thread');
			var thread = [thread];
			$.post('<?php echo base_url();?>dashboard_data/set_archive',{thread:thread},function(data){
				if(data == 'true')
				{
					location.reload();
				}
			});
		});
		
		// thread remove thread_trash
		$('.forward').click(function(){
			var content = $(this).data('content'); 
			$('#balas').show()
			$('#act').html('<h5>Forward:</h5>');;
			$('#text').html(content);
			$('#number_fwd').html('<select class="combobox" name="number_box" id="number_box"><?php if($pbk){?><?php foreach($pbk as $pb){?> <option value="<?php echo $pb->number?>"><?php echo $pb->first_name.' '.$pb->last_name ;?></option><?php }?><?php }?></select>')

			$('#number_box').combobox();
			

		});
		
		
		$('.thread_trash').click(function(){
			var aw = $(this).data('thread');
			var thread = [aw];
			
			console.log(thread);
			$.post('<?php echo base_url();?>dashboard_data/hapus_message',{id:thread},function(data){
				if(data = 'true')
				{
					location.reload();
				}
			});
			
		});
		
		$('.mark_spam').click(function(){
			
			var thread = $(this).data('thread');
			$.post('<?php echo base_url();?>dashboard_data/mark_spam',{thread:thread},function(data){
				if(data = 'true')
				{
					location.reload();
				}	
					
			});
			
		});

		$('.not_spam').click(function(){
			
			var thread = $(this).data('thread');
			$.post('<?php echo base_url();?>dashboard_data/remove_blacklist',{thread:thread},function(data){
				if(data = 'true')
				{
					location.reload();
				}	
					
			});
			
		});
		
		
		$('.edit_draft').click(function(){
			
			var content = $(this).data('content');
			var id_inbox = $(this).data('id_inbox');
			$('#div_inbox_'+id_inbox).hide();
			$('#balas').show()
			$('#act').append('<h5>Edit Draft:</h5>');
			$('#reply').append('<input type="hidden" name="number" value="<?php echo $data[0]['number'];?>">');
			$('#text').append(content);
			
		});

		$('.hapus').click(function(){
			var id_inbox = $(this).data('id_inbox');
			$('#warning_delete_'+id_inbox).show();
		});
		
		if($("[rel=tooltip]").length) {
			$("[rel=tooltip]").tooltip();
		}	
	});
	

	function terapkan_label()
	{
		var id_label =  $('.labelcek:checkbox').map(function() {
			if(this.checked){
			   return this.value;
			  }
		}).get();
		var th = '<?php echo $data[0]['thread'];?>';
		var thr = [th]
		$.post('<?php echo base_url();?>dashboard_data/apply_label',{id_label:id_label,thread:thr},function(data){
			if(data == 'true')
			{

				location.reload();
			}
		});		
	}

	function countChar(val) {
	  var len = val.value.length;
	  if (len >= 160) {
		 $('#charNum').html('<p class="text-error"> '+ len +' character(s) <p>');
	  } else {
		$('#charNum').html('<p id="jumchar"> '+len+' character(s) <p>');
	  }
	};
	
	</script>
	<div id="modal_body" class="modal-body" style="height: 400px;overflow-y: auto;">	
	<?php $label=false;?>
	<?php if(isset($data)){?>
	<?php //var_dump($data);?>
		<?php for($d=0;$d < count($data);$d++){?>
				<?php $stat=false;?>
				<?php $draft=false;?>
				<?php if(isset($data[$d]['label'])){ ?>			
					<?php $label=$data[$d]['label']; ?>
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
	
	</div>
	
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal" aria-hidden="true" onclick="reloadz()">Close</a>
	</div>
</div>

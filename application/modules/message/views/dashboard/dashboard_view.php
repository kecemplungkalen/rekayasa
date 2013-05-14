	<script type="text/javascript">

		$(function() {
			applyPagination();
		});
		
		function applyPagination() {
			$(".pagination a").click(function() {
				var search = $('#keyword').val();
				var url = $(this).attr("href");
					$.ajax({
						type: "POST",
						data: "ajax=1&reload=1&keyword="+search,
						url: url,
						beforeSend: function() {
								$("#tampil_data").html('');

						},
						success: function(msg) {
								$("#tampil_data").html(msg);
						}
					});
				return false;
			});

		}
		$(document).ready(function(){
			
			$('.pesan_list').click(function(){
				
				var id =  $('.pesan_list:checkbox').map(function() {
					if(this.checked){
					   return this.value;
					  }
				}).get();
				
				
				if(id != '')
				{
					$.post('<?php echo base_url();?>dashboard_data/get_label_thread/',{thread:id},function(data){
						for(var i=0;i < data.length;i++)
						{
							//console.log(data[i]);labelcek
							$('#label_to_'+data[i]).val(data[i]).prop('checked',true);
						}
						
					},'json');
					$('#top_btn').show();
				}
				else
				{
					$('.labelcek').prop('checked',false);
					$('#top_btn').hide();
				}
				//console.log(id);
				
				var read_stat =  $('.pesan_list:checkbox').map(function() {
					
					if(this.checked){
					   var rs = $(this).data('read');
					   return rs;
					  }
				}).get();				
				
				console.log(read_stat);
			});
			
			$('.remove_label').click(function(){
				var thread = $(this).data('value');
				var id_labelname = $(this).data('id_labelname');
				$.post('<?php echo base_url();?>dashboard_data/hapus_label',{thread:thread,id_labelname:id_labelname},function(data){
					if(data=='true')
					{
						location.reload();
					}
				});
			});
						
			
		});
			
	</script>
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th><input id="checkall_pesan" onclick="checkall()" type="checkbox"></th>
			<?php if(isset($lbl)){?>
			<?php if($lbl == 'outbox' || $lbl == 'sent' ){ ?>
			<th> To </th>
			<?php } else { ?>
			<th> From </th>
			<?php }?>
			<?php }?>
			<th> Date </th>
			<th> Content </th>
			<th> Label </th>
		</tr>
	</thead>
    <tbody>
	<?php if(isset($data)){ ?>
		<?php for($i=0;$i< count($data);$i++) { ?>
		<tr>
			<td>
				<input class="pesan_list" data-read="<?php echo $data[$i]['read_status'];?>"type="checkbox" id="<?php echo $data[$i]['thread']; ?>" value="<?php echo $data[$i]['thread']; ?>"> 
			</td>
			<td>
				<a href="#" onclick="read_sms('<?php echo $data[$i]['thread']; ?>')">
					<?php if($data[$i]['read_status'] != '1'){?>
					<strong><?php echo $data[$i]['first_name'];?> <?php echo $data[$i]['last_name'] ;?><br><?php echo $data[$i]['number'];?> <?php if($data[$i]['total'] != '1'){?> (<?php echo $data[$i]['total'];  ?>)<?php } ?> </strong>
					<?php } else {?>
					<?php echo $data[$i]['first_name'];?> <?php echo $data[$i]['last_name'] ;?><br><?php echo $data[$i]['number'];?>  <?php if($data[$i]['total'] != '1'){?> (<?php echo $data[$i]['total'];  ?>)<?php } ?> 

					<?php }?>
				</a>
			</td>
			<td>
				<?php echo date('j F Y',$data[$i]['recive_date']);?><br>
				<small><?php echo date('g:i a',$data[$i]['recive_date']);?><br></small>
			<td>
				<?php echo $data[$i]['content'] ;?>...
			</td>
        	<td>
				
				<?php $label = $data[$i]['label']; ?>
				<?php if($label){ ?>
					<?php for($j=0;$j< count($label);$j++){ ?>
						<?php if(isset($lbl)){ ?>
							<?php if($lbl != $label[$j]['name']){?>
								<a href="<?php echo base_url();?>message/<?php echo $label[$j]['name']; ?>"><span class="label badge-<?php echo $label[$j]['color']; ?>"><small><?php echo $label[$j]['name']; ?></small></span></a><a href="#remove_label" class="remove_label" data-value="<?php echo $data[$i]['thread']; ?>" data-id_labelname="<?php echo $label[$j]['id_labelname']; ?>"><span class="label badge-<?php echo $label[$j]['color']; ?>"><small>x</small></span></a><br>
							<?php } ?>
						<?php } ?>
					<?php } ?>
				<?php } ?>
			</td>
		</tr>
		<?php } ?>
	<?php } ?>
	
	</tbody>
</table>

<div align="center">
<?php if(isset($paging)){?>
<?php echo $paging;?>
<?php }?>
</div>
<div id="show_modal"> </div>

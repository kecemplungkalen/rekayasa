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
						//console.log(msg);
					}
				});
			return false;
		});
	}
</script>
<?php if(!$reload){ ?>

          <div class="row-fluid">
            <div class="span12">
	<div id="tampil_data"> 
<?php } ?>
			
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th><input type="checkbox"></th>
			<th>From</th>
			<th>Date</th>
			<th>Content</th>
			<th>Label</th>
		</tr>
	</thead>
    <tbody>
	<?php if(isset($data)){ ?>
		<?php for($i=0;$i< count($data);$i++) { ?>
		<tr>
			<td>
				<input type="checkbox"> 
			</td>
			<td>
				<a href="#">
					<?php if($data[$i]['read_status'] == '0'){?>
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
				<?php echo $data[$i]['content'] ;?>
			</td>
        	<td>
				
				<?php $label = $data[$i]['label']; ?>
				<?php if($label){ ?>
				<?php for($j=0;$j< count($label);$j++){ ?>
				<a href="<?php echo base_url();?>message/<?php echo $label[$j]['name']; ?>"><span class="label badge-<?php echo $label[$j]['color']; ?>"><small><?php echo $label[$j]['name']; ?></small></span></a><a href="removetag"><span class="label badge-<?php echo $label[$j]['color']; ?>"><small>x</small></span></a><br>
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

<?php if(!$reload){ ?>
</div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php } ?>


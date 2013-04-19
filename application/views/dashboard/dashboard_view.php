          <div class="row-fluid">
            <div class="span12">
				
				
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
				<?php //var_dump(count($label));?>
				<?php for($j=0;$j< count($label);$j++){ ?>
					<?php if($label[$j]['additional'] != '0') {?>
					
					<a href="message/<?php echo $label[$j]['name']; ?>"><span class="label badge-<?php echo $label[$j]['color']; ?>"><small><?php echo $label[$j]['name']; ?></small></span></a><a href="removetag"><span class="label badge-<?php echo $label[$j]['color']; ?>"><small>x</small></span></a>
					<?php } ?>
				<?php } ?>
				
			</td>
		</tr>

		<!--
		<tr>
			<td>
				<input type="checkbox"> 
			</td>
			<td>
				<a href="#">
					<strong>Paiman<br>08112540606</strong>
				</a>
			</td>
			<td>
				2 April 2013<br>
				<small>02:00PM</small>
			<td>
				1234567890 1234567890 1234567890 1234567890 1234567890 1234567890...
			</td>
        	<td>
				<a href="tag"><span class="label badge-b6cff5"><small>Konfirmasi</small></span></a><a href="removetag"><span class="label badge-b6cff5"><small>x</small></span></a>
			</td>
		</tr>
		<tr>
			<td>
				<input type="checkbox"> 
			</td>
			<td>
				<a href="#">081802611110</a>
			</td>
			<td>
				2 April 2013<br>
				<small>02:00PM</small>
			</td>
			<td>
				1234567890 1234567890 1234567890 1234567890 1234567890 1234567890...
			</td>
			<td>
				<a href="tag"><span class="label badge-b6cff5"><small>Konfirmasi</small></span></a><a href="removetag"><span class="label badge-b6cff5"><small>x</small></span></a>
			</td>
		</tr>
		<tr>
			<td>
				<input type="checkbox"> 
			</td>
			<td>
				<a href="#">
					Solihin<br>
					081802621868 (3)
				</a>
			</td>
			<td>
				2 April 2013<br>
				<small>02:00PM</small>
			</td>
			<td>
				1234567890 1234567890 1234567890 1234567890 1234567890 1234567890...
			</td>
			<td>
				<a href="tag"><span class="label badge-b6cff5"><small>Konfirmasi</small></span></a><a href="removetag"><span class="label badge-b6cff5"><small>x</small></span></a>
			</td>
		</tr>
		-->
		<?php } ?>
	<?php } ?>
	
	</tbody>
</table>
<div align="center">
	<div class="pagination">
		<ul>
		    <li class="disabled"><a href="#">&laquo;</a></li>
		    <li class="active"><a href="#">1</a></li>
		    <li><a href="#">2</a></li>
		    <li><a href="#">3</a></li>
		    <li><a href="#">4</a></li>
		    <li><a href="#">5</a></li>
		    <li><a href="#">&raquo;</a></li>
		</ul>	  
	</div>
</div>

            </div>
          </div>
        </div>
      </div>
    </div>

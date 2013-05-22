<div id="sendlimit" class="tab-pane">
	<table class="table table-striped">
		<thead>
			<tr>
				<td><input type="checkbox" id="checkall_user" ></input></td>
				<td><strong>Phone ID</strong></td>
				<td><strong>Time Limit</strong></td>
				<td><strong>Sending Limit</strong></td>
				<td><strong>Total Send</strong></td>
				<td><strong>Total UnSend</strong></td>
				<td><strong>Status</strong></td>
			</tr>
		</thead>
		<tbody>	
		
		<?php if($send_limit){?>	
			<?php foreach($send_limit as $sl){?>	
			<tr>
				<td><input class="modem_list" type="checkbox"  value="<?php echo $sl->id_config_modem; ?>" id="modem_<?php echo $sl->id_config_modem; ?>"></input></td>
				<td><a href="#" onclick="edit_config_sendlimit('<?php echo $sl->id_config_modem; ?>')"  ><?php echo $sl->phoneID; ?></a></td>
				<td><?php echo $sl->time_sending_limit; ?></td>
				<td><?php echo $sl->sending_limit; ?></td>
				<td><?php echo $sl->total_send; ?></td>
				<td><?php echo $sl->total_unsend; ?></td>
				<td><?php if($sl->status_sending == 'ready'){ ?>
				<span class="label label-success"><?php echo $sl->status_sending; ?></span>
				<?php } elseif($sl->status_sending == 'pending') {?>
				<span class="label label-warning"><?php echo $sl->status_sending; ?></span>
				<?php } else { ?>
				<span class="label label-success"><?php echo $sl->status_sending; ?></span>
				<?php } ?>
				</td>
			</tr>
			<?php }?>
		<?php }?>
		
		</tbody>
	</table>
</div>

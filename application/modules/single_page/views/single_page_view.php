<script>
	$(document).ready(function(){
		$('#add_pesan').submit(function(event) {
			//return false;
			$.post('<?php echo base_url()?>single_page/insert',$('#add_pesan').serialize(),function(data){
				
				if(data)
				{
					$('#add_pesan').reset();
				}

			});
			event.preventDefault();

		});
	});

</script>

<body>
    <div class="navbar">
      <div class="navbar-inner">
        <h1 class="align-center">SMS</h1>
      </div>
    </div>
    <div class="container-fluid">
      <div class="well">
        <form id="add_pesan" action="<?php echo base_url()?>single_page/insert" method="post">
          <input type="text" class="input-block-level input-medium" name="number" placeholder="+62">
          <div class="control-group">
            <div class="controls">
              <label class="checkbox" for="checkbox">
                <input type="checkbox" value="true" id="checkbox" name="checkbox">
                <span>Phonebook</span> 
              </label>
              <select name="number_box">
				  <?php if($data){?>
					<?php foreach($data as $d){?>
						<option value="<?php echo $d->number?>"><?php echo $d->first_name.' '.$d->last_name ;?></option>
					<?php }?>
                <?php }?>
              </select>
            </div>
          </div>
          <textarea class="input-block-level" name="text" placeholder="Isi Pesan.." rows="8"></textarea>
          <div class="form-actions">
            <button type="submit" class="btn btn-primary">Submit</button>
            <input type="reset" class="btn" value="Reset"> 
          </div>
        </form>
      </div>
    </div>
  </body>

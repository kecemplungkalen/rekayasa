<div class="navbar">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="./">
				Rekayasa SMS Management System
			</a>		
		</div> <!-- /container -->
	</div> <!-- /navbar-inner -->
</div> <!-- /navbar -->
		<br><br><br>
		
	<script type="text/javascript">


	</script>		
		
		<div  class="span6 offset3" >
		<div class="warning" id="warning"> 
		<?php if(isset($data)){ ?>
		<div class="alert alert-error">
		<a class="close" data-dismiss="alert" href="#">&times;</a>
		<strong><?php echo $data;?></strong>
		</div>
		<?php }?>
		</div>
		<form action="<?php echo base_url();?>login/user_login" method="post" />
			<h1 class="text-center">Login Panel</h1>		
			<div class="well text-center">
				<p>Sign in using your registered account:</p>
				<div>
					<label for="username">Username:</label>
					<input autocomplete="off" type="text" id="username" name="username"  placeholder="Username" class="login username-field" />
				</div> <!-- /field -->
				
				<div>
					<label for="password">Password:</label>
					<input autocomplete="off" type="password" id="password" name="password" placeholder="Password" class="login password-field" />
				</div>
			</div>
			<div class="pull-right">
				<button type="submit" class="button btn btn-warning btn-large">Sign In</button>
			</div> 
		</form>
		</div>


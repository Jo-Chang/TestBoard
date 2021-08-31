<div>
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<div class="alert alert-warning" role="alert">
	                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        	        <span class="sr-only">Error:</span>
			Test Board Register
		</div>
		<?php echo validation_errors(); ?>
		<form class="form-horizontal" action="/testBoard/index.php/auth/register" method="post">

			<div class="form-group">
				<label class="col-sm-4 control-label" for="id">ID</label>
				<div class="col-sm-5">
					<input type="text" id="id" name="id" class="form-control input-sm"
					       value="<?php echo set_value('id'); ?>" placeholder="ID">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-4 control-label" for="password">Password</label>
				<div class="col-sm-5">
					<input type="password" id="password" name="password" class="form-control input-sm"
					       value="<?php echo set_value('password'); ?>" placeholder="Password">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="re_password">Password Confirm</label>
				<div class="col-sm-5">
					<input type="password" id="re_password" name="re_password" class="form-control input-sm"
					       value="<?php echo set_value('re_password'); ?>" placeholder="Re-password">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="name">Name</label>
				<div class="col-sm-5">
					<input type="text" id="name" name="name" class="form-control input-sm"
					       value="<?php echo set_value('name'); ?>" placeholder="Name">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label"></label>
				<div class="col-sm-5">
					<input type="submit" class="btn btn-primary" class="form-control input-sm" value="Register"/>
				</div>
			</div>
		</form>
	</div>
	<div class="col-md-2"></div>
</div>

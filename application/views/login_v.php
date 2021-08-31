<div class="modal-open">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3>Log in</h3>
			</div>
			<form class="form-horizontal" action="<?= site_url('/auth/authentication?returnURL='. rawurlencode($returnURL)) ?>" method="POST">
				<div class="modal-body">

					<div class="form-group">
						<label class="col-sm-4 control-label" for="inputEmail">ID</label>
						<div class="col-sm-5">
							<input class="form-control" type="text" id="id" name="id" placeholder="ID">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="inputPassword">Password</label>
						<div class="col-sm-5">
							<input class="form-control" type="password" id="password" name="password"
							       placeholder="Password">
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<input type="submit" class="btn btn-primary" value="Login"/>
				</div>
			</form>
		</div>
	</div>
</div>

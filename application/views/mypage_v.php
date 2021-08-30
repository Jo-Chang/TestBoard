<div>
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<div class="page-header">
			<h2 style="margin-bottom:0px">Change your information</h2>
		</div>
		<form name="mypage" action="/index.php/auth/modify_myinfo" onsubmit="return mypagecheck()" method="post">
			<div class="form-group">
				<label for="id">Student ID</label>
				<input type="text" id="id" name="id" class="form-control" style="width:40%" value="<?= $user_id ?>"
				       placeholder="Student ID" disabled>
			</div>

			<div class="form-group">
				<label for="password">Old password</label>
				<input type="password" id="password" name="password" class="form-control" style="width:40%">
			</div>

			<div class="form-group">
				<label for="password">New password</label>
				<input type="password" id="newpassword" name="newpassword" class="form-control" style="width:40%">
			</div>

			<div class="form-group">
				<label for="re_password">Confirm new password</label>
				<input type="password" id="new_re_password" name="new_re_password" class="form-control"
				       style="width:40%">
			</div>

			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" id="name" name="name" class="form-control" value="<?= $user_info->name ?>"
				       placeholder="name" style="width:40%">
			</div>

			<input type="submit" class="btn btn-default btn-lg" style="margin-bottom:30px"
			       value="Update your information"/>
		</form>

		<div class="page-header">
			<h2 style="margin-bottom:0px; color:#cb2431"><strong>Delete account</strong></h2>
		</div>

		<div class="alert alert-danger" role="alert">
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			Once you delete your account, there is no going back. Please be certain. <br/><br/>
			<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteaccount">
				Delete your account
			</button>
		</div>

	</div>
	<div class="col-md-2"></div>
</div>


<!-- Modal -->
<div class="modal fade" id="deleteaccount" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
				</button>
				<h3 class="modal-title" id="myModalLabel">Are you sure you want to do this ?</h3>
			</div>
			<div class="modal-body alert alert-danger" role="alert">
				<span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span>
				This is extremely important.
			</div>
			<form name="deleteform" id="deleteform">
				<div class="modal-body">
					<p>We will <strong>immediately delete your account</strong>, along with all of your submissions.</p>
					<p>This action <strong>CANNOT</strong> be undone.</p>
					<p>Please type in your student id and password.</p>
					<hr/>
					<div class="form-group">
						<label for="deleteid">Student ID</label>
						<input type="text" id="deleteid" name="deleteid" class="form-control">
					</div>
					<div class="form-group">
						<label for="deletepass">Password</label>
						<input type="password" id="deletepass" name="deletepass" class="form-control">
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-danger btn-block btn-lg" onclick="formSubmit()"
					       value="Delete your account"/>
				</div>
			</form>
		</div>
	</div>
</div>


<script type="text/javascript">

	function mypagecheck() {
		if (password.value == "" || newpassword.value == "" || new_re_password.value == "" || name.value == "" || email.value == "") {
			alert("Fill the empty field !");
			return false;
		}
		else if (newpassword.value != new_re_password.value) {
			alert("Password doesn't match the confirmation");
			return false;
		}
		return true;
	}

	function formSubmit() {
		if ($("#deleteid").val() == "" || $("#deletepass").val() == "") {
			alert("Type your student id and password.");
			return false;
		}

		$.ajax({
			url: '/index.php/auth/deleteaccount',
			type: 'POST',
			data: {deleteid: $("#deleteid").val(), deletepass: $("#deletepass").val()},
			dataType: 'json',
			success: function (data) {
				alert(data.message);

				if (data.result)
					location.href = "/";
			},
			error: function (xhr, status, error) {
				alert(xhr);
				alert(status);
				alert(error);
			}
		});
	}


</script>

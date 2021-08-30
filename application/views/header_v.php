<!DOCTYPE html>
<html>
<head>
	<title>Test Board</title>
	<link rel="shortcut icon" href="/static/img/favicon.ico" type="image/x-icon"/>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<META http-equiv="Expires" content="-1">
	<META http-equiv="Pragma" content="no-cache">
	<META http-equiv="Cache-Control" content="No-Cache">

	<!-- JQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

	<!-- Bootstrap -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="/static/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- DateTimePicker -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.css"
	      rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/locale/ko.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

	<!-- Custom CSS -->
	<link href="/static/css/style.css" rel="stylesheet">

	<script type="text/javascript">
		var url = "<?php echo base_url();?>";

		function delete_confirm(id1, id2, mode, number) {
			if (confirm("If you click the Okay button, all the related data will be deleted.\n\nDo you want to continue?")) {
				if (number == 0) {
					window.location.href = url + "index.php/manager/delete_problem/" + id1 + "/" + id2 + "/" + mode;
				} else if (number == 1) {
					window.location.href = url + "index.php/manager/del_cp/" + id1 + "/" + id2 + "/" + mode;
				} else if (number == 2) {
					window.location.href = url + "index.php/manager/contest_delete/" + id1 + "/" + id2 + "/" + mode;
				} else if (number == 3) {
					window.location.href = url + "index.php/manager/exam_delete/" + id1 + "/" + id2 + "/" + mode;
				} else if (number == 4) {
					window.location.href = url + "index.php/system_mgr/delete_subject/" + id1;
				} else if (number == 5) {
					window.location.href = url + "index.php/manager/delete_class/" + id1 + "/" + id2 + "/" + mode;
				}
			} else {
				return false;
			}
		}

		function exception_confirm(id1, id2, mode, number) {
			if (confirm("If you click the Okay button, this student will be excepted from IP Check Once.\n\nDo you want to continue?")) {
				if (number == 0) {
					window.location.href = url + "index.php/manager/exam_exception/" + id1 + "/" + id2 + "/" + mode;
				}
			} else {
				return false;
			}
		}

		function multi_submit(number, id1, id2, mode, sample = '0') {
			if (number == 0) {
				document.testcase.action = "/index.php/manager/download_testcase/" + id1 + "/" + id2 + "/" + mode + "/" + sample;
				document.testcase.submit();
			} else if (number == 1) {
				document.testcase.action = "/index.php/manager/delete_testcase/" + id1 + "/" + id2 + "/" + mode + "/" + sample;
				document.testcase.submit();
			} else if (number == 2) {
				document.testcase.action = "/index.php/manager/add_testcase/" + id1 + "/" + id2 + "/" + mode + "/" + sample;
				document.testcase.submit();
			} else if (number == 3) {
				if (confirm("If you click the Okay button, Your Problem Ownership will be transfered.\n\nDo you want to continue?")) {
					document.problem.action = "/index.php/manager/transfer_problem/" + id1 + "/" + mode;
					document.problem.submit();
					document.newOnwer.submit();
				}
				else {
					return false;
				}
			} else if(number == 4) {
				if (confirm("If you click the Okay button, Selected Contest will be copied to your Subject.\n\nDo you want to continue?")) {
					document.contests.action = "/index.php/manager/copy_contest/" + id1 + "/" + mode;
					document.contests.submit();
				}
				else {
					return false;
				}
			}

		}

		var timeDiff =  new Date("<?php echo date("Y/m/d H:i:s")?>").getTime() - new Date().getTime();
	</script>


</head>

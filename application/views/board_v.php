<div class="col-md-3"></div>
<div class="col-md-9">
	<h3 style="text-align:center">Test Board</h3>
</div>

<div class="col-md-9">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover">
			<thead>
			<tr style="background:#E0E0E0">
				<th style="text-align:center">번호</th>
				<th style="text-align:center">제목</th>
				<th style="text-align:center">작성자</th>
				<th style="text-align:center">작성일</th>
			</tr>
			</thead>
			<tbody>
			<?php
			foreach ($data['list'] as $lt) {
			?>
				<tr>
					<td style="text-align:center"> <?php echo $lt -> ID;?> </td>
					<td style="text-align:center"> <?php echo $lt -> title;?> </td>
					<td style="text-align:center"><?php echo $lt -> created_user;?></td>
					<td style="text-align:center">
						<time datetime="<?php echo mdate("%Y-%M-%j", human_to_unix($lt -> created)); ?>"><?php echo mdate("%Y-%M-%j", human_to_unix($lt -> created));?>
						</time>
					</td>
				</tr>
			<?php
			}
			?>

			</tbody>

		</table>
	</div>
	
	<div style="vertical-align:middle; text-align:center">
		<form id="pb_search" method="get" class="form-inline">
			<select name="type" id="selectbox"  class="form-control input-sm">
				<option value="0" <?= $post['type'] == 'title' ? 'selected' : ''?>>Title</option>
				<option value="1" <?= $post['type'] == 'ID' ? 'selected' : ''?>>ID</option>
				<option value="2" <?= $post['type'] == 'created_user' ? 'selected' : ''?>>User</option>
			</select>
			&nbsp;
			<div class="form-group">
				<input type="text" class="form-control col-md-3 col-xs-3 col-sm-3 col-lg-3" name="search_word" placeholder="Keyword" 
					id="q" onkeypress="pb_search_enter(document.q);" value="<?=$post['word']?>"/>
			</div>
			&nbsp;
				<input type="button" class="btn btn-primary" value="search" id="search_btn"/>
		</form>
	</div>

	<div class="row">
		<div class="col-md-12 text-center">
			<?php echo $data['pagination']; ?>
		</div>
	</div>

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
$(document).ready(function () {
	$("#search_btn").click(function () {
		if ($("#q").val() == '') {
			alert("Empty Input Box");
			return false;
		} else {
			var search_wd = encodeURIComponent($("#q").val());
			var search_type = encodeURIComponent($("#selectbox").val());
			if(search_type == 0) search_type='title';
			else if(search_type ==1)search_type='ID';
			else if(search_type ==2)search_type='created_user';


			//var act = "testBoard/index.php/Main/lists/q/"+ search_wd +"/p/"+search_type+"/page/1";
			var act = "testBoard/index.php/Main/lists";
			$("#pb_search").attr('action', act).submit();
		}


	});
});

function pb_search_enter(form) {
	var keycode = window.event.keyCode;
	if (keycode == 13)
		$("#search_btn").click();
}
</script>


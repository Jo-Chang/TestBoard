<div class="col-md-3">
</div>

<div class="col-md-9">
	<form name="new" class="col-md-9" action="/testBoard/index.php/main/add_list" method="post">
		<div class="form-group col-xs-12">
			<label class="control-label" for="inputTitle">Title</label>
			<label><font size=2 color=gray>&ensp; - 글 제목</font></label>
			<input id="inputTitle" class="form-control" type="text" placeholder="Title" name="title" />
		</div>

		 <div class="form-group col-xs-12">
                        <label class="control-label" for="inputDescription">Description</label>
                        <label><font size=2 color=gray>&ensp; - 내용</font></label>
                        <textarea id="inputDescription" class="form-control" rows="15" type="text" placeholder="Description" name="description" ></textarea>
                </div> 

		<div class="form-group col-xs-6">
				<div class="input-group">
					<input type="button" class="btn btn-default" value="Apply" onclick="erchk()"/>
				</div>
		</div>

	</form>
</div>

<script>

	function erchk() {
		if(document.getElementById("inputTitle").value==""||document.getElementById("inputDescription").value==""){
			alert("Title or Description is Empty ");
			return false;
		}
		else{
			document.new.submit();
		}
	}

	$(function () {
		$('[data-toggle="tooltip2"]').tooltip({
			template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner" style="max-width:1000px"></div></div>',
			html: 'true',
			placement: 'right',
			title: 'ON : 공백 개수까지 정확히 일치해야 정답 <br />OFF : 한개 이상의 공백을 하나의 공백으로 처리'
		});
	})

</script>

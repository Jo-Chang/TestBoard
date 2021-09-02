<div class="col-md-3">
</div>

<div class="col-md-9">
	<div class="table-responsive">
		<table class="table table-striped ">
			<thead>
			<h4> 제목 </h4>
			<tr style="background:#ededed">
				<th style="text-align:left"><?= $forum->title ?></th>
			</tr>
			</thead>

		</table>
	</div>
	<h5> 내용 </h5>
	<pre style="background:#fefefe"> <?= $forum->description ?></pre>

	<div align="right">
                <a href="/testBoard/index.php/Main" class="btn btn-default" align="right">이전</a>
        </div>

</div>
			

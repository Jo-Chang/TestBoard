<article id="board_area">
    <header>
        <h1></h1>
    </header>
    <h1></h1>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col">번호</th>
                <th scope="col">제목</th>
                <th scope="col">작성자</th>
                <th scope="col">작성일</th>
            </tr>
        </thead>
        <tbody>
            <?php
foreach($list as $lt)
{
           ?>
            <tr style="background:#E0E0E0">
                <th style="test-align:center" scope="row"><?php echo $lt -> ID;?></th>
		<th style="text-align:center"><?php echo $lt -> title;?></td>
                <th style="text-align:center"><?php echo $lt -> created_user;?></td>
                <th style="text-align:center">
		<time datetime="<?php echo mdate("%Y-%M-%j", human_to_unix($lt -> created)); ?>">
                    <?php echo mdate("%Y-%M-%j", human_to_unix($lt -> created));?>
                </time>
		</td>
            </tr>
            <?php
            }
           ?>
        </tbody>
    </table>
</article>

<?php include "../db.php"; ?>
<!DOCTYPE html>
<head>
	<meta charset="utf-8" />
	<title>게시판</title>
	<link rel="stylesheet" type="text/css" href="/css/style.css" />
</head>
<body>
	
	<?php
	if(isset($_SESSION['id'])){
		echo "<h2>{$_SESSION['id']} 님 환영합니다.</h2>";
	?>
	<a href="/member/logout.php"><input type="button" style="float:right" value="로그아웃" /></a>


	<div id="board_area"> 
	<h1>자유게시판</h1>
	<h4>자유롭게 글을 쓸 수 있는 게시판입니다.</h4>
		<table class="list-table">
		<thead>
			<tr>
				<th width="70">번호</th>
					<th width="500">제목</th>
					<th width="120">글쓴이</th>
					<th width="100">작성일</th>
					<th width="100">조회수</th>
				</tr>
			</thead>
			<?php
			// board테이블에서 idx를 기준으로 내림차순해서 5개까지 표시
			$sql = mq("select * from post order by idx desc limit 0,5"); 
				while($post = $sql->fetch_array())
				{
				//title변수에 DB에서 가져온 title을 선택
				$title=$post["title"]; 
				if(strlen($title)>30)
				{ 
					//title이 30을 넘어서면 ...표시
					$title=str_replace($post["title"],mb_substr($post["title"],0,30,"utf-8")."⋯",$post["title"]);
				}
			?>
		<tbody>
			<tr>
			<td width="70"><?php echo $post['idx']; ?></td>
			<td width="500"><a href="../board/read.php?idx=<?php echo $post["idx"];?>"><?php echo $title;?></a></td>
			<td width="120"><?php echo $post['name']?></td>
			<td width="100"><?php echo $post['date']?></td>
			<td width="100"><?php echo $post['hit']; ?></td>
			
			</tr>
		</tbody>
		<?php } ?>
		</table>
		<div id="write_btn">
		<a href="../board/writer.php"><button>글쓰기</button></a>
		</div>
  </div>


	<?php 
		}else{
		echo "<script>alert('잘못된 접근입니다.'); history.back();</script>";
	} 
	?>
</body>
</html>

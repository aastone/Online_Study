<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Read from a file</title>
<link rel="stylesheet" type="text/css" href="../../stylesheet/bootstrap/css/bootstrap.min.css">
<script type="text/javascript" src="../../script/jquery-1.9.1.min.js"></script>
</head>
<body>
	<?php
		$counter = file_get_contents("test.txt");
		$content1 = fopen("test.txt", r);
		// while (!feof($content1)) {
		// 	for ($i=0; !feof($content1); $i++) { 
		// 		# code...
		// 		echo $i;
		// 		echo fgets($content1)."<br/>";
		// 	}
		
		// }

		if (!feof($content1)) {
			for ($i=0; $i < 16; $i++) { 
				# code...
				echo fgets($content1)."<br/>";
			}
		}

		echo 1;
		//echo $counter;
		$length = strlen($counter);
		$page_count = ceil($length/500);

		function msubstr($str,$start,$len){
			$strlength = $start+$len;
			$tmpstr = "";
			//echo "functn";

			for ($i=0; $i < $length; $i++) { 
				if (ord(substr($str, $i, 1))==0x0a) {
					$tmpstr='<br />';
				}

				if (ord(substr($str, $i,1))>0x0a) {
					$tmpstr=substr($str, $i,2);
					$i++;
				}
				else{
					$tmpstr=substr($str, $i,1);
				}				
			}
			return $tmpstr;
		}
					//--截取字符串
			$c = msubstr($counter,0,($page-1)*500);
			//echo $c;
			$c1 = msubstr($counter,0,$page*500);
			echo substr($c1, strlen($c),strlen($c1)-strlen($c));
	

	?>
	<div>
		<?php
		echo $page;
		?>/
		<?php
		echo $page_count;
		?>
		<?php
		echo "<a href=m.php?page=1>Homepage</a>";
		if ($page!=1) {
			echo "<a href=m.php?page=".($page-1).">Pre</a>";
		}
		if ($page<$page_count) {
			echo "<a href=m.php?page=".$page_count.">Next</a>";
		}
		echo "<a href=m.php?page=".$page_count.">Last</a>";
		?>
	</div>
</body>
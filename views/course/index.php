<html>
<head>
<link rel="stylesheet" type="text/css" href="../../stylesheet/bootstrap/css/bootstrap.min.css">
<script type="text/javascript" src="../../script/jquery-1.9.1.min.js"></script>
</head>
<body>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span2">
				<h3>Select a course</h3>
			</div>
			<div class="span10">
				<!--Body content-->
				<?
				$filename = "list/php/1";
				$mode = "r";
				$file_handle = fopen($filename, $mode);
				$lineNum = 0;
				$pattern = "/{\d}[^{}]+/";
				if ($file_handle) {
					$counter = file_get_contents($filename);
					$length = strlen($counter);
					$page_count = ceil($length/300);
					}
				function msubstr($str,$start,$len){
					$strlength = $start + $len;
					$tmpstr = "";
					for ($i=0; $i < $strlength; $i++) { 
						# code...
						if (ord(substr($str, $i,1))==0x0a) {
							# code...
							$tmpstr.='<br/>';
						}

						if (ord(substr($str, $i,1))>0x0a) {
							# code...
							$tmpstr.=substr($str, $i,2);
							$i++;
						}
						else{
							$tmpstr.=substr($str, $i,1);
						}
						return $tmpstr;
					}
					//-----截取文中字符串
					$c = msubstr($counter,0,($page-1)*300);
					$cl = msubstr($counter,0,($page*300));
					echo substr($cl, strlen($c),strlen($cl)-strlen($c));
				}
				
				//fclose($file_handle);
				?>
				<table width="100%" bgcolor="#cccccc">
					<tr>
						<td width="42%" align="center" valign="middle">
						<span class="">
							<?php
							echo $page;
							?>
						</span>
						</td>
						<?php
						echo "<a href=index.php?page=1>Homepage</a>";
						?>
					</tr>
				</table>
			</div>
		</div>
	</div>
</body>
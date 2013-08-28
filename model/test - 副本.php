<?php
	require_once 'header.php';
?>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body>
	
	
	<?php
	error_reporting(E_ALL^E_NOTICE);
$con = mysql_connect("localhost", "stone", "123456");//连接数据库
if (!$con){ 
 die('Could not connect: ' . mysql_error());//连接失败，提示报错！
}
//
$gPageSize=1; //定义每页显示的记录数
$db_selected = mysql_select_db("db_study",$con);//选择数据库
mysql_query('set names "utf8"');
$query="select title,answer1,answer2,answer3,answer4 from tbl_question ";//执行查询
//echo $query;
$rresult=mysql_query($query,$con)or die("Can't excute SQL：$query");
$page = $_REQUEST['page'];
//$page变量标示当前显示的页
if(!isset($page)) $page=1;
if($page==0) $page=1; 
//得到当前查询到的纪录数   $nNumRows  
if(($nNumRows=mysql_num_rows($rresult))<=0)
{
echo "<p align=center>error1";
exit;
}
//得到最大页码数MaxPage  
$MaxPage=(int)ceil($nNumRows/$gPageSize);
if((int)$page>$MaxPage)
 $page=$MaxPage;
?>

<div class="container-fluid">
	<div class="span2">
		<!--Slide Bar-->
	</div>
<div class="span10"> 
<table align="center" width="80%" border="1" cellspacing="0" cellpadding="4" bordercolorlight="#CC9966"  bgcolor="#00F2EE" bordercolordark="#FFFFFF"   class="LZH">  
<!--   
  <tr bgcolor="#F7F2ff"  style="font-size:14.8px;font-weight:bold">  

<?
//显示表格头
   
  //for($iCnt=0; $iCnt<mysql_num_fields($rresult); $iCnt++)  
    {  
    //echo   "<td>".mysql_field_name($rresult,$iCnt)."</td>"   ;  
  }  
   
  ?>  
 </tr>  
 -->
 <?php
//根据偏移量($page - 1)*$gPageSize,运用mysql_data_seek函数得到要显示的页面
//if( mysql_data_seek($rresult,($page -1)*$gPageSize) )
if(mysql_data_seek($rresult,($page-1)*$gPageSize))
{
  $i=0;
  for($i;$i<$gPageSize;$i++)
  {
  
  $arr=mysql_fetch_row($rresult);
  if($arr)
  {
    $tmp=0;

    echo "<div class='hero-unit control-group'><form>";
    echo "<label class='control-label'><h3>Q".":&nbsp".$arr[0]."</h3></label><br/>";
    echo "<div class='controls'>";
    for($nOffSet=1;$nOffSet<count($arr);$nOffSet++) 
    {
      $tmp++;

      echo "<h4><label class='radio'><input type='checkbox' value='$tmp' >".$tmp."&nbsp";
      echo $arr[$nOffSet]."</label></h4><br/>";

    }
    echo "</div></form></div>";
    }
    echo "</tr>";
    }
  }
?>
</table>  

<div align=center style="font-size:12px" class="pagination pagination-large">  

<?php
{  
	$PHP_SELF=$_SERVER['PHP_SELF'];
   $prevPage=$page-1;    
   echo   "<div class='pagination'><ul><li><a   href=$PHP_SELF?page=1>First</a></li> ";    
   echo   "<li><a   href=$PHP_SELF?page=$prevPage>Pre</a></li>   ";  
}  
 
//下一页和末页的链接  
 
if($page>=0 && $page<=$MaxPage)  
 
{  
 
    $nextPage= $page+1;  
    $PHP_SELF=$_SERVER['PHP_SELF']; // (/admin/test.php)
    echo   "<li><a   href=$PHP_SELF?page=$nextPage>Next</a></li>   ";  
    echo   "<li><a   href=$PHP_SELF?page=$MaxPage>End</a></li></ul></div>  </div> ";    
 
}  
?>  
</div>
</div>
</div>  
</body>
</html>
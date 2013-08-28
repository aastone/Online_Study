<html>
<head>
<title>php page</title>
</head>
<body>
<?php
$con = mysql_connect("localhost", "root", "123456");//连接数据库
if (!$con){ 
 die('Could not connect: ' . mysql_error());//连接失败，提示报错！
}
//
$gPageSize=2; //定义每页显示的记录数
$db_selected = mysql_select_db("onlinestudy",$con);//选择数据库
$query="select title,answer1,answer2,answer3 from tbl_quiz ";//执行查询
echo $query;
$rresult=mysql_query($query,$con)or die("无法执行SQL：$query");
$page = $_REQUEST['page'];//
//$page变量标示当前显示的页
if(!isset($page)) $page=1;
if($page==0) $page=1;
 
//得到当前查询到的纪录数   $nNumRows  
if(($nNumRows=mysql_num_rows($rresult))<=0)
{
echo "<p align=center>没有记录";
exit;
};
//得到最大页码数MaxPage  
$MaxPage=(int)ceil($nNumRows/$gPageSize);
if((int)$page>$MaxPage)
 $page=$MaxPage;
?>
<table align="center" width="80%" border=0>
     <tr>
         <td>
         <?php 
            echo   "<font size=2>第".$page."页，共".$MaxPage."页</font>";
         ?>
         </td><td></td></tr>
  </table>  
   
<table align="center" width="80%" border="1" cellspacing="0" cellpadding="4" bordercolorlight="#CC9966"  bgcolor="#00F2EE" bordercolordark="#FFFFFF"   class="LZH">  
   
  <tr bgcolor="#F7F2ff"  style="font-size:14.8px;font-weight:bold">  
<?
//显示表格头
   
  for($iCnt=0; $iCnt<mysql_num_fields($rresult); $iCnt++)  
    {  
    echo   "<td>".mysql_field_name($rresult,$iCnt)."</td>"   ;  
  }  
   
  ?>  
 </tr>  
 
 <?  
//根据偏移量($page - 1)*$gPageSize,运用mysql_data_seek函数得到要显示的页面
//if( mysql_data_seek($rresult,($page -1)*$gPageSize) )
if(mysql_data_seek($rresult,($page-1)*$gPageSize))
{
  $i=0;
//循环显示当前纪录集
for($i;$i<$gPageSize;$i++)
{
//  echo "<tr>";
//得到当前纪录，填充到数组$arr;
$arr=mysql_fetch_row($rresult);
if($arr)
{
//循环显示当前纪录的所有字段值
for($nOffSet=0;$nOffSet<count($arr);$nOffSet++)
{
//  echo "<td>".$arr[$nOffSet]."</td>";
  echo "<th bgcolor=#0099FF><td>&nbsp".$arr[$nOffSet]."&nbsp</td></th>";
  }
  }
  echo "</tr>";
  }
  }
?>
</table>  
<br>  
<hr size=1 width=80%>  
<div align=center style="font-size:12px">  
 
<?  
 
//首页和上一页的链接  
if($nNumRows>1 && $page>1)  
{  
   $prevPage=$page-1;    
   echo   "<a   href=$PHP_SELF?page=1>F</a>  ";    
   echo   "<a   href=$PHP_SELF?page=$prevPage>Last</a>   ";  
}  
 
//下一页和末页的链接  
 
if($page>=1 && $page<$MaxPage)  
 
{  
 
    $nextPage= $page+1;  
    $PHP_SELF=$_SERVER['PHP_SELF']; // (/admin/test.php)
    echo   "<a   href=$PHP_SELF?page=$nextPage>Next</a>   ";  
    echo   "<a   href=$PHP_SELF?page=$MaxPage>N</a>   ";    
 
}  
?>  
</div>  
</body>  
</html>  
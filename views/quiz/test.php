<html>
<head>
<title>quiz page</title>
<link rel="stylesheet" type="text/css" href="../../../stylesheet/bootstrap/css/bootstrap.min.css">
<script type="text/javascript" src="../../../script/jquery-1.9.1.min.js"></script>
</head>
<body>
<?php
echo $PHP_SELF;
$con = mysql_connect("localhost", "stone", "123456");//连接数据库
if (!$con){ 
 die('Could not connect: ' . mysql_error());//连接失败，提示报错！
}
//
$gPageSize=2; //定义每页显示的记录数
$db_selected = mysql_select_db("db_study",$con);//选择数据库
$query="select title,answer1,answer2,answer3,answer4 from tbl_question ";//执行查询
//echo $query;
$rresult=mysql_query($query,$con)or die("error SQL：$query");
$page = $_REQUEST['page'];

//$page变量标示当前显示的页
if(!isset($page)) $page=1;
if($page==0) $page=1;
echo $page; 
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
<table align="center" width="80%" border=0>
     <tr>
         <td>
         <?php 
            echo   "<font size=2>Page".$page.",Total page".$MaxPage."</font>";
         ?>
         </td><td></td></tr>
  </table>  
   
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

    echo "<div class='hero-unit'><form><label class='radio'>";
    echo "<h3>Q".":&nbsp".$arr[0]."</h3><br/>";
    for($nOffSet=1;$nOffSet<count($arr);$nOffSet++) 
    {
      $tmp++;

      echo "<h4><input type='checkbox'>"."&nbsp";
      echo $arr[$nOffSet]."</h4><br/>";

    }
    echo "</label></form></div>";
    }
    echo "</tr>";
    }
  }
?>
</table>  

<div align=center style="font-size:12px" class="pagination pagination-large">  

<?php
{  
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
</body>  
</html>  
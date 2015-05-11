
<?php
include_once './DataProvider.php';
include_once './helper/Utils.php';

if(isset($_POST['pageId']) && !empty($_POST['pageId'])){
   $id=$_POST['pageId'];
}else{
   $id='0';
}
$pageLimit=PAGE_PER_NO*$id;
$query="select ProductID, ProductName from products order by ProductID desc
limit $pageLimit,".PAGE_PER_NO;
$res=  DataProvider::execQuery($query);
$count=count($res);
$HTML='';
if($count > 0){
while($row=mysql_fetch_array($res)){
   $post=$row['ProductID'];
   $link=$row['ProductName'];
   $HTML.='<div>';
   $HTML.='<a href="'.$link.'" target="blank">'.$post.'</a>';
   $HTML.='</div><br/>';
}
}else{
    $HTML='No Data Found';
}
echo $HTML;
?>
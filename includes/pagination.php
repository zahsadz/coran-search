<?php

function Pages($total_pages,$limit,$path){

	$adjacents = "1";
 
       //if (isset($_GET['page']) ) $page = $_GET['page']; else $page= 1;
	//$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
	$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
	$page = ($page == 0 ? 1 : $page);

	if($page)
	$start = ($page - 1) * $limit;
	else
	$start = 0;

	$prev = $page - 1;
	$next = $page + 1;
	$lastpage = ceil($total_pages/$limit);
	$lpm1 = $lastpage - 1;

           // Generate from .. to
      $from = 1 + ($page - 1) * $limit;
      if ($page< $lastpage) {
			$to = $from + $limit - 1;
      }
      else {
      	$to = $total_pages;
      }

$from_to ='  من : '.$from.' - إلي : '.$to.'  - من مجموع : '.$total_pages.' ';
//$from_to ='  from : '.$from.' - to : '.$to.'  - totals : '.$total_pages.' ';

$pagination = "";
$pagination .=''.$from_to.'<br/>';
if($lastpage > 1)
{
$pagination .= '<nav aria-label="Page navigation"><ul class="pagination justify-content-center">';
if ($page > 1)
// $pagination.= "<li><a href='".$path."$prev' aria-label='Previous'>&laquo;&laquo; السابق</a></li>";
 $pagination.= "<li class='page-item'><a class='page-link' href='".$path."$prev' aria-label='Previous'>&laquo;&laquo; السابق</a></li>";

else
	//$pagination.= "<li class='disabled'><span><span aria-hidden='true'>&laquo;&laquo; السابق</span></span></li>";
$pagination.= "<li class='page-item disabled'>
      <a class='page-link' href='#' tabindex='-1' aria-disabled='true'>السابق&laquo;&laquo;</a></li>";
if ($lastpage < 7 + ($adjacents * 2))
{
for ($counter = 1; $counter <= $lastpage; $counter++)
{
if ($counter == $page)
	$pagination.= "<li class='page-item active'><a class='page-link' href='#'>$counter<span class='sr-only'>(current)</span></a></li>";
else
 $pagination.= "<li class='page-item'><a class='page-link' href='".$path."$counter'>$counter</a></li>";
}
}
elseif($lastpage > 5 + ($adjacents * 2))
{
if($page < 1 + ($adjacents * 2))
{
for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
{
if ($counter == $page)
	$pagination.= "<li class='page-item active'><a class='page-link' href='#'>$counter<span class='sr-only'>(current)</span></a></li>";
else
 $pagination.= "<li class='page-item'><a class='page-link' href='".$path."$counter'>$counter</a></li>";
}
	//$pagination.= "...";
 	$pagination.= "<li class='page-item'><a class='page-link' href='".$path."$lpm1'>$lpm1</a></li>";
	$pagination.= "<li class='page-item'><a class='page-link' href='".$path."$lastpage'>$lastpage</a></li>";
}
elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
{
 	$pagination.= "<li class='page-item'><a class='page-link' href='".$path."1'>1</a></li>";
	$pagination.= "<li class='page-item'><a class='page-link' href='".$path."2'>2</a></li>";
	//$pagination.= "<li>...</li>";
for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
{
if ($counter == $page)
	$pagination.= "<li class='page-item active'><a class='page-link' href='#'>$counter<span class='sr-only'>(current)</span></a></li>";
else
 $pagination.= "<li class='page-item'><a class='page-link' href='".$path."$counter'>$counter</a></li>";
}
	//$pagination.= "..";
 	$pagination.= "<li class='page-item'><a class='page-link' href='".$path."$lpm1'>$lpm1</a></li>";
	$pagination.= "<li class='page-item'><a class='page-link' href='".$path."$lastpage'>$lastpage</a></li>";
}
else
{
 	$pagination.= "<li class='page-item'><a class='page-link' href='".$path."1'>1</a></li>";
	$pagination.= "<li class='page-item'><a class='page-link' href='".$path."2'>2</a></li>";
 
	//$pagination.= "..";
for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
{
if ($counter == $page)
	$pagination.= "<li class='page-item active'><a class='page-link' href='#'>$counter<span class='sr-only'>(current)</span></a></li>";
else
 	$pagination.= "<li class='page-item'><a class='page-link' href='".$path."$counter'>$counter</a></li>";
}
}
}

if ($page < $counter - 1)
//$pagination.= "<li><a href='".$path."$next' aria-label='Next'>التالي &raquo;&raquo;</a></li>";
 $pagination.= "<li class='page-item'><a class='page-link' href='".$path."$next'>التالي&raquo;&raquo;</a></a></li>";

else
	//$pagination.= "<li class='disabled'><span>التالي &raquo;&raquo;</span></li>";
	$pagination.= "<li class='page-item disabled'><a class='page-link' href='#'>التالي&raquo;&raquo;</a></li>";

	$pagination.= "</ul></nav>\n";
}
return $pagination;
}

<?php
class xtable
{
 private $tit,$arr,$fons,$sextra;
 public function __construct()
 {
  $this->tit=array();       // strings with titles for first row 
  $this->arr=array();       // data to show on cells
  $this->fons=array("#EEEEEE","#CCEEEE");  // background colors for odd and even rows
  $this->sextra="";       // extra html code for table tag
 }

 public function extra($s)      // add some html code for the tag table
 {
  $this->sextra=$s;
 }
 public function background($arr) {if (is_array($arr)) $this->fons=$arr; else $this->fons=array($arr,$arr);}
 public function titles($text,$style="") {$this->tit=$text; $this->sesttit=$style;}
 public function addrow($a) {$this->arr[]=$a;}
 public function addrows($arr) {$n=count($arr); for($i=0;$i<$n;$i++) $this->addrow($arr[$i]);}
 public function html()
 {
  $cfondos=$this->fons;
  $titulos="<tr>";
  $t=count($this->tit);
  for($k=0;$k<$t;$k++)
  {
   $titulos.=sprintf("<th>%s</th>",$this->tit[$k]);
  }
  $titulos.="</tr>";

  $celdas="";
  $n=count($this->arr);
  for($i=0;$i<$n;$i++)
  {
   $celdas.=sprintf("<tr style='background-color:%s'>",$this->fons[$i%2]);
   $linea=$this->arr[$i];
   $m=count($linea);
   for($j=0;$j<$m;$j++)
    $celdas.=sprintf("<td  %s>%s</td>","",$linea[$j]);
   $celdas.="</tr>";
  }
  return sprintf("<table cellpadding='0' cellspacing='0' border='1' %s>%s%s</table>",$this->sextra,$titulos,$celdas);
 }
 public function example()
 {
  $tit=array("Apellidos","Nombre","Telefono"); 
  $r1=array("Garcia","Ivan","888"); 
  $r2=array("Marco","Alfonso","555"); 
  $x=new xtable(); 
  $x->titles($tit);      //take titles array
  $x->addrows(array($r1,$r2));   // take all rows at same time
  return $x->html();     //return html code to get/show/save it 
 }
}

// Example
$t1=new xtable();
echo $t1->example()."<hr />";
$t2=new xtable();
for($i=1;$i<=10;$i+=2)
 {
  $t2->addrow(array("ODD",$i));
  $t2->addrow(array("EVEN",$i+1));
 }
$t2->background(array("pink","gold"));
$t2->titles(array("TYPE","#"));
$t2->extra(" style='width:500px; background-color:cyan; color:navy;'");
echo $t2->html()."<hr />";
$t3=new xtable();
for($i=1;$i<=6;$i++)
 {
  $t3->addrow(array("5x".$i,5*$i));

 }
$t3->background(array("olive","maroon"));
$t3->titles(array("Multiplication table","5"));
$t3->extra("style='border:dotted red 10px; padding-left:4px;padding-right:4px; text-align:right;width:500px; background-color:black; color:white;'");
echo $t3->html()."<hr />";
$t4=new xtable();
$a=array("#");
for($i=1;$i<=10;$i++)
 {
  $a[]=$i;
 }
$t4->addrow($a);
$t4->background(array("pink","gold"));
$tit=array(); $tit[]="Numbers";
for($i=1;$i<=10;$i++) $tit[]="#";
$t4->titles($tit);
$t4->extra("style='border:solid 1px silver; padding-left:4px;padding-right:4px; text-align:center;width:500px; background-color:cyan; color:navy;'");
echo $t4->html()."<hr />";





function get_td_array($table) {
  $table = preg_replace("'<table[^>]*?>'si","",$table);
  $table = preg_replace("'<tr[^>]*?>'si","",$table);
  $table = preg_replace("'<td[^>]*?>'si","",$table);
  $table = str_replace("</tr>","{tr}",$table);
  $table = str_replace("</td>","{td}",$table);
  //去掉 HTML 标记 
  $table = preg_replace("'<[/!]*?[^<>]*?>'si","",$table);
  //去掉空白字符 
  $table = preg_replace("'([rn])[s]+'","",$table);
  $table = str_replace(" ","",$table);
  $table = str_replace(" ","",$table);
  $table = explode('{tr}', $table);
  array_pop($table);
  foreach ($table as $key=>$tr) {
    $td = explode('{td}', $tr);
    array_pop($td);
    $td_array[] = $td;
  }
  return $td_array;
}
?>
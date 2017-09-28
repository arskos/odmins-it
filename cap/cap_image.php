<?
$pass_length=rand(4,7);
$width=200;
$height=30;
$font_path=dirname(__FILE__);

session_start();
$passwd="";
$i=0;
while ($i<$pass_length)
{
	$passwd.=chr(rand(97,122));
	$i++;
}
$_SESSION['tt_pass']=$passwd;
$fonts=array();
if ($handle=opendir($font_path))
{
	while (false!==($file=readdir($handle)))
	{
		if (substr(strtolower($file),-4,4)=='.ttf')
		{
			$fonts[]=$font_path.'/'.$file;
		}
	}
}
if (count($fonts)<1){die("Нет шрифтов");}
//заголовок для браузера
header("Content-Type: image/jpeg");
//запрещаем кэширование
header("Expires: Mon, 01 Jul 1998 05:00:00 GMT");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
header("Cache-Control: no-store, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

//создаем картинку
$img=imagecreatetruecolor($width,$height);
//заливаем произвольным цветом
$bg=imagecolorallocate($img,rand(210,255),rand(210,255),rand(210,255));
imagefilledrectangle($img,0,0,$width,$height,$bg);
//рисукем вертикальные многоугольники
$right=rand(10,30);
$left=0;
while($left<$width)
{
	$poly_points=array(
		$left,0,
		$right,0,
		rand($right-25,$right+25),$height,
		rand($left-15,$left+15),$height);
	$c=imagecolorallocate($img,$poly_points,4,$c);
	$random_amount=rand(10,30);
	$left+=$random_amount;
	$right+=$random_amount;
}
$c_min=rand(120,185);
$c_max=rand(195,280);
//рисуем вертикальные линии
$left=0;
while($left<$width)
{
	$right=$left+rand(3,7);
	$offset=rand(-3,3);
	$line_points=array(
		$left,0,
		$right,0,
		$right+$offset,$height,
		$left+$offset,$height);
	$pc=imagecolorallocate($img,rand($c_min,$c_max),rand($c_min,$c_max),rand($c_min,$c_max));
	imagefilledpolygon($img,$line_points,4,$pc);
	$left+=rand(20,60);
}
//рисуем горизонтальные линии
$top=0;
while($top<$height)
{
	$bottom=$top+rand(1,4);
	$offset=rand(-6,6);
	$line_points=array(
		0,$top,
		0,$bottom,
		$width,$bottom+$offset,
		$width,$top+$offset);
	$pc=imagecolorallocate($img,rand($c_min,$c_max),rand($c_min,$c_max),rand($c_min,$c_max));
	imagefilledpolygon($img,$line_points,4,$pc);
	$top+=rand(8,15);
}
//расстояние между буквами
$spacing=$width/(strlen($passwd)+2);
//начальная координата
$x=$spacing;
//вывод символов
for ($i=0;$i<strlen($passwd);$i++)
{
	$letter=$passwd[$i];
	$size=rand($height/3,$height/2);
	//случайное положение символа
	$y=rand($height*.90,$height-$size-4);
	//случайный шрифт
	$font=$fonts[array_rand($fonts)];
	$r=rand(100,255);$g=rand(100,255);$b=rand(100,255);
	$color=imagecolorallocate($img,$r,$g,$b);
	$shadow=imagecolorallocate($img,$r/3,$g/3,$b/3);
	//используем imagettftext для рисования букв и теней
	$rotation=rand(0,45);
	imagettftext($img,$size,$rotation,$x,$y,$shadow,$font,$letter);
	//imagettftext($img,$size,$rotation,$x-1,$y-2,$shadow,$font,$letter);
	$x+=rand($spacing,$spacing*1.5);
}
imagejpeg($img);
imagedestroy($img);
?>
?>
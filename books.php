<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
<tr valign="top">
	<td height="24" style="padding-left:17px;" valign="top" ><h1>Книжный магазин</h1></td>
</tr>
<tr>
	<td>
		<span class="txt">Мы рады приветствовать вас в нашем небольшом книжном интернет-магазине. Здесь вы сможете просмотреть/заказать книги по компьютерной тематике. Книги разбиты на категории, чтобы вам было проще ориентироваться.<br><em>Если у вас не отображаются товары, то скорее всего у вас включен ad-block</em>
		</span>
		</div>
	</td>
</tr>
<tr>
	<td height="13px" background="/img/dots.gif"></td>
</tr>
<?
if (empty($ids))
{?>
<tr>
	<td><div align="left">
<?require "books_cat.php";?></div>
</td></tr><?
}else{?>
<tr valign="top">
			<td valign="top" class="txt">
<script charset="windows-1251" type="text/javascript" src="http://www.ozon.ru/PartnerTwinerNew.aspx?revident=<?echo$ids;?>" ></script></td>
</tr>
<?}?>
</table>

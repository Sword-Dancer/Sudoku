<div id="top_menu">
	<ul>
		<?foreach ($obApp->getTopMenu() as $arItem):?>
			<li class="<?=$arItem['css_class']?>"><a href="<?=$arItem['href']?>"><?=$arItem['name']?></a></li>
		<?endforeach;?>
	</ul>
</div>

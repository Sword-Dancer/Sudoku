<?
require_once '/classes/AutoLoading.php';
$obApp = new Application("/templates/top_menu.php", "/templates/footer.php");
?>
<html>
<head>
	<title>Судоку с произвольным условием</title>
	<meta charset="utf-8">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
	<script src="templates/js/script.js"></script>
	<link rel="stylesheet" type="text/css" href="templates/styles/style.css">
</head>
<body>

	<? require_once $obApp->getTopMenuTemplate(); ?>

	<div id="construct_mode" class='off'>Конструктор</div>

    <div id="menu">
        <div id="clear">Очистить</div>
        <!--<div id="save">Сохранить</div>
        <div id="load">Загрузить</div>-->
    </div>

	<br><br><br><br><br><br>

	<div id='nums'>
		<div class='off' id="pencil">&#9998;</div>
		<div class='num off' id="num_1">1</div>
		<div class='num off' id="num_2">2</div>
		<div class='num off' id="num_3">3</div>
		<div class='num off' id="num_4">4</div>
		<div class='num off' id="num_5">5</div>
		<div class='num off' id="num_6">6</div>
		<div class='num off' id="num_7">7</div>
		<div class='num off' id="num_8">8</div>
		<div class='num off' id="num_9">9</div>
		<div class='off' id="erase">&#9747;</div>
	</div>

	<div id='net_wrapper'>
		<table id='net'>
			<tbody>
				<?$n=1;?>
				<?for($i=1; $i<=9; $i++):?>
					<tr>
						<?for($j=1; $j<=9; $j++):?>
							<td id="cell_<?=$n?>" class="unlock <?if($n==1):?>active_cell<?endif;?>"></td>
							<?$n++;?>
						<?endfor;?>
					</tr>
				<?endfor;?>
			</tbody>
		</table>
	</div>

	<div id="hint">
		<ul>
			<li><b>C</b> — режим конструктора</li>
			<li><b>Пробел</b> — режим карандаша (маленьких цифр)</li>
			<li><b>Х</b> — режим удаления</li>
			<li><b>1-9</b> — выбор цифры</li>
			<li><b>Стрелки</b> — выбор активной ячейки</li>
			<li><b>Enter</b> — вставка</li>
		</ul>
	</div>

	<? require_once $obApp->getFooterTemplate(); ?>

</body>
</html>

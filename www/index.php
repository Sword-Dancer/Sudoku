<?
require_once 'classes/Sudoku.php';
require_once 'classes/SortBuilder.php';
require_once 'classes/BasicFieldBuilder.php';

$sudoku = new Sudoku();
?>

<html>
<head>
	<title>Судоку</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<table class="sudoku_table">
	<?foreach ($sudoku->field as $x):?>
	<tr>
		<?foreach ($x as $y):?>
		<td><?=$y?></td>
		<?endforeach;?>
	</tr>
	<?endforeach;?>
</table>

</body>
</html>


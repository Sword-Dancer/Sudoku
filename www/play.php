<html>
<head>
	<title>Играть в судоку</title>
	<meta charset="utf-8">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script src="play_script.js"></script>
	<link rel="stylesheet" type="text/css" href="play_style.css">
</head>
<body>
	<div id="construct_mode" class='off'>Конструктор</div>
	<br><br><br>

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
		<table class='net'>
			<tbody>
				<tr>
					<td id="cell_1"></td>
					<td id="cell_2"></td>
					<td id="cell_3"></td>

					<td id="cell_4"></td>
					<td id="cell_5"></td>
					<td id="cell_6"></td>

					<td id="cell_7"></td>
					<td id="cell_8"></td>
					<td id="cell_9"></td>
				</tr>
				<tr>
					<td id="cell_10"></td>
					<td id="cell_11"></td>
					<td id="cell_12"></td>

					<td id="cell_13"></td>
					<td id="cell_14"></td>
					<td id="cell_15"></td>

					<td id="cell_16"></td>
					<td id="cell_17"></td>
					<td id="cell_18"></td>
				</tr>
				<tr>
					<td id="cell_19"></td>
					<td id="cell_20"></td>
					<td id="cell_21"></td>

					<td id="cell_22"></td>
					<td id="cell_23"></td>
					<td id="cell_24"></td>

					<td id="cell_25"></td>
					<td id="cell_26"></td>
					<td id="cell_27"></td>
				</tr>
				<tr>
					<td id="cell_28"></td>
					<td id="cell_29"></td>
					<td id="cell_30"></td>

					<td id="cell_31"></td>
					<td id="cell_32"></td>
					<td id="cell_33"></td>

					<td id="cell_34"></td>
					<td id="cell_35"></td>
					<td id="cell_36"></td>
				</tr>
				<tr>
					<td id="cell_37"></td>
					<td id="cell_38"></td>
					<td id="cell_39"></td>

					<td id="cell_40"></td>
					<td id="cell_41"></td>
					<td id="cell_42"></td>

					<td id="cell_43"></td>
					<td id="cell_44"></td>
					<td id="cell_45"></td>
				</tr>
				<tr>
					<td id="cell_46"></td>
					<td id="cell_47"></td>
					<td id="cell_48"></td>

					<td id="cell_49"></td>
					<td id="cell_50"></td>
					<td id="cell_51"></td>

					<td id="cell_52"></td>
					<td id="cell_53"></td>
					<td id="cell_54"></td>
				</tr>
				<tr>
					<td id="cell_55"></td>
					<td id="cell_56"></td>
					<td id="cell_57"></td>

					<td id="cell_58"></td>
					<td id="cell_59"></td>
					<td id="cell_60"></td>

					<td id="cell_61"></td>
					<td id="cell_62"></td>
					<td id="cell_63"></td>
				</tr>
				<tr>
					<td id="cell_64"></td>
					<td id="cell_65"></td>
					<td id="cell_66"></td>

					<td id="cell_67"></td>
					<td id="cell_68"></td>
					<td id="cell_69"></td>

					<td id="cell_70"></td>
					<td id="cell_71"></td>
					<td id="cell_72"></td>
				</tr>
				<tr>
					<td id="cell_73"></td>
					<td id="cell_74"></td>
					<td id="cell_75"></td>

					<td id="cell_76"></td>
					<td id="cell_77"></td>
					<td id="cell_78"></td>

					<td id="cell_79"></td>
					<td id="cell_80"></td>
					<td id="cell_81"></td>
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html>
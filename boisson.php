<html>
<head>
<link rel="STYLESHEET" type="text/css" media="all" href="style.css"/>
<title>Boisson</title>
</head>
<body>
<center>	
<div class="conteneur">
	<div class="top">
		<center><img class="centre" src="image/banniere.png"/></center>
	</div>
	
	<div class="navig">
		<script type="text/javascript" src="ejs_menu_multicolor.js"></script>
	</div>
	
	<div class="corps">
		<h1> Boissons </h1>
		<?php 
			include 'connect.php';
			$cpt=0;
			while($cpt<10)
			{
				$sql = 'SELECT * FROM boisson, type WHERE boisson.type_boisson = type_boisson.num_type_boisson AND type_boisson.num_type_boisson = "'.$cpt.'";';
				$res = mysql_query($sql) or die(mysql_error());
				$ligne = mysql_fetch_array($res);
				while($ligne)
				{
					echo  '<table class="prod">
							<tr>
								<td class="nom_menu"><h2>'.$ligne["nom_prod"].'</h2></td>
								<td rowspan="2" class="pict_vin"><img src="'.$ligne["url_img_prod"].'"></td>
								
							</tr>
							<tr>
								<td class="designation">'.$ligne["descr_prod"].'</td>
							</tr>
							</table>';								
						$ligne = mysql_fetch_array($res);
				}
					$cpt++;
			}
		?>
		
	</div>
	
	<center><span id="by">Design & created by Jean-David JACQUEMIN & Jérémy LARDET</span></center>
</div>
</center>
</body>
</html>

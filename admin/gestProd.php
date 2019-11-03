<html>
<head>
	<link rel="STYLESHEET" type="text/css" media="all" href="style.css"/>
	<title>Gestion des produits</title>
</head>

<body>
<center>	
<div class="conteneur">
	<div class="top">
		<center><img class="centre" src="../image/banniere.png"/></center>
	</div>
	
	<div class="navig">
		<script type="text/javascript" src="ejs_menu_multicolor.js"></script>
	</div>
	<div class="corps">
		<h1> Les Produits </h1>
<hr>
		<?php 
		
		//Page permettant l'ajout de produits (via formulaire externe), la consultation de tous les produits, et leur modification
			include 'connect.php';
			
			if($connect)
			{
			$sql = 'SELECT * FROM produits;';
			$res = mysql_query($sql);
			$ligne = mysql_fetch_array($res);
			
			if(!isset($_GET["method"]))
			{
				while($ligne)
				{
					echo  '<table class="prod">
							<tr>
								<td class="nom_menu"><h2>'.$ligne["nomProd"].'</h2></td>
								<td rowspan="2" class="pict_vin"><a href="../photo.php?url='.$ligne["url_imgProd"].'"><img height="100" src="../'.$ligne["url_imgProd"].'"></a></td>
							</tr>
								<tr>
								<td class="designation">'.$ligne["descrProd"].'</td>
							</tr>
							</table>
							<p class="option">
							<a href="produit.php?prod='.$ligne["numProd"].'&method=detail">Détails</a> | 
							<a href="produit.php?prod='.$ligne["numProd"].'&method=modif">Modifier</a> | 
							<a href="produit.php?prod='.$ligne["numProd"].'&method=suppr">Supprimer</a>
							</p>';
					$ligne = mysql_fetch_array($res);
				}
			}
			else
			{
			if($_GET["method"] == "modif")
			{
				
			}
			}}

		?>
	</div>
	<center><span id="by">Design & created by Jean-David JACQUEMIN & Jérémy LARDET</span></center>
</div>
</center>
</body>
</html>

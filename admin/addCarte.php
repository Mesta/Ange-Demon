<html>
<head>
 <link id="skin-steel" title="Steel" type="text/css" rel="alternate stylesheet" href="calendar/css/steel/steel.css" />
    <link type="text/css" rel="stylesheet" href="calendar/css/jscal2.css" />
    <link type="text/css" rel="stylesheet" href="calendar/css/border-radius.css" />
    <link id="skinhelper-compact" type="text/css" rel="alternate stylesheet" href="calendar/css/reduce-spacing.css" />
	<script src="calendar/js/jscal2.js"></script>
	<script src="calendar/js/lang/fr.js"></script>
	<script src="lib_fonc.js"></script>
	
<link rel="STYLESHEET" type="text/css" media="all" href="style.css"/>
<title>Ajout en cours</title>
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
	
		<div class="Corps">
		<center>
		<br>
			<?php

			if(!isset($_POST["step"]))
			{
				echo '<table><form method="POST" id="form_addCarte" name ="form_addCarte" action="addCarte.php">
						<tr>
							<td><label name="lbl_nomCarte" for="nomCarte">Nom de la carte : </label></td>
							<td><input type="text" id="nomCarte" name="nomCarte"/></td>
							<td><input type="hidden" id="step" name="step" value="1"></td>
						</tr>	
						<tr>
							<td><label name="lbl_descrCarte" for="descrCarte">Description de la carte : </label></td>
							<td><input type="textarea"  row="2" id="descrCarte" name="descrCarte"/></td>
						</tr>	
						<tr>
							<td><label for="dateDebCarte">Date de mise en circulation de la carte :</label></td>
							<td><input name="dateDebCarte" id="dateDebCarte" readonly="readonly"/></td>
							<td><button type="button" name="calendar-trigger" id="calendar-trigger">...</button></td>
									<script>
										Calendar.setup(
										{
											trigger    : "calendar-trigger",
											inputField : "dateDebCarte",
											dateFormat: "%d/%m/%Y",
											onSelect   : function() { this.hide() }
										});
									</script>
						</tr>
							
						<tr>
							<td><label for="dateFinCarte">Date de fin de circulation de la carte :</label></td>
							<td><input name="dateFinCarte" id="dateFinCarte" readonly="readonly"/></td>
							<td><button type="button" name="calendar-trigger2" id="calendar-trigger2">...</button></td>
									<script>
										Calendar.setup(
										{
											trigger    : "calendar-trigger2",
											inputField : "dateFinCarte",
											dateFormat: "%d/%m/%Y",
											onSelect   : function() { this.hide() }
										});
									</script>
						</tr></table>';
							
							
				echo '<tr><td colspan="3"><br><input type="submit" VALUE="Suite du formulaire =>" ></form></td></tr>';
			}
			else
			{
				include 'connect.php';
				
				if($_POST["step"] == 1)			
				{
					if($connect)
					{
						$resId = mysql_query("SELECT max(numCar) as maxCar from cartes;") or die(mysql_error());
						
						$res_id = mysql_fetch_array($resId);
						
						$num = $res_id["maxCar"];
						
						if($num<1)
							$num = 1;
						else
							$num = $num + 1;
					
						$tab = explode("/", $_POST["dateDebCarte"]);
						$annee = $tab[2];
						$mois = $tab[1];
						$jour = $tab[0];
						
						$dateDeb = $annee.'-'.$mois.'-'.$jour; 
						
						if(isset($_POST["dateFinCarte"]))
						{
							$tab = explode("/", $_POST["dateFinCarte"]);
							$annee = $tab[2];
							$mois = $tab[1];
							$jour = $tab[0];
						
							$dateFin = $annee.'-'.$mois.'-'.$jour; 
						}
						else
							$dateFin = null;
						
						
						
						$res = mysql_query('INSERT INTO cartes VALUES( "'.$num.'" ,"'.$_POST["nomCarte"].'", "'.$_POST["descrCarte"].'" , "'.$dateDeb.'" , "'.$dateFin.'")');
					
						if($res)
						{
							echo '<h2>Ajout de produits</h2><br>
									<form method="POST" action="addCarte.php"><table>';
							
							$sql = 'SELECT * FROM produits, types WHERE typeProd = numTyp AND typeProd BETWEEN 1 AND 6;';
							$res = mysql_query($sql) or die(mysql_error());
							$ligne = mysql_fetch_array($res);

							while($ligne)
							{
								
								echo  '<tr>
												<td><input type="checkbox" id="'.$ligne["numProd"].'" name="'.$ligne["numProd"].'"/></td>
												<td><label for="'.$ligne["numProd"].'">'.$ligne["nomProd"].'</td></label>
												<td>'.$ligne["descrProd"].'</td>
											</tr>';
								$ligne = mysql_fetch_array($res);
							}
							echo '</table><br>
									<input type="hidden" id="step" name="step" value="2">
									<input type="hidden" id="carte" name="carte" value="'.$num.'">
									<input type="submit" value="Prévisualisé le contenu de la carte =>"/>
									<input type="reset" value="Réinitialiser"/>
									</form>';
						}
					}
				}
				else
				{
					if($_POST["step"] == 2)			
					{
						echo "Ajout en cours...";
						
						$sql = 'SELECT * FROM produits WHERE typeProd BETWEEN 1 AND 6;';
						$res_prod = mysql_query($sql) or die(mysql_error());
						$ligne = mysql_fetch_array($res_prod);
						
						while($ligne)
						{
							if(isset($_POST[$prod]))
								$res = mysql_query('INSERT INTO planifier VALUES( "'.$_POST["carte"].'" ,"'.$ligne["numProd"].'")');
							$ligne = mysql_fetch_array($res_prod);
						}

						echo '<form action="index.htm">
									<input type="submit" value="Finir la création de la carte"/>
								</form>';
						
					}
					else
						echo "Une erreur est survenue lors de la création d'une nouvelle carte. Veuillez recommencer la manipulation.";
				}	
			}	
			?>
		</center>
	</div>
</div>
</center>
</body>
</html>
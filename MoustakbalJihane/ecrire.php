<?php 

	$connexion = mysql_connect("localhost", "root", "");
	mysql_select_db("etunote",$connexion);
	
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	function enregister($etu, $exe, $note, $cours) {
		$sql = "INSERT INTO notes(etu, exercice, cours, note, maj) VALUES ('$etu', '$exe', '$cours', $note, NOW()) ";
		mysql_query($sql) or die('Requête invalide : ' . mysql_error());
	}


	
	 if(isset ($_GET['nom'])) {
		extract($_GET);
		enregister($nom,html_entity_decode($cours));
		echo $nom . " à " . date("H:i") . " a eu la note $note pour l'exercice : ". $exe." du cours ".$cours;
		
		}else{
		echo "Y'a RIEN !!";
	
		}
		
		
		$xml = simplexml_load_file("https://picasaweb.google.com/data/feed/base/user/113848708930851956597/albumid/5795380358275112865?alt=rss&kind=photo&hl=fr");
		
		$i=0;
		//foreach ($xml->photo as $item){
		foreach ($xml->channel->item as $item){
			if($i % 2 == 0) $c = 'good'; else $c = 'bad';
     
				echo "<br/><label>Exercice : </label><br/><input id='exe_".$i."' />";
				echo "<br/><label>Note : </label><input id='note_".$i."' size='3' />";
				echo "<br/><label>Cour : </label><input id='note_".$i."' size='3' />";
		
		
		$i++;
	}
	?>
	

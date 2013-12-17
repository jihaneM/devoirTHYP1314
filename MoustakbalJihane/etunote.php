<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<script src="jquery.min.js" ></script>
	
	
	<script>
	
	function presentliste(etu){
		var dl = document.getElementById("lst"); 
		
		$.get("ecrire.php",
				{nom:etu.nom,cours:'LangagesWeb',raison:1} ,function(message){
					var liste = document.createElement("div"); 
					liste.setAttribute('class', 'listeP');
					liste.innerHTML = message; 
					dl.appendChild(liste);
					
				});
		
	};

	
	
	function absentliste(etu){

		var dl = document.getElementById("lst"); 
		var liste = document.createElement("div");
			liste.setAttribute('class', 'listeA');
			liste.innerHTML = etu.nom+' est abscent.';//etu.prenom+' '+etu.nom+' '+etu.diplome+' est absent';
		dl.appendChild(liste);
		
		
	};	
		function showRSS(url)
		{
			//merci � http://stackoverflow.com/questions/10943544/how-to-parse-a-rss-feed-using-javascript
			$.ajax({
				  url      : document.location.protocol + '//ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=100&callback=?&q=' + encodeURIComponent(url),
				  dataType : 'json',
				  success  : function (data) {
				    if (data.responseData.feed && data.responseData.feed.entries) {
				      $.each(data.responseData.feed.entries, function (i, e) {
				        console.log("------------------------");
				        console.log("image      : " + e.mediaGroups[0].contents[0].url);
				        console.log("title      : " + e.title);
				        console.log("author     : " + e.author);
				        console.log("description: " + e.description);
				        var oEtu = {nom:e.title,url:e.mediaGroups[0].contents[0].url};
				        showEtu(oEtu);
				        
				      });
				    }
				  }
				});
			console.log('FIN showRSS');
		}
		
		
		function showEtu(etu){
			var d=document.createElement("div");//crear el div para poner la lista de etudiants
			d.setAttribute('class', 'etu');
			d.innerHTML = etu.nom;
			document.body.appendChild(d);
			
			var tof = document.createElement("img");//crear la lista de estudiants
			tof.setAttribute('src', etu.url);
			tof.setAttribute('alt', etu.nom);
			tof.setAttribute('title', etu.nom);
			tof.addEventListener("click", function(){presentliste(etu)});
			d.appendChild(tof);

			var presImg = document.createElement("img");// crear el botton de prent
				presImg.setAttribute('src', './images/present.jpg');
				presImg.setAttribute('alt', 'pr�sent');
				presImg.setAttribute('title', 'pr�sent');
			presImg.addEventListener("click", function(){presentliste(etu)});
			d.appendChild(presImg);

			var absImg = document.createElement("img"); //crear el botton de absent
				absImg.setAttribute('src', './images/absent.jpg');
				absImg.setAttribute('alt', 'absent');
				absImg.setAttribute('title', 'absent');
				absImg.addEventListener("click", function(){absentliste(etu)});
			d.appendChild(absImg);
		};		
	</script>
	<style type="text/css">
		.etu{
		width:300px;
		}
		.listeA{
			background-color:red;
		}
		.listeP{
			background-color:green;
		}
	</style>
	</head>
	<body >
						<form>
							<select onchange="showRSS(this.value)">
								<option value="">Selectioner un dipl�me</option>
								<option value="https://picasaweb.google.com/data/feed/base/user/112537161896190034287/albumid/5931538032377292977?alt=rss&kind=photo&authkey=Gv1sRgCJjJwc265LnxigE&hl=fr">THYP 1314</option>
								<option value="">CDNL 1314</option>
							</select>
						</form>
						
						
							
						<br>
						<div id="rssOutput">Le trombinoscope va arriver...</div>
						<div id="lst" ></div><!--pour dementrer la liste des �tudiants-->
	</body>
</html>
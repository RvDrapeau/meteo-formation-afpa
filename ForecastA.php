<?php 

if (!isset($_SESSION["connected_user"])) header("location:Login.php");

?>


<html>
<head>
	<meta charset="UTF-8">


	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="css/Forecast.css">
	</head>


	<body>

<h1>Prévisions météorologiques</h1>

<h2>Données provenant de <a href="https://openweathermap.org/forecast5" target="_blank">OpenWeatherMap</a></h2>
<br>
<input id="textville" type="text" placeholder="Ville" name="ville">

<button type ="button" onclick="test()" name="bouton" class="btn btn-primary" data-toggle="tooltip" title="écrire la ville avec une majuscule et sans accent">Validation</button>


<p id="actualDate"></p>

<br><br>

		<table id="example" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr>
					<th>Ville</th>
					<th>Date</th>
					<th>température en °C</th>
					<th>taux d'humidité</th>
					<th>vitesse du vent</th>
                    <th>densité des nuages</th>
					<th>type de temps</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>Ville</th>
					<th>Date</th>
                    <th>température en °C</th>
                    <th>taux d'humidité</th>
                    <th>vitesse du vent en m/s</th>
                    <th>densité des nuages</th>
                    <th>type de temps</th>
				</tr>
			</tfoot>
		</table>
		
        <div id="zone1"></div>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
        
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
        
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
			<script>

				$(document).ready(function() {
					$('#example').DataTable({
						"ajax": {
							"url": "http://api.openweathermap.org/data/2.5/forecast?q=Angouleme&units=metric&mode=json&appid=4c751f95a60360ae52bee41672463b92&lang=fr",			//prettify json pour mieux visualiser
							"dataSrc": function ( json ) {

                                 var forecast=new Array();
									for ( var i=0, ien=json.list.length ; i<ien ; i++ ) {
									    forecast[i]=new Array();
										
										forecast[i][0] = document.getElementById('textville').value;
										forecast[i][1] = json.list[i].dt_txt;
									    forecast[i][2] = json.list[i].main.temp;
									    forecast[i][3] = json.list[i].main.humidity;
									    forecast[i][4] = json.list[i].wind.speed;
									    forecast[i][5] = json.list[i].clouds.all;
									    forecast[i][6] = json.list[i].weather[0].description;
								
                                   }
                                return forecast;
						
							}
			}
		});
			
	} );
						</script>


    <script type="text/javascript">
        function test() {

            $.getJSON( "http://api.openweathermap.org/data/2.5/weather?q="+$('#textville').val()+"&units=metric&mode=json&appid=4c751f95a60360ae52bee41672463b92&lang=fr", function( data ) {
                $("#zone1").html(data.weather[0].description+' '+data.main.temp+' K');

            });


			$('#example').DataTable().ajax.url("http://api.openweathermap.org/data/2.5/forecast?q=" + document.getElementById('textville').value + "&units=metric&mode=json&appid=4c751f95a60360ae52bee41672463b92&lang=fr").load();

            /*$.ajax({
              url: "http://api.openweathermap.org/data/2.5/weather?q=Angouleme&units=metric&mode=json&appid=4c751f95a60360ae52bee41672463b92&lang=fr",
            }).done(function(texte) {

              $("#zone1").html(texte);
            });*/
        }
	</script>

	<script>

		function changeHeure() {
			var date = new Date();
			var months = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre"];
			m = date.getMinutes();
			if(m<10)
			{
					m = "0"+m;
			}

			document.getElementById("actualDate").innerHTML = "Il est " + date.getHours() + "h" + m + " le " + date.getDate() + " " + months[date.getMonth()] + " " + date.getFullYear();
		}

		setInterval(changeHeure,1000);

	</script>

<img src="https://www.actualite.co/thumb/bb3e938d303dc61ae4779de05a877f91.jpg"/>

<a href="Login.php" id="Retour">Retour</a>

<address>Site crée par Hervé Drapeau</address>
</body>
</html>
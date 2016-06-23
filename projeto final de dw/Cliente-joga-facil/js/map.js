var map;
var idInfoBoxAberto;
var infoBox = [];
var markers = [];

function initialize() {
	var latlng = new google.maps.LatLng(-15.8177186, -48.09612270000002);
	var options = {
		zoom: 17,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};

	map = new google.maps.Map(document.getElementById("mapa"), options);
}

initialize();

function abrirInfoBox(id, marker) {
	if (typeof(idInfoBoxAberto) == 'number' && typeof(infoBox[idInfoBoxAberto]) == 'object') {
		infoBox[idInfoBoxAberto].close();
	}

	infoBox[id].open(map, marker);
	idInfoBoxAberto = id;
}

function carregarPontos() {

	$.getJSON('pontos.json', function(pontos) {

		var latlngbounds = new google.maps.LatLngBounds();

		$.each(pontos, function(index, ponto) {

			var marker = new google.maps.Marker({
				position: new google.maps.LatLng(ponto.lat, ponto.longe),
				title: ponto.nome_partida,
				icon: 'imagens/marcador-bola.png'
			});

			var myOptions = {
				content: "<p>" +"Data da Partida: "+ ponto.data + "  Horario da Partida: " + ponto.horario+ "</p>" ,
				pixelOffset: new google.maps.Size(-150, 0)
			};

			infoBox[ponto.idt_partida] = new InfoBox(myOptions);
			infoBox[ponto.idt_partida].marker = marker;

			infoBox[ponto.idt_partida].listener = google.maps.event.addListener(marker, 'click', function (e) {
				abrirInfoBox(ponto.idt_partida, marker);
			});

			markers.push(marker);

			latlngbounds.extend(marker.position);

		});

		var markerCluster = new MarkerClusterer(map, markers);

		map.fitBounds(latlngbounds);

	});

}

carregarPontos();
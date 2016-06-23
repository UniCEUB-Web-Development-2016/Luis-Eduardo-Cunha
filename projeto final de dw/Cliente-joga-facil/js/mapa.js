var geocoder;
var map;
var marker;

function initialize() {
	var latlng = new google.maps.LatLng(-15.8177186, -48.09612270000002);
	var options = {
		zoom: 17,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};

	map = new google.maps.Map(document.getElementById("mapa"), options);

	geocoder = new google.maps.Geocoder();

	marker = new google.maps.Marker({
		map: map,
		draggable: true,
	});

	marker.setPosition(latlng);
}

$(document).ready(function () {

	initialize();

	function carregarNoMapa(endereco) {
		geocoder.geocode({ 'address': endereco + ', Brasil', 'region': 'BR' }, function (results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				if (results[0]) {
					var latitude = results[0].geometry.location.lat();
					var longitude = results[0].geometry.location.lng();

					$('#txtEndereco').val(results[0].formatted_address);
					$('#txtLatitude').val(latitude);
					$('#txtLongitude').val(longitude);
					$('#txtDescricao').val(descricao);


					var location = new google.maps.LatLng(latitude, longitude);
					marker.setPosition(location);
					map.setCenter(location);
					map.setZoom(16);
				}
			}
		})
	}

	$("#btnEndereco").click(function() {
		if($(this).val() != "")
			carregarNoMapa($("#txtEndereco").val());
	})

	$("#txtEndereco").blur(function() {
		if($(this).val() != "")
			carregarNoMapa($(this).val());
	})

	google.maps.event.addListener(marker, 'drag', function () {
		geocoder.geocode({ 'latLng': marker.getPosition() }, function (results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				if (results[0]) {
					$('#txtEndereco').val(results[0].formatted_address);
					$('#txtLatitude').val(marker.getPosition().lat());
					$('#txtLongitude').val(marker.getPosition().lng());
				}
			}
		});
	});

	$("#txtEndereco").autocomplete({
		source: function (request, response) {
			geocoder.geocode({ 'address': request.term + ', Brasil', 'region': 'BR' }, function (results, status) {
				response($.map(results, function (item) {
					return {
						label: item.formatted_address,
						value: item.formatted_address,
						latitude: item.geometry.location.lat(),
						longitude: item.geometry.location.lng()
					}
				}));
			})
		},
		select: function (event, ui) {
			$("#txtLatitude").val(ui.item.latitude);
			$("#txtLongitude").val(ui.item.longitude);
			var location = new google.maps.LatLng(ui.item.latitude, ui.item.longitude);
			marker.setPosition(location);
			map.setCenter(location);
			map.setZoom(16);
		}

	});




	//$("form").submit(function(event) {
	//	event.preventDefault();
    //
	//	var nomepartida = document.getElementById("nome_partida").value;
	//	var horario = document.getElementById("horario").value;
	//	var data = document.getElementById("data").value;
	//	var endereco = document.getElementById("txtEndereco").value;
	//	var latitude = document.getElementById("txtLatitude").value;
	//	var longitude = document.getElementById("txtLongitude").value;
    //
	//	$.ajax({
    //
	//		type : 'POST', /* Tipo da requisição */
	//		url : 'insertpartida.php', /* URL que será chamada */
    //
	//		data:{ 'nomepartida':  $('#nome_partida').val(),
	//			   'horario': $('#horario').val(),
	//			   'data':  $('#data').val(),
	//			'latitude':  $('#txtLatitude').val(),
	//			'longitude':  $('#txtLongitude').val(),
	//			  'endereco': encodeURIComponent($('#txtEndereco').val())},
    //
	//		dataType: 'json',
    //
	//	})
	//	alert(endereco);
	//});

});


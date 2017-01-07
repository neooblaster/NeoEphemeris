<?php

	/**
		lat: Latitude in decimal degrees. Required.
		lng: Longitude in decimal degrees. Required.
		date: Date in YYYY-MM-DD format. Also accepts other date formats and even relative date formats. If not present, date defaults to current date. Optional.
		callback: Callback function name for JSONP response. Optional.
		formatted: 0 or 1 (1 is default). Time values in response will be expressed following ISO 8601 and day_length will be expressed in seconds. Optional.
		
		
		{
			"results":{
			
				"astronomical_twilight_begin":"5:58:36 AM",
				"nautical_twilight_begin":"6:29:55 AM",
				"civil_twilight_begin":"7:02:03 AM",
			
				"sunrise":"8:08:52 AM", 							// Heure du levé
				"solar_noon":"12:23:51 PM",						// Heure au plus haut
				"sunset":"4:38:51 PM", 								// Heure du couché
			
				"civil_twilight_end":"5:45:37 PM",
				"nautical_twilight_end":"6:17:46 PM",
				"astronomical_twilight_end":"6:49:05 PM"
			
				"day_length":"08:29:59",							// Durée de la journée
			},
			"status":"OK"
		}
		
		
	**/

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'http://api.sunrise-sunset.org/json?lat=48.592832&lng=-4.423762');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);

	// CURLOPT_RETURNTRANSFER = true
	//$result = curl_exec($ch);

	// CURLOPT_RETURNTRANSFER = false
	curl_exec($ch);

	// Fermeture du pointeur
	curl_close($ch);

?>
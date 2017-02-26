<?php
/** -------------------------------------------------------------------------------------------------------------------- ** 
/** -------------------------------------------------------------------------------------------------------------------- ** 
/** ---																																					--- **
/** --- 											------------------------------------------------										--- **
/** ---																{ solstices.php }																--- **
/** --- 											------------------------------------------------										--- **
/** ---																																					--- **
/** ---		TAB SIZE			: 3																													--- **
/** ---																																					--- **
/** ---		AUTEUR			: Nicolas DUPRE																									--- **
/** ---																																					--- **
/** ---		RELEASE			: 26.02.2017																										--- **
/** ---																																					--- **
/** ---		APP_VERSION		: 1.0.0.0																											--- **
/** ---																																					--- **
/** ---		FILE_VERSION	: 1.0 NDU																											--- **
/** ---																																					--- **
/** ---																																					--- **
/** --- 														---------------------------														--- **
/** ---															{ C H A N G E L O G }															--- **
/** --- 														---------------------------														--- **
/** ---																																					--- **
/** ---																																					--- **
/** ---		VERSION 1.0 : 26.02.2017 : NDU																									--- **
/** ---		------------------------------																									--- **
/** ---			- Première release																												--- **
/** ---																																					--- **
/** -------------------------------------------------------------------------------------------------------------------- **
/** -------------------------------------------------------------------------------------------------------------------- **

	Requirements :
	--------------

	Input Params :
	--------------
	
		[ Integer $year = null 
			[, Float $latitude = null 
				[, Float $longitude = null 
					[, $gmt_offset = 0 
						[, String $timezone = "UTC" 
							[, Float $zenoth = null]
						]
					]
				]
			]
		]
	
	Output Params :
	---------------

	Objectif du script :
	---------------------
	
	Description fonctionnelle :
	----------------------------

/** -------------------------------------------------------------------------------------------------------------------- **
/** -------------------------------------------------------------------------------------------------------------------- **/
function solstices($year=null, $latitude=null, $longitude=null, $gmt_offset=0, $timezone="UTC", $zenith=null){
	/** 1. Sécurisation des arguments **/
		// 1.1. L'année
		$year = (is_null($year)) ? date("Y", time()) : $year;
	
		// 1.2. Coordonnées
		$latitude = (is_null($latitude)) ? ini_get("date.default_latitude") : $latitude;
		$longitude = (is_null($longitude)) ? ini_get("date.default_longitude") : $longitude;
	
		// 1.3. Paramètre facultatif
		$zenith = (is_null($zenith)) ? ini_get("date.sunrise_zenith") : $zenith;
	
	
	/** 2. Définir la timezone de travail **/
	date_default_timezone_set($timezone);
	
	
	/** 3. Définir la période de recherche **/
	$reading_date = mktime(0, 0, 0, 1, 1, $year);
	$closing_date = mktime(0, 0, 0, 12, 31, $year);
	
	
	/** 4. Analyse jour par jour **/
	$daylengths = Array();
	$dates = Array();  
	
	while($reading_date <= $closing_date){
		// Timestamp des sunrise//sunset
		$sunrise = date_sunrise($reading_date, SUNFUNCS_RET_TIMESTAMP, $latitude, $longitude, $zenith, $gmt_offset);
		$sunset = date_sunset($reading_date, SUNFUNCS_RET_TIMESTAMP, $latitude, $longitude, $zenith, $gmt_offset);
		$daylength = $sunset-$sunrise;
		
		// Stockage des informations
		$daylengths[] = $daylength;
		$dates[] = $reading_date;
		
		// Ajoute un jour de plus (en seconde)
		$reading_date += 86400;
	}
	
	// Rechercher les clés du jour le plus long et le jour le plus cours
	$shortest_key = array_search(min($daylengths), $daylengths);
	$longest_key = array_search(max($daylengths), $daylengths);
	
	
	/** 5. Envois des résultats **/
	return Array(
		"params" => Array(
			"latitude" => $latitude,
			"longitude" => $longitude,
			"zenith" => $zenith,
			"timezone" => $timezone,
			"gmt_offset" => $gmt_offset
		),
		"summer" => $dates[$longest_key],
		"winter" => $dates[$shortest_key]
	);
}
?>
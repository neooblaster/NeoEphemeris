<?php
/** -------------------------------------------------------------------------------------------------------------------- ** 
/** -------------------------------------------------------------------------------------------------------------------- ** 
/** ---																																					--- **
/** --- 											------------------------------------------												--- **
/** ---														{ setup.timezone.php }																--- **
/** --- 											------------------------------------------												--- **
/** ---																																					--- **
/** ---		AUTEUR 	: Nicolas DUPRE																											--- **
/** ---																																					--- **
/** ---		RELEASE	: 08.01.2016																												--- **
/** ---																																					--- **
/** ---		VERSION	: 1.0																															--- **
/** ---																																					--- **
/** ---																																					--- **
/** --- 														-----------------------------														--- **
/** --- 															{ C H A N G E L O G } 															--- **
/** --- 														-----------------------------														--- **	
/** ---																																					--- **
/** ---																																					--- **
/** ---		VERSION 1.0 : 08.01.2016																											--- **
/** ---		------------------------																											--- **
/** ---			- Première release																												--- **
/** ---																																					--- **
/** -------------------------------------------------------------------------------------------------------------------- **
/** -------------------------------------------------------------------------------------------------------------------- **

	Objectif du script :
	---------------------
	
		Nécessite l'existance de la constante TIMEZONE
		Le script appelant doit avoir au préalable executé "json_to(file_get_content(?./"Configs/config.application.params.json"))"
	
	
	Description fonctionnelle :
	----------------------------
	
/** -------------------------------------------------------------------------------------------------------------------- **
/** -------------------------------------------------------------------------------------------------------------------- **/
/** Forcer le fonctionnement en mode GMT **/
ini_set('date.timezone', 'GMT');

/** Calculer l'offset entre GMT et ParisTime**/
	/** Calculer l'écart entres les timezone : Création des DateTimeZone **/
	//$__dateTimeZoneParis = new DateTimeZone("Europe/Paris");
	$__dateTimeZoneLocal = new DateTimeZone(TIMEZONE);
	$__dateTimeZoneGMT = new DateTimeZone("UTC"); //GMT
	
	/** Calculer les timestamps de chaque fuseau **/
	$__dateTimeLocal = new DateTime('now', $__dateTimeZoneLocal);
	$__dateTimeGMT = new DateTime('now', $__dateTimeZoneGMT);
	
	/** Calculer l'écart **/
	$_TIME_OFFSET = $__dateTimeZoneLocal->getOffset($__dateTimeGMT);

?>
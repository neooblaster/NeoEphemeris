<?php
/** ------------------------------------------------------------------------------------------------------------------- 
/** ------------------------------------------------------------------------------------------------------------------- 
/** ---																												---
/** --- 			 			-----------------------------------------------										---	
/** --- 			 					  { C R Y P T P W D . P H P } 												---	
/** --- 			 			-----------------------------------------------										---	
/** ---																												---
/** ---		AUTEUR 	: Neoblaster																					---
/** ---																												---
/** ---		RELEASE	: 28.11.2014																					---
/** ---																												---
/** ---		VERSION	: 1.1																							---
/** ---																												---
/** ---																												---
/** --- 			 						-----------------------------											---
/** --- 			 							{ C H A N G E L O G } 												---	
/** --- 			 						-----------------------------											---	
/** ---																												---
/** ---		VERSION 1.1 :																							---
/** ---		-------------																							---
/** ---			- Correction de l'étape : 2. CONVERSION. Modification du modulo de 16 à 15							---
/** ---			- Suppresision d'un appel parasite																	---
/** ---																												---
/** ---		VERSION 1.0 :																							---
/** ---		-------------																							---
/** ---			- Première release																					---
/** ---																												---
/** ---																												---
/** --- 			 			         ---------------------------------											---	
/** --- 			 				         { D E S C R I P T I O N } 												---	
/** --- 			 			         ---------------------------------											---	
/** ---																												---
/** ---			Le role de cette fonction est de fournir un mot de passe crypter non décryptable.					---
/** ---		Les fonctions crypt, sha1 et md5 sont facilement décryptable et ne peuvent être simplement utilisée		---
/** ---		En cas de piratahe de la base de donnée, les mots de passe reste sécurisé a moins d'avoir accès à ce 	---
/** ---		docuement.																							 	---
/** ---																									 			---
/** ---			La fonction opère des calculs entre le mot de passe d'origine et une clé							---
/** ---																												---
/** ---																												---
/** --- 			 			-----------------------------------------------------								---	
/** --- 			 				{ L I S T E      D E S      M E T H O D E S } 									---	
/** --- 			 			-----------------------------------------------------								---	
/** ---																												---
/** ---																												---
/** -------------------------------------------------------------------------------------------------------------------
/** ------------------------------------------------------------------------------------------------------------------- **/
	function cryptpwd($password, $key){
		/***********************/
		/** 0. INITIALISATION **/
		/***********************/
		$key = sha1($key);
		$kToV = Array(
			'0' => 0, '1' => 1, '2' => 2, '3' => 3,
			'4' => 4, '5' => 5, '6' => 6, '7' => 7,
			'8' => 8, '9' => 9, 'a' => 10, 'b' => 11,
			'c' => 12, 'd' => 13, 'e' => 14, 'f' => 15
		);		
		$vToK = Array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');	
		
		$password = sha1($password);
		
		$sha1_calculated = null;
		$output = null;
		
		/********************/
		/** 1. CALCULATION **/
		/********************/
		for($i = 0; $i < strlen($password); $i++){
			$sha1_calculated .= ($sha1_calculated == null) ? ($kToV[$password[$i]] + $kToV[$key[$i]]) : '.'.($kToV[$password[$i]] + $kToV[$key[$i]]) ;
		}
		
		$sha1_calculated = explode('.', $sha1_calculated);
		
		/*******************/
		/** 2. CONVERTION **/
		/*******************/
		for($i = count($sha1_calculated) - 1; $i >= 0; $i--){			
			$cr_value = $sha1_calculated[$i];			
			do {
				if($cr_value > 15){
					$cr_value -= 16;
					$sha1_calculated[$i-1]++; 
				}
			} while($cr_value > 15);			
			$output .= $vToK[$cr_value];
		}
		
		return $output;
	}	
?>
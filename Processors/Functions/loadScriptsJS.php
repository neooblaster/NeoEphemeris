<?php
/** -------------------------------------------------------------------------------------------------------------------- ** 
/** -------------------------------------------------------------------------------------------------------------------- ** 
/** ---																																					--- **
/** --- 										------------------------------------------------											--- **
/** ---												{ L O A D S C R I P T S J S . P H P }													--- **
/** --- 										------------------------------------------------											--- **
/** ---																																					--- **
/** ---		AUTEUR 	: Neoblaster																												--- **
/** ---																																					--- **
/** ---		RELEASE	: 31.03.2015																												--- **
/** ---																																					--- **
/** ---		VERSION	: 1.0																															--- **
/** ---																																					--- **
/** ---																																					--- **
/** --- 														-----------------------------														--- **
/** --- 															{ C H A N G E L O G } 															--- **
/** --- 														-----------------------------														--- **	
/** ---																																					--- **
/** ---																																					--- **
/** ---		VERSION 3.0 : 31.03.2015																											--- **
/** ---		------------------------																											--- **
/** ---			- Remplacement du paramètre d'entrée $path pour permettre une utilisation par paramètre facultatif		--- **
/** ---																																					--- **
/** ---		VERSION 2.0 : 05.03.2015																											--- **
/** ---		------------------------																											--- **
/** ---			- Permet de spécifier la sortie de donnée : sortie direct, ou donnée rangées dans un array				--- **
/** ---																																					--- **
/** ---		VERSION 1.0 :																															--- **
/** ---		-------------																															--- **
/** ---			- Première release																												--- **
/** ---																																					--- **
/** -------------------------------------------------------------------------------------------------------------------- **
/** -------------------------------------------------------------------------------------------------------------------- **

	Input Params :
	--------------
		- $output	[String]	:	Format des données à l'issue de la fonction (soit echo, soit un tableau)
	
	Output Params :
	---------------
		- $Scripts		[Array]	:	Uniquement si $output = array;

/** -------------------------------------------------------------------------------------------------------------------- **
/** -------------------------------------------------------------------------------------------------------------------- **/	
function loadScriptsJS($output){
		/** > Inclusion automatique de la fonction sortScandir si ce n'est pas déjà fait **/
		if(file_exists('sortScandir.php')){
			require_once 'sortScandir.php';	
		}
		
		/** > Analyser le nombre de paramètre envoyé à la fonction **/
		if(func_num_args() === 1){
			$path = Array('Scripts');
		} else {
			$path = func_get_args();	// Récupération ds argurments
			array_shift($path);			// Suppression du premier argument
		}
		
		
		/** > Analyser tout les dossiers demandé **/
		$Scripts = Array();
		$output = strtolower($output);
		
		foreach($path as $key => $value){
			/** > Scanner le dossier **/
			$scan = scandir($path[$key], 1);
			$scan = sortScandir($scan);
			
			/** > Lecture du dossier **/
			for($i = 2; $i < count($scan); $i++){
				if(!is_dir($path[$key].'/'.$scan[$i]) && !preg_match('#readme\.md#i', $path[$key].'/'.$scan[$i])){
					/** > Si output = true, alors emettre les sorties **/
					if($output){
						echo "<script type=\"text/javascript\" src=\"".$path[$key]."/$scan[$i]\"></script>\r\t";
					}	
					
					/** > Ajouter les données au tableau **/
					$Scripts[] = Array(
						'SCRIPT_FILE' => str_replace("//", "/", $path[$key].'/'.$scan[$i]),
						'SCRIPT_FILEMTIME' => filemtime($path[$key].'/'.$scan[$i])
					);
				}
			}
		}
		return $Scripts;
	}
?>














/** ----------------------------------------------------------------------------------------------------------------------- ** 
/** ----------------------------------------------------------------------------------------------------------------------- ** 
/** ---																																						--- **
/** --- 														---------------------------															--- **
/** ---																{ ephemeris.js }																	--- **
/** --- 														---------------------------															--- **
/** ---																																						--- **
/** ---		TAB SIZE			: 3																														--- **
/** ---																																						--- **
/** ---		AUTEUR			: Nicolas DUPRE																										--- **
/** ---																																						--- **
/** ---		RELEASE			: xx.xx.2017																											--- **
/** ---																																						--- **
/** ---		APP_VERSION		: 1.3.1.0																												--- **
/** ---																																						--- **
/** ---		FILE_VERSION	: 0.1 NDU																												--- **
/** ---																																						--- **
/** ---																																						--- **
/** --- 														-----------------------------															--- **
/** --- 															 { C H A N G E L O G } 																--- **
/** --- 														-----------------------------															--- **
/** ---																																						--- **
/** ---		VERSION 0.1 : xx.xx.2017 : NDU																										--- **
/** ---		------------------------------																										--- **
/** ---			- Première release																													--- **
/** ---																																						--- **
/** --- 											-----------------------------------------------------										--- **
/** --- 												{ L I S T E      D E S      M E T H O D E S } 											--- **
/** --- 											-----------------------------------------------------										--- **
/** ---																																						--- **
/** ----------------------------------------------------------------------------------------------------------------------- **
/** ----------------------------------------------------------------------------------------------------------------------- **


	Objectif de la fonction :
	-------------------------
		


	variable Globales requises :
	----------------------------
		
	

	Déclaration des structure de donnée :
	-------------------------------------
		
	

	Description fonctionnelle :
	---------------------------
		
	
	
	Exemples d'utilisations :
	-------------------------
		
	
	
	
/** ----------------------------------------------------------------------------------------------------------------------- **
/** ----------------------------------------------------------------------------------------------------------------------- **/
function ephemeris(){
	var self = this;
	
	self.watcher = null;
	
	self.init = function(){
		self.watcher = new SSE("watch-sunrise-sunset-api");
		self.watcher.target("Processors/Async/watcher.php");
		self.watcher.callback(self.update);
		self.watcher.consoleOn();
		self.watcher.setTimeoutDelay(30000);
		self.watcher.start();
	};
	
	self.update = function(stream){
		try {
			stream = JSON.parse(stream.data);
			
			if(stream.status === "OK"){
				stream = stream.results;
				console.log(stream);
				
				
				/*
				day_length
				:
				"08:33:08"
				solar_noon
				:
				"12:24:42 PM"
				**/
				
				/** Calculer le degrée d'offset correpsondant à la timezone à imputer sur les horaires recu **/
				var timezone_offset = (stream.timezone_offset * 360) / (24 * 3600);
				//var timezone_offset = 0;
				
				
				/** Conversion des temps en degrée (fournis en UTC) avec offset appliqué **/
				var astronomical_start = self.time_to_deg(stream.astronomical_twilight_begin) + timezone_offset;
				//console.log(timezone_offset, self.time_to_deg(stream.astronomical_twilight_begin), astronomical_start);
				var nautical_start = self.time_to_deg(stream.nautical_twilight_begin) + timezone_offset;
				var civil_start = self.time_to_deg(stream.civil_twilight_begin) + timezone_offset;
				var sunrise = self.time_to_deg(stream.sunrise) + timezone_offset;
				
				var sunset = self.time_to_deg(stream.sunset) + timezone_offset;
				var civil_end = self.time_to_deg(stream.civil_twilight_end) + timezone_offset;
				var nautical_end = self.time_to_deg(stream.nautical_twilight_end) + timezone_offset;
				var astronomical_end = self.time_to_deg(stream.astronomical_twilight_end) + timezone_offset;
				
				
				/** Effectuer les calculs **/
					// Sunrise - 0° axe vertical, en bas, positif = rotation sens horaire, 0° = 00h00
					// Positionnement de la zone visible "Astronomical Start"
					var sunrise_astronomical = astronomical_start;
					
					// Positionnement de la zone visible "Astro_To_Sunrise"
					var sunrise_sunrise = sunrise - sunrise_astronomical;
					
					// Positionnement de la zone visible "Sunrise_To_Nautical"
					var sunrise_nautical = -1 * (sunrise - nautical_start);
					
					// Positionnement de la zone visible "Nautical_To_Civil"
					var sunrise_civil = civil_start - nautical_start;
					
					
					// Sunset - 0° axe vertical, en bas , négatif = rotation sens anti-horaire, 0° = 00h00
					// Positionnement de la zone visible "Astronomical End"
					var sunset_astronomical = astronomical_end;
						sunset_astronomical = -1 * (360 - sunset_astronomical);
						
					// Positionnement de la zone visible "Astro_To_Sunset"
					var sunset_sunset = -1 * (astronomical_end - sunset);
					
					// Positionnement de la zone visible "Sunrset_To_Nautical"
					var sunset_nautical = -1 * (sunset - nautical_end);
					
					// Positionnement de la zone visible "Nautical_To_Civil"
					var sunset_civil = -1 * (nautical_end - civil_end);
					
					
					
					// Maintenant() - 0° axe vertical, en haut, positif = rotaton sens horaire, 0° = 12h00 -> sens antihoraire
					var now = new Date();
					var isNoon = (now.getHours() > 12);
					var hour = (now.getHours() > 12) ? (now.getHours() - 12) : now.getHours();
					var now_str = hour+":"+now.getMinutes()+":"+now.getSeconds()+" "+((isNoon) ? ("PM") : ("AM"));
					var clock_deg = self.time_to_deg(now_str);
				
				
				
				/** Appliquer les calculs **/
				document.querySelector(".ephemeris .rings").classList.remove('uninitialized');
				document.querySelector(".ephemeris .clock").setAttribute("style", "transform: rotate("+(180-clock_deg)+"deg);");
				
				document.querySelector(".ephemeris .rings .start_astronomical").setAttribute("style", "transform: rotate("+sunrise_astronomical+"deg);");
				document.querySelector(".ephemeris .rings .start_nautical").setAttribute("style", "transform: rotate("+sunrise_sunrise+"deg);");
				document.querySelector(".ephemeris .rings .start_civil").setAttribute("style", "transform: rotate("+sunrise_nautical+"deg);");
				document.querySelector(".ephemeris .rings .start_sunrise").setAttribute("style", "transform: rotate("+sunrise_civil+"deg);");
				
				document.querySelector(".ephemeris .rings .end_astronomical").setAttribute("style", "transform: rotate("+sunset_astronomical+"deg);");
				document.querySelector(".ephemeris .rings .end_nautical").setAttribute("style", "transform: rotate("+sunset_sunset+"deg);");
				document.querySelector(".ephemeris .rings .end_civil").setAttribute("style", "transform: rotate("+sunset_nautical+"deg);");
				document.querySelector(".ephemeris .rings .end_sunset").setAttribute("style", "transform: rotate("+sunset_civil+"deg);");
				
			} else {
				console.error("Sunset/Sunrise API Respond with Not OK Status", stream);
			}
		} catch (err){
			console.log(err, stream.data);
		}
	};
	
	self.time_to_deg = function(time){
		var deg = 0;
		var noon_pattern = /PM$/gi;
		var isNoon = noon_pattern.test(time);
		time = time.replace(/\s[A-P]M$/gi, "");
		time = time.split(":");
		
		var hours = parseInt(time[0]);
		var minutes = parseInt(time[1]);
		var seconds = parseInt(time[2]);
		
		seconds = seconds +(minutes * 60) + ((isNoon) ? ((hours+12) * 3600) : (hours * 3600));
		
		deg = (seconds * 360) / (24 * 3600);
		
		return Math.froundx(deg, 4);
	};
}

var EPHEMERIS = new ephemeris();
	EPHEMERIS.init();
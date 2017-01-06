This folder is made to received all files which you want to automaticaly includes in all php scripts

Configuration required in php.ini :

	; UNIX: "/path1:/path2"
	include_path = ".:/usr/share/php:/var/www/NeoEphemeris/Prepends"

	; Automatically add files before PHP document.
	; http://php.net/auto-prepend-file
	auto_prepend_file = "auto_prepend_files.php"
This folder is made to received Languages packages

How To with script executed in /Languages Folder

To generate Language environnement from script executed in /Languages :

<?php

	SYSLangCompilator::build_environnement("../", "fr-FR:Français");

?>


To add new languages

<?php

	$lng = new SYSLangCompilator("../");
	$lng->add_languages("en-EN:English");

?>


To Append referent package changes to others packages :

<?php

	$lng = new SYSLangCompilator("../");
	$lng->compile();

?>
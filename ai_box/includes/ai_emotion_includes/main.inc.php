<?php
/*********************************************************************************
   {ZIMP EMOTION ARTIFICIAL INTELIGIENCE ALGORITHAM}

creator: raman tehlan
date   : 25/07/2015
detail : this is to include libraries needed for basic run
*******************************************************************************/


//include of set of words 
include "$path/includes/set.lib.php";

//inclues the correct functions to correct strings
include "$path/includes/correct.lib.php";

$correct = new correct_algorithms();

//includes the search functions
include "$path/includes/search.lib.php";

$search = new search_algorithms();

//include of basic algorithm
include "$path/includes/ai_emotion_includes/algoritham.lib.php";

$emotions = new emotion_algorithms();


?>
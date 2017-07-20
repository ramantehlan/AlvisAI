<?php
/*********************************************************************************
  

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

//includes the search functions
include "$path/includes/filter.lib.php";

$filter = new filter();

//include the algoritham to learn 
include "$path/includes/ai_learn_includes/algoritham.lib.php";

$learn = new learn_algoritham();





?>
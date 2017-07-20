<?php 
/*********************************************
this is the basic interface of Alvis box 
this is use to include Alvis to all the pages
*********************************************/


?>

<link rel='stylesheet' href='http://<?php echo $host; ?>/ai_box/assets/css/talk-ai-call-ui.css'> 





<div class='basic_box_ai pop box_of_pop moveable'>
    <div class='top_of_pop top_of_app_ai_box mover'>
      <?php echo ai_name ?>

      <div class='close_of_pop close_of_app_ai'>

      </div>
    </div>
     <div class='main_content_box_of_ai body_of_pop'>
             <?php
                /*********************************************
                  this is to include program-o app file
                **********************************************/
                 switch ($page) {
                   case 'board':
                    $path_of_program = "..";
                     break;

                    case 'wall':
                    $path_of_program = "..";
                     break;

                    case 'settings':
                    $path_of_program = "..";
                     break;

                     case 'questions':
                    $path_of_program = "..";
                     break;

                    case 'notification_link':
                    $path_of_program = "..";
                     break;
                   
                   default:
                     $path_of_program = "..";
                     break;
                 }

                 include "$path_of_program/ai_box/ai/program_o/gui/jquery/index.php";

             ?>
     </div>

</div>


<script type="text/javascript">

$('.basic_box_ai').hide();

$("#talk_to_ai").click(function(){

        //$('#black').show();
        $('.basic_box_ai').show();


});




$(".close_of_app_ai").click(function(){

        $('#black').hide();
        $('.basic_box_ai').hide();


});

</script>

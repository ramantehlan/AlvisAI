<?php

/*
this is for the privacy 

-who can ask question
-allow anonymous question
*/

?>

       <?php 
          
          if(allow_question )
          {
            echo " <div class='option_to_settings' style='width:450'>
         
           <div class='left_title_of_input'>Allow anonymous Question: </div>
                    <input type='checkbox' id='allow_anon_ask' >
                                <label for='allow_anon_ask'><div class='checkbox--img check_box'></div></label>

        </div>
                      
       <div class='option_to_settings' style='width:450'>
         
            <div class='left_title_of_input'>Who can Question: </div>

                      <select class='settings_input input' id='who_can_ask'>
                         <option value='a' selected>Everyone</option>
                         <option value='b'>Following</option>
                      </select>

       </div>
       ";
          }

       ?>

       



       <div class='error settings_saving_platform'></div>

                        <div class='bottom_of_box'>
                                
                              
                              <input type='button' class='button save_button' value='save'>

                        </div>

                         <script type="text/javascript">
                                
                                $(document).ready(function(){
                                             var who_can_ask   = $('#who_can_ask');
                                             var allow_anon    = $('#allow_anon_ask');
                                             var check         = <?php echo $allow_anon_ask; ?>;

                                             who_can_ask.val('<?php echo $who_can_ask; ?>');
                                              
                                              if(check == 1)
                                              {
                                                     allow_anon.attr("checked",true);
                                              }
                                              else
                                              {
                                                      allow_anon.attr("checked",false);
                                              }
                                              
                                });

                                $(".save_button").click(function(){
                                   
                                   var display      = $('.settings_saving_platform');
                                   var who_can_ask  = $('#who_can_ask').val();
                                   var allow_anon   = document.getElementById('allow_anon_ask').checked;

                                   $('html').css('cursor','wait');
                                   $(this).css('cursor','wait');

                                   display.show();
                                   display.html('Saving...');

                                   $.post("<?php echo _php_dir_; ?>settings/save_privacy_settings.php",{who_can_ask:who_can_ask,allow_anon:allow_anon},function(save_privacy){
                                      
                                      display.html(save_privacy);
                                      $('html').css('cursor','default');
                                      $(".save_button").css('cursor','default');

                                   });
                                    

                                });

                       </script>
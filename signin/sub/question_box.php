

<link rel='stylesheet' href='<?php echo _css_dir_; ?>comman/question-box-ui.css'>

<div class='question_box_of_user'>
	       <div class='title_of_question' id='show_question' title='click here'><?php echo $s_question_title; ?></div>
           <div class='upper_body_question_box' >
           	      
                  <textarea  placeholder='Write a question' id='question_textarea' class='question_textarea' maxlength='300'></textarea>
            </div>
            <div class='bottom_body_question_box'  >
                  <div class='terms_of_question'>300</div>
                  <input type='button' class='button question_ask_button' value='Ask'>
                  <input type='button' class='button while_question_ask_button' value='Asking'>
                  <div class='ask_anon_box'>
                             
                             <?php 
                                 if($s_allow_anon_ask == 1)
                                 {
                                   echo "
                                   <input type='checkbox' id='question_check' checked >
                                   <label for='question_check'><div class='checkbox--img question_check'></div></label>
                                   Anonymously
                                ";
                                 }
                                 else
                                 {
                                  echo "Anonymously not allowed <input type='checkbox' id='question_check' style='display:none;'> " ;
                                 }
                             ?>  
                                
                  </div>
            </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
     
      $("#show_question").click(function(){
             $(".upper_body_question_box").slideToggle(); 
             $(".bottom_body_question_box").slideToggle();  
      });

      $('.question_textarea').keyup(function(){
                  var display  = $(".terms_of_question");
                  var length   = document.getElementById('question_textarea').value.length;
                  var no       = (300 - length);
                  display.html(no);

            
      });

      
      $('.question_ask_button').click(function(){

             var question_value = $('.question_textarea').val();
             var question_check = document.getElementById('question_check').checked;
             var ask_button     = $('.question_ask_button');
             var while_ask_but  = $(".while_question_ask_button");

              if(question_value == "")
              {
                $(".terms_of_question").html("Please enter a question...");
              }
              else
              {
                $(".terms_of_question").html("Sending Question...");
 
                $('html').css('cursor','wait');
                ask_button.hide();
                while_ask_but.show();
                  /* $('#black').show();
                  $('#loading').show(); */

                  $.post("<?php echo _php_dir_; ?>comman/ask_question.php",{question:question_value,anonymously:question_check,wall_user_id:<?php echo $s_id; ?>},function(ask_question){
                

                     $(".terms_of_question").html(ask_question);
               
                    $('html').css('cursor','default');
                    ask_button.show();
                    while_ask_but.hide();
                   /* $('#black').hide();
                    $('#loading').hide();*/

                     $('.question_textarea').val("");
                     $(".terms_of_question").html("300");
                     $(".upper_body_question_box").slideToggle(); 
                     $(".bottom_body_question_box").slideToggle(); 
              
                  });

              }
            


      });


});
</script>


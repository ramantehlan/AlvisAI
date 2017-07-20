<?php

/*******************************************************

********************************************************/





?>



<link rel='stylesheet' href='<?php echo _ai_css_dir_; ?>emotion-ui.css' >




<textarea class='sample_text_area sample_emotion_text' placeholder='Write Text here...'></textarea>

<input type='button' class='button check_emotions_button' value='Check Emotions' >


<div class='error'></div>
<div class='result_box'>

</div>


<script type="text/javascript">
              
              $('.check_emotions_button').click(function(){
                        
                  var sample_emotion_text = $('.sample_emotion_text').val();
                      
                      if(sample_emotion_text.length == 0)
                      {
                              $(".error").show();
                              $(".error").html("Text Error! Text length can't be 0.");	
                      }
                      else if(sample_emotion_text.length < 10)
                      {
                              $(".error").show();
                              $('.error').html("Text Error! Minimum length of text should be 10.");
                      }
                      else
                      {
                      	 $(".error").hide();
                      	 $(".result_box").show();
                      	 $.post("http://<?php echo $host; ?>/ai_box/ai/ai_emotion/test_emotion_ai.php",{text:sample_emotion_text},function(test_emotion_ai){
                                   
                                     $(".result_box").html(test_emotion_ai);

                      	 });

                      }
 
              });


</script>

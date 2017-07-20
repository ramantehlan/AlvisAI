<h2>Feedback</h2>
<p>
We are trying hard to roll new features to out site but to do so we need your feedback. Let us know that do our services satisfy your need or not and do our services have quality.
Team of <?php echo $company_name; ?> work to give you best product which should be fast , useful and advance, so we invite your suggestions and ideas for our site. If we
find your suggestion or idea good then we will inform you and we will create that for you and million others. 

</p>

   <?php

             if(isset($_SESSION['user_id']))
      {
              
               $allow = $get_mysqli_info -> get_project_info("allow_feedback");
         
          if($allow)
          {
      	?>
          <div class='form_box_ui'>

      	              <div class='top_of_pop'>
                              Feedback
      	              </div>
      	              <div class='body_of_pop body_of_feedback_box'>

                                  <select type='Feedback about' class='input info_input' style='width:100%;' id='feedback_topic'>
                                       <option value=''>Select your feedback topic</option>
                                       <option value='Services'>Services</option>
                                       <option value='Malfunction'>Malfunction</option>
                                       <option value='Team'>Team</option>
                                       <option value='Experience'>Experience</option>
                                       <option value='Our Aim'>Our Aim</option>
                                       <option value='other'>Other</option>
                                  </select>
                                 
                                  <textarea class=' text_area_input' id='feedback_text' placeholder='Write your feedback here...' maxlength='1000'></textarea>
                                  
                                  <div class='error_box'>

                                  </div>

                                  <input type='submit' class='button submit_button' value='Send' >
             
                         </div>
                </div>


                  <script type='text/Javascript'>
                             $('document').ready(function(){
                                        
                                        $('.submit_button').click(function(){
                                                   

                                              var feedback_topic = document.getElementById('feedback_topic').value;
                                              var feedback       = document.getElementById('feedback_text').value;

                                              
                                             
                                              if(feedback_topic.length == 0 && feedback.length == 0 )
                                              {

                                                 $('.error_box').show();
                                                 $('.error_box').html('All Fields are compulsory to fill!');

                                              }
                                              else if(feedback_topic.length == 0)
                                              {

                                                 $('.error_box').show();     
                                                 $('.error_box').html("Feedback topic can't be empty!");

                                              }
                                              else if(feedback.length == 0)
                                              {

                                                 $('.error_box').show();       
                                                 $('.error_box').html("Feedback can't be empty!");

                                              }
                                              else
                                              {          
                                                           $('.error_box').hide(); 
                                                           $('.body_of_feedback_box').html("<div class='result_respond'><img src='<?php echo _loading_image_; ?>' ></div>");
                                                           
                                                           $.post("http://<?php echo $host; ?>/project/assets/php/send_feedback.php",{topic:feedback_topic,feedback:feedback},function(respose){
                                                               $('.result_respond').html(respose);
                                                           });

                                              }
                                          
                                           
                                               return false;
                                        });


                             });
                   </script>

      <?php
        }//end of feedback form if allows
      else
      {
        echo "<div class='error_box' >You have already given your feedback. Once it get viewed, you can give it again!</div>
            <script>
             $('.error_box').show();
            </script>
         ";
      }

      }
      else
      {
      	echo "<div class='error_box' >You must sign in to give feedback. </div>
            <script>
             $('.error_box').show();
            </script>
      	 ";
      }


   ?>







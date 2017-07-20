<h2>Contact Us</h2>
<p>To contact us you need to fill this form and Our Team will contact you shortly. You can contact us to <br>
   <ul>
   	<li>tell some malfunction of the site.</li>
   	<li>give some suggestions.</li>  
	<li>tell if we or any user is violating your copyright or patent.</li>
	<li>tell if we or any user is  Endorsing discrimination based on race, religion, disability, sex, nationality, age, violence, sexually explicit or pornographic material.</li>
	<li>Tell if any service is not working</li>
   </ul>


   <?php

   if(isset($_SESSION['user_id']))
      {


         $allow = $get_mysqli_info -> get_project_info("allow_contactus");
         
          if($allow)
          {

       ?> <div class='form_box_ui'>

      	              <div class='top_of_pop'>
                             Contact Us
      	              </div>
      	              <div class='body_of_pop coutact_us_box'>

                                  <select type='Reason' class='input info_input' style='width:100%;' id='reason_to_contact'>
                                        <option value=''>Select Your Reason.</option>
                                              <option value='Malfunction of the site.'>  Malfunction of the site.  </option>  
   	                                          <option value='Giving some suggestions.'>  Giving some suggestions.  </option>    
	                                          <option value='We or any user is violating your copyright or patent.'>  We or any user is violating your copyright or patent.  </option>  
	                                          <option value='We or any user is  Endorsing discrimination based on race, religion etc.'>  We or any user is  Endorsing discrimination based on race, religion etc.</option>  
	                                          <option value='Any service is not working.'>  Any service is not working.  </option>  
	                                          <option value='other.'>  Other.  </option>  
                                  </select>
                                  <textarea class='text_area_input' id='message' placeholder='Write your message here...' maxlength='1000'></textarea>
              
                                  <div class='error_box'>

                                  </div>

                                  <input type='submit' class='button submit_button' value='Send' >
             
                         </div>
                </div>


                  <script type='text/Javascript'>
                             $('document').ready(function(){
                                        
                                        $('.submit_button').click(function(){
                                                   
                                              var reason = document.getElementById('reason_to_contact').value;
                                              var message    = document.getElementById('message').value;

                                              
                                             
                                              if(reason.length == 0 && message.length == 0)
                                              {

                                                 $('.error_box').show();
                                                 $('.error_box').html('All Fields are compulsory to fill!');

                                              }
                                              else if(reason.length == 0)
                                              {

                                                 $('.error_box').show();     
                                                 $('.error_box').html("Reason can't be empty!");

                                              }
                                              else if(message.length == 0)
                                              {

                                                 $('.error_box').show();       
                                                 $('.error_box').html("Message can't be empty!");

                                              }
                                              else
                                              {          
                                                           $('.error_box').hide(); 
                                                           $('.coutact_us_box').html("<div class='result_respond'><img src='<?php echo _loading_image_; ?>' ></div>");
                                                           
                                                           $.post("http://<?php echo $host; ?>/project/assets/php/contact.php",{reason:reason,message:message},function(respose){
                                                               $('.result_respond').html(respose);
                                                           });

                                              }

                                           
                                               return false;
                                        });


                             });
                   </script>
     

  
  <?php
     }//end of if to allow contact us
      else
      {
        echo "<div class='error_box' >Your previous contact request is still pending!</div>
            <script>
             $('.error_box').show();
            </script>
         ";
      }


      }
      else
      {
      	echo "<div class='error_box' >You must sign in to contact us. </div>
            <script>
             $('.error_box').show();
            </script>
      	 ";
      }


   ?>
  

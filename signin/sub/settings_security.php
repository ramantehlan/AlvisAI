<?php
/*
this is to security 

for password 
and security question
and email
*/
?>



        <div class='option_to_settings' >
         
         <div class='left_title_of_input'>Email: </div><input type='Email' placeholder='Email'  maxlength='50' class='settings_input input' id='email' value='<?php echo $email; ?>' >
        
        </div>






         <div class='option_to_settings light_box' >
            <div class='heading_of_settings'>Security Question</div>
             <select type="question" id="s_question" class="input" name="s_question">
                                 <option select="" value="">Select your security question</option>
                                <option value="What was your bast friend name when you were 10 year old.">What was your bast friend name when you were 10 year old.</option>
                               <option value="Where is your mother's home town.">Where is your mother's home town.</option>
                               <option value="what is your hobby.">what is your hobby.</option>
                               <option value="what game do you play.">what game do you play.</option>
                               <option value="what do you want to do in your life.">what do you want to do in your life.</option>
                               <option value="what is your nick name at home.">what is your nick name at home.</option>
                               <option value="what was your first school name.">what was your first school name.</option>
                               <option value="what was your first toy.">what was your first toy.</option>
                               <option value="what was your first club.">what was your first club.</option>
                               <option value="what is your grandfather name.">what is your grandfather name.</option>
                      </select>
                      <input type="answer" id="s_answer" style='margin-top:10px;' autocomplete='off' class="input " placeholder="Answer" name="s_answer" maxlength='20'>

         </div>





           <div class='option_to_settings' >
            
             <div class='heading_of_settings'>Change Password</div>
            <input type='password' placeholder='New Password' id='password_in_new' maxlength='50' class='input' >
            <input type='password' placeholder='Retype New Password' id='password_in_new_2' maxlength='50' class='input' style='margin-top:10px'>

          </div>




           <div class='option_to_settings light_box' >
            
             <div class='heading_of_settings'>Current Password</div>
             <input type='password' placeholder='Current Password' id='curren_password' maxlength='50' class='input' >


          </div>




                <div class='error settings_saving_platform'></div>

                          <div class='bottom_of_box'>
                                
                              
                              <input type='button' class='button save_button' value='save'>
                        </div>


                         <script type="text/javascript">
                                
                                $(document).ready(function(){
                                             var s_question  = $('#s_question');
                                             var s_answer    = $('#s_answer');

                                             s_question.val('<?php echo $security_question; ?>');
                                             s_answer.val('<?php echo $security_answer; ?>');
                                });
                                  
                                $('.save_button').click(function(){
                                   /*
                                        check list 
                                        1-> Email is to be checked first
                                        2-> sequirty question is to be checked 
                                        3-> password is to be checked 
                                   */
                                     
                                      var email             = $('#email').val();
                                      var security_question = $('#s_question').val();
                                      var security_answer   = $('#s_answer').val();
                                      var new_password      = $("#password_in_new").val();
                                      var new_password_2    = $("#password_in_new_2").val();
                                      var current_password  = $('#curren_password').val();
                                      var display           = $('.settings_saving_platform');

                                      if(email == "" || security_question == "" || security_answer == "")
                                      {
                                            display.show();
                                            display.html("Fill all the fields before saving!");
                                      }
                                      else if(email.indexOf("@") == -1 || email.indexOf(".com") == -1)
                                      {
                                         display.show();
                                         display.html("Enter a proper email!");
                                      }
                                      else if(current_password == "")
                                      {
                                         display.show();
                                         display.html("Current password can not be left empty!");          
                                      }
                                      else if(current_password.length < 6)
                                      {
                                         display.show();
                                         display.html("Current Password should have at least 6 character!");
                                         
                                      }
                                      else if(new_password.length != 0 || new_password_2.length != 0)
                                        {
                                                  if(new_password.length < 6)
                                                  {
                                                     display.show();
                                                     display.html("New Password should have at least 6 character!");
                                                  }
                                                  else if(new_password != new_password_2)
                                                  {
                                                       display.show();
                                                       display.html("New password don't match retyped new password!");
                                                  }
                                                  else
                                                  {
                                                    save_settings();
                                                  }
                                        }
                                      else
                                        {
                                          save_settings(); 
                                        }
                                     


                                });

                              function save_settings()
                              {
                                                                       
                                      var email             = $('#email').val();
                                      var security_question = $('#s_question').val();
                                      var security_answer   = $('#s_answer').val();
                                      var new_password      = $("#password_in_new").val();
                                      var new_password_2    = $("#password_in_new_2").val();
                                      var current_password  = $('#curren_password').val();
                                      var display           = $('.settings_saving_platform');
                                          
                                      $('html').css('cursor','wait');
                                      $('.save_button').css('cursor','wait');
                                      display.show();
                                      display.html('Saving...');
                                       
                                      $.post('<?php echo _php_dir_; ?>settings/save_security_settings.php',{email:email,s_question:security_question,s_answer:security_answer,new_pass:new_password,new_pass_2:new_password_2,current_password:current_password,current_email:'<?php echo $email; ?>'},function(save_security_settings){
                                               
                                            display.html(save_security_settings);
                                            $('html').css('cursor','default');
                                            $('.save_button').css('cursor','default');
                                            $('#curren_password').val("");
                                            $("#password_in_new_2").val("");
                                            $("#password_in_new").val("");


                                      });

                              }


                       </script>
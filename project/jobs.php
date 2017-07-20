<h2>Jobs</h2>
<p>
	      If you want to help us in making this world a better place then join us and be a part of our team. Being a part of Alvisai journey is an amazing experience, here you 
        can create astonishing applications, make mistakes, take risks, explore things and much more. Join only if you are really passionate about making a change. Apply by filling 
        under given form.
</p>

<?php 
      
      if(isset($_SESSION['user_id']))
      {
          
          $allow = $get_mysqli_info -> get_project_info("allow_apply_for_jobs");
          
          if($allow)
          {
             
             ?>
               <div class='form_box_ui'>

      	              <div class='top_of_pop'>
                              Apply
      	              </div>
      	              <div class='body_of_pop body_of_apply_form'>
                              
                              <form method='post' action='#'>

                                  <select type='qualification' class='input info_input' id='qualification'>
                                        <option value=''>Select Your Qualification</option>
                                        <option value='Computer science and MBA'>Computer science and MBA</option>
                                        <option value='M-TECH and MBA'>M-TECH and MBA</option>
                                        <option value='MBA'>MBA</option>
                                        <option value='Computer science'>Computer science</option>
                                        <option value='M-TECH'>M-TECH</option>
                                        <option value='Phd in computer science'>Phd in computer science</option>
                                        <option value='Qualification Not Listed'>Qualification Not Listed</option>
                                        <option value='I have knowledge but not qualification'>I have knowledge but not qualification</option>


                                  </select>
                                 
                                  <select type='Experience' class='input info_input' id='experience' style='margin-left:4%;'>
                                          <option value=''>Select You Experience</option>
                                          <option value='1-3'>1-3 Years</option>
                                          <option value='4-6'>4-6 Years</option>
                                          <option value='7-9'>7-9 Years</option>
                                          <option value='10-12'>10-12 Years</option>
                                          <option value='12 above'>12 above</option>
                                          <option value='void'>No Experience</option>
                                  </select>
                                 
                                  <textarea class='text_area_input' id='ideals' placeholder='About Your Ideals...' maxlength='1000'></textarea>

                                  <div class='error_box'>

                                  </div>
              
                                  <input type='submit' class='button submit_button' value='Apply' >

                              </form>
             
                         </div>
                </div>
                   
                   <script type='text/Javascript'>
                             $('document').ready(function(){
                                        
                                        $('.submit_button').click(function(){
                                                   
                                              var qualification = document.getElementById('qualification').value;
                                              var experience    = document.getElementById('experience').value;
                                              var ideals        = document.getElementById('ideals').value;

                                              
                                             
                                              if(qualification.length == 0 && experience.length == 0 && ideals.length == 0)
                                              {

                                                 $('.error_box').show();
                                                 $('.error_box').html('All Fields are compulsory to fill!');

                                              }
                                              else if(qualification.length == 0)
                                              {

                                                 $('.error_box').show();     
                                                 $('.error_box').html("Qualifications can't be empty!");

                                              }
                                              else if(experience.length == 0)
                                              {

                                                 $('.error_box').show();       
                                                 $('.error_box').html("Experience can't be empty!");

                                              }
                                              else if(ideals.length == 0)
                                              {

                                                 $('.error_box').show();      
                                                 $('.error_box').html("Ideals can't be empty!");

                                              }
                                              else
                                              {          
                                                           $('.error_box').hide(); 
                                                           $('.body_of_apply_form').html("<div class='result_respond'><img src='<?php echo _loading_image_; ?>' ></div>");
                                                           
                                                           $.post("http://<?php echo $host; ?>/project/assets/php/apply_for_job.php",{qualification:qualification,experience:experience,ideals:ideals},function(respose){
                                                               $('.result_respond').html(respose);
                                                           });

                                              }

                                           
                                               return false;
                                        });


                             });
                   </script>
                 


        <?php
      }//end of if which allow to apply 
      else
      {
        echo "<div class='error_box' >You have already applied for a job!</div>
            <script>
             $('.error_box').show();
            </script>
         ";
      }


      }
      else
      {
      	echo "<div class='error_box' >You must sign in to apply for a job. </div>
            <script>
             $('.error_box').show();
            </script>
      	 ";
      }

?>


  <?php 
  /*        
	

<!--
<ul class='ul_of_jobs'>



<li>
<h3>Chief Service Officer (CSO)</h3>
<p>
<b>Qualifications</b>:- (Computer science engineer or M-TECH) and MBA<br>
<b>Experience</b>:- 4/5 Years<br>
<b>Description</b>:- Chief Service Officer (CSO) is the administrator of Design and Developer team, who should have a deep knowledge of PHP, C++, CSS, Mysql, HTML, Jquery, Javascript, Photoshop, Flash and
 JAVA, he should also know how to lead and administrate a team.
 <br>
<b>Salary</b>:- To be decided <br>
<b>Apply</b>:- <a href='#'>Apply</a>

</p>
</li>


<li>
<h3>Senior Developer</h3>
<p>
<b>Qualifications</b>:- Computer science engineer or M-TECH<br>
<b>Experience</b>:- 3/4 Years<br>
<b>Description</b>:-  Junior Designer is some one who work on each and every part of the site and mold it in the best shape and design. He should have a knowledge of CSS, Javascript, Jquery, 
Flash, HTML, Photoshop and should know about php.
 <br>
<b>Salary</b>:- To be decided <br>
<b>Apply</b>:- <a href='#'>Apply</a>

</p>
</li>


<li>
<h3>Senior Designer</h3>
<p>
<b>Qualifications</b>:- Computer science engineer<br>
<b>Experience</b>:- 3/4 Years<br>
<b>Description</b>:-   Junior Designer is some one who work on each and every part of the site and mold it in the best shape and design. He should have a knowledge of CSS, Javascript, Jquery, 
Flash, HTML, Photoshop and should know about php.
 <br>
<b>Salary</b>:- To be decided <br>
<b>Apply</b>:- <a href='#'>Apply</a>

</p>
</li>

<li>
<h3>Junior Developers</h3>
<p>
<b>Qualifications</b>:- (Computer science engineer or M-TECH)<br>
<b>Experience</b>:- 1/2 Years<br>
<b>Description</b>:-  Junior Designer is some one who work on each and every part of the site and mold it in the best shape and design. He should have a knowledge of CSS, Javascript, Jquery, 
Flash, HTML, Photoshop and should know about php.
 <br>
<b>Salary</b>:- To be decided <br>
<b>Apply</b>:- <a href='#'>Apply</a>

</p>
</li>


<li>
<h3>Junior Designers</h3>
<p>
<b>Qualifications</b>:- Computer science engineer<br>
<b>Experience</b>:- 1/2 Years<br>
<b>Description</b>:- Junior Designer is some one who work on each and every part of the site and mold it in the best shape and design. He should have a knowledge of CSS, Javascript, Jquery, 
Flash, HTML, Photoshop and should know about php.

 <br>
<b>Salary</b>:- To be decided <br>
<b>Apply</b>:- <a href='#'>Apply</a>

</p>
</li>

</ul>


-->
*/

?>
<?php

/*
this is for the display of user

-bg color 
-bg img
*/

?>

          <?php 
            
            if(allow_background_colour)
            {
               echo " <div class='option_to_settings' style='width:400px;'>
            <div class='heading_of_settings'>Choose Background Color</div> 
                       <div class='box_div light_box' >
                                     <div class='croshorse'><canvas id='canvas_picker_2' width='160px'></canvas></div>
                                     <div id='display_of_color_2' style='background-color:#$bg_color'></div>
                                     <input type='text' class='input_hex input_hex_2 hex_v' id='hex_2' value='$bg_color' maxlength='6'>  
                                     <span id='save_color_here_2'></span>
                                     <input type='button' class=' button_of_display' style='width:80px;margin-left:10px;margin-top:10px;height:25px;' id='save_color_2' value='Save'> 
                     </div>

            </div>";
            }


             if(allow_background_image)
             {

              $display_option_bgi = <<< EOFILE
 

                    <div class='option_to_settings' style='width:400px;'>
                        
                           <div class='heading_of_settings'>Choose Background Image</div> 
                           
                           <div class='light_box' style='height:150px;'>

                                     <img src="http://$host/signin/assets/images/settings/bg/0.jpg" class='small_images_thumb' id='display_img_0'>
                                                             
                                                                      <script type='text/javascript'>
                                                                                   $('#display_img_0').click(function(){
                                                                                         
                                                                                         $('html').css('background-image',"url('')");
                                                                                         $('html').css('background-size',"");
                                                                                          var display = $("#default_image_saver");

                                                                                          $.post("http://$host/signin/assets/php/settings/save_default_image.php",{image_name:''},function(save_default_image){
                                                                                                display.html(save_default_image);
                                                                                          });                                                                                         
                                                                                        

                                                                                   });
                                                                      </script>

EOFILE;
echo $display_option_bgi;
               

                                     for($nof=1;$nof<=9;$nof++)
                                                         {
                                                                  $display_now = <<< EOFILE
                                                                  <img src="http://$host/signin/assets/images/settings/bg/$nof.jpg" class='small_images_thumb' id='display_img_$nof'>
                                                             
                                                                      <script type='text/javascript'>
                                                                                   $('#display_img_$nof').click(function(){
                                                                                         
                                                                                         $('html').css('background-image',"url('http://$host/signin/user files/background pictures/$nof.jpg')");
                                                                                          $('html').css('background-size',"100%");
                                                                                          var display = $("#default_image_saver");

                                                                                          $.post("http://$host/signin/assets/php/settings/save_default_image.php",{image_name:'$nof'},function(save_default_image){
                                                                                                display.html(save_default_image);
                                                                                          });

                                                                                   });
                                                                      </script>

                                                                      
EOFILE;
                                                               echo $display_now;
                                                          
                                                         }



                echo "            </div>
                           <span id='default_image_saver'></div>
            ";
    
             }
             else
             {
                 $php_dir = _php_dir_;
 
                  $display_option_bgi = "<img src='" . _image_dir_ . "settings/bg/0.jpg' class='small_images_thumb' id='display_img_0'>";

                 $display_option_bgi .= <<< EOFILE
                                                             
                                                                      <script type='text/javascript'>
                                                                                   $('#display_img_0').click(function(){
                                                                                         
                                                                                         $('html').css('background-image',"url('')");
                                                                                         $('html').css('background-size',"");
                                                                                          var display = $("#default_image_saver");

                                                                                          $.post("$php_dir" + "settings/save_default_image.php",{image_name:''},function(save_default_image){
                                                                                                display.html(save_default_image);
                                                                                          });                                                                                         
                                                                                        

                                                                                   });
                                                                      </script>

EOFILE;
echo $display_option_bgi;
             }



            if(allow_background_image_upload)
            {
              echo "            <div class='option_to_settings' style='width:400px;'>
                        
                           <div class='heading_of_settings'>Upload Background Image</div> 
                           <input type='file' class='input upload_of_design' id='upload_of_design' name='bg_img'>


             </div>";
            }

          ?>
    
          

           
                                    
                               







                               </div>
                                     <div class='error settings_saving_platform' id='bg_img_error'></div>

                        <div class='bottom_of_box'>                      
                              <input type='button' class='button save_button' id='upload_save_bg_img' value='save'>
                        </div>

<div class='background_uploading_box pop' ><br>
       <progress id='background_progressBar' value='0' max='100' style='width:300px;'></progress><Br>
       <b>Status</b>: <span id='background_upload_status'>Loading...</span>
</div>
            
            <script type="text/javascript">
               
               $("#upload_save_bg_img").click(function(){
                         
                         var file   = _("upload_of_design").files[0];
                         var display = $(".settings_saving_platform"); 

                        if($("#upload_of_design").val() != "")
                        {
                             if(file.type == 'image/jpeg' || file.type == 'image/png' || file.type == 'image/jpg' ||  file.type == 'image/gif' || file.type == 'image/jpe')
                                  {
               
                                   if( (file.size/1024) > 2048)
                                         {
                                           display.show();
                                           display.html("Image size should be less then 2MB.");
                                         }

                                      else
                                      {

                                       display.hide();
                                       $("#black").show();
                                       $('.background_uploading_box').show();

                                       var formdata = new FormData();
                                       formdata.append("image_file",file);

                                       var ajax = new XMLHttpRequest();
                                       ajax.upload.addEventListener("progress", progressHandler_bg_img,false);
                                       ajax.addEventListener("load", completeHandler_bg_img , false);
                                       ajax.addEventListener("error",errorHandler_bg_img,false);
                                       ajax.addEventListener("abort",abortHandler_bg_img,false);
                                       ajax.open("POST","..<?php echo _simple_php_dir_ ?>settings/upload_bg_image.php");
                                       ajax.send(formdata);


                                       $('html').css('cursor','wait');
                                       $(this).css('cursor','wait');
                   
                                      }
              
                                   }
                    
                        }// end of first if
                        else
                        {
                          display.show();
                          display.html("Choose a image before uploading!");
                        }


               });

            </script>      

             <script>

       function _(el){
        return document.getElementById(el);
       }

        function progressHandler_bg_img(event){
                 var percent = (event.loaded / event.total) * 100 ;
                 _("background_progressBar").value = Math.round(percent);
                 _("background_upload_status").innerHTML = Math.round(percent) +"% uploaded... please wait";

       }
      function completeHandler_bg_img(event){
                 _("background_upload_status").innerHTML = event.target.responseText;
                 _("background_progressBar").value =  100;


                  _("upload_of_design").value = "";
                   $('.pop').hide();
                   $('#black').hide();
                   $('html').css('cursor','default');
                   $('#upload_save_bg_img').css('cursor','default');
                   window.location.reload(!0);

                  // $('html').css('background-image',"url('http://<?php echo $host ?>/signin/user files/background pictures/" + event.target.responseText + "')");
                   //$('html').css('background-size',"100%");
                   //alert(event.target.responseText);
                 
       }
       function errorHandler_bg_img(event){
                   $("#bg_img_error").show();
                   $('.background_uploading_box').hide();
                   $('#black').hide();
                 _("bg_img_error").innerHTML = "Upload Failed";

       }

        function abortHandler_bg_img(event){
                   $("#bg_img_error").show();
                   $('.background_uploading_box').hide();
                   $('#black').hide();
                 _("bg_img_error").innerHTML = "Upload Aborted";

       }
    </script>      






<script type="text/javascript">

var canvas = document.getElementById('canvas_picker_2').getContext('2d');
     
  // create an image object and get it’s source
  var img = new Image();
  img.src = '<?php echo _image_dir_; ?>settings/bg.JPG';
  img.width="50px";

  // copy the image to the canvas
  $(img).load(function(){
    canvas.drawImage(img,0,0);

  });

  // http://www.javascripter.net/faq/rgbtohex.htm
  function rgbToHex(R,G,B) {return toHex(R)+toHex(G)+toHex(B)}
  function toHex(n) {
    n = parseInt(n,10);
    if (isNaN(n)) return "00";
    n = Math.max(0,Math.min(n,255));
    return "0123456789ABCDEF".charAt((n-n%16)/16)  + "0123456789ABCDEF".charAt(n%16);
  }


  $('#canvas_picker_2').click(function(event){
    // getting user coordinates
    
  
    var x = event.pageX - (this.offsetLeft);
    var y = event.pageY - (this.offsetTop);
       

    // getting image data and RGB values
    var img_data = canvas.getImageData(x, y, 1, 1).data;

    var R = img_data[0];
    var G = img_data[1];
    var B = img_data[2];  var rgb = R + ',' + G + ',' + B;
    
    // convert RGB to HEX
    var hex = rgbToHex(R,G,B);
    $('#hex_2').val(hex);
    $("#display_of_color_2").css("background-color",'#' + hex);

    

  });

     $("#save_color_2").click(function(){
       var hex = $('#hex_2').val();
        $('html').css("background-color",'#' + hex);
        $("#display_of_color_2").css("background-color",'#' + hex);
        var display  = $("#save_color_here_2")

         $.post("<?php echo _php_dir_; ?>settings/save_bg_color.php",{hex:hex},function(save_color){
              display.html(save_color);
         });

     });

</script>
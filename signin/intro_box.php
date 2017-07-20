
<style>
   
    .intro_box{position:fixed;
               top:50%;
               left:50%;
               width:700px;
               height:400px;
               margin-left:-350px;
               margin-top:-200px;
               z-index:101;
               display:none;
    }
    


    .body_of_intro{text-align:center;
                   padding-top:10px;
                   overflow:hidden;
                   overflow-y:auto;
    }
   
    .head_of_intro_body{font-size:19px;
                         font-weight:bold;
                         
    }

    .body_of_intro_body{margin-top:5px;}

    .sub_head_of_intro{
                      text-align:left;
                      margin-top:20px;
                      color:rgb(140,160,200);
    }

    .sub_head_of_intro_box{
                      text-align:left;
                      margin-top:20px;
                      color:rgb(140,160,200);
                      width:200px;
                      min-height:50px;
                      float:left;
                      border:1px solid rgb(240,240,240);
                      border-radius:5px;
                      margin-left:10px;
                      padding:5px;
    }

    .sub_head_of_intro_box b{font-weight:15px;
                          color:black;
                          margin-right:8px;
    }

    .sub_head_of_intro_box img{width:16px;

                               }

</style>
<?php

                      /**************************************************
                         this is to show into box
                      **************************************************/
                            
                              $no_of_login          =  $get_mysqli_info -> get_info($id,0,'count_login');

                            if( $no_of_login < 2 && isset($_COOKIE["Alvis_intro_done_" . $id]) != 1 )
                            { 
                    
                                    setcookie("Alvis_intro_done_" . $id,"true", time() + 604800 );
                                                                  
                                    $allow_intro = true;
                                                           
 
                            }
                            else
                            {     
                            	 
                            	  $allow_intro = false;
                            }


?>



<div class='intro_box box_of_pop pop'>
  <div class='top_of_pop'>
      
     Welcome to Alvisai.

      <div class='close_of_intro close_of_pop'>
            
      </div>
  </div>
  <div class='body_of_pop body_of_intro '>
         
        <div class='head_of_intro_body' style='color:rgb(70,90,150);'> 
        	Welcome  <?php echo $name; ?>!
        </div>
        <div class='body_of_intro_body'>
          
               <div class='sub_p_of_intro' style='color:rgb(100,140,190); font-size:14px;'>
                   My name is Alvis. your AI(Artificial Intelligence) Friend. Following stuff will help you to use Alvisai!
               </div>


               <div class='sub_head_of_intro_box' >
                       <b> Calling Alvis:</b> Click on <img src='http://<?php echo $host; ?>/assets/images/comman/logos/logo.png'> in top bar grid to call me any where.
               </div>

                <div class='sub_head_of_intro_box' >
                       <b> Update:</b> Click on <img src='http://<?php echo $host; ?>/signin/assets/images/top/grid/update.png'> in top bar to update anonymously(optional).
               </div>

              <div class='sub_head_of_intro_box' >
                       <b> Settings:</b> Click on <img src='http://<?php echo $host; ?>/signin/assets/images/top/grid.png'> in top bar and then on <img src='http://<?php echo $host; ?>/signin/assets/images/top/grid/settings.png'> to go to settings.
               </div>

                <div class='sub_head_of_intro_box' >
                       <b> Display:</b> Settings have option to allow you to upload your background image.
               </div>

               <div class='sub_head_of_intro_box' >
                       <b> Board:</b> Place where you get updates from your friends and people around the world!
               </div>

               <div class='sub_head_of_intro_box' >
                       <b> Wall:</b> Place where you can see your updates and friends. Only you can see your anonymous updates!
               </div>





               <div class='sub_head_of_intro_box' >
                       <b> Logout:</b> Click on <img src='http://<?php echo $host; ?>/signin/assets/images/top/grid/logout.png'> in top bar grid.
               </div>



               <div class='sub_head_of_intro_box' >
                       <b> Information:</b> Click on <img src='http://<?php echo $host; ?>/signin/assets/images/top/grid/information.png'> in top bar grid to check all this again.
               </div>
            





        </div>

  </div>
</div>

<script type='text/javascript'>
    $(document).ready(function(){
          
           
           $('.close_of_intro').click(function(){
                $('#black').hide();
                $('.intro_box').hide();
           });
            

            //this pop up when intro is click on grid
           $('#information_grid').click(function(){
                
                $('.intro_box').show();
                $('#black').show();
               
           });

    });

</script>

<?php
     
     if($allow_intro)
     {
     	                                        echo "
                                                                          <script type='text/javascript'>

                                                                            $(document).ready(function(){

                                                                                         $('.intro_box').show();
                                                                                         $('#black').show();

                                                                                     });
                                                                          </script>
                                                                    ";
     }

?>





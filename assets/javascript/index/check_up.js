$(document).ready(function(){
	
 /* $("#u_name").keyup(function(){
                username = document.getElementById("u_name");
                var regex=/[^a-z0-9A-Z_]/gi;
                username.value=username.value.replace(regex ,""); 
      });

  */


   $("#signup").click(function(){
                                      //these are input by user during sign up
      var f_name        =$('#f_name').val();
      var l_name        =$('#l_name').val();
      //var u_name        =$('#u_name').val();
      var password      =$('#password').val();
      var email         =$('#email').val();
      //var date          =$("#date_up").val();
      //var month         =$("#month_up").val();
      //var year          =$("#year_up").val();
      //var gender        =$("#gender_up").val();
      //var country       =$("#country_up").val();

     

      var display=$('#signup_error');
                                     // now we are going to check value , username , password , email
        if(f_name == "" || l_name == "" || /* u_name == "" || */ password == "" || email == "" /*|| date == "" || month == "" || year == "" || gender == "" || country =="" */)
           {
           	display.show();
           	display.html("Please fill all fields.");
            return false;
           }
         /*else if(u_name.length < 3)
         {
         	  display.show();
           	display.html("Username should have at least 3 character.");
            return false;
         }*/
         else if(password.length < 6)
         {
         	display.show();
           	display.html("Password should have at least 6 character.");
            return false;
         }
         else if(email.indexOf("@") == -1 || email.indexOf(".com") == -1)
         {
         	display.show();
           	display.html("Enter a proper email.");
            return false;
         }
         
         else if(f_name == l_name)
         {
            display.show();
            display.html("First name should not match Last name.");
            return false;
         }

         


         else
         {
         	display.html("Thank you!");
          display.hide();
         }

      

   });

});
<?php
/***************************************
 * http://www.program-o.com
 * PROGRAM O
 * Version: 2.6.5
 * FILE: index.php
 * AUTHOR: Elizabeth Perreau and Dave Morton
 * DATE: FEB 01 2016
 * DETAILS: This is the interface for the Program O JSON API
 ***************************************/

$cookie_name = 'Program_O_JSON_GUI';
$botId = filter_input(INPUT_GET, 'bot_id');
// Replaced (isset($_COOKIE[$cookie_name])) ? $_COOKIE[$cookie_name] : jq_get_convo_id() with user id
$convo_id = $_SESSION['user_id'];
// Replaced (isset($_COOKIE['bot_id'])) ? $_COOKIE['bot_id'] : ($botId !== false && $botId !== null) ? $botId : 1 with 1
$bot_id = 1;

if (is_nan($bot_id) || empty($bot_id))
{
    $bot_id = 1;
}

//setcookie('bot_id', $bot_id);

// Experimental code
$base_URL = 'http://' . $_SERVER['HTTP_HOST'];                                   // set domain name for the script
$this_path = str_replace(DIRECTORY_SEPARATOR, '/', realpath(dirname(__FILE__)));  // The current location of this file, normalized to use forward slashes
$this_path = str_replace($_SERVER['DOCUMENT_ROOT'], $base_URL, $this_path);       // transform it from a file path to a URL
$url = str_replace('gui/jquery', 'chatbot/conversation_start.php', $this_path);   // and set it to the correct script location

/*
  Example URL's for use with the chatbot API
  $url = 'http://api.program-o.com/v2.3.1/chatbot/';
  $url = 'http://localhost/Program-O/Program-O/chatbot/conversation_start.php';
  $url = 'chat.php';
*/



/**
 * Function jq_get_convo_id
 *
 *
 * @return string
 */
function jq_get_convo_id()
{
    global $cookie_name;

    session_name($cookie_name);
    //session_start();
    $convo_id = session_id();
    session_destroy();
    //setcookie($cookie_name, $convo_id);

    return $convo_id;
}

?>

    <script type="text/javascript">
    var URL = '<?php echo $url ?>';
    </script>


<div class='left_side_of_box_ai'>
           
          <div class='user_profile_pic_ai_box' title='you'>
                <img src='http://<?php echo $host; ?>/signin/user files/profile pictures/medium/<?php echo $profile_pic; ?>'>
          </div> 
          
          <div class='anser_space_ai'>
                <div class="usersay answer_space_bubble" >&nbsp;</div>
          </div>

      </div>


      <div class='right_side_of_box_ai'>
           
           
                 <b>Alvis:</b> <span class="botsay">hi!</span>
          

      </div>
           
          <form method="post" name="talkform" id="talkform" action="index.php"> 

          <input type="text" name="say" id="say" class='user_input_ai' size="60" placeholder='write your relpy here...' autocomplete='off'/>
          <input type="submit" name="submit" id="submit" class="submit"  value="say" style='display:none;' />
          <input type="hidden" name="convo_id" id="convo_id" value="<?php echo $convo_id;?>" />
          <input type="hidden" name="bot_id" id="bot_id" value="<?php echo $bot_id;?>" />
          <input type="hidden" name="format" id="format" value="json" />
        
          </form>
   
    <div id="urlwarning" class='warning_box'></div>

<!--<script type="text/javascript" src="jquery-1.9.1.min.js"></script>-->
<script type="text/javascript">
    $(document).ready(function () {
        // put all your jQuery goodness in here.
        $('#talkform').submit(function (e) {
            $('.botsay').html("Thinking...");
            e.preventDefault();
            var user = $('#say').val();
            $('.usersay').text(user);
            var formdata = $("#talkform").serialize();
            $('#say').val('');
            $('#say').focus();
            $.get(URL, formdata, function (data) {
                var b = data.botsay;
                if (b.indexOf('[img]') >= 0) {
                    b = showImg(b);
                }
                if (b.indexOf('[link') >= 0) {
                    b = makeLink(b);
                }
                var usersay = data.usersay;
                if (user != usersay) {
                    $('.usersay').text(usersay);
                }
                $('.botsay').html(b);
                $('#urlwarning').hide();
            }, 'json').fail(function (xhr, textStatus, errorThrown) {
                console.error('XHR =', xhr.responseText);
                $('#urlwarning').html("Something went wrong! Error = " + errorThrown).show();
            });
            return false;
        });
    });
    function showImg(input) {
        var regEx = /\[img\](.*?)\[\/img\]/;
        var repl = '<br><a href="$1" target="_blank"><img src="$1" alt="$1" width="150" /></a>';
        var out = input.replace(regEx, repl);
        console.log('out = ' + out);
        return out
    }
    function makeLink(input) {
        var regEx = /\[link=(.*?)\](.*?)\[\/link\]/;
        var repl = '<a href="$1" target="_blank">$2</a>';
        var out = input.replace(regEx, repl);
        console.log('out = ' + out);
        return out;
    }
</script>
</body>
</html>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">
@-webkit-keyframes cursor-blink {
  0% {
    opacity: 0;
  }
  50% {
    opacity: 1;
  }
  100% {
    opacity: 0;
  }
}
@-moz-keyframes cursor-blink {
  0% {
    opacity: 0;
  }
  50% {
    opacity: 1;
  }
  100% {
    opacity: 0;
  }
}
@keyframes cursor-blink {
  0% {
    opacity: 0;
  }
  50% {
    opacity: 1;
  }
  100% {
    opacity: 0;
  }
}
body {
  background-color: black;
}

.four-oh-four {
  position: relative;
  top: 0;
  left: 0;
  min-height: 100vh;
  min-width: 100vw;
  z-index: 2;
  background-color: black;
  transition: opacity 300ms ease-out;
  background-position: center center;
  background-repeat: no-repeat;
}
.four-oh-four .dJAX_internal {
  opacity: 0.0;
}
.four-oh-four form, .four-oh-four input {
  position: fixed;
  top: 0;
  left: 0;
  opacity: 0;
  background-color: black;
}

.terminal {
  position: relative;
  padding-top: 10px;
  padding-left: 58px;
  padding-bottom: 21px;
  padding-right: 48px;
  background-color: #000;  
}
.terminal .prompt {
  color: #1ff042;
  display: block;
  font-family: 'AndaleMono', monospace;
  font-weight: bold;
  text-transform: uppercase;
  font-size: 0.9em;
  letter-spacing: 0.15em;
  white-space: pre-wrap;
  text-shadow: 0 0 2px rgba(31, 240, 66, 0.75);
  line-height: 1;
  margin-bottom: 0.75em;
}
.terminal .prompt:before {
  content: '> ';
  display: inline-block;
}
.terminal .new-output {
  display: inline-block;
}
.terminal .new-output:after {
  display: inline-block;
  vertical-align: -0.15em;
  width: 0.75em;
  height: 1em;
  margin-left: 5px;
  background: #1ff042;
  box-shadow: 1px 1px 1px rgba(31, 240, 66, 0.65), -1px -1px 1px rgba(31, 240, 66, 0.65), 1px -1px 1px rgba(31, 240, 66, 0.65), -1px 1px 1px rgba(31, 240, 66, 0.65);
  -webkit-animation: cursor-blink 1.25s steps(1) infinite;
  -moz-animation: cursor-blink 1.25s steps(1) infinite;
  animation: cursor-blink 1.25s steps(1) infinite;
  content: '';
}

.kittens p {
  letter-spacing: 0;
  opacity: 0;
  line-height: 1rem;
}

.kitten-gif {
  margin: 20px;
  max-width: 300px;
}

.four-oh-four-form {
  opacity: 0;
  position: fixed;
  top: 0;
  left: 0;
}	
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function()
{
	var inputReady = true;
	var input = $('.404-input');
	input.focus();
	$('.container').on('click', function(e)
	{  
		input.focus();
	});

	input.on('keyup', function(e){  
		$('.new-output').text(input.val());  
		if (e.which == 13) 
		{
			if (input.val() == 'back' || input.val() == 'home') 
			{
				alert("goto home");
			}
			else if(input.val() == "refresh" || input.val() == "r" || input.val() == "R")
			{
				location.reload();				
			}
      else
      {
        
      }      
		}
	});
		// console.log(inputReady);});$('.four-oh-four-form').on('submit', function(e){  e.preventDefault();  var val = $(this).children($('.404-input')).val().toLowerCase();  var href;     if (val === 'kittens'){    showKittens();  }else {    resetForm();  }});function resetForm(withKittens){  var message = "Sorry that command is not recognized."  var input = $('.404-input');  if (withKittens){    $('.kittens').removeClass('kittens');    message = "Huzzzzzah Kittehs!"  }  $('.new-output').removeClass('new-output');  input.val('');  $('.terminal').append('<p class="prompt">' + message + '</p><p class="prompt output new-output"></p>');  $('.new-output').velocity(    'scroll'  ), {duration: 100}}    function showKittens(){        $('.terminal').append("<div class='kittens'>"+                                 "<p class='prompt'>                                 ,----,         ,----,                                          ,---,</p>" +                                 "<p class='prompt'>       ,--.                ,/   .`|       ,/   .`|                     ,--.              ,`--.' |</p>" +                                 "<p class='prompt'>   ,--/  /|    ,---,     ,`   .'  :     ,`   .'  :     ,---,.        ,--.'|   .--.--.    |   :  :</p>" +                                 "<p class='prompt'>,---,': / ' ,`--.' |   ;    ;     /   ;    ;     /   ,'  .' |    ,--,:  : |  /  /    '.  '   '  ;</p>" +                                 "<p class='prompt'>:   : '/ /  |   :  : .'___,/    ,'  .'___,/    ,'  ,---.'   | ,`--.'`|  ' : |  :  /`. /  |   |  |</p>" +                                 "<p class='prompt'>|   '   ,   :   |  ' |    :     |   |    :     |   |   |   .' |   :  :  | | ;  |  |--`   '   :  ;</p>" +                                 "<p class='prompt'>'   |  /    |   :  | ;    |.';  ;   ;    |.';  ;   :   :  |-, :   |   \\ | : |  :  ;_     |   |  '</p>" +                                 "<p class='prompt'>|   ;  ;    '   '  ; `----'  |  |   `----'  |  |   :   |  ;/| |   : '  '; |  \\  \\    `.  '   :  |</p>" +                                 "<p class='prompt'>:   '   \\   |   |  |     '   :  ;       '   :  ;   |   :   .' '   ' ;.    ;   `----.   \\ ;   |  ;</p>" +                                 "<p class='prompt'>'   : |.  \\ |   |  '     '   :  |       '   :  |   '   :  ;/| '   : |  ; .'  /  /`--'  /  `--..`;  </p>" +                                 "<p class='prompt'>|   | '_\\.' '   :  |     ;   |.'        ;   |.'    |   |    \\ |   | '`--'   '--'.     /  .--,_   </p>" +                                 "<p class='prompt'>'   : |     ;   |.'      '---'          '---'      |   :   .' '   : |         `--'---'   |    |`.  </p>" +                                 "<p class='prompt'>;   |,'     '---'                                  |   | ,'   ;   |.'                    `-- -`, ; </p>" +                                 "<p class='prompt'>'---'                                              `----'     '---'                        '---`'</p>" +                                 "<p class='prompt'>                                                              </p></div>");                var lines = $('.kittens p');        $.each(lines, function(index, line){            setTimeout(function(){                $(line).css({                    "opacity": 1                });                textEffect($(line))            }, index * 100);        });        $('.new-output').velocity(            'scroll'        ), {duration: 100}        setTimeout(function(){            var gif;            $.get('http://api.giphy.com/v1/gifs/random?api_key=dc6zaTOxFJmzC&tag=kittens', function(result){                gif = result.data.image_url;                $('.terminal').append('<img class="kitten-gif" src="' + gif + '"">');                resetForm(true);            });        }, (lines.length * 100) + 1000);    }    function textEffect(line){        var alpha = [';', '.', ',', ':', ';', '~', '`'];        var animationSpeed = 10;        var index = 0;        var string = line.text();        var splitString = string.split("");        var copyString = splitString.slice(0);        var emptyString = copyString.map(function(el){            return [alpha[Math.floor(Math.random() * (alpha.length))], index++];        })        emptyString = shuffle(emptyString);        $.each(copyString, function(i, el){            var newChar = emptyString[i];            toUnderscore(copyString, line, newChar);            setTimeout(function(){              fromUnderscore(copyString, splitString, newChar, line);            },i * animationSpeed);          })    }    function toUnderscore(copyString, line, newChar){        copyString[newChar[1]] = newChar[0];        line.text(copyString.join(''));    }    function fromUnderscore(copyString, splitString, newChar, line){        copyString[newChar[1]] = splitString[newChar[1]];        line.text(copyString.join(""));    }    function shuffle(o){        for(var j, x, i = o.length; i; j = Math.floor(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);        return o;    };
});
</script>
<div class="container">  
	<form class="four-oh-four-form">    
		<input type="text" class="404-input">  
	</form>  
	<div class="terminal">      
		<p class="prompt">-------------------------------------------------------------------------------</p>      		
		<p class="prompt">A PHP Error was encountered</p>      	
		<p class="prompt">Severity: <?php echo $severity; ?></p>
		<p class="prompt">Message:  <?php echo $message; ?></p>		      			
		<p class="prompt">Filename: <?php echo $filepath; ?></p>		      			
		<p class="prompt">Line Number: <?php echo $line; ?></p>
		<p class="prompt">
		<?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>

			<p class="prompt">Backtrace:</p>
			<?php foreach (debug_backtrace() as $error): ?>

				<?php if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>

					<p class="prompt" style="margin-left:10px">
					File: <?php echo $error['file'] ?><br />
					Line: <?php echo $error['line'] ?><br />
					Function: <?php echo $error['function'] ?>
					</p>

				<?php endif ?>

			<?php endforeach ?>

		<?php endif ?>			
		</p>						      						
		<p class="prompt">-------------------------------------------------------------------------------</p>
		<p class="prompt">Go home : type home or back</p>		
		<p class="prompt">refresh : type all character</p>				
		<p class="prompt output new-output"></p>  
	</div>
</div>
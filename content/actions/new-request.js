jQuery(document).ready(function(){
    function isEmail(emailAddress) {
        var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        return pattern.test(emailAddress);
    }
	
	// Validate as you type  
	$('#name, #wallet').blur(function() {
		if (!$(this).val()) {
			$(this).addClass('error');
		}
		else {
			$(this).removeClass('error');
		}
	});
	
	//Verify if email is valid
	$('#email').blur(function() {
		if (!$(this).val() || !isEmail($(this).val())) {
			$(this).addClass('error');
		}
		else {
			$(this).removeClass('error');
		}
	});

	/**
	 * We Proccess The form submition
	 */
    $('#contact-form').submit(function(){
		
		//reset the submit button
		$('#submit').trigger("reset");
		
		//verify if they are empty
		$('#name, #wallet').map(function() {
			if (!$(this).val()) {
				$(this).addClass('error');
				return false;
			}
			else {
				$(this).removeClass('error');
			}
		});
		
		//Verify if email is valid
		$('#email').map(function() {
			if (!$(this).val() || !isEmail($(this).val())) {
				$(this).addClass('error');
				return false;
			}
			else {
				$(this).removeClass('error');
			}
		});
		
		//show the results
        var action = $(this).attr('action');
			
        $.post(action, $('#contact-form').serialize(),
            function(data){		
				//hide old message
				$("#msg").fadeOut(0);
				
				//get new message
				$('#msg').html(data);
				
				//show the loader
				$("#submit-contact").after('<img src="content/actions/loader.gif" class="loader" />');
				$(".loader").fadeOut(2000);
				
				//Show the message
                $("#msg").fadeIn(2000);
				
				//Scroll up to the error
				//$('body, html').animate({scrollTop:$('#contact-message').offset().top}, 'slow');

				//We reset the form and disable a submit only if the icon from the success message is shown
				if ($('.text-success')[0]) {
					// ALL DATEBASE REQUEST WAS MADE AND ARE VERIFICATIONS WHERE DONE
					// HERE YOU THE JS NODE CONNECTION NEEDS TO BE MADE WITH THE FAUCET
					// AT THIS STAGE COINS CAN BE SEND

					$('#contact-form').trigger("reset");
					$("#contact-form").prop('disabled', true).addClass('disabled');
					$("#submit-contact").prop('disabled', true).addClass('disabled');
					$("#name, #wallet, #email").prop('disabled', true).addClass('disabled');
				}				
            }
        );

		// DO not reload the page
        return false;
    });
});
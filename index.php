<?php

	$error = "";
	$successMessage = "";
	$style = "";

	if($_POST) {

		if(!$_POST["form-email"]) {
			$error .= "Email is required <br>";
		};

		if(!$_POST["form-subject"]) {
			$error .= "Subject is required <br>";
		};

		if (!$_POST["form-message"]) {
			$error .= "Message is required <br>";
		};

		if($_POST["form-email"] && filter_var($_POST["form-email"], FILTER_VALIDATE_EMAIL === false)) {
			$error .= "The email address is invalid<br>";
		};

		if ($error != "") {
			$error = "<div class='alert alert-dander'>There were mistake(s) in the form:<br> " . $error . "</div>";
			$style = "visibility: visible";
		}
		else {

			$emailTo = "arstrel@gmail.com";

			$subject = $_POST['form-subject'];

			$content = $_POST['form-message'];

			$headers = "From: ".$_POST['form-email'];

			if(mail($emailTo, $subject, $content, $headers)) {



				$successMessage = "<div class='alert alert-success'> Your message was sent successfully. I'll get back to you soon </div>";
				$style = "visibility: visible";
			} else {
				$error = "<div class='alert alert-dander'>Your message couldn't be sent - please try again later</div>";
				$style = "visibility: visible";
			};

		};
	};


	?>

<!DOCTYPE html>
<html lang="en">

	<head>

		<title> Contact form </title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	</head>

	<body>

		<div class="container">

				<div class="row">

					<div class="col-xl-8 offset-xl-2 py-3">

						<h1> Get in Touch! </h1>

						<p class="lead"> Contact form dedicated to get your message across quick and easy</p>

					</div>

					<div class="col-xl-8 offset-xl-2">

						<div id="messages"><? echo $error.$successMessage; ?></div>

					</div>

					<div class="col-xl-8 offset-xl-2">



					<form id="contact-form" method="post" class="py-3">

						<div class="form-group">
							<label for="form-email"> Email address </label>
							<input id="form-email" class="form-control" type="email"
							name="form-email" placeholder="Enter your email">
							<small class="form-text text-muted"> We'll never share your email with anyone else</small>
						</div>

						<div class="form-group">
							<label for="form-subject"> Subject </label>
							<input id="form-subject" name="form-subject" class="form-control" type="text" placeholder="Specify your need"
							data-error="Specify the subject of your request">
						</div>

						<div class="form-group">
							<label for="form-message">What would you like to ask us?</label>
							<textarea id="form-message" name="form-message" rows="4" class="form-control"></textarea>

						</div>

						<button class="btn btn-primary" type="submit" id="submitButton">Submit </button>

					</form>

				</div>
			</div>
		</div>

	</body>





<style type="text/css">

#messages {
	visibility: hidden;
	<? echo $style ?> !important;
}



</style>

<script src="https://code.jquery.com/jquery-3.4.0.min.js"  integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script type="text/javascript">
	$('#contact-form').submit(function (e) {
		e.preventDefault();


		var error = "";

		if ($("#form-email").val() == "") {
			error += "The email field is required <br>";
		}

		if ($("#form-subject").val() == "") {
			error += "The subject field is required <br>";
		}

		if ($("#form-message").val() == "") {
			error += "The content field is required";
		}

		if (error != "") {

		$('#messages').html('<div class="alert alert-danger"> <p><strong>There were error(s) in your form:</strong></p>' + error + "</div>");

		$('#messages').fadeTo(200, 1, function() {
			$('#messages').css('visibility','visible');
			});

		$('#messages').fadeTo(5000, 0, function() {
			$('#messages').css('visibility','hidden');
		});
	} else {

		$('#contact-form').unbind('submit').submit();
	}
	});

</script>

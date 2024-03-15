<!DOCTYPE html>
<html lang="en">

<head>



	<title>OrderVox Ltd.</title>


	<link rel="apple-touch-icon" sizes="120x120" href="img/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="img/orderE.ico">
	<link rel="icon" type="image/png" sizes="16x16" href="img/orderE.ico">


	<link rel="mask-icon" href="img/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">



	<!-- GOOGLE WEB FONT -->
	<link href="https://fonts.googleapis.com/css?family=Lato:400,700,900,400italic,700italic,300,300italic" rel="stylesheet" type="text/css">

	<!-- BASE CSS -->
	<link href="https://faithitcouk.ordere.uk/template/css/animate.min.css" rel="stylesheet">
	<link href="https://faithitcouk.ordere.uk/template/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://faithitcouk.ordere.uk/template/css/menu.css" rel="stylesheet">
	<link href="https://faithitcouk.ordere.uk/template/css/style.css" rel="stylesheet">
	<link href="https://faithitcouk.ordere.uk/template/css/style1.css" rel="stylesheet">
	<link href="https://faithitcouk.ordere.uk/template/css/responsive.css" rel="stylesheet">
	<link href="https://faithitcouk.ordere.uk/template/css/elegant_font.min.css" rel="stylesheet">
	<link href="https://faithitcouk.ordere.uk/template/css/fontello.min.css" rel="stylesheet">
	<link href="https://faithitcouk.ordere.uk/template/css/magnific-popup.css" rel="stylesheet">
	<link href="https://faithitcouk.ordere.uk/template/css/pop_up.css" rel="stylesheet">
	<link href="https://faithitcouk.ordere.uk/template/css/grey.css" rel="stylesheet">

	<link href="https://faithitcouk.ordere.uk/template/css/snackbar.css" rel="stylesheet">



	<style>
		table.table.table_summary td {
			padding: 5px 0px !important;
		}

		table.table.table_summary td p {
			margin-bottom: 0px !important;
			margin-top: 0px !important;
		}

		@font-face {
			font-weight: 400;
			font-style: normal;
			font-family: circular;

			src: url('chrome-extension://liecbddmkiiihnedobmlmillhodjkdmb/fonts/CircularXXWeb-Book.woff2') format('woff2');
		}

		@font-face {
			font-weight: 700;
			font-style: normal;
			font-family: circular;

			src: url('chrome-extension://liecbddmkiiihnedobmlmillhodjkdmb/fonts/CircularXXWeb-Bold.woff2') format('woff2');
		}
	</style>
</head>

<body>

	<!-- Add your HTML content here -->
	<div class="container margin_60_35">
		<div class="row">
			<div class="panel-group" id="accordion">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h2 class="panel-title">
							<span class="numberCircle" style="border-color:white;">#</span>Stripe Payment
						</h2>
					</div>
					<div class="col-md-12" style="padding-top: 40px; padding-bottom: 40px;">
						<div class="card card-outline-secondary">
							<div class="card-body">
								<span style="font-size: 14px; margin-bottom: 20px;">
									<i style="float: left; margin-right: 5px;margin-left: 5px; font-size: 20px; margin-bottom: 20px;" class="fa fa-lock"></i>
									This is a secure SSL encrypted payment.
								</span>
								<hr>
								<p id="failed" style="color:red;font-weight:bold;text-align:center;margin:8px;"></p>
								<form class="form" role="form" autocomplete="off" id="payment-form" method="POST">
									<div id="card-dtl">
										<div class="form-group col-md-12">
											<label>Email</label>
											<input type="email" id="email" class="form-control" required>
										</div>
										<div class="form-group col-md-12">
											<label for="cc_name">Card No</label>
											<div id="card-errors" style="color: red"></div>
											<div class="form-control">
												<div id="card-element" style="margin-top: 3px"></div>
											</div>
										</div>
									</div>
									<hr>
									<div class="form-group row" align="center" style="padding-top: 15px; ">
										<div class="col-md-12" align="center">
											<button id="submit" class="btn btn-primary" style="padding: 10px; font-size: 17px;">
												<i id="loading-icon" style="display:none" class="fa fa-spinner fa-spin"></i> Pay Now</button>
											<button id="try-btn" style="display:none" type="button" class="btn btn-primary" style="padding: 10px; font-size: 17px;" onclick="reloadPage()">Try Again</button>
										</div>
									</div>
								</form>
								<div class="error-pay text-center">
									<span class="text-danger" style="font-size:20px;" id="pay-err"></span>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="https://js.stripe.com/v3/"></script>
	<script type="text/javascript">
		var stripe_public_key = "SET YOUR PUBLIC KEY HERE";
		var stripe = Stripe(stripe_public_key);
		var elements = stripe.elements();
		var style = {
			base: {
				color: "#32325d",
			}
		};
		var card = elements.create("card", {
			hidePostalCode: true,
			style: style
		});
		card.mount("#card-element");
		card.on('change', ({
			error
		}) => {
			const displayError = document.getElementById('card-errors');
			if (error) {
				displayError.textContent = error.message;
				document.getElementById('card-errors').style.display = "block";
			} else {
				displayError.textContent = '';
				document.getElementById('card-errors').style.display = "none";
			}
		});
		var form = document.getElementById('payment-form');
		form.addEventListener('submit', function(ev) {
			$('#loading-icon').show();
			if ($('#card-errors').css('display') == 'block') {
				$('#loading-icon').hide();
			}
			ev.preventDefault();
			var email = document.getElementById('email').value;
			stripe.confirmCardPayment("<?php echo $intent['client_secret'] ?>", {
				payment_method: {
					card: card,
					billing_details: {
						email: email
					}
				}
			}).then(function(result) {
				if (result.error) {
					$('#failed').text(result.error.message);
					$('#failed').show();
					$('#loading-icon').hide();
				} else {
					if (result.paymentIntent.status === 'succeeded') {
						$('#failed').hide();
						location.href = '<?= base_url('/success'); ?>';
						
					}
				}
			});
		});
	</script>
</body>

</html>
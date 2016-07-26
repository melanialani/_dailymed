<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Your Daily Medication</title>

    <!-- Bootstrap Core CSS -->
    <!--link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"-->
    <link rel="stylesheet" href="<?php echo base_url("assets/vendor/bootstrap/css/bootstrap.min.css"); ?>" />

    <!-- Custom Fonts -->
    <!--link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/vendor/font-awesome/css/font-awesome.min.css"); ?>" />
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Theme CSS -->
    <!--link href="css/agency.min.css" rel="stylesheet"-->
    <link rel="stylesheet" href="<?php echo base_url("assets/css/agency.min.css"); ?>" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">Your Daily Medication</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#resources">Resources</a>
                    </li>
                    <li>
                    	<a class="page-scroll" href="#contact">
                    		<?php 	if ($email == "" || $email == NULL) echo 'Register/Login';
	                        		else echo $email; 												?>
                    	</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#payment">Payment</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">Provides users with access to current Structured Product Language (SPL) information 
                        	about marketed drugs</div>
                <div class="intro-heading">YOUR DAILY MEDICATION</div>
                <a href="#resources" class="page-scroll btn btn-xl">Our Resources</a>
            </div>
        </div>
    </header>

    <!-- Resources Grid Section -->
    <section id="resources">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Resources</h2>
                    <h3 class="section-subheading text-muted">Provides users with access to current Structured Product Language (SPL) 
                    	information about marketed drugs. The data provided by this service is the most recent provided to the FDA. Users 
                    	can query this RESTful service using a variety of parameters, including prescription or over the counter, 
                        human or animal drugs, drug name, drug imprint data, and National Drug Code (NDC). This free service returns 
                        data as XML or JSON based on user specificaiton.</h3>
                </div>
            </div>
            
            <table class="table table-striped">
            	<tr>
            		<td><b>/drug/ndc?code={SETCODE}&key={USERKEY}</b></td>
            		<td>Returns drug information with NDC code = SETCODE in XML format</td>
            	</tr>
            	<tr>
            		<td><b>/drug/diagnosis?code={SETCODE}&key={USERKEY}</b></td>
            		<td>Returns drug information with diagnosis code = SETCODE in XML format</td>
            	</tr>
            	<tr>
            		<td><b>/drug/procedure?code={SETCODE}&key={USERKEY}</b></td>
            		<td>Returns drug information with procedure code = SETCODE in XML format</td>
            	</tr>
            	<tr>
            		<td><b>/drug/brand?name={SETNAME}&key={USERKEY}</b></td>
            		<td>Returns drug information with brand name contains SETNAME in XML format</td>
            	</tr>
            	<tr>
            		<td><b>/drug/generic?name={SETNAME}&key={USERKEY}</b></td>
            		<td>Returns drug information with generic name contains SETNAME in XML format</td>
            	</tr>
            	<tr>
            		<td><b>/drug/price?more_than={SETPRICE}&lower_than={SETPRICE}&key={USERKEY}</b></td>
            		<td>Returns drug information with price in between in XML format</td>
            	</tr>
            	<tr>
            		<td><b>/drug/brandfor?brand={SETBRAND}&for={SETAGECIRCLE}&key={USERKEY}</b></td>
            		<td>Returns drug information with a certain brand within certain age circle in XML format</td>
            	</tr>
            	<tr>
            		<td><b>/drug/drugsForWithPrice?more_than={SETPRICE}&lower_than={SETPRICE}&for={SETAGECIRCLE}&key={USERKEY}</b></td>
            		<td>Returns drug information with price in between and within a certain age circle XML format</td>
            	</tr>
            	<tr>
            		<td><b>/drug/ndc/code/{SETCODE}/format/json?key={USERKEY}</b></td>
            		<td>Returns drug information with NDC code = SETCODE in JSON format</td>
            	</tr>
            	<tr>
            		<td><b>/drug/diagnosis/code/{SETCODE}/format/json?key={USERKEY}</b></td>
            		<td>Returns drug information with diagnosis code = SETCODE in JSON format</td>
            	</tr>
            	<tr>
            		<td><b>/drug/procedure/code/{SETCODE}/format/json?key={USERKEY}</b></td>
            		<td>Returns drug information with procedure code = SETCODE in JSON format</td>
            	</tr>
            	<tr>
            		<td><b>/drug/brand/name/{SETNAME}/format/json?key={USERKEY}</b></td>
            		<td>Returns drug information with brand name contains SETNAME in JSON format</td>
            	</tr>
            	<tr>
            		<td><b>/drug/generic/name/{SETNAME}/format/json?key={USERKEY}</b></td>
            		<td>Returns drug information with generic name contains SETNAME in JSON format</td>
            	</tr>
            	<tr>
            		<td><b>/drug/price/more_than/{SETPRICE}/lower_than/{SETPRICE}/format/json?key={USERKEY}</b></td>
            		<td>Returns drug information with price in between in JSON format</td>
            	</tr>
            	<tr>
            		<td><b>/drug/brandfor/brand/{SETBRAND}/for/{SETAGECIRCLE}/format/json?key={USERKEY}</b></td>
            		<td>Returns drug information with a certain brand within certain age circle in JSON format</td>
            	</tr>
            	<tr>
            		<td><b>/drug/drugsForWithPrice/more_than/{SETPRICE}/lower_than/{SETPRICE}/for/{SETAGECIRCLE}/format/json?key={USERKEY}</b></td>
            		<td>Returns drug information with price in between and within a certain age circle in JSON format</td>
            	</tr>
            </table>
        </div>
    </section>
    
    <!-- Status/Register/Login Section -->
    <?php
    	if ($email == "" || $email == NULL){ // register/login section
    		echo '
    			<section id="contact">
			    	<div class="container">
			            <div class="row">
			                <div class="col-lg-12 text-center">
			                    <h2 class="section-heading">Register/Login</h2>
			                    <h3 class="section-subheading text-muted">Get up to 10,000 request before paying $0.01 for every request</h3>
			                </div>
			            </div>
			            <div class="row">
			            	<div class="col-lg-12 text-center" style="margin-left: 15%;">
				                <div class="col-md-4 col-sm-6 portfolio-item">
				                    <a href="#register_modal" class="portfolio-link" data-toggle="modal">
				                        <h4>Register</h4>
				                    </a>
				                    <div class="portfolio-caption">
					                    <p class="text-muted">Join us to start using our service</p>
				                    </div>
				                </div>
				                
				                <div class="col-md-4 col-sm-6 portfolio-item">
				                    <a href="#login_modal" class="portfolio-link" data-toggle="modal">
				                        <h4>Login</h4>
				                    </a>
				                    <div class="portfolio-caption">
					                    <p class="text-muted">Login to see your status & make payment</p>
				                    </div>
				                </div>
			                </div>
			            </div>
			        </div>
			    </section>
    		';
    	} else { // status section
    		echo '
    			<section id="contact">
			    	<div class="container">
			            <div class="row">
			                <div class="col-lg-12 text-center">
			                	<h2 class="section-heading">' . $email . '</h2>
			                    <div class="portfolio-caption">
			                        <h4 style="color:white;">Public key : ' . $key . '</h4>
			                    </div>
			                    <br/>
			                    <div class="portfolio-caption">
			                        <h4 style="color:white;">Total request : ' . $req . '</h4>
			                    </div>
			                </div>
			            </div>
			            <br/><br/>
			            <div class="row">
			                <div class="col-lg-12 text-center">
			                    <h2 class="section-heading">TO GET UNLIMITED REQUEST, MAKE PAYMENT NOW</h2>
			                </div>
			            </div>
			        </div>
			    </section>
    		';
    	}
    ?>
    
    <!-- Payment Section -->
    <section id="payment">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Payment</h2>
                    <h3 class="section-subheading text-muted">We offer three ways to pay</h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-lock fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading"><a class="page-scroll" style="color: black;" href="http://www.klikbca.com/">BCA Bank Transfer</a></h4>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-laptop fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading"><a class="page-scroll" style="color: black;" href="#paypal">PayPal</a></h4>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-lock fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading"><a class="page-scroll" style="color: black;" href="https://ib.bankmandiri.co.id/retail/Login.do?action=form&lang=in_ID">Mandiri Bank Transfer</a></h4>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-light-gray">
        <div class="container">
            <div class="col-md-4">
                <span class="copyright">Copyright &copy; Your Daily Medication 2016</span>
            </div>
        </div>
    </footer>

    <!-- Modals -->
    <!-- Use the modals below to showcase details about your portfolio projects! -->

    <!-- Portfolio Modal 1 -->
    <div class="portfolio-modal modal fade" id="register_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl"></div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <!-- Project Details Go Here -->
                            <h2>Register</h2>
                            <p class="item-intro text-muted">Join us to start using our service</p>
                            
                            <?php echo form_open('med/register', "role='form'"); ?>
								<fieldset> 
	                            	<div class="col-lg-12 text-center">
		                                <div class="form-group">
		                                    <input type="email" class="form-control" placeholder="Your Email *" id="new_email" name="new_email" required data-validation-required-message="Please enter your email address.">
		                                    <p class="help-block text-danger"></p>
		                                </div>
		                                <div class="form-group">
		                                    <input type="password" class="form-control" placeholder="Your Password *" id="new_password" name="new_password" required data-validation-required-message="Please enter your password.">
		                                    <p class="help-block text-danger"></p>
		                                </div>
		                                <div class="form-group">
		                                    <input type="password" class="form-control" placeholder="Retype Your Password *" id="re_password" name="re_password" required data-validation-required-message="Please retype your password.">
		                                    <p class="help-block text-danger"></p>
		                                </div>
		                            </div>
	                            	<?php echo form_submit(['id'=>'register','name'=>'register','value'=>'Register','class'=>'btn btn-primary']); ?>
                            	</fieldset> 
							<?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 2 -->
    <div class="portfolio-modal modal fade" id="login_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl"></div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <!-- Project Details Go Here -->
                            <h2>Login</h2>
                            <p class="item-intro text-muted">Login to see your status & make payment</p>
                            
                            <?php echo form_open('med/login', "role='form'"); ?>
								<fieldset> 
	                            	<div class="col-lg-12 text-center">
		                                <div class="form-group">
		                                    <input type="email" class="form-control" placeholder="Your Email *" id="email" name="email" required data-validation-required-message="Please enter your email address.">
		                                    <p class="help-block text-danger"></p>
		                                </div>
		                                <div class="form-group">
		                                    <input type="password" class="form-control" placeholder="Your Password *" id="password" name="password" required data-validation-required-message="Please enter your password.">
		                                    <p class="help-block text-danger"></p>
		                                </div>
		                            </div>
	                            	<?php echo form_submit(['id'=>'login','name'=>'login','value'=>'Login','class'=>'btn btn-primary']); ?>
	                            </fieldset> 
							<?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php echo $message; ?>

    <!-- jQuery -->
    <!--script src="vendor/jquery/jquery.min.js"></script-->
    <script src="<?php echo base_url("assets/vendor/jquery/jquery.min.js"); ?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <!--script src="vendor/bootstrap/js/bootstrap.min.js"></script-->
    <script src="<?php echo base_url("assets/vendor/bootstrap/js/bootstrap.min.js"); ?>"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Contact Form JavaScript -->
    <!--script src="js/jqBootstrapValidation.js"></script-->
    <script src="<?php echo base_url("assets/js/jqBootstrapValidation.js"); ?>"></script>
    <!--script src="js/contact_me.js"></script-->
    <script src="<?php echo base_url("assets/js/contact_me.js"); ?>"></script>

    <!-- Theme JavaScript -->
    <!--script src="js/agency.min.js"></script-->
    <script src="<?php echo base_url("assets/js/agency.min.js"); ?>"></script>
    
    <script type="text/javascript">
		window.onload = function () {
			document.getElementById("new_password").onchange = validatePassword;
			document.getElementById("re_password").onchange = validatePassword;
		}
		function validatePassword(){
			var re_pass = document.getElementById("re_password").value;
			var pass = document.getElementById("new_password").value;
			if(pass != re_pass)
				document.getElementById("re_password").setCustomValidity("Passwords Don't Match");
			else
				document.getElementById("re_password").setCustomValidity('');	 
			//empty string means no validation error
		}
	</script>

</body>

</html>

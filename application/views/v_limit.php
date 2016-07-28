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
                    <!--<li>
                    	<a class="page-scroll" href="#contact">
                    		<?php 	if ($email == "" || $email == NULL) echo 'Register/Login';
	                        		else echo $email; 												?>
                    	</a>
                    </li>-->
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
                <div class="intro-lead-in">OPPS!</div>
                <div class="intro-heading">INVALID REQUEST LIMIT</div>
                <a href="#payment" class="page-scroll btn btn-xl">Payment</a>
            </div>
        </div>
    </header>

    <!-- Resources Grid Section -->

    <!-- Status/Register/Login Section -->

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

    <!-- Portfolio Modal 2 -->

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

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
    <nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top" style="background: #000;">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="<?php echo base_url(); ?>">Your Daily Medication</a>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Resources Grid Section -->
    <section id="resources">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Our client example</h2>
               		<!--woohoo i did it !! im fucking awesome you losers! just fyi, that guy named yudha didnt do any shit in this project, and the senior only added the user key, he couldnt even do this client thing. im a saint for still letting them in this project.-->
                    <h3 class="section-subheading text-muted">This page provides example result of parsing our data and use it correctly.</h3>
                </div>
            </div>
            
            <h6 class="text-muted text-center">Request url: <a href="<?php echo $url; ?>" style="color: #660090;"><?php echo $url; ?></a></h6><br/><br/>
            
            <table class="table table-striped">
            	<?php
            		for ($i = 0; $i < sizeof($data); $i++){
						echo "
						<tr>
		            		<td><b>FDA NCD Code</b></td>
		            		<td>".$data[$i]['FDA NDC Code']."</td>
		            	</tr>
		            	<tr>
		            		<td><b>Brand</b></td>
		            		<td>".$data[$i]['Brand']."</td>
		            	</tr>
		            	<tr>
		            		<td><b>Generic Name</b></td>
		            		<td>".$data[$i]['Generic Name']."</td>
		            	</tr>
		            	<tr>
		            		<td><b>Drug Company</b></td>
		            		<td>".$data[$i]['Drug Company']."</td>
		            	</tr>
		            	<tr>
		            		<td><b>ICD9 Diagnosis Code</b></td>
		            		<td>".$data[$i]['ICD9 Diagnosis Code']."</td>
		            	</tr>
		            	<tr>
		            		<td><b>ICD9 Diagnosis Form</b></td>
		            		<td>".$data[$i]['Diagnosis Form']."</td>
		            	</tr>
		            	<tr>
		            		<td><b>ICD9 Procedure Code</b></td>
		            		<td>".$data[$i]['Procedure Code']."</td>
		            	</tr>
		            	<tr>
		            		<td><b>ICD9 Procedure Form</b></td>
		            		<td>".$data[$i]['Procedure Form']."</td>
		            	</tr>
		            	
		            	<tr><td></td><td></td></tr>
		            	<tr><td></td><td></td></tr>
		            	<tr><td></td><td></td></tr>
		            	";
					}
            	?>
            </table>
        </div>
    </section>
    
    <footer class="bg-light-gray">
        <div class="container">
            <div class="col-md-4">
                <span class="copyright">Copyright &copy; Your Daily Medication 2016</span>
            </div>
        </div>
    </footer>
    
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
    
</body>

</html>
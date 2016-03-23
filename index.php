<?php
$subjectPrefix = '[Contato via Site]';
$emailTo = '<themask@theatreforcharity.in>';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name    = stripslashes(trim($_POST['form-name']));
    $email   = stripslashes(trim($_POST['form-email']));
    $phone   = stripslashes(trim($_POST['form-tel']));
    $subject = stripslashes(trim($_POST['form-assunto']));
    $message = stripslashes(trim($_POST['form-mensagem']));
    $pattern = '/[\r\n]|Content-Type:|Bcc:|Cc:/i';

    if (preg_match($pattern, $name) || preg_match($pattern, $email) || preg_match($pattern, $subject)) {
        die("Header injection detected");
    }

    $emailIsValid = filter_var($email, FILTER_VALIDATE_EMAIL);

    if($name && $email && $emailIsValid && $subject && $message){
        $subject = "$subjectPrefix $subject";
        $body = "Nome: $name <br /> Email: $email <br /> Telefone: $phone <br /> Mensagem: $message";

        $headers .= sprintf( 'Return-Path: %s%s', $email, PHP_EOL );
        $headers .= sprintf( 'From: %s%s', $email, PHP_EOL );
        $headers .= sprintf( 'Reply-To: %s%s', $email, PHP_EOL );
        $headers .= sprintf( 'Message-ID: <%s@%s>%s', md5( uniqid( rand( ), true ) ), $_SERVER[ 'HTTP_HOST' ], PHP_EOL );
        $headers .= sprintf( 'X-Priority: %d%s', 3, PHP_EOL );
        $headers .= sprintf( 'X-Mailer: PHP/%s%s', phpversion( ), PHP_EOL );
        $headers .= sprintf( 'Disposition-Notification-To: %s%s', $email, PHP_EOL );
        $headers .= sprintf( 'MIME-Version: 1.0%s', PHP_EOL );
        $headers .= sprintf( 'Content-Transfer-Encoding: 8bit%s', PHP_EOL );
        $headers .= sprintf( 'Content-Type: text/html; charset="utf-8"%s', PHP_EOL );

        mail($emailTo, "=?utf-8?B?".base64_encode($subject)."?=", $body, $headers);
        $emailSent = true;
    } else {
        $hasError = true;
    }
}
?>

<!DOCTYPE html>
<!-- ashwinvasudevan.com -->
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
	<title> The Mask: Fundraiser</title>

	<!--Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<!--Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:700,300' rel='stylesheet' type='text/css'>
	<!--Font Awesome-->
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">
	<!--Custom CSS-->
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	 <?php if(!empty($emailSent)): ?>
        	<script>
				function myFunction() {
				    alert("Sent");
				}
			</script>
    <?php else: ?>
        <?php if(!empty($hasError)): ?>
        	<script>
				function myFunction() {
				    alert("Could not send! Error.");
				}
			</script>
        <?php endif; ?>

	<nav class="navbar navbar-default navbar-fixed-top">
  		<div class="container-fluid">
    	<!-- Brand and toggle get grouped for better mobile display -->
    		<div class="navbar-header">
      			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
      			</button>
     			<a href="#"><img class="navbar-brand" href="#" src="images/logo.png"></a>
    		</div>

    		<!-- Collect the nav links, forms, and other content for toggling -->
    		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      		<ul class="nav navbar-nav">
			        <li class="active"><a href="#myCarousel">HOME</a></li>
			        <li><a href="#mission">OUR MISSION</a></li>
			        <li><a href="#vision">OUR VISION</a></li>
			        <li><a href="#sponsors">SPONSORS</a></li>
	     		</ul>
    		</div><!-- /.navbar-collapse -->
 		</div><!-- /.container-fluid -->
	</nav>
	
	
    <header id="myCarousel" class="carousel slide">
		<div id="main-logos">
			<img src="images/logo2.png" alt="">
			<img src="images/logo3.png" alt="">
			<img src="images/logo5.png" alt="">
			<img src="images/logo6.png" class="width" alt="">
		</div>		
        <!-- Wrapper for Slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="fill" style="background-image:url('images/bg2-min.jpg');"></div>
                <div class="carousel-caption">
                	<div class="row">
                		<div class="col-lg-12">
                			<img href="#" src="images/logo.png" >
                		</div>
						<div class="col-lg-12">
							<h1> The Mask </h1> 
							
							<h3>CHENNAI, INDIA </h3>
						</div>
                	</div>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('images/bg1-min.jpg');"></div>
                <div class="carousel-caption">
                	<div class="row">
                		<div class="col-lg-12 col-xs-12	">	
                		 	<h1>The Sight of the stars makes me dream </h1>
                   			<h3> Vincent Van Gogh </h3>
                		</div>
                	</div>
                   
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('images/bg3-min.jpg');"></div>
                <div class="carousel-caption">
                	<div class="row">
                		<div class="col-lg-12 col-xs-12	">	
                		 	<h1> There is no better way to thank God for your sight than giving a helping hand to someone in the dark </h1>
                   			<h3> Helen Keller </h3>
                		</div>
                	</div>
                </div>
            </div>
        </div>

        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <i class="fa fa-arrow-left "></i>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
        	 <i class="fa fa-arrow-right"></i>
        </a>
    </header>
    
	<section id="mission" class="secondary-color">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12 text-center">
					<h1>The Mission</h1>
					<hr>
					<div class="col-md-6 col-md-offset-3 text-center">
						<p class="italics">Vincent Van Gogh once said “<b>The sight of the Stars makes me dream. </b>”
						Of all the senses, sight is the most delightful.
						To see is to dream, they say. Sight is no ordinary ability.It is a boon of life taken for granted, yet denied to millions of people.
						To restore vision to the needy and bring back light into their dark lives,
						we present to you our fundraiser, <b>The Mask</b>
 						</p>
					</div>
				</div>

				<div class="col-md-2 col-md-offset-2">
					
					<h2> Fundraise </h2>
					<p>The theatre play, the apple of everyone’s eye is our way of raising the funds necessary. The Egmore Museum Theatre, one of the most renown theatres in our beautiful city is where the magic happens.
					</p>
				</div>
				<div class="col-md-2 col-md-offset-1">
					<h2> Empower</h2>
					<p>Dr. Agarwal’s Eye Hospital, our official Medical Partner, will help us find the people who are desperately in need of help using their vast resources.</p>
				</div>
				<div class="col-md-2 col-md-offset-1">
					<h2> Enlighten </h2>
					<p>The final and most fruitifying step in our glorius journey, we give vision to the underprivileged with the help of the doctors at Dr. Agarwal’s Eye Hospital, bringing light into their dark lives. </p>
				</div>
				
			</div>
		</div>
	</section>
	<article>
		<div class="containter-fluid">
			<div class="row-eq-height">
				<div class="col-md-6 col-xs-12 bg">
					<div class="row">
						<div class="col-xs-6">
							<img src="images/circle1.png" class="img-circle" alt="">
						</div>
						<div class="col-xs-6">
							<img src="images/circle2.png" class="img-circle" alt="">
						</div>
					</div>
					
					<div class="row">
						<div class="col-xs-6">
							<img src="images/circle3.png" class="img-circle" alt="">
						</div>
						<div class="col-xs-6">
							<img src="images/circle4.png" class="img-circle" alt="">
						</div>
					</div>

				</div>
				<div class="col-md-6 col-xs-12 primary-color">
					<div id="info-text" class="col-md-12">
						<p>
								The Mask, a marvellous annual theatre play organized by the rotaractors of <b>SRM Easwari </b>, has tried to revive the “art of theatres”. The Mask has lent a helping hand to this admirable cause and has also got the people, especially the youngsters, to enjoy and appreciate wholesome joy of watching and experiencing artistry of the highest order, thereby breathing new life into the perishing art form. Nothing can match up to the effect of watching real people performing on a live stage in front of our very eyes! So get all set to catch the spectacular action at the MASK 16!
						</p>
					</div>
					<div class="col-lg-12 text-center">
					  	<div id="info-details" class="text-left">
						  	<p> <i class="fa fa-calendar fa-2x"> </i> &nbsp;&nbsp;&nbsp;&nbsp;March 25-27, 2016
						  	</p>
							<p> <i class="fa fa-clock-o fa-2x"> </i> &nbsp;&nbsp;&nbsp;&nbsp;Several shows available</p>
							<p><i class="fa fa-map-marker fa-2x"> </i>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							Venue- Museum Theatre, <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Egmore
							</p>
				    	</div> 
						<button type="submit" class="btn btn-default btn-secondary spacing">TICKETS ARE NOT AVAILABLE YET</button>
	    			</div>
				</div>
			</div>	
		</div>
	</article>
	<section id="gallery" class="secondary-color">
		<div class="container-fluid ">
			<div class="row">
				<div class="col-md-12 text-center">
					<h1>Gallery</h1>
					<hr>
				</div>

				<div class="col-md-3 col-sm-6 col-xs-6 text-center">
					<a href="#" data-toggle="modal" data-target="#lightbox"> 
            			<img src="images/g1.jpg" alt="...">
       				 </a>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-6 text-center">
					<a href="#" data-toggle="modal" data-target="#lightbox"> 
            			<img src="images/g2.jpg" alt="...">
       				 </a>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-6 text-center">
					<a href="#" data-toggle="modal" data-target="#lightbox"> 
            			<img src="images/g3.jpg" alt="...">
       				 </a>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-6 text-center">
					<a href="#" data-toggle="modal" data-target="#lightbox"> 
            			<img src="images/g4.jpg" alt="...">
       				 </a>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-6 text-center">
					<a href="#" data-toggle="modal" data-target="#lightbox"> 
            			<img src="images/g5.jpg" alt="...">
       				 </a>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-6 text-center">
					<a href="#" data-toggle="modal" data-target="#lightbox"> 
            			<img src="images/g6.jpg" alt="...">
       				 </a>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-6 text-center">
					<a href="#" data-toggle="modal" data-target="#lightbox"> 
            			<img src="images/g7.jpg" alt="...">
       				 </a>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-6 text-center">
					<a href="#" data-toggle="modal" data-target="#lightbox"> 
            			<img src="images/g8.jpg" alt="...">
       				 </a>
				</div>
						
			</div>
		</div>
		<div id="lightbox" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		    <div class="modal-dialog">
		        <button type="button" class="close hidden" data-dismiss="modal" aria-hidden="true">×</button>
		        <div class="modal-content">
		            <div class="modal-body">
		                <img src="" alt="" />
		            </div>
		        </div>
		    </div>
		</div>
	</section>
	
	<article id="vision">
		<div class="containter-fluid">
			<div class="row-eq-height">
				<div class="col-md-6 col-xs-12 primary-color">
					<div id="info-text" class="col-md-12 ">
						<p>
							Sight makes us understand the beauty of everything around us, helps us nurture our imagination, cultivate our dreams and fulfill our ambitions. There are millions of visually impaired people all over our country, without the one boon the rest of us take for granted- the boon of sight. India has the greatest number of blind people in the world and currently about 19 million blind people live in India of which 80% live in rural and slum areas. 
							<br>Step 1: Click on the link
							<br>Step 2: Register yourself as an eye donor
							<br>Step 3: Spread awareness and make the difference
						</p>
						<a class="btn btn-default btn-secondary spacing center-block" href="http://www.dare2stare.in/#do-you-dare">CLICK HERE TO REGISTER!</a>
					</div>
					
				</div>
				<div class="col-md-6 col-xs-12 bg">
					<div class="videowrapper">
						<iframe width="560" height="315" src="https://www.youtube.com/embed/LCeZMK3OuX0" frameborder="0" allowfullscreen></iframe>
					</div>
				
				</div>
				
			</div>	
		</div>
	</article>
	<section id="gallery" class="secondary-color">
		<div class="container-fluid" id="sponsors">
			<div class="row">
				<div class="col-md-12 text-center">
					<h1>Previous Sponsors</h1>
					<hr>
				</div>

				<div class="col-md-3 col-sm-6 col-xs-6 text-center">
					<a href="#" data-toggle="modal" data-target="#lightbox"> 
            			<img src="images/s1.jpg" alt="...">
       				 </a>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-6 text-center">
					<a href="#" data-toggle="modal" data-target="#lightbox"> 
            			<img src="images/s2.jpg" alt="...">
       				 </a>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-6 text-center">
					<a href="#" data-toggle="modal" data-target="#lightbox"> 
            			<img src="images/s3.jpg" alt="...">
       				 </a>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-6 text-center">
					<a href="#" data-toggle="modal" data-target="#lightbox"> 
            			<img src="images/s4.jpg" alt="...">
       				 </a>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-6 text-center">
					<a href="#" data-toggle="modal" data-target="#lightbox"> 
            			<img src="images/s5.jpg" alt="...">
       				 </a>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-6 text-center">
					<a href="#" data-toggle="modal" data-target="#lightbox"> 
            			<img src="images/s6.jpg" alt="...">
       				 </a>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-6 text-center">
					<a href="#" data-toggle="modal" data-target="#lightbox"> 
            			<img src="images/s7.jpg" alt="...">
       				 </a>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-6 text-center">
					<a href="#" data-toggle="modal" data-target="#lightbox"> 
            			<img src="images/s8.png" alt="...">
       				 </a>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-6 text-center">
					<a href="#" data-toggle="modal" data-target="#lightbox"> 
            			<img src="images/s9.jpg" alt="...">
       				 </a>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-6 text-center">
					<a href="#" data-toggle="modal" data-target="#lightbox"> 
            			<img src="images/s10.jpg" alt="...">
       				 </a>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-6 text-center">
					<a href="#" data-toggle="modal" data-target="#lightbox"> 
            			<img src="images/s11.jpg" alt="...">
       				 </a>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-6 text-center">
					<a href="#" data-toggle="modal" data-target="#lightbox"> 
            			<img src="images/s12.jpg" alt="...">
       				 </a>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-6 text-center">
					<a href="#" data-toggle="modal" data-target="#lightbox"> 
            			<img src="images/s13.jpg" alt="...">
       				 </a>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-6 text-center">
					<a href="#" data-toggle="modal" data-target="#lightbox"> 
            			<img src="images/s14.jpg" alt="...">
       				 </a>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-6 text-center">
					<a href="#" data-toggle="modal" data-target="#lightbox"> 
            			<img src="images/s15.jpg" alt="...">
       				 </a>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-6 text-center">
					<a href="#" data-toggle="modal" data-target="#lightbox"> 
            			<img src="images/s16.jpg" alt="...">
       				 </a>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-6 text-center">
					<a href="#" data-toggle="modal" data-target="#lightbox"> 
            			<img src="images/s17.jpg" alt="...">
       				 </a>
				</div>
						
			</div>
		</div>
		<div id="lightbox" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		    <div class="modal-dialog">
		        <button type="button" class="close hidden" data-dismiss="modal" aria-hidden="true">×</button>
		        <div class="modal-content">
		            <div class="modal-body">
		                <img src="" alt="" />
		            </div>
		        </div>
		    </div>
		</div>
	</section>
	<footer class="primary-color">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4 col-md-offset-1">
					<h2 class="heavy">Contact Us!</h2>
					 <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="contact-form" class="form-horizontal" role="form" method="post">
            <div class="form-group">
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="form-name" name="form-name" placeholder="Name" required>
                </div>
            </div>
            <div class="form-group">
           
                <div class="col-lg-10">
                    <input type="email" class="form-control" id="form-email" name="form-email" placeholder="Email" required>
                </div>
            </div>
            <div class="form-group">
            
                <div class="col-lg-10">
                    <input type="tel" class="form-control" id="form-tel" name="form-tel" placeholder="Phone Number">
                </div>
            </div>
            <div class="form-group">
                
                <div class="col-lg-10">
                    <textarea class="form-control" rows="3" id="form-mensagem" name="form-mensagem" placeholder="Your Message" required></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-offset-3 col-lg-10">
                    <button type="submit" class="btn btn-default btn-secondary spacing">SUBMIT</button>
                </div>
            </div>
        </form>
	    <?php endif; ?>
				</div>
				<div class="col-md-4 col-md-offset-1">
					<div id="footer-links" class="text-center">
						<p> <i class="fa fa-phone fa-2x"> </i> &nbsp;&nbsp;&nbsp;&nbsp;Arun Shankar 8939260981
				  		</p>
				  		<p> <i class="fa fa-phone fa-2x"> </i> &nbsp;&nbsp;&nbsp;&nbsp;Ashwin 9600185573
				  		</p>
			  			<a href="https://www.facebook.com/The-Mask-Fundraiser-838754559573802/?fref=ts"><img src="images/fb.png"></a>
			  			<a href="https://twitter.com/eecrotaract"><img src="images/twitter.png"></a>
					</div>
				</div>
			</div>
		</div>
	</footer>





	




	<!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="assets/js/contact-form.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Custom JS -->
    <script src="js/custom.js"></script>
    <script src="js/scroll.js"></script>
    
    <script>
    $(document).ready(function() {
      $('nav a').smoothScroll();
    });
  	</script>
	
	


	
</body>
</html>
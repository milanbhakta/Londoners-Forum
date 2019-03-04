<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>The londoners</title>
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="index.css">
<link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Condensed|Titillium+Web" rel="stylesheet">
</head>
<body>

<div class="gallery-wrap">
  <div  class="icons hover item-1"></div>
  <div class="icons hover item-2"></div>
  <div class="icons hover item-3"></div>
  <div class="icons hover item-4"></div>
  <div class="icons hover item-5"></div>
</div>

<div class="login">
		<!--<a href="login.html">Log in</a>-->
    
	<form method="post">
        <input type="submit" name = "register" class= "btn btn-primary" value = "Sign up">
        <input type="submit" name = "login" class= "btn btn-primary" value = "Login">
    </form>	
    
    <?php
        if(isset($_POST['register'])){
            header("location: register.php");
        }
    
    if(isset($_POST['login'])){
            header("location: login.php");
        }
    ?>
	</div>
		
<nav>
	<ul>
		<li><a href="index.html">Home</a></li>
		<li><a href="contact.html">Contact us</a></li>
	</ul>
</nav>


<section id="templates">

<h1>Everything you need and more...</h1>
	
	
<div class="templates_icons">
	
    <div class="item"><img src="images/sub-category/news.jpg">
	<div class="img-text"><a href="post_master.php">News</a></div>
	</div>
	
	<div class="item"><img src="images/sub-category/rent.png">
	<div class="img-text"><a href="#">renting a house</a></div>
	</div>
	
	<div class="item"><img src="images/sub-category/job.png">
	<div class="img-text"><a href="#">finding a job</a></div>
	</div>
	
	<div class="item"><img src="images/sub-category/car.png">
	<div class="img-text"><a href="#">buying a car</a></div>
	</div>
	
	<div class="item"><img src="images/sub-category/carpool.png">
	<div class="img-text"><a href="#">looking for a ride</a></div>
	</div>
	
	<div class="item"><img src="images/sub-category/chat.png">
	<div class="img-text"><a href="#">Wanna chat?</a></div>
	</div>

    </div>

</section>


  
	<footer id="footer" class="footer-info">

			
			<p class="footer-links">
				<a href="#">Home</a>
				·
				<a href="#">About</a>
				·
				<a href="mailto:webmaster@example.com">Email</a>
				·
				<a href="tel:555-555-5555">Call us</a>
			</p>

			<p class="footer-company-name"> &copy; 2018</p>
	</footer>


</body>
</html>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>The londoners</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
    <link rel = stylesheet href="index.css">
</head>
<body>
<!--the first nav with login signup and logo-->
<nav class ="navbar navbar-dark bg-dark" style="margin:0;">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">The Londoners</a>
    </div>
    <div class="container-fluid">
    <ul class="nav navbar-nav navbar-right">
        
            <li><a href = "register.php"><span class="glyphicon glyphicon-user"></span>Sign Up</a></li>
            <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span>Login</a></li>
        
    </ul>
  </div>
</nav>
    
    <!--Search bar with picture and search bar-->
<div id = "header" class = "jumbotron big-banner" style="height:350px;margin:0;">
<div class = "container">   
     <p class = "text-center" style = 'color:white;'>"Everything You Want and More !"</p>
   <input type = "text" placeholder = "Search...." id = "search" name = "search" class = "form-control">
</div> 	
   
</div>
    
    <!--the second and main nav-->
     <nav class = "navbar navbar-inverse">
    <div class="container-fluid">
   
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#">About-Us</a></li>
      <li><a href="#">Contact-Us</a></li>
    </ul>
  </div>
</nav>
    
<?php
    
    display_data();
    
    function display_data(){

	
	 $db = new mysqli('localhost','londoners','London123!','Londoners');
	 
	 
	 $query = "select * from category_master;";
	 

	 if($db->query($query) == true){
      
		$rs = $db->query($query); 
			if($rs->num_rows > 0){
				$category = array();
			   while($row = $rs->fetch_assoc()){
				  array_push($category,$row);
				  //print_r(category[0]);
			   }

			}else{
				echo "No threads to display";
				return;
				
			};
			
		}else{
			echo "Connection error";
			exit;
		}  
     
		$category_len = count($category);
		
		for($i = 0; $i < $category_len; $i++){
			echo "<div id = 'category".$i."' class = 'jumbotron'>";
			echo "<b><a href = 'post_master.php'<p class = 'this'>".$category[$i]['name']."</p></a></b>";
			echo "<p class = 'this'><b>Date posted: </b>".$category[$i]['created_datetime']."</p>";
			echo "<p id = '".$i."' class = 'text-muted'>".$category[$i]['description']."</p>";
			echo "</div>";
		}
		
        
  
	}
?>
    
    

</body>
</html>

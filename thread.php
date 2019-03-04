<?php
  session_start();

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['new_thread'])){
      if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==  true){
          header("location:login.php");
      }
  }
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
    <script src ="js/angular.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>The londoners</title>
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
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

<nav>
	<ul>
		<li><a href="index.html"></a></li>
		<li><a href="thread.php"></a></li>
		<li><a href="member.html"></a></li>
		<li><a href="contact.html"></a></li>
	</ul>
</nav>
	
    
<section id="templates">

<?php
$_SESSION['thread_post_id'] = $_GET['id'];
//echo $_SESSION['thread_post_id'];
require_once("dbOperations.php"); 
	


//echo  $id ;

if (isset($_POST['new_thread'])){
	$err_message = array();

	 $thread = trim($_POST['thread']);
	 if (empty($thread)){
		 echo $err_message = "<p style = 'color:red;'>Sorry, the thread cannot be empty</p></br>";
	 }else{
		 //$_SESSION['thread'] = $thread;
		 
		 save_thread($thread);
		 display_data();
	 }

}else{
	display_data();
}

function display_data(){

	
	 $db = new mysqli('localhost','londoners','London123!','Londoners');
	 
	 
	 $query = "select * from member_profile INNER JOIN post_threads
	           ON post_threads.member_id = member_profile.member_id where post_threads.post_master_id = ".$_SESSION['thread_post_id'] .";";
	 

	 if($db->query($query) == true){
      
		$rs = $db->query($query); 
			if($rs->num_rows > 0){
				$thread = array();
			   while($row = $rs->fetch_assoc()){
				  array_push($thread,$row);
				  //print_r($thread[0]);
			   }

			}else{
				echo "No threads to display";
				return;
				
			};
			
		}else{
			echo "Connection error";
			exit;
		}  
     
		$thread_len = count($thread);
		echo  "<div class = 'container'>";
		for($i = 0; $i < $thread_len; $i++){
			echo "<div id = 'thread".$i."' class = 'jumbotron'>";
			echo "<b><p class = 'this'>Posted by :".$thread[$i]['first_name']."</p></b>";
			echo "<p class = 'this'><b>Date posted: </b>".$thread[$i]['thread_created_date']."</p>";
			echo "<p id = '".$i."' class = 'text-muted'>".$thread[$i]['thread_data']."</p>";
			echo "</div>";
		}
		echo "</div>";
	}
		
?>
</section>
  <form method = "post">
           <h2 class = "text-muted">Start a new thread</h2>
		   <textarea id = "threadArea" rows = '5' cols = '100' name="thread" class = "form-control"></textarea></br></br>
		   
		   <input type = "submit" name = "new_thread" value = "Post Thread" class = 'btn btn-primary'/>
		   <input type = "submit" id = "red_posts" name = "red_posts" value = "back" class = 'btn btn-primary'/>
	</form>
	        
	
	<?php
   
      if(isset($_POST['red_posts'])){
		header("location: http://localhost/app/post_master.php");
	  }

	   function save_thread($thread){
			  $db1= new mysqli('localhost','londoners','London123!','Londoners');
			  
				$qry = "insert into post_threads (post_master_id,member_id,previous_thread_id,thread_data) values (".$_SESSION['thread_post_id'].",".$_SESSION['id'].",1,'".$thread."');";
		

			  if($db1->query($qry) !== true){
				//echo $_SESSION['id'];
				echo "<p style = 'color:red;'>Error in posting! Please try again.</p></br>";
                  echo $db1->error;
				
			  }else{
				echo "<p style = 'color:green;'>New thread created</p></br>";
				}
				
		 }
		 

     ?>			
  
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
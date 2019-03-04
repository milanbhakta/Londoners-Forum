<?php
  session_start();
?>

<?php
  if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['btn_new_post'])){
      if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==  true){
          header("location:login.php");
      }
  }
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
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
		<li><a href="post.html"></a></li>
		<li><a href="member.html"></a></li>
		<li><a href="contact.html"></a></li>
	</ul>
</nav>
	
<section id="templates">
<form method="post">
        <input type = "submit" name = "logout" class = "btn btn-primary" value = "logout"/>
    </form>
    
<?php
       if(isset($_POST['logout'])){
           header("location:logout.php");
       }
    ?>
<header>
    
<h2> Category Header</h2>
	

</header>

<!-- 	
<div class="templates_icons">
  
   
    <div class="item"><img src="images/sub-category/news.jpg">
	<div class="img-text"><a href="#"></a>News</div>
	</div>
	
	<div class="item"><img src="images/sub-category/rent.png">
	<div class="img-text"><a href="#"></a>renting a house</div>
	</div>
	
	<div class="item"><img src="images/sub-category/job.png">
	<div class="img-text"><a href="#"></a>finding a job</div>
	</div>
	
	<div class="item"><img src="images/sub-category/car.png">
	<div class="img-text"><a href="#"></a>buying a car</div>
	</div>
	
	<div class="item"><img src="images/sub-category/carpool.png">
	<div class="img-text"><a href="#">looking for a ride</a></div>
	</div>
	
	<div class="item"><img src="images/sub-category/chat.png">
	<div class="img-text"><a href="#">Wanna chat?</a></div>
	</div>

    </div>
	<button id="btnMore">more </button>
-->	

</section>

<div id="container">
<?php 
  $category_id = 1;
	require_once("dbOperations.php"); 
	 
	if (isset($_POST['btn_new_post']))
{

formPostAdd($category_id ,'','');
	
}

else if (isset($_POST['btn_post_save']))
{

formPostSave($category_id );
	
}
else if (isset($_POST['btn_view_back']))
{

  header("Location: index.php");
    exit;
	
}
else  
{
	formDisplayPosts($category_id);
}



function formDisplayPosts($category_id){


	 // get the selected contact details
	 
	 $rs = getPostsByCategoryID($category_id ) ;
	
		// $row = $rs->fetch_assoc();

?>
			 <form action ="./post_master.php" method ="POST">
			 
 <h3>Posts </h3>
 <table style ="background-color:white;  width:100% ; border: 2px solid green">
 
 <?php 
	 
	 if ($rs->num_rows > 0)
     {
		 while ($row = $rs->fetch_assoc())
         { ?>
            
			<tr>
			
			<td colspan=2><h4><a href = <?php echo "thread.php?id=". $row['post_master_id'] ;?>  name=  <?php echo $row['post_master_id']; ?> ><?php echo $row['post_heading'];  ?> </a></h4> </td>
			 <tr><td> </td></tr>
			</tr>
			<tr><td><b> Posted By : <?php echo $row['first_name'] . ' '.$row['last_name'];  ?></b></td>
			<td><b><?php echo $row['post_date'];  ?></b></td></tr>
			<tr>
			
			<td colspan =2><?php echo $row['contents']; ?></td>
			</tr>
			<tr>
			
			<td colspan =2><hr></td>
			</tr>
<?php }} ?>

 
 </table>
 <br><br>
 <?php 
 $_SESSION['user_type']  ='mbr';
if ($_SESSION['user_type'] =='mbr') { ?>

 <input type="submit" name="btn_new_post" value="Write a new Post" class = "btn-success"> &nbsp;
<?php } ?>
<input type="submit" name="btn_view_back" value="Back">
			</form>

	

<?php  } ?>


<?php 

function formPostAdd($category_id ,$heading ,$contents)
{ ?>
	<form method="POST" action="post_master.php" >
	<div  width="100%" height="100%"  >
	 <h2> New Post Entry Page </h2>
	
	 <br>
				
	 <label for="heading">Heading</label>  <br>
		<input type="text" size="100"  id ="txtheading" name="txtheading" value= "<?php echo  $heading ?>"></input>
		<br>
				 <br>  

				 <label for="txtContents">Content</label><br>
		<textarea id="txtContents" name="txtContents" rows="7" cols="125" maxlength="65530"  width ="100%"><?php echo  $contents ?></textarea>
		<br>
				 		
				 
				 <br>
				 
				 <input type="submit" name ="btn_post_save" value="Save" />
				 <input type="submit" name ="Cancel" value="Cancel"/>
				 <br>
			</div>
		 </form>
	<?php

}
?>
<?php 
function formPostSave($category_id ){
	
	$error_formAdd_msg = validate_formAdd_fields();
	if (count($error_formAdd_msg) > 0){
					display_error($error_formAdd_msg);
					// if error stay on page 2 with user data 
					//form_next($_POST['notes'], strtolower(pathinfo($_FILES['pic']['name'])));
					formPostAdd($category_id,$_POST['txtheading'], $_POST['txtContents']);
	}
	else{
			//if page 2 validation success , upload image and save data to db .
	save_data($category_id);
	// if save success  show summary page

	formDisplayPosts($category_id);
//display_success();
	}
}


?>
<?php
function save_data($category_id){
	
	$db_conn = dbconnect(DBHOST, DBDB, DBUSER, DBPW);
$qry = "INSERT INTO post_master (member_id,category_id , location_id,post_heading,contents,post_date, 
          approved_by,approved_date,post_active,post_inactive_date,post_viewer_action_id,comments) 
         values(".$_SESSION['id'].", '".$category_id."',1,'".$_POST['txtheading']."',
         '".$_POST['txtContents']."', current_timestamp,1,current_timestamp,'Y',current_timestamp,1,'test');";
	
//.$_SESSION['id']
//$db_conn->query($qry);
    
    if($db_conn->query($qry)!==true){
        echo $db_conn->error;
    }
    
//get PK from table
$post_id  = mysqli_insert_id($db_conn);   

return $post_id;

}
?>


<?php 
  // validate page 1
function validate_formAdd_fields(){
    $error_msg = array();
     
    //Name validation
	if (!isset($_POST['txtheading'])){
		$error_msg[] = " Heading field not defined";
	} else if (isset($_POST['txtheading'])){
		$heading = trim($_POST['txtheading']);
		if (empty($heading)){
			$error_msg[] = "The  Heading field is empty";
		} else {
			if (strlen($heading) >  100){
				$error_msg[] = "The  heading field contains too many characters";
			}
		}
    }
    
    if (!isset($_POST['txtContents'])){
			$error_msg[] = " Notes field not defined";
		} else if (isset($_POST['txtContents'])){
			$txtContents = trim($_POST['txtContents']);
			if (empty($txtContents)){
				$error_msg[] = "The  Contents field is empty";
			} else {
				if (strlen($txtContents) >  65535){
					$error_msg[] = "The   Contents field contains too many characters";
				}
			}
			}
    
    
/*	if (count($error_msg) == 0){
       // if no error store session 
        store_form1_session( $name, $age);         
	} */
	return $error_msg;
} ?>

<?php function display_error($error_msg){
	echo "<p>\n";
	foreach($error_msg as $v){
		echo $v."<br>\n";
	}
	echo "</p>\n";
} ?>

</div>
  
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

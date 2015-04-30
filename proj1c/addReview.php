<!DOCTYPE html>
<html>
<head>
<style>
#header{
	background-color:black;
	color:white;
	text-align:center;
	padding:5px;
}

#nav{
	line-height:30px;
    background-color:#eeeeee;
    height:600px;
    width:270px;
    float:left;
    padding:5px;
}
#section {
    width:600px;
    float:left;
    padding:10px;	 	 
}
#footer {
    background-color:black;
    color:white;
    clear:both;
    text-align:center;
   padding:5px;	 	 
}
</style>
</head>
<body>

<div id="header">
<h1>CS143 Project1C</h1>
</div>

<div id="nav">
<h2>Add New Content:</h2>
<ul style="list-style-type:disc">
	<li><a href="./addActorDirector.php">Add Actor/Director</a></li>
	<li><a href="./addMovie.php">Add Movie Infomation</a></li>
	<li><a href="./addReview.php">Add Comments To Movie</a></li>
	<li><a href="./addMovieActor.php">Add Movie/Actor Relation</a></li>	
	<li><a href="./addMovieDirector.php">Add Movie/Director Relation</a></li>
</ul>

<h2>Browsering Content:</h2>
<ul style="list-style-type:disc">
	<li><a href="./actorInfo.php">Show Actor Information</a></li>
	<li><a href="./movieInfo.php">Show Movie Information</a></li>
</ul>

<h2>Search Interface:</h2>
<ul style="list-style-type:disc">
	<li><a href="./search.php">Search Actor/Movie</a></li>
</ul>
</div>

<div id="section">

<h2>Add Comment to a Movie</h2>
<form method="POST">
	Select a Movie:<select name="mid">
	<?php 
		include "exe_q.php";
		$myquery="select id, title from Movie order by title;";
		$res=query($myquery);
		if (!empty($res)) {
			while($row=mysql_fetch_row($res))
			{
				echo "<option value='".$row[0]."'>".$row[1]."</option>";
			}
			
		}
		else 
		{
			die('Invalid query: '.mysql_error());
		}
	?>
	</select>
	<input type="submit" name="submit" value="add">
</form>
<?php 
$curid=0;
if (!$_POST['submit'] && $_GET['id']) {
	$curid=$_GET['id'];
}
elseif ($_POST['mid'])
{
	$curid=$_POST['mid'];
}
$myquery="select title from Movie where id=".$curid.";";
$res=query($myquery);
$row=mysql_fetch_row($res);
echo "<h2> Create a review for movie ".$row[0]."</h2>";
?>
<form method="post">
	Your Name: <input type="text" name="name"><br>
	Rating: <select name="rating">
				<option value="1">1</option> 
				<option value="2">2</option> 
				<option value="3" selected>3</option> 
				<option value="4">4</option> 
				<option value="5">5</option> 
			</select> 5 is the best<br>
	Comment: <textarea name="comment" rows="5" cols="100"></textarea><br>
	<input type="submit" name="submit2" value="add">
</form>
<?php 
	if($_POST['submit2'])
	{
		$name=$_POST['name'];
		$rating=$_POST['rating'];
		$comment=$_POST['comment'];
		$myquery = "INSERT INTO Review (name, mid, rating, comment) VALUES ('" . $name . "'," .$curid . "," . $rating . ",'" . $comment . "');";
		query($myquery);
		
	}
?>
<br>
</div>
</body>
</html>
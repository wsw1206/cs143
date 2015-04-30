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
    width:350px;
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

<h2>Add Movie-Actor Relation</h2>
<form method="POST">
	Movie:<select name="mid">
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
	Actor:<select name="aid">
	<?php 
		$myquery="select id,first,last,dob from Actor order by first";
		$res=query($myquery);
		if(!empty($res))
		{
			while ($row=mysql_fetch_row($res))
			{
				echo "<option value='".$row[0]."'>".$row[1].", ".$row[2]." (".$row[3].")</option>";
			}
		}
		else
		{
			die('Invalid query: '.mysql_error());
		}
	?>
	</select>
	Role: <input type="text" name="role"><br>
	<input type="submit" name="submit" value="add">
</form>
<?php 
	if($_POST['submit'])
	{
		$mid=$_POST['mid'];
		$aid=$_POST['aid'];
		$role=$_POST['role'];
		if (empty($role)) {
			$role="Unknown";
		}
		$myquery="insert into MovieActor values(".$mid.",".$aid.",'".$role."');";
		$res=query($myquery);
		if (!$res) {
			echo "<b> Failed to add!</b>";
		}
		else 
		{
			echo "<b> Success to add!</b>";
		}

	}
?>
</div>
</body>
</html>
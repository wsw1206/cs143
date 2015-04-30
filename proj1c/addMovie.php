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
<h2>Add new movie</h2>
<form method="POST">
	Movie Title:<input type="text" name="title"><br>
	Release Year:<input type="text" name="year"><br>
	Production Company:<input type="text" name="company"><br>
	MPAA Rating:
	<?php //rating select
		include 'exe_q.php';
		$myquery="select rating from Movie group by rating;";
		$result=query($myquery);
		if (!$result)
		{
			//die('Invalid query: '.mysql_error());
			echo "500 Internal Server Error<br>";
			die('The server encountered an internal error or misconfiguration and was unable to complete your request.');
		}
		echo "<select name='rating'>";
		while ($cur=mysql_fetch_row($result)) {
			echo "<option value='".$cur[0]."'>".$cur[0]."</option>";
		}
		echo "</select>"
		
	?>
	<br>
	Genre(s):<br>
	
	<?php        //gener table
		$myquery = "SELECT genre FROM MovieGenre GROUP BY genre;";
		$result = query($myquery, $db_connection);
		if (!$result)
		{
			//die('Invalid query: '.mysql_error());
			echo "500 Internal Server Error<br>";
			die('The server encountered an internal error or misconfiguration and was unable to complete your request.');
		}
		echo "<table border='1px'>";
		$done=FALSE;
		$num=0;
		
		while (!$done) {
			echo "<tr>";
			while ($num<5) {
				
				if($cur=mysql_fetch_row($result))
				{
					echo "<td>";
					echo '<input type="checkbox" name="genre[]" value="'.$cur[0].'">'.$cur[0];
					echo "</td>";
					$num++;
				}
				else 
				{
					$done=TRUE;
					break;
				}
			}
			echo "</tr>";
			$num=0;
		}
	?>
	</table>
	<br>
	<input type="submit" name="submit" value="Submit">
</form>
<?php 
	if($_POST['submit']){
		$title=$_POST['title'];
		$year=$_POST['year'];
		$company=$_POST['company'];
		$rating=$_POST['rating'];
		$myquery="select * from MaxMovieID;";
		$result=query($myquery);
		if(is_resource($result))
		{
			$cur=mysql_fetch_row($result);
			$nowid=$cur[0];
			$maxid=$nowid+1;
		}
		$myquery="insert into Movie values(".$maxid.",\"".$title."\",".$year.",\"".$rating."\",\"".$company."\");";
		$result=query($myquery);
		if ($result) {
			echo "<b>Sucessfully added Movie!</b><br>";
			$myquery="update MaxMovieID set id=".$maxid." where id=".$nowid.";";
			$result=query($myquery);
			if (!$result) {
				echo "<b>Failed update MaxMovieID!</b>";
			}
			
			if($_POST['genre'])
			{
				foreach ($_POST['genre'] as $key => $value)
				{
					$myquery="insert into MovieGenre values(".$maxid.",\"".$value."\");";
					$result=query($myquery);
					if(!$result)
					{
						echo "<b>Failed in Genre</b>";
					}
				}
				echo "<b>Sucessfully added Genre!</b>";
			}
		}
		else 
		{
			echo "<b>Sorry bro, bad SQL. Maybe invalid syntax, or the command violated a CHECK constraint. Bummer.</b>";
		}
	}	
?>

</div>
</body>
</html>
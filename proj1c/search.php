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
    width:500px;
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
<h2>Search</h2>
<form method="post">
<input type="text" name="search">
<input type="submit" name="submit" value="search an Actor/Movie">
</form>
<?php 
	include 'exe_q.php';
	if($_POST['submit'])
	{
		$search=$_POST['search'];
		$searchitem=explode(" ", $search);
		if (!search || count($searchitem)==0) {
			echo "<b>Nothing in search terms</b>";
			exit(1);
		}
		//search Actor
		$myquery="select id, first, last, dob from Actor where first like '%".$searchitem[0]."%' or last like '%".$searchitem[0]."%' ";
		for($i=1;$i<count($searchitem);$i++)
		{
			$myquery.="or first like '%".$searchitem[$i]."%' or last like '%".$searchitem[$i]."%' ";
		}
		$myquery.=" order by first";
		$res=query($myquery);
		if (!empty($res)) {
			echo "<h2> Actor</h2>";

			while ($row=mysql_fetch_row($res))
			{
				echo "<b>Actor:  <a href='actorInfo.php?id=".$row[0]."'>".$row[1].", ".$row[2]."(".$row[3].")</a></b><br>";
			}
		}
		else
		{
			echo "Failed to found Actor";
		}
		//search Movie
		$myquery="select id, title, year from Movie where title like '%".$searchitem[0]."%' ";
		for($i=1;$i<count($searchitem);$i++)
		{
		$myquery.="or title like '%".$searchitem[$i]."%' ";
		}
		$res=query($myquery);
		if (!empty($res)) {
		echo "<h2> Movie</h2>";
		
			while ($row=mysql_fetch_row($res))
					{
		echo "Movie:  <a href='movieInfo.php?id=".$row[0]."'>".$row[1].", ".$row[2]."(".$row[3].")</a><br>";
			}
		}
		else 
		{
			echo "Failed to found movie";
		}
	}
?>
</div>
</body>
</html>
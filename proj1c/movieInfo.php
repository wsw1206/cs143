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
    height:1000px;
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

<h2>Movie Information</h2>
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
	<input type="submit" name="submit" value="search">
</form>
<br>
<?php 
	$curid=0;
	if (!$_POST['submit'] && $_GET['id']) {
		$curid=$_GET['id'];
	}
	elseif ($_POST['mid'])
	{
		$curid=$_POST['mid'];
	}
	if($curid){
	$myquery="select title,year,rating,company from Movie where id=".$curid.";";
	$res=query($myquery);
	if(!$res)
	{
		echo "Fail to search movie";
		exit(1);
	}
	$row=mysql_fetch_row($res);
	echo "<b> Search ".$row[0]." (".$row[1].")</b>";
	echo "<h2> Movie Information </h2>";
	echo "title:  ".$row[0]."<br>";
	echo "Year:   ".$row[1]."<br>";
	echo "Rating :  ".$row[2]."<br>";
	echo "Company:  ".$row[3]."<br>";
	
	echo "<br>";
	//show role information
	$myquery="select distinct aid,role from MovieActor where mid=".$curid.";";
	$res=query($myquery);
	if(!$res)
	{
		echo "Fail to search actor";
		exit(1);
	}
	echo "<h3>Actors in this movie:</h3>";
	while($row=mysql_fetch_row($res))
	{
		$myquery="select last,first from Actor where id=".$row[0].";";
		$res2=query($myquery);
		if ($row2=mysql_fetch_row($res2)) {
			echo "<a href='./actorInfo.php?id=".$row[0]."'>".$row2[1].", ".$row2[0]."</a> played a role of ".$row[1]."<br>";
		}	
	}
	//review
	echo "<br>";
	echo "<a href='./addReview.php?id=".$curid."'> Add a review</a>";}
	//show review
	$myquery="select count(*) ,avg(rating) from Review where mid=".$curid.";";
	$res=query($myquery);
	if(!$res)
	{
		echo "Fail to search review";
		exit(1);
	}
	echo "<h3>Users' Review</h3>";
	$row=mysql_fetch_row($res);
	echo $row[0]." reviews in summery.<br>";
	if ($row[1]==NULL) {
		$row[1]="*";
	}
	echo "The average rate:  ".$row[1]."<br><br><br>";
	$myquery="select name,time, rating,comment from Review where mid=".$curid." order by time DESC;";
	$res=query($myquery);
	while ($row=mysql_fetch_row($res))
	{
		if ($row[0]==NULL) {
			$row[0]="Anonymous";
		}
		echo $row[0].": ";
		echo " Rating:".$row[2];
		echo " at time ".$row[1]."<br>";
		echo "<p>".$row[3]."</p><br><br>";
	}
?>
</div>
</body>
</html>
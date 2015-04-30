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

<h2>Actor Information</h2>
<form method="POST">
	Actor:<select name="aid">
	<?php 
		include 'exe_q.php';
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
	<input type="submit" name="submit" value="search">
</form>
<br>
<?php 
	$curid=0;
	if (!$_POST['submit'] && $_GET['id']) {
		$curid=$_GET['id'];
	}
	elseif ($_POST['aid'])
	{
		$curid=$_POST['aid'];
	}
	if($curid){
	$myquery="select first, last, sex, dob, dod from Actor where id=".$curid.";";
	$res=query($myquery);
	if(!$res)
	{
		echo "Fail to search actor";
		exit(1);
	}
	$row=mysql_fetch_row($res);
	echo "<b> Search ".$row[0].", ".$row[1]." (".$row[3].")</b>";
	echo "<h2> Actor Information </h2>";
	echo "Name:  ".$row[0].", ".$row[1]."<br>";
	echo "Sex:   ".$row[2]."<br>";
	echo "Date of Birth:  ".$row[3]."<br>";
	if ($row[4]==NULL) {
		$row[4]="still alive";
	}
	echo "Date of Death:  ".$row[4]."<br>";
	echo "<br>";
	//show role information
	$myquery="select distinct mid,role from MovieActor where aid=".$curid.";";
	$res=query($myquery);
	if(!$res)
	{
		echo "Fail to search actor";
		exit(1);
	}
	while($row=mysql_fetch_row($res))
	{
		$myquery="select title from Movie where id=".$row[0].";";
		$res2=query($myquery);
		if ($row2=mysql_fetch_row($res2)) {
			echo "Played role of ".$row[1]." in movie <a href='./movieInfo.php?id=".$row[0]."'>".$row2[0]."</a><br>";
		}	
	}}
?>
</div>
</body>
</html>
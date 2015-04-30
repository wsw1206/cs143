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
<h2>Add new actor/director</h2>

<form>
<input type="radio" name="AorD" value="Actor" checked>Actor
<input type="radio" name="AorD" value="Director">Director<br>
<!-- </form> -->
<!-- <br> -->
<!-- <form method="post"> -->
First Name:<input type="text" name="first" ><br>
Last Name:<input type="text" name="last" ><br>
Sex:
<input type="radio" name="sex" value="Male" checked>Male
<input type="radio" name="sex" value="Female">Female<br>
Date of Birth:<input type="text" name="dob" ><br>
Date of Die:<input type="text" name="dod" ><br>
<input type="submit" value="Add" name="smit">
</form>


<?php 
	include 'exe_q.php';
	if (!empty($_GET['smit'])){
	$table=$_GET['AorD'];
	
	$myquery="select * from MaxPersonID;";
	$id=query($myquery);
	if (is_resource($id)) {
		$row=mysql_fetch_row($id);
		$maxid=$row[0];
		$newid=$maxid+1;
	}
	if ($table) {
		$first=$_GET['first'];
		$last=$_GET['last'];
		$sex=$_GET['sex'];
		$dob=$_GET['dob'];
		$dod=$_GET['dod'];
		if($dod=="NULL" || !$dod){$dod=",NULL";}
		else{$dod=",\"".$dod."\"";}
		if($table=="Actor"){
		$myquery="insert into ".$table." values(".$newid.",\"".$last."\",\"".$first."\",\"".$sex."\",\"".$dob."\"".$dod.");";}
		else{
			$myquery="insert into ".$table." values(".$newid.",\"".$last."\",\"".$first."\",\"".$dob."\"".$dod.");";
		}


		$res=query($myquery);
		if ($res) {
                print "<b>Sucessfully added Actor/Director!</b>";

                //Updating the maxID now
                $updateIDQuery = "UPDATE MaxPersonID SET id = ".$newid." WHERE id = " . $maxid.";";
                $updateIDresult = query($updateIDQuery);
                if(!$updateIDresult)
                {
                    print "Failed to update ID. Further updates will likely fail.";
                }

            } else {
                    print "<b>Sorry bro, bad SQL. Maybe invalid syntax, or the command violated a CHECK constraint. Bummer.</b>";
            }


	}}
	
?>
</div>
</body>
</html>
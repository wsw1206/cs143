<!DOCTYPE html>
<html>
<head>
<title> Test Database </title>
</head>

<body>

<h1> Test </h1>
<p> Type the query</p>

<form method="POST">
<textarea name="que" rows="6" cols="80"></textarea>
<input type="submit">
</form>
<?php
    $q=$_POST['que'];
    if($q != ""){
        $handle = mysql_connect("127.0.0.1", "root","");
        mysql_select_db("TEST",$handle);
        $res = mysql_query($q,$handle);
        $error = mysql_error();
        if(is_resource($res)){
            $head=mysql_num_fields($res);
            
            print '<table border="1" >';
            print '<tr>';
            while($field = mysql_fetch_field($res)){
                
                
                    print '<th>'.$field->name.'</th>';
                    
                
                
                
            }
            print '</tr>';
            while($row = mysql_fetch_row($res)) {
                print '<tr>';
                foreach($row as $i){
                        print '<td>'.$i.'</td>';
                    
                }
                print '</tr>';
            }
            print '</table>';
            
        }else if  ($rs) {
            // INSERT/UPDATE/DELETE was successful
            print "<b>Successfully added Actor/Direcor! Rejoice!</b>";
        } else {
            // invalid SQL query
            print "<b>Sorry bro, bad SQL. Maybe invalid syntax, or the command violated a CHECK constraint. Bummer.</b>";
        }
        mysql_close($handle);
    }
    ?>




</body>


</html>


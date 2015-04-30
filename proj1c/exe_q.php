<?php
	function query($query_string){
		$db_connection = mysql_connect("127.0.0.1","root","");
		if (!$db_connection) {
			$err = mysql_error($db_connection);
			print "connection failed: $err <br />";
			exit(1);
		}
		
		mysql_select_db("TEST",$db_connection);
		
		mysql_query("USE TEST;");
		$res=mysql_query($query_string,$db_connection);
		if (is_resource($res)) {
			return $res;
		}
		elseif ($res){
			return TRUE;
		}
		else {
			return FALSE;
		}
		mysql_close($db_connection);
	}
?>
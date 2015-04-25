<!DOCTYPE html>
<html>

<head>
<title>Calculator</title>
</head>

<body>
<h1> Calculator</h1>

<p> Exercise </p>

<form method="POST">
<input type="text" name="expr">
<input type="submit">
</form>

<h1> Result </h1>

<?php
    $expr=$_POST['expr'];
    if($expr != "")
    {
        $input_expr = $expr;
        $result = 1;
//        if(preg_match('/\/0$/', $expr))
//        {
//            $result = 0;
//        }
        if(preg_match("/\/0[^\.]*/", $input_expr))
        {
            $result = 0;
        }
        if($result)
        {
            echo $input_expr;
            echo "=";
            $expr=str_replace("--", "+", $expr);
            eval("echo $expr;");
        }
        else
        {
            echo "Invalid input";
        }
    }
?>






</body>
</html>

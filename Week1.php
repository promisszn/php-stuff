<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
// Range Function
function ranging(int $start = 0, int $end = 1) {
    $result = [];

    while($start <= $end) { 
       array_push($result, $start); 
       $start++;
    }

    return $result;
}

 //Sum Function
function sum($numArray) {
    $total = 0;
    $numArrayLength = count($numArray);

    for ($i=0; $i < $numArrayLength; $i++) { 
        $total += $numArray[$i];
    }

    return $total;
}
//calling range function    
print_r(ranging(5, 15));
    
echo '<br><br>';
//calling sum function    
print_r(sum(ranging(5,15)));
?>

    
</body>
</html>

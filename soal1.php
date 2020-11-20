<?php

$a = [4, 9, 7, 5, 8, 9, 3];

function swap($a,$x) {
	if( count($a)-1 > $x ) {
		$b = array_slice($a,0,$x,true);
		$b[] = $a[$x+1];
		$b[] = $a[$x];
		$b += array_slice($a,$x+2,count($a),true);
		return($b);
	} else { return $a; }
}

$i =0;
$count = count($a);

while($i<$count){
        if($count-1!==$i){
            if($a[$i]>$a[$i+1]){
                $newArr = array();
                $newArr = swap($a,$i);
              echo $i."=>";
              print_r(swap($a,$i));
                
                repeat($newArr,$i,$count);
            }else{
                $i++;
            }
        }
    }

function repeat($newArr,$i,$count){
    while($i<$count){
        if($count-1!==$i){
            if($newArr[$i]>$newArr[$i+1]){
                $newArr = swap($newArr,$i);
                 echo $i."=>";
                print_r(swap($newArr,$i));
                
                repeat($newArr,$i,$count);
            }else{
                $i++;
            }
        }
    }
}

?>
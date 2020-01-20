<?php

    $str = "match any decimal digit ranging from 0 through 3, or the range the ";

    if(preg_match('/[0-9]/', $str)){            // same for alphabets - [a-zA-Z]
        echo "Digit Found <br>";
    }
    else{
        echo "Digit Not found <br>";
    }

    if(preg_match('/DIGIT/i', $str, $arr)){         // i - case insensitive
        echo "Word Found <br>";
        print_r($arr);
    }else {
        echo "Word Not Found <br>";
    }

    $str2 = "cyberccom creeeation";

    if(preg_match('/c{2}/', $str2)){            // match sequence of char
        echo "<br> word found where c comes 2 times in sequence";
    }else {
        echo "<br> Word contains 2 time c not mathces in sequence";
    }

    if(preg_match('/e{2,3}/', $str2)){          //match sequence 2/3 times
        echo "<br> word found where sequence of e 2/3 times";
    }
    else{
        echo "<br> No sequence of e Found";
    }
?>
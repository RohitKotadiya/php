<?php

    $url = "E:/Cybercom Creation/GIT Commands";

    $myFile = fopen($url, "r") or exit("Error Occured !");

    echo "<strong>File Data</strong><br>";

    echo fread($myFile, filesize($url));

    fclose($myFile);

    $filePath = "E:/GLS/DS_&_ML/DataSets/breast_cancer_dataset.csv";
    $myFile2 = fopen($filePath, "r") or die("Path not Found");

    echo "<br><strong> Read File Line by line </strong><br>";

    while(true){
        if(! feof($myFile2)):
            echo fgets($myFile2)."<br>";
        else:
            exit("No More Records Found!");
        endif;    
    }
    fclose($myFile2);
?>
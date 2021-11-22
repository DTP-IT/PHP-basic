<?php
function checkValidString($string, $keyWord1, $keyWord2) 
{
    if ((strpos($string, $keyWord1) && !strpos($string, $keyWord2)) || (!strpos($string, $keyWord1) && strpos($string, $keyWord2))) {
        return true;
    } else {
        return false;
    }
}

function checkValidFile($fileName, $keyWord1, $keyWord2) 
{
    $readFile = file_get_contents($fileName);
    if(checkValidString($readFile, $keyWord1, $keyWord2)) {
        echo "Chuỗi hợp lệ. Chuỗi bao gồm: ".count(explode('.', $readFile))." câu";
    } else {
        echo "Chuỗi không hợp lệ";
    }
}

//Bài 1
var_dump(checkValidString(file_get_contents('file1.txt'), "book", "restaurant"));// bool(true)
var_dump(checkValidString(file_get_contents('file2.txt'), "book", "restaurant"));// bool(false)

//Bài 2
checkValidFile('file1.txt', 'book', 'restaurant'); //Chuỗi hợn lệ. Chuỗi bao gồm: 5 câu
checkValidFile('file2.txt', 'book', 'restaurant'); //Chuỗi không hợp lệ
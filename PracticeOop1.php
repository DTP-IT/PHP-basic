<?php
class ExerciseString
{
    public $check1;
    public $check2;

    public function readFile($fileName)
    {
        $readFile = file_get_contents($fileName);

        return $readFile;
    }
    public function checkValidString($string, $keyWord1, $keyWord2) 
    {
        if ((strpos($string, $keyWord1) && !strpos($string, $keyWord2)) || (!strpos($string, $keyWord1) && strpos($string, $keyWord2))) {
            return true;
        } else {
            return false;
        }
    }
    public function writeFile()
    {
        $myFile = fopen("result_file.txt", "w") or die("Unable to open file!");
        if ($this->check1 == true) {
            fwrite($myFile, "check1 là chuỗi hợp lệ\n");
        }  else {
            fwrite($myFile, "check1 là chuỗi không hợp lệ\n");
        }

        if ($this->check2 == true) {
            fwrite($myFile, "check2 là chuỗi hợp lệ\n");
        }  else {
            fwrite($myFile, "check2 là chuỗi không hợp lệ gao gồm ".(count(explode('.', 'fil2.txt'))-1)." câu");
        }
        fclose($myFile);
    }
}
$object1 = new ExerciseString();
$string1 = $object1->readFile("file1.txt");
$object1->check1 = $object1->checkValidString($string1, 'book', 'restaurant');
$string2 = $object1->readFile("file2.txt");
$object1->check2 = $object1->checkValidString($string2, 'book', 'restaurant');

var_dump($object1->check1 = $object1->checkValidString($string1, 'book', 'restaurant')); //bool(true)
var_dump($object1->check2 = $object1->checkValidString($string2, 'book', 'restaurant'));//bool(false)

$object1->writeFile();
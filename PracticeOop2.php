<?php
trait Active
{
    public function getClass()
    {
        return get_class($this);
    }
}
abstract class Country
{
    protected $slogan;

    public function sayHello()
    {

    }
}

interface Boss
{
    public function checkValidSlogan();
}

class EnglandCountry extends Country implements Boss
{
    use Active;
    public function setSlogan($input)
    {
        $this->slogan = $input;
    }
    public function sayHello()
    {
        echo "Hello";
    }
    public function checkValidSlogan()
    {
        if (strlen(strstr($this->slogan, 'England') || strstr($this->slogan, 'english')) > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function defindYourSelf()
    {
        return $this->getClass();
    }
}

class VietNamCountry extends Country implements Boss
{
    use Active;

    public function setSlogan($input)
    {
        $this->slogan = $input;
    }
    public function sayHello()
    {
        echo "Xin chao";
    }
    public function checkValidSlogan()
    {
        if (strlen(strstr($this->slogan, "Vietnam") && strstr($this->slogan, "hust")) > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function defindYourSelf()
    {
        return $this->getClass();
    }

}

$englandCountry = new EnglandCountry();
$vietnamCountry = new VietnamCountry();

$englandCountry->setSlogan('England is a country that is part of the United Kingdom. It shares land borders with Wales to the west and Scotland to the north. The Irish Sea lies west of England and the Celtic Sea to the southwest.');
$vietnamCountry->setSlogan('Vietnam is the easternmost country on the Indochina Peninsula. With an estimated 94.6 million inhabitants as of 2016, it is the 15th most populous country in the world.');

$englandCountry->sayHello(); // Hello
echo "<br>";
$vietnamCountry->sayHello(); // Xin chao

echo "<br>";

var_dump($englandCountry->checkValidSlogan()); // true
echo "<br>";
var_dump($vietnamCountry->checkValidSlogan()); // false

echo 'I am ' . $englandCountry->defindYourSelf(); 
 echo "<br>";
 echo 'I am ' . $vietnamCountry->defindYourSelf(); 
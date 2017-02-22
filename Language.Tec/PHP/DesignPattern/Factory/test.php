<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2017/2/16 下午9:22
 */
namespace Factory;

include './Farm.php';

use Factory\Farm;

$a = new Farm();
$animal = $a->getAnimal('horse');

var_dump($animal);
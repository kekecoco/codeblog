<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2017/2/17 下午5:27
 */

require './Prototype.php';


$a = new Prototype\Prototype();
$c = new Prototype\Prototype();

if ($a === $c) {
	print '123';
} else {
	print '456';
}

//debug_zval_dump($a);
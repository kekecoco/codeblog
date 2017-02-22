<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2017/2/16 下午9:15
 */
namespace Factory;

class Horse implements AnimalInterface {


	public function __construct()
	{
		echo 'I\'m a horse';
	}
}
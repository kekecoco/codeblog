<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2017/2/16 下午9:55
 */
namespace FactoryAbstract;

class Horse implements AnimalInterface {


	public function __construct()
	{
		echo 'I\'m a horse';
	}
}
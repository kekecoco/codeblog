<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2017/2/16 下午9:56
 */
namespace FactoryAbstract;

class Donkey implements AnimalInterface {

	public function __construct()
	{
		echo 'I\'m a donkey';
	}
}
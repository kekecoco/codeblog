<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2017/2/16 下午9:58
 */
namespace FactoryAbstract;

class Corn implements PlantInterface {

	public function __construct()
	{
		echo 'I\'m the corn';
	}
}
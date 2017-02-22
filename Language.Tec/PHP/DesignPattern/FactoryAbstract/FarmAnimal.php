<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2017/2/16 下午9:59
 */
namespace FactoryAbstract;

class FarmAnimal {


	public function getAnimal($type)
	{
		if (!isset($type) || $type == '') {
			return null;
		}

		if ($type == 'horse') {
			return new Horse();
		} elseif ($type == 'donkey') {
			return new Donkey();
		}
	}
}
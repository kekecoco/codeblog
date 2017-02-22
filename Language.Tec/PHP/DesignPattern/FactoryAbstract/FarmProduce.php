<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2017/2/16 下午10:03
 */
namespace FactoryAbstract;

class FarmProduce {


	public function getFarm($type)
	{
		if (!isset($type) || $type == '') {
			return null;
		}

		if ($type == 'animal') {
			return new FarmAnimal();
		} elseif ($type == 'plant') {
			return new FarmPlant();
		}
	}
}
<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2017/2/16 下午10:01
 */
namespace FactoryAbstract;

class FarmPlant {


	public function getPlant($type)
	{
		if (!isset($type) || $type == '') {
			return null;
		}

		if ($type == 'rice') {
			return new Rice();
		} elseif ($type == 'corn') {
			return new Corn();
		}
	}
}
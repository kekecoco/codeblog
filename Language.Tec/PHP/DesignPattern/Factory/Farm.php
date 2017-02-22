<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2017/2/16 下午9:18
 */
/**
 * 定义一个创建对象的接口，让其子类自己决定实例化哪一个工厂类，工厂模式使其创建过程延迟到子类进行。
 */
namespace Factory;

class Farm {

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
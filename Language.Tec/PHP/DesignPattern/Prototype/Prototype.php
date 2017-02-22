<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2017/2/17 下午5:23
 */
/**
 * 原型模式：用于实现对象的克隆。当直接创建对象的代价比较大时，可使用这种模式。
 */
namespace Prototype;

require './PrototypeAbstract.php';

class Prototype extends PrototypeAbstract {

	public $name;

	public function __set($name, $value)
	{
		$this->$name = $value;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getPrototype()
	{
		return clone $this;
	}
}
<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2017/2/17 下午5:21
 */
namespace Prototype;

abstract class PrototypeAbstract {

	public $name;
	
	abstract public function getName();
	
	abstract public function getPrototype();

}
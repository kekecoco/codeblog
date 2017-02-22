<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2017/2/21 下午6:10
 */
/**
 * 代理模式：和适配器模式的区别：适配器模式主要考虑改变对象的接口，而代理模式不能改变。
 */
namespace Proxy;

class ProxyImage {

	private $filename;

	public function __construct($filename)
	{
		$this->filename = $filename;
	}

	public function display()
	{
		$realImage = new RealImage();
		$realImage->display($this->filename);
	}
}

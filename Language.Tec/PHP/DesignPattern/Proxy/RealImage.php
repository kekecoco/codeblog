<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2017/2/21 下午6:08
 */
namespace Proxy;

class RealImage implements ImageInterface {

	public function display($filename)
	{
		echo $filename;
	}

}
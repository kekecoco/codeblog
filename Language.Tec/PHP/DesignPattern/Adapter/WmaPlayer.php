<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2017/2/21 上午11:41
 */
namespace Adapter;

class WmaPlayer implements AdvancedMediaInterface {

	public function playMp4($filename = '')
	{
		//do nothing
	}

	public function playWma($filename = '')
	{
		echo $filename;
	}

}
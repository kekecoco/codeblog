<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2017/2/21 上午11:40
 */
namespace Adapter;

class Mp4Player implements AdvancedMediaInterface {

	public function playMp4($filename = '')
	{
		echo $filename;
	}

	public function playWma($filename = '')
	{
		//do nothing
	}
}
<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2017/2/21 上午11:36
 */
namespace Adapter;

interface AdvancedMediaInterface {

	public function playMp4($filename = '');
	public function playWma($filename = '');

}
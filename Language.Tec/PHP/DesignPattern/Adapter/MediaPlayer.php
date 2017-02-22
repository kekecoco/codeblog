<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2017/2/21 上午11:52
 */
namespace Adapter;

class MediaPlayer implements MediaInterface {

	public function play($type = '', $filename = '')
	{
		if (strtolower($type) == 'mp3') {
			echo $filename;
		} elseif (strtolower($type) == 'mp4') {
			$mediaPlayer = new MediaAdapter($type);
			$mediaPlayer->player($filename);
		} elseif (strtolower($type) == 'wma') {
			$mediaPlayer = new MediaAdapter($type);
			$mediaPlayer->player($filename);
		} else {
			throw new \Exception($type.'is not supported', 400);
		}
	}
}
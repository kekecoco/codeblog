<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2017/2/21 上午11:45
 */
/**
 * 适配器模式是作为两个不兼容的接口之间的桥梁。
 */
namespace Adapter;

class MediaAdapter {

	protected $advancedMedia;
	protected $type;

	public function __construct($type)
	{
		if (strtolower($type) == 'mp4') {
			$this->advancedMedia = new Mp4Player();
		} elseif (strtolower($type) == 'wma') {
			$this->advancedMedia = new WmaPlayer();
		} else {
			throw new \Exception($type.'is not supported', 400);
		}

		$this->type = $type;
	}

	public function player($file)
	{
		if ($this->type == 'mp4') {
			$this->advancedMedia->playMp4($file);
		} elseif ($this->type == 'wma') {
			$this->advancedMedia->playWma($file);
		} else {
			return false;
		}
	}
}
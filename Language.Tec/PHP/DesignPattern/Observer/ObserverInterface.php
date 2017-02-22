<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2017/2/22 下午5:12
 */
namespace Observer;

interface ObserverInterface {

	/**
	 * 观察者更新
	 * @return mixed
	 */
	public function Update(ObserverInterface $observer);
}
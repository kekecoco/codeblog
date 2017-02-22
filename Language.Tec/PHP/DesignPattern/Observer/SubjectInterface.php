<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2017/2/22 下午5:05
 */
namespace Observer;

interface SubjectInterface {

	/**
	 * 增加观察者
	 * @param SubjectInterface $observer
	 * @return mixed
	 */
	public function Attach(SubjectInterface $observer);

	/**
	 * 移除观察者
	 * @param SubjectInterface $observer
	 * @return mixed
	 */
	public function Detach(SubjectInterface $observer);

	/**
	 * 通知观察者
	 * @return mixed
	 */
	public function Notify();
}
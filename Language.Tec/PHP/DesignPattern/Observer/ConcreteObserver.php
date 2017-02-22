<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2017/2/22 下午5:31
 */
/**
 * 观察者模式：别名：发布/订阅模式.观察者模式定义了一种一对多的依赖关系，让多个观察对象同时监听某一个主体对象。
 * 这个主体对象发生变化时，会通知所有观察对象，使他们能够自动更新自己。
 */
namespace Observer;

class ConcreteObserver implements ObserverInterface {

	/**
	 * @param ObserverInterface $observer
	 * @return string
	 */
	public function Update(ObserverInterface $observer)
	{
		return 'I get';
	}
}
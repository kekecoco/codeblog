<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2017/2/14 下午5:56
 */

/**
 * 单例模式特点：
 * 1.单例类只能有一个实例。
 * 2.单例类只能自己创建这个实例。
 * 3.单例类必须为所有对象提供这个实例。
 */

class Singleton {

	private static $instance;

	/**
	 * Singleton constructor.
	 */
	private function __construct() {}

	/**
	 * @return Singleton
	 */
	public static function getInstance()
	{
		if (!self::$instance instanceof self) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * 禁止深度复制
	 */
	private function __clone(){}

    /**
     * 禁止serialize
     */
	private function __sleep() {}

    /**
     * 禁止unserialize
     */
    private function __wakeup() {}
}
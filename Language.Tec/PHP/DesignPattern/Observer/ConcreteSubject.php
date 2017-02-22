<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2017/2/22 下午5:21
 */
namespace Observer;

class ConcreteSubject implements SubjectInterface {

	private $subject;
	private $observer = [];

	public function __get($name)
	{
		return $this->subject = $name;
	}

	/**
	 * @param SubjectInterface $observer
	 */
	public function Attach(SubjectInterface $observer)
	{
		if (!in_array($observer, $this->observer)) {
			$this->observer[] = $observer;
		}
	}

	/**
	 * @param SubjectInterface $observer
	 */
	public function Detach(SubjectInterface $observer)
	{
		if (in_array($observer, $this->observer)) {
			foreach ($this->observer as $key => $value) {
				if ($value === $observer) {
					unset($this->observer[$key]);
				}
			}
		}
	}

	/**
	 * 通知更新
	 */
	public function Notify()
	{
		foreach ($this->observer as $item) {
			$item->update($this);
		}
	}
}
<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2017/3/2 下午6:36
 */
class myIterator implements Iterator{

	private $_position = 0;
	private $arr= array(
		"firstelement",
		"secondelement",
		"lastelement",
	);

	public function rewind(){
		$this->position = 0;
	}

	public function valid()
	{
		return isset($this->arr[$this->_position]);
	}

	public function current()
	{
		return $this->arr[$this->_position];
	}

	public function key()
	{
		return $this->_position;
	}

	public function next()
	{
		++$this->_position;
	}

}

$a = new myIterator();
foreach ($a as $key=>$value) {
	var_dump($key.'='.$value);
}
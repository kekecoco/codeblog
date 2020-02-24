<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2020/2/24 10:06 AM
 */
class LRUCache {
	private $head;
	private $tail;
	private $capacity;
	private $hashmap;

	public function __construct($capacity)
	{
		$this->capacity = $capacity;
		$this->hashmap = [];
		$this->head = new Node(null, null);
		$this->tail = new Node(null, null);
		$this->head->setNext($this->tail);
		$this->tail->setPrevious($this->head);
	}

	/**
	 * @param $key
	 * @return null
	 */
	public function get($key)
	{
		if (!isset($this->hashmap[$key])) {
			return null;
		}
		$node = $this->hashmap[$key];
		if (count($this->hashmap) == 1) {
			return $node->getData();
		}
		$this->detach($node);
		$this->attach($this->head, $node);

		return $node->getData();
	}

	/**
	 * @param $key
	 * @param $data
	 * @return bool
	 */
	public function put($key, $data)
	{
		if ($this->capacity <= 0) {
			return false;
		}
		if (isset($this->hashmap[$key]) && !empty($this->hashmap[$key])) {
			$node = $this->hashmap[$key];
			$this->detach($node);
			$this->attach($this->head, $node);
			$node->setData($data);
		} else {
			$node = new Node($key, $data);
			$this->hashmap[$key] = $node;
			$this->attach($this->head, $node);
			if (count($this->hashmap) > $this->capacity) {
				$nodeToRemove = $this->tail->getPrevious();
				$this->detach($nodeToRemove);
				unset($this->hashmap[$nodeToRemove->getKey()]);
			}
		}
		return true;
	}

	/**
	 * @param $key
	 * @return bool
	 */
	public function remove($key)
	{
		if (!isset($this->hashmap[$key])) {
			return false;
		}
		$nodeToRemove = $this->hashmap[$key];
		$this->detach($nodeToRemove);
		unset($this->hashmap[$nodeToRemove->getKey()]);
		return true;
	}
	
	/**
	 * @param $node
	 */
	public function detach($node)
	{
		$node->getPrevious()->setNext($node->getNext());
		$node->getNext()->setPrevious($node->getPrevious());
	}

	/**
	 * @param $head
	 * @param $node
	 */
	public function attach($head, $node)
	{
		$node->setPrevious($head);
		$node->setNext($head->getNext());
		$node->getNext()->setPrevious($node);
		$node->getPrevious()->setNext($node);
	}
}

class Node {
	private $key;
	private $data;
	private $next;
	private $previous;

	public function __construct($key, $data)
	{
		$this->key = $key;
		$this->data = $data;
	}

	/**
	 * @param $data
	 */
	public function setData($data)
	{
		$this->data = $data;
	}

	/**
	 * @param $key
	 */
	public function setKey($key)
	{
		$this->key = $key;
	}

	/**
	 * @return mixed
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 * @return mixed
	 */
	public function getKey()
	{
		return $this->key;
	}

	/**
	 * @return mixed
	 */
	public function getNext()
	{
		return $this->next;
	}

	/**
	 * @return mixed
	 */
	public function getPrevious()
	{
		return $this->previous;
	}

	/**
	 * @param mixed $next
	 */
	public function setNext($next)
	{
		$this->next = $next;
	}

	/**
	 * @param mixed $previous
	 */
	public function setPrevious($previous)
	{
		$this->previous = $previous;
	}
}

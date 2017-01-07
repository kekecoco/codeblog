<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2016/12/28 下午5:31
 */

/**
 * 说明：PHP实现参考：https://gist.github.com/justinfay/3403846
 * rate = (capacity - tokens)/time
 */
class TokenBucket {

	/*
	 * 每秒令牌消耗率
	 */
	protected $rate;

	/*
	 * 令牌桶最大容量
	 */
	protected $capacity;

	/*
	 * 令牌生效时长
	 */
	protected $timeout;

	public function __construct($rate, $capacity, $timeout)
	{
		$this->rate     = $rate;
		$this->capacity = $capacity;
		$this->timeout  = $timeout;
	}

	/**
	 * @param $tokens
	 * @param $key
	 * @return bool
	 */
	public function tokenBucket($tokens, $key)
	{
		$redisObj = $this->getRedis();

		while (true) {
			try{
				$redisObj->watch($key.':available');
				$redisObj->watch($key.':last_time');

				$currentTime = time();

				//获取剩余令牌数
				$oldTokens = $redisObj->get($key.':available');
				$lastTime  = $redisObj->get($key.':last_time');

				if ($oldTokens === false) {
					$currentTokens = $this->capacity;
				} else {
					$currentTokens = (float)$oldTokens + (float)min(
							($currentTime-$lastTime)*$this->rate,
							$this->capacity - $oldTokens);
				}

				if ($tokens >=0 && $tokens <= $currentTokens) {
					$currentTokens -= $tokens;
					$consumes = true;
				} else {
					$consumes = false;
				}

				$redisObj->multi(Redis::PIPELINE);
				$redisObj->set($key.':available', $currentTokens);
				$redisObj->expire($key.':available', $this->timeout);
				$redisObj->set($key.':last_time', $currentTime);
				$redisObj->expire($key.':last_time', $this->timeout);
				$redisObj->exec();
				break;
			} catch (Exception $exception) {
				continue;
			} finally {
				$redisObj->discard();
			}
		}
		return $consumes;
	}

	/**
	 * @return array|false|string
	 */
	public function getIP()
	{
		if (isset($_SERVER)) {
			if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$realIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
				$realIP = $_SERVER['HTTP_CLIENT_IP'];
			} else {
				$realIP = $_SERVER['REMOTE_ADDR'];
			}
		} else {
			if (getenv("HTTP_X_FORWARDED_FOR")) {
				$realIP = getenv( "HTTP_X_FORWARDED_FOR");
			} elseif (getenv("HTTP_CLIENT_IP")) {
				$realIP = getenv("HTTP_CLIENT_IP");
			} else {
				$realIP = getenv("REMOTE_ADDR");
			}
		}

		return $realIP?$realIP:'unknown';
	}

	/**
	 * @return Redis
	 */
	protected function getRedis()
	{
		$redisObj = new Redis();
		$redisObj->connect('127.0.0.1', '6379');
		return $redisObj;
	}
}
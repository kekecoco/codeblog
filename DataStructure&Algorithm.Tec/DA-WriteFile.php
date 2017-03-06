<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2017/2/28 下午9:29
 */
/**
 * 多个进程同时写入一个文件
 */
function writeFile($filename, $content) {
	$lockFile = $filename.'.lock';
	$writeRes = null;

	while (true) {
		if (file_exists($lockFile)) {
			sleep(2);
		} else {
			$writeRes = file_put_contents($filename, $content, FILE_APPEND);
			break;
		}
	}

	if (file_exists($lockFile)) {
		unlink($lockFile);
	}
	return $writeRes;
}

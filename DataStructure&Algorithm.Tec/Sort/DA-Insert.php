<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2017/2/24 下午12:01
 */
/*
 * 名称：直接插入排序
 *
 */
function Insert(array $arr) {

	for ($i=1, $len = count($arr); $i < $len; $i++) {
		if ($arr[$i] < $arr[$i-1]) {
			//设置哨兵
			$flag = $arr[$i];
			$j    = $i;
			while (isset($arr[$j]) && $flag < $arr[$j-1]) {
				$arr[$j] = $arr[$j-1];
				$j--;
			}
			$arr[$j] = $flag;
		} else {
			continue;
		}
	}
	return $arr;
}
$oldArr = range(1, 50);
shuffle($oldArr);
$arr = Insert($oldArr);
echo '原数组:';
echo "<pre>";
var_dump($oldArr);
echo "</pre>";
echo '排序后数组:';
echo "<pre>";
var_dump($arr);
echo "</pre>";
<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2020/2/17 3:05 PM
 */
/**
 * 给一串字符串,求其最长的子串
 *
 */
function getMaxLengthSubString($subjectString) {
	$length = mb_strlen($subjectString, "utf-8");
	if ($length <= 0) {
		return 0;
	}
	$maxLength = 0;
	$containArr = [];
	for ($i = 0,$j = 0; $j < $length; $j ++) {
		if (!empty($containArr[$subjectString[$j]])) {
			$i = max($containArr[$subjectString[$j]], $i);
		}
		$maxLength = max($maxLength, $j - $i + 1);
		$containArr[$subjectString[$j]] = $j + 1;
	}
	return $maxLength;
}
$str = "abcabcbb";
var_dump(getMaxLengthSubString($str));

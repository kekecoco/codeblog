###面试日常记录
####0X01 58同城
1. 给一张表,要求按照score进行倒序排列给出具体名次并解决并列排名的问题.  
```
CREATE TABLE `players` (
  `uid` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `score` int(2) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

INSERT INTO `players` (`uid`, `name`, `score`) VALUES
(1, 'Samual', 25),
(2, 'Vino', 20),
(3, 'John', 20),
(4, 'Andy', 22),
(5, 'Brian', 21),
(6, 'Dew', 24),
(7, 'Kris', 25),
(8, 'William', 26),
(9, 'George', 23),
(10, 'Peter', 19),
(11, 'Tom', 20),
(12, 'Andre', 20);
```
```
SQL语句:
SELECT uid, name, score,
CASE
WHEN @prevRank = score THEN @currentRank
WHEN @prevRank := socre THEN @currentRank := @currentRank + 1
END AS rank
FROM players p,
(SELECT @currentRank := 0, @prevRank := NULL) r
ORDER BY SOCRE DESC;
注: := 为赋值符号; =为比较符号.
```
2. MySQL的int数据类型数据范围.    
```
Type	    Storage (Bytes)	  Minimum Value Signed	Minimum Value Unsigned	Maximum Value Signed	Maximum Value Unsigned     
TINYINT	    1	              -128	                0	                    127	                    255    
SMALLINT	2	              -32768	            0	                    32767	                65535    
MEDIUMINT	3	              -8388608	            0	                    8388607	                16777215   
INT      	4	              -2147483648	        0	                    2147483647	            4294967295   
BIGINT	    8	              -2^63	                0	                    2^63-1	                2^64-1   
注: MySQL还支持在该类型后面的括号内指定整数值的显示宽度(最大支持255).该可选显示宽度规定用于显示宽度小于指定的列宽度的值时从左侧填满宽度.
显示宽度并不限制可以在列内保存的值的范围,也不限制超过列的指定宽度的值的显示.
```
3. 取出文件的前xx行数据.
head -n 100 demo.txt
4. 


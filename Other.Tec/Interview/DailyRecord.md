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
4. 移位运算.
$a << $b	Shift left（左移）	将 $a 中的位向左移动 $b 次（每一次移动都表示“乘以 2”）。
$a >> $b	Shift right（右移）	将 $a 中的位向右移动 $b 次（每一次移动都表示“除以 2”）。
5. PHP的session存储配置.
自定义session存储: 
session.save_handler = redis
session.save_path = "tcp://127.0.0.1:6379"
注: 
1. 自定义会话管理器是有各扩展实现的.  
2. 需要使用session_set_save_handle()函数或SessionHandlerInterface类或者通过继承SessionHandler类来扩展内置的管理器,
从而达到自定义会话保存机制的目的.  
6. 字符串数组是否有版本限制.
PHP 5.5 增加了直接在字符串原型中用[]或{}访问字符的支持。   
####0X02 阿里-神马搜索(电话)
1. 序列化与反序列化对单例模式的破坏.   
序列化和反序列化时, 单例模式返回的对象会受破坏.解决办法对__sleep()和__wakeup()魔术方法做私有化限制.
2. PHP多态实现的特点.   
多态是指在面向对象中能够根据使用类的上下文来重新定义或改变类的性质或行为.
抽象类和方法:  
* 抽象类: 
  一个类中只要有一个抽象方法,则这个类就是抽象类.   
  抽象类不能直接实例化必须先实现抽象方法.
* 接口:  
  用interface声明的类.接口中所有的方法都要求是抽象方法.
  接口中所有的方法都默认是public也只能是public.
  接口中的所有方法没有方法体.
  接口没有构造函数.
* 区别:  
  抽象用于不同的事物,接口用于事物的行为.  
####0X03 贝壳找房
1. MongoDB索引与MySQL索引的区别.
* MongoDB支持的索引类型: 单字段索引, 复合索引, 多key索引, 文本索引等.
* MongoDB使用B-tree作为索引数据结构.
2. MySQL查询执行流程.
* SQL ==> 查询缓存 ==> 语法解析器 ==> 解析树 ==> 预处理器 ==> 解析树 ==> 查询优化器 ==> 查询执行引擎 ==> 返回结果
* 语法解析器: 验证SQL的语法是否合法且正确.
* 预处理器: 根据MySQL的规则进一步检查解析树是否正确.例如: 表是否存在, 数据列是否存在.
3. PHP后期静态绑定.
* 含义: static:: 不在被解析为定义当前方法所在的类,而是实际运算时计算的.
* 转发调用: 在静态调用时未指定类名的调用属于转发调用.具体指: static::, self::, parent::, forward_static_call().
* 非转发调用: 明确指定类名的静态调用和非静态调用.具体指: foo::bar(), $foo->bar().
* 非转发调用之前的类名已明确指定具体的类,所以调用的方法确定一定是属于这个类的,不需要转到别的类.转发调用就是由于前期的静态绑定导致在后面进行方法调用时可能转发到其他的类.
* 后期静态绑定的原理: 存储了一个"非转发调用"中的类名.意思是当调用一个转发调用的静态调用时,实际调用的类名是上一个非转发调用的类.
4. PHP垃圾回收机制.
* 垃圾的产生: 变量的内部成员引用了变量自身, 这种变量的循环引用最终会变为垃圾.
```
$a = [1];
$a[] = &$a;
```
* 垃圾回收准则:  
    1. 如果一个变量value的refcount减少到0,那么此value可以被释放掉,不属于垃圾.
    2. 如果一个变量value的refcount减少之后大于0,那么此zval还不能被释放掉,此zval可能成为一个垃圾.
针对第一种情况GC不会进行处理,只有第二种情况GC才会将变量收集起来.另外变量是否加入垃圾检查buffer不是根据zval的类型判断的,而是通过zval.u1.type_flag记录的,只有包含IS_TYPE_COLLECTABLE
的变量才会被GC收集.
目前垃圾只会出现在array和object两种类型中.垃圾回收只会处理这两种数据类型产生的垃圾.
* 回收过程:  
    1. 如果变量的refcount减少后还是大于0,PHP会将其放入buffer缓冲区中,等这个buffer满了之后(10000个值)再统一进行处理.
    2. 具体过程:  
        - 从buffer链表的roots开始遍历,把当前value标记为灰色,然后对当前value的成员进行深度遍历,把成员value的refcount减1,并且标记为灰色.
        - 重复遍历buffer链表,检查当前value引用是否为0,为0表示确实是垃圾,把它标为白色, 如果不为0则排除了引用全部来自自身的情况,需要再次深度遍历将refcount加1还原回去,同时标记为黑色.
        - 再次遍历buffer链表,将非白色的节点从链表中删除,最终剩下的即为垃圾,最后将这些垃圾进行清除.
####0X04 快手
1. OSI七层模型: 
 * 应用层
 * 表示层
 * 会话层
 * 运输层
 * 网络层
 * 数据链路层
 * 物理层
####0X05 新浪微博
1. MySQL binlog日志的三种格式:
 * statement: 每一条会修改数据的SQL都会记录在binlog中.
 * Row: 不记录SQL语句上下文的相关信息,仅保存哪些记录被修改.(仅需要记录一条数据被修改成了什么)
 * mixed level: 是以上两种格式混合使用, 一般的语句修改使用statement格式保存binlog,如一些函数的使用, statement无法完成主从复制的操作.
 需要使用row格式保存binlog.
2. register_shutdown_function():
 * 注册一个会在PHP终止时执行的函数.
 * 注册一个callback, 它会在脚本执行完成之或者exit()后被调用.
 * 可以多次调用register_shutdown_function(),这些被注册的回调会按照他们注册的顺序被依次调用.如果你在注册的方法内部调用exit(),那么所有的
 处理会被终止,并且其他注册的终止回调也不会再被执行.
 * 如果进程被信号SIGTERM或SIGKILL杀死,那么终止函数将不会被调用.尽管你无法中断SIGKILL,但你可以通过pcntl_signal()来捕获SIGTERM,通过
 在其中调用exit()来进行一个正常的终止.
 * 如果脚本执行时间超时被终止,该函数还是可以继续执行.
3. mysqli无法设置超时时间:
 * mysqli仅支持连接超时时间,无法设置查询超时时间.
 * mysqli底层超时时间设置单位为秒,最少配置1秒.
 * mysqli底层的read会重试两次,所以实际时间是3秒.
 * MYSQL_OPT_READ_TIMEOUT = 11; MYSQL_OPT_WRITE_TIMEOUT = 12.
####0X06 斗鱼直播
1. MySQL GROUP BY可以对多列进行分组. 
 
 
 
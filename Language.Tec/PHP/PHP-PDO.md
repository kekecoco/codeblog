#### PHP PDO  
##### 0X01 PDO简介  
1. PDO是官方提供的，面向对象的数据库扩展，它不依赖于某种数据库，对于数据库的更换非常方便.  
2. 使用PDO更加的安全，在PDO中是默认对特殊字符串进行过滤的，所以在开始PDO之前，要将magic_qutes_gpc关闭.
3. 使用不同的数据库，需要加载不同数据库的PDO驱动.  
    
##### 0X02 PDO使用  
1. PDO本身方法:
* $pdoobj = new PDO($dns, $username, $password);    
* $pdoobj->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
* $pdoobj -> exec('set names utf8');  
* $pdoobj -> qutes(字符串);  
2. PDO statement操作
* $ps = $pdoobj->prepare("SELECT * FROM `article` WHERE `id` = 1");
* *这个方法并没有执行sql语句，只是准备好了sql语句，执行的话还需要使用execute来执行。
$ps->execute();*
* 两步合为一步则可以使用：query来执行。$ps = $pdoobj->query(sql语句);
* $ps = $pdoobj->prepare('select * from article where id = ?');
* $ps -> bindValue(1, 10);
3. 代码示例:  
```
<?php
	try{
		$obj = new PDO('mysql:host=localhost;dbname=localhost' , 'root'  , '123456');  
		//生成PDO示例  
		$obj ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
		//设置以异常的形式报错  
		$obj ->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_ASSOC );
		//设置fetch时返回数据形式为数组  
		$ps = $obj->prepare("SELECT *  FROM `article` WHERE `type` = ? and `menu` = ?");
		//生成一个PDOStatement实例  
		$ps->bindValue(1 , "文章");//第一个？处的参数换成 文章，不需要附加任何处理
		$ps->bindValue(2 , 2);//第二个？处的参数换成2，不需要附加任何处理
		$ps->execute(); //正式执行。
		$res = $ps->fetchAll();//得到查询结果
	} catch(Exception $e){
		exit($e->getMessage());
	}
?>
```


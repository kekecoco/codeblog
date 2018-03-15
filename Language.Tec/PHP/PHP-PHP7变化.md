#### PHP7变化

##### 0X01 类型声明

1. 标量类型声明

   * 字符串,整型,浮点型和布尔型可以进行类型声明;之前在函数参数中只有数据及对象可以进行.

     ```php
     <?php
       function check(int $num){
         var_dump($num);
       }
       
       check(1); // 1
       check(true); // 1 会进行强制类型转换
     ```

2. 返回值类型声明

   * PHP7中函数增加了返回值的类型声明.

     ```php
     <?php
     function check(array $arr):array{
       return $arr;
     }
     ```

##### 0X02 运算符

1. null合并运算符

   ```php
   <?php
     isset($_GET['param'])?$_GET['param']:'err'; // 旧版
     isset($_GET['param'])??'err';// 新版
   ```

2. 太空船比较符

   ```php
   <?php
     echo 1 <=> 1; // 0
     echo 1 <=> 2; // -1
     echo 2 <=> 1; // 1
   ```

##### 0X03 定义常量数组

1. define()定义常量数组

   ```php
   <?php
     define('FRUITS', ['apple', 'banna', 'orange']);// 旧版不支持,会报语法错误
     echo FRUITS[1]; // banna
   ```

##### 0X04 匿名类

1. ```php
   <?php
     interface Logger {
      	public function log (string $msg){}; 
     }
     class Application {
       private $logger;
       public function getLogger():Logger{
          return $this->logger;
       }
       public function setLogger(Logger $logger){
          $this->logger = $logger;
       }  
     }
     $application  = new $Application;  
     $application->setLogger(new class implements Logger{
         public function log(string $msg){
         	echo $msg;
         }
     });
     var_dump($application->log('log'));
   ```

##### 0X04 foreach不在改变内部的指针

1. 在PHP7之前foreach遍历数组,数组的指针会发生移动,PHP7以后不再如此.
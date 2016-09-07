####Linux-sed使用  

##### 0X01 基本原理  
1. sed的工作原理简单,就设计一个缓存区:模式空间(pattern space).  
2. sed对文件的处理是一行一行进行的,每行的处理是独立的.  

##### 0X02 处理过程  
1. 一个command可以看作是由pattern匹配和sed-command指令两个部分，一个commands是由多个command组成.  
* 读入新行到缓存区.  
* 从commands里取出一个command，判断此command的pattern是否匹配.  
* 如果不匹配，则忽略后面的sed-command命令.  
* 如果匹配，则执行本command对应的sed-command命令. 
* 不管匹配与否都会：继续下一个command，跳到2.  
* 所有command处理完毕后，输出缓存区内容到屏幕.
* 继续下一行，跳到1.  
*从上述过程中可以看出，sed的核心处理过程是在缓冲区完成的 *  

##### 0X03 实例  
1. sed -n '3p' test.txt  输出test.txt文件的第三行  
2. sed -n '/a/s/a/x/p' test.txt  将匹配到的以字母a开头的一行的第一个字母a替换为x  
3. sed -n '/a/s/a/y/gp' test.txt 将匹配到的以字母a开头的一行的所有字母a替换为y  
*n和p需要配合使用才可以，n是控制屏幕输出的，控制屏幕只输出缓冲区的内容，p控制缓冲区内容的输出。
所以两者配合使用，才可以输出sed缓冲区的内容.*  
4. sed '2d' test.txt 删除test.txt文件的第二行  
5. sed '2,4d' test.txt 删除test.txt文件的第二到第四行  
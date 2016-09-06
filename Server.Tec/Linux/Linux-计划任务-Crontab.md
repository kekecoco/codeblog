####Linux-计划任务-Crontab  
> Crontab是Linux自带的计划程序.  

##### 0X01 Crontab配置及使用方法  
1. 配置文件: /etc/crontab  
2. 使用方法:  
.---------------- minute (0 - 59)  
|  .------------- hour (0 - 23)  
|  |  .---------- day of month (1 - 31)  
|  |  |  .------- month (1 - 12) OR jan,feb,mar,apr ...  
|  |  |  |  .---- day of week (0 - 6) (Sunday=0 or 7) OR sun,mon,tue,wed,thu,fri,sat  
|  |  |  |  |  
* *  *  *  * user-name  command to be executed   
3. 使用示例:  
0 6 * * * root /sh   每天6点执行  
0 4  *  * 6 root /sh 每周六凌晨4点执行  
5 * * 6 root /sh  每周六凌晨5点执行  
40,50 11 * * 1-5 root /sh 每周1-5的11：41开始，每10分钟执行一次,共执行两次    
1-59/10 12-23 * * 1-5 root     
31 10-23/2 * * * root /sh 每天10：31开始，每隔两小时重复一次  
0 8，9 * * 1-5 root /sh 每周一到周五8点，每周一到周五9点  

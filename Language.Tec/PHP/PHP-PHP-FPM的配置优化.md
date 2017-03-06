#PHP-FPM配置优化   
###0x00 相关配置参数的说明  
1. static和dynamic:    
   这两个选项都是用于指定PHP-FPM的进程数，static指定的是固定的数值而dynamic指定的是动态的值。对于访问量和并发量不是很大的网站来讲，使用动态的进程数能更好的利用系统的资源，但是对于访问量和并发量比较大的网站来说，最好使用静态的值进行设置。这样可以避免由于瞬时PHP-FPM子进程的创建而带来过多的资源占用。
2. pm.max_requests：    
   这个参数的含义是PHP-FPM进程处理完多少个请求后自动重启，主要的目的就是为了控制处理请求过程中的内容溢出问题，使内存占用在一个可接受的范围内。  
   据官方介绍，php-cgi不存在内存泄漏，每个请求完后会回收内存，但是不会释放给操作系统，这样就会导致大量的内存被php-cgi占用。
3. pm.max_children、pm.start_servers、pm.min/max_spare_servers个数的设置：    
   静态的设置值只有第一个，后面两个是用于动态的设置值的。  
   ps -ylC php-fpm --sort:rss 这条命令可以看出每个PHP-FPM进程的实际占用内存的大小。    
   ps --no-headers -o "rss,cmd" -C php-fpm | awk '{ sum+=$1 } END { printf ("%d%s\n", sum/NR/1024,"M") }' 这条命令可以帮助实际计算出PHP-FPM进程平均的内存占用量。  
   然后根据实际需要使用的内存量来计算PHP-FPM的总的进程个数。

###0x01 配置内容  
```
[global]
pid = /opt/phpad/var/run/php-fpm.pid
error_log = /opt/phpad/var/log/php/php-fpm.log
log_level = notice
rlimit_files = 65535
events.mechanism = epoll

[nginx]
listen = /opt/phpad/tmp/php-fpm.sock
request_slowlog_timeout = 5s
slowlog = /opt/phpad/var/log/php/slowlog-adm.log
user = nginx
group = nginx
pm = static
pm.max_children = 75
pm.start_servers = 20
pm.min_spare_servers = 20
pm.max_spare_servers = 75
pm.max_requests = 1000
request_terminate_timeout = 300
```

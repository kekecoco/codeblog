# SeasLog日志系统
> 系统日志 应用程序日志 安全日志  
> 高性能 配置简单 

### SeasLog安装
安装方法与一般的PHP扩展相同。  
```
phpize .
./configure --with-php-config=/opt/lampp/bin/php-config
make && make install
```
配置：  
需要在php.ini文件中加入：
```
extension = seaslog.so
seaslog.default_basepath = /log/seaslog-test    ;默认log根目录
seaslog.default_logger = default                ;默认logger目录
seaslog.disting_type = 1                        ;是否以type分文件 1是 0否(默认)
seaslog.disting_by_hour = 1                     ;是否每小时划分一个文件 1是 0否(默认)
seaslog.use_buffer = 1                          ;是否启用buffer 1是 0否(默认)
seaslog.buffer_size = 100                       ;buffer中缓冲数量 默认0(不使用buffer_size)
seaslog.level = 0                               ;记录日志级别 默认0(所有日志)
seaslog.trace_error = 1                         ;自动记录错误 默认1(开启)
seaslog.trace_exception = 0                     ;自动记录异常信息 默认0(关闭)
```
### SeasLog使用
**seaslog的常用函数**  
配置方法：setBasePath,getBasePath,setLogger,getLasteLogger    
写日志方法：log,info,notice,debug,error,warning    
读日志方法：analyzerCount,analyzerDetail      
*  setBasePath:设置日志的记录地址，必须要确保权限是满足的。
*  getBasePath:获取当前设置的日志记录地址。
*  setLogger:设置模块，这个和自己的项目相关。
*  getLasteLogger:获取上次设置的模块。
*  log:记录日志的方法，需要传两个参数：日志级别，日志内容。
*  analyzerCount:获取各个级别日志的数量。
*  analyzerDetail:获取各个级别日志的详细内容。

**日志的级别说明**  

* SEASLOG_DEBUG "debug"
* SEASLOG_INFO "info"
* SEASLOG_NOTICE "notice"
* SEASLOG_WARNING "warning"
* SEASLOG_ERROR "error"
* SEASLOG_CRITICAL "critical"
* SEASLOG_ALERT "alert"
* SEASLOG_EMERGENCY "emergency"

*不要在虚拟主机中使用seaslog*    
*不要在集群服务中使用seaslog*

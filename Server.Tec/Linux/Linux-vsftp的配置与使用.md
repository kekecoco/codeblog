# vsftp的配置与使用
> * 全称very secure FTP daemon.它的发展本来就是以安全性为考量的。    
> * vsftpd在安全性的考量上面，主要针对了程序的权限，privilege概念来设计的。    
> * 它支持IPv6和SSL。    
> * vsftpd支持显式的（自2.0.0）和隐式（自2.1.0）FTPS。  

### 一、vsftpd的安装  
*以下仅针对CentOS6.x进行安装与设置。*    

**安装**  
yum install -y vsftpd  
其他可以下载vsftpd的tarball进行手动编译安装。  
### 二、vsftpd的配置
1.vsftpd.conf的配置  
* listen=YES 默认为NO。  
vsftpd可以有两种启动方式：  
super server：以inetd或者xinetd启动;  
standalone:这种方式vsftpd会自己监听网络。这种方式更为易用同时也是推荐的运行方式。设置方式需要将NO改为YES。  
* anonymous_enable=NO 禁止匿名用户登录服务器。
* local_enable=YES 允许本地的用户帐号用于登录服务器。
* write_enable=YES 用于实体用户的上传。
* use_localtime=YES 允许服务器使用本地时间，否则默认使用格林威治时间，与本地时间有八个小时的时差。
* xferlog_enable=YES 开启上传与下载的日志记录。
* connect_from_port_20=YES 开启ftp主动连接的数据传输端口。
* chroot_local_user=YES 允许对本地实体用户启用chroot。
* ssl_enable=YES 启用加密的方式连接和传输数据。
  
### 三、问题解决  
1. 时间错误：如果不设置use_localtime=YES vsftpd默认是使用格林威治时间的，这个与本地的时间有八个小时的时间差。所以需要在配置文件中设置这个选项，时间就会正常。  
2. vsftpd无法显示目录或者不显示某些文件：这个很大的原因是在SELinux，需要对SELinux进行设置。  
getsebool -a | grep ftp  
setbool -P ftp_home_dir 1  
其他的选项也可以通过上面的方式进行设置。  
3. 为避免产生安全性的问题，必要时需要禁止匿名用户的访问。
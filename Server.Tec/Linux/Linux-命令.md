####Linux-命令

1. Linux--uname命令   
*uname是UNix name的缩写。通过它可以获得操作系统的相关信息。*
- uname -s ：内核名称
- uname -r：内核发行版
- uname -v：内核建立的时间，CPU架构等
- uname -n：打印节点名，实际为主机名
*通过查看/etc/issue 文件可以获得本发行版的详细信息* 
- uname -m：获取硬件名称
- uname -i：获取硬件平台
- uname -p：获取处理器类型
- uname -o：获取操作系统的类型
- uname-a：显示所有的信息，输出为unknown的会被忽略.
2. Linux图形化的系统管理工具--webadmin
- 下载：sourceforg.net/projects/webadmin/ 可以选择相应的版本，一般用源码安装比较好。
- 对源码进行解压：tar -zxvf  webadminxxx.tar.gz
- 进入webadmin的目录：./setup.sh 运行脚本进行安装
- 安装过程中出现的目录等设置选项可以为默认。
- 访问方法：http://主机名:10000
3. Netdata开源的Linux系统监视工具
- 安装：
>Centos：
yum install zlib-devel gcc make git autoconf autogen automake pkgconfig

>Ubuntu：
apt-get install zlib1g-dev gcc make git autoconf autogen automake pkg-config

>git clone https://github.com/firehol/netdata.git --depth=1
cd netdata
./netdata-install.sh  

4. 查看进程所占用内存的大小：
- pmap  -d <pid>
5. 探查远程ip是否开启某个端口
- telnet ip port
- nc -z ip tcpport 
- nc -zu ip updport
6. 显示指定程序的进程ID：
- yum install -y pidof
- pidof -l httpd
##### 0X01 网络配置  
1. 在宿主机安装好Proxmox后, 默认只有一个本地节点,在网络模块下除了显示正常的网络设备外还会默认有一个桥接网卡vmbr0.  
  注: 1. Proxmox网络设备中,不会显示无线网卡只显示有线网卡或USB网卡.
2. vmbr0可以编辑修改默认的IP地址和子网掩码.  
  注: 1. vmbr0如果设置端口/从属当前的有线网卡,会使同一网段的两台宿主机无法连接,导致创建集群失败.可能的原因是vmbr0如果指定桥接在当前的有线网卡中
      Mac地址会使用有线网卡的,导致host unreachable错误.
3. 虚拟机或容器上网配置:
    * 宿主机需要添加Linux Bridge vmbr0 vmbr1 两个网卡.
    * 虚拟机或容器在硬件/网络模块下添加两个分别桥接vmbr0和vmbr1的网卡,网卡模型全部选择VirtIO(半虚拟化).
    * 配置虚拟机/容器外网DNS.
    * 重启虚拟机/容器网络或重启虚拟机/容器.
4. A宿主机上的虚拟机或容器需要被B宿主机访问,除了通过创建集群外,可以通过端口转发实现ssh链接.

##### 0X02 集群配置
1. Proxmox对加入集群节点的网络环境有比较高的要求,连接延迟2ms左右,太高会导致加入集群失败.
2. 加入集群失败可以通过一下命令进行节点恢复:
```shell
# stop service
systemctl stop pvestatd.service
systemctl stop pvedaemon.service
systemctl stop pve-cluster.service
systemctl stop corosync
systemctl stop pve-cluster

# delete sqlite3 info
sqlite3 /var/lib/pve-cluster/config.db
select * from tree where name = 'corosync.conf';
delete from tree where name = 'corosync.conf';
select * from tree where name = 'corosync.conf';
.quit

# remove files
pmxcfs -l
rm /etc/pve/corosync.conf
rm /etc/corosync/*
rm /var/lib/corosync/*
rm -rf /etc/pve/nodes/*

```

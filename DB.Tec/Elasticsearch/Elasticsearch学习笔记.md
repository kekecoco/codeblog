#### 0X01 Elasticsearch学习笔记
1. ES的节点选举:
    * 选举的基本原则:
        * ES针对当前集群中所有的Master Node进行选举得到master节点,为了避免出现脑裂现象,ES选择了分布式系统常见的多数派思想,
        也就是只有获得了超过半数选票的节点才能成为master.
    * 如何触发选举:
        * 集群启动
        * Master失效
    * 选主流程:
        * 每个节点计算最低的已知节点,并向该节点发送领导投票.
        * 如果一个节点收到足够多的票数,并且该节点也为自己投票,那么它将扮演领导者的角色,开始发布集群状态.
        * 所有节点都会参与选举,参与投票,但是只有有资格成为master节点的投票才有效.
        * 法定人数大小的配置: 可以成为master节点数n/2+1.
2. ES的数据存储:
    * 用户查询是在Index上完成的,每个Index由若干个shard组成,以此来达到分布式可扩展的能力.
    * shard是ES数据存储的最小单位,index的存储容量为所有shard的存储容量之和.ES集群的存储容量则为所有index存储容量之和.
    * 一个shard就对应了Lucene的library.对于一个shard,ES增加了translog的功能,是数据写入过程中的中间数据,其余的数据都在Lucene库中管理.
    * segment:
        * Lucene内部的数据是由一个个segment组成的,写入Lucene的数据并不直接落盘,而是先写在内存中,经过refresh的间隔,Lucene才将该时间段
        写入的全部数据refresh成一个segment,segment多了之后会进行merge成更大的segment.
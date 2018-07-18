####MyISAM与InnoDB的区别
1. InnoDB存储引擎会维护自己的缓冲池，会将被访问数据的表和索引缓存在缓冲池中。经常使用的数据会直接从内存中取出。MyISAM不支持数据和索引缓存.
2. InnoDB支持外键,MyISAM不支持外键.
3. MyISAM不支持MVCC.
4. 锁级别不同: InnoDB锁粒度为行级锁.MyISAM锁粒度为表级锁.
5. 事务支持不同: MyISAM不支持事务.
6. 数据存储方式不同: MyISAM表在磁盘中有两个文件,一个为数据文件.MYD,另一个为索引文件.MYI.InnoDB存储在表空间中,数据文件可配置,一般为.ibdata.
####TCP报文
1. 三次握手--建立连接  
17:06:45.608123 IP localhost.60338 > localhost.entextxid: Flags [S], seq 837436192, win 65535, options [mss 16344,nop,wscale 5,nop,nop,TS val 86329992 ecr 0,sackOK,eol], length 0  
17:06:45.608187 IP localhost.entextxid > localhost.60338: Flags [S.], seq 1551233059, ack 837436193, win 65535, options [mss 16344,nop,wscale 5,nop,nop,TS val 86329992 ecr 86329992,sackOK,eol], length 0  
17:06:45.608195 IP localhost.60338 > localhost.entextxid: Flags [.], ack 1, win 12759, options [nop,nop,TS val 86329992 ecr 86329992], length 0  

17:06:45.608201 IP localhost.entextxid > localhost.60338: Flags [.], ack 1, win 12759, options [nop,nop,TS val 86329992 ecr 86329992], length 0  
2. 客户端向server端传输数据  
17:06:48.072565 IP localhost.60338 > localhost.entextxid: Flags [P.], seq 1:5, ack 1, win 12759, options [nop,nop,TS val 86332455 ecr 86329992], length 4  
17:06:48.072594 IP localhost.entextxid > localhost.60338: Flags [.], ack 5, win 12759, options [nop,nop,TS val 86332455 ecr 86332455], length 0  
3. server端向客户端传输数据  
17:06:48.072657 IP localhost.entextxid > localhost.60338: Flags [P.], seq 1:5, ack 5, win 12759, options [nop,nop,TS val 86332455 ecr 86332455], length 4  
17:06:48.072669 IP localhost.60338 > localhost.entextxid: Flags [.], ack 5, win 12759, options [nop,nop,TS val 86332455 ecr 86332455], length 0  
4. 四次挥手--断开连接  
17:06:48.072678 IP localhost.entextxid > localhost.60338: Flags [F.], seq 5, ack 5, win 12759, options [nop,nop,TS val 86332455 ecr 86332455], length 0  
17:06:48.072688 IP localhost.60338 > localhost.entextxid: Flags [.], ack 6, win 12759, options [nop,nop,TS val 86332455 ecr 86332455], length 0  
17:06:48.072773 IP localhost.60338 > localhost.entextxid: Flags [F.], seq 5, ack 6, win 12759, options [nop,nop,TS val 86332455 ecr 86332455], length 0  
17:06:48.072801 IP localhost.entextxid > localhost.60338: Flags [.], ack 6, win 12759, options [nop,nop,TS val 86332455 ecr 86332455], length 0  
5. 解析:  
  * TCP flags:  
    -用于标志当前的连接状态.  
    -提供信息便于调试和排错.  
    -常用的flags列表:  
     +SYN:Synchronisation.三次握手的第一个状态位.  
     +ACK:Acknowledgment.三次握手的第二个状态位.用于告诉发送者已经收到SYN的连接请求.  
     +FIN:Finished.  
     +PSH:PUSH.告诉接收者处理发送者传送过来的数据.  
  * win:   
    -TCP的窗口机制: 充分利用双方的带宽及缓冲区.  
    -发送方不必等待接收方的确认,可以连续发送多个数据包给对方,对方可以暂时把这些数据放在缓冲区,并给对方一个确认.这样,可以增大数据传输的速度.  
    -在某些极端的情况下,接收方的buffer被填满时,会发送ZeroWindowSize通知,让发送方暂时停止数据传输,等待下个确认通知.  
  * options:  
    -MSS:maximum segment size:指明本端可以接受的最大的TCP segment长度.对端不能发送大于MSS(单位Byte).  
    -EOL:选项列表结束.  
    -NOP:无操作,用于补位填充.  

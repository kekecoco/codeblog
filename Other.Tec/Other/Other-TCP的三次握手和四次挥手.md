#### TCP的三次握手和四次挥手

##### 0X01 TCP的三次握手

1. TCP有6中标示：SYN(synchronous建立联机),ACK(acknowledge 确认),PSH(push 传送),FIN(finish 结束),RST(reset重置),URG(urgent紧急)。
2. 握手过程：
   * 第一次握手：主机A发送位码SYN=1，随机产生seq number=123456的数据包到服务器，主机B由SYN=1知道A要求建立联机。
   * 第二次握手：主机B收到请求后确认联机信息，向A发送ACK number=(seq number+1),SYN=1,ACK=1,随机产生seq number=654321的包。
   * 第三次握手：主机A收到后检查ACK number是否正确，即第一次发送的seq number+1，以及位码ACK=1，若正确，主机A会再发送ACK number=(主机B的seq number+1),ACK=1,完成三次握手，主机A与B开始传送数据。
   * 状态过程：
     * 第一次握手：建立连接时，客户端发送SYN(SYN=j)包到服务器，并进入SYN_SEND状态，等待服务器确认。
     * 第二次握手：服务器收到SYN包，必须确认客户的SYN(ACK=j+1)，同时自己也发送一个SYN+ACK包，此时服务器进入SYN_RECV状态。
     * 第三次握手：客户端收到服务器的SYN+ACK包，向服务器发送确认包ACK，此包发送完毕，客户端和服务器进入ESTABLISHED状态，完成三次握手。

##### 0X02 TCP四次挥手

1. 客户端发送一个FIN报文给服务器，表示我将关闭客户端到服务器这个方向的连接。
2. 服务器接收到FIN报文后，发送一个ACK报文给客户端，顺序号+1.
3. 服务器发送一个FIN报文给客户端，表示自己也将关闭服务器端到客户端这个方向的连接。
4. 客户端收到报文后，发回一个ACK报文给服务器，顺序号+1。
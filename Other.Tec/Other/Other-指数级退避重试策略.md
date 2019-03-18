#### 指数级退避重试策略

##### 0X01 重试的场景
1. 如果当前的故障是暂时的,而不是永久的,才需要去重试.
2. 业务级错误其实不需要重试,直接报故障就可以.

##### 0X02 重试的策略
1. 重试必须要有一个最大值,到达这个最大之后就不必再重试,直接报故障就可以.
2. 在重试的设计中,需要引入指数级退避策略.这种机制主要是用来让被调用方能够有更多的时间来从容处理我们的请求.
```java
public enum Results {
    SUCCESS,
    NOT_READY,
    TOO_BUSY,
    NO_RESOURCE,
    SERVER_ERROR
}

public static long getWaitTimeExp(int retryCount) {
    long waitTime = ((long) Math.pow(2, retryCount));
    return waitTime;
}

public static void doOperationAndWaitForResult() {
    long token = asyncOperation();
    int retries = 0;
    boolean retry = false;
    do {
        Result result = getAsyncOperationResult(token);
        if (Results.SUCCESS == result) {
               retry = false;
        } esle if (Results.NOT_READY == result ||
                    Results.TOO_BUSY == result ||
                    Results.NO_RESOURCE == result ||
                    Results.SERVER_ERROR == result) {
            retry = true;
        
        } else {
            retry = false;
        }
        if (retry) {
            long waitTime = Math.min(getWaitTimeExp(retries), MAX_WAIT_INTERVAL);
            Thread.sleep(waitTime);
        }
    } while (retry && (retries++ < MAX_RETRIES))

} 
```


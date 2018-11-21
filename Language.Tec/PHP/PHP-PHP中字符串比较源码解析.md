### PHP中字符串比较源码解析
> 源码文件: master/php-7.1.9/Zend/zend_operators.c

1. PHP中的对比(松散对比)底层是通过compare_function这个方法实现的.compare_function()的比较过程是一个穷举遍历比较的过程.
具体实现是首先对传入的值做类型识别,然后按照具体的数据类型进行比较.
2. 字符串在比较时首先会调用函数zendi_smart_strcmp(), 函数zendi_smart_strcmp()首先会判断两个字符串是否都是数字,
如果是数字,会先转换为数字类型进行比较.如果不是数字会调用函数zend_binary_strcmp()继续进行比较.
zend_binary_strcmp()函数底层是通过调用系统函数memcmp()进行比较的.
* memcmp()函数:int memcmp( const void* lhs, const void* rhs, std::size_t count );
    - lhs和rhs所指向的对象为unsigned char数组，并比较这些数组的首count个字符。按字典序比较。
    - 结果的符号是在被比较对象中相异的首对字节的值（都转译成 unsigned char ）的差。
    - 返回值
        + 若lhs中首个相异字节（转译为 unsigned char ）小于rhs中的对应字节则为负值。
        + 若lhs和rhs的所有count个字节相等则为0​。
        + 若lhs中首个相异字节大于rhs中的对应字节则为负值。
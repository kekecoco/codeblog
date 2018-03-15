### AWK的使用实例

> AWK命令使用教程: [https://www.ibm.com/support/knowledgecenter/zh/ssw_aix_72/com.ibm.aix.cmds1/awk.htm](https://www.ibm.com/support/knowledgecenter/zh/ssw_aix_72/com.ibm.aix.cmds1/awk.htm)

1. 显示长度大于72个字符的文件的行:
   * awk  'length > 72'  chapter1
2. 显示start和stop之间的所有行,其中包含"start"和"stop":
   * awk  '/start/,/stop/'  chapter1 
3. 以相反的顺序打印前两个字段:
   * awk  '{print $2, $1}'  chapter1
4. 打印每条记录并且带有编号:
   * awk  '{print NR, $0}'  chapter1
5. 打印每条记录并且带有多少域:
   * awk  '{print $0, NF}'  chapter1
6. 以冒号为分隔符,打印匹配记录:
   * awk -F:  '/Tom Jones/{print $1, $2}'  chapter1
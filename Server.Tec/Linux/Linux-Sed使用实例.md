### Sed使用实例

> Sed使用手册:https://www.ibm.com/support/knowledgecenter/zh/ssw_aix_72/com.ibm.aix.cmds5/sed.htm

1. 要执行全局更改:
   * sed  "s/happy/sad/g"  chap1 >chap1_new
2. 要显示文件的特定行:
   * sed -n  "/food/p"  chap3
   * 通常sed命令将编辑过的每行复制到标准输出.-n终止了sed进行该操作,如果没有-n标识,该示例会显示所有的行,包含food 的行会显示两次.
3. 直接修改文件:
   * sed -i "s/happy/sad/g" chap1
   * 直接在原文件的基础之上进行修改.
4. 删除匹配行:
   * sed  "/food/d"  chap1
5. 打印奇数/偶数行:
   * sed  -n   "p;n"  chap1 #奇数行	
   * sed  -n   "n;p"  chap1 #偶数行
#!D:\python2.7\python.exe
# -*- coding: UTF-8 -*-

print  
import urllib2
import re
import pymysql
#读取网页所有内容
# url="http://news.baidu.com/"
# response = urllib2.urlopen(url)
# content = response.read()

# #匹配nav标签正则,两个div之间的内容，第一个开头是匹配所有
# reg=re.compile('(<div id="channel-all".*?)<div id="body" alog-alias="b"',re.S)

# nav = re.search(reg,content)   #读取html页面
# print nav.group(1)
# 
# 打开数据库连接
db = pymysql.connect("localhost","testuser","test123","TESTDB" )

# 使用cursor()方法获取操作游标 
cursor = db.cursor()
response = urllib2.urlopen("http://news.baidu.com/")
content = response.read()
pattern = re.compile('(<div id="channel-all".*?)<div id="body" alog-alias="b"', re.S)
# pattern = re.compile('<div id="channel-all"(.*?)</div>', re.S)
nav = re.search(pattern, content)
print nav.group()

#添加入库
# def insertOneRd(self,value):
#         val = ''
#         for item in value:
#             val += "'"+item+"',"
#         val = val.rstrip(',')
#         try:
#             sqlcmd = 'insert into ' + self.tableName + ' (username, pwd, address, phone, email, hobby)values' + '(' + val + ')'
#             # print sqlcmd
#             self.cursor.execute(sqlcmd)
#             self.conn.commit()
#         except:
#             print 'fail to insertOneRd'
#             return None

#!D:\python2.7\python.exe
# _*_ coding:utf-8 _*_

print "Content-type:text/html"
print                               # 空行，告诉服务器结束头部

import urllib
import urllib2
import re
import MySQLdb

class News:
    #home page
    def __init__(self):
     self.url = "http://news.baidu.com/"
    
    #div guolv
    def tranTags(self, x):
        pattern = re.compile('<div.*?</div>') 
        res = re.sub(pattern, '', x)
        return res

    #get all news
    def getAll(self):
        url = self.url
        request = urllib2.Request(url)
        response = urllib2.urlopen(request)
        return response.read()

    #get word
    def getWord(self):
        par = self.getAll()
        reg = re.compile('<div class="hotnews" alog-group="focustop-hotnews">(.*?)<div class="column clearfix" id="tupianxinwen"',re.S)
        title = re.search(reg,par)
        return title.group(1)

    #get All title
    def allTitle(self):
        alls = self.getWord()                               
        reg = re.compile('<a href="(http://.*?").*?>(.*?)</a>',re.S)
        title = re.findall(reg,alls)
        return title
        for item in title:
            print item[0][:-1],item[1]

nav = News()
title = nav.allTitle()

# 打开数据库连接
db = MySQLdb.connect("127.0.0.1","root","root","python",charset="gbk")

# 使用cursor()方法获取操作游标 
cursor = db.cursor()

# SQL 插入语句
for item in title:
    item[0],nav.tranTags(item[1])
    # sql = """INSERT INTO url(url,name)VALUES (%s,%s)""" %("'"+new.tranTags(item[1])+"'","'"+item[0]+"'")
    sql = """INSERT INTO news(name,url)VALUES (%s,%s)"""%("'"+nav.tranTags(item[0])+"'","'"+item[1]+"'")
    try:
       # 执行sql语句
       cursor.execute(sql)
       # 提交到数据库执行
       db.commit()
    except:
       # 如果发生错误则回滚
       db.rollback()

# 关闭数据库连接
db.close()



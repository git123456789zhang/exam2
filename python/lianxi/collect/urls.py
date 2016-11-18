# _*_ coding:utf-8 _*_
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
    
    #get navAll
    def getNav(self):
        page = self.getAll()
        reg = re.compile('(<div id="channel-all".*?)<div id="body" alog-alias="b"', re.S)
        nav = re.search(reg,page)
        return nav.group(1)

    #get nav--href,name
    def getName(self):
        getNav = self.getNav()
        pattern = re.compile('<a href="(http://.*?/).*?>(.*?)</a>', re.S)
        itmes = re.findall(pattern,getNav)
        return itmes
        # for item in itmes:
        #     print item[0],self.tranTags(item[1])


new = News()
news = new.getName()



# 打开数据库连接
db = MySQLdb.connect("127.0.0.1","root","root","python",charset="gbk")


# 使用 cursor() 方法创建一个游标对象 cursor
cursor = db.cursor()

for item in news:
    print item[0],new.tranTags(item[1])
    sql = """INSERT INTO url(url,name)VALUES (%s,%s)""" %("'"+new.tranTags(item[1])+"'","'"+item[0]+"'")
    try:
       # 执行sql语句
       cursor.execute(sql)
       # 提交到数据库执行
       db.commit()
    except:
       # 如果发生错误则回滚
       db.rollback()


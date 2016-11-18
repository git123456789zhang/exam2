#!D:\python2.7\python.exe
# -*- coding: UTF-8 -*-
import MySQLdb
from config import *
class MYSQL:

	tableName='login'
	#构造函数
	def __init__(self):
		self.db=MySQLdb.connect(db['host'],db['user'],db['passwd'],db['db'])
		self.cursor=self.db.cursor()

	#基础查询
	def query(self,sql):
		cursor=self.cursor
		cursor.execute(sql)

	#查询所有结果集
	def getAll(self,field='*',where='1',limit='-1'):
		cursor=self.cursor
		if(field!='*'):
			field=','.join(field)
		if(limit==-1):
			sql="select %s from %swhere %s" % (field,self.tableName,where)
		else:
			sql="select %s from %s where %s limit 1" % (field,self.tableName,where)
			self.query(sql)
			return cursor.fetchall()

    #查询一条数据
	def getOne(self,field='*',where=1):
		return self.getAll(field,where,1)

	#添加方法
	def ins(self,val):
		val=','.join(val)
		#print val
		sql = "INSERT INTO users(name,pwd, token, phone, email,age) VALUES" + '(' + val + ')'
		return sql

    #删除数据
	#def delete(self,where=1):


# obj=MYSQL()
# list1 = ['aaa', 'aaa','sss','dddd','sss','eee'];
# res=obj.ins(list1)
# print res
# #for item in res
# #print item





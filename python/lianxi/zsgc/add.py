#!D:\python2.7\python.exe
# -*- coding: UTF-8 -*-
print "Content-type:text/html;charset=utf-8"
print                               # 空行，告诉服务器结束头部
# CGI处理模块
import cgi, cgitb 
import DB
import re
# 创建 FieldStorage 的实例化
form = cgi.FieldStorage()	

# 获取数据
name = form.getvalue('name')
pwd  = form.getvalue('pwd')
token = form.getvalue('token')
age = form.getvalue('age')
phone = form.getvalue('phone')
email = form.getvalue('email')

# # #正则验证
# 验证用户名
p1 = re.compile("^[A-Z]{3,}")
namematch = p1.match(name)
# print name
if namematch:
	print 'OK'
else:
	print "<script>alert('用户名首字母为大写且不少于3位');location.href='add.html'</script>"

# 验证密码
p1 = re.compile("^[A-Za-z0-9]{6,}")
namematch = p1.match(pwd)
# print pwd
if namematch:
	print 'OK'
else:
	print "<script>alert('密码不能少于6位');location.href='add.html'</script>"

# 验证token
p1 = re.compile("^[A-Za-z0-9]{6,}")
namematch = p1.match(pwd)
# print pwd
if namematch:
	print 'OK'
else:
	print "<script>alert('token不能少于6位');location.href='add.html'</script>"

# 验证手机号
p1 = re.compile("^1[358]\d{9}")
namematch = p1.match(phone)
# print phone
if namematch:
	print 'OK'
else:
	print "<script>alert('手机号必须以13,15,18开头的十一位数字组成');location.href='add.html'</script>"


#验证邮箱
p1 = re.compile("^[0-9a-zA-Z_]{0,19}@[0-9a-zA-Z]{1,13}\.[com,cn,net]{1,3}")
namematch = p1.match(email)
# print email
if namematch:
	print 'OK'
else:
	print "<script>alert('邮箱格式不正确');location.href='add.html'</script>"

# 验证idcard
p1 = re.compile("^[1-9]{1,3}")
namematch = p1.match(age)
# print age
if namematch:
	print 'OK'
else:
	print "<script>alert('年龄为数字且不大于3位');location.href='add.html'</script>"

#连接数据库，执行添加
obj=MYSQL()
#print obj
list1 = [name, pwd,token,phone,email,age]
# list1 = ['aaa', 'aaa','sss','dddd','sss','eee'];
# print list1
res=obj.ins(list1)
print res
#for item in res
#print item
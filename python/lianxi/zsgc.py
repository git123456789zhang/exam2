b=a()
然后调用
b.fun()

#调用数据库连接类
mysql = conf()
mysql.dbsql
# 使用cursor()方法获取操作游标
cursor = db.cursor()

# SQL 插入语句
sql = """INSERT INTO LOGIN(NAME,
         PWD, TOKEN)
         VALUES ('Luxi', '12345', 223430)"""
try:
   # 执行sql语句
   cursor.execute(sql)
   # 提交到数据库执行
   db.commit()

except:
   # 发生错误时回滚
   db.rollback()

# 关闭数据库连接
db.close()
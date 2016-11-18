#!D:\python2.7\python.exe
#如果一个 3 位数等于其各位数字的立方和，则称这个数为水仙花数。
#例如：153 = 1^3 + 5^3 + 3^3，因此 153 就是一个水仙花数。  
# for i in range(10,1000):  
#     sum=0 #各个位数的立方和  
#     temp=i  
#     while temp:  
#         sum=sum+(temp%10)**3   #累加  
#         temp//=10   #地板除  
#     if sum==i:  
#         print(i) 

# #1-100的偶数
# for i in range(1,100):
#        if(i%2==0):
#           print (i)


# #1-100的奇数
# for i in range(1,100):
#        if(i%2==1):
#           print (i)

# # #99乘法表
# print ('\n'.join([' '.join(['%s*%s=%-2s' % (j,i,i*j) for j in range(1,i+1)]) for i in range(1,10)])) 

# #条件语句
# if true:
# 	print("111")
# else false:
# 	print("222")
a = 10
b = 11
c =22
if( a*b > a*c):
	print('a')
else:
	print('c')
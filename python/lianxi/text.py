#正三角形
for i in range(1,6):
	for j in range(5-i):
		print j*'',
	print (2*i-1)*'*'

#其实，python 中还有一种字符串连接方式，不过用的不多，就是字符串乘法，如：
a = 'abc'
a * 3 = 'abcabcabc'

# #菱形
s = '*'
for i in range(1,8,2):
    t = (7-i)//2
    print(' '*t + s*i + ' '*t)
for i in reversed(range(1,6,2)):
    t = (7-i)//2
    print(' '*t + s*i + ' '*t)
    
# 计算器
#     
def add(x,y):
   """相加"""

   return x + y

def subtract(x, y):
   """相减"""

   return x - y

def multiply(x, y):
   """相乘"""

   return x * y

def divide(x, y):
   """相除"""

   return x / y

# 用户输入
print("选择运算:")
print("1、相加")
print("2、相减")
print("3、相乘")
print("4、相除")

choice = input("输入你的选择(1/2/3/4):")

num1 = int(input("输入第一个数字: "))
num2 = int(input("输入第二个数字: "))

if choice == '1':
   print(num1,"+",num2,"=", add(num1,num2))

elif choice == '2':
   print(num1,"-",num2,"=", subtract(num1,num2))

elif choice == '3':
   print(num1,"*",num2,"=", multiply(num1,num2))

elif choice == '4':
   print(num1,"/",num2,"=", divide(num1,num2))
else:
   print("非法输入")



#冒泡排序
def bub(bublist):
	listlength = len(bublist)
	while listlength > 0:
		for i in range(listlength - 1):
		 if bublist[i] > bublist[i+1]:
			bublist[i]=bublist[i]+bublist[i+1];
			bublist[i+1]=bublist[i]-bublist[i+1];
			bublist[i]=bublist[i]-bublist[i+1];
		listlength -= 1
	print bublist

if __name__=='__main__':
	bublist=[60,50,30,40,20,10];
	bub(bublist);


#小球落地次数
base = int(input("请输入次数："))
num=0
b=0
a=100
for i in range(0,base):
    if(i==0):
      num=100
    num+=2*b
    a=a/2
    b=a
print(num)

import datetime



#print(current.minute)
while True:
    current = datetime.datetime.now()
    if(current.second % 5 == 0 and current.microsecond == 0):
        print("Detik 5 : " + str(current.second))
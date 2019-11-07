import Adafruit_DHT
import RPi.GPIO as GPIO
import time
import urllib.request as req
import urllib.parse as par

apiurl = 'https://makassarrobotics.000webhostapp.com/iot_farm/api/add_data.php'

ph_tanah = 0

sensorDHT = Adafruit_DHT.DHT11
pinDHT = 17 #GPIO17

pinLTanah = 18 #GPIO18 
GPIO.setmode(GPIO.BCM)
GPIO.setup(pinLTanah, GPIO.IN)


while True:
    lembab_udara, suhu_udara = Adafruit_DHT.read_retry(sensorDHT, pinDHT)
    l_tanah = GPIO.input(pinLTanah)
    if lembab_udara is not None and suhu_udara is not None:
        print('Temp={0:0.1f}*C  Humidity={1:0.1f}%'.format(suhu_udara, lembab_udara))
        
        if (l_tanah == False):            
            lembab_tanah = 1
            print("Tanah Lembab : " + str(lembab_tanah))
        else:
            lembab_tanah = 0
            print("Tanah Kering : "+ str(lembab_tanah))
            
            
        data = {
            'suhu_udara' : suhu_udara,
            'lembab_udara' : lembab_udara,
            'lembab_tanah' : lembab_tanah,
            'ph_tanah' : ph_tanah
        }
        data = bytes(par.urlencode(data).encode())
        handler = req.urlopen(apiurl,data)
        print(handler.read().decode('utf-8'))        
        
    else:
        print('Failed to get reading. Try again!')

    
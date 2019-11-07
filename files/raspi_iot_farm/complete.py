import Adafruit_DHT
from picamera import PiCamera
import RPi.GPIO as GPIO
import time
import urllib.request as req
import urllib.parse as par
import base64
import json

camera = PiCamera()
camera.resolution = (640, 480)
camera.rotation = 180

apiurl = 'https://makassarrobotics.000webhostapp.com/iot_farm/api/add_data.php'

ph_tanah = 0

sensorDHT = Adafruit_DHT.DHT11
pinDHT = 17 #GPIO17

pinLTanah = 18 #GPIO18 
GPIO.setmode(GPIO.BCM)
GPIO.setup(pinLTanah, GPIO.IN)

def encodeimg64():
    with open('/home/pi/images.jpg','rb') as image_file:
        encoded_string = base64.b64encode(image_file.read())
        return encoded_string

while True:
    lembab_udara, suhu_udara = Adafruit_DHT.read_retry(sensorDHT, pinDHT)
    l_tanah = GPIO.input(pinLTanah)
    if lembab_udara is not None and suhu_udara is not None:
        print('Temp={0:0.1f}*C  Humidity={1:0.1f}%'.format(suhu_udara, lembab_udara))
         
        camera.capture('/home/pi/images.jpg')
        
        gambar = encodeimg64()
            
        data = {
            'suhu_udara' : suhu_udara,
            'lembab_udara' : lembab_udara,
            'lembab_tanah' : lembab_tanah,
            'ph_tanah' : ph_tanah,
            'gambar' : gambar
        }
        data = bytes(par.urlencode(data).encode())
        handler = req.urlopen(apiurl,data)
        response = str(handler.read().decode('utf-8'))
        print("RES : " + response)
        json_data = json.loads(response)
        print(json_data['kontrol'])
        
    else:
        print('Failed to get reading. Try again!')

    

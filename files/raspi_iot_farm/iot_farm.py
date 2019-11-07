import Adafruit_DHT
from picamera import PiCamera
import RPi.GPIO as GPIO
import time
import urllib.request as req
import urllib.parse as par
import base64
import json
import board
import busio
import adafruit_ads1x15.ads1115 as ADS
from adafruit_ads1x15.analog_in import AnalogIn
import datetime



i2c = busio.I2C(board.SCL, board.SDA)
ads = ADS.ADS1115(i2c)

pinLembabTanah = AnalogIn(ads, ADS.P0)
pinPHTanah = AnalogIn(ads, ADS.P1)

camera = PiCamera()
camera.resolution = (640, 480)
camera.rotation = 180

apiurl = 'https://makassarrobotics.000webhostapp.com/iot_farm/api/add_data.php'

ph_tanah = 0

sensorDHT = Adafruit_DHT.DHT11
pinDHT = 17 #GPIO17(BCM) / PIN 11(BOARD)

pinMotor1A = 22 #GPIO22(BCM) / PIN 15(BOARD)
pinMotor1B = 23 #GPIO23(BCM) / PIN 16(BOARD)
pinPWM = 25


GPIO.setmode(GPIO.BCM)
GPIO.setup(pinMotor1A, GPIO.OUT)
GPIO.setup(pinMotor1B, GPIO.OUT)
GPIO.setup(pinPWM, GPIO.OUT)
p = GPIO.PWM(pinPWM,100)

def getPeriode(angka,  waktu):
    
    if waktu == 'sec':
        durasi = current.second
    elif waktu == 'min':
        durasi = current.minute
    elif waktu == 'hour':
        durasi = current.hour
    elif waktu =='day':
        durasi = current.day
    elif waktu == 'month':
        durasi = current.month
    else:
        durasi = current.second
    return durasi % angka
        

def pompaOff():
    p.stop()
    GPIO.output(pinMotor1A, GPIO.LOW)
    GPIO.output(pinMotor1B, GPIO.LOW)
    print('POMPA NON-AKTIF')
    
    

def pompaOn():
    p.start(100)
    GPIO.output(pinMotor1B, GPIO.HIGH)
    GPIO.output(pinMotor1A, GPIO.LOW)
    print('POMPA AKTIF')
    

def encodeimg64():
    with open('/home/pi/images.jpg','rb') as image_file:
        encoded_string = base64.b64encode(image_file.read())
        return encoded_string

pompaOff()
wait = True
trigger = 0

while True:
    current = datetime.datetime.now()
    
    
    lembab_udara, suhu_udara = Adafruit_DHT.read_retry(sensorDHT, pinDHT)
    lembab_tanah = pinLembabTanah.value / 32
    adc_ph_tanah = pinPHTanah.value / 32
    ph_tanah = (-0.0693*adc_ph_tanah) + 7.3855
    if lembab_udara is not None and suhu_udara is not None:
        print('Temp={0:0.1f}*C  Humidity={1:0.1f}%'.format(suhu_udara, lembab_udara))
        
        print('PH=' + str(ph_tanah))
        print('Lembab Tanah = ' +str(lembab_tanah))
            
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
        try:
            if(trigger == 0):
                if(wait):
                    print('Mengirim Data..')
                    handler = req.urlopen(apiurl,data)
                    response = str(handler.read().decode('utf-8'))
                    wait = False            
            else:
                wait = True
            
            
            #print("RES : " + response)
            
            json_data = json.loads(response)
            #print("JSON : " + str(json_data['kontrol']))
            penyiraman = json_data['kontrol'][0]['value']
            limit_suhu = int(json_data['kontrol'][1]['value'])
            limit_lembab_udara = int(json_data['kontrol'][2]['value'])
            limit_lembab_tanah = int(json_data['kontrol'][3]['value'])
            angka_periode = int(json_data['kontrol'][4]['value'])
            waktu_periode = json_data['kontrol'][5]['value']       
        except KeyboardInterrupt:
            pompaOff()
            #GPIO.cleanup()
        except:
            penyiraman = 'ON'
            limit_suhu = 30
            limit_lembab_udara = 15
            limit_lembab_tanah = 300
            angka_periode = 1
            waktu_periode = 'min'        
        finally:
            print('PENYIRAMAN OTOMATIS : %s \nLIMIT SUHU : %d \nLIMIT LEMBAB UDARA = %d \nLIMIT LEMBAB TANAH = %d \nPERIODE : %d %s'% (penyiraman, limit_suhu, limit_lembab_udara, limit_lembab_tanah,
              angka_periode, waktu_periode))
            trigger = getPeriode(angka_periode, waktu_periode)

        
            if(penyiraman == 'ON'):
                if(suhu_udara >= limit_suhu or lembab_udara >= limit_lembab_udara
                   or lembab_tanah <= limit_lembab_tanah):
                    pompaOn()                    
                else:
                    pompaOff()                    
            else:
                pompaOff()
        
    else:
        print('Failed to get reading. Try again!')
        p.stop()
        #GPIO.cleanup()

    

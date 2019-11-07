import RPi.GPIO as GPIO
GPIO.setwarnings(False)
pinMotor1A = 22 #GPIO22(BCM) / PIN 15(BOARD)
pinMotor1B = 23 #GPIO23(BCM) / PIN 16(BOARD)
pinPWM = 25

GPIO.setmode(GPIO.BCM)
GPIO.setup(pinMotor1A, GPIO.OUT)
GPIO.setup(pinMotor1B, GPIO.OUT)
GPIO.setup(pinPWM, GPIO.OUT)
p = GPIO.PWM(pinPWM,50)
p.start(50)
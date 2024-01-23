import RPi.GPIO as GPIO
import time

# setup RPi
GPIO.setwarnings(False)
servo_pin = 12
GPIO.setmode(GPIO.BCM)
GPIO.setup(servo_pin,GPIO.OUT)

# 50 Hz or 20 ms PWM period
pwm = GPIO.PWM(servo_pin,50) 

def init():
    print("Starting at zero...")
    pwm.start(3) 

def buka():
    print("Setting to 180...")
    pwm.ChangeDutyCycle(12) #  Duty Cycle Adjusted
    time.sleep(2)

def tutup():
    print("Setting to zero...")
    pwm.ChangeDutyCycle(2) #  Duty Cycle Adjusted
    time.sleep(4)
    pwm.stop() 
    GPIO.cleanup()
    print("Program stopped")



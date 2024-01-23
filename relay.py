import RPi.GPIO as GPIO
import time

# Pilih pin yang sesuai dengan konfigurasi hardware Anda
pin = 17

GPIO.setmode(GPIO.BCM) # Gunakan nomor pin BCM
GPIO.setup(pin, GPIO.OUT) # Set pin sebagai output

try:
  while True:
      # Aktifkan relay
      GPIO.output(pin, GPIO.HIGH)
      print("RELAY: on")
      time.sleep(1)

      # Matikan relay
      GPIO.output(pin, GPIO.LOW)
      print("RELAY: off")
      time.sleep(1)
except KeyboardInterrupt:
  pass
finally:
  GPIO.cleanup()

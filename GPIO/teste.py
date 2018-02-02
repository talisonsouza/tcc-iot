import RPi.GPIO as GPIO             #IMPORTA A BIBLIOTECA GPIO
import time                         #importa a biblioteca de temporizacao

GPIO.setmode(GPIO.BOARD)            # Gpio - UTILIZANDO O NUMERO DO PINO
GPIO.setwarnings(False)              #desabilitar mensagens

GPIO.setup(7,GPIO.OUT)

while(1):
    print('LED ON')
    GPIO.output(7,GPIO.HIGH)            
    time.sleep(1)
    print('LED OFF')
    GPIO.output(7,GPIO.LOW)            
    time.sleep(2)

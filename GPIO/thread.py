import RPi.GPIO as GPIO
import sys
import MySQLdb
import time
import datetime

db = MySQLdb.connect(host="127.0.0.1", user="root", passwd="omega123", db="tcc")
db.autocommit(True)
cur = db.cursor()



def inicializaBoard():
    GPIO.setmode(GPIO.BOARD)
    GPIO.setwarnings(False)

def definePinoComoSaida(numeroPino):
    GPIO.setup(numeroPino, GPIO.OUT)

def escreveParaPorta(numeroPino,estadoPorta):
    GPIO.output(numeroPino,estadoPorta)
    cur.execute("UPDATE device  SET ds_bit=%s WHERE ds_pino=%s",(estadoPorta, numeroPino))

    

def start():    
    
    cur.execute("SELECT d.ds_pino, c.ds_acao FROM config c join device d on d.id_device = c.id_device WHERE c.dt_config = DATE_FORMAT(NOW(),'%Y/%m/%d %H:%i')")  
   
    for row in cur.fetchall() :

        device = int(row[0])
        acao = int(row[1])

        inicializaBoard()
        definePinoComoSaida(device)
        escreveParaPorta(device,acao)


while(True):    
    print "aaa"
    start()
    time.sleep(2)

  

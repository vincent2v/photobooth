import RPi.GPIO as GPIO
import time
#import os
import uinput

button = 23
led = 22
sleeptime = 0.2
counter = 0

def setup():
    GPIO.setmode(GPIO.BCM)
    GPIO.setup(button, GPIO.IN, pull_up_down=GPIO.PUD_UP)
    GPIO.setup(led, GPIO.OUT)
    GPIO.output(led, False)
    
    
    
def loop():
        while True:
            counter = 0
            button_state = GPIO.input(button)
            if button_state == False:
                GPIO.output(led,True)
                #print('Button Pressed...')
                while GPIO.input(button) == False:
                    
                    time.sleep(sleeptime)
                    counter = (counter + sleeptime)
                    #print (counter)
                    #print ("Button hold time", counter)
                    
                else:
                    #print("Button Hold on Exit time", counter)
                    if counter < 1.2:
                        print ("Foto")
                        with uinput.Device([uinput.KEY_ENTER]) as device:
                            time.sleep(0.5)
                            device.emit_combo([uinput.KEY_ENTER])
                            time.sleep(10)
                    
                    else:
                        print ("Kollage")
                        with uinput.Device([uinput.KEY_K]) as device:
                            time.sleep(0.5)
                            device.emit_combo([uinput.KEY_K])
                            time.sleep(10)
                                        
                    GPIO.output(led, False)
                    counter = 0
                    
def endprogram():
        GPIO.output(led,False)
        GPIO.cleanup()
        
if __name__ == '__main__':
    
    setup()
    
    try:
        
        loop()
        
    except KeyboardInterrupt:
        print ('KeyboardInterrupt Detected - manual Kill?!')
        endprogram()
            



    


# To setup Raspberry pi we need to follow the article form pimylifeup
# https://pimylifeup.com/raspberry-pi-lcd-16x2/ Docomentation here
# V0 is to be grounded over a potentiometer or a resister I did it with resistor 9.4K OHMS
# RW is to be grounded to avoid flow of 5V of LCD to 3V3 pin of raspberry pi which is 3v3 rated
# After setup install libaray into Raspi
# https://github.com/pimylifeup/Adafruit_Python_CharLCD
# Extract and Run sudo python3 setup.py install
# It will install, some libs might be needed and it worked on python3.7 rasbian buster
from Adafruit_CharLCD import Adafruit_CharLCD as LCD
from time import sleep

class PyLCD():
    def __init__(self):
        self. LCD_CONF = {
            "rs": 25,  # Pin 22 register select signal (H/L)
            "en": 24,  # Pin 18 Enable Signal
            "d4": 23,  # Pin 16
            "d5": 17,  # Pin 11
            "d6": 18,  # Pin 12
            "d7": 22,  # Pin 15
            "cl": 16,  # Columns in LCD
            "rw": 2,  # Rows in LCD
            "bl": 4,  # Pin 7, (Backlight)
        }
        self.lcd = LCD(self.LCD_CONF["rs"], self.LCD_CONF["en"], self.LCD_CONF["d4"], self.LCD_CONF["d5"],
                       self.LCD_CONF["d6"], self.LCD_CONF["d7"], self.LCD_CONF["cl"], self.LCD_CONF["rw"], self.LCD_CONF["bl"])
        self.lcd.clear()
        
    def clear(self):
        self.lcd.set_cursor(0,0)
        self.lcd.clear()
    def message(self, msg):
        self.lcd.clear()
        self.lcd.set_cursor(0,0)
        self.lcd.message("{}\n{}".format(msg[:16], msg[16:]))
    def write_center(self, title, value):
        self.clear()
        self.lcd.message("{:^16}".format(title))
        self.lcd.set_cursor(0,1) #column first, second row
        self.lcd.message("{:^16}".format(value))
lcd = PyLCD()



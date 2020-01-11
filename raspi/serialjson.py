# Writes and reads json data on serial port terminated at "\n\r"
#uses lib pyserial (pip install pyserial)
# wrapper only
import serial
import json
from time import sleep

class SerialJson:
    def __init__(self, port='/dev/ttyACM0', timeout=1, baudrate=9600):
        self.ser = serial.Serial(
        port = port,
        baudrate = 9600,
        parity = serial.PARITY_NONE,
        stopbits = serial.STOPBITS_ONE,
        bytesize = serial.EIGHTBITS,
        timeout= 1
        )
        self.data = {} # read data
        self.wdata = {} # write data
    def read(self, timeout=1): #reads data into serialjson.readData
        try:
            data = self.ser.readline()
            data = data[:-2]
            data = data.decode("utf-8")
            if(len(data)>0):
                self.data = json.loads(data)
                return True
        except serial.serialutil.SerialException:
            print("Error serialjson.read: Serial Exception")
            return False
        except UnicodeDecodeError:
            print("Error serialjson.read: UTF Decode Exception")
            return False
        except json.decoder.JSONDecodeError:
            print("Error serialjson.read: Json Decode Exception")
            return False
    def readForever(self, timeout = 2):
        while True:
            self.read(timeout)
            print(self.data)
    def write(self, data): #writes json array and terminates at \n
        self.ser.write(str.encode(json.dumps(data) + "\n"))
    def writeForever(self, timeout = 1): # to use this function write the data in wdata and the call this function. Change the data in wdata if you want to change the data.
        while True:
            self.write(self.wdata)
            sleep(1)
    


# serialjson = SerialJson(port="COM4") # for windows
serialjson = SerialJson(port='/dev/ttyACM0') # for raspi - port lef-top



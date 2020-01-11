#https://electrondust.com/2017/11/25/setting-raspberry-pi-wifi-static-ip-raspbian-stretch-lite/
from serialjson import serialjson
from lcd import lcd
 #sends message before loading initializing further to lcd
lcd.write_center("Initialzing", "ACS")
from lcdctrl import lcdCtrl, important_messages #uses lcd and serialjson together. Important messages is used to convey important events to lcd like connection and disconnection.
from cloud import syncOnce, pushAndPull
from server import syncServer
from time import sleep
import threading

lcd.write_center("Loading", "ML Kit")
from predict import *



threads = []
threads.append(threading.Thread(target=serialjson.readForever, name="acs_read_serialjson", daemon= True))
threads.append(threading.Thread(target=serialjson.writeForever, name="acs_write_serialjson", daemon= True))
threads.append(threading.Thread(target=lcdCtrl, name="acs_print_lcd", daemon=True))
threads.append(threading.Thread(target=syncOnce, name="acs_cloud_sync_once", daemon=True))
threads.append(threading.Thread(target=pushAndPull, name="acs_cloud_push_and_pull", daemon=True))
threads.append(threading.Thread(target=syncServer, name="acs_sync_server", daemon=True))
threads.append(threading.Thread(target=predictAndSyncReccurrent, name="acs_ml_predict_and_sync", daemon=True))

# Message pattern
# important_messages.insert(0,{
#     "title": "Hi This is a message",
#     "value": "Message 1"
# })


for thread in threads:
    thread.start()
while True:
    pass




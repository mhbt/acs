from lcd import lcd
from serialjson import serialjson
from time import sleep
sleep_timeout = 3
important_messages = [] #Should be passed dictionary with title and value param
def lcdCtrl():
    sleep(5)
    while True:
        try:
            if(len(important_messages) > 0):
                message = important_messages.pop()
                lcd.write_center(message["title"], message["value"])
                sleep(sleep_timeout)
            else:
                lcd.write_center("Temperature", "{} Degree".format(serialjson.data["temperature"]))
                sleep(sleep_timeout)
                lcd.write_center("Humidity", "{}%".format(serialjson.data["humidity"]))
                sleep(sleep_timeout)
                lcd.write_center("Moisture", "{}%".format(round(100 - (serialjson.data["moisture"]/1024 * 100), 2)))
                sleep(sleep_timeout)
                lcd.write_center("PH", round(serialjson.data["ph"], 2))
                sleep(sleep_timeout)
                lcd.write_center("Reservoir", "{}%".format(serialjson.data["reservoir"]))
                sleep(sleep_timeout)
                lcd.write_center("Irrigation", "Allowed" if serialjson.data["motor-status"] == True else "Disallowed")
                sleep(sleep_timeout)
        except KeyboardInterrupt:
            exit(-100)
        except:
            lcd.write_center("Stablizing", "...")
            sleep(sleep_timeout)


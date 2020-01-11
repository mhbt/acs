from Adafruit_IO import Client, MQTTClient, errors
from time import sleep
from lcdctrl import important_messages #to send important events to lcd
from serialjson import serialjson
from requests import exceptions
#Constants

ADAFRUIT_IO_USERNAME = "ai_eciot"
ADAFRUIT_IO_KEY = "aio_yzoE283hddW3jnp4lTaaHZp4tH19"
aio = Client(ADAFRUIT_IO_USERNAME, ADAFRUIT_IO_KEY)
def syncOnce():
    global aio
    while True:
        try:
            important_messages.insert(0,{
            "title": "Connecting",
            "value": "Sync Once"
            })
            data = aio.receive("motor-status")
            print(data.value)
            important_messages.insert(0, {
            "title": "Sync",
            "value": "Succesful"
            })
            serialjson.wdata = {
                'motor-status': bool(int(data.value))
            }
            print("SyncOnce Terminating!")
            client.connect()
            client.loop_background()
            break
        except errors.AdafruitIOError:
            aio = Client(ADAFRUIT_IO_USERNAME, ADAFRUIT_IO_KEY)
            important_messages.insert(0, {
            "title": "Sync",
            "value": "Failed"
            })
            client.connect()
            client.loop_background()
        except exceptions.ConnectionError:
            aio = Client(ADAFRUIT_IO_USERNAME, ADAFRUIT_IO_KEY)
            important_messages.insert(0, {
            "title": "Sync",
            "value": "Failed"
            })
            client.connect()
            client.loop_background()
        except:
            print("Internet Connection Error")
            aio = Client(ADAFRUIT_IO_USERNAME, ADAFRUIT_IO_KEY)
            important_messages.insert(0,{
            "title": "Cloud Sync",
            "value": "Failed"
            })
            client.connect()
            client.loop_background()


def pushAndPull():
    global aio
    client.connect() #try to connect mqqtt
    while True:
        sleep(20)
        important_messages.insert(0,{
            "title": "Cloud Sync",
            "value": "..."
        })
        try:
            print("Sync Starting")
            aio.send('ph', serialjson.data["ph"])
            aio.send('temperature', serialjson.data["temperature"])
            aio.send('humidity', serialjson.data["humidity"])
            aio.send('moisture', serialjson.data["moisture"])
            aio.send('reservoir', serialjson.data["reservoir"])
            aio.send('motor', "1" if serialjson.data["motor"] == True else "0")
            data = aio.receive("motor-status")
            print("Sync Ended")
            serialjson.wdata = {
                    'motor-status': bool(int(data.value))
                }
            important_messages.insert(0,{
            "title": "Cloud Sync",
            "value": "Succesful"
            })
        except errors.AdafruitIOError:
            print("Adafruit Connection Error")
            aio = Client(ADAFRUIT_IO_USERNAME, ADAFRUIT_IO_KEY)
            important_messages.insert(0,{
            "title": "Cloud Sync",
            "value": "Failed"
            })
            client.connect()
            client.loop_background()
        except exceptions.ConnectionError:
            print("Internet Connection Error")
            aio = Client(ADAFRUIT_IO_USERNAME, ADAFRUIT_IO_KEY)
            important_messages.insert(0,{
            "title": "Cloud Sync",
            "value": "Failed"
            })
            client.connect()
            client.loop_background()
        except:
            print("Internet Connection Error")
            aio = Client(ADAFRUIT_IO_USERNAME, ADAFRUIT_IO_KEY)
            important_messages.insert(0,{
            "title": "Cloud Sync",
            "value": "Failed"
            })
            client.connect()
            client.loop_background()


## MQTT Connections

def connected(client):
    print("Subscribed to MQTT")
    client.subscribe('motor-status')
    important_messages.insert(0,{
        "title": "MQTT",
        "value": "Connected"
    })

def disconnected(client):
    print('MQTT Disconnected')
    important_messages.insert(0,{
        "title": "MQTT",
        "value": "Disconnected"
    })

def message(client, feed_id, payload):
    print('Feed {} recieved new value: {}'.format(feed_id, payload))
    important_messages.insert(0,{
        "title": "MQTT",
        "value": "Recieved"
    })
    serialjson.wdata = {
        'motor-status': bool(int(payload))
    }

#Setup mqtt
client = MQTTClient(ADAFRUIT_IO_USERNAME, ADAFRUIT_IO_KEY)
# Setup the callback functions defined above.
client.on_connect    = connected
client.on_disconnect = disconnected
client.on_message    = message

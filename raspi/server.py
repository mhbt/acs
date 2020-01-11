import requests
import json
from serialjson import serialjson
from time import sleep

def syncServer():
    sleep(10)
    while True:
        payload = {
            "acs_data" : json.dumps({
                "temperature" : serialjson.data["temperature"],
                "humidity": serialjson.data["humidity"],
                "ph": serialjson.data["ph"],
                "reservoir": serialjson.data["reservoir"],
                "moisture": serialjson.data["moisture"],
                "created_by": "Device 1"
                })
        }
        try:
            print("Running SyncServer")
            r = requests.post("http://acs.muhammadhassaan.com/api/save-data.php", payload)
            print("Data Sent To Server. {}".format(r.text))
        except requests.exceptions.ConnectionError:
            print("Server Connection Error.")
        sleep(10)


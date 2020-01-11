import requests
import json

payload = {
    "eciot_data" : json.dumps({
        "temp" : 34,
        "humidity": 15,
        "ph": 7.0,
        "water": 54.0,
        "dryness": 500,
        "created_by": "Device 1"
    })
}
# r = requests.post("http://eciot.muhammadhassaan.com/api/save-data.php", payload)
try:
    r = requests.post("http://eciot.muhammadhassaan.com/api/save-data.php", payload)
    print(r.text)
except requests.exceptions.ConnectionError:
    pass

# r = requests.post("http://localhost/eciot/api/save-data.php", payload)
# lada = json.loads(r.json())
# print(lada.lada)

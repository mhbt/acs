from time import sleep
from datetime import datetime
from picamera import PiCamera
import numpy as np 
import keras
import matplotlib.pyplot as plt
from keras.models import Sequential
from keras.layers import Flatten, Dense
from keras.layers.convolutional import Conv2D
from keras.layers.convolutional import MaxPooling2D
from keras.utils import to_categorical
from keras.preprocessing.image import ImageDataGenerator, img_to_array, load_img
from keras.models import load_model
from lcdctrl import important_messages
import requests
#We couldn't load the model into the module, it is loaded in the function, which helps the thread control.
print("loading machine learning model")
classes = 8
camera = PiCamera()
camera.resolution= (256,256)
labels = [
    "Bacterial Blight",
    "Bacterial Spot",
    "Black Rot",
    "Mosaic Virus",
    "Normal",
    "Powedry_Mildew",
    "Rust",
    "Scab"
]
def predictAndSync(model):
    print("Starting predictAndSync")
    camera.start_preview()
    sleep(2)
    now = datetime.now()
    rand= now.strftime('%m%d%Y%H%M%S')
    camera.capture("images/plant-{}.jpg".format(rand))
    camera.stop_preview()
    try:
        image = load_img("images/plant-{}.jpg".format(rand))
    except:
        image = load_img("images/plant-{}.JPG".format(rand))
    image = img_to_array(image)
    image = image / 255
    reshaped_image = image.reshape(1, 256, 256, 3)
    score = model.predict(reshaped_image)[0]
    score = score * 100
    score = np.around(score, decimals=0)
    print(score)
    predictions = {
    "bacterial_blight" : score[0],
    "bacterial_spot" : score[1],
    "black_rot": score[2],
    "mosaic_virus": score[3],
    "normal": score[4],
    "powedry_mildew": score[5],
    "rust" : score[6],
    "scab": score[7]
    }
    print(predictions)
    url = "http://acs.muhammadhassaan.com/api/save-image.php"
    files = {'picture': open("images/plant-{}.jpg".format(rand), 'rb')}
    response = requests.request("POST", url, files=files, data=predictions)
    print(response.text)

def predictAndSyncReccurrent():
    model = load_model("models/21111.h5")
    while True:
        sleep(30)
        try:
            predictAndSync(model)
        except:
            continue




# predictAndSync()




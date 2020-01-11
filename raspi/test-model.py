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

#constants
classes = 8
x=1
y = 45
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
#Load Model
model = load_model("models/211111.h5")

for i in range(x, y):

    try:
        image = load_img("dataset/test-raw-2/({}).JPG".format(i))
    except:
        image = load_img("dataset/test-raw-2/({}).jpg".format(i))

    image = img_to_array(image)
    image = image / 255
    reshaped_image = image.reshape(1, 256, 256, 3)
    score = model.predict(reshaped_image)[0]
    score = score * 100
    score = np.around(score, decimals=0)
    print(score)
    diseases = []
    for j in range(classes):
        prediction = int(score[j])
        if prediction > 0:
            diseases.append("{}% {}".format(prediction, labels[j]))
    plt.title(", ".join(diseases))
    plt.imshow(image)
    plt.show()


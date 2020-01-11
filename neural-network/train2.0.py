import numpy as numpy
import matplotlib.pyplot as plt
import keras
from keras.models import Sequential
from keras.layers import Flatten, Dense
from keras.layers.convolutional import Conv2D, MaxPooling2D
from keras.utils import to_categorical
from keras.preprocessing.image import ImageDataGenerator
from time import sleep

#Constants
classes = 8
batchsize = 16
targetsize = (256,256)
inputshape = (256, 256, 3)
epochs = 10
dataset_train = "dataset/train2/"
dataset_valid = "dataset/valid2/"
save_file = "models/3.h5"

idg_train = ImageDataGenerator(rescale=1.0 / 255.0)
idg_valid = ImageDataGenerator(rescale=1.0 / 255.0)


train = idg_train.flow_from_directory(dataset_train, target_size=targetsize, class_mode="categorical", batch_size=batchsize, color_mode="rgb", shuffle=True)
valid = idg_valid.flow_from_directory(dataset_valid, target_size=targetsize, class_mode= 'categorical', batch_size= batchsize, color_mode= "rgb", shuffle=True)

#Sanity Check
x, y = train.next()
print(x.shape)

#Model
model = Sequential()

model.add(Conv2D(16, (5,5), activation="relu", input_shape = inputshape))
model.add(Conv2D(16, (5,5), activation="relu"))
model.add(MaxPooling2D(pool_size=(2,2), strides=(2,2)))

model.add(Conv2D(32, (5,5), activation="relu"))
model.add(Conv2D(32, (5,5), activation="relu"))
model.add(MaxPooling2D(pool_size=(2,2), strides=(2,2)))
  

model.add(Conv2D(64, (3,3), activation="relu"))
model.add(Conv2D(64, (3,3), activation="relu"))
model.add(Conv2D(64, (3,3), activation="relu"))   
model.add(MaxPooling2D(pool_size=(2,2), strides=(2,2)))

model.add(Conv2D(64, (2,2), activation="relu"))
model.add(Conv2D(64, (2,2), activation="relu"))
model.add(Conv2D(64, (2,2), activation="relu"))
model.add(MaxPooling2D(pool_size=(2,2), strides=(2,2)))


model.add(Flatten())
model.add(Dense(300, activation="relu"))
model.add(Dense(classes, activation="softmax"))

#Compile Model
model.compile(optimizer="ADAM", loss="categorical_crossentropy", metrics=["accuracy"])

#print Summary
model.summary()
sleep(10)
#Run Model
history = model.fit_generator(train, validation_data = valid, epochs = epochs, shuffle=True)

#Save Model
model.save(save_file)


#Print Graphs
acc = history.history['acc']
val_acc = history.history['val_acc']
loss = history.history['loss']
val_loss = history.history['val_loss']
epochs = range(1, len(acc) + 1)
plt.plot(epochs, acc, 'b', label = 'Training Accuracy')
plt.plot(epochs, val_acc, 'r', label="Validation Accuracy")
plt.title('Training and Validation Accuracy')
plt.legend()

plt.figure()
plt.plot(epochs, loss, 'b', label='Training Loss')
plt.plot(epochs, val_loss, 'r', label="Validation Loss")
plt.title("Training and Validation Loss")
plt.legend()
plt.show()
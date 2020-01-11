import numpy as np 
import keras
import matplotlib.pyplot as plt
from keras.models import Sequential
from keras.layers import Flatten, Dense
from keras.layers.convolutional import Conv2D
from keras.layers.convolutional import MaxPooling2D
from keras.utils import to_categorical
from keras.preprocessing.image import ImageDataGenerator
from keras.models import load_model

load_file = "models/21111.h5"
save_file = "models/211111.h5"
dataset_train = "dataset/train2/"
dataset_valid = "dataset/valid/"
targetsize = (256,256)
# inputshape = (256, 256, 3)
batchsize = 16
epochs = 5
model = load_model(load_file)

idg_train = ImageDataGenerator(rescale=1.0 / 255.0)
# idg_train_aug = ImageDataGenerator(rescale=1.0 / 255.0, shear_range=0.2, zoom_range=0.2, width_shift_range=0.1, height_shift_range=0.1, zca_whitening=True, vertical_flip=True, horizontal_flip=True)
idg_valid = ImageDataGenerator(rescale=1.0 / 255.0)




train = idg_train.flow_from_directory(dataset_train, target_size=targetsize, class_mode="categorical", batch_size=batchsize, color_mode="rgb", shuffle=True)
valid = idg_valid.flow_from_directory(dataset_valid, target_size=targetsize, class_mode= 'categorical', batch_size= batchsize, color_mode= "rgb", shuffle=True)


#Train Model
history = model.fit_generator(train, validation_data=valid, epochs = epochs)

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



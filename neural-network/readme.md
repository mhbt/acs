1.h5 => ~ 0.8A ~ 0.65VA
increasing batch size
for 21.h5 idg_train = ImageDataGenerator(rescale=1.0 / 255.0, rotation_range= 60, shear_range=0.1, zoom_range=0.2, vertical_flip=True)
improved 2 to 21
130/130 [==============================] - 165s 1s/step - loss: 0.5301 - acc: 0.8065 - val_loss: 0.7554 - val_acc: 0.7472

for 211
dataset_train = "dataset/train2/"
dataset_valid = "dataset/valid2/"
improved 2 to 211
idg_train = ImageDataGenerator(rescale=1.0 / 255.0, shear_range=0.1, zoom_range=0.1)
idg_valid = ImageDataGenerator(rescale=1.0 / 255.0)
130/130 [==============================] - 168s 1s/step - loss: 0.1973 - acc: 0.9365 - val_loss: 0.7274 - val_acc: 0.7787

for 2111
dataset_train = "dataset/train2/"
dataset_valid = "dataset/train/"
targetsize = (256,256)
# inputshape = (256, 256, 3)
batchsize = 16
idg_train = ImageDataGenerator(rescale=1.0 / 255.0, shear_range=0.2, zoom_range=0.2, rotation_range=20, width_shift_range=0.1, height_shift_range=0.1)
idg_valid = ImageDataGenerator(rescale=1.0 / 255.0)
Epoch 4/5
259/259 [==============================] - 158s 611ms/step - loss: 0.5703 - acc: 0.7930 - val_loss: 0.5944 - val_acc: 0.8036
Epoch 5/5
259/259 [==============================] - 167s 646ms/step - loss: 0.5429 - acc: 0.8031 - val_loss: 0.8417 - val_acc: 0.7740

for 21111 over 2111
also added some more images
dataset_train = "dataset/train2/"
dataset_valid = "dataset/train/"
targetsize = (256,256)
# inputshape = (256, 256, 3)
batchsize = 16
epochs = 5
Epoch 4/5
idg_train = ImageDataGenerator(rescale=1.0 / 255.0, shear_range=0.2, zoom_range=0.2, rotation_range=20, width_shift_range=0.1, height_shift_range=0.1)
idg_valid = ImageDataGenerator(rescale=1.0 / 255.0)
259/259 [==============================] - 163s 629ms/step - loss: 0.4423 - acc: 0.8405 - val_loss: 0.6623 - val_acc: 0.8104
Epoch 5/5
259/259 [==============================] - 165s 636ms/step - loss: 0.4302 - acc: 0.8361 - val_loss: 0.7472 - val_acc: 0.7942


for 211111 over 21111
dataset_train = "dataset/train2/"
dataset_valid = "dataset/valid/"
targetsize = (256,256)
# inputshape = (256, 256, 3)
batchsize = 16
epochs = 5
model = load_model(load_file)


idg_train = ImageDataGenerator(rescale=1.0 / 255.0, shear_range=0.2, zoom_range=0.2, width_shift_range=0.1, height_shift_range=0.1, zca_whitening=True, vertical_flip=True, horizontal_flip=True)
but it should be called with .fit() which I didn't
idg_valid = ImageDataGenerator(rescale=1.0 / 255.0)
Epoch 4/5
259/259 [==============================] - 155s 597ms/step - loss: 0.4416 - acc: 0.8378 - val_loss: 0.7754 - val_acc: 0.7885
Epoch 5/5
259/259 [==============================] - 155s 598ms/step - loss: 0.4317 - acc: 0.8470 - val_loss: 0.7901 - val_acc: 0.7971
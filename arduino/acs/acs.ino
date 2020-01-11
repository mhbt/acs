#include <ArduinoJson.h> //reads and write json for us.
#include <dht.h> //DHT Library, included with the code, has to be imported into arduino for used as .zip
dht DHT;
String input_uart = ""; // to read and json into string.
StaticJsonDocument<200> json_input; //json object for reading.
StaticJsonDocument<200> json_output; //json object for writing.

//Pins
const byte trig = 8; //Distance Sensor Trigger
const byte echo = 9; //Distance Sensor Echo
const byte moisture_pin = A5; //Moisture Analog. Digital is connected to 8 but isn't used.
const byte motor_pin = 7; // Kept 'HIGH' to keep motor off and low to start motor. (Rectifier)
const byte dht_pin = 4; // DHT 11 used and connected to A4
const byte ph_pin = A0; // PH Sensor Connected to A0

// Control Values
const double reservoir_empty = 19.52; //Full empty 19.52cms with some water filled 17.29
const double reservoir_full = 4;
const double reservoir_height =  reservoir_empty - reservoir_full;
const double moisture_control = 850;

//Values
double reservoir = 100.00;
bool motor = false; // Tells if motor is on or off at the moment
bool motor_status = false; //Checks if motor is allowed to run or not should be false initially
short moisture = 0;
float temperature = 25.00;
float humidity = 26.00;
double ph = 7.00;

void setup() {
  // Initialization
  Serial.begin(9600); //Began Serial @ 9600 baud rate. (Data Transfer Rate)
  
  pinMode(trig, OUTPUT);
  digitalWrite(trig, LOW); // Keep Trig Low
  
  pinMode(echo, INPUT);
  
  pinMode(moisture_pin, INPUT);
  
  pinMode(motor_pin, OUTPUT);
  digitalWrite(motor_pin, HIGH); // Turn off the motor
  
  pinMode(dht_pin, INPUT);
  
  pinMode(ph_pin, INPUT);

  delay(1000); // wait for 5 seconds for sensors to stabalize.

}

void loop() {
  //Measure the soil moisture
  moisture = analogRead(moisture_pin);
  
  //Measure the fluid(water) in reservoir 
  digitalWrite(trig, HIGH);
  delayMicroseconds(10);
  digitalWrite(trig, LOW);
  
  float distance = ((double) pulseIn(echo, HIGH) * 0.0343)/2;
  distance = distance - reservoir_full;
  if(distance <= 2.05 || distance >=1100){ // distance lower than two isn't measurable.
    distance = 0;
  }
  if(distance > reservoir_height){
    distance = reservoir_height; //prevents negative values 
  }
  reservoir =(((double)(reservoir_height)- distance) * 100 / reservoir_height); //limit from distane sensor is 4.Water too close to it will ruin distance sensor
  
  //Water the soil using motor
  if(motor_status == true){
    //Check for the mositure value with moisture control
    if(moisture >= moisture_control && reservoir > 0){
      motor = true;
      digitalWrite(motor_pin, LOW);
    }else{
       motor = false;
      digitalWrite(motor_pin, HIGH);
    }
  }else{
    motor = false;
     digitalWrite(motor_pin, HIGH);
  }


  //Measure ph of the soil
  short av = analogRead(ph_pin); //Analog Value (av)
  double voltage = (double) 5.0 * av / 1024;
  ph = (double) 3.5 * voltage + 0;

  //Measure temperature an humidity
  DHT.read11(dht_pin);
  humidity = DHT.humidity;
  temperature = DHT.temperature;

  
  //Debug
//  Serial.print("Moisture: ");
//  Serial.print(moisture);
//  Serial.print("\t");
//  Serial.print("Reservoir: ");
//  Serial.print(reservoir);
//  Serial.print("\t");
//  Serial.print("Temp: ");
//  Serial.print(temperature);
//  Serial.print("\t");
//  Serial.print("Humidity: ");
//  Serial.print(humidity);
//  Serial.print("\t");
//  Serial.print("PH: ");
//  Serial.print(ph);
//  Serial.print("\t");
//  Serial.print("Distance: ");
//  Serial.print(distance);
//  Serial.println("");
  sendJson();
  readJson();
  delay(1000);
  

}

//Neccessary for json to work with serial it helps terminate at \n
void serialEvent(){
  int length = Serial.available();
  if(length > 0){
    input_uart = String(Serial.readStringUntil('\n'));
  }
}
void readJson(){
  DeserializationError error = deserializeJson(json_input, input_uart);
  if(!error){
    /*
     * Receive Json values from raspi here.
    */
     motor_status = (bool) json_input["motor-status"];
  }
  /*
  {"motor-status": true} check by sending this value with true or false in the serial monitor
  */
}
void sendJson(){
  /*
   * Initialize json values to be sent.
  */
  json_output["ph"] = ph;
  json_output["motor"] = motor;
  json_output["temperature"] = temperature;
  json_output["humidity"] = humidity;
  json_output["moisture"] = moisture;
  json_output["reservoir"] = reservoir;
  json_output["motor-status"] = motor_status;
  if(Serial.availableForWrite()){
      serializeJson(json_output, Serial);
      Serial.println();
      Serial.flush();
    }
   /*
    * Standard Json Output in serial Monitor
    * {"ph":7.331543,"motor":true,"temperature":0,"humidity":0,"moisture":950,"reservoir":0}

   */
}

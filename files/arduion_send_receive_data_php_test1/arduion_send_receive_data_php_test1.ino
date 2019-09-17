#include <ArduinoJson.h>
#include "dht.h"
#define dht_apin D5
dht DHT;

/* HTTP Client POST Request
 * Copyright (c) 2018, circuits4you.com
 * All rights reserved.
 * https://circuits4you.com 
 * Connects to WiFi HotSpot. */
 
#include <ESP8266WiFi.h>
#include <WiFiClient.h> 
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>
 
/* Set these to your desired credentials. */
const char *ssid = "HOLOGRAM";  //ENTER YOUR WIFI SETTINGS
const char *password = "untukapa?";
 
//Web/Server address to read/write from 
const char *host = "http://makassarrobotics.000webhostapp.com";   //https://circuits4you.com website or IP address of server
 
//=======================================================================
//                    Power on setup
//=======================================================================
 
void setup() {
  delay(1000);

  pinMode(D4, OUTPUT);
  Serial.begin(9600);
  WiFi.mode(WIFI_OFF);        //Prevents reconnection issue (taking too long to connect)
  delay(1000);
  WiFi.mode(WIFI_STA);        //This line hides the viewing of ESP as wifi hotspot
  
  WiFi.begin(ssid, password);     //Connect to your WiFi router
  Serial.println("");
 
  Serial.print("Connecting");
  // Wait for connection
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
 
  //If connection successful show IP address in serial monitor
  Serial.println("");
  Serial.print("Connected to ");
  Serial.println(ssid);
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());  //IP address assigned to your ESP
  delay(3000);
}
 
//=======================================================================
//                    Main Program Loop
//=======================================================================
float a = 1.1, b = 2.2, c = 3.3, d = 4.4;
void loop() {

  HTTPClient http;    //Declare object of class HTTPClient
 
  String suhu_udara, lembab_udara, lembab_tanah, ph_tanah, postData;
  int adcvalue=analogRead(A0);  //Read Analog value of LDR

  DHT.read11(dht_apin);
  suhu_udara = String(DHT.temperature);   //String to interger conversion
  lembab_udara = String(DHT.humidity);
  lembab_tanah = String(b);
  ph_tanah = String(c);
 
  //Post Data
//  postData = "status=" + ADCData + "&station=" + station ;
  postData = "suhu_udara=" + suhu_udara +"&lembab_udara="+ lembab_udara + "&lembab_tanah="+ lembab_tanah + "&ph_tanah=" + ph_tanah ;
  
  http.begin("http://makassarrobotics.000webhostapp.com/iot_farm/api/add_data.php");              //Specify request destination
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");    //Specify content-type header
 
  int httpCode = http.POST(postData);   //Send the request
  String payload = http.getString();    //Get the response payload
 
  Serial.println(httpCode);   //Print HTTP return code
  Serial.println(payload);    //Print request response payload
   
 DynamicJsonBuffer  jsonBuffer;

  JsonObject& dataLog = jsonBuffer.parseObject(payload);


  // Test if parsing succeeds.
  if (!dataLog.success()) {
    Serial.println("parseObject() failed");
    return;
  }

  String pompa = dataLog["kontrol"][0]["value"]; 
  
  Serial.println("DATA : " + pompa);

  if(pompa == "ON"){
    digitalWrite(D4, LOW);
  }else if(pompa == "OFF"){
    digitalWrite(D4, HIGH);
  }
  http.end();  //Close connection

  a++; b++; c++; d++;
  delay(5000);  //Post Data at every 5 seconds
  
}

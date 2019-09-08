#include <ArduinoJson.h>

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
const char *ssid = "mantap";  //ENTER YOUR WIFI SETTINGS
const char *password = "anuanuanu";
 
//Web/Server address to read/write from 
const char *host = "192.168.43.153";   //https://circuits4you.com website or IP address of server
 
//=======================================================================
//                    Power on setup
//=======================================================================
 
void setup() {
  delay(1000);

  pinMode(D4, OUTPUT);
  Serial.begin(115200);
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
}
 
//=======================================================================
//                    Main Program Loop
//=======================================================================
int suhu = 0;
void loop() {
  suhu++;
  HTTPClient http;    //Declare object of class HTTPClient
 
  String ADCData, station, postData;
  int adcvalue=analogRead(A0);  //Read Analog value of LDR
  ADCData = String(suhu);   //String to interger conversion
  station = "A";
 
  //Post Data
//  postData = "status=" + ADCData + "&station=" + station ;
  postData = "suhu=" + ADCData ;//
  
  http.begin("http://192.168.43.153/iot/add_data.php");              //Specify request destination
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

  String lampu1 = dataLog["hasil"][0]["status"];
  
  Serial.println("DATA : " + lampu1);

  if(lampu1 == "ON"){
    digitalWrite(D4, HIGH);
  }else if(lampu1 == "OFF"){
    digitalWrite(D4, LOW);
  }
  http.end();  //Close connection
  
  delay(5000);  //Post Data at every 5 seconds
}

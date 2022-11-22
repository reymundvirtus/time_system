#include "Arduino.h"
#include <SPI.h>
#include <MFRC522.h>
#include <Ethernet.h>
#include <TimeLib.h>     // for update/display of time
#include <LiquidCrystal_I2C.h>

// Pin Definitions
#define RFID_PIN_RST 9
#define RFID_PIN_SDA 8
#define LCD_ADDRESS 0x3F
#define LCD_ROWS 2
#define LCD_COLUMNS 16
#define SCROLL_DELAY 150
#define BACKLIGHT 255
LiquidCrystal_I2C lcd(0x27,20,4);
MFRC522 mfrc522(RFID_PIN_SDA, RFID_PIN_RST);

char menuOption = 0;

// replace the MAC address below by the MAC address printed on a sticker on the Arduino Shield 2
byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };

void setup() {
  Serial.begin(9600);
  
//initialize RFID module
  SPI.begin();
  mfrc522.PCD_Init();
  menuOption = menu();
}

void insert(){

  String content = "";
  byte letter;
////  // Look for new cards
  if ( ! mfrc522.PICC_IsNewCardPresent())
  {
    return;
  }
//  // Select one of the cards
  if ( ! mfrc522.PICC_ReadCardSerial())
  {
    return;
  }
  
  EthernetClient client;

  int    HTTP_PORT   = 80;
  String HTTP_METHOD = "GET";
  char   HOST_NAME[] = "192.168.100.17"; // change to your PC's IP address
  String PATH_NAME   = "/rfid_time_users.php"; //rfid_insert_user.php
  String val1 = "?code=";
//  String val2 = "&name=";

  
//  Serial.print(code);
   
  // initialize the Ethernet shield using DHCP:
  if (Ethernet.begin(mac) == 0) {
    Serial.println("Failed to obtaining an IP address using DHCP");
    while(true);
  }

  // connect to web server on port 80:
  if(client.connect(HOST_NAME, HTTP_PORT)) {
    // if connected:
    Serial.println("Connected to server");
    // make a HTTP request:
    // send HTTP header
    String names = "Admin";

    Serial.print("UID tag :");
   for (byte i = 0; i < mfrc522.uid.size; i++)
    {
    Serial.print(mfrc522.uid.uidByte[i] < 0x10 ? "-0" : "-");
    Serial.print(mfrc522.uid.uidByte[i], HEX);
    content.concat(String(mfrc522.uid.uidByte[i] < 0x10 ? "-0" : "-"));
    content.concat(String(mfrc522.uid.uidByte[i], HEX));
   }
   content.toUpperCase();
   String code = String(content.substring(1));
//   Serial.print(code);
    
    client.println(HTTP_METHOD + " " + PATH_NAME + val1 + code +" HTTP/1.1");

    client.println("Host: " + String(HOST_NAME));
    client.println("Connection: close");
    client.println(); // end HTTP header

    while(client.connected()) {
      if(client.available()){
        // read an incoming byte from the server and print it to serial monitor:
        char c = client.read();
        Serial.print(c);
      }
    }

    // the server's disconnected, stop the client:
    client.stop();
    Serial.println();
    //Serial.println("disconnected");
  } else {// if not connected:
    Serial.println("connection failed");
  }
}

// FOR EMPLOYEES TIME IN

void time_in() {
  String content = "";
  byte letter;
////  // Look for new cards
  if ( ! mfrc522.PICC_IsNewCardPresent())
  {
    return;
  }
//  // Select one of the cards
  if ( ! mfrc522.PICC_ReadCardSerial())
  {
    return;
  }
  
  EthernetClient client;

  int    HTTP_PORT   = 80;
  String HTTP_METHOD = "GET";
  char   HOST_NAME[] = "192.168.100.17"; // change to your PC's IP address
  String PATH_NAME   = "/rfid_time_in_users.php";
  String val1 = "?code=";
//  String val2 = "&name=";

  
//  Serial.print(code);
   
  // initialize the Ethernet shield using DHCP:
  if (Ethernet.begin(mac) == 0) {
    Serial.println("Failed to obtaining an IP address using DHCP");
    while(true);
  }

  // connect to web server on port 80:
  if(client.connect(HOST_NAME, HTTP_PORT)) {
    // if connected:
    Serial.println("Connected to server");
    // make a HTTP request:
    // send HTTP header
    String names = "Admin";

    Serial.print("UID tag :");
   for (byte i = 0; i < mfrc522.uid.size; i++)
    {
    Serial.print(mfrc522.uid.uidByte[i] < 0x10 ? "-0" : "-");
    Serial.print(mfrc522.uid.uidByte[i], HEX);
    content.concat(String(mfrc522.uid.uidByte[i] < 0x10 ? "-0" : "-"));
    content.concat(String(mfrc522.uid.uidByte[i], HEX));
   }
   content.toUpperCase();
   String code = String(content.substring(1));
//   Serial.print(code);
    
    client.println(HTTP_METHOD + " " + PATH_NAME + val1 + code +" HTTP/1.1");

    client.println("Host: " + String(HOST_NAME));
    client.println("Connection: close");
    client.println(); // end HTTP header

    while(client.connected()) {
      if(client.available()){
        // read an incoming byte from the server and print it to serial monitor:
        char c = client.read();
        Serial.print(c);
      }
    }

    // the server's disconnected, stop the client:
    client.stop();
    Serial.println();
    //Serial.println("disconnected");
  } else {// if not connected:
    Serial.println("connection failed");
  }
}

void time_out() {
  String content = "";
  byte letter;
////  // Look for new cards
  if ( ! mfrc522.PICC_IsNewCardPresent())
  {
    return;
  }
//  // Select one of the cards
  if ( ! mfrc522.PICC_ReadCardSerial())
  {
    return;
  }
  
  EthernetClient client;

  int    HTTP_PORT   = 80;
  String HTTP_METHOD = "GET";
  char   HOST_NAME[] = "192.168.100.17"; // change to your PC's IP address
  String PATH_NAME   = "/rfid_time_out_users.php";
  String val1 = "?code=";
//  String val2 = "&name=";

  
//  Serial.print(code);
   
  // initialize the Ethernet shield using DHCP:
  if (Ethernet.begin(mac) == 0) {
    Serial.println("Failed to obtaining an IP address using DHCP");
    while(true);
  }

  // connect to web server on port 80:
  if(client.connect(HOST_NAME, HTTP_PORT)) {
    // if connected:
    Serial.println("Connected to server");
    // make a HTTP request:
    // send HTTP header
    String names = "Admin";

    Serial.print("UID tag :");
   for (byte i = 0; i < mfrc522.uid.size; i++)
    {
    Serial.print(mfrc522.uid.uidByte[i] < 0x10 ? "-0" : "-");
    Serial.print(mfrc522.uid.uidByte[i], HEX);
    content.concat(String(mfrc522.uid.uidByte[i] < 0x10 ? "-0" : "-"));
    content.concat(String(mfrc522.uid.uidByte[i], HEX));
   }
   content.toUpperCase();
   String code = String(content.substring(1));
//   Serial.print(code);
    
    client.println(HTTP_METHOD + " " + PATH_NAME + val1 + code +" HTTP/1.1");

    client.println("Host: " + String(HOST_NAME));
    client.println("Connection: close");
    client.println(); // end HTTP header

    while(client.connected()) {
      if(client.available()){
        // read an incoming byte from the server and print it to serial monitor:
        char c = client.read();
        Serial.print(c);
      }
    }

    // the server's disconnected, stop the client:
    client.stop();
    Serial.println();
    //Serial.println("disconnected");
  } else {// if not connected:
    Serial.println("connection failed");
  }
}

void loop() {

  if(menuOption == '1') {
    insert();
  }
  if(menuOption == '2') {
    time_in();
  }
  if(menuOption == '3') {
    time_out();
  }
}

char menu()
{

    Serial.println(F("\nWhich option would you like to do?"));
    Serial.println(F("(1) INSERT NEW EMPLOYEE/LOGIN"));
    Serial.println(F("(2) EMPLOYEES TIME IN"));
    Serial.println(F("(3) EMPLOYEES TIME OUT"));
    Serial.println(F("(menu) send anything else or press on board reset button\n"));
    while (!Serial.available());

    // Read data from serial monitor if received
    while (Serial.available()) 
    {
        char c = Serial.read();
        if (isAlphaNumeric(c)) 
        {   
            
          if(c == '1') 
            {Serial.println(F("Approximate your card to the reader to INSERT OR LOGIN...\n"));}
          else if(c == '2') 
            {Serial.println(F("Approximate your card to the reader to TIME IN...\n"));}
          else if(c == '3') 
            {Serial.println(F("Approximate your card to the reader to TIME OUT...\n"));}
          else
          {
              Serial.println(F("illegal input!"));
              return 0;
          }
          return c;
        }
    }
}
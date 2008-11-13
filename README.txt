This version of the PureMVC Framework for PHP comes bundled with
a Basic Demo based on the CSS Zen Garden (http://www.csszengarden.com/)

The demo uses the file name and a POST variable to determine which 
page to load and which CSS file to parse into the page.  Since the 
demo is only one page, there is only one switch case for '/index.php',  
However, depending on what link is clicked in the style selection 
section of the index.php a different "c" POST variable is sent and 
a new CSS is displayed.

----------------------------------------
Installation on Mac with MAMP
----------------------------------------
1.) Download MAMP from http://www.mamp.info/en/index.php

2.) Install MAMP, by default it goes in the Applications folder.

3.) Click on the MAMP icon to start the MAMP Control Panel.  MAMP will
prompt for your user password.  After entering your password the
control panel will start the Apache server and MySQL server and the
MAMP start page will appear with links to PHPMyAdmin and other tools.

4.) Open the MAMP installation folder.  In the MAMP folder open the 
'htdocs' folder.  By default this is where MAMP will look for index
when browsing to http://localhost:80.  Place the index.php, org and
images folders in the htdocs folder.

5.) Browse to http://localhost in your web browser to run the demo.


----------------------------------------
Installation on Windows with XAMPP
----------------------------------------
1.) Download XAMPP from http://www.apachefriends.org/en/xampp.html

2.) Double click the xampp-win32-1.6.8.exe or current version.  It will
prompt you for a location to extract the files.

3.) In the xampp folder, double click the setup_xampp.bat file to set up
xampp.

4.) Double click the xampp-control.exe when the setup is complete.
The XAMPP Control Panel allows you to start and stop the Apache
and MySQL server as well as a couple of others.  For the demo only
Apache and MySQL server should be running.  The Control Panel starts
and stops the servers, but does not stop then when you exit the 
Control Panel like MAMP does, so make sure to turn off your server
if you do not want it on before exiting the Control Panel.

5.) Open the xampp folder.  In there locate and open the htdocs folder.
By default this is where XAMPP will look for index when browsing to 
http://localhost.  Place the index.php, org and images folders in the
htdocs folder.

6.) Browse to http://localhost in your web browser to run the demo.




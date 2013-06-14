# Observium Sensors

#### Delta UPS 

> You must use the included `/includes/defaults.inc.php` or modify your current one and comment out or remove line 598 (remove rf1628 association) or you will have duplicate sensors.

Sensor | Includes | Path
--- | --- | ---
Current | Input, Output, Battery, Bypass | `/includes/discovery/current/deltaups.inc.php`
Frequency | Input, Output, Battery | `/includes/discovery/frequency/deltaups.inc.php`
Humidity | Environment | `/includes/discovery/humidity/deltaups.inc.php`
Temperatures | Environment, Battery | `/includes/discovery/temperatures/deltaups.inc.php`
Voltages | Input, Output, Battery, Bypass | `/includes/discovery/voltages/deltaups.inc.php`
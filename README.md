# Observium Sensors

Installation
---------------
To install these sensors you can select specific files or use all of them.  Just copy the `/includes/discovery` to your current installation.  Observium will automatically load them through the next discovery.

You do not need to use the included `/includes/defaults.inc.php` file but you will need to comment or remove any required lines specified below.

Force discovery:
`./discovery.php -h all`

___
#### Delta UPS (has been pushed to current SVN repo)

> You must use the included `/includes/defaults.inc.php` or modify your current one and comment out or remove line 598 (remove rf1628 association) or you will have duplicate sensors.

Sensor | Includes | Path
--- | --- | ---
Current | Input, Output, Battery, Bypass | `/includes/discovery/current/deltaups.inc.php`
Frequency | Input, Output, Battery | `/includes/discovery/frequency/deltaups.inc.php`
Humidity | Environment | `/includes/discovery/humidity/deltaups.inc.php`
Temperatures | Environment, Battery | `/includes/discovery/temperatures/deltaups.inc.php`
Voltages | Input, Output, Battery, Bypass | `/includes/discovery/voltages/deltaups.inc.php`

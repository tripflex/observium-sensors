<?php
// @title Delta UPS
// ------------------------------------------------------------------------------------------
// Observium SNMP Sensor
// @sensor voltages
// @device deltaups
// ------------------------------------------------------------------------------------------
// @author Myles McNamara
// @date 6.13.2013
// @version 1.0
// @source https://gh.smyl.es/observium-sensors
// ------------------------------------------------------------------------------------------
// @file deltaups.inc.php
// @usage This file requires Observium, this is only a sensor module.
// ------------------------------------------------------------------------------------------
// @copyright Copyright (C) 2013  Myles McNamara
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
// You should have received a copy of the GNU General Public License
// along with this program. If not, see <http://www.gnu.org/licenses/>.
// ------------------------------------------------------------------------------------------

// DeltaUPS-MIB
if ($device['os'] == "deltaups")
{
  echo("DeltaUPS-MIB ");
  $dupsVoltage = array( 
              array(  OID => "1.3.6.1.4.1.2254.2.4.7.6.0", 
                            descr => "Battery",
                            divisor => 10
                        ),
              array(  OID => "1.3.6.1.4.1.2254.2.4.5.4.0", 
                            descr => "Output",
                            divisor => 10
                        ),
              array(  OID => "1.3.6.1.4.1.2254.2.4.4.3.0", 
                            descr => "Input",
                            divisor => 10
                        ),
              array(  OID => "1.3.6.1.4.1.2254.2.4.6.3.0", 
                            descr => "Bypass",
                            divisor => 10
                        )
             );
  foreach ($dupsVoltage as $eachArray => $eachValue) {
    $current = snmp_get($device, $eachValue['OID'], "-O vq");
    $index = substr(strstr($eachValue['OID'], '2254.2.4'), 9);
    discover_sensor($valid['sensor'], 'voltage', $device, $eachValue['OID'], $index, "DeltaUPS", $eachValue['descr'], $eachValue['divisor'], '1', NULL, NULL, NULL, NULL, $current);
  }
}

?>

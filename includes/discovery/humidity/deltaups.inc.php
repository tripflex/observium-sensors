<?php
// @title Delta UPS
// ------------------------------------------------------------------------------------------
// Observium SNMP Sensor
// @sensor humidity
// @device deltaups
// ------------------------------------------------------------------------------------------
// @author Myles McNamara
// @date 6.17.2013
// @version 1.1
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
  $dupsHumidity = array( 
              array(  OID => "1.3.6.1.4.1.2254.2.4.10.2.0", 
                            descr => "Environment",
                            divisor => 1
                        )
             );
  foreach ($dupsHumidity as $eachArray => $eachValue)
  {
    // DeltaUPS does not have tables, so no need to walk, only need snmpget
    $current = snmp_get($device, $eachValue['OID'], "-O vq");
    // Get index values from current OID
    $preIndex = strstr($eachValue['OID'], '2254.2.4');
    // Format and strip index to only include everything after 2254.2.4
    $index = substr($preIndex, 9);
      // Prevent NULL returned values from being added as sensors
      if($current != "NULL" )
      {
        discover_sensor($valid['sensor'], 'humidity', $device, $eachValue['OID'], $index, "DeltaUPS", $eachValue['descr'], $eachValue['divisor'], '1', NULL, NULL, NULL, NULL, $current);
      }
  }
}

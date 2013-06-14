<?php

/**
 * Observium Network Management and Monitoring System
 * Copyright (C) 2006-2013, Observium Developers - http://www.observium.org
 *
 * @package    observium
 * @subpackage config
 * @author     Adam Armstrong <adama@memetic.org>
 * @copyright  (C) 2006 - 2013 Adam Armstrong
 *
 */

///
// Please don't edit this file -- make changes to the configuration array in config.php
///

error_reporting(E_ERROR);

// Default directories

$config['install_dir']   = "/opt/observium";
#$config['html_dir']      = $config['install_dir'] . "/html";
#$config['rrd_dir']       = $config['install_dir'] . "/rrd";
#$config['log_file']      = $config['install_dir'] . "/observium.log";
#$config['temp_dir']      = "/tmp";

// What is my own hostname (used so observium can identify its host in its own database)
$config['own_hostname'] = "localhost";

// Location of executables

$config['rrdtool']        = "/usr/bin/rrdtool";
$config['fping']          = "/usr/bin/fping";
$config['fping6']         = "/usr/bin/fping6";
$config['snmpwalk']       = "/usr/bin/snmpwalk";
$config['snmpget']        = "/usr/bin/snmpget";
$config['snmpbulkwalk']   = "/usr/bin/snmpbulkwalk";
$config['snmptranslate']  = "/usr/bin/snmptranslate";
$config['whois']          = "/usr/bin/whois";
$config['mtr']            = "/usr/bin/mtr";
$config['nmap']           = "/usr/bin/nmap";
$config['nagios_plugins'] = "/usr/lib/nagios/plugins";
$config['ipmitool']       = "/usr/bin/ipmitool";
$config['virsh']          = "/usr/bin/virsh";
$config['dot']            = "/usr/bin/dot";
$config['unflatten']      = "/usr/bin/unflatten";
$config['neato']          = "/usr/bin/neato";
$config['sfdp']           = "/usr/bin/sfdp";
$config['svn']            = "/usr/bin/svn";

// RRD Format Settings
// These should not normally be changed
// Though one could conceivably increase or decrease the size of each RRA if one had performance problems
// Or if one had a very fast I/O subsystem with no performance worries.

$config['rrd_rra']  = " RRA:AVERAGE:0.5:1:2016 RRA:AVERAGE:0.5:6:1440 RRA:AVERAGE:0.5:24:1440 RRA:AVERAGE:0.5:288:1440 ";
$config['rrd_rra'] .= "                        RRA:MIN:0.5:6:1440     RRA:MIN:0.5:96:360      RRA:MIN:0.5:288:1440 ";
$config['rrd_rra'] .= "                        RRA:MAX:0.5:6:1440     RRA:MAX:0.5:96:360      RRA:MAX:0.5:288:1440 ";
$config['rrd_rra'] .= " RRA:LAST:0.5:1:1       RRA:LAST:0.5:6:1       RRA:LAST:0.5:24:1       RRA:LAST:0.5:288:1";

// RRDCacheD - Make sure it can write to your RRD dir!

#$config['rrdcached']    = "unix:/var/run/rrdcached.sock";

// Web Interface Settings

if (isset($_SERVER["SERVER_NAME"]) && isset($_SERVER["SERVER_PORT"]))
{
  if (strpos($_SERVER["SERVER_NAME"] , ":"))
  {
    // Literal IPv6
    $config['base_url']  = "http://[" . $_SERVER["SERVER_NAME"] ."]" . ($_SERVER["SERVER_PORT"] != 80 ? ":".$_SERVER["SERVER_PORT"] : '') ."/";
  }
  else
  {
    $config['base_url']  = "http://" . $_SERVER["SERVER_NAME"] . ($_SERVER["SERVER_PORT"] != 80 ? ":".$_SERVER["SERVER_PORT"] : '') ."/";
  }
}

$config['title_image']      = "images/observium-logo.png";
$config['title_url']        = "";
$config['stylesheet']       = "css/styles.css";
$config['mono_font']        = "DejaVuSansMono";
$config['favicon']          = "images/observium-icon.png";
$config['header_color']     = "#1F334E";
$config['page_refresh']     = "300";  // Refresh the page every xx seconds, 0 to disable
$config['front_page']       = "pages/front/default.php";
$config['page_title_prefix'] = "Observium :: Network Observation and Monitoring";
$config['timestamp_format'] = 'Y-m-d H:i:s';
$config['page_gen']         = 1;
$config['web_header']       = "header.inc.php";  // in html/includes
$config['login_message']    = "Unauthorised access or use shall render the user liable to criminal and/or civil prosecution.";
$config['web_mouseover']    = TRUE;      // Enable or disable mouseover popups.
$config['web_show_disabled'] = TRUE;     // Show or not disabled devices on major pages.

$config['old_graphs']             = 1;   // RRDfiles from before the great rra reform. This is default for a while.

$config['int_customers']           = 1;  // Enable Customer Port Parsing
$config['int_customers_graphs' ]   = 1;  // Enable Customer Port List Graphs
$config['int_transit']             = 1;  // Enable Transit Types
$config['int_peering']             = 1;  // Enable Peering Types
$config['int_core']                = 1;  // Enable Core Port Types
$config['int_l2tp']                = 0;  // Enable L2TP Port Types

$config['show_locations']          = 1;  // Enable Locations on menu
$config['show_locations_dropdown'] = 1;  // Enable Locations dropdown on menu
$config['show_services']           = 0;  // Enable Services on menu
$config['ports_page_default']      = "details"; // eg "details" or "basic"

// PING Settings - Retries/Timeouts
#$config['ping']['retries'] = 3;    // How many times to retry ping
#$config['ping']['timeout'] = 500;  // Timeout in milliseconds

// SNMP Settings - Timeouts/Retries disabled as default
#$config['snmp']['timeout'] = 1;            // timeout in seconds
#$config['snmp']['retries'] = 5;            // how many times to retry the query
$config['snmp']['max-rep'] = FALSE;         // allow use of -Cr in snmpbulkwalk vastly increasing walk speed
$config['snmp']['transports'] = array('udp', 'udp6', 'tcp', 'tcp6');
$config['snmp']['version'] = "v2c";         // Default version to use

// SNMPv1/2c default settings
$config['snmp']['community'][0] = "public"; // Communities to try during adding hosts and discovery

// SNMPv3 default settings
// The array can be expanded to give another set of parameters
$config['snmp']['v3'][0]['authlevel'] = "noAuthNoPriv";  // noAuthNoPriv | authNoPriv | authPriv
$config['snmp']['v3'][0]['authname'] = "observium";      // User Name (required even for noAuthNoPriv)
$config['snmp']['v3'][0]['authpass'] = "";               // Auth Passphrase
$config['snmp']['v3'][0]['authalgo'] = "MD5";            // MD5 | SHA
$config['snmp']['v3'][0]['cryptopass'] = "";             // Privacy (Encryption) Passphrase
$config['snmp']['v3'][0]['cryptoalgo'] = "AES";          // AES | DES

// Autodiscovery Settings

$config['autodiscovery']['xdp']            = TRUE; // Autodiscover hosts via discovery protocols
$config['autodiscovery']['ospf']           = TRUE; // Autodiscover hosts via OSPF
$config['autodiscovery']['bgp']            = TRUE; // Autodiscover hosts via BGP
$config['autodiscovery']['snmpscan']       = TRUE; // Autodiscover hosts via SNMP scanning
$config['autodiscovery']['libvirt']        = TRUE; // Autodiscover hosts found via libvirt
$config['autodiscovery']['ip_nets']        = array("127.0.0.0/8", "192.168.0.0/16", "10.0.0.0/8", "172.0.0.0/8");  // Networks to permit autodiscovery

$config['discover_services']               = FALSE; // Autodiscover services via SNMP on devices of type "server"

// Mailer backend Settings

$config['email_backend']              = 'mail';               // Mail backend. Allowed: "mail" (PHP's built-in), "sendmail", "smtp".
$config['email_from']                 = NULL;                 // Mail from. Default: "OBSERVIUM Network Monitor" <observium@`hostname`>
$config['email_sendmail_path']        = '/usr/sbin/sendmail'; // The location of the sendmail program.
$config['email_smtp_host']            = 'localhost';          // Outgoing SMTP server name.
$config['email_smtp_port']            = 25;                   // The port to connect.
$config['email_smtp_timeout']         = 10;                   // SMTP connection timeout in seconds.
$config['email_smtp_secure']          = NULL;                 // Enable encryption. Use 'tls' or 'ssl'
$config['email_smtp_auth']            = FALSE;                // Whether or not to use SMTP authentication.
$config['email_smtp_username']        = NULL;                 // SMTP username.
$config['email_smtp_password']        = NULL;                 // Password for SMTP authentication.

// Alerting Settings

$config['alerts']['email']['default']      = NULL;     // Default alert recipient
$config['alerts']['email']['default_only'] = FALSE;    // Only use default recipient
$config['alerts']['email']['enable']       = FALSE;    // Enable email alerts
$config['alerts']['bgp']['whitelist']      = NULL;     // Populate as an array() with ASNs to alert on.

$config['alerts']['port']['ifdown']        = FALSE;    // Generate alerts for ports that go down
$config['alerts']['port']['ifdown_types']  = array('core', 'transit', 'peering');    // Generate alerts for ports that go down

// Port bandwidth threshold percentage %age utilisation above this will cause an alert

$config['alerts']['port_util_alert']       = FALSE;    // Disabled as default
$config['alerts']['port_util_perc']        = 85;       // %age above which to alert

$config['uptime_warning']                  = "84600";  // Time in seconds to display a "Device Rebooted" Alert. 0 to disable warnings.

// Proxy

#$config['http_proxy'] = "yourproxy:80";                // Proxy for HTTP/HTTPS requests (e.g. for geocoding)

// Geocoding Configuration

$config['geocoding']['enable']	           = TRUE;                  // Enable Geocoding
$config['geocoding']['api']                = 'mapquest';            // Which GEO API use ('mapquest', 'google')
$config['geocoding']['default']['lat']     =  "37.7463058";         // Default latitude
$config['geocoding']['default']['lon']     =  "-25.6668573";        // Default longitude

$config['location_menu_geocoded']	   = TRUE;		    // Build location menu with geocoded data.

// Cosmetics

$config['rrdgraph_def_text']  = "-c BACK#EEEEEE00 -c SHADEA#EEEEEE00 -c SHADEB#EEEEEE00 -c FONT#000000 -c CANVAS#FFFFFF00 -c GRID#a5a5a5";
$config['rrdgraph_def_text'] .= " -c MGRID#FF9999 -c FRAME#5e5e5e -c ARROW#5e5e5e -R normal";
$config['rrdgraph_real_95th'] = FALSE; // Set to TRUE if you want to display the 95% based on the highest value. (aka real 95%)
$config['overlib_defaults']   = ",FGCOLOR,'#ffffff', BGCOLOR, '#e5e5e5', BORDER, 0, CELLPAD, 0, CAPCOLOR, '#555555', TEXTCOLOR, '#3e3e3e'";

$list_colour_a = "#ffffff";
$list_colour_b = "#eeeeee";
$list_colour_a_a = "#f9f9f9";
$list_colour_a_b = "#f0f0f0";
$list_colour_b_a = "#f0f0f0";
$list_colour_b_b = "#e3e3e3";
$list_highlight  = "#ffcccc";
$warn_colour_a = "#ffeeee";
$warn_colour_b = "#ffcccc";

#$config['graph_colours'] = array("000066","330066","990066","990066","CC0033","FF0000"); // Purple to Red
#$config['graph_colours'] = array("006600","336600","996600","996600","CC3300","FF0000"); // Green to Red
#$config['graph_colours'] = array("002200","004400","006600","008800","00AA00","00CC00"); // Green
#$config['graph_colours'] = array("220000","440000","660000","880000","AA0000","CC0000"); // Red
#$config['graph_colours'] = array("001122","002244","003366","004488","0055AA","0066CC"); // Blue
#$config['graph_colours'] = array("002233","004466","006699","0088CC","0099FF");          // Sky-Blue
#$config['graph_colours'] = array("110022","330066","440088","6600AA","8800FF");          // Purple
#$config['graph_colours'] = array("002200","004400","006600","008800","00AA00","00AA00","00CC00"); // Forest Greens

$config['graph_colours']['mixed']   = array('CC0000','008C00','4096EE','73880A','F03F5C','36393D','FF0084');

$config['graph_colours']['oranges'] = array('FFC344', 'FCB53D', 'F9A836', 'F69A2F', 'F48D28', 'F17F22', 'EE721B', 'EC6414', 'E9570D', 'E64906', 'E43C00');
$config['graph_colours']['greens']  = array('B6D14B', 'A4C445', '92B73F', '80AA39', '6E9D33', '5C902E', '4A8328', '387622', '26691C', '145C16', '034F11');
$config['graph_colours']['reds']    = array('FF7373', 'F66767', 'ED5C5C', 'E45050', 'DB4545', 'D23939', 'C92E2E', 'C02222', 'B71616', 'AE0B0B', 'A60000');
$config['graph_colours']['pinks']   = array('E881B1', 'DE76A7', 'D46C9D', 'CA6293', 'C15889', 'B74E7F', 'AD4475', 'A43A6B', '9A3061', '902657', '871C4E');
$config['graph_colours']['blues']   = array('A0A0E5', '9090D3', '8080C1', '7070AF', '60609D', '50508C', '40407A', '303068', '1F1F56', '0F0F44', '000033');
$config['graph_colours']['purples'] = array('CC7CCC', 'BD6FBD', 'AF63AF', 'A156A1', '934A93', '853E85', '773177', '692569', '5B185B', '4D0C4D', '3F003F');
$config['graph_colours']['peach']   = array('FC998C', 'F38E81', 'EA8476', 'E1796B', 'D86F61', 'CF6456', 'C65A4B', 'BD4F41', 'B44536', 'AB3A2B', 'A23021');
$config['graph_colours']['yellow']  = array('FFD683', 'FACF79', 'F5C970', 'F0C267', 'EBBC5D', 'E6B554', 'E1AF4B', 'DCA841', 'D7A238', 'D29B2F', 'CD9526');
$config['graph_colours']['red2']    = array('FD627A', 'F05870', 'E34E66', 'D7455C', 'CA3B52', 'BE3248', 'B1283E', 'A41E34', '98152A', '8B0B20', '7F0216');

$config['graph_colours']['default'] = $config['graph_colours']['blues'];
$config['graph_colours']['juniperive']   = array('F7C729','52A6EF');

// Front page settings

// General settings
$config['frontpage']['overall_traffic']            = true;         // Enable/Disable the overall traffic view (transit, peering, transit+peering)
$config['frontpage']['eventlog']['items']          = 15;           // Only show the last XX items of the eventlog view
$config['frontpage']['syslog']['items']            = 25;           // Only show the last XX items of the syslog view

// Map overview settings
$config['frontpage']['map']['region']              = "world";      // See https://developers.google.com/chart/interactive/docs/gallery/geochart for region settings
$config['frontpage']['map']['resolution']          = "countries";  // Some region types such as US States (US-NY) require this to be changed to "provinces"
$config['frontpage']['map']['dotsize']             = 10;           // Set the dotsize you want
$config['frontpage']['map']['realworld']           = false;        // Enable/Disable the realworld view (blue/green), if disabled default map view

// Device status settings
// Show the status messages you want
$config['frontpage']['device_status']['max']['interval'] = 24;     // Maximal interval for which to display devices status (in hours)
$config['frontpage']['device_status']['max']['count'] = 200;       // Maximal count for which to display devices status (in items)
$config['frontpage']['device_status']['devices']   = true;         // Show the down devices
$config['frontpage']['device_status']['ports']     = true;         // Show the down ports
$config['frontpage']['device_status']['links']     = true;         // Show the down inter-device links (with CDP/LLDP linked devices)
$config['frontpage']['device_status']['errors']    = true;         // Show the ports with interface errors
$config['frontpage']['device_status']['services']  = true;         // Show the down services
$config['frontpage']['device_status']['bgp']       = true;         // Show the bgp status
$config['frontpage']['device_status']['uptime']    = true;         // Show the uptime status


// Custom traffic graphs
$config['frontpage']['custom_traffic']['ids']      = "";           // COMMA SEPERATED PORT ID FOR EXAMPLE: "1,2,3,4,5"
$config['frontpage']['custom_traffic']['title']    = "";           // Your own title for the custom traffic graphs

// Custom mini graphs
$config['frontpage']['minigraphs']['ids']          = "";           // Comma and semicolon seperated array list, first the device id or graph id followed by the image type and the text header you want (example: "2,device_processor,CPU Usage;10,diskio_bits,IOPS")
$config['frontpage']['minigraphs']['legend']       = false;        // Enable/Disable the legend on custom mini graph view

// Frontpage order you can use: status_summary, map, device_status_boxes, overall_traffic, custom_traffic, minigraphs, syslog, eventlog
$config['frontpage']['order']           = array('status_summary', 'map', 'device_status_boxes', 'device_status', 'eventlog');

// Device page options

$config['show_overview_tab'] = TRUE;

// The device overview page options

$config['overview_show_sysDescr'] = TRUE;

// Enable version checker & stats
$config['version_check']                = 1; // Enable checking of version in discovery
                                             // and submittal of basic stats used
                                             // to prioritise development effort :)

// Poller/Discovery Modules

$config['enable_bgp']                   = 1; // Enable BGP session collection and display
$config['enable_rip']                   = 1; // Enable RIP session collection and display
$config['enable_ospf']                  = 1; // Enable OSPF session collection and display
$config['enable_isis']                  = 1; // Enable ISIS session collection and display
$config['enable_eigrp']                 = 1; // Enable EIGRP session collection and display
$config['enable_syslog']                = 0; // Enable Syslog
$config['enable_inventory']             = 1; // Enable Inventory
$config['enable_pseudowires']           = 1; // Enable Pseudowires
$config['enable_vrfs']                  = 1; // Enable VRFs
$config['enable_printers']              = 1; // Enable Printer support
$config['enable_sla']                   = 1; // Enable Cisco SLA collection and display

// Ports extension modules

$config['port_descr_parser']            = "includes/port-descr-parser.inc.php"; // Parse port descriptions into fields
$config['enable_ports_Xbcmc']           = 1; // Enable ifXEntry broadcast/multicast
$config['enable_ports_etherlike']       = 0; // Enable Polling EtherLike-MIB (doubles interface processing time)
$config['enable_ports_junoseatmvp']     = 0; // Enable JunOSe ATM VC Discovery/Poller
$config['enable_ports_adsl']            = 1; // Enable ADSL-LINE-MIB
$config['enable_ports_poe']             = 0; // Enable PoE stats collection

// Billing System Configuration

$config['enable_billing']               = 0; // Enable Billing
$config['billing']['customer_autoadd']  = 0; // Enable Auto-add bill per customer
$config['billing']['circuit_autoadd']   = 0; // Enable Auto-add bill per circuit_id
$config['billing']['bill_autoadd']      = 0; // Enable Auto-add bill per bill_id
$config['billing']['base']              = 1000; // Set the base to divider bytes to kB, MB, GB ,... (1000|1024)

// External Integration

#$config['rancid_configs'][]             = '/var/lib/rancid/network/configs/';
#$config['rancid_suffix']                = 'yourdomain.com'; // Domain suffix for non-FQDN device names
$config['rancid_ignorecomments']        = 0; // Ignore lines starting with #
#$config['collectd_dir']                 = '/var/lib/collectd/rrd';
#$config['smokeping']['dir']             = "/var/lib/smokeping/";

// NFSen RRD dir.
$config['nfsen_enable'] = 0;
#$config['nfsen_split_char']   = "_";
#$config['nfsen_rrds']   = "/var/nfsen/profiles-stat/live/";
#$config['nfsen_suffix']   = "_yourdomain_com";

// Location Mapping
// Use this feature to map ugly locations to pretty locations
#config['location_map']['Under the Sink'] = "Under The Sink, The Office, London, UK";

// Ignores & Allows
// Has to be lowercase

$config['bad_if'][] = "voip-null";
$config['bad_if'][] = "virtual-";
$config['bad_if'][] = "unrouted";
$config['bad_if'][] = "eobc";
$config['bad_if'][] = "lp0";
$config['bad_if'][] = "-atm";
$config['bad_if'][] = "faith0";
$config['bad_if'][] = "container";
$config['bad_if'][] = "async";
$config['bad_if'][] = "plip";
$config['bad_if'][] = "-physical";
$config['bad_if'][] = "container";
$config['bad_if'][] = "unrouted";
$config['bad_if'][] = "bluetooth";
$config['bad_if'][] = "isatap";
$config['bad_if'][] = "ras";
$config['bad_if'][] = "qos";
$config['bad_if'][] = "span rp";
$config['bad_if'][] = "span sp";
$config['bad_if'][] = "sslvpn";
$config['bad_if'][] = "pppoe-";
#$config['bad_if'][] = "control plane";  // Example for cisco control plane

// Ignore ports based on ifType. Case-sensitive.

$config['bad_iftype'][] = "voiceEncap";
$config['bad_iftype'][] = "voiceEM";
$config['bad_iftype'][] = "voiceFXO";
$config['bad_iftype'][] = "voiceFXS";
$config['bad_iftype'][] = "voiceOverAtm";
$config['bad_iftype'][] = "voiceOverFrameRelay";
$config['bad_iftype'][] = "voiceOverIp";
$config['bad_iftype'][] = "ds0";
$config['bad_iftype'][] = "ds1";
$config['bad_iftype'][] = "ds3";
#$config['bad_iftype'][] = "isdn";       //show signaling traffic
#$config['bad_iftype'][] = "lapd";       //show signaling traffic
$config['bad_iftype'][] = "sonet";
$config['bad_iftype'][] = "atmSubInterface";
$config['bad_iftype'][] = "aal5";
$config['bad_iftype'][] = "shdsl";
$config['bad_iftype'][] = "mpls";
$config['bad_iftype'][] = "usb";        // Ignore USB pseudo interface (BSD)

$config['bad_if_regexp'][] = "/^ng[0-9]+$/";
$config['bad_if_regexp'][] = "/^sl[0-9]/";

$config['processor_filter'][] = "An electronic chip that makes the computer work.";

$config['ignore_mount_removable']  = 1; // Ignore removable disk storage
$config['ignore_mount_network']    = 1; // Ignore network mounted storage
$config['ignore_mount_optical']    = 1; // Ignore mounted optical discs

// Per-device interface graph filters

$config['device_traffic_iftype'][] = '/loopback/';
$config['device_traffic_iftype'][] = '/tunnel/';
$config['device_traffic_iftype'][] = '/virtual/';
$config['device_traffic_iftype'][] = '/mpls/';
$config['device_traffic_iftype'][] = '/ieee8023adLag/';
$config['device_traffic_iftype'][] = '/l2vlan/';
$config['device_traffic_iftype'][] = '/ppp/';

$config['device_traffic_descr'][]  = '/loopback/';
$config['device_traffic_descr'][]  = '/vlan/';
$config['device_traffic_descr'][]  = '/tunnel/';
#$config['device_traffic_descr'][]  = '/:\d+/';   #// this breaks on xos (ifName = 1:1)
$config['device_traffic_descr'][]  = '/bond/';
$config['device_traffic_descr'][]  = '/null/';
$config['device_traffic_descr'][]  = '/dummy/';

// IRC Bot configuration

$config['irc_host'] = "irc.oftc.net";
$config['irc_port'] = 6667;
$config['irc_nick'] = "Observium".rand(99999);
$config['irc_chan'][] = "#observium";

// Authentication

$config['allow_unauth_graphs']      = 0;       // Allow graphs to be viewed by anyone
$config['allow_unauth_graphs_cidr'] = array(); // Allow graphs to be viewed without authorisation from certain IP ranges
$config['auth_mechanism']           = "mysql"; // Available mechanisms: mysql (default), ldap, http-auth

// LDAP Authentication

$config['auth_ldap_version'] = 3;                     // LDAP client version (2 or 3)
$config['auth_ldap_server'] = "ldap.yourserver.com";  // LDAP server name
$config['auth_ldap_port']   = 389;                    // LDAP server port
$config['auth_ldap_starttls'] = 'no';                 // Use STARTTLS ('no', 'optional' or 'require')
$config['auth_ldap_prefix'] = "uid=";
$config['auth_ldap_suffix'] = ",ou=People,dc=example,dc=com";
$config['auth_ldap_group']  = "cn=observium,ou=groups,dc=example,dc=com";
$config['auth_ldap_groupbase'] = "ou=groups,dc=example,dc=com";

$config['auth_ldap_binddn'] = ""; // Initial LDAP bind dn and password, leave empty for anonymous bind
$config['auth_ldap_bindpw'] = "";
$config['auth_ldap_bindanonymous'] = FALSE;

$config['auth_ldap_attr']['uid'] = "uid";             // LDAP attribute containing the user login name
$config['auth_ldap_attr']['uidNumber'] = "uidNumber"; // LDAP attribute containing the numeric user ID
$config['auth_ldap_attr']['cn'] = "cn";               // LDAP attribute containing the user's full name

$config['auth_ldap_objectclass'] = "posixAccount";    // objectClass to filter out valid users, use * for all objects under ldap_suffix tree


$config['auth_ldap_groupmembertype'] = "nodn";        // Available membertypes: 'nodn' (default, uses $username);
                                                      // 'fulldn' ($config['auth_ldap_prefix'] . $username . $config['auth_ldap_suffix'])
$config['auth_ldap_groupmemberattr'] = "memberUid";   // Use your unique attribute for username, example "uniqueMember".

#$config['auth_ldap_groups']['admin']['level'] = 10;  // Assign levels to certain LDAP groups
#$config['auth_ldap_groups']['pfy']['level'] = 7;
#$config['auth_ldap_groups']['support']['level'] = 1;

// Sensors

$config['allow_entity_sensor']['amperes'] = 1;
$config['allow_entity_sensor']['celsius'] = 1;
$config['allow_entity_sensor']['dBm'] = 1;
$config['allow_entity_sensor']['voltsDC'] = 1;
$config['allow_entity_sensor']['voltsAC'] = 1;
$config['allow_entity_sensor']['watts'] = 1;
$config['allow_entity_sensor']['truthvalue'] = 1;
$config['allow_entity_sensor']['specialEnum'] = 1;

// Filesystems

$config['ignore_mount'][] = "/kern";
$config['ignore_mount'][] = "/mnt/cdrom";
$config['ignore_mount'][] = "/proc";
$config['ignore_mount'][] = "/dev";

$config['ignore_mount_string'][] = "packages";
$config['ignore_mount_string'][] = "devfs";
$config['ignore_mount_string'][] = "procfs";
$config['ignore_mount_string'][] = "UMA";
$config['ignore_mount_string'][] = "MALLOC";

$config['ignore_mount_regexp'][] = "/on: \/packages/";
$config['ignore_mount_regexp'][] = "/on: \/dev/";
$config['ignore_mount_regexp'][] = "/on: \/proc/";
$config['ignore_mount_regexp'][] = "/on: \/junos^/";
$config['ignore_mount_regexp'][] = "/on: \/junos\/dev/";
$config['ignore_mount_regexp'][] = "/on: \/jail\/dev/";
$config['ignore_mount_regexp'][] = "/^(dev|proc)fs/";
$config['ignore_mount_regexp'][] = "/^\/dev\/md0/";
$config['ignore_mount_regexp'][] = "/^\/var\/dhcpd\/dev,/";
$config['ignore_mount_regexp'][] = "/UMA/";

$config['ignore_mount_removable'] = 1; // Ignore removable disk storage
$config['ignore_mount_network']   = 1; // Ignore network mounted storage

// Syslog Settings

$config['syslog_age']       = "1 month";        // Entries older than this will be removed

$config['syslog_filter'][] = "last message repeated";
$config['syslog_filter'][] = "Connection from UDP: [";
$config['syslog_filter'][] = "ipSystemStatsTable node ipSystemStatsOutFragOKs not implemented";
$config['syslog_filter'][] = "diskio.c";  // Ignore some crappy stuff from SNMP daemon

// Virtualization

$config['enable_libvirt'] = 0; // Enable Libvirt VM support
$config['libvirt_protocols']    = array("qemu+ssh","xen+ssh"); // Mechanisms used, add or remove if not using this on any of your machines.

// Unix Agent settings
$config['unix-agent']['port'] = 36602; // Default agent port

// Hardcoded ASN descriptions
$config['astext'][65332] = "Cymru FullBogon Feed";
$config['astext'][65333] = "Cymru Bogon Feed";

// Nicer labels for the SLA types
$config['sla_type_labels']['echo'] = 'ICMP ping';
$config['sla_type_labels']['pathEcho'] = 'Path ICMP ping';
$config['sla_type_labels']['fileIO'] = 'File I/O';
$config['sla_type_labels']['script'] = 'Script';
$config['sla_type_labels']['udpEcho'] = 'UDP ping';
$config['sla_type_labels']['tcpConnect'] = 'TCP connect';
$config['sla_type_labels']['http'] = 'HTTP';
$config['sla_type_labels']['dns'] = 'DNS';
$config['sla_type_labels']['jitter'] = 'Jitter';
$config['sla_type_labels']['dlsw'] = 'DLSW';
$config['sla_type_labels']['dhcp'] = 'DHCP';
$config['sla_type_labels']['ftp'] = 'FTP';
$config['sla_type_labels']['voip'] = 'VoIP';
$config['sla_type_labels']['rtp'] = 'RTP';
$config['sla_type_labels']['lspGroup'] = 'LSP group';
$config['sla_type_labels']['icmpjitter'] = 'ICMP jitter';
$config['sla_type_labels']['lspPing'] = 'LSP ping';
$config['sla_type_labels']['lspTrace'] = 'LSP trace';
$config['sla_type_labels']['ethernetPing'] = 'Ethernet ping';
$config['sla_type_labels']['ethernetJitter'] = 'Ethernet jitter';
$config['sla_type_labels']['lspPingPseudowire'] = 'LSP Pseudowire ping';

// List of poller modules. Need to be in the array to be
// considered for execution.

$config['poller_modules']['unix-agent']                   = 0;
$config['poller_modules']['system']                       = 1;
$config['poller_modules']['os']                           = 1;
$config['poller_modules']['ipmi']                         = 1;
$config['poller_modules']['sensors']                      = 1;
$config['poller_modules']['processors']                   = 1;
$config['poller_modules']['mempools']                     = 1;
$config['poller_modules']['storage']                      = 1;
$config['poller_modules']['netstats']                     = 1;
$config['poller_modules']['hr-mib']                       = 1;
$config['poller_modules']['ucd-mib']                      = 1;
$config['poller_modules']['ipSystemStats']                = 1;
$config['poller_modules']['ports']                        = 1;
$config['poller_modules']['bgp-peers']                    = 1;
$config['poller_modules']['junose-atm-vp']                = 1;
$config['poller_modules']['toner']                        = 1;
$config['poller_modules']['ucd-diskio']                   = 1;
$config['poller_modules']['wifi']                         = 1;
$config['poller_modules']['ospf']                         = 1;
$config['poller_modules']['cisco-ipsec-flow-monitor']     = 1;
$config['poller_modules']['cisco-remote-access-monitor']  = 1;
$config['poller_modules']['cisco-cef']                    = 1;
$config['poller_modules']['cisco-sla']                    = 1;
$config['poller_modules']['mac-accounting']         	  = 1;
$config['poller_modules']['arista-software-ip-forwarding']= 1;
$config['poller_modules']['cipsec-tunnels']               = 1;
$config['poller_modules']['cisco-ace-loadbalancer']       = 1;
$config['poller_modules']['cisco-ace-serverfarms']        = 1;
$config['poller_modules']['cisco-cbqos']                  = 1;
$config['poller_modules']['cisco-eigrp']	          = 1;
$config['poller_modules']['netscaler-vsvr']               = 1;
$config['poller_modules']['aruba-controller']             = 1;
$config['poller_modules']['entity-physical']              = 1;
$config['poller_modules']['applications']                 = 1;
$config['poller_modules']['fdb-table']                    = 1;

// List of discovery modules. Need to be in this array to be
// considered for execution.

$config['discovery_modules']['ports']                     = 1;
$config['discovery_modules']['ports-stack']               = 1;
$config['discovery_modules']['entity-physical']           = 1;
$config['discovery_modules']['processors']                = 1;
$config['discovery_modules']['mempools']                  = 1;
$config['discovery_modules']['ipv4-addresses']            = 1;
$config['discovery_modules']['ipv6-addresses']            = 1;
$config['discovery_modules']['sensors']                   = 1;
$config['discovery_modules']['storage']                   = 1;
$config['discovery_modules']['hr-device']                 = 1;
$config['discovery_modules']['discovery-protocols']       = 1;
$config['discovery_modules']['ospf-autodiscovery']        = 1;
$config['discovery_modules']['arp-table']                 = 1;
$config['discovery_modules']['junose-atm-vp']             = 1;
$config['discovery_modules']['bgp-peers']                 = 1;
$config['discovery_modules']['vlans']                     = 1;
$config['discovery_modules']['mac-accounting']            = 1;
$config['discovery_modules']['cisco-pw']                  = 1;
$config['discovery_modules']['cisco-vrf']                 = 1;
#$config['discovery_modules']['cisco-cef']                 = 1;
$config['discovery_modules']['cisco-sla']                 = 1;
$config['discovery_modules']['vmware-vminfo']             = 1;
$config['discovery_modules']['libvirt-vminfo']            = 1;
$config['discovery_modules']['toner']                     = 1;
$config['discovery_modules']['ucd-diskio']                = 1;
$config['discovery_modules']['services']                  = 1;

$config['modules_compat']['rfc1628']['liebert']           = 1;
$config['modules_compat']['rfc1628']['netmanplus']        = 1;
// $config['modules_compat']['rfc1628']['deltaups']          = 1;
$config['modules_compat']['rfc1628']['poweralert']        = 1;

// Simple Observium API Settings

$config['api']['enabled']                        = 0;        // Enable or disable the API
$config['api']['module']['inventory']                = 0;        // Enable or disable the inventory module for the API
$config['api']['module']['billing']                = 0;        // Enable or disable the billing module for the API
$config['api']['module']['packages']                = 0;        // Enable or disable the packages module for the API
$config['api']['module']['encryption']                = 0;        // Enable encryption of data (be aware that this can be very slow and cpu intensive!!!)
$config['api']['encryption']['key']                = "I_Need_To_Change_This_Key";        // Set a random encryption/decryption key

// Unsupported settings

$config['shorthost']['length'] = 12; // Alter shorthost() target length, changing this is not officially supported!

// End includes/defaults.inc.php

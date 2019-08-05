<?php
// using GeoLite to get user information, not works everytime
function findIP($ip, $loc){

    include_once('geoipcity.inc');
	include_once('geoipregionvars.php');
	include_once('timezone.php');
	
    $a = array();
	$gi = geoip_open($loc.'GeoLiteCity.dat', GEOIP_STANDARD);
	$record = geoip_record_by_addr($gi,$ip);
	$a['CountryC']		=	$record->country_code;
	$a['CountryC3']		=	$record->country_code3;
	$a['Country']		=	$record->country_name;
	$a['Region']		=	$record->region;
	$a['RegionName']	=	(isset($GEOIP_REGION_NAME[$record->country_code][$record->region]) ? $GEOIP_REGION_NAME[$record->country_code][$record->region] : '');
	$a['City']			=	$record->city;
	$a['PostCode']		=	$record->postal_code;
	$a['Latitude']		=	$record->latitude;
	$a['Longitude']		=	$record->longitude;
	$a['MetroCode']		=	$record->metro_code;
	$a['AreaCode']		=	$record->area_code;
	$a['ContinentC']	=	$record->continent_code;
	$a['TimeZone']		=	get_time_zone($a['CountryC'],'');
	geoip_close($gi);
	return $a;
}
?>
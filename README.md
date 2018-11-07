# Transit Station Service

##Installation:
**add in file composer.json**
```javascript
"require": {
	"megaads/transit-station": "^1.0"
}
```
##Usage:
**Register Provider**
```
#/Config/app.php
'providers' => [
    Megaads\TransitStation\TransitStationServiceProvider::class
];
```

**Router for transfer both GET or POST**
```
http://domain/proxy/transferring
```

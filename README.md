## Motivation

此為學術研究的專案，使用到Jquery, PHP收集網路使用者的瀏覽器數據，僅供學術研討之用。

## Installation
     
1. 放到 <body> tag 中
```
     <script src="test/scripts/ext/swfobject.js" type="text/javascript" />
     <script src="test/scripts/ext/jquery-1.6.4.min.js" type="text/javascript" />
     <script src="test/scripts/ext/jquery.json-2.3.min.js" type="text/javascript" />
     <script src="test/scripts/Fingerprint.js" type="text/javascript" />
     <script src="test/scripts/collect.js" type="text/javascript" />
```

1. 改database collection

```
     $con = new MongoClient("mongodb://localhost");
     $db = $con->fingerprints;
     $collection = $db->createCollection("test"); 
```
     
1. 把Fonts.swf放在網站之伺服器上

```
     改路徑 collect.js   Fingerprint.events.add(Fingerprint.initFlash,['Fonts.swf路徑'])
```

## Licence

MIT

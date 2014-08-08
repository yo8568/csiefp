<?php
$con = new MongoClient("mongodb://localhost");
$db = $con->fingerprints;
$collection = $db->createCollection("csie");
   $cursor = $collection->find();
   // 迭代显示文档标题
function deviceCount() {
   foreach ($cursor as $document) {
}
//var_dump($document['2']);
   	if($document['2']['Android']){
$Android_count++;
   		 	}
   		 	elseif ($document['2']['mobile']) {
   		 		$mobile_count++;
   		 	}
   		 	elseif (!$document['2']['mobile']) {
   		 		$web_count++;
   		 	}
   		 	elseif ($document['2']['iPad']) {
   		 		$iPad_count++;
   		 	}elseif ($document['2']['iPone']) {
   		 			$iPone_count++;
   		 	}

}
echo 'mobile_count:'.$mobile_count.'<br />';
echo 'web_count:'.$web_count.'<br />';
echo 'iPad_count:'.$iPad_count.'<br />';
echo 'iPone_count:'.$iPone_count.'<br />';
echo 'Android_count:'.$Android_count.'<br />';

echo '<hr />';
 }
?>
#!/usr/bin/env php
<?php
libxml_use_internal_errors(true);
//$path = 'http://www.nhaccuatui.com/flash/xml?html5=true&key2=47cd00425581da7b86c09c5c25f390d8';
//$path = 'http://www.nhaccuatui.com/flash/xml?html5=true&key2=fc42418b7a3366bc636a002e0d9c31a1';
//$path = 'http://www.nhaccuatui.com/flash/xml?html5=true&key2=4dfa2aea2d77bb38b8fc906a52e6f9f1';
// $path = 'http://www.nhaccuatui.com/flash/xml?html5=true&key2=cbc58d20eb7c1fe143c51288f0754825';
$path = 'http://www.nhaccuatui.com/flash/xml?html5=true&key2=b172bffc52996df16dea639d48524b8c';
// $path = 'http://www.nhaccuatui.com/flash/xml?html5=true&key2=2250da8d51173ad1f65a06d1155ab257';
// $path = 'http://www.nhaccuatui.com/flash/xml?html5=true&key2=e2806067ddd6ae211f3021c2d53b513f';
// $path = 'http://www.nhaccuatui.com/flash/xml?html5=true&key2=a976ec5c2791fd39e378a1c3ac0dfa50';
// $path = 'http://www.nhaccuatui.com/flash/xml?html5=true&key2=37c2174c11af1cfcf9fda5e553d5baa1';
$folder = 'music';
if( ! file_exists($folder) ) {
   mkdir($folder, 0777, true);
}
$myXMLData = file_get_contents($path);

$nodes = simplexml_load_string($myXMLData);
if ($nodes === false) {
    echo "Failed loading XML: ";
    foreach(libxml_get_errors() as $error) {
        echo "<br>", $error->message;
    }
}
else {
    $tracks = $nodes->track;
    
    foreach ($tracks as $key => $node) {
        $link =  $node->location;
        //var_dump($node);die();
        $fileName = $folder. DIRECTORY_SEPARATOR  . basename(  $link );
        $link = trim($link);
        $content = file_get_contents($link);
        if( FALSE != $content ) {
            file_put_contents( $fileName, $content );
        }
    }
}
exit();
?>

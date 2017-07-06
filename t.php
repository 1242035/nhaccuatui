#!/usr/bin/env php
<?php
libxml_use_internal_errors(true);
$path = 'http://www.nhaccuatui.com/flash/xml?html5=true&key2=47cd00425581da7b86c09c5c25f390d8';
$folder = 'NhacAuMy';
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
    if( ! file_exists($folder) ) {
        mkdir($folder);
    }
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

?>

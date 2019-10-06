<?php

require __DIR__  . '/../vendor/autoload.php';

$query = 'cat memes';
$google = new \Chabberwock\Siteinfo\GoogleQuery();
$links = $google->run($query, 11);
$result = [];
foreach ($links as $link) {
    $p = parse_url($link);
    $domain = $p['host'];
    $siteInfo = new Chabberwock\Siteinfo\SiteInfo($domain);
    $result[] = ['link'=>$link, 'domainExpires'=>$siteInfo->domainExpires, 'certExpires'=>$siteInfo->certExpires];
}
var_dump($result);


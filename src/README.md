# Usage

````
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
````

# Class reference

````
//Chabberwock\Siteinfo\GoogleQuery
// Performs search request and returns array with up to $maxResults links
public function run($query, $maxResults = 20) 

//Chabberwock\Siteinfo\SiteInfo
    public $domain;
    public $certExpires;
    public $domainExpires;
public function __construct($domain)



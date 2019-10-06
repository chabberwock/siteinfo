<?php


namespace Chabberwock\Siteinfo;


class GoogleQuery
{
    public function run($query, $maxResults = 20)
    {
        
        $client = new \GuzzleHttp\Client([
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36 OPR/63.0.3368.94',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
                'Accept-Language' => 'ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
                'cache-control' => 'no-cache'
            ]
        ]);
        $response = $client->get('https://www.google.ru/search?q=' . urlencode($query). '&num=11');
        $body = $response->getBody();

        $dom = new \DOMDocument();
        @$dom->loadHTML($body);
        $xpath = new \DOMXPath($dom);
        $items = $xpath->query('//div[@class="r"]/a/@href');
        $links = [];
        for ($i=0;$i<min($items->length,$maxResults);$i++) {
            $links[] =  $items->item($i)->nodeValue;
        }
        return $links;
        
    }
}

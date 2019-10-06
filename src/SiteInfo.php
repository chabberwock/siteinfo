<?php


namespace Chabberwock\Siteinfo;


class SiteInfo
{
    public $domain;
    public $certExpires;
    public $domainExpires;
    
    public function __construct($domain)
    {
        $this->domain = $domain;
        $cert = $this->getCert($domain);
        $whois = $this->whois($domain);
        $this->certExpires = date('Y-m-d H:i:s', $cert['validTo_time_t']);
        $this->domainExpires = $whois->expires;
    }
    
    private function getCert($domain) {
        $g = stream_context_create (array("ssl" => array("capture_peer_cert" => true)));
        $r = stream_socket_client("ssl://{$domain}:443", $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $g);
        $cont = stream_context_get_params($r);
        return openssl_x509_parse($cont["options"]["ssl"]["peer_certificate"]);
    }
    
    private function whois($domain)
    {
        $parser = new \Novutec\WhoisParser\Parser();
        return $parser->lookup($domain);
    }
    
}

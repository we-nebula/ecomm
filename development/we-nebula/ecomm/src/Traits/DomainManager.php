<?php

namespace nebula\we\Traits;

Trait DomainManager{
	function extract_domain($domain)
    {
        if(preg_match("/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i", $domain, $matches))
        {
            return $matches['domain'];
        } else {
            return $domain;
        }
    }

    function extract_subdomains($domain)
    {
        $subdomains = $domain;
        $domain = $this->extract_domain($subdomains);
        // $domain = str_replace('www.','',$this->extract_domain($url))?:'www';
        $subdomains = rtrim(strstr($subdomains, $domain, true), '.');

        return $subdomains;
    }
}
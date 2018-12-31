<?php

/**
 * Replaces the laravel's route method to work the subdomains
 */
if (!function_exists('route')) {
    function route($name, $parameters = [], $absolute = true) {
        if (!is_array($parameters)) {
            $parameters = [$parameters];
        }

        $subDomain = request()->companySubDomain;

        if (!empty(request()->currentCompany)) {
            $subDomain = request()->currentCompany->subdomain;
        }

        if (!empty($subDomain)) {
            array_unshift($parameters, $subDomain);
        }
        elseif (substr($name, 0, 5) != 'home.') {
            $name = 'home.' . $name;
        }

        return app('url')->route($name, $parameters, $absolute);
    }
}
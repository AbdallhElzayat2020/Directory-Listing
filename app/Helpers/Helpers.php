<?php

/* set Sidebar active  */
if (!function_exists('setSidebarActive')) {

    function setSidebarActive(array $routes): ?string
    {
        foreach ($routes as $route) {
            if (request()->routeIs($route)) {
                return 'active';
            }
        }
        return null;
    }
}

/* regMatch for Videos Gallery in listings */
if (!function_exists('extractYoutubeId')) {
    function extractYoutubeId(string $url): ?string
    {
        $pattern = '/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&]+)/';
        preg_match($pattern, $url, $matches);

        return $matches[1] ?? null;
    }
}

// truncate text 
if (!function_exists('truncate')) {
    function truncate(string $text, int $limit = 25): ?string
    {
        return \Illuminate\Support\Str::of($text)->limit($limit);
    }
}

// currency position
if (!function_exists('currencyPosition')) {
    function currencyPosition(int $amount): ?string
    {
        if (config('settings.site_currency_position') == 'left') {

            return config('settings.site_currency_icon') . $amount;
        } elseif (config('settings.site_currency_position') == 'right') {

            return $amount . config('settings.site_currency_icon');
        }

        return null;
    }
}

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


if (!function_exists('truncate')) {
    function truncate(string $text, int $limit = 25): ?string
    {
        return \Illuminate\Support\Str::of($text)->limit($limit);
    }
}

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
        /*

         * preg_match(
             *     pattern : Regex pattern to search for.  أنا هدور على إيه؟ (Regex Pattern)
             *     string  : The string to search in.  هدور فين؟ (The text or URL)
             *     matches : Stores all matched results.     حطلي النتيجة هنا.
          );

         *
         * $url = "https://www.youtube.com/watch?v=AbCd12345";

         *
         * https://youtu.be/abc123
         * https://youtube.com/watch?v=abc123
         * https://youtube.com/watch?v=ABC123XYZ&t=50
         *
         * (?:A)
         * (?:B)
         *
         *
         * $matches = [

            0 => "youtu.be/AbCdEf12345",

            1 => "AbCdEf12345"
         ];
         *
         *  */


        $pattern = '/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&]+)/';
        preg_match($pattern, $url, $matches);

        return $matches[1] ?? null;
    }
}

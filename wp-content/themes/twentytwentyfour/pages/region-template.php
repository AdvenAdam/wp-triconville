<?php
get_header();

$region = get_query_var('region_slug');
echo "<h1>Welcome to region: " . esc_html($region) . "</h1>";

get_footer();
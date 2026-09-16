<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

header('Content-Type: application/xml; charset=UTF-8');

$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'hostinginfo.online';
$base = $scheme . '://' . $host;
$today = date('Y-m-d');

$urls = [
    ['loc' => $base . url(''), 'changefreq' => 'daily', 'priority' => '1.0'],
    ['loc' => $base . url('providers'), 'changefreq' => 'daily', 'priority' => '0.9'],
    ['loc' => $base . url('deals'), 'changefreq' => 'daily', 'priority' => '0.9'],
    ['loc' => $base . url('compare'), 'changefreq' => 'weekly', 'priority' => '0.6'],
    ['loc' => $base . url('tools'), 'changefreq' => 'monthly', 'priority' => '0.4'],
    ['loc' => $base . url('tools/whois'), 'changefreq' => 'monthly', 'priority' => '0.3'],
    ['loc' => $base . url('hosting-categories'), 'changefreq' => 'weekly', 'priority' => '0.5'],
    ['loc' => $base . url('awards'), 'changefreq' => 'monthly', 'priority' => '0.5'],
    ['loc' => $base . url('rating-methodology'), 'changefreq' => 'monthly', 'priority' => '0.3'],
    ['loc' => $base . url('human-sitemap'), 'changefreq' => 'weekly', 'priority' => '0.2'],
    ['loc' => $base . url('about'), 'changefreq' => 'monthly', 'priority' => '0.4'],
    ['loc' => $base . url('contact'), 'changefreq' => 'monthly', 'priority' => '0.4'],
    ['loc' => $base . url('privacy-policy'), 'changefreq' => 'yearly', 'priority' => '0.2'],
    ['loc' => $base . url('terms-of-service'), 'changefreq' => 'yearly', 'priority' => '0.2'],
];

foreach (get_all_categories() as $category) {
    $urls[] = ['loc' => $base . category_url($category), 'changefreq' => 'weekly', 'priority' => '0.7'];
}

$dealSlugs = array_column(get_deals(), 'provider_slug');

foreach (get_providers() as $provider) {
    $urls[] = ['loc' => $base . provider_url($provider), 'changefreq' => 'weekly', 'priority' => '0.8'];
    if (in_array($provider['slug'], $dealSlugs, true)) {
        $urls[] = ['loc' => $base . provider_coupons_url($provider), 'changefreq' => 'weekly', 'priority' => '0.6'];
    }
}

/* Comparison pages: only the curated "popular" pairs among top-rated providers, to avoid
 * a combinatorial explosion of every possible pairing across the whole directory. */
$topPool = get_providers();
usort($topPool, fn($a, $b) => $b['rating'] <=> $a['rating']);
$topPool = array_slice($topPool, 0, 8);
foreach ($topPool as $i => $a) {
    foreach ($topPool as $j => $b) {
        if ($j <= $i) {
            continue;
        }
        [$first, $second] = $a['slug'] < $b['slug'] ? [$a, $b] : [$b, $a];
        $urls[] = ['loc' => $base . compare_url($first, $second), 'changefreq' => 'monthly', 'priority' => '0.4'];
    }
}

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($urls as $u): ?>
    <url>
        <loc><?= e($u['loc']) ?></loc>
        <lastmod><?= $today ?></lastmod>
        <changefreq><?= $u['changefreq'] ?></changefreq>
        <priority><?= $u['priority'] ?></priority>
    </url>
<?php endforeach; ?>
</urlset>

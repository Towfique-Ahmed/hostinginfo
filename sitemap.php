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
];

foreach (get_providers() as $provider) {
    $urls[] = ['loc' => $base . provider_url($provider), 'changefreq' => 'weekly', 'priority' => '0.8'];
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

<?php
declare(strict_types=1);

define('ROOT_PATH', dirname(__DIR__));

/**
 * @return array<int, array<string, mixed>>
 */
function get_providers(): array
{
    static $providers = null;
    if ($providers === null) {
        $providers = require ROOT_PATH . '/data/providers.php';
    }
    return $providers;
}

/**
 * @return array<int, array<string, mixed>>
 */
function get_deals(): array
{
    static $deals = null;
    if ($deals === null) {
        $deals = require ROOT_PATH . '/data/deals.php';
    }
    return $deals;
}

function get_provider_by_slug(string $slug): ?array
{
    foreach (get_providers() as $provider) {
        if ($provider['slug'] === $slug) {
            return $provider;
        }
    }
    return null;
}

/**
 * @return array<int, array<string, mixed>> deals merged with their provider record, sorted by discount desc
 */
function get_deals_with_providers(): array
{
    $providers = get_providers();
    $index = [];
    foreach ($providers as $p) {
        $index[$p['slug']] = $p;
    }

    $deals = get_deals();
    $merged = [];
    foreach ($deals as $deal) {
        if (!isset($index[$deal['provider_slug']])) {
            continue;
        }
        $deal['provider'] = $index[$deal['provider_slug']];
        $merged[] = $deal;
    }

    usort($merged, fn($a, $b) => $b['discount'] <=> $a['discount']);

    return $merged;
}

/**
 * @return array<int, array<string, mixed>>
 */
function get_top_deals(int $limit = 10): array
{
    $deals = get_deals_with_providers();
    $deals = array_values(array_filter($deals, fn($d) => !empty($d['featured'])));
    return array_slice($deals, 0, $limit);
}

function get_all_categories(): array
{
    $set = [];
    foreach (get_providers() as $p) {
        foreach ($p['categories'] as $c) {
            $set[$c] = true;
        }
    }
    $cats = array_keys($set);
    sort($cats);
    return $cats;
}

function get_all_countries(): array
{
    $set = [];
    foreach (get_providers() as $p) {
        $set[$p['country']] = $p['flag'];
    }
    ksort($set);
    return $set;
}

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function initials(string $name): string
{
    $words = preg_split('/[\s\-\(\)\.]+/', $name, -1, PREG_SPLIT_NO_EMPTY);
    $words = array_slice($words, 0, 2);
    $letters = array_map(fn($w) => mb_strtoupper(mb_substr($w, 0, 1)), $words);
    return implode('', $letters);
}

/**
 * @return array{0:int,1:int,2:int} RGB channels for a #rrggbb string.
 */
function hex_to_rgb(string $hex): array
{
    $hex = ltrim($hex, '#');
    if (strlen($hex) === 3) {
        $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
    }
    return [
        (int) hexdec(substr($hex, 0, 2)),
        (int) hexdec(substr($hex, 2, 2)),
        (int) hexdec(substr($hex, 4, 2)),
    ];
}

/**
 * Relative luminance (0 = black, 1 = white), used to keep brand colours legible
 * once they sit on the site's own ink or paper background.
 */
function rgb_luminance(array $rgb): float
{
    return (0.2126 * $rgb[0] + 0.7152 * $rgb[1] + 0.0722 * $rgb[2]) / 255;
}

/**
 * Mixes a colour toward white or black until it clears a luminance floor/ceiling,
 * so a navy brand colour stays readable on ink and a yellow one stays readable on paper.
 */
function brand_variant(array $rgb, bool $forDark): string
{
    $target = $forDark ? [255, 255, 255] : [0, 0, 0];
    $lum = rgb_luminance($rgb);
    $needed = $forDark ? 0.5 : 0.28;

    for ($step = 0; $step < 10; $step++) {
        $ok = $forDark ? ($lum >= $needed) : ($lum <= $needed);
        if ($ok) {
            break;
        }
        $rgb = [
            (int) round($rgb[0] + ($target[0] - $rgb[0]) * 0.18),
            (int) round($rgb[1] + ($target[1] - $rgb[1]) * 0.18),
            (int) round($rgb[2] + ($target[2] - $rgb[2]) * 0.18),
        ];
        $lum = rgb_luminance($rgb);
    }

    return sprintf('#%02x%02x%02x', $rgb[0], $rgb[1], $rgb[2]);
}

/**
 * Flat identity tile: the provider's initials set in monospace, tinted with its own
 * brand colour. Replaces the old gradient SVG badge — no image dependency, and it
 * reads as a data point rather than an app icon.
 */
function provider_badge(array $provider, string $size = 'md'): string
{
    $rgb = hex_to_rgb((string) $provider['color1']);
    $style = sprintf(
        '--brand-rgb:%d,%d,%d;--brand-on-dark:%s;--brand-on-light:%s',
        $rgb[0], $rgb[1], $rgb[2],
        brand_variant($rgb, true),
        brand_variant($rgb, false)
    );

    return '<span class="logo-tile logo-tile--' . e($size) . '" style="' . e($style) . '" aria-hidden="true">'
        . e(initials((string) $provider['name']))
        . '</span>';
}

/**
 * Line-art glyph for a hosting category. Drawn rather than emoji, so the set stays
 * visually consistent and inherits the current text colour.
 */
function category_icon(string $category): string
{
    $paths = [
        'Shared'    => '<rect x="3" y="4" width="18" height="13" rx="1.5"/><path d="M8 21h8M12 17v4"/>',
        'WordPress' => '<circle cx="12" cy="12" r="9"/><path d="M4 9h16M7.5 9l3 9 3-9M14 18l3-9"/>',
        'VPS'       => '<rect x="3" y="4" width="18" height="7" rx="1.5"/><rect x="3" y="13" width="18" height="7" rx="1.5"/><path d="M7 7.5h.01M7 16.5h.01"/>',
        'Cloud'     => '<path d="M7 18h10a4 4 0 0 0 .6-7.96A6 6 0 0 0 6 9.5 4.25 4.25 0 0 0 7 18z"/>',
        'Dedicated' => '<rect x="4" y="3" width="16" height="18" rx="1.5"/><path d="M8 7h8M8 11h8M8 15h4"/>',
        'Reseller'  => '<path d="M4 8h16l-1.5 12H5.5L4 8z"/><path d="M9 8V6a3 3 0 0 1 6 0v2"/>',
        'Managed'   => '<path d="M12 3l7.5 3.5v5c0 4.5-3 8-7.5 9.5C7.5 19.5 4.5 16 4.5 11.5v-5L12 3z"/><path d="M9.5 12l1.8 1.8 3.5-3.6"/>',
    ];
    $body = $paths[$category] ?? '<circle cx="12" cy="12" r="9"/>';

    return '<svg viewBox="0 0 24 24" aria-hidden="true" stroke-linecap="round" stroke-linejoin="round">' . $body . '</svg>';
}

/**
 * Rating as a number plus a proportional bar. A five-dot meter rounds every provider
 * in a 4.3-4.9 band to "five dots"; a bar shows the difference that actually exists.
 */
function rating_meter(float $rating): string
{
    $pct = max(0, min(100, ($rating / 5) * 100));

    return '<span class="rating">'
        . '<span class="rating__num">' . number_format($rating, 1) . '</span>'
        . '<span class="meter" role="img" aria-label="' . e(number_format($rating, 1)) . ' out of 5">'
        . '<i style="width:' . round($pct, 1) . '%"></i>'
        . '</span></span>';
}

function format_price(float $price): string
{
    if ($price == 0.0) {
        return 'Free';
    }
    return '$' . (fmod($price, 1) == 0.0 ? number_format($price, 0) : number_format($price, 2));
}

function slugify_query(string $value): string
{
    return trim(preg_replace('/[^a-z0-9]+/', '-', strtolower($value)) ?? '', '-');
}

/**
 * Builds a site-relative URL for a top-level page, optionally with a query string.
 * Pass '' for the homepage.
 */
function url(string $path = '', array $params = []): string
{
    $path = '/' . ltrim($path, '/');
    $query = http_build_query($params);
    return $path . ($query ? '?' . $query : '');
}

/**
 * URL slug for a hosting category: 'Cloud' -> 'cloud-hosting', 'VPS' -> 'vps-hosting'.
 */
function category_slug(string $category): string
{
    return slugify_query($category) . '-hosting';
}

/**
 * Resolves a category slug back to its canonical category name, or null if it
 * matches no known category. Comparison goes through category_slug() so the two
 * directions can never drift apart.
 */
function category_from_slug(string $slug): ?string
{
    $slug = strtolower(trim($slug, '/'));
    foreach (get_all_categories() as $category) {
        if (category_slug($category) === $slug) {
            return $category;
        }
    }
    return null;
}

/**
 * Builds the clean /providers/{category}-hosting URL, optionally with a query string.
 */
function category_url(string $category, array $params = []): string
{
    $query = http_build_query($params);
    return '/providers/' . category_slug($category) . ($query ? '?' . $query : '');
}

/**
 * Sends a permanent redirect and stops. Used to fold the old ?category= links
 * into their canonical path form.
 */
function redirect_permanent(string $location): void
{
    header('Location: ' . $location, true, 301);
    exit;
}

/**
 * Builds the clean /provider/{slug} URL for a provider record or slug.
 */
function provider_url(array|string $provider): string
{
    $slug = is_array($provider) ? $provider['slug'] : $provider;
    return '/provider/' . rawurlencode($slug);
}

/**
 * Scheme + host only, no path: e.g. "https://hostinginfo.online".
 */
function base_url(): string
{
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'hostinginfo.online';
    return $scheme . '://' . $host;
}

/**
 * Absolute canonical URL for the current request (scheme + host + path, no query string).
 */
function canonical_url(): string
{
    $path = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
    return base_url() . $path;
}

/**
 * Current request path with no leading/trailing slash or query string, e.g. 'provider/kinsta'.
 */
function current_path(): string
{
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
    return trim($path, '/');
}

/**
 * Renders the themed 404 page and stops execution. Shared by index.php's front-controller
 * router (for unknown paths) and provider.php (for an unknown provider slug).
 */
function render_not_found(string $heading = 'Page Not Found', ?string $message = null): void
{
    $message = $message ?? 'The page you requested does not exist. Try the homepage or browse all providers.';
    http_response_code(404);
    $page_title = $heading . ' | HostingInfo';
    $page_description = $message;
    $robots = 'noindex, follow';
    $active_nav = '';
    require __DIR__ . '/header.php';
    ?>
    <div class="container">
        <section class="page-head">
            <span class="kicker">Error 404</span>
            <h1><?= e($heading) ?></h1>
            <p class="lede"><?= e($message) ?></p>
            <div class="provider-head__actions">
                <a href="<?= url('providers') ?>" class="btn btn--primary">Browse the directory</a>
                <a href="<?= url('') ?>" class="btn">Back to home</a>
            </div>
        </section>
    </div>
    <?php
    require __DIR__ . '/footer.php';
    exit;
}

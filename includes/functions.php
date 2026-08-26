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

function star_rating_html(float $rating): string
{
    $full = (int) floor($rating);
    $half = ($rating - $full) >= 0.25 && ($rating - $full) < 0.75;
    if (($rating - $full) >= 0.75) {
        $full++;
    }
    $empty = 5 - $full - ($half ? 1 : 0);

    $html = '<span class="stars" aria-label="' . e((string) $rating) . ' out of 5 stars">';
    for ($i = 0; $i < $full; $i++) {
        $html .= '<svg viewBox="0 0 24 24" class="star star--full"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01z"/></svg>';
    }
    if ($half) {
        $html .= '<svg viewBox="0 0 24 24" class="star star--half"><defs><linearGradient id="half-' . uniqid() . '" x1="0" x2="1"><stop offset="50%" stop-color="currentColor"/><stop offset="50%" stop-color="transparent"/></linearGradient></defs><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01z" fill="url(#half-' . uniqid() . ')" stroke="currentColor"/></svg>';
    }
    for ($i = 0; $i < $empty; $i++) {
        $html .= '<svg viewBox="0 0 24 24" class="star star--empty"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01z"/></svg>';
    }
    $html .= '</span>';
    return $html;
}

function initials(string $name): string
{
    $words = preg_split('/[\s\-\(\)]+/', $name, -1, PREG_SPLIT_NO_EMPTY);
    $words = array_slice($words, 0, 2);
    $letters = array_map(fn($w) => mb_strtoupper(mb_substr($w, 0, 1)), $words);
    return implode('', $letters);
}

/**
 * Renders a self-contained gradient badge (no external image dependency).
 */
function provider_badge(array $provider, string $size = 'md'): string
{
    $sizeClass = 'badge--' . $size;
    $c1 = e($provider['color1']);
    $c2 = e($provider['color2']);
    $letters = e(initials($provider['name']));
    $gradId = 'grad-' . e($provider['slug']) . '-' . $size;
    return '<span class="provider-badge ' . $sizeClass . '" style="--c1:' . $c1 . ';--c2:' . $c2 . '">
        <svg viewBox="0 0 64 64" role="img" aria-label="' . e($provider['name']) . ' logo">
            <defs><linearGradient id="' . $gradId . '" x1="0" y1="0" x2="1" y2="1">
                <stop offset="0%" stop-color="' . $c1 . '"/>
                <stop offset="100%" stop-color="' . $c2 . '"/>
            </linearGradient></defs>
            <rect width="64" height="64" rx="18" fill="url(#' . $gradId . ')"/>
            <text x="32" y="40" text-anchor="middle" font-family="Space Grotesk, sans-serif" font-weight="700" font-size="24" fill="#fff">' . $letters . '</text>
        </svg>
    </span>';
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

function page_url(string $file, array $params = []): string
{
    $query = http_build_query($params);
    return $file . ($query ? '?' . $query : '');
}

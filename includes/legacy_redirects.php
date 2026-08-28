<?php
declare(strict_types=1);

/**
 * Slugs of blog posts that used to live at the site root and no longer exist.
 * Google still has them indexed, so they are 301'd to the homepage instead of
 * serving a 404, which passes their link equity on and clears the errors in
 * Search Console.
 */
const LEGACY_BLOG_SLUGS = [
    'cloudways-vs-wp-engine',
    'kinsta-review',
    'hostinger-review',
    'best-siteground-alternatives',
    'best-rapyd-cloud-alternatives',
    'best-hosting-com-alternatives',
    'best-hostinger-alternatives',
    'best-kinsta-alternatives',
    'best-liquid-web-alternatives',
    'best-wp-engine-alternatives',
    'best-nodejs-hosting-providers',
    'best-laravel-hosting-providers',
    'best-cloudways-alternatives',
    'best-openclaw-hosting-providers',
    'cloudways-review',
    'dreamhost-review',
    'rapyd-cloud-review',
    'best-website-builders',
    'xcloud-hosting-review',
    'kinsta-vs-siteground',
    'liquid-web-review',
    'wp-engine-review',
    'hosting-com-review',
    'wp-engine-vs-kinsta',
    'best-black-friday-web-hosting-deals',
    'siteground-review',
    'best-dreamhost-alternatives',
];

/**
 * Sends a permanent redirect to the homepage when $path is a retired blog URL.
 */
function redirect_legacy_blog_url(string $path): void
{
    if (in_array(strtolower($path), LEGACY_BLOG_SLUGS, true)) {
        header('Location: /', true, 301);
        exit;
    }
}

<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/legacy_redirects.php';

/**
 * Front-controller fallback: some hosts (e.g. xCloud's Nginx, tuned for WordPress-style
 * "pretty permalinks") route every request that isn't a real file straight to index.php,
 * bypassing .htaccess entirely. Dispatch on the request path so clean URLs still resolve
 * even when that catch-all is the only routing the server does.
 */
$requestPath = current_path();

// Retired blog posts still in Google's index: 301 them to the homepage.
redirect_legacy_blog_url($requestPath);

if ($requestPath === 'providers') {
    require __DIR__ . '/providers.php';
    exit;
}
if ($requestPath === 'deals') {
    require __DIR__ . '/deals.php';
    exit;
}
if (preg_match('#^providers/([a-zA-Z0-9\-]+)$#', $requestPath, $m)) {
    $_GET['category_slug'] = $m[1];
    require __DIR__ . '/providers.php';
    exit;
}
if (preg_match('#^provider/([a-zA-Z0-9\-]+)$#', $requestPath, $m)) {
    $_GET['slug'] = $m[1];
    require __DIR__ . '/provider.php';
    exit;
}
if ($requestPath === 'sitemap.xml') {
    require __DIR__ . '/sitemap.php';
    exit;
}
if ($requestPath === 'about') {
    require __DIR__ . '/about.php';
    exit;
}
if ($requestPath === 'contact') {
    require __DIR__ . '/contact.php';
    exit;
}
if ($requestPath === 'privacy-policy') {
    require __DIR__ . '/privacy-policy.php';
    exit;
}
if ($requestPath !== '' && $requestPath !== 'index.php') {
    render_not_found();
}

$page_title = 'HostingInfo — Compare Web Hosting Providers & Find the Best Hosting Deals';
$page_description = 'An independent directory of ' . count(get_providers()) . ' web hosting providers: compare price, uptime and rating side by side, and track the coupon codes worth using.';
$active_nav = 'home';

$_base = base_url();
$json_ld = json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'WebSite',
            '@id'   => $_base . '/#website',
            'name'  => 'HostingInfo',
            'url'   => $_base,
            'description' => 'An independent reference for web hosting: compare providers on price, uptime and rating, and track the discounts worth using.',
            'potentialAction' => [
                '@type'  => 'SearchAction',
                'target' => [
                    '@type'       => 'EntryPoint',
                    'urlTemplate' => $_base . '/providers?q={search_term_string}',
                ],
                'query-input' => 'required name=search_term_string',
            ],
        ],
        [
            '@type' => 'Organization',
            '@id'   => $_base . '/#organization',
            'name'  => 'HostingInfo',
            'url'   => $_base,
        ],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

$providers = get_providers();
$topDeals = get_top_deals(6);
$countries = get_all_countries();
$categories = get_all_categories();
$allDeals = get_deals_with_providers();

usort($providers, fn($a, $b) => $b['rating'] <=> $a['rating']);
$picks = array_slice($providers, 0, 6);

$avgUptime = array_sum(array_column($providers, 'uptime')) / max(count($providers), 1);
$cheapest = min(array_column($providers, 'price'));
$biggestCut = $allDeals ? max(array_column($allDeals, 'discount')) : 0;

require __DIR__ . '/includes/header.php';
?>

<div class="container">

    <section class="masthead">
        <div>
            <div class="masthead__dateline">
                <span class="dot"></span>
                <span class="kicker">Updated <?= date('j F Y') ?></span>
            </div>
            <h1>Hosting, compared <em>honestly</em>.</h1>
            <p class="lede">We profile <?= count($providers) ?> providers across <?= count($countries) ?> countries and put their numbers side by side — price, uptime, rating — so the comparison takes minutes, not tabs.</p>
            <form class="masthead__search" action="<?= url('providers') ?>" method="get">
                <label class="field">
                    <span class="visually-hidden">Search providers</span>
                    <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3" stroke-linecap="round"/></svg>
                    <input type="text" name="q" placeholder="Search by provider, country or feature">
                </label>
                <button type="submit" class="btn btn--primary">Search</button>
            </form>
        </div>

        <div class="spec-block">
            <div class="spec-row">
                <span class="spec-row__label">Providers profiled</span>
                <span class="spec-row__value" data-count="<?= count($providers) ?>"><?= count($providers) ?></span>
            </div>
            <div class="spec-row">
                <span class="spec-row__label">Countries represented</span>
                <span class="spec-row__value" data-count="<?= count($countries) ?>"><?= count($countries) ?></span>
            </div>
            <div class="spec-row">
                <span class="spec-row__label">Live coupon codes</span>
                <span class="spec-row__value" data-count="<?= count($allDeals) ?>"><?= count($allDeals) ?></span>
            </div>
            <div class="spec-row">
                <span class="spec-row__label">Mean uptime tracked</span>
                <span class="spec-row__value"><?= number_format($avgUptime, 2) ?><small>%</small></span>
            </div>
            <div class="spec-row">
                <span class="spec-row__label">Entry price, lowest</span>
                <span class="spec-row__value"><?= format_price((float)$cheapest) ?><small>/mo</small></span>
            </div>
            <div class="spec-row">
                <span class="spec-row__label">Deepest discount</span>
                <span class="spec-row__value"><?= (int)$biggestCut ?><small>% off</small></span>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="section-head reveal">
            <div class="section-head__title">
                <span class="kicker kicker--signal">01 / Deals</span>
                <h2>Discounts worth using</h2>
            </div>
            <a href="<?= url('deals') ?>" class="section-head__link">All <?= count($allDeals) ?> deals
                <svg viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>
        </div>

        <div class="deal-list reveal">
            <?php foreach ($topDeals as $i => $deal): $p = $deal['provider']; ?>
                <article class="deal">
                    <span class="deal__rank num"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                    <div class="deal__id">
                        <?= provider_badge($p, 'sm') ?>
                        <div>
                            <h3 class="deal__title"><?= e($deal['title']) ?></h3>
                            <div class="deal__provider">
                                <a href="<?= provider_url($p) ?>"><?= e($p['name']) ?></a> · <?= e($p['country']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="deal__price">
                        <span class="was"><?= format_price((float)$deal['original_price']) ?></span>
                        <span class="now"><?= format_price((float)$deal['deal_price']) ?></span>
                        <span class="per">/mo</span>
                    </div>
                    <div class="coupon">
                        <code><?= e($deal['coupon']) ?></code>
                        <button type="button" class="copy-btn" data-copy="<?= e($deal['coupon']) ?>">
                            <svg viewBox="0 0 24 24"><rect x="9" y="9" width="12" height="12" rx="2"/><path d="M5 15V5a2 2 0 0 1 2-2h10"/></svg>
                            Copy
                        </button>
                    </div>
                    <div class="deal__off"><?= (int)$deal['discount'] ?>%<small>OFF</small></div>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="section">
        <div class="section-head reveal">
            <div class="section-head__title">
                <span class="kicker kicker--signal">02 / Top rated</span>
                <h2>Our highest-scoring hosts</h2>
            </div>
            <a href="<?= url('providers') ?>" class="section-head__link">Open the directory
                <svg viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>
        </div>

        <div class="pick-grid reveal">
            <?php foreach ($picks as $i => $p): ?>
                <a class="pick" href="<?= provider_url($p) ?>">
                    <div class="pick__top">
                        <?= provider_badge($p, 'md') ?>
                        <div>
                            <div class="pick__name"><?= e($p['name']) ?></div>
                            <div class="pick__origin"><?= e($p['country']) ?> · est. <?= (int)$p['founded'] ?></div>
                        </div>
                        <span class="pick__rank"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                    </div>
                    <p class="pick__line"><?= e($p['tagline']) ?></p>
                    <div class="pick__foot">
                        <?= rating_meter((float)$p['rating']) ?>
                        <span class="pick__price"><?= format_price((float)$p['price']) ?><small>/mo</small></span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="section">
        <div class="section-head reveal">
            <div class="section-head__title">
                <span class="kicker kicker--signal">03 / By need</span>
                <h2>Browse by hosting type</h2>
            </div>
        </div>

        <div class="cat-index reveal">
            <?php foreach ($categories as $cat):
                $count = count(array_filter($providers, fn($p) => in_array($cat, $p['categories'], true))); ?>
                <a href="<?= e(category_url($cat)) ?>">
                    <?= category_icon($cat) ?>
                    <span class="cat-index__name"><?= e($cat) ?></span>
                    <span class="cat-index__count"><?= $count ?></span>
                </a>
            <?php endforeach; ?>
        </div>
    </section>

</div>

<?php require __DIR__ . '/includes/footer.php'; ?>

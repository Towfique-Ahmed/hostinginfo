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
if (preg_match('#^provider/([a-zA-Z0-9\-]+)/coupons$#', $requestPath, $m)) {
    $_GET['slug'] = $m[1];
    require __DIR__ . '/provider-coupons.php';
    exit;
}
if (preg_match('#^provider/([a-zA-Z0-9\-]+)$#', $requestPath, $m)) {
    $_GET['slug'] = $m[1];
    require __DIR__ . '/provider.php';
    exit;
}
if (preg_match('#^compare/([a-zA-Z0-9\-]+)$#', $requestPath, $m)) {
    $_GET['pair'] = $m[1];
    require __DIR__ . '/compare-vs.php';
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
if ($requestPath === 'terms-of-service') {
    require __DIR__ . '/terms-of-service.php';
    exit;
}
if ($requestPath === 'rating-methodology') {
    require __DIR__ . '/rating-methodology.php';
    exit;
}
if ($requestPath === 'awards') {
    require __DIR__ . '/awards.php';
    exit;
}
if ($requestPath === 'human-sitemap') {
    require __DIR__ . '/human-sitemap.php';
    exit;
}
if ($requestPath === 'tools') {
    require __DIR__ . '/tools.php';
    exit;
}
if ($requestPath === 'tools/whois') {
    require __DIR__ . '/whois.php';
    exit;
}
if ($requestPath === 'compare') {
    require __DIR__ . '/comparisons.php';
    exit;
}
if ($requestPath === 'hosting-categories') {
    require __DIR__ . '/hosting-categories.php';
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
$countries = get_all_countries();
$categories = get_all_categories();
$allDeals = get_deals_with_providers();

usort($providers, fn($a, $b) => $b['rating'] <=> $a['rating']);

$avgUptime = array_sum(array_column($providers, 'uptime')) / max(count($providers), 1);
$cheapest = min(array_column($providers, 'price'));
$biggestCut = $allDeals ? max(array_column($allDeals, 'discount')) : 0;

/* Explore strips: short horizontal-scroll rows, one per facet of the directory. */
$exploreReviews = array_slice($providers, 0, 10);
$exploreCoupons = array_slice($allDeals, 0, 10);
$exploreTopPool = array_slice($providers, 0, 6);
$explorePairs = [];
foreach ($exploreTopPool as $i => $a) {
    foreach ($exploreTopPool as $j => $b) {
        if ($j <= $i) {
            continue;
        }
        $explorePairs[] = [$a, $b];
    }
}
$explorePairs = array_slice($explorePairs, 0, 8);

/* Recommended providers, tabbed by category. An empty key is the "All" tab. */
$recGroups = ['' => array_slice($providers, 0, 6)];
foreach ($categories as $cat) {
    $inCat = array_values(array_filter($providers, fn($p) => in_array($cat, $p['categories'], true)));
    $recGroups[$cat] = array_slice($inCat, 0, 6);
}

/* Three coupons to feature big: the featured/exclusive ones first, deepest discount otherwise. */
$featuredDeals = array_values(array_filter($allDeals, fn($d) => !empty($d['featured'])));
$topCoupons = array_slice($featuredDeals ?: $allDeals, 0, 3);

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

    <section class="explore-strip">
        <div class="explore-strip__head">
            <span class="explore-strip__icon"><svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7a2 2 0 0 1 2-2h4l2 2h8a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7z"/></svg></span>
            <div class="explore-strip__title-row">
                <div>
                    <h2>Explore categories</h2>
                    <p class="explore-strip__desc">Every hosting type we track, with how many providers offer it.</p>
                </div>
                <a href="<?= url('hosting-categories') ?>" class="section-head__link">See all
                    <svg viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
            </div>
        </div>
        <div class="tile-scroll">
            <?php foreach ($categories as $cat):
                $count = count(array_filter($providers, fn($p) => in_array($cat, $p['categories'], true))); ?>
                <a class="explore-tile" href="<?= e(category_url($cat)) ?>">
                    <span class="explore-tile__icon"><?= category_icon($cat) ?></span>
                    <span class="explore-tile__body">
                        <span class="explore-tile__name"><?= e($cat) ?> hosting</span>
                        <span class="explore-tile__meta"><?= $count ?> providers</span>
                    </span>
                </a>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="explore-strip">
        <div class="explore-strip__head">
            <span class="explore-strip__icon"><svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l2.6 5.6 6.1.6-4.6 4.1 1.3 6-5.4-3.2-5.4 3.2 1.3-6-4.6-4.1 6.1-.6z"/></svg></span>
            <div class="explore-strip__title-row">
                <div>
                    <h2>Explore reviews</h2>
                    <p class="explore-strip__desc">Our highest-rated providers, one tap from the full profile.</p>
                </div>
                <a href="<?= url('providers') ?>" class="section-head__link">See all
                    <svg viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
            </div>
        </div>
        <div class="tile-scroll">
            <?php foreach ($exploreReviews as $p): ?>
                <a class="explore-tile" href="<?= provider_url($p) ?>">
                    <?= provider_badge($p, 'sm') ?>
                    <span class="explore-tile__body">
                        <span class="explore-tile__name"><?= e($p['name']) ?></span>
                        <span class="explore-tile__meta"><?= number_format((float)$p['rating'], 1) ?>/5</span>
                    </span>
                </a>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="explore-strip">
        <div class="explore-strip__head">
            <span class="explore-strip__icon"><svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2h7a2 2 0 0 1 2 2v7l-9 9-9-9 9-9z"/><path d="M9 9h.01"/></svg></span>
            <div class="explore-strip__title-row">
                <div>
                    <h2>Explore coupons</h2>
                    <p class="explore-strip__desc">Every provider with a live discount code right now.</p>
                </div>
                <a href="<?= url('deals') ?>" class="section-head__link">See all <?= count($allDeals) ?>
                    <svg viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
            </div>
        </div>
        <div class="tile-scroll">
            <?php foreach ($exploreCoupons as $deal): $p = $deal['provider']; ?>
                <a class="explore-tile" href="<?= e(provider_coupons_url($p)) ?>">
                    <?= provider_badge($p, 'sm') ?>
                    <span class="explore-tile__body">
                        <span class="explore-tile__name"><?= e($p['name']) ?></span>
                        <span class="explore-tile__meta"><?= (int)$deal['discount'] ?>% off</span>
                    </span>
                </a>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="explore-strip">
        <div class="explore-strip__head">
            <span class="explore-strip__icon"><svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v18M7 21h10M12 6L5 18h14z"/></svg></span>
            <div class="explore-strip__title-row">
                <div>
                    <h2>Explore comparisons</h2>
                    <p class="explore-strip__desc">Popular match-ups among our top-rated providers.</p>
                </div>
                <a href="<?= url('compare') ?>" class="section-head__link">See all
                    <svg viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
            </div>
        </div>
        <div class="tile-scroll">
            <?php foreach ($explorePairs as [$pa, $pb]): ?>
                <a class="explore-tile" href="<?= e(compare_url($pa, $pb)) ?>">
                    <?= provider_badge($pa, 'sm') ?>
                    <span class="explore-tile__body">
                        <span class="explore-tile__name"><?= e($pa['name']) ?> vs <?= e($pb['name']) ?></span>
                        <span class="explore-tile__meta">Side by side</span>
                    </span>
                </a>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="section">
        <div class="section-head reveal">
            <div class="section-head__title">
                <span class="kicker kicker--signal">05 / Recommended</span>
                <h2>HostingInfo recommends</h2>
            </div>
            <a href="<?= url('providers') ?>" class="section-head__link">Open the directory
                <svg viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>
        </div>

        <div class="rec-tabs reveal" data-tabgroup="rec" role="tablist">
            <button type="button" class="rec-tab is-active" data-tab="">All</button>
            <?php foreach ($categories as $cat): ?>
                <button type="button" class="rec-tab" data-tab="<?= e($cat) ?>"><?= e($cat) ?></button>
            <?php endforeach; ?>
        </div>

        <div class="reveal" data-tabpanels="rec">
            <?php foreach ($recGroups as $groupKey => $groupProviders): ?>
                <div class="rec-panel <?= $groupKey === '' ? 'is-active' : '' ?>" data-tab="<?= e($groupKey) ?>">
                    <div class="rec-grid">
                        <?php foreach ($groupProviders as $i => $p): ?>
                            <div class="rec-card">
                                <?php if ($groupKey === '' && $i === 0): ?><span class="rec-card__label">Best overall</span><?php endif; ?>
                                <div class="rec-card__head">
                                    <?= provider_badge($p, 'md') ?>
                                    <div>
                                        <div class="rec-card__name"><a href="<?= provider_url($p) ?>"><?= e($p['name']) ?></a></div>
                                        <div class="rec-card__origin"><?= e($p['country']) ?> · est. <?= (int)$p['founded'] ?></div>
                                    </div>
                                </div>
                                <?php $highlights = provider_highlights($p); if ($highlights): ?>
                                <ul class="rec-card__bullets">
                                    <?php foreach ($highlights as $h): ?>
                                        <li><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg><?= e($h) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php endif; ?>
                                <div class="rec-card__score">
                                    <div class="rec-card__score-num"><?= number_format((float)$p['rating'], 1) ?></div>
                                    <div>
                                        <?= rating_meter((float)$p['rating']) ?>
                                        <div class="rec-card__score-name"><?= e(rating_adjective((float)$p['rating'])) ?> · <?= number_format((int)$p['reviews']) ?> reviews</div>
                                    </div>
                                </div>
                                <div class="rec-card__foot">
                                    <span class="rec-card__price"><?= format_price((float)$p['price']) ?><small>/mo</small></span>
                                    <div class="rec-card__actions">
                                        <a class="btn btn--sm btn--primary" href="<?= provider_url($p) ?>">Read review</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="section">
        <div class="section-head reveal">
            <div class="section-head__title">
                <span class="kicker kicker--signal">06 / Why trust us</span>
                <h2>The same fields, every provider</h2>
            </div>
        </div>

        <div class="trust-layout reveal">
            <div class="trust-tabs" data-tabgroup="trust" role="tablist">
                <button type="button" class="trust-tab is-active" data-tab="method">
                    <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 8v.01M12 11v5"/></svg>
                    Our methodology
                </button>
                <button type="button" class="trust-tab" data-tab="team">
                    <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 4-6 8-6s8 2 8 6"/></svg>
                    Who writes this
                </button>
                <button type="button" class="trust-tab" data-tab="corrections">
                    <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
                    Corrections
                </button>
            </div>

            <div data-tabpanels="trust">
                <div class="trust-panel is-active" data-tab="method">
                    <p>Every provider is scored against the same five weighted factors — speed, support, value, features and reliability — plus our own editorial read of its plans and policies. No provider pays for a better number, and the full breakdown of what each factor means is public.</p>
                    <a href="<?= url('rating-methodology') ?>" class="btn btn--sm">See the full methodology</a>
                </div>
                <div class="trust-panel" data-tab="team">
                    <div class="trust-expert">
                        <div class="trust-expert__avatar">TA</div>
                        <div>
                            <div class="trust-expert__name">Towfique Ahmed</div>
                            <div class="trust-expert__role">Founder, HostingInfo</div>
                        </div>
                    </div>
                    <p>HostingInfo is written and maintained by a small team that has spent years building and troubleshooting WordPress sites — the pricing figures and trade-offs here come from that hands-on background, not marketing copy.</p>
                    <a href="<?= url('about') ?>" class="btn btn--sm">Meet the team</a>
                </div>
                <div class="trust-panel" data-tab="corrections">
                    <p>Prices and plans move on providers' own sites, often without notice. If a figure looks stale or wrong, tell us — we would rather correct it than defend it, and we review every message.</p>
                    <a href="<?= url('contact') ?>" class="btn btn--sm">Send a correction</a>
                </div>
            </div>
        </div>
    </section>

    <?php if ($topCoupons): ?>
    <section class="section">
        <div class="section-head reveal">
            <div class="section-head__title">
                <span class="kicker kicker--signal">07 / Exclusives</span>
                <h2>Our top <?= count($topCoupons) ?> hosting coupons</h2>
            </div>
            <a href="<?= url('deals') ?>" class="section-head__link">All <?= count($allDeals) ?> deals
                <svg viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>
        </div>

        <div class="fc-grid reveal">
            <?php foreach ($topCoupons as $deal): $p = $deal['provider']; ?>
                <div class="fc-card">
                    <div class="fc-card__head">
                        <?= provider_badge($p, 'md') ?>
                        <div class="fc-tags">
                            <span class="fc-tag fc-tag--verified">Verified</span>
                            <?php if (!empty($deal['featured'])): ?><span class="fc-tag fc-tag--exclusive">Exclusive</span><?php endif; ?>
                        </div>
                    </div>
                    <h3 class="fc-card__title"><?= e($deal['title']) ?></h3>
                    <p class="fc-card__desc"><?= e($p['name']) ?> · down to <?= format_price((float)$deal['deal_price']) ?>/mo</p>
                    <div class="coupon-wrap">
                        <div class="coupon">
                            <code><?= e($deal['coupon']) ?></code>
                            <button type="button" class="copy-btn" data-copy="<?= e($deal['coupon']) ?>">
                                <svg viewBox="0 0 24 24"><rect x="9" y="9" width="12" height="12" rx="2"/><path d="M5 15V5a2 2 0 0 1 2-2h10"/></svg>
                                Copy
                            </button>
                        </div>
                    </div>
                    <div class="fc-card__actions">
                        <a class="btn btn--primary btn--sm" href="<?= provider_url($p) ?>">Read the review</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <section class="section reveal">
        <div class="tools-teaser-head section-head">
            <div class="section-head__title">
                <span class="kicker kicker--signal">08 / Tools</span>
                <h2>Free tools, no signup</h2>
            </div>
            <a href="<?= url('tools') ?>" class="section-head__link">Open tools hub
                <svg viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>
        </div>
        <div class="pick-grid">
            <a class="pick" href="<?= url('compare') ?>">
                <div class="pick__top">
                    <span class="logo-tile logo-tile--md" aria-hidden="true" style="--brand-rgb:233,171,76;--brand-on-dark:#fff;--brand-on-light:#000">
                        <svg viewBox="0 0 24 24" width="18" height="18" style="stroke:currentColor;fill:none;stroke-width:1.6"><path d="M8 3v18M16 3v18M4 8h4M4 16h4M16 8h4M16 16h4" stroke-linecap="round"/></svg>
                    </span>
                    <div><div class="pick__name">Compare providers</div></div>
                </div>
                <p class="pick__line">Put any two hosts side by side on price, uptime, rating and features.</p>
            </a>
            <a class="pick" href="<?= url('tools/whois') ?>">
                <div class="pick__top">
                    <span class="logo-tile logo-tile--md" aria-hidden="true" style="--brand-rgb:233,171,76;--brand-on-dark:#fff;--brand-on-light:#000">
                        <svg viewBox="0 0 24 24" width="18" height="18" style="stroke:currentColor;fill:none;stroke-width:1.6"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3" stroke-linecap="round"/></svg>
                    </span>
                    <div><div class="pick__name">Whois lookup</div></div>
                </div>
                <p class="pick__line">Check who a domain is registered to, and when it was created and expires.</p>
            </a>
            <a class="pick" href="<?= url('providers') ?>">
                <div class="pick__top">
                    <span class="logo-tile logo-tile--md" aria-hidden="true" style="--brand-rgb:233,171,76;--brand-on-dark:#fff;--brand-on-light:#000">
                        <svg viewBox="0 0 24 24" width="18" height="18" style="stroke:currentColor;fill:none;stroke-width:1.6"><rect x="3" y="4" width="18" height="16" rx="1.5"/><path d="M3 9h18"/></svg>
                    </span>
                    <div><div class="pick__name">Plan search</div></div>
                </div>
                <p class="pick__line">Filter the full directory by country, price and hosting type.</p>
            </a>
        </div>
    </section>

</div>

<?php require __DIR__ . '/includes/footer.php'; ?>

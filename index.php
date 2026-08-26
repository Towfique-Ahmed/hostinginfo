<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

/**
 * Front-controller fallback: some hosts (e.g. xCloud's Nginx, tuned for WordPress-style
 * "pretty permalinks") route every request that isn't a real file straight to index.php,
 * bypassing .htaccess entirely. Dispatch on the request path so clean URLs still resolve
 * even when that catch-all is the only routing the server does.
 */
$requestPath = current_path();

if ($requestPath === 'providers') {
    require __DIR__ . '/providers.php';
    exit;
}
if ($requestPath === 'deals') {
    require __DIR__ . '/deals.php';
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
$page_description = 'Compare 35+ web hosting providers from around the world, read in-depth reviews, and grab the top 10 hosting deals and coupon codes — updated regularly.';
$active_nav = 'home';

$providers = get_providers();
$topDeals = get_top_deals(10);
$countries = get_all_countries();
$categories = get_all_categories();

$categoryIcons = [
    'Shared' => '🖥️', 'WordPress' => '📝', 'VPS' => '🧩', 'Cloud' => '☁️',
    'Dedicated' => '🗄️', 'Reseller' => '🔁', 'Managed' => '🛠️',
];

usort($providers, fn($a, $b) => $b['rating'] <=> $a['rating']);
$featured = array_slice($providers, 0, 8);

require __DIR__ . '/includes/header.php';
?>

<section class="hero">
    <div class="container">
        <span class="hero__eyebrow"><span class="dot"></span> Tracking <?= count($providers) ?> hosting providers across <?= count($countries) ?> countries</span>
        <h1>Find your perfect <span class="gradient-text">hosting match</span>, anywhere in the world.</h1>
        <p class="lead">HostingInfo is an independent directory of web hosting providers — compare pricing, uptime and features, then grab the deal that fits.</p>

        <form class="search-shell" action="<?= url('providers') ?>" method="get">
            <div class="search-box">
                <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
                <input type="text" name="q" placeholder="Search by provider, country, or feature…" aria-label="Search hosting providers">
                <button type="submit" class="btn btn--primary btn--sm">Search</button>
            </div>
        </form>

        <div class="hero__chips">
            <a class="chip" href="<?= url('providers', ['category' => 'WordPress']) ?>">📝 WordPress</a>
            <a class="chip" href="<?= url('providers', ['category' => 'VPS']) ?>">🧩 VPS</a>
            <a class="chip" href="<?= url('providers', ['category' => 'Cloud']) ?>">☁️ Cloud</a>
            <a class="chip" href="<?= url('providers', ['category' => 'Dedicated']) ?>">🗄️ Dedicated</a>
            <a class="chip" href="<?= url('deals') ?>">🔥 Hot Deals</a>
        </div>

        <div class="stats-row">
            <div class="stat-pill">
                <div class="stat-pill__num" data-count="<?= count($providers) ?>">0</div>
                <div class="stat-pill__label">Hosting Providers</div>
            </div>
            <div class="stat-pill">
                <div class="stat-pill__num" data-count="<?= count($countries) ?>">0</div>
                <div class="stat-pill__label">Countries Covered</div>
            </div>
            <div class="stat-pill">
                <div class="stat-pill__num" data-count="<?= count($topDeals) ?>" data-suffix="+">0</div>
                <div class="stat-pill__label">Live Hosting Deals</div>
            </div>
            <div class="stat-pill">
                <div class="stat-pill__num" data-count="99" data-suffix="%">0</div>
                <div class="stat-pill__label">Avg. Uptime Tracked</div>
            </div>
        </div>
    </div>
</section>

<section class="section" id="deals">
    <div class="container">
        <div class="section-head reveal">
            <div>
                <span class="section-head__eyebrow">🔥 Limited-time offers</span>
                <h2>Top 10 hosting deals right now</h2>
                <p>Hand-picked discounts and coupon codes from providers around the globe — refreshed regularly.</p>
            </div>
            <a href="<?= url('deals') ?>" class="section-head__link">See all deals
                <svg viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
        </div>

        <div class="deals-strip">
            <?php foreach ($topDeals as $i => $deal): $p = $deal['provider']; ?>
                <div class="deal-card reveal" style="transition-delay: <?= min($i * 60, 300) ?>ms">
                    <div class="deal-card__inner">
                        <span class="deal-card__rank">#<?= $i + 1 ?></span>
                        <div class="deal-card__top">
                            <?= provider_badge($p, 'sm') ?>
                            <div>
                                <div class="provider-card__name"><?= e($p['name']) ?></div>
                                <div class="provider-card__country"><?= $p['flag'] ?> <?= e($p['country']) ?></div>
                            </div>
                            <span class="deal-card__discount" style="margin-left:auto"><?= (int)$deal['discount'] ?>% OFF</span>
                        </div>
                        <p class="deal-card__title"><?= e($deal['title']) ?></p>
                        <div class="deal-card__pricing">
                            <span class="old"><?= format_price((float)$deal['original_price']) ?></span>
                            <span class="new"><?= format_price((float)$deal['deal_price']) ?></span>
                            <span class="per">/mo</span>
                        </div>
                        <div class="coupon-row">
                            <code><?= e($deal['coupon']) ?></code>
                            <button type="button" class="copy-btn" data-copy="<?= e($deal['coupon']) ?>">
                                <svg viewBox="0 0 24 24"><rect x="9" y="9" width="12" height="12" rx="2"/><path d="M5 15V5a2 2 0 0 1 2-2h10"/></svg>
                                Copy
                            </button>
                        </div>
                        <div class="countdown" data-expires="<?= e($deal['expires']) ?>">
                            <div class="countdown__unit"><span class="countdown__num" data-unit="d">00</span><span class="countdown__label">Days</span></div>
                            <div class="countdown__unit"><span class="countdown__num" data-unit="h">00</span><span class="countdown__label">Hrs</span></div>
                            <div class="countdown__unit"><span class="countdown__num" data-unit="m">00</span><span class="countdown__label">Min</span></div>
                            <div class="countdown__unit"><span class="countdown__num" data-unit="s">00</span><span class="countdown__label">Sec</span></div>
                        </div>
                        <a href="<?= provider_url($p) ?>" class="btn btn--primary btn--block btn--sm">Get This Deal</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section" id="categories">
    <div class="container">
        <div class="section-head reveal">
            <div>
                <span class="section-head__eyebrow">Browse by need</span>
                <h2>Find hosting by category</h2>
            </div>
        </div>
        <div class="category-grid">
            <?php foreach ($categories as $cat):
                $count = count(array_filter($providers, fn($p) => in_array($cat, $p['categories'], true))); ?>
                <a class="category-card reveal" href="<?= url('providers', ['category' => $cat]) ?>">
                    <span class="category-card__icon"><?= $categoryIcons[$cat] ?? '🌐' ?></span>
                    <span class="category-card__name"><?= e($cat) ?> Hosting</span>
                    <span class="category-card__count"><?= $count ?> providers</span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section" id="featured">
    <div class="container">
        <div class="section-head reveal">
            <div>
                <span class="section-head__eyebrow">Top rated</span>
                <h2>Featured hosting providers</h2>
                <p>The highest-rated hosts in our directory, based on performance, support and value.</p>
            </div>
            <a href="<?= url('providers') ?>" class="section-head__link">Browse all providers
                <svg viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
        </div>

        <div class="provider-grid">
            <?php foreach ($featured as $i => $p): ?>
                <a href="<?= provider_url($p) ?>" class="provider-card reveal" style="transition-delay: <?= min($i * 50, 300) ?>ms">
                    <div class="provider-card__top">
                        <div class="provider-card__id">
                            <?= provider_badge($p, 'md') ?>
                            <div>
                                <div class="provider-card__name"><?= e($p['name']) ?></div>
                                <div class="provider-card__country"><?= $p['flag'] ?> <?= e($p['country']) ?></div>
                            </div>
                        </div>
                        <span class="rank-badge">#<?= $i + 1 ?></span>
                    </div>
                    <p class="provider-card__tagline"><?= e($p['tagline']) ?></p>
                    <div class="provider-card__tags">
                        <?php foreach (array_slice($p['categories'], 0, 3) as $cat): ?>
                            <span class="tag"><?= e($cat) ?></span>
                        <?php endforeach; ?>
                    </div>
                    <div class="provider-card__meta">
                        <div><?= star_rating_html((float)$p['rating']) ?><span class="rating-num"><?= number_format((float)$p['rating'], 1) ?></span></div>
                        <div class="price-tag">
                            <div class="price-tag__amount"><?= format_price((float)$p['price']) ?></div>
                            <div class="price-tag__period">per month</div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section section--tight">
    <div class="container">
        <div class="trust-band reveal">
            <?php foreach (array_slice($countries, 0, 18) as $flag): ?>
                <span title="Provider location"><?= $flag ?></span>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="cta-band reveal">
            <h2>Not sure which host is right for you?</h2>
            <p>Compare every provider side-by-side with our filterable directory — by category, country, rating and price.</p>
            <a href="<?= url('providers') ?>" class="btn btn--primary">Explore All Providers</a>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>

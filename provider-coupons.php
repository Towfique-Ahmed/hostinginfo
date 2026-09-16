<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

$slug = trim((string)($_GET['slug'] ?? ''));
$provider = $slug !== '' ? get_provider_by_slug($slug) : null;

if (!$provider) {
    render_not_found('Provider Not Found', "We couldn't find a hosting provider with that identifier. Browse the full HostingInfo directory instead.");
}

$active_nav = 'providers';

$providerDeals = array_values(array_filter(get_deals_with_providers(), fn($d) => $d['provider_slug'] === $provider['slug']));

$year = date('Y');
if ($providerDeals) {
    $best = max(array_column($providerDeals, 'discount'));
    $page_title = $provider['name'] . ' Coupon Codes (' . $year . ') — Up to ' . $best . '% Off | HostingInfo';
    $page_description = count($providerDeals) . ' verified ' . $provider['name'] . ' coupon code' . (count($providerDeals) === 1 ? '' : 's') . ', up to ' . $best . '% off, checked against the current plan pricing on our ' . $provider['name'] . ' profile.';
} else {
    $page_title = $provider['name'] . ' Coupon Codes (' . $year . ') | HostingInfo';
    $page_description = "We don't currently have an active " . $provider['name'] . ' coupon code. See every live deal we track, or read the full ' . $provider['name'] . ' review.';
}

$_base = base_url();
$json_ld = json_encode([
    '@context'        => 'https://schema.org',
    '@type'           => 'BreadcrumbList',
    'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',      'item' => $_base . '/'],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'Directory', 'item' => $_base . '/providers'],
        ['@type' => 'ListItem', 'position' => 3, 'name' => $provider['name'], 'item' => $_base . provider_url($provider)],
        ['@type' => 'ListItem', 'position' => 4, 'name' => 'Coupons'],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

require __DIR__ . '/includes/header.php';
?>

<div class="container">

    <section class="page-head">
        <nav class="breadcrumb" aria-label="Breadcrumb">
            <a href="<?= url('') ?>">Home</a> <span>/</span>
            <a href="<?= url('providers') ?>">Directory</a> <span>/</span>
            <a href="<?= provider_url($provider) ?>"><?= e($provider['name']) ?></a> <span>/</span>
            <span>Coupons</span>
        </nav>

        <div class="provider-head__row" style="align-items:center">
            <?= provider_badge($provider, 'lg') ?>
            <div class="provider-head__text">
                <h1><?= e($provider['name']) ?> coupon codes</h1>
                <p class="provider-head__line"><?= rating_meter((float)$provider['rating']) ?></p>
            </div>
        </div>
    </section>

    <?php if ($providerDeals): ?>
    <section class="section">
        <div class="deal-list">
            <?php foreach ($providerDeals as $i => $deal): $p = $deal['provider']; ?>
                <article class="deal" id="deal-<?= (int)$deal['id'] ?>">
                    <span class="deal__rank num"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                    <div class="deal__id">
                        <?= provider_badge($p, 'sm') ?>
                        <div>
                            <h3 class="deal__title"><?= e($deal['title']) ?></h3>
                            <div class="deal__provider">Verified against the current <a href="<?= provider_url($p) ?>#plans">plan pricing</a></div>
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
        <p class="deal-disclaimer" style="margin-top:16px">Pricing moves on the provider's own site; confirm the total before checkout. Codes are pulled from our <a href="<?= url('deals') ?>">full deals tracker</a>.</p>
    </section>
    <?php else: ?>
    <section class="section section--tight">
        <div class="empty-state">
            <h3>No active <?= e($provider['name']) ?> coupon right now</h3>
            <p>We don't have a verified code for <?= e($provider['name']) ?> at the moment. Check the <a href="<?= url('deals') ?>">full deals tracker</a> for what's currently live, or read the <a href="<?= provider_url($provider) ?>">full <?= e($provider['name']) ?> review</a> for standard pricing.</p>
        </div>
    </section>
    <?php endif; ?>

    <section class="section section--tight">
        <div class="section-head">
            <div class="section-head__title">
                <span class="kicker kicker--signal">Next</span>
                <h2>More on <?= e($provider['name']) ?></h2>
            </div>
        </div>
        <div class="provider-head__actions">
            <a href="<?= provider_url($provider) ?>" class="btn btn--primary">Read the full review</a>
            <a href="<?= url('deals') ?>" class="btn">Browse all deals</a>
        </div>
    </section>

</div>

<?php require __DIR__ . '/includes/footer.php'; ?>

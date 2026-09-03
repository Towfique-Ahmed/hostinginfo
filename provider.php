<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

$slug = trim((string)($_GET['slug'] ?? ''));
$provider = $slug !== '' ? get_provider_by_slug($slug) : null;

if (!$provider) {
    render_not_found('Provider Not Found', "We couldn't find a hosting provider with that identifier. Browse the full HostingInfo directory instead.");
}

$page_title = $provider['name'] . ' Review (' . date('Y') . ') — Plans, Pricing & Deals | HostingInfo';
$page_description = $provider['name'] . ': ' . $provider['tagline'] . ' Rated ' . number_format((float)$provider['rating'], 1) . '/5 from ' . number_format((int)$provider['reviews']) . '+ reviews, plans from ' . format_price((float)$provider['price']) . '/mo. Compare features, pricing and deals.';
$active_nav = 'providers';

$deals = get_deals_with_providers();
$providerDeal = null;
foreach ($deals as $d) {
    if ($d['provider_slug'] === $provider['slug']) {
        $providerDeal = $d;
        break;
    }
}

$related = array_filter(get_providers(), function ($p) use ($provider) {
    if ($p['slug'] === $provider['slug']) {
        return false;
    }
    return count(array_intersect($p['categories'], $provider['categories'])) > 0;
});
$related = array_slice(array_values($related), 0, 4);

$cheapestPlan = $provider['plans'] ? min(array_column($provider['plans'], 'price')) : (float) $provider['price'];

$_base = base_url();
$_ld = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type'           => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',      'item' => $_base . '/'],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Directory', 'item' => $_base . '/providers'],
                ['@type' => 'ListItem', 'position' => 3, 'name' => $provider['name']],
            ],
        ],
    ],
];
if (!empty($provider['faqs'])) {
    $faqEntities = [];
    foreach ($provider['faqs'] as $faq) {
        $faqEntities[] = [
            '@type'          => 'Question',
            'name'           => $faq['q'],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['a']],
        ];
    }
    $_ld['@graph'][] = ['@type' => 'FAQPage', 'mainEntity' => $faqEntities];
}
$json_ld = json_encode($_ld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

require __DIR__ . '/includes/header.php';
?>

<div class="container">

    <section class="provider-head">
        <nav class="breadcrumb" aria-label="Breadcrumb">
            <a href="<?= url('') ?>">Home</a> <span>/</span>
            <a href="<?= url('providers') ?>">Directory</a> <span>/</span>
            <span><?= e($provider['name']) ?></span>
        </nav>

        <div class="provider-head__row">
            <?= provider_badge($provider, 'lg') ?>
            <div class="provider-head__text">
                <h1><?= e($provider['name']) ?></h1>
                <p class="provider-head__line"><?= e($provider['tagline']) ?></p>

                <div class="provider-head__meta">
                    <?= rating_meter((float)$provider['rating']) ?>
                    <span class="num" style="color:var(--fg-faint)"><?= number_format((int)$provider['reviews']) ?> reviews</span>
                    <span class="sep">|</span>
                    <span><?= e($provider['country']) ?></span>
                    <span class="sep">|</span>
                    <span>Est. <span class="num"><?= (int)$provider['founded'] ?></span></span>
                    <span class="sep">|</span>
                    <span><span class="num"><?= number_format((float)$provider['uptime'], 2) ?>%</span> uptime</span>
                    <span class="sep">|</span>
                    <span><?= e(implode(', ', $provider['categories'])) ?></span>
                </div>

                <div class="provider-head__actions">
                    <a href="#plans" class="btn btn--primary">Plans from <?= format_price((float)$cheapestPlan) ?>/mo</a>
                    <?php if ($providerDeal): ?>
                        <a href="#deal" class="btn"><?= (int)$providerDeal['discount'] ?>% off with a code</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <div class="detail-layout">
        <div class="detail-main">

            <section class="detail-block">
                <h2>The verdict</h2>
                <p><?= e($provider['description']) ?></p>
            </section>

            <section class="detail-block">
                <h2>What you get</h2>
                <ul class="feature-list">
                    <?php foreach ($provider['features'] as $feature): ?>
                        <li><?= e($feature) ?></li>
                    <?php endforeach; ?>
                </ul>
            </section>

            <section class="detail-block" id="plans">
                <h2>Plans &amp; pricing</h2>
                <div class="plan-grid">
                    <?php foreach ($provider['plans'] as $plan): ?>
                        <div class="plan">
                            <div class="plan__name"><?= e($plan['name']) ?></div>
                            <div class="plan__price"><?= format_price((float)$plan['price']) ?><span>/<?= e($plan['period']) ?></span></div>
                            <ul>
                                <?php foreach ($plan['features'] as $f): ?>
                                    <li><?= e($f) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="detail-block">
                <h2>The trade-off</h2>
                <div class="pc-grid">
                    <div class="pc pc--pro">
                        <h3>In its favour</h3>
                        <ul>
                            <?php foreach ($provider['pros'] as $pro): ?>
                                <li><?= e($pro) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="pc pc--con">
                        <h3>Worth knowing</h3>
                        <ul>
                            <?php foreach ($provider['cons'] as $con): ?>
                                <li><?= e($con) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </section>

            <?php if (!empty($provider['faqs'])): ?>
            <section class="detail-block">
                <h2>Common questions</h2>
                <div class="faq">
                    <?php foreach ($provider['faqs'] as $faq): ?>
                        <details>
                            <summary><?= e($faq['q']) ?></summary>
                            <p><?= e($faq['a']) ?></p>
                        </details>
                    <?php endforeach; ?>
                </div>
            </section>
            <?php endif; ?>

        </div>

        <aside class="rail">
            <div class="rail__card">
                <h3>At a glance</h3>
                <div class="spec-block">
                    <div class="spec-row">
                        <span class="spec-row__label">Rating</span>
                        <span class="spec-row__value"><?= number_format((float)$provider['rating'], 1) ?><small>/5</small></span>
                    </div>
                    <div class="spec-row">
                        <span class="spec-row__label">Uptime</span>
                        <span class="spec-row__value"><?= number_format((float)$provider['uptime'], 2) ?><small>%</small></span>
                    </div>
                    <div class="spec-row">
                        <span class="spec-row__label">From</span>
                        <span class="spec-row__value"><?= format_price((float)$provider['price']) ?><small>/mo</small></span>
                    </div>
                    <div class="spec-row">
                        <span class="spec-row__label">Founded</span>
                        <span class="spec-row__value"><?= (int)$provider['founded'] ?></span>
                    </div>
                    <div class="spec-row">
                        <span class="spec-row__label">Base</span>
                        <span class="spec-row__value" style="font-size:0.85rem"><?= e($provider['country']) ?></span>
                    </div>
                </div>
            </div>

            <?php if ($providerDeal): ?>
            <div class="rail__card rail__card--deal" id="deal">
                <h3><?= (int)$providerDeal['discount'] ?>% off — active code</h3>
                <p class="rail__deal-title"><?= e($providerDeal['title']) ?></p>
                <div class="coupon" style="width:100%; justify-content:space-between">
                    <code><?= e($providerDeal['coupon']) ?></code>
                    <button type="button" class="copy-btn" data-copy="<?= e($providerDeal['coupon']) ?>">
                        <svg viewBox="0 0 24 24"><rect x="9" y="9" width="12" height="12" rx="2"/><path d="M5 15V5a2 2 0 0 1 2-2h10"/></svg>
                        Copy
                    </button>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($related): ?>
            <div class="rail__card">
                <h3>Similar hosts</h3>
                <div class="related">
                    <?php foreach ($related as $r): ?>
                        <a href="<?= provider_url($r) ?>">
                            <?= provider_badge($r, 'sm') ?>
                            <div>
                                <div class="related__name"><?= e($r['name']) ?></div>
                                <div class="related__meta"><?= number_format((float)$r['rating'], 1) ?> · <?= format_price((float)$r['price']) ?>/mo</div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </aside>
    </div>

</div>

<?php require __DIR__ . '/includes/footer.php'; ?>

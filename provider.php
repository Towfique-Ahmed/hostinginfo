<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

$slug = trim((string)($_GET['slug'] ?? ''));
$provider = $slug !== '' ? get_provider_by_slug($slug) : null;

if (!$provider) {
    render_not_found('Provider Not Found', "We couldn't find a hosting provider with that identifier. Browse the full HostingInfo directory instead.");
}

$page_title = $provider['name'] . ' Review (' . date('Y') . ') — Plans, Pricing & Deals | HostingInfo';
$_guaranteeNote = (int)$provider['money_back'] > 0 ? ' ' . (int)$provider['money_back'] . '-day money-back guarantee.' : '';
$_dcNote = !empty($provider['data_centers']) ? ' Data centers: ' . implode(', ', array_slice($provider['data_centers'], 0, 3)) . '.' : '';
$page_description = $provider['name'] . ': ' . $provider['tagline'] . ' Rated ' . number_format((float)$provider['rating'], 1) . '/5 from ' . number_format((int)$provider['reviews']) . '+ reviews, plans from ' . format_price((float)$provider['price']) . '/mo.' . $_guaranteeNote . $_dcNote . ' Compare features, pricing and deals.';
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
$_providerUrl = provider_url($provider);
$_ld['@graph'][] = [
    '@type'       => 'Product',
    'name'        => $provider['name'] . ' Web Hosting',
    'description' => $provider['description'],
    'url'         => $_base . '/' . ltrim($_providerUrl, '/'),
    'brand'       => ['@type' => 'Brand', 'name' => $provider['name']],
    'aggregateRating' => [
        '@type'       => 'AggregateRating',
        'ratingValue' => number_format((float)$provider['rating'], 1),
        'reviewCount' => (int)$provider['reviews'],
        'bestRating'  => '5',
        'worstRating' => '1',
    ],
    'offers' => [
        '@type'         => 'Offer',
        'price'         => number_format((float)$cheapestPlan, 2),
        'priceCurrency' => 'USD',
        'availability'  => 'https://schema.org/InStock',
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

    <?php if (!empty($provider['scores'])): ?>
    <div class="score-strip">
        <?php
        $scoreLabels = ['speed' => 'Speed', 'support' => 'Support', 'value' => 'Value', 'features' => 'Features', 'reliability' => 'Reliability'];
        foreach ($scoreLabels as $key => $label):
            if (!isset($provider['scores'][$key])) continue;
            $val = (float)$provider['scores'][$key];
            $pct = round($val / 5 * 100);
        ?>
        <div class="score-item">
            <div class="score-item__label"><?= e($label) ?></div>
            <div class="score-bar" role="meter" aria-valuenow="<?= $val ?>" aria-valuemin="0" aria-valuemax="5" aria-label="<?= e($label) ?> score <?= $val ?> of 5">
                <div class="score-bar__fill" style="width:<?= $pct ?>%"></div>
            </div>
            <div class="score-item__value"><?= number_format($val, 1) ?></div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <div class="detail-layout">
        <div class="detail-main">

            <section class="detail-block">
                <h2>The verdict</h2>
                <p><?= e($provider['description']) ?></p>
                <?php if (!empty($provider['best_for'])): ?>
                <div class="best-for">
                    <span class="best-for__label">Best for:</span>
                    <?php foreach ($provider['best_for'] as $tag): ?>
                        <span class="best-for__chip"><?= e($tag) ?></span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
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

            <?php if (!empty($provider['support_channels']) || !empty($provider['data_centers'])): ?>
            <section class="detail-block">
                <h2>Infrastructure &amp; support</h2>
                <div class="infra-grid">
                    <?php if (!empty($provider['support_channels'])): ?>
                    <div class="infra-card">
                        <h3 class="infra-card__title">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            Support channels
                        </h3>
                        <ul class="infra-list">
                            <?php foreach ($provider['support_channels'] as $ch): ?>
                                <li><?= e($ch) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($provider['data_centers'])): ?>
                    <div class="infra-card">
                        <h3 class="infra-card__title">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="2" y="3" width="20" height="5" rx="1" stroke-linecap="round" stroke-linejoin="round"/><rect x="2" y="10" width="20" height="5" rx="1" stroke-linecap="round" stroke-linejoin="round"/><rect x="2" y="17" width="20" height="5" rx="1" stroke-linecap="round" stroke-linejoin="round"/><circle cx="6" cy="5.5" r="1" fill="currentColor" stroke="none"/><circle cx="6" cy="12.5" r="1" fill="currentColor" stroke="none"/><circle cx="6" cy="19.5" r="1" fill="currentColor" stroke="none"/></svg>
                            Data centers
                        </h3>
                        <ul class="infra-list">
                            <?php foreach ($provider['data_centers'] as $dc): ?>
                                <li><?= e($dc) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>
            </section>
            <?php endif; ?>

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
                    <?php if ((int)$provider['money_back'] > 0): ?>
                    <div class="spec-row">
                        <span class="spec-row__label">Guarantee</span>
                        <span class="spec-row__value"><?= (int)$provider['money_back'] ?><small>-day</small></span>
                    </div>
                    <?php endif; ?>
                </div>
                <?php if ((int)$provider['money_back'] > 0): ?>
                <div class="guarantee-badge">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <?= (int)$provider['money_back'] ?>-day money-back guarantee
                </div>
                <?php else: ?>
                <div class="guarantee-badge guarantee-badge--none">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12" stroke-linecap="round"/><line x1="12" y1="16" x2="12.01" y2="16" stroke-linecap="round"/></svg>
                    No standard refund policy
                </div>
                <?php endif; ?>
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

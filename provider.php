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

// The in-page contents list. Built from the sections that actually have data,
// so a thin provider record does not advertise empty anchors.
$sections = ['verdict' => 'Verdict'];
if ($provider['overview'] !== '')          { $sections['overview']       = 'Full picture'; }
if (!empty($provider['features']))         { $sections['features']       = 'What you get'; }
if (!empty($provider['hosting_types']))    { $sections['products']       = 'Hosting types'; }
if (!empty($provider['plans']))            { $sections['plans']          = 'Plans & pricing'; }
if (!empty($provider['specs']))            { $sections['specs']          = 'Specification'; }
if ($provider['performance'] !== '')       { $sections['performance']    = 'Performance'; }
if (!empty($provider['support_channels']) || !empty($provider['data_centers'])) {
    $sections['infrastructure'] = 'Infrastructure';
}
if (!empty($provider['security']))         { $sections['security']       = 'Security'; }
if ($provider['migration'] !== '')         { $sections['migration']      = 'Migration'; }
$sections['tradeoff'] = 'Trade-off';
if (!empty($provider['company']) || !empty($provider['timeline'])) { $sections['company'] = 'The company'; }
if (!empty($provider['faqs']))             { $sections['faq']            = 'FAQ'; }
if ($provider['verdict'] !== '')           { $sections['bottom-line']    = 'Bottom line'; }

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

            <nav class="toc" aria-label="On this page">
                <span class="toc__label">On this page</span>
                <?php foreach ($sections as $id => $label): ?>
                    <a href="#<?= e($id) ?>"><?= e($label) ?></a>
                <?php endforeach; ?>
            </nav>

            <section class="detail-block" id="verdict">
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

            <?php if ($provider['overview'] !== ''): ?>
            <section class="detail-block" id="overview">
                <h2>The full picture</h2>
                <div class="longform"><?= paragraphs((string)$provider['overview']) ?></div>
            </section>
            <?php endif; ?>

            <section class="detail-block" id="features">
                <h2>What you get</h2>
                <ul class="feature-list">
                    <?php foreach ($provider['features'] as $feature): ?>
                        <li><?= e($feature) ?></li>
                    <?php endforeach; ?>
                </ul>
            </section>

            <?php if (!empty($provider['hosting_types'])): ?>
            <section class="detail-block" id="products">
                <h2>Every hosting type it sells</h2>
                <div class="table-scroll">
                    <table class="data-table">
                        <thead>
                            <tr><th scope="col">Product</th><th scope="col">From</th><th scope="col">What it is</th></tr>
                        </thead>
                        <tbody>
                            <?php foreach ($provider['hosting_types'] as $type): ?>
                            <tr>
                                <th scope="row"><?= e($type['name']) ?></th>
                                <td class="num"><?= e($type['from']) ?></td>
                                <td><?= e($type['note']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>
            <?php endif; ?>

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
                <?php if (!empty($provider['pricing_notes'])): ?>
                <h3 class="detail-sub">What the price actually costs you</h3>
                <ul class="note-list">
                    <?php foreach ($provider['pricing_notes'] as $note): ?>
                        <li><?= e($note) ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </section>

            <?php if (!empty($provider['specs'])): ?>
            <section class="detail-block" id="specs">
                <h2>Technical specification</h2>
                <div class="table-scroll">
                    <table class="data-table data-table--specs">
                        <tbody>
                            <?php foreach ($provider['specs'] as $label => $value): ?>
                            <tr>
                                <th scope="row"><?= e((string)$label) ?></th>
                                <td><?= e((string)$value) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>
            <?php endif; ?>

            <?php if ($provider['performance'] !== ''): ?>
            <section class="detail-block" id="performance">
                <h2>Performance in practice</h2>
                <div class="longform"><?= paragraphs((string)$provider['performance']) ?></div>
            </section>
            <?php endif; ?>

            <?php if (!empty($provider['support_channels']) || !empty($provider['data_centers'])): ?>
            <section class="detail-block" id="infrastructure">
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

            <?php if (!empty($provider['security'])): ?>
            <section class="detail-block" id="security">
                <h2>Security &amp; compliance</h2>
                <ul class="check-list">
                    <?php foreach ($provider['security'] as $item): ?>
                        <li><?= e($item) ?></li>
                    <?php endforeach; ?>
                </ul>
            </section>
            <?php endif; ?>

            <?php if ($provider['migration'] !== ''): ?>
            <section class="detail-block" id="migration">
                <h2>Moving a site in</h2>
                <div class="longform"><?= paragraphs((string)$provider['migration']) ?></div>
            </section>
            <?php endif; ?>

            <section class="detail-block" id="tradeoff">
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
                <?php if (!empty($provider['not_for'])): ?>
                <h3 class="detail-sub">Who should look elsewhere</h3>
                <ul class="cross-list">
                    <?php foreach ($provider['not_for'] as $item): ?>
                        <li><?= e($item) ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </section>

            <?php if (!empty($provider['company']) || !empty($provider['timeline'])): ?>
            <section class="detail-block" id="company">
                <h2>The company behind it</h2>
                <?php if (!empty($provider['company'])): ?>
                <div class="table-scroll">
                    <table class="data-table data-table--specs">
                        <tbody>
                            <?php foreach ($provider['company'] as $label => $value): ?>
                            <tr>
                                <th scope="row"><?= e((string)$label) ?></th>
                                <td><?= e((string)$value) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>
                <?php if (!empty($provider['timeline'])): ?>
                <h3 class="detail-sub">How it got here</h3>
                <ol class="timeline">
                    <?php foreach ($provider['timeline'] as $entry): ?>
                        <li>
                            <span class="timeline__year num"><?= (int)$entry['year'] ?></span>
                            <span class="timeline__event"><?= e($entry['event']) ?></span>
                        </li>
                    <?php endforeach; ?>
                </ol>
                <?php endif; ?>
            </section>
            <?php endif; ?>

            <?php if (!empty($provider['faqs'])): ?>
            <section class="detail-block" id="faq">
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

            <?php if ($provider['verdict'] !== ''): ?>
            <section class="detail-block" id="bottom-line">
                <h2>The bottom line</h2>
                <div class="bottom-line"><?= paragraphs((string)$provider['verdict']) ?></div>
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
                    <div class="spec-row">
                        <span class="spec-row__label">Type</span>
                        <span class="spec-row__value" style="font-size:0.85rem"><?= e(implode(', ', $provider['categories'])) ?></span>
                    </div>
                    <?php if (!empty($provider['data_centers'])): ?>
                    <div class="spec-row">
                        <span class="spec-row__label">Locations</span>
                        <span class="spec-row__value"><?= count($provider['data_centers']) ?></span>
                    </div>
                    <?php endif; ?>
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
                <a href="<?= e(provider_coupons_url($provider)) ?>" class="section-head__link" style="margin-top:10px">All <?= e($provider['name']) ?> coupons
                    <svg viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
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

            <div class="rail__card">
                <h3>Compare with a similar host</h3>
                <div class="related">
                    <?php foreach (array_slice($related, 0, 4) as $r): ?>
                        <a href="<?= e(compare_url($provider, $r)) ?>">
                            <?= provider_badge($r, 'sm') ?>
                            <div>
                                <div class="related__name">vs <?= e($r['name']) ?></div>
                                <div class="related__meta">Side-by-side comparison</div>
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

<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

$slug = trim((string)($_GET['slug'] ?? ''));
$provider = $slug !== '' ? get_provider_by_slug($slug) : null;

if (!$provider) {
    http_response_code(404);
    $page_title = 'Provider Not Found | HostingInfo';
    $page_description = 'The hosting provider you are looking for could not be found. Browse the full HostingInfo directory instead.';
    $robots = 'noindex, follow';
    $active_nav = 'providers';
    require __DIR__ . '/includes/header.php';
    ?>
    <section class="section" style="text-align:center; padding: 120px 0;">
        <div class="container">
            <h1>404 — Provider Not Found</h1>
            <p>We couldn't find a hosting provider with that identifier.</p>
            <a href="<?= url('providers') ?>" class="btn btn--primary">Browse All Providers</a>
        </div>
    </section>
    <?php
    require __DIR__ . '/includes/footer.php';
    exit;
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

require __DIR__ . '/includes/header.php';
?>

<section class="provider-hero">
    <div class="container">
        <div class="breadcrumb">
            <a href="<?= url('') ?>">Home</a> <span>/</span>
            <a href="<?= url('providers') ?>">Providers</a> <span>/</span>
            <span><?= e($provider['name']) ?></span>
        </div>

        <div class="provider-hero__grid">
            <?= provider_badge($provider, 'lg') ?>
            <div class="provider-hero__info">
                <h1><?= e($provider['name']) ?></h1>
                <p><?= e($provider['tagline']) ?></p>
                <div class="provider-hero__badges">
                    <span class="badge-pill"><?= $provider['flag'] ?> <?= e($provider['country']) ?></span>
                    <span class="badge-pill">📅 Founded <?= (int)$provider['founded'] ?></span>
                    <span class="badge-pill">⏱ <?= number_format((float)$provider['uptime'], 2) ?>% Uptime</span>
                    <?php foreach ($provider['categories'] as $cat): ?>
                        <span class="badge-pill"><?= e($cat) ?></span>
                    <?php endforeach; ?>
                </div>
                <div><?= star_rating_html((float)$provider['rating']) ?>
                    <span class="rating-num"><?= number_format((float)$provider['rating'], 1) ?>/5</span>
                    <span style="color:var(--text-dimmer); font-size:0.85rem;"> · <?= number_format((int)$provider['reviews']) ?> reviews</span>
                </div>
                <div class="provider-hero__actions">
                    <a href="#plans" class="btn btn--primary">View Plans from <?= format_price((float)$provider['price']) ?>/mo</a>
                    <a href="<?= url('providers') ?>" class="btn btn--ghost">← Back to Directory</a>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container">
<div class="detail-layout">
    <div class="detail-main">

        <div class="detail-block">
            <h2>About <?= e($provider['name']) ?></h2>
            <p><?= e($provider['description']) ?></p>
        </div>

        <div class="detail-block">
            <h2>Key Features</h2>
            <ul class="feature-list">
                <?php foreach ($provider['features'] as $feature): ?>
                    <li><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg> <?= e($feature) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="detail-block" id="plans">
            <h2>Plans &amp; Pricing</h2>
            <div class="plans-grid">
                <?php foreach ($provider['plans'] as $plan): ?>
                    <div class="plan-card">
                        <div class="plan-card__name"><?= e($plan['name']) ?></div>
                        <div class="plan-card__price"><?= format_price((float)$plan['price']) ?><span>/<?= e($plan['period']) ?></span></div>
                        <ul>
                            <?php foreach ($plan['features'] as $f): ?>
                                <li><?= e($f) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <a href="#" class="btn btn--ghost btn--block btn--sm" onclick="return false;">Select Plan</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="detail-block">
            <h2>Pros &amp; Cons</h2>
            <div class="pros-cons-grid">
                <div class="pc-card pc-card--pros">
                    <h3>👍 What we like</h3>
                    <ul>
                        <?php foreach ($provider['pros'] as $pro): ?>
                            <li>✅ <?= e($pro) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="pc-card pc-card--cons">
                    <h3>👎 Worth noting</h3>
                    <ul>
                        <?php foreach ($provider['cons'] as $con): ?>
                            <li>⚠️ <?= e($con) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

        <?php if (!empty($provider['faqs'])): ?>
        <div class="detail-block">
            <h2>Frequently Asked Questions</h2>
            <div class="faq-list">
                <?php foreach ($provider['faqs'] as $faq): ?>
                    <details class="faq-item">
                        <summary><?= e($faq['q']) ?></summary>
                        <p><?= e($faq['a']) ?></p>
                    </details>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

    </div>

    <aside class="detail-sidebar">
        <div class="sidebar-card">
            <h3>Quick Facts</h3>
            <div class="fact-row"><span>Headquarters</span><span><?= $provider['flag'] ?> <?= e($provider['country']) ?></span></div>
            <div class="fact-row"><span>Founded</span><span><?= (int)$provider['founded'] ?></span></div>
            <div class="fact-row"><span>Uptime</span><span><?= number_format((float)$provider['uptime'], 2) ?>%</span></div>
            <div class="fact-row"><span>Starting Price</span><span><?= format_price((float)$provider['price']) ?>/mo</span></div>
            <div class="fact-row"><span>Rating</span><span><?= number_format((float)$provider['rating'], 1) ?> / 5</span></div>
            <a href="#plans" class="btn btn--primary btn--block" style="margin-top:16px;">View Plans</a>
        </div>

        <?php if ($providerDeal): ?>
        <div class="sidebar-card">
            <h3>🔥 Active Deal</h3>
            <p style="font-size:0.88rem;"><?= e($providerDeal['title']) ?></p>
            <div class="coupon-row">
                <code><?= e($providerDeal['coupon']) ?></code>
                <button type="button" class="copy-btn" data-copy="<?= e($providerDeal['coupon']) ?>">
                    <svg viewBox="0 0 24 24"><rect x="9" y="9" width="12" height="12" rx="2"/><path d="M5 15V5a2 2 0 0 1 2-2h10"/></svg>
                    Copy
                </button>
            </div>
            <a href="<?= url('deals') ?>" class="btn btn--ghost btn--block btn--sm" style="margin-top:12px;">See All Deals</a>
        </div>
        <?php endif; ?>

        <?php if ($related): ?>
        <div class="sidebar-card">
            <h3>Similar Providers</h3>
            <div class="related-list">
                <?php foreach ($related as $r): ?>
                    <a href="<?= provider_url($r) ?>" class="related-item">
                        <?= provider_badge($r, 'sm') ?>
                        <div>
                            <div class="related-item__name"><?= e($r['name']) ?></div>
                            <div class="related-item__meta"><?= $r['flag'] ?> <?= e($r['country']) ?> · ⭐ <?= number_format((float)$r['rating'], 1) ?></div>
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

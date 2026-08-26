<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

$active_nav = 'deals';

$deals = get_deals_with_providers();
$maxDiscount = 0;
$avgDiscount = 0;
if ($deals) {
    $maxDiscount = max(array_column($deals, 'discount'));
    $avgDiscount = (int) round(array_sum(array_column($deals, 'discount')) / count($deals));
}

$page_title = 'Hosting Deals & Coupon Codes (Up to ' . $maxDiscount . '% Off) | HostingInfo';
$page_description = 'Live hosting discounts and coupon codes from ' . count($deals) . '+ providers, ranked by savings — averaging ' . $avgDiscount . '% off. Updated regularly, verified against each provider.';

require __DIR__ . '/includes/header.php';
?>

<section class="deals-hero">
    <div class="container">
        <span class="hero__eyebrow"><span class="dot"></span> <?= count($deals) ?> active deals tracked</span>
        <h1>Grab the best <span class="gradient-text">hosting deals</span> before they expire.</h1>
        <p class="lead">Every discount code below is tied to a live provider profile — click through to compare plans before you buy.</p>
    </div>
</section>

<section class="section section--tight">
    <div class="container">
        <div class="deal-highlight-band reveal">
            <div class="stat-pill">
                <div class="stat-pill__num"><?= $maxDiscount ?>%</div>
                <div class="stat-pill__label">Biggest Discount</div>
            </div>
            <div class="stat-pill">
                <div class="stat-pill__num"><?= $avgDiscount ?>%</div>
                <div class="stat-pill__label">Average Savings</div>
            </div>
            <div class="stat-pill">
                <div class="stat-pill__num"><?= count($deals) ?></div>
                <div class="stat-pill__label">Coupon Codes</div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head reveal">
            <div>
                <span class="section-head__eyebrow">Sorted by savings</span>
                <h2>All hosting deals</h2>
            </div>
        </div>

        <div class="deals-strip">
            <?php foreach ($deals as $i => $deal): $p = $deal['provider']; ?>
                <div class="deal-card reveal" style="transition-delay: <?= min($i * 40, 300) ?>ms">
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
                        <a href="<?= provider_url($p) ?>" class="btn btn--primary btn--block btn--sm">Get This Deal</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>

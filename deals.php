<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

$active_nav = 'deals';

$deals = get_deals_with_providers();
$maxDiscount = 0;
$avgDiscount = 0;
$deepestSaving = 0;
if ($deals) {
    $maxDiscount = max(array_column($deals, 'discount'));
    $avgDiscount = (int) round(array_sum(array_column($deals, 'discount')) / count($deals));
    foreach ($deals as $d) {
        $deepestSaving = max($deepestSaving, (float)$d['original_price'] - (float)$d['deal_price']);
    }
}

$page_title = 'Hosting Deals & Coupon Codes (Up to ' . $maxDiscount . '% Off) | HostingInfo';
$page_description = 'Every hosting discount we track, ranked by savings — ' . count($deals) . ' coupon codes averaging ' . $avgDiscount . '% off, each tied to a full provider profile.';

require __DIR__ . '/includes/header.php';
?>

<div class="container">

    <section class="page-head">
        <span class="kicker">Coupons &amp; discounts</span>
        <h1>Deals, ranked by <em>what you save</em>.</h1>
        <p class="lede">Every code we track, deepest discount first. Each one links back to the provider's full profile so you can check what you are actually buying.</p>
    </section>

    <section class="section section--tight">
        <div class="spec-block" style="max-width:520px">
            <div class="spec-row">
                <span class="spec-row__label">Codes tracked</span>
                <span class="spec-row__value"><?= count($deals) ?></span>
            </div>
            <div class="spec-row">
                <span class="spec-row__label">Deepest discount</span>
                <span class="spec-row__value"><?= $maxDiscount ?><small>%</small></span>
            </div>
            <div class="spec-row">
                <span class="spec-row__label">Average discount</span>
                <span class="spec-row__value"><?= $avgDiscount ?><small>%</small></span>
            </div>
            <div class="spec-row">
                <span class="spec-row__label">Largest monthly saving</span>
                <span class="spec-row__value"><?= format_price($deepestSaving) ?><small>/mo</small></span>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="section-head">
            <div class="section-head__title">
                <span class="kicker kicker--signal">Sorted by savings</span>
                <h2>All hosting deals</h2>
            </div>
            <a href="<?= url('providers') ?>" class="section-head__link">Compare providers
                <svg viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>
        </div>

        <div class="deal-list">
            <?php foreach ($deals as $i => $deal): $p = $deal['provider']; ?>
                <article class="deal">
                    <span class="deal__rank num"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                    <div class="deal__id">
                        <?= provider_badge($p, 'sm') ?>
                        <div>
                            <h3 class="deal__title"><?= e($deal['title']) ?></h3>
                            <div class="deal__provider">
                                <a href="<?= provider_url($p) ?>"><?= e($p['name']) ?></a> · <?= e($p['country']) ?> · est. <?= (int)$p['founded'] ?>
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

</div>

<?php require __DIR__ . '/includes/footer.php'; ?>

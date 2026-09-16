<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

$active_nav = 'compare';

/*
 * The picker form submits provider slugs as ?a=&b=; resolve and redirect to
 * the canonical /compare/{a}-vs-{b} path rather than rendering the pair here,
 * so every comparison lives at one indexable URL.
 */
$aSlug = trim((string)($_GET['a'] ?? ''));
$bSlug = trim((string)($_GET['b'] ?? ''));
if ($aSlug !== '' && $bSlug !== '' && $aSlug !== $bSlug) {
    $pa = get_provider_by_slug($aSlug);
    $pb = get_provider_by_slug($bSlug);
    if ($pa !== null && $pb !== null) {
        redirect_permanent(compare_url($pa, $pb));
    }
}

$providers = get_providers();
$sorted = $providers;
usort($sorted, fn($a, $b) => $b['rating'] <=> $a['rating']);
$byName = $providers;
usort($byName, fn($a, $b) => strcmp($a['name'], $b['name']));

/*
 * "Popular" pairs: every unique combination among the top-rated providers,
 * capped so the page stays a curated handful rather than every possible
 * pairing across the full directory.
 */
$topPool = array_slice($sorted, 0, 8);
$popularPairs = [];
foreach ($topPool as $i => $pa) {
    foreach ($topPool as $j => $pb) {
        if ($j <= $i) {
            continue;
        }
        $popularPairs[] = [$pa, $pb];
    }
}
usort($popularPairs, fn($x, $y) => ($y[0]['rating'] + $y[1]['rating']) <=> ($x[0]['rating'] + $x[1]['rating']));
$popularPairs = array_slice($popularPairs, 0, 12);

$page_title = 'Compare Web Hosting Providers Side by Side | HostingInfo';
$page_description = 'Pick any two of the ' . count($providers) . ' providers we track and see price, uptime, rating and features lined up in one table.';

require __DIR__ . '/includes/header.php';
?>

<div class="container">

    <section class="page-head">
        <span class="kicker">Tools</span>
        <h1>Put two hosts <em>side by side</em>.</h1>
        <p class="lede">Pick any two providers from the directory and we line up price, uptime, rating and the trade-offs in one table.</p>
    </section>

    <form class="toolbar" method="get" action="<?= url('compare') ?>">
        <div class="toolbar__filters" style="flex:1">
            <select name="a" class="select" aria-label="First provider" required>
                <option value="">First provider…</option>
                <?php foreach ($byName as $p): ?>
                    <option value="<?= e($p['slug']) ?>"><?= e($p['name']) ?></option>
                <?php endforeach; ?>
            </select>
            <select name="b" class="select" aria-label="Second provider" required>
                <option value="">Second provider…</option>
                <?php foreach ($byName as $p): ?>
                    <option value="<?= e($p['slug']) ?>"><?= e($p['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn--primary btn--sm">Compare</button>
    </form>

    <section class="section">
        <div class="section-head">
            <div class="section-head__title">
                <span class="kicker kicker--signal">Popular</span>
                <h2>Comparisons people run often</h2>
            </div>
        </div>

        <div class="pick-grid">
            <?php foreach ($popularPairs as [$pa, $pb]): ?>
                <a class="pick" href="<?= e(compare_url($pa, $pb)) ?>">
                    <div class="pick__top">
                        <?= provider_badge($pa, 'sm') ?>
                        <div class="pick__name" style="font-size:0.8rem">vs</div>
                        <?= provider_badge($pb, 'sm') ?>
                    </div>
                    <p class="pick__line"><?= e($pa['name']) ?> vs <?= e($pb['name']) ?></p>
                    <div class="pick__foot">
                        <span class="num" style="color:var(--fg-faint); font-size:0.8rem"><?= number_format((float)$pa['rating'], 1) ?> · <?= number_format((float)$pb['rating'], 1) ?></span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </section>

</div>

<?php require __DIR__ . '/includes/footer.php'; ?>

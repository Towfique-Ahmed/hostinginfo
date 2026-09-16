<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

$active_nav = 'compare';

$pairSlug = trim((string)($_GET['pair'] ?? ''));
$pair = $pairSlug !== '' ? resolve_compare_pair($pairSlug) : null;

if ($pair === null) {
    render_not_found(
        'Comparison Not Found',
        "We couldn't match that address to two providers we track. Start a new comparison instead."
    );
}

[$providerA, $providerB] = $pair;

/* Canonical order is alphabetical by slug, so "a-vs-b" and "b-vs-a" never both get indexed. */
if ($providerA['slug'] > $providerB['slug']) {
    redirect_permanent(compare_url($providerB, $providerA));
}

$cheaper = $providerA['price'] <= $providerB['price'] ? $providerA : $providerB;
$pricier = $cheaper === $providerA ? $providerB : $providerA;
$higherRated = $providerA['rating'] >= $providerB['rating'] ? $providerA : $providerB;
$betterUptime = $providerA['uptime'] >= $providerB['uptime'] ? $providerA : $providerB;
$older = $providerA['founded'] <= $providerB['founded'] ? $providerA : $providerB;

$year = date('Y');
$page_title = $providerA['name'] . ' vs ' . $providerB['name'] . ': Which Hosting Is Better in ' . $year . '? | HostingInfo';
$page_description = $providerA['name'] . ' vs ' . $providerB['name'] . ' compared on price, uptime and rating — ' . $cheaper['name'] . ' starts cheaper, ' . $higherRated['name'] . ' rates higher.';

$_base = base_url();
$json_ld = json_encode([
    '@context'        => 'https://schema.org',
    '@type'           => 'BreadcrumbList',
    'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',    'item' => $_base . '/'],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'Compare', 'item' => $_base . '/compare'],
        ['@type' => 'ListItem', 'position' => 3, 'name' => $providerA['name'] . ' vs ' . $providerB['name']],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

/* A handful of related pairings: other top providers against either side of this one. */
$others = array_filter(get_providers(), fn($p) => !in_array($p['slug'], [$providerA['slug'], $providerB['slug']], true));
$others = array_values($others);
usort($others, fn($x, $y) => $y['rating'] <=> $x['rating']);
$related = array_slice($others, 0, 4);

require __DIR__ . '/includes/header.php';

function vs_row(string $label, array $a, array $b, callable $format, ?callable $winner = null): void
{
    $winA = $winner ? $winner($a, $b) : null;
    ?>
    <tr>
        <th scope="row"><?= e($label) ?></th>
        <td class="<?= $winA === true ? 'cell-win' : '' ?>"><?= $format($a) ?></td>
        <td class="<?= $winA === false ? 'cell-win' : '' ?>"><?= $format($b) ?></td>
    </tr>
    <?php
}
?>

<div class="container">

    <section class="page-head">
        <nav class="breadcrumb" aria-label="Breadcrumb">
            <a href="<?= url('') ?>">Home</a> <span>/</span>
            <a href="<?= url('compare') ?>">Compare</a> <span>/</span>
            <span><?= e($providerA['name']) ?> vs <?= e($providerB['name']) ?></span>
        </nav>
        <h1><?= e($providerA['name']) ?> <em>vs</em> <?= e($providerB['name']) ?></h1>
        <p class="lede">Same fields, both providers, side by side — so the comparison is the table, not our opinion.</p>
    </section>

    <div class="vs-head">
        <a class="vs-side" href="<?= provider_url($providerA) ?>">
            <?= provider_badge($providerA, 'lg') ?>
            <div class="vs-side__name"><?= e($providerA['name']) ?></div>
            <?= rating_meter((float)$providerA['rating']) ?>
            <div class="vs-side__price"><?= format_price((float)$providerA['price']) ?><small>/mo</small></div>
        </a>
        <div class="vs-versus">VS</div>
        <a class="vs-side" href="<?= provider_url($providerB) ?>">
            <?= provider_badge($providerB, 'lg') ?>
            <div class="vs-side__name"><?= e($providerB['name']) ?></div>
            <?= rating_meter((float)$providerB['rating']) ?>
            <div class="vs-side__price"><?= format_price((float)$providerB['price']) ?><small>/mo</small></div>
        </a>
    </div>

    <section class="section">
        <div class="section-head">
            <div class="section-head__title">
                <span class="kicker kicker--signal">Head to head</span>
                <h2>Every field, matched up</h2>
            </div>
        </div>
        <div class="table-scroll">
            <table class="data-table vs-table">
                <thead>
                    <tr><th scope="col"></th><th scope="col"><?= e($providerA['name']) ?></th><th scope="col"><?= e($providerB['name']) ?></th></tr>
                </thead>
                <tbody>
                    <?php
                    vs_row('Rating', $providerA, $providerB, fn($p) => number_format((float)$p['rating'], 1) . '/5', fn($a, $b) => $a['rating'] >= $b['rating']);
                    vs_row('Reviews', $providerA, $providerB, fn($p) => number_format((int)$p['reviews']));
                    vs_row('Entry price', $providerA, $providerB, fn($p) => format_price((float)$p['price']) . '/mo', fn($a, $b) => $a['price'] <= $b['price']);
                    vs_row('Uptime', $providerA, $providerB, fn($p) => number_format((float)$p['uptime'], 2) . '%', fn($a, $b) => $a['uptime'] >= $b['uptime']);
                    vs_row('Founded', $providerA, $providerB, fn($p) => (string)(int)$p['founded'], fn($a, $b) => $a['founded'] <= $b['founded']);
                    vs_row('Country', $providerA, $providerB, fn($p) => $p['country']);
                    vs_row('Hosting types', $providerA, $providerB, fn($p) => implode(', ', $p['categories']));
                    vs_row('Money-back guarantee', $providerA, $providerB, fn($p) => (int)$p['money_back'] > 0 ? (int)$p['money_back'] . ' days' : 'None stated', fn($a, $b) => (int)$a['money_back'] >= (int)$b['money_back']);
                    if (!empty($providerA['support_channels']) || !empty($providerB['support_channels'])) {
                        vs_row('Support channels', $providerA, $providerB, fn($p) => !empty($p['support_channels']) ? implode(', ', $p['support_channels']) : '—');
                    }
                    if (!empty($providerA['data_centers']) || !empty($providerB['data_centers'])) {
                        vs_row('Data center locations', $providerA, $providerB, fn($p) => !empty($p['data_centers']) ? (string)count($p['data_centers']) : '—', fn($a, $b) => count($a['data_centers'] ?? []) >= count($b['data_centers'] ?? []));
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <section class="section">
        <div class="section-head">
            <div class="section-head__title">
                <span class="kicker kicker--signal">Trade-offs</span>
                <h2>Where each one wins</h2>
            </div>
        </div>
        <div class="pc-grid">
            <div class="pc pc--pro">
                <h3><?= e($providerA['name']) ?> — in its favour</h3>
                <ul>
                    <?php foreach (array_slice($providerA['pros'], 0, 5) as $pro): ?>
                        <li><?= e($pro) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="pc pc--pro">
                <h3><?= e($providerB['name']) ?> — in its favour</h3>
                <ul>
                    <?php foreach (array_slice($providerB['pros'], 0, 5) as $pro): ?>
                        <li><?= e($pro) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="section-head">
            <div class="section-head__title">
                <span class="kicker kicker--signal">Reading the table</span>
                <h2>Which one to pick</h2>
            </div>
        </div>
        <article class="prose" style="padding-top:0">
            <p>
                On price, <?= e($cheaper['name']) ?> starts lower at <?= format_price((float)$cheaper['price']) ?>/mo against
                <?= format_price((float)$pricier['price']) ?>/mo for <?= e($pricier['name']) ?>.
                <?= e($higherRated['name']) ?> carries the higher rating overall, at <?= number_format((float)$higherRated['rating'], 1) ?>/5, and
                <?= e($betterUptime['name']) ?> reports the better tracked uptime at <?= number_format((float)$betterUptime['uptime'], 2) ?>%.
                <?= e($older['name']) ?> has been operating longer, since <?= (int)$older['founded'] ?>.
            </p>
            <p>If entry price is what decides it, start with <?= e($cheaper['name']) ?>. If rating and reliability matter more than the sticker price, <?= e($higherRated['name']) ?> has the edge. Either way, read the full profile before you buy — the trade-offs section on each page covers what the summary numbers leave out.</p>
        </article>
    </section>

    <?php if ($related): ?>
    <section class="section">
        <div class="section-head">
            <div class="section-head__title">
                <span class="kicker kicker--signal">Keep comparing</span>
                <h2>Other hosts worth a look</h2>
            </div>
        </div>
        <div class="pick-grid">
            <?php foreach ($related as $r): ?>
                <a class="pick" href="<?= e(compare_url($providerA, $r)) ?>">
                    <div class="pick__top">
                        <?= provider_badge($providerA, 'sm') ?>
                        <div class="pick__name" style="font-size:0.8rem">vs</div>
                        <?= provider_badge($r, 'sm') ?>
                    </div>
                    <p class="pick__line"><?= e($providerA['name']) ?> vs <?= e($r['name']) ?></p>
                </a>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

</div>

<?php require __DIR__ . '/includes/footer.php'; ?>

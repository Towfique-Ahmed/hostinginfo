<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

$active_nav = 'awards';

$providers = get_providers();
$year = date('Y');

$byRating = $providers;
usort($byRating, fn($a, $b) => $b['rating'] <=> $a['rating']);

$byUptime = $providers;
usort($byUptime, fn($a, $b) => $b['uptime'] <=> $a['uptime']);

$byFounded = $providers;
usort($byFounded, fn($a, $b) => $a['founded'] <=> $b['founded']);

$wellRated = array_values(array_filter($providers, fn($p) => $p['rating'] >= 4.5));
$byValue = $wellRated ?: $providers;
usort($byValue, fn($a, $b) => $a['price'] <=> $b['price']);

$badges = [
    ['label' => 'Best overall', 'note' => 'Highest rating across the whole directory.', 'provider' => $byRating[0] ?? null],
    ['label' => 'Best value', 'note' => 'Lowest entry price among hosts rated 4.5 or higher.', 'provider' => $byValue[0] ?? null],
    ['label' => 'Best tracked uptime', 'note' => 'The strongest published uptime commitment.', 'provider' => $byUptime[0] ?? null],
    ['label' => 'Longest running', 'note' => 'Operating the longest of any host we track.', 'provider' => $byFounded[0] ?? null],
];

$categoryPicks = [];
foreach (get_all_categories() as $cat) {
    $inCat = array_values(array_filter($byRating, fn($p) => in_array($cat, $p['categories'], true)));
    if ($inCat) {
        $categoryPicks[] = ['category' => $cat, 'provider' => $inCat[0]];
    }
}

$page_title = 'HostingInfo Awards ' . $year . ' — Editor\'s Picks by Category | HostingInfo';
$page_description = 'Our editorial picks for ' . $year . ', computed directly from the same rating, price and uptime data behind every provider profile.';

require __DIR__ . '/includes/header.php';
?>

<div class="container">

    <section class="page-head">
        <span class="kicker">Editor's picks</span>
        <h1>The HostingInfo <em>Awards</em>, <?= e($year) ?>.</h1>
        <p class="lede">Not sponsored placements — every pick below is read straight off the same rating, price and uptime fields shown on each provider's own profile.</p>
    </section>

    <section class="section">
        <div class="pick-grid">
            <?php foreach ($badges as $badge): if (!$badge['provider']) continue; $p = $badge['provider']; ?>
                <a class="pick" href="<?= provider_url($p) ?>">
                    <div class="pick__top">
                        <?= provider_badge($p, 'md') ?>
                        <div>
                            <div class="pick__name"><?= e($badge['label']) ?></div>
                            <div class="pick__origin"><?= e($p['name']) ?></div>
                        </div>
                    </div>
                    <p class="pick__line"><?= e($badge['note']) ?></p>
                    <div class="pick__foot">
                        <?= rating_meter((float)$p['rating']) ?>
                        <span class="pick__price"><?= format_price((float)$p['price']) ?><small>/mo</small></span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="section">
        <div class="section-head">
            <div class="section-head__title">
                <span class="kicker kicker--signal">By category</span>
                <h2>Top-rated host in every hosting type</h2>
            </div>
        </div>
        <div class="pick-grid">
            <?php foreach ($categoryPicks as $pick): $p = $pick['provider']; ?>
                <a class="pick" href="<?= provider_url($p) ?>">
                    <div class="pick__top">
                        <?= provider_badge($p, 'md') ?>
                        <div>
                            <div class="pick__name">Best <?= e($pick['category']) ?></div>
                            <div class="pick__origin"><?= e($p['name']) ?></div>
                        </div>
                    </div>
                    <p class="pick__line"><?= e($p['tagline']) ?></p>
                    <div class="pick__foot">
                        <?= rating_meter((float)$p['rating']) ?>
                        <span class="pick__price"><?= format_price((float)$p['price']) ?><small>/mo</small></span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="section section--tight">
        <article class="prose" style="padding-top:0">
            <h2>How picks are chosen</h2>
            <p>Each badge above is a straightforward read of the underlying data: highest rating, lowest qualifying price, strongest published uptime, or earliest founding year. See the full breakdown on our <a href="<?= url('rating-methodology') ?>">rating methodology page</a>.</p>
        </article>
    </section>

</div>

<?php require __DIR__ . '/includes/footer.php'; ?>

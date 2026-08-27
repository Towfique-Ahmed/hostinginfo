<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

$active_nav = 'providers';

$providers = get_providers();
$categories = get_all_categories();
$countries = get_all_countries();

$page_title = 'All Hosting Providers (' . count($providers) . ') — Compare Plans & Prices | HostingInfo';
$page_description = 'Compare ' . count($providers) . ' hosting providers in one sortable table: entry price, uptime, rating, country and category. Shared, VPS, cloud, WordPress and dedicated hosting.';

$q = trim((string)($_GET['q'] ?? ''));
$category = trim((string)($_GET['category'] ?? ''));
$country = trim((string)($_GET['country'] ?? ''));
$sort = trim((string)($_GET['sort'] ?? 'rating'));

$filtered = array_values(array_filter($providers, function ($p) use ($q, $category, $country) {
    if ($category !== '' && !in_array($category, $p['categories'], true)) {
        return false;
    }
    if ($country !== '' && $p['country'] !== $country) {
        return false;
    }
    if ($q !== '') {
        $haystack = mb_strtolower($p['name'] . ' ' . $p['country'] . ' ' . implode(' ', $p['categories']) . ' ' . $p['tagline']);
        if (mb_strpos($haystack, mb_strtolower($q)) === false) {
            return false;
        }
    }
    return true;
}));

switch ($sort) {
    case 'price':
        usort($filtered, fn($a, $b) => $a['price'] <=> $b['price']);
        break;
    case 'name':
        usort($filtered, fn($a, $b) => strcmp($a['name'], $b['name']));
        break;
    case 'founded':
        usort($filtered, fn($a, $b) => $a['founded'] <=> $b['founded']);
        break;
    case 'uptime':
        usort($filtered, fn($a, $b) => $b['uptime'] <=> $a['uptime']);
        break;
    default:
        usort($filtered, fn($a, $b) => $b['rating'] <=> $a['rating']);
}

/* Slugs that currently carry a coupon, so the table can flag them. */
$dealSlugs = [];
foreach (get_deals_with_providers() as $d) {
    $dealSlugs[$d['provider_slug']] = (int) $d['discount'];
}

require __DIR__ . '/includes/header.php';
?>

<div class="container">

    <section class="page-head">
        <span class="kicker">The directory</span>
        <h1>Every provider, <em>one table</em>.</h1>
        <p class="lede">Sort <?= count($providers) ?> hosts by price, uptime, rating or age. Click any column heading to reorder; click a row to read the full profile.</p>
    </section>

    <form class="toolbar" id="filterForm" method="get" action="<?= url('providers') ?>">
        <label class="field">
            <span class="visually-hidden">Search providers</span>
            <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3" stroke-linecap="round"/></svg>
            <input type="text" name="q" id="searchInput" value="<?= e($q) ?>" placeholder="Search providers">
        </label>
        <div class="toolbar__filters">
            <select name="country" id="countryFilter" class="select" aria-label="Filter by country">
                <option value="">All countries</option>
                <?php foreach ($countries as $c => $flag): ?>
                    <option value="<?= e($c) ?>" <?= $country === $c ? 'selected' : '' ?>><?= e($c) ?></option>
                <?php endforeach; ?>
            </select>
            <select name="sort" id="sortFilter" class="select" aria-label="Sort providers">
                <option value="rating" <?= $sort === 'rating' ? 'selected' : '' ?>>Highest rated</option>
                <option value="price" <?= $sort === 'price' ? 'selected' : '' ?>>Lowest price</option>
                <option value="uptime" <?= $sort === 'uptime' ? 'selected' : '' ?>>Best uptime</option>
                <option value="name" <?= $sort === 'name' ? 'selected' : '' ?>>Name A–Z</option>
                <option value="founded" <?= $sort === 'founded' ? 'selected' : '' ?>>Longest running</option>
            </select>
        </div>
        <noscript><button type="submit" class="btn btn--primary btn--sm">Apply</button></noscript>
        <input type="hidden" name="category" id="categoryInput" value="<?= e($category) ?>">
    </form>

    <div class="chip-row" id="categoryTags">
        <button type="button" class="chip <?= $category === '' ? 'is-active' : '' ?>" data-category="">All</button>
        <?php foreach ($categories as $cat): ?>
            <button type="button" class="chip <?= $category === $cat ? 'is-active' : '' ?>" data-category="<?= e($cat) ?>"><?= e($cat) ?></button>
        <?php endforeach; ?>
    </div>

    <div class="results-bar">
        <span class="kicker" id="resultsCount"><?= count($filtered) ?> provider<?= count($filtered) === 1 ? '' : 's' ?></span>
        <span class="kicker">Prices are entry-tier, per month</span>
    </div>

    <div class="table-wrap">
        <table class="dir-table" id="providerTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col" class="is-sortable" data-sort="name">Provider <span class="arrow">↓</span></th>
                    <th scope="col">Country</th>
                    <th scope="col">Type</th>
                    <th scope="col" class="is-sortable" data-sort="rating">Rating <span class="arrow">↓</span></th>
                    <th scope="col" class="is-sortable" data-sort="uptime">Uptime <span class="arrow">↓</span></th>
                    <th scope="col" class="is-sortable" data-sort="price" style="text-align:right">From <span class="arrow">↓</span></th>
                    <th scope="col"><span class="visually-hidden">Open profile</span></th>
                </tr>
            </thead>
            <tbody id="providerRows">
                <?php foreach ($filtered as $p): ?>
                    <tr data-name="<?= e(mb_strtolower($p['name'])) ?>"
                        data-country="<?= e($p['country']) ?>"
                        data-categories="<?= e(implode(',', $p['categories'])) ?>"
                        data-rating="<?= e((string)$p['rating']) ?>"
                        data-uptime="<?= e((string)$p['uptime']) ?>"
                        data-price="<?= e((string)$p['price']) ?>"
                        data-founded="<?= e((string)$p['founded']) ?>"
                        data-tagline="<?= e(mb_strtolower($p['tagline'])) ?>"
                        data-href="<?= provider_url($p) ?>">
                        <td class="cell-rank"></td>
                        <td>
                            <div class="cell-name">
                                <?= provider_badge($p, 'sm') ?>
                                <div class="cell-name__text">
                                    <div class="cell-name__title">
                                        <a href="<?= provider_url($p) ?>"><?= e($p['name']) ?></a>
                                    </div>
                                    <div class="cell-name__line"><?= e($p['tagline']) ?></div>
                                </div>
                            </div>
                        </td>
                        <td class="cell-origin"><?= e($p['country']) ?></td>
                        <td class="cell-tags"><?= e(implode(', ', array_slice($p['categories'], 0, 2))) ?></td>
                        <td><?= rating_meter((float)$p['rating']) ?></td>
                        <td class="cell-num"><?= number_format((float)$p['uptime'], 2) ?>%</td>
                        <td class="cell-price">
                            <?= format_price((float)$p['price']) ?>
                            <?php if (isset($dealSlugs[$p['slug']])): ?>
                                <div><span class="has-deal"><?= $dealSlugs[$p['slug']] ?>% OFF</span></div>
                            <?php endif; ?>
                        </td>
                        <td class="cell-go">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="empty-state" id="emptyState" style="<?= count($filtered) ? 'display:none' : '' ?>">
        <h3>Nothing matches those filters</h3>
        <p>Clear a filter or try a different search term.</p>
    </div>

</div>

<?php require __DIR__ . '/includes/footer.php'; ?>

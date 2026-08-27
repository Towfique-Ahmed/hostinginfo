<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

$active_nav = 'providers';

$providers = get_providers();
$categories = get_all_categories();
$countries = get_all_countries();

/*
 * Category pages live at /providers/{category}-hosting. The slug arrives either from
 * the .htaccess rewrite or from index.php's front-controller fallback; an unknown slug
 * is a 404 rather than a silently unfiltered listing. The old ?category=Cloud links are
 * folded into the canonical path with a 301 so the two forms never both get indexed.
 */
$categorySlug = trim((string)($_GET['category_slug'] ?? ''));

if ($categorySlug !== '') {
    $category = category_from_slug($categorySlug);
    if ($category === null) {
        render_not_found(
            'Category Not Found',
            'There is no hosting category at that address. Browse the full directory instead.'
        );
    }
} else {
    $category = trim((string)($_GET['category'] ?? ''));
    if ($category !== '' && in_array($category, get_all_categories(), true)) {
        $carry = array_filter([
            'q' => trim((string)($_GET['q'] ?? '')),
            'country' => trim((string)($_GET['country'] ?? '')),
            'sort' => trim((string)($_GET['sort'] ?? '')),
        ], fn($v) => $v !== '');
        redirect_permanent(category_url($category, $carry));
    }
    $category = '';
}

$q = trim((string)($_GET['q'] ?? ''));
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

$categoryCount = count($filtered);

if ($category !== '') {
    $label = $category . ' hosting';
    $page_title = ucfirst($label) . ' — ' . $categoryCount . ' Providers Compared | HostingInfo';
    $page_description = 'Compare ' . $categoryCount . ' ' . $label . ' providers side by side: entry price, uptime, rating and country, sorted however you need.';
} else {
    $page_title = 'All Hosting Providers (' . count($providers) . ') — Compare Plans & Prices | HostingInfo';
    $page_description = 'Compare ' . count($providers) . ' hosting providers in one sortable table: entry price, uptime, rating, country and category. Shared, VPS, cloud, WordPress and dedicated hosting.';
}

$formAction = $category !== '' ? category_url($category) : url('providers');

require __DIR__ . '/includes/header.php';
?>

<div class="container">

    <section class="page-head">
        <?php if ($category !== ''): ?>
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="<?= url('') ?>">Home</a> <span>/</span>
                <a href="<?= url('providers') ?>">Directory</a> <span>/</span>
                <span><?= e($category) ?> hosting</span>
            </nav>
            <h1><?= e($category) ?> hosting, <em>compared</em>.</h1>
            <p class="lede"><?= $categoryCount ?> <?= e($category) ?> host<?= $categoryCount === 1 ? '' : 's' ?> in the directory, sortable by price, uptime, rating or age. Click a row to read the full profile.</p>
        <?php else: ?>
            <span class="kicker">The directory</span>
            <h1>Every provider, <em>one table</em>.</h1>
            <p class="lede">Sort <?= count($providers) ?> hosts by price, uptime, rating or age. Click any column heading to reorder; click a row to read the full profile.</p>
        <?php endif; ?>
    </section>

    <form class="toolbar" id="filterForm" method="get" action="<?= e($formAction) ?>">
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
    </form>

    <nav class="chip-row" aria-label="Hosting categories">
        <a class="chip <?= $category === '' ? 'is-active' : '' ?>" href="<?= url('providers') ?>">All</a>
        <?php foreach ($categories as $cat): ?>
            <a class="chip <?= $category === $cat ? 'is-active' : '' ?>" href="<?= e(category_url($cat)) ?>"><?= e($cat) ?></a>
        <?php endforeach; ?>
    </nav>

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

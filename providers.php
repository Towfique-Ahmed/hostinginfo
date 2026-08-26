<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

$page_title = 'All Hosting Providers — Compare & Filter | HostRadar';
$page_description = 'Browse and filter every hosting provider in the HostRadar directory by category, country, rating and price.';
$active_nav = 'providers';

$providers = get_providers();
$categories = get_all_categories();
$countries = get_all_countries();

$q = trim((string)($_GET['q'] ?? ''));
$category = trim((string)($_GET['category'] ?? ''));
$country = trim((string)($_GET['country'] ?? ''));
$sort = trim((string)($_GET['sort'] ?? 'rating'));

$filtered = array_filter($providers, function ($p) use ($q, $category, $country) {
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
});
$filtered = array_values($filtered);

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
    default:
        usort($filtered, fn($a, $b) => $b['rating'] <=> $a['rating']);
}

require __DIR__ . '/includes/header.php';
?>

<section class="page-hero">
    <div class="container">
        <h1>Every hosting provider, <span class="gradient-text">one directory</span>.</h1>
        <p>Filter by category, country, price or rating to find the host that fits your project — updated as our team profiles more providers.</p>
    </div>
</section>

<section class="section section--tight">
    <div class="container">
        <form class="filter-bar" id="filterForm" method="get" action="/providers.php">
            <div class="filter-bar__row">
                <div class="search-box">
                    <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
                    <input type="text" name="q" id="searchInput" value="<?= e($q) ?>" placeholder="Search providers…" aria-label="Search providers">
                </div>
                <select name="country" id="countryFilter" class="select-pill" aria-label="Filter by country">
                    <option value="">All Countries</option>
                    <?php foreach ($countries as $c => $flag): ?>
                        <option value="<?= e($c) ?>" <?= $country === $c ? 'selected' : '' ?>><?= $flag ?> <?= e($c) ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="sort" id="sortFilter" class="select-pill" aria-label="Sort providers">
                    <option value="rating" <?= $sort === 'rating' ? 'selected' : '' ?>>Top Rated</option>
                    <option value="price" <?= $sort === 'price' ? 'selected' : '' ?>>Lowest Price</option>
                    <option value="name" <?= $sort === 'name' ? 'selected' : '' ?>>Name A–Z</option>
                    <option value="founded" <?= $sort === 'founded' ? 'selected' : '' ?>>Oldest First</option>
                </select>
                <noscript><button type="submit" class="btn btn--primary btn--sm">Apply</button></noscript>
            </div>
            <div class="filter-bar__tags" id="categoryTags">
                <button type="button" class="filter-tag <?= $category === '' ? 'is-active' : '' ?>" data-category="">All Categories</button>
                <?php foreach ($categories as $cat): ?>
                    <button type="button" class="filter-tag <?= $category === $cat ? 'is-active' : '' ?>" data-category="<?= e($cat) ?>"><?= e($cat) ?></button>
                <?php endforeach; ?>
            </div>
            <input type="hidden" name="category" id="categoryInput" value="<?= e($category) ?>">
        </form>

        <div class="results-meta">
            <span id="resultsCount"><?= count($filtered) ?> provider<?= count($filtered) === 1 ? '' : 's' ?> found</span>
        </div>

        <div class="provider-grid" id="providerGrid">
            <?php foreach ($filtered as $p): ?>
                <a href="/provider.php?slug=<?= e($p['slug']) ?>" class="provider-card"
                   data-name="<?= e(mb_strtolower($p['name'])) ?>"
                   data-country="<?= e($p['country']) ?>"
                   data-categories="<?= e(implode(',', $p['categories'])) ?>"
                   data-rating="<?= e((string)$p['rating']) ?>"
                   data-price="<?= e((string)$p['price']) ?>"
                   data-founded="<?= e((string)$p['founded']) ?>"
                   data-tagline="<?= e(mb_strtolower($p['tagline'])) ?>">
                    <div class="provider-card__top">
                        <div class="provider-card__id">
                            <?= provider_badge($p, 'md') ?>
                            <div>
                                <div class="provider-card__name"><?= e($p['name']) ?></div>
                                <div class="provider-card__country"><?= $p['flag'] ?> <?= e($p['country']) ?></div>
                            </div>
                        </div>
                    </div>
                    <p class="provider-card__tagline"><?= e($p['tagline']) ?></p>
                    <div class="provider-card__tags">
                        <?php foreach (array_slice($p['categories'], 0, 3) as $cat): ?>
                            <span class="tag"><?= e($cat) ?></span>
                        <?php endforeach; ?>
                    </div>
                    <div class="provider-card__meta">
                        <div><?= star_rating_html((float)$p['rating']) ?><span class="rating-num"><?= number_format((float)$p['rating'], 1) ?></span></div>
                        <div class="price-tag">
                            <div class="price-tag__amount"><?= format_price((float)$p['price']) ?></div>
                            <div class="price-tag__period">per month</div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="empty-state" id="emptyState" style="<?= count($filtered) ? 'display:none' : '' ?>">
            <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
            <h3>No providers match your filters</h3>
            <p>Try clearing a filter or searching a different term.</p>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>

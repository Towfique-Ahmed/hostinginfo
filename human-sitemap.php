<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

$active_nav = '';

$providers = get_providers();
$byName = $providers;
usort($byName, fn($a, $b) => strcmp($a['name'], $b['name']));
$categories = get_all_categories();

$page_title = 'Sitemap | HostingInfo';
$page_description = 'Every page on HostingInfo in one place: providers, categories, deals, tools and site policies.';

require __DIR__ . '/includes/header.php';
?>

<div class="container">

    <section class="page-head">
        <span class="kicker">Sitemap</span>
        <h1>Every page, <em>one list</em>.</h1>
        <p class="lede">A machine-readable version lives at <a href="/sitemap.xml"><?= e(base_url()) ?>/sitemap.xml</a>. This one is for people.</p>
    </section>

    <section class="section section--tight">
        <div class="section-head"><div class="section-head__title"><h2>Main</h2></div></div>
        <ul class="prose" style="padding:0"><li><a href="<?= url('') ?>">Home</a></li>
        <li><a href="<?= url('providers') ?>">Provider directory</a></li>
        <li><a href="<?= url('deals') ?>">Deals &amp; coupon codes</a></li>
        <li><a href="<?= url('compare') ?>">Compare providers</a></li>
        <li><a href="<?= url('tools') ?>">Tools</a></li>
        <li><a href="<?= url('hosting-categories') ?>">Hosting categories</a></li>
        <li><a href="<?= url('awards') ?>">Awards</a></li>
        <li><a href="<?= url('about') ?>">About</a></li>
        <li><a href="<?= url('contact') ?>">Contact</a></li>
        </ul>
    </section>

    <section class="section section--tight">
        <div class="section-head"><div class="section-head__title"><h2>Categories</h2></div></div>
        <ul class="prose" style="padding:0">
            <?php foreach ($categories as $cat): ?>
                <li><a href="<?= e(category_url($cat)) ?>"><?= e($cat) ?> hosting</a></li>
            <?php endforeach; ?>
        </ul>
    </section>

    <section class="section section--tight">
        <div class="section-head"><div class="section-head__title"><h2>Providers (<?= count($byName) ?>)</h2></div></div>
        <div class="human-sitemap-grid">
            <?php foreach ($byName as $p): ?>
                <div>
                    <a href="<?= provider_url($p) ?>"><?= e($p['name']) ?></a>
                    <a href="<?= e(provider_coupons_url($p)) ?>" class="human-sitemap-grid__sub">coupons</a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="section section--tight">
        <div class="section-head"><div class="section-head__title"><h2>Policies</h2></div></div>
        <ul class="prose" style="padding:0">
            <li><a href="<?= url('rating-methodology') ?>">Rating methodology</a></li>
            <li><a href="<?= url('privacy-policy') ?>">Privacy policy</a></li>
            <li><a href="<?= url('terms-of-service') ?>">Terms of service</a></li>
        </ul>
    </section>

</div>

<?php require __DIR__ . '/includes/footer.php'; ?>

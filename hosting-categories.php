<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

$active_nav = 'providers';

$providers = get_providers();
$categories = get_all_categories();

$descriptions = [
    'Shared'    => 'Multiple sites share one server. The cheapest way to get a site online, and the usual starting point.',
    'WordPress' => 'Tuned specifically for WordPress: caching, staging and one-click installs built in.',
    'VPS'       => 'A virtual private slice of a server, with root access and dedicated resources.',
    'Cloud'     => 'Resources scale across a cluster rather than one machine, so traffic spikes don\'t take a site down.',
    'Dedicated' => 'An entire physical server to yourself — maximum control, at the highest price point.',
    'Reseller'  => 'Buy hosting in bulk and resell it under your own brand.',
    'Managed'   => 'The provider handles updates, security and backups so you don\'t have to.',
];

$page_title = 'Hosting Categories — Shared, VPS, Cloud, Dedicated & More | HostingInfo';
$page_description = 'Every hosting type in the directory, explained in a sentence, with a link straight to the providers that offer it.';

require __DIR__ . '/includes/header.php';
?>

<div class="container">

    <section class="page-head">
        <span class="kicker">Directory</span>
        <h1>Hosting, <em>by type</em>.</h1>
        <p class="lede">Not sure which category you need? Here's what each one actually means.</p>
    </section>

    <section class="section">
        <div class="cat-index" style="grid-template-columns:repeat(auto-fill,minmax(260px,1fr))">
            <?php foreach ($categories as $cat):
                $count = count(array_filter($providers, fn($p) => in_array($cat, $p['categories'], true))); ?>
                <a href="<?= e(category_url($cat)) ?>" style="flex-direction:column; align-items:flex-start; gap:8px; padding:18px">
                    <div style="display:flex; align-items:center; gap:10px; width:100%">
                        <?= category_icon($cat) ?>
                        <span class="cat-index__name"><?= e($cat) ?> hosting</span>
                        <span class="cat-index__count"><?= $count ?></span>
                    </div>
                    <p style="margin:0; font-size:0.85rem; color:var(--fg-muted); line-height:1.5"><?= e($descriptions[$cat] ?? '') ?></p>
                </a>
            <?php endforeach; ?>
        </div>
    </section>

</div>

<?php require __DIR__ . '/includes/footer.php'; ?>

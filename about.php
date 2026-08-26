<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

$active_nav = 'about';

$providers = get_providers();
$countries = get_all_countries();

$page_title = 'About Us | HostingInfo';
$page_description = 'HostingInfo is an independent directory helping you discover, compare, and choose web hosting providers from every corner of the world.';

require __DIR__ . '/includes/header.php';
?>

<section class="hero">
    <div class="container">
        <span class="hero__eyebrow"><span class="dot"></span> Our story</span>
        <h1>Helping you find hosting you can <span class="gradient-text">trust</span>.</h1>
        <p class="lead">HostingInfo is an independent directory built to make comparing web hosting providers simple, honest, and fast.</p>
    </div>
</section>

<section class="section section--tight">
    <div class="container">
        <div class="legal-content reveal">
            <h2>What we do</h2>
            <p>We track <?= count($providers) ?>+ hosting providers across <?= count($countries) ?>+ countries, covering shared, WordPress, VPS, cloud, dedicated, and reseller hosting. Every profile is built to help you compare pricing, features, and ratings side-by-side, so you can pick a host that actually fits your project.</p>

            <h2>Why we started</h2>
            <p>Choosing a hosting provider shouldn't mean digging through a dozen tabs of marketing pages just to compare prices. We built HostingInfo to put that information in one place — clear, structured, and easy to scan — so you can make a decision in minutes instead of hours.</p>

            <h2>How we stay independent</h2>
            <p>HostingInfo is an informational directory, not a hosting provider. We are not affiliated with the companies listed here, and all provider names, logos, and trademarks belong to their respective owners. Pricing and deals are refreshed regularly, but we always recommend verifying current pricing on the provider's official site before you buy.</p>

            <h2>Get in touch</h2>
            <p>Have a correction, a suggestion, or a provider we should add? We'd love to hear from you — visit our <a href="<?= url('contact') ?>">Contact Us</a> page to reach out.</p>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>

<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

$active_nav = 'contact';

$page_title = 'Contact HostingInfo — Corrections & Provider Submissions';
$page_description = 'Send corrections, suggest a missing hosting provider, or ask a partnership question. The HostingInfo team reviews every message.';

require __DIR__ . '/includes/header.php';
?>

<div class="container">

    <section class="page-head">
        <span class="kicker">Contact</span>
        <h1>Tell us what we got <em>wrong</em>.</h1>
        <p class="lede">Corrections, missing providers, stale pricing, or a partnership question — all of it reaches the same inbox.</p>
    </section>

    <section class="section section--tight">
        <div class="contact-grid">
            <a class="contact-card" href="mailto:hello@towfique.com">
                <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg>
                <h3>Email</h3>
                <p>hello@towfique.com</p>
            </a>
            <div class="contact-card">
                <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>
                <h3>Corrections</h3>
                <p>Outdated pricing or a provider we are missing? Send the detail and we will review it.</p>
            </div>
            <div class="contact-card">
                <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/></svg>
                <h3>Providers</h3>
                <p>Represent a host and want your profile reviewed or updated? Get in touch.</p>
            </div>
        </div>
    </section>

</div>

<?php require __DIR__ . '/includes/footer.php'; ?>

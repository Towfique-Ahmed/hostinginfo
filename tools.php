<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

$active_nav = 'tools';

$page_title = 'Free Hosting Tools — Compare & Whois Lookup | HostingInfo';
$page_description = 'Free tools that sit alongside the directory: a side-by-side provider comparison and a domain Whois lookup.';

require __DIR__ . '/includes/header.php';
?>

<div class="container">

    <section class="page-head">
        <span class="kicker">Tools</span>
        <h1>Small tools, <em>no signup</em>.</h1>
        <p class="lede">Utilities that sit next to the directory — free, and built from the same data.</p>
    </section>

    <section class="section">
        <div class="pick-grid">
            <a class="pick" href="<?= url('compare') ?>">
                <div class="pick__top">
                    <span class="logo-tile logo-tile--md" aria-hidden="true" style="--brand-rgb:233,171,76;--brand-on-dark:#fff;--brand-on-light:#000">
                        <svg viewBox="0 0 24 24" width="18" height="18" style="stroke:currentColor;fill:none;stroke-width:1.6"><path d="M8 3v18M16 3v18M4 8h4M4 16h4M16 8h4M16 16h4" stroke-linecap="round"/></svg>
                    </span>
                    <div><div class="pick__name">Compare providers</div></div>
                </div>
                <p class="pick__line">Put any two hosts side by side on price, uptime, rating and features.</p>
            </a>
            <a class="pick" href="<?= url('tools/whois') ?>">
                <div class="pick__top">
                    <span class="logo-tile logo-tile--md" aria-hidden="true" style="--brand-rgb:233,171,76;--brand-on-dark:#fff;--brand-on-light:#000">
                        <svg viewBox="0 0 24 24" width="18" height="18" style="stroke:currentColor;fill:none;stroke-width:1.6"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3" stroke-linecap="round"/></svg>
                    </span>
                    <div><div class="pick__name">Whois lookup</div></div>
                </div>
                <p class="pick__line">Check who a domain is registered to, and when it was created and expires.</p>
            </a>
            <a class="pick" href="<?= url('providers') ?>">
                <div class="pick__top">
                    <span class="logo-tile logo-tile--md" aria-hidden="true" style="--brand-rgb:233,171,76;--brand-on-dark:#fff;--brand-on-light:#000">
                        <svg viewBox="0 0 24 24" width="18" height="18" style="stroke:currentColor;fill:none;stroke-width:1.6"><rect x="3" y="4" width="18" height="16" rx="1.5"/><path d="M3 9h18"/></svg>
                    </span>
                    <div><div class="pick__name">Plan search</div></div>
                </div>
                <p class="pick__line">Filter the full directory by country, price and hosting type.</p>
            </a>
        </div>
    </section>

</div>

<?php require __DIR__ . '/includes/footer.php'; ?>

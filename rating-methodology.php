<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

$active_nav = 'rating-methodology';

$page_title = 'Our Rating Methodology | HostingInfo';
$page_description = 'How HostingInfo scores every hosting provider on the same five factors, and what the overall rating actually means.';

require __DIR__ . '/includes/header.php';
?>

<div class="container container--narrow">

    <section class="page-head">
        <span class="kicker">Methodology</span>
        <h1>How we <em>score a host</em>.</h1>
        <p class="lede">Every provider on HostingInfo is scored against the same five factors, so a 4.6 means the same thing wherever you see it.</p>
    </section>

    <article class="prose">
        <h2>The five factors</h2>
        <p>Where we publish a factor breakdown on a provider's page, it comes from five weighted components, each scored on a 5-point scale:</p>
        <ul>
            <li><strong>Speed</strong> — server response and page-load behaviour reported for the provider's entry-tier plan.</li>
            <li><strong>Support</strong> — the number and quality of support channels offered (live chat, ticketing, phone, knowledge base) and typical response expectations.</li>
            <li><strong>Value</strong> — what you get at the advertised entry price relative to comparable plans elsewhere in the directory.</li>
            <li><strong>Features</strong> — breadth of what's included at entry tier: free domain, SSL, backups, staging, caching and similar.</li>
            <li><strong>Reliability</strong> — published uptime commitments and track record, where the provider discloses one.</li>
        </ul>

        <h2>The overall rating</h2>
        <p>The single rating shown on a provider's card and profile is a weighted composite of the factors above, combined with our own editorial read of the provider's plans, policies and public reputation. It is not a live, automated benchmark — we do not run continuous uptime monitors or synthetic load tests against every provider. Treat it as a structured editorial judgment, not a lab measurement.</p>

        <h2>Where the numbers come from</h2>
        <p>Entry price is the lowest advertised price we found on the provider's own pricing page at time of review, before any first-term-only discount unless stated otherwise. Uptime is the figure the provider publishes or guarantees in its SLA, not a measurement we take ourselves. Founding year and country come from the provider's own "about" material or public company records.</p>

        <h2>Review cadence</h2>
        <p>We revisit provider profiles periodically and whenever we're notified of a material change — a price change, a new plan tier, or a policy update. Between reviews, figures can drift out of date; always check the provider's own site before buying.</p>

        <h2>Independence</h2>
        <p>We are not paid by providers to rank them higher, and a provider cannot buy a better score. See our <a href="<?= url('about') ?>">About page</a> for more on how HostingInfo operates.</p>

        <h2>Something looks wrong?</h2>
        <p>If a score, price or feature looks out of date, tell us on the <a href="<?= url('contact') ?>">contact page</a> — corrections are the fastest way we keep this accurate.</p>
    </article>

</div>

<?php require __DIR__ . '/includes/footer.php'; ?>

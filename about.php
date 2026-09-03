<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

$active_nav = 'about';

$providers = get_providers();
$countries = get_all_countries();

$page_title = 'About HostingInfo — Independent Web Hosting Research & Comparison';
$page_description = 'HostingInfo is an independent web hosting directory tracking ' . count($providers) . ' providers across ' . count($countries) . ' countries — unbiased pricing, uptime, and rating data with no affiliate pressure.';

$_base = base_url();
$json_ld = json_encode([
    '@context' => 'https://schema.org',
    '@type'    => 'Organization',
    '@id'      => $_base . '/#organization',
    'name'     => 'HostingInfo',
    'url'      => $_base,
    'foundingDate' => '2024',
    'founder'  => ['@type' => 'Person', 'name' => 'Towfique Ahmed'],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

require __DIR__ . '/includes/header.php';
?>

<div class="container container--narrow">

    <section class="page-head">
        <span class="kicker">About</span>
        <h1>An independent desk for <em>hosting research</em>.</h1>
        <p class="lede">HostingInfo exists to make comparing web hosts a matter of reading one table instead of opening twelve tabs.</p>
    </section>

    <article class="prose">
        <h2>What we do</h2>
        <p>We track <?= count($providers) ?> hosting providers across <?= count($countries) ?> countries — shared, WordPress, VPS, cloud, dedicated, managed and reseller. Every provider gets the same profile structure and the same fields, so the numbers line up in a column and a comparison is actually a comparison.</p>

        <h2>Why we started</h2>
        <p>Choosing a host shouldn't mean reverse-engineering a dozen marketing pages to find out what a plan costs after the first term. We put the figures that matter — entry price, uptime, rating, founding year, country of operation — in one structured place, and we say plainly what each provider is bad at as well as what it is good at.</p>

        <h2>How we stay independent</h2>
        <p>HostingInfo is a directory, not a hosting company. We are not affiliated with the providers listed here, and all names and marks belong to their owners. Pricing and deals move constantly, so treat what you read here as a starting point and confirm the current figure on the provider's own site before you buy.</p>

    </article>

    <section class="team">
        <span class="kicker">Team</span>
        <h2 class="team__title">The HostingInfo Team</h2>

        <div class="team__member">
            <div class="team__avatar" aria-hidden="true">TA</div>
            <div class="team__body">
                <h3>Towfique Ahmed</h3>
                <p class="team__role">Founder, HostingInfo.online</p>
                <p>Towfique Ahmed is the founder of HostingInfo.online. In his own words: WordPress has been part of my working life for years. I have built and maintained WordPress sites of every size, from a single landing page to sites with a lot of moving parts, and I have spent as much time troubleshooting other people's sites as building my own — which is where most of what I know about hosting actually came from.</p>
                <p>Chasing page speed pulled me into cloud infrastructure, and I ended up staying. I started HostingInfo with one idea: put the data first and let people choose for themselves. Every provider here gets the same fields and the same treatment, so the comparison is a real comparison rather than a ranked list of whoever pays the most. I am still refining how the numbers are collected, and I would rather correct a figure than defend it.</p>
                <p class="team__links"><a href="https://www.linkedin.com/in/towfiq28/" target="_blank" rel="noopener noreferrer">Connect on LinkedIn</a></p>
            </div>
        </div>
    </section>

    <article class="prose">
        <h2>Corrections</h2>
        <p>If a price is stale, a feature is wrong, or a provider is missing, we want to know. The <a href="<?= url('contact') ?>">contact page</a> reaches us directly.</p>
    </article>

</div>

<?php require __DIR__ . '/includes/footer.php'; ?>

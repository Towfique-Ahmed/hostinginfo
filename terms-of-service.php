<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

$active_nav = 'terms';

$page_title = 'Terms of Service | HostingInfo';
$page_description = 'The terms that govern your use of HostingInfo — an independent, informational web hosting directory.';

require __DIR__ . '/includes/header.php';
?>

<div class="container container--narrow">

    <section class="page-head">
        <span class="kicker">Legal</span>
        <h1>Terms of <em>service</em>.</h1>
        <p class="lede">The rules for using HostingInfo, in plain language.</p>
    </section>

    <article class="prose">
        <p class="kicker">Last updated <?= date('j F Y') ?></p>

        <h2>What HostingInfo is</h2>
        <p>HostingInfo is an independent, informational directory of web hosting providers. We publish comparisons, pricing snapshots and coupon codes that we compile and review ourselves. We are not a hosting company, a reseller, or an agent of any provider listed here, and using this site does not create a business relationship between you and HostingInfo.</p>

        <h2>Accuracy of information</h2>
        <p>Prices, uptime figures, plan details and coupon codes change on providers' own sites, often without notice. We work to keep our data current, but we cannot guarantee that any figure on this site matches what you will see at checkout. Always confirm the current price, terms and availability directly with the provider before purchasing.</p>

        <h2>No warranty</h2>
        <p>The site and its content are provided "as is," without warranties of any kind, express or implied. We do not warrant that any provider profiled here will meet your requirements, or that the site will be uninterrupted, timely, secure, or error-free.</p>

        <h2>Limitation of liability</h2>
        <p>HostingInfo is not liable for any loss or damage arising from your reliance on information published here, or from your dealings with any third-party provider linked from this site. Your use of a provider's service is governed entirely by that provider's own terms.</p>

        <h2>External links</h2>
        <p>Provider pages and deal listings link to third-party sites we do not control. We are not responsible for the content, security or practices of those sites. Links do not imply endorsement beyond the profile shown on this site.</p>

        <h2>Intellectual property</h2>
        <p>The text, structure, design and data compilation on HostingInfo are our own work and may not be reproduced without permission. Provider names, logos and marks referenced on this site belong to their respective owners and are used only to identify the providers being described.</p>

        <h2>Acceptable use</h2>
        <ul>
            <li>Do not scrape, republish or redistribute our compiled data at scale without permission.</li>
            <li>Do not attempt to disrupt, probe or gain unauthorized access to the site or its infrastructure.</li>
            <li>Do not use the site for any unlawful purpose.</li>
        </ul>

        <h2>Changes to these terms</h2>
        <p>We may revise these terms from time to time. Continued use of the site after a change means you accept the revised terms. The date above reflects the last update.</p>

        <h2>Contact</h2>
        <p>Questions about these terms can be sent through our <a href="<?= url('contact') ?>">contact page</a>.</p>
    </article>

</div>

<?php require __DIR__ . '/includes/footer.php'; ?>

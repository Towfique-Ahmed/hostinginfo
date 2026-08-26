<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

$active_nav = 'privacy';

$page_title = 'Privacy Policy | HostingInfo';
$page_description = 'Read the HostingInfo privacy policy to understand what information we collect, how it is used, and your choices.';

require __DIR__ . '/includes/header.php';
?>

<section class="hero">
    <div class="container">
        <span class="hero__eyebrow"><span class="dot"></span> Legal</span>
        <h1>Privacy <span class="gradient-text">Policy</span></h1>
        <p class="lead">This policy explains what information HostingInfo collects and how it is used.</p>
    </div>
</section>

<section class="section section--tight">
    <div class="container">
        <div class="legal-content reveal">
            <p class="legal-updated">Last updated: <?= date('F j, Y') ?></p>

            <h2>Information we collect</h2>
            <p>We collect limited information automatically when you visit HostingInfo, such as pages viewed, browser type, and general usage patterns, typically through standard analytics tools. If you subscribe to our newsletter, we collect the email address you provide.</p>

            <h2>How we use information</h2>
            <ul>
                <li>To operate, maintain, and improve the directory and its content.</li>
                <li>To send occasional hosting deals and updates to newsletter subscribers who opt in.</li>
                <li>To understand aggregate site usage so we can improve navigation and content.</li>
            </ul>

            <h2>Cookies</h2>
            <p>HostingInfo may use cookies or similar local storage to remember preferences, such as your light or dark theme choice. You can disable cookies through your browser settings, though some features may not work as intended.</p>

            <h2>Third-party links</h2>
            <p>Our provider pages and deals link out to third-party hosting companies. We are not responsible for the privacy practices or content of those external sites — please review their own privacy policies before providing any information.</p>

            <h2>Data sharing</h2>
            <p>We do not sell your personal information. We may share limited data with service providers who help us operate the site (for example, email delivery for our newsletter), solely for that purpose.</p>

            <h2>Your choices</h2>
            <p>You can unsubscribe from our newsletter at any time using the link included in every email. For any other privacy request, contact us using the details on our <a href="<?= url('contact') ?>">Contact Us</a> page.</p>

            <h2>Changes to this policy</h2>
            <p>We may update this privacy policy from time to time. Changes will be posted on this page with an updated revision date.</p>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>

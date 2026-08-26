<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

$active_nav = 'contact';

$page_title = 'Contact Us | HostingInfo';
$page_description = 'Get in touch with the HostingInfo team — questions, corrections, provider suggestions, and partnership inquiries.';

require __DIR__ . '/includes/header.php';
?>

<section class="hero">
    <div class="container">
        <span class="hero__eyebrow"><span class="dot"></span> We'd love to hear from you</span>
        <h1>Get in <span class="gradient-text">touch</span> with us.</h1>
        <p class="lead">Questions about a provider, a correction to suggest, or a partnership idea? Reach out and we'll get back to you.</p>
    </div>
</section>

<section class="section section--tight">
    <div class="container">
        <div class="contact-grid reveal">
            <a class="contact-card" href="mailto:hello@hostinginfo.online">
                <span class="contact-card__icon">✉️</span>
                <h3>Email us</h3>
                <p>hello@hostinginfo.online</p>
            </a>
            <div class="contact-card">
                <span class="contact-card__icon">🛠️</span>
                <h3>Corrections &amp; suggestions</h3>
                <p>Spotted outdated pricing or a provider we're missing? Email us the details and we'll review it.</p>
            </div>
            <div class="contact-card">
                <span class="contact-card__icon">🤝</span>
                <h3>Partnerships</h3>
                <p>Represent a hosting provider and want to be featured or updated? Let's talk.</p>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>

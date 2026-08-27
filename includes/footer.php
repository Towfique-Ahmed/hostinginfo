</main>

<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <a href="<?= url('') ?>" class="brand">Hosting<em>Info</em></a>
                <p>An independent reference for web hosting. We profile providers, track their pricing, and publish what we find — we do not sell hosting.</p>

                <form class="newsletter-form" id="newsletterForm">
                    <label class="field">
                        <span class="visually-hidden">Email address</span>
                        <input type="email" placeholder="you@example.com" required>
                    </label>
                    <button type="submit" class="btn btn--sm">Get the deals digest</button>
                </form>
                <p class="newsletter-note" id="newsletterNote" aria-live="polite"></p>
            </div>

            <div class="footer-col">
                <h4>Directory</h4>
                <a href="<?= url('providers') ?>">All providers</a>
                <a href="<?= url('providers', ['sort' => 'price']) ?>">Cheapest first</a>
                <a href="<?= url('deals') ?>">Current deals</a>
            </div>

            <div class="footer-col">
                <h4>Categories</h4>
                <?php foreach (array_slice(get_all_categories(), 0, 5) as $cat): ?>
                    <a href="<?= e(category_url($cat)) ?>"><?= e($cat) ?> hosting</a>
                <?php endforeach; ?>
            </div>

            <div class="footer-col">
                <h4>Masthead</h4>
                <a href="<?= url('about') ?>">About</a>
                <a href="<?= url('contact') ?>">Contact</a>
                <a href="<?= url('privacy-policy') ?>">Privacy policy</a>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?= date('Y') ?> HostingInfo — published by <a href="https://towfique.com" target="_blank" rel="noopener noreferrer">towfique.com</a>. Provider names and marks belong to their owners.</p>
            <p>Verify current pricing on the provider's own site before buying.</p>
        </div>
    </div>
</footer>

<div class="toast" id="toast" role="status" aria-live="polite"></div>

<script src="/assets/js/main.js" defer></script>
</body>
</html>

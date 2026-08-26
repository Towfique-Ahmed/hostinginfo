</main>

<footer class="site-footer">
    <div class="container footer-grid">
        <div class="footer-brand">
            <a href="/index.php" class="brand">
                <span class="brand__mark">🌐</span>
                <span class="brand__text">Host<em>Radar</em></span>
            </a>
            <p>An independent directory helping you discover, compare, and choose hosting providers from every corner of the world.</p>
            <div class="footer-socials">
                <a href="#" aria-label="X / Twitter" onclick="return false;">
                    <svg viewBox="0 0 24 24"><path d="M4 4l16 16M20 4L4 20"/></svg>
                </a>
                <a href="#" aria-label="GitHub" onclick="return false;">
                    <svg viewBox="0 0 24 24"><path d="M12 2a10 10 0 0 0-3.16 19.49c.5.09.68-.22.68-.48v-1.7c-2.78.6-3.37-1.34-3.37-1.34-.46-1.16-1.11-1.47-1.11-1.47-.91-.62.07-.6.07-.6 1 .07 1.53 1.03 1.53 1.03.9 1.53 2.36 1.09 2.93.83.09-.65.35-1.09.63-1.34-2.22-.25-4.56-1.11-4.56-4.94 0-1.1.39-1.99 1.03-2.69-.1-.25-.45-1.27.1-2.65 0 0 .84-.27 2.75 1.02a9.6 9.6 0 0 1 5 0c1.91-1.29 2.75-1.02 2.75-1.02.55 1.38.2 2.4.1 2.65.64.7 1.03 1.59 1.03 2.69 0 3.84-2.34 4.68-4.57 4.93.36.31.68.92.68 1.85v2.75c0 .26.18.58.69.48A10 10 0 0 0 12 2z"/></svg>
                </a>
                <a href="#" aria-label="LinkedIn" onclick="return false;">
                    <svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="3"/><path d="M7 10v7M7 7v.01M12 17v-4a2 2 0 0 1 4 0v4M12 13v4"/></svg>
                </a>
            </div>
        </div>

        <div class="footer-col">
            <h4>Explore</h4>
            <a href="/index.php">Home</a>
            <a href="/providers.php">All Providers</a>
            <a href="/deals.php">Hosting Deals</a>
        </div>

        <div class="footer-col">
            <h4>Categories</h4>
            <?php $cats = array_slice(get_all_categories(), 0, 5); ?>
            <?php foreach ($cats as $cat): ?>
                <a href="/providers.php?category=<?= e($cat) ?>"><?= e($cat) ?> Hosting</a>
            <?php endforeach; ?>
        </div>

        <div class="footer-col footer-col--newsletter">
            <h4>Stay in the loop</h4>
            <p>Get the best hosting deals dropped into your inbox. No spam, ever.</p>
            <form class="newsletter-form" id="newsletterForm">
                <input type="email" placeholder="you@example.com" required aria-label="Email address">
                <button type="submit" class="btn btn--primary btn--sm">Subscribe</button>
            </form>
            <p class="newsletter-note" id="newsletterNote" aria-live="polite"></p>
        </div>
    </div>

    <div class="container footer-bottom">
        <p>&copy; <?= date('Y') ?> HostRadar. All provider names and logos are trademarks of their respective owners.</p>
        <p>Built for informational purposes — always verify current pricing on the provider's official site.</p>
    </div>
</footer>

<div class="toast" id="toast" role="status" aria-live="polite"></div>

<script src="/assets/js/main.js" defer></script>
</body>
</html>

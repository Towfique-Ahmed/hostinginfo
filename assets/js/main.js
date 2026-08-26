(function () {
    'use strict';

    /* ---------------- Theme toggle ---------------- */
    var root = document.documentElement;
    var themeToggle = document.getElementById('themeToggle');
    var THEME_KEY = 'hostradar-theme';

    function applyTheme(theme) {
        root.setAttribute('data-theme', theme);
    }

    (function initTheme() {
        var saved = null;
        try { saved = localStorage.getItem(THEME_KEY); } catch (e) {}
        if (saved) {
            applyTheme(saved);
        } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches) {
            applyTheme('light');
        }
    })();

    if (themeToggle) {
        themeToggle.addEventListener('click', function () {
            var current = root.getAttribute('data-theme') === 'light' ? 'light' : 'dark';
            var next = current === 'light' ? 'dark' : 'light';
            applyTheme(next);
            try { localStorage.setItem(THEME_KEY, next); } catch (e) {}
        });
    }

    /* ---------------- Mobile nav ---------------- */
    var navToggle = document.getElementById('navToggle');
    var mainNav = document.getElementById('mainNav');
    if (navToggle && mainNav) {
        navToggle.addEventListener('click', function () {
            var isOpen = mainNav.classList.toggle('is-open');
            navToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });
        mainNav.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                mainNav.classList.remove('is-open');
                navToggle.setAttribute('aria-expanded', 'false');
            });
        });
    }

    /* ---------------- Toast helper ---------------- */
    var toastEl = document.getElementById('toast');
    var toastTimer = null;
    function showToast(message) {
        if (!toastEl) return;
        toastEl.textContent = message;
        toastEl.classList.add('is-visible');
        clearTimeout(toastTimer);
        toastTimer = setTimeout(function () {
            toastEl.classList.remove('is-visible');
        }, 2400);
    }

    /* ---------------- Copy coupon codes ---------------- */
    document.addEventListener('click', function (evt) {
        var btn = evt.target.closest('.copy-btn');
        if (!btn) return;
        evt.preventDefault();
        var code = btn.getAttribute('data-copy') || '';
        var done = function () {
            showToast('Coupon "' + code + '" copied to clipboard!');
            var original = btn.innerHTML;
            btn.classList.add('is-copied');
            setTimeout(function () { btn.classList.remove('is-copied'); }, 1500);
        };
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(code).then(done).catch(function () { fallbackCopy(code, done); });
        } else {
            fallbackCopy(code, done);
        }
    });

    function fallbackCopy(text, cb) {
        var ta = document.createElement('textarea');
        ta.value = text;
        ta.style.position = 'fixed';
        ta.style.opacity = '0';
        document.body.appendChild(ta);
        ta.select();
        try { document.execCommand('copy'); } catch (e) {}
        document.body.removeChild(ta);
        if (cb) cb();
    }

    /* ---------------- Newsletter (front-end only) ---------------- */
    var newsletterForm = document.getElementById('newsletterForm');
    var newsletterNote = document.getElementById('newsletterNote');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function (evt) {
            evt.preventDefault();
            if (newsletterNote) newsletterNote.textContent = "You're on the list! 🎉";
            newsletterForm.reset();
        });
    }

    /* ---------------- Countdown timers ---------------- */
    function pad(n) { return String(n).padStart(2, '0'); }

    function tickCountdowns() {
        var nodes = document.querySelectorAll('.countdown[data-expires]');
        nodes.forEach(function (node) {
            var expires = new Date(node.getAttribute('data-expires').replace(' ', 'T') + 'Z').getTime();
            var now = Date.now();
            var diff = expires - now;

            var d = node.querySelector('[data-unit="d"]');
            var h = node.querySelector('[data-unit="h"]');
            var m = node.querySelector('[data-unit="m"]');
            var s = node.querySelector('[data-unit="s"]');

            if (diff <= 0) {
                if (d) d.textContent = '00';
                if (h) h.textContent = '00';
                if (m) m.textContent = '00';
                if (s) s.textContent = '00';
                node.classList.add('is-expired');
                return;
            }

            var days = Math.floor(diff / 86400000);
            var hours = Math.floor((diff % 86400000) / 3600000);
            var mins = Math.floor((diff % 3600000) / 60000);
            var secs = Math.floor((diff % 60000) / 1000);

            if (d) d.textContent = pad(days);
            if (h) h.textContent = pad(hours);
            if (m) m.textContent = pad(mins);
            if (s) s.textContent = pad(secs);
        });
    }

    if (document.querySelector('.countdown[data-expires]')) {
        tickCountdowns();
        setInterval(tickCountdowns, 1000);
    }

    /* ---------------- Animated stat counters ---------------- */
    function animateCount(el) {
        var target = parseInt(el.getAttribute('data-count'), 10) || 0;
        var suffix = el.getAttribute('data-suffix') || '';
        var duration = 1200;
        var start = null;

        function step(ts) {
            if (!start) start = ts;
            var progress = Math.min((ts - start) / duration, 1);
            var eased = 1 - Math.pow(1 - progress, 3);
            el.textContent = Math.round(eased * target) + suffix;
            if (progress < 1) requestAnimationFrame(step);
        }
        requestAnimationFrame(step);
    }

    var statObserver = ('IntersectionObserver' in window) ? new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                animateCount(entry.target);
                statObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.4 }) : null;

    document.querySelectorAll('.stat-pill__num[data-count]').forEach(function (el) {
        if (statObserver) {
            statObserver.observe(el);
        } else {
            animateCount(el);
        }
    });

    /* ---------------- Scroll reveal ---------------- */
    var revealObserver = ('IntersectionObserver' in window) ? new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                revealObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12 }) : null;

    document.querySelectorAll('.reveal').forEach(function (el) {
        if (revealObserver) {
            revealObserver.observe(el);
        } else {
            el.classList.add('is-visible');
        }
    });

    /* ---------------- Provider card cursor glow ---------------- */
    document.querySelectorAll('.provider-card').forEach(function (card) {
        card.addEventListener('mousemove', function (evt) {
            var rect = card.getBoundingClientRect();
            card.style.setProperty('--mx', ((evt.clientX - rect.left) / rect.width * 100) + '%');
            card.style.setProperty('--my', ((evt.clientY - rect.top) / rect.height * 100) + '%');
        });
    });

    /* ---------------- Header shrink on scroll ---------------- */
    var header = document.getElementById('siteHeader');
    if (header) {
        var lastScroll = 0;
        window.addEventListener('scroll', function () {
            var scrolled = window.scrollY > 12;
            header.style.boxShadow = scrolled ? '0 8px 30px rgba(0,0,0,0.25)' : 'none';
            lastScroll = window.scrollY;
        }, { passive: true });
    }

    /* ---------------- Live filtering on /providers.php ---------------- */
    var grid = document.getElementById('providerGrid');
    if (grid) {
        var searchInput = document.getElementById('searchInput');
        var countryFilter = document.getElementById('countryFilter');
        var sortFilter = document.getElementById('sortFilter');
        var categoryTags = document.getElementById('categoryTags');
        var categoryInput = document.getElementById('categoryInput');
        var resultsCount = document.getElementById('resultsCount');
        var emptyState = document.getElementById('emptyState');
        var cards = Array.prototype.slice.call(grid.querySelectorAll('.provider-card'));

        var state = {
            q: (searchInput && searchInput.value || '').toLowerCase(),
            country: (countryFilter && countryFilter.value) || '',
            category: (categoryInput && categoryInput.value) || '',
            sort: (sortFilter && sortFilter.value) || 'rating'
        };

        function applyFilters() {
            var visibleCount = 0;
            cards.forEach(function (card) {
                var matchesQ = !state.q ||
                    card.dataset.name.indexOf(state.q) !== -1 ||
                    card.dataset.tagline.indexOf(state.q) !== -1 ||
                    card.dataset.country.toLowerCase().indexOf(state.q) !== -1;
                var matchesCountry = !state.country || card.dataset.country === state.country;
                var matchesCategory = !state.category || card.dataset.categories.split(',').indexOf(state.category) !== -1;
                var visible = matchesQ && matchesCountry && matchesCategory;
                card.style.display = visible ? '' : 'none';
                if (visible) visibleCount++;
            });

            var sorted = cards.filter(function (c) { return c.style.display !== 'none'; });
            sorted.sort(function (a, b) {
                if (state.sort === 'price') return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
                if (state.sort === 'name') return a.dataset.name.localeCompare(b.dataset.name);
                if (state.sort === 'founded') return parseInt(a.dataset.founded, 10) - parseInt(b.dataset.founded, 10);
                return parseFloat(b.dataset.rating) - parseFloat(a.dataset.rating);
            });
            sorted.forEach(function (card) { grid.appendChild(card); });

            if (resultsCount) resultsCount.textContent = visibleCount + ' provider' + (visibleCount === 1 ? '' : 's') + ' found';
            if (emptyState) emptyState.style.display = visibleCount === 0 ? '' : 'none';
        }

        var debounceTimer;
        if (searchInput) {
            searchInput.addEventListener('input', function () {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(function () {
                    state.q = searchInput.value.toLowerCase();
                    applyFilters();
                }, 150);
            });
        }
        if (countryFilter) {
            countryFilter.addEventListener('change', function () {
                state.country = countryFilter.value;
                applyFilters();
            });
        }
        if (sortFilter) {
            sortFilter.addEventListener('change', function () {
                state.sort = sortFilter.value;
                applyFilters();
            });
        }
        if (categoryTags) {
            categoryTags.addEventListener('click', function (evt) {
                var btn = evt.target.closest('.filter-tag');
                if (!btn) return;
                categoryTags.querySelectorAll('.filter-tag').forEach(function (t) { t.classList.remove('is-active'); });
                btn.classList.add('is-active');
                state.category = btn.getAttribute('data-category') || '';
                if (categoryInput) categoryInput.value = state.category;
                applyFilters();
            });
        }

        applyFilters();
    }

})();

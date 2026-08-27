/* HostingInfo — progressive enhancement only. Every page works without this file. */
(function () {
    'use strict';

    var root = document.documentElement;

    /* ---------------- Theme ---------------- */
    var THEME_KEY = 'hostinginfo-theme';
    var themeToggle = document.getElementById('themeToggle');

    (function initTheme() {
        /* Dark is the default reading environment; only an explicit choice overrides it. */
        var saved = null;
        try { saved = localStorage.getItem(THEME_KEY); } catch (e) {}
        root.setAttribute('data-theme', saved === 'light' ? 'light' : 'dark');
    })();

    if (themeToggle) {
        themeToggle.addEventListener('click', function () {
            var next = root.getAttribute('data-theme') === 'light' ? 'dark' : 'light';
            root.setAttribute('data-theme', next);
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

    /* ---------------- Toast ---------------- */
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

    document.addEventListener('click', function (evt) {
        var btn = evt.target.closest('.copy-btn');
        if (!btn) return;
        evt.preventDefault();
        var code = btn.getAttribute('data-copy') || '';
        var done = function () {
            showToast('Copied ' + code);
            btn.classList.add('is-copied');
            setTimeout(function () { btn.classList.remove('is-copied'); }, 1500);
        };
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(code).then(done).catch(function () { fallbackCopy(code, done); });
        } else {
            fallbackCopy(code, done);
        }
    });

    /* ---------------- Newsletter (front-end only) ---------------- */
    var newsletterForm = document.getElementById('newsletterForm');
    var newsletterNote = document.getElementById('newsletterNote');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function (evt) {
            evt.preventDefault();
            if (newsletterNote) newsletterNote.textContent = 'Thanks — you are on the list.';
            newsletterForm.reset();
        });
    }

    /* ---------------- Scroll reveal ---------------- */
    var prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var revealTargets = document.querySelectorAll('.reveal');

    if (prefersReduced || !('IntersectionObserver' in window)) {
        revealTargets.forEach(function (el) { el.classList.add('is-visible'); });
    } else {
        var revealObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.08, rootMargin: '0px 0px -40px' });
        revealTargets.forEach(function (el) { revealObserver.observe(el); });
    }

    /* ---------------- Directory table ---------------- */
    var tbody = document.getElementById('providerRows');
    if (tbody) {
        var table = document.getElementById('providerTable');
        var searchInput = document.getElementById('searchInput');
        var countryFilter = document.getElementById('countryFilter');
        var sortFilter = document.getElementById('sortFilter');
        var resultsCount = document.getElementById('resultsCount');
        var emptyState = document.getElementById('emptyState');
        var tableWrap = table ? table.parentNode : null;
        var rows = Array.prototype.slice.call(tbody.querySelectorAll('tr'));

        var state = {
            q: ((searchInput && searchInput.value) || '').toLowerCase(),
            country: (countryFilter && countryFilter.value) || '',
            sort: (sortFilter && sortFilter.value) || 'rating'
        };

        /* Which direction each key reads best in: bigger-is-better vs smaller-is-better. */
        var comparators = {
            price: function (a, b) { return parseFloat(a.dataset.price) - parseFloat(b.dataset.price); },
            name: function (a, b) { return a.dataset.name.localeCompare(b.dataset.name); },
            founded: function (a, b) { return parseInt(a.dataset.founded, 10) - parseInt(b.dataset.founded, 10); },
            uptime: function (a, b) { return parseFloat(b.dataset.uptime) - parseFloat(a.dataset.uptime); },
            rating: function (a, b) { return parseFloat(b.dataset.rating) - parseFloat(a.dataset.rating); }
        };

        function markSortedColumn() {
            if (!table) return;
            table.querySelectorAll('th[data-sort]').forEach(function (th) {
                th.classList.toggle('is-sorted', th.getAttribute('data-sort') === state.sort);
            });
        }

        function applyFilters() {
            var visible = [];

            rows.forEach(function (row) {
                var d = row.dataset;
                var matchesQ = !state.q ||
                    d.name.indexOf(state.q) !== -1 ||
                    d.tagline.indexOf(state.q) !== -1 ||
                    d.country.toLowerCase().indexOf(state.q) !== -1 ||
                    d.categories.toLowerCase().indexOf(state.q) !== -1;
                var matchesCountry = !state.country || d.country === state.country;
                var show = matchesQ && matchesCountry;
                row.hidden = !show;
                if (show) visible.push(row);
            });

            visible.sort(comparators[state.sort] || comparators.rating);

            /* Re-append in one pass, then number the visible rows. */
            var frag = document.createDocumentFragment();
            visible.forEach(function (row, i) {
                var rank = row.querySelector('.cell-rank');
                if (rank) rank.textContent = String(i + 1).padStart(2, '0');
                frag.appendChild(row);
            });
            tbody.appendChild(frag);

            if (resultsCount) {
                resultsCount.textContent = visible.length + ' provider' + (visible.length === 1 ? '' : 's');
            }
            if (emptyState) emptyState.style.display = visible.length ? 'none' : '';
            if (tableWrap) tableWrap.style.display = visible.length ? '' : 'none';
            markSortedColumn();
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
        /* Column headings double as sort controls. */
        if (table) {
            table.querySelectorAll('th[data-sort]').forEach(function (th) {
                th.setAttribute('tabindex', '0');
                th.setAttribute('role', 'button');
                function sortBy() {
                    state.sort = th.getAttribute('data-sort');
                    if (sortFilter) sortFilter.value = state.sort;
                    applyFilters();
                }
                th.addEventListener('click', sortBy);
                th.addEventListener('keydown', function (evt) {
                    if (evt.key === 'Enter' || evt.key === ' ') {
                        evt.preventDefault();
                        sortBy();
                    }
                });
            });
        }

        /* Anywhere in a row opens the profile, but let real links and text selection win. */
        tbody.addEventListener('click', function (evt) {
            if (evt.target.closest('a')) return;
            if (window.getSelection && String(window.getSelection())) return;
            var row = evt.target.closest('tr');
            if (row && row.dataset.href) window.location.href = row.dataset.href;
        });

        applyFilters();
    }

})();

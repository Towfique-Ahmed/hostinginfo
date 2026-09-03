<?php
/**
 * Expects (optional): $page_title, $page_description, $active_nav
 */
$page_title = $page_title ?? 'HostingInfo — Compare Web Hosting Providers Worldwide';
$page_description = $page_description ?? 'An independent reference for web hosting: compare providers on price, uptime and rating, and track the discounts worth using.';
$active_nav = $active_nav ?? '';
$robots = $robots ?? 'index, follow';
?><!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="google-site-verification" content="pyd7LfaT8PnVx-ikVWbTWmfSJkmvH1Mtl4AixvGcnAE" />
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-K9HE23EXS9"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-K9HE23EXS9');
</script>
<title><?= e($page_title) ?></title>
<meta name="description" content="<?= e($page_description) ?>">
<meta name="robots" content="<?= e($robots) ?>">
<link rel="canonical" href="<?= e(canonical_url()) ?>">
<link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 64 64%22><rect width=%2264%22 height=%2264%22 rx=%228%22 fill=%22%230a0a0c%22/><text x=%2232%22 y=%2245%22 text-anchor=%22middle%22 font-family=%22Georgia,serif%22 font-size=%2240%22 fill=%22%23e9ab4c%22>H</text></svg>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400..700;1,9..144,400..600&family=Inter+Tight:wght@400;500;600&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/style.css">
<meta property="og:type" content="website">
<meta property="og:site_name" content="HostingInfo">
<meta property="og:title" content="<?= e($page_title) ?>">
<meta property="og:description" content="<?= e($page_description) ?>">
<meta property="og:url" content="<?= e(canonical_url()) ?>">
<?php if (!empty($og_image)): ?>
<meta property="og:image" content="<?= e($og_image) ?>">
<meta name="twitter:image" content="<?= e($og_image) ?>">
<?php endif; ?>
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="<?= e($page_title) ?>">
<meta name="twitter:description" content="<?= e($page_description) ?>">
<?php if (!empty($json_ld)): ?>
<script type="application/ld+json"><?= $json_ld ?></script>
<?php endif; ?>
</head>
<body>

<header class="site-header" id="siteHeader">
    <div class="container site-header__inner">
        <a href="<?= url('') ?>" class="brand">Hosting<em>Info</em></a>

        <nav class="main-nav" id="mainNav" aria-label="Main navigation">
            <a href="<?= url('providers') ?>" class="<?= $active_nav === 'providers' ? 'is-active' : '' ?>">Directory</a>
            <a href="<?= url('deals') ?>" class="<?= $active_nav === 'deals' ? 'is-active' : '' ?>">Deals</a>
            <a href="<?= url('about') ?>" class="<?= $active_nav === 'about' ? 'is-active' : '' ?>">About</a>
        </nav>

        <div class="site-header__actions">
            <button type="button" class="icon-btn" id="themeToggle" aria-label="Toggle light and dark theme" title="Toggle theme">
                <svg class="icon-sun" viewBox="0 0 24 24"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/></svg>
                <svg class="icon-moon" viewBox="0 0 24 24"><path d="M21 12.8A9 9 0 1 1 11.2 3 7 7 0 0 0 21 12.8z"/></svg>
            </button>
            <a href="<?= url('providers') ?>" class="btn btn--sm site-header__cta">Compare providers</a>
            <button type="button" class="icon-btn nav-toggle" id="navToggle" aria-label="Toggle menu" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
</header>

<main>

<?php
/**
 * Expects (optional): $page_title, $page_description, $active_nav
 */
$page_title = $page_title ?? 'HostingInfo — Discover Hosting Providers Worldwide';
$page_description = $page_description ?? 'Compare hosting providers from around the world, read in-depth profiles, and grab the best hosting deals in one place.';
$active_nav = $active_nav ?? '';
$robots = $robots ?? 'index, follow';
?><!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
<meta name="google-site-verification" content="pyd7LfaT8PnVx-ikVWbTWmfSJkmvH1Mtl4AixvGcnAE" />
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-K9HE23EXS9"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-K9HE23EXS9');
</script>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($page_title) ?></title>
<meta name="description" content="<?= e($page_description) ?>">
<meta name="robots" content="<?= e($robots) ?>">
<link rel="canonical" href="<?= e(canonical_url()) ?>">
<link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🌐</text></svg>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/style.css">
<meta property="og:type" content="website">
<meta property="og:title" content="<?= e($page_title) ?>">
<meta property="og:description" content="<?= e($page_description) ?>">
<meta property="og:url" content="<?= e(canonical_url()) ?>">
</head>
<body>
<div class="bg-glow bg-glow--1" aria-hidden="true"></div>
<div class="bg-glow bg-glow--2" aria-hidden="true"></div>
<div class="noise-overlay" aria-hidden="true"></div>

<header class="site-header" id="siteHeader">
    <div class="container site-header__inner">
        <a href="<?= url('') ?>" class="brand">
            <span class="brand__mark">🌐</span>
            <span class="brand__text">Hosting<em>Info</em></span>
        </a>

        <nav class="main-nav" id="mainNav">
            <a href="<?= url('') ?>" class="<?= $active_nav === 'home' ? 'is-active' : '' ?>">Home</a>
            <a href="<?= url('providers') ?>" class="<?= $active_nav === 'providers' ? 'is-active' : '' ?>">Providers</a>
            <a href="<?= url('deals') ?>" class="<?= $active_nav === 'deals' ? 'is-active' : '' ?>">Hosting Deals</a>
        </nav>

        <div class="site-header__actions">
            <button type="button" class="icon-btn" id="themeToggle" aria-label="Toggle light/dark theme" title="Toggle theme">
                <svg class="icon-sun" viewBox="0 0 24 24"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/></svg>
                <svg class="icon-moon" viewBox="0 0 24 24"><path d="M21 12.8A9 9 0 1 1 11.2 3 7 7 0 0 0 21 12.8z"/></svg>
            </button>
            <a href="<?= url('providers') ?>" class="btn btn--primary btn--sm site-header__cta">Compare Now</a>
            <button type="button" class="icon-btn nav-toggle" id="navToggle" aria-label="Toggle menu" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
</header>

<main>

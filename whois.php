<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

$active_nav = 'tools';

/**
 * Minimal WHOIS servers for common TLDs. The target host is always looked up
 * from this fixed list — never taken from user input — so a lookup can only
 * ever reach a server we chose ourselves.
 */
const WHOIS_SERVERS = [
    'com' => 'whois.verisign-grs.com', 'net' => 'whois.verisign-grs.com',
    'org' => 'whois.pir.org', 'info' => 'whois.afilias.net',
    'biz' => 'whois.biz', 'io' => 'whois.nic.io',
    'co' => 'whois.nic.co', 'me' => 'whois.nic.me',
    'dev' => 'whois.nic.google', 'app' => 'whois.nic.google',
    'xyz' => 'whois.nic.xyz', 'online' => 'whois.nic.online',
    'site' => 'whois.nic.site', 'store' => 'whois.nic.store',
    'tech' => 'whois.nic.tech', 'us' => 'whois.nic.us',
    'in' => 'whois.registry.in', 'uk' => 'whois.nic.uk',
];

$domain = strtolower(trim((string)($_GET['domain'] ?? '')));
$result = null;
$error = null;

if ($domain !== '') {
    if (!preg_match('/^(?!-)[a-z0-9-]{1,63}(?<!-)(\.(?!-)[a-z0-9-]{1,63}(?<!-))*\.[a-z]{2,24}$/', $domain)) {
        $error = 'That doesn\'t look like a valid domain name.';
    } else {
        $tld = substr((string) strrchr($domain, '.'), 1);
        $server = WHOIS_SERVERS[$tld] ?? null;
        if ($server === null) {
            $error = 'We don\'t have a WHOIS server on file for the ".' . $tld . '" TLD yet.';
        } else {
            $fh = @fsockopen($server, 43, $errno, $errstr, 6);
            if ($fh === false) {
                $error = 'The WHOIS server did not respond. Try again in a moment.';
            } else {
                stream_set_timeout($fh, 6);
                fwrite($fh, $domain . "\r\n");
                $response = '';
                while (!feof($fh) && strlen($response) < 100000) {
                    $chunk = fread($fh, 4096);
                    if ($chunk === false) {
                        break;
                    }
                    $response .= $chunk;
                }
                fclose($fh);
                $result = trim($response) !== '' ? trim($response) : null;
                if ($result === null) {
                    $error = 'The WHOIS server returned nothing for that domain.';
                }
            }
        }
    }
}

$page_title = 'Whois Lookup — Check Domain Registration | HostingInfo';
$page_description = 'Look up who a domain is registered to, its registrar, and its creation and expiry dates.';

require __DIR__ . '/includes/header.php';
?>

<div class="container container--narrow">

    <section class="page-head">
        <nav class="breadcrumb" aria-label="Breadcrumb">
            <a href="<?= url('') ?>">Home</a> <span>/</span>
            <a href="<?= url('tools') ?>">Tools</a> <span>/</span>
            <span>Whois</span>
        </nav>
        <span class="kicker">Tools</span>
        <h1>Whois <em>lookup</em>.</h1>
        <p class="lede">Check a domain's registrar, registration date and expiry straight from the registry.</p>
    </section>

    <form class="toolbar" method="get" action="<?= url('tools/whois') ?>">
        <label class="field" style="flex:1">
            <span class="visually-hidden">Domain name</span>
            <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3" stroke-linecap="round"/></svg>
            <input type="text" name="domain" value="<?= e($domain) ?>" placeholder="example.com" autocapitalize="off" autocorrect="off" spellcheck="false">
        </label>
        <button type="submit" class="btn btn--primary btn--sm">Look up</button>
    </form>

    <?php if ($error): ?>
        <div class="empty-state" style="margin-top:24px"><h3>Couldn't complete that lookup</h3><p><?= e($error) ?></p></div>
    <?php elseif ($result): ?>
        <section class="section section--tight">
            <div class="section-head"><div class="section-head__title"><h2>Result for <?= e($domain) ?></h2></div></div>
            <pre class="whois-result"><?= e($result) ?></pre>
        </section>
    <?php endif; ?>

    <p class="prose" style="padding-top:24px"><small>Supported TLDs: <?= e(implode(', ', array_map(fn($t) => '.' . $t, array_keys(WHOIS_SERVERS)))) ?>. Results come straight from the registry's own WHOIS server and are not stored by HostingInfo.</small></p>

</div>

<?php require __DIR__ . '/includes/footer.php'; ?>

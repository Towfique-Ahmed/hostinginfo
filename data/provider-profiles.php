<?php
/**
 * Deep per-provider profiles.
 *
 * The main dataset (data/providers.php) carries the comparison facts — price,
 * rating, plans — that the directory and cards need. This file carries the
 * long-form detail a visitor wants once they have landed on a single provider
 * and stopped comparing: who owns the company, what the stack actually is,
 * what renewal costs, who should walk away.
 *
 * Keyed by provider slug and merged in functions.php. Every key is optional —
 * a provider with no entry here still renders, just with fewer sections.
 *
 * Schema
 *   overview       string   Two or three paragraphs of editorial background.
 *   company        array    Label => value rows (ownership, HQ, scale).
 *   timeline       array    [['year' => int, 'event' => string], ...]
 *   hosting_types  array    [['name' => string, 'from' => string, 'note' => string], ...]
 *   specs          array    Label => value rows for the technical stack.
 *   performance    string   What the infrastructure means in practice.
 *   security       array    Security and compliance bullet points.
 *   pricing_notes  array    Renewal, billing term and add-on caveats.
 *   migration      string   How sites move in.
 *   not_for        array    Audiences that should look elsewhere.
 *   verdict        string   Closing recommendation.
 */

return [

    'hostinger' => [
        'overview' => 'Hostinger started in 2004 in Kaunas, Lithuania as a free host called Hosting24 and 000webhost, and spent the next two decades converting that free-tier traffic into one of the largest paid hosting bases in the world. It now serves upwards of three million customers in 150 countries and does something few budget hosts attempt: it builds its own control panel rather than licensing cPanel, which is how it keeps the entry price near two dollars a month. The panel, hPanel, is the single biggest reason people either love or leave the company. It is cleaner and faster than cPanel for someone setting up a first site, and it is missing knobs a systems administrator would expect. Hostinger has decided, deliberately, that the first group is bigger than the second.

Under the hood the shared platform runs LiteSpeed rather than Apache, with the LSCache WordPress plugin wired in by default, and storage moved to NVMe on the Business tier and above. That combination is why a Hostinger shared plan regularly benchmarks close to hosts charging four times as much. The caveat is density: shared hosting is shared, and Hostinger packs accounts efficiently. Performance is excellent until a neighbour has a bad day.

The company has also pushed hard into adjacent products, including a website builder, AI site generation, managed email and a cloud tier that is really a resource-isolated container rather than a true VPS. For a first site, a portfolio, a small shop or a client site on a tight budget, it is one of the strongest values on the market. For anything where you would need to phone a human at three in the morning, it is not.',
        'company' => [
            'Ownership'    => 'Privately held, founder-led',
            'Headquarters' => 'Kaunas, Lithuania',
            'Founded'      => '2004 (as Hosting Media)',
            'Scale'        => '3 million+ customers across 150+ countries',
            'Sister brands'=> 'Hostinger, Hosting24, 000webhost, Zyro (builder)',
        ],
        'timeline' => [
            ['year' => 2004, 'event' => 'Founded in Lithuania as Hosting Media.'],
            ['year' => 2007, 'event' => 'Launches 000webhost, a free hosting service that becomes a major acquisition funnel.'],
            ['year' => 2011, 'event' => 'Rebrands to Hostinger and begins international expansion.'],
            ['year' => 2019, 'event' => 'Moves the shared platform to LiteSpeed and ships the hPanel control panel.'],
            ['year' => 2023, 'event' => 'Rolls out NVMe storage and AI-assisted site building across the shared range.'],
        ],
        'hosting_types' => [
            ['name' => 'Shared hosting',    'from' => '$1.99/mo', 'note' => 'Single, Premium and Business tiers on LiteSpeed with hPanel.'],
            ['name' => 'WordPress hosting', 'from' => '$2.99/mo', 'note' => 'Same hardware plus LSCache, auto-updates and a staging tool on Business.'],
            ['name' => 'Cloud hosting',     'from' => '$7.99/mo', 'note' => 'Resource-isolated containers with dedicated CPU and RAM, still managed.'],
            ['name' => 'VPS hosting',       'from' => '$4.99/mo', 'note' => 'KVM virtualisation with full root access and a choice of Linux images.'],
            ['name' => 'Email hosting',     'from' => '$0.99/mo', 'note' => 'Standalone mailboxes, sold separately from web plans.'],
        ],
        'specs' => [
            'Control panel'   => 'hPanel (custom, not cPanel)',
            'Web server'      => 'LiteSpeed Enterprise with LSCache',
            'Storage'         => 'SSD on Single/Premium, NVMe on Business and above',
            'PHP versions'    => 'PHP 7.4 through 8.3, switchable per site',
            'Databases'       => 'MySQL/MariaDB, unlimited on Premium and above',
            'Backups'         => 'Weekly on Premium, daily on Business and Cloud',
            'Staging'         => 'One-click, Business tier and above',
            'SSH access'      => 'Yes, on Business and above',
            'Free migration'  => 'Yes, automated WordPress migration plus assisted transfers',
            'CDN'             => 'Included on Business and Cloud tiers',
            'Email accounts'  => 'Free mailboxes bundled with Premium and above',
            'Uptime SLA'      => '99.9% contractual',
        ],
        'performance' => 'LiteSpeed plus LSCache is the difference-maker. On a cached WordPress page a Hostinger Business plan typically returns a time to first byte in the 200 to 400 millisecond range from a data centre near the visitor, which is competitive with managed hosts charging thirty dollars a month. Uncached and database-heavy pages are where the shared-tier CPU limits show, and a busy WooCommerce catalogue will hit the entry plan ceilings well before the storage runs out. Picking the data centre closest to your audience at signup matters more here than on hosts with a real edge network, because the CDN only appears on the higher tiers.',
        'security' => [
            'Free unlimited Let\'s Encrypt SSL with automatic renewal',
            'Web application firewall and in-house malware scanner on all plans',
            'Two-factor authentication on the account, and per-site access logs',
            'Automatic daily or weekly backups depending on tier, restorable from hPanel',
            'DDoS protection at the network edge, plus Cloudflare-protected nameservers',
        ],
        'pricing_notes' => [
            'The headline price requires a 48-month prepayment; 12-month terms cost meaningfully more per month.',
            'Renewal is the real cost. Expect roughly a two to three times increase when the introductory term ends.',
            'The free domain applies to the first year only on 12-month terms and longer.',
            'The 30-day money-back guarantee excludes domain registrations and some add-ons.',
        ],
        'migration' => 'WordPress sites move automatically through a plugin-driven importer in hPanel, and the support team will move non-WordPress sites manually on request. Migrations are free and generally finish within 24 hours, though Hostinger does not offer a white-glove scheduled-cutover service the way Kinsta or WP Engine do.',
        'not_for' => [
            'Anyone who needs telephone support — there is none, only chat and tickets',
            'High-traffic stores that will outgrow shared CPU limits within a year',
            'Teams that require cPanel or WHM specifically for client handover',
            'Buyers who cannot commit to a multi-year prepayment to get the advertised price',
        ],
        'verdict' => 'The best price-to-performance ratio in mainstream shared hosting, provided you go in with open eyes about the multi-year prepayment and the renewal jump. Choose the Business tier rather than Single or Premium: NVMe storage, daily backups, staging and the CDN are the parts that make the platform genuinely fast, and they all start there.',
    ],

    'bluehost' => [
        'overview' => 'Bluehost is a 1996 Utah company that became, for a generation of site owners, the default answer to "where do I host WordPress." That is largely because WordPress.org has listed it as a recommended host for well over a decade, a placement that sends enormous volumes of first-time builders its way. The company was acquired by Endurance International Group in 2010 and now sits inside Newfold Digital, which also owns HostGator, Network Solutions and Web.com.

What you get for the recommendation is a genuinely smooth onboarding experience. Signup installs WordPress, walks you through a theme and plugin setup, and hands you a working site faster than almost any competitor. What you also get is the Newfold commercial model: a low introductory rate, an aggressive add-on checkout, and a renewal price that is roughly three times the advertised one. Neither of those facts is hidden, but they surprise people every day.

Technically the platform has improved more than its reputation suggests. Bluehost moved shared accounts onto NVMe storage, added a Cloudflare-backed CDN and an object cache on higher tiers, and rebuilt the customer dashboard away from raw cPanel into a WordPress-first interface with cPanel still available underneath. It is no longer a slow host. It is a mid-table host with excellent WordPress ergonomics and a pricing structure that rewards reading the fine print.',
        'company' => [
            'Ownership'     => 'Newfold Digital (formerly Endurance International Group)',
            'Headquarters'  => 'Draper, Utah, United States',
            'Founded'       => '1996',
            'Scale'         => 'Over 2 million websites hosted',
            'Sister brands' => 'HostGator, Network Solutions, Web.com, Domain.com',
        ],
        'timeline' => [
            ['year' => 1996, 'event' => 'Founded by Matt Heaton and Danny Ashworth in Utah.'],
            ['year' => 2005, 'event' => 'Named an officially recommended host by WordPress.org.'],
            ['year' => 2010, 'event' => 'Acquired by Endurance International Group.'],
            ['year' => 2021, 'event' => 'Endurance rebrands as Newfold Digital following a private-equity buyout.'],
            ['year' => 2023, 'event' => 'Launches a rebuilt WordPress-first dashboard and moves shared plans to NVMe.'],
        ],
        'hosting_types' => [
            ['name' => 'Shared hosting',        'from' => '$2.95/mo',  'note' => 'Basic through Pro, all with free domain and SSL for year one.'],
            ['name' => 'Managed WordPress',     'from' => '$9.95/mo',  'note' => 'WP Pro tier with staging, object caching and daily backups.'],
            ['name' => 'WooCommerce hosting',   'from' => '$9.95/mo',  'note' => 'Store-ready stack with payment and shipping plugins preinstalled.'],
            ['name' => 'VPS hosting',           'from' => '$31.99/mo', 'note' => 'Root access, dedicated resources, cPanel included.'],
            ['name' => 'Dedicated servers',     'from' => '$91.98/mo', 'note' => 'Single-tenant hardware with RAID storage and full root.'],
        ],
        'specs' => [
            'Control panel'  => 'Custom Bluehost dashboard with cPanel underneath',
            'Web server'     => 'Apache with NGINX reverse proxy',
            'Storage'        => 'NVMe SSD across current shared plans',
            'PHP versions'   => 'PHP 7.4 through 8.2, per-account switch',
            'Backups'        => 'CodeGuard Basic bundled from Choice Plus upward',
            'Staging'        => 'Yes, one-click on WordPress plans',
            'SSH access'     => 'Yes, on all shared plans',
            'Free migration' => 'Free automated WordPress migration; paid for complex sites',
            'CDN'            => 'Cloudflare integration on all plans',
            'Email accounts' => 'Included, with a free Google Workspace trial month',
            'Uptime SLA'     => '99.9% target, no financial credit',
        ],
        'performance' => 'Bluehost hosts everything from a small number of United States data centres, with Utah as the primary site. That is the defining performance fact: a visitor in London or Singapore is paying a transatlantic or transpacific round trip on every uncached request, and the bundled Cloudflare CDN only papers over static assets. For a United States audience the platform is solidly quick, with cached WordPress responses typically landing in the 300 to 600 millisecond range. For a genuinely global audience, a host with regional data centres will beat it without trying.',
        'security' => [
            'Free SSL on every domain, provisioned automatically',
            'Free domain privacy on Choice Plus and Pro tiers',
            'CodeGuard Basic daily backup and one-click restore on higher tiers',
            'SiteLock malware scanning offered as a paid add-on, not bundled',
            'Two-factor authentication and account-level access controls',
        ],
        'pricing_notes' => [
            'Advertised pricing assumes a 36-month prepayment paid up front.',
            'Renewal runs roughly three times the introductory rate — budget for it before year two.',
            'Checkout preselects add-ons including domain privacy and SiteLock; uncheck what you do not want.',
            'The 30-day money-back guarantee does not cover the free domain, which is billed if you refund.',
        ],
        'migration' => 'Bluehost includes a free automated WordPress migration through a plugin, and will move one site manually for free on some plans. Complex or non-WordPress migrations are handled by a paid service. There is no scheduled zero-downtime cutover, so plan the DNS switch during a quiet window yourself.',
        'not_for' => [
            'Sites whose audience is mostly outside North America',
            'Buyers who dislike upsell-heavy checkouts and renewal cliffs',
            'Developers who want modern tooling such as WP-CLI-first workflows and Git deploys',
            'Anyone needing a contractual uptime credit rather than a target',
        ],
        'verdict' => 'Still the smoothest path from "I want a WordPress site" to a working WordPress site, and the official recommendation is not undeserved on ergonomics. Buy it for a United States audience, buy the Choice Plus tier so backups and domain privacy are included, and set a calendar reminder before renewal so the price increase is a decision rather than a surprise.',
    ],

    'siteground' => [
        'overview' => 'SiteGround is a Bulgarian company founded in 2004 by university students and grown, without outside acquisition, into one of the most technically respected hosts in the shared and managed WordPress market. In 2020 it did something almost no host its size has done: it migrated its entire fleet onto Google Cloud Platform and abandoned cPanel in favour of a control panel it wrote itself, Site Tools. Both moves cost it customers in the short term and both look correct in hindsight.

The engineering culture is the product. SiteGround maintains its own caching stack (SuperCacher, now backed by NGINX Direct Delivery and a Memcached layer), its own WordPress plugin, its own AI anti-bot system that blocks millions of login attempts a day, and a container-based account isolation model that means a noisy neighbour genuinely cannot take your site down. Support is the other half of the reputation: chat responses in under a minute, staffed by people who can actually read a stack trace.

The catch is price and storage. SiteGround is not a budget host once you renew, and its plans meter storage and monthly visits rather than pretending to be unlimited. That honesty is a feature for anyone who has been burned by a fair-use policy, and a genuine constraint for a media-heavy site.',
        'company' => [
            'Ownership'    => 'Privately held, independent, founder-led',
            'Headquarters' => 'Sofia, Bulgaria, with offices in Madrid and London',
            'Founded'      => '2004',
            'Scale'        => 'Around 2.8 million domains hosted',
            'Infrastructure' => 'Runs entirely on Google Cloud Platform since 2020',
        ],
        'timeline' => [
            ['year' => 2004, 'event' => 'Founded in Sofia by a small group of university students.'],
            ['year' => 2011, 'event' => 'Becomes an officially recommended WordPress.org host.'],
            ['year' => 2018, 'event' => 'Ships Site Tools, a ground-up replacement for cPanel.'],
            ['year' => 2020, 'event' => 'Completes migration of the whole fleet to Google Cloud Platform.'],
            ['year' => 2022, 'event' => 'Adds NGINX Direct Delivery and an AI anti-bot layer across all plans.'],
        ],
        'hosting_types' => [
            ['name' => 'Shared hosting',     'from' => '$2.99/mo',  'note' => 'StartUp, GrowBig and GoGeek, priced by visits and storage.'],
            ['name' => 'Managed WordPress',  'from' => '$2.99/mo',  'note' => 'Same plans with the SiteGround Optimizer plugin and auto-updates.'],
            ['name' => 'WooCommerce hosting','from' => '$2.99/mo',  'note' => 'WordPress stack preconfigured with WooCommerce and a storefront theme.'],
            ['name' => 'Cloud hosting',      'from' => '$100/mo',   'note' => 'Fully managed, resizable CPU and RAM, autoscaling available.'],
            ['name' => 'Reseller hosting',   'from' => '$7.99/mo',  'note' => 'GoGeek and Cloud tiers with white-label client access and billing.'],
        ],
        'specs' => [
            'Control panel'  => 'Site Tools (custom, replaced cPanel)',
            'Web server'     => 'NGINX with Direct Delivery, Apache backend',
            'Storage'        => 'SSD on Google Cloud persistent disks',
            'PHP versions'   => 'Ultrafast PHP builds, 7.4 through 8.3',
            'Caching'        => 'SuperCacher: NGINX static, dynamic cache and Memcached',
            'Backups'        => 'Daily, 30 copies retained, on-demand backups on GoGeek',
            'Staging'        => 'Yes, on GrowBig and GoGeek, with one-click push to live',
            'SSH access'     => 'Yes, plus WP-CLI, Git and Composer',
            'Free migration' => 'Unlimited free automated migrations, one manual transfer on GrowBig+',
            'CDN'            => 'SiteGround CDN included, premium tier optional',
            'Collaboration'  => 'Client and collaborator roles with scoped access',
            'Uptime SLA'     => '99.9% with an uptime credit policy',
        ],
        'performance' => 'This is a genuinely fast platform and the numbers hold up under load. Google Cloud premium-tier networking, NGINX Direct Delivery for static files and a well-tuned dynamic cache combine to put cached WordPress time to first byte in the 150 to 300 millisecond band from a nearby region. The six data centre choices, spanning three continents, mean you can put the origin close to your audience rather than relying solely on a CDN. Where SiteGround limits you is not speed but headroom: plans are capped by monthly visits, and a traffic spike is a plan upgrade conversation rather than a silent slowdown.',
        'security' => [
            'AI anti-bot system blocking millions of brute-force attempts daily across the fleet',
            'Account isolation via Linux containers, so a compromised neighbour cannot reach you',
            'Daily backups with 30-day retention and self-service restore, included on all plans',
            'Free Let\'s Encrypt and wildcard SSL, with automatic HTTPS enforcement',
            'Custom web application firewall rules written in-house and pushed fleet-wide within hours of a disclosed WordPress vulnerability',
            'Two-factor authentication and scoped collaborator permissions',
        ],
        'pricing_notes' => [
            'Introductory pricing applies to the first term only; renewal is roughly three to four times higher.',
            'Plans are metered by monthly visits and storage — check both against your actual traffic.',
            'The Cloud tier starts near $100 a month, so there is a large gap between shared and cloud.',
            '30-day money-back guarantee on shared plans, 14 days on cloud.',
        ],
        'migration' => 'The SiteGround Migrator plugin handles WordPress sites automatically and without downtime in most cases, and GrowBig and GoGeek customers get one professional manual transfer for sites the plugin cannot handle. Staging plus one-click push means you can rehearse the cutover before pointing DNS.',
        'not_for' => [
            'Budget buyers — renewal pricing is squarely premium',
            'Media-heavy sites that will run into the storage caps',
            'Anyone who specifically needs cPanel or WHM for client handover',
            'Sites needing a cheap step up from shared, given the jump to the cloud tier',
        ],
        'verdict' => 'The best-engineered shared host in the mainstream market, and the one to pick when support quality and security posture matter more than the monthly line item. GrowBig is the value sweet spot: staging, on-demand backups and the full cache stack. Budget for the renewal, or move before it lands.',
    ],

    'dreamhost' => [
        'overview' => 'DreamHost has been running since 1997, is employee-owned, and behaves like a company with nobody to answer to but its customers, for better and for worse. It is one of only three hosts officially recommended by WordPress.org, it publishes an unusually clear privacy stance, it has fought subpoenas in court on behalf of its users, and it offers a 97-day money-back guarantee that no competitor comes close to matching.

The technical platform is solid rather than spectacular. Shared plans use a custom control panel instead of cPanel, include unlimited bandwidth with no fair-use asterisk, and ship free domain privacy on every registration rather than selling it back to you. DreamPress, the managed WordPress tier, puts each site on its own virtual server with built-in caching and is a genuinely good product at its price. There is also DreamCompute, an OpenStack-based cloud, and DreamObjects, an S3-compatible object store, which together make DreamHost more of a small cloud provider than a typical shared host.

What you will not get is hand-holding. There is no phone support on standard plans, callbacks are a paid extra, and the control panel is functional rather than delightful. DreamHost assumes you are reasonably competent and prices accordingly.',
        'company' => [
            'Ownership'    => 'Employee-owned, independent since 1997',
            'Headquarters' => 'Los Angeles, California, United States',
            'Founded'      => '1997',
            'Scale'        => 'Over 1.5 million sites and 750,000 WordPress installs',
            'Notable'      => 'One of three hosts recommended by WordPress.org',
        ],
        'timeline' => [
            ['year' => 1997, 'event' => 'Founded by four Harvey Mudd College undergraduates.'],
            ['year' => 2006, 'event' => 'Introduces the industry-leading 97-day money-back guarantee.'],
            ['year' => 2012, 'event' => 'Launches DreamObjects S3-compatible storage and DreamCompute cloud.'],
            ['year' => 2017, 'event' => 'Publicly challenges a United States government warrant for visitor data and wins narrowing of its scope.'],
            ['year' => 2021, 'event' => 'Rebuilds DreamPress on isolated virtual servers with built-in object caching.'],
        ],
        'hosting_types' => [
            ['name' => 'Shared hosting',    'from' => '$2.59/mo',  'note' => 'Starter and Unlimited, both with unmetered bandwidth.'],
            ['name' => 'DreamPress managed','from' => '$16.95/mo', 'note' => 'Isolated VPS per site with built-in caching and Jetpack Premium.'],
            ['name' => 'VPS hosting',       'from' => '$10/mo',    'note' => 'Managed VPS with scalable RAM, no root by default.'],
            ['name' => 'Dedicated servers', 'from' => '$149/mo',   'note' => 'Fully managed single-tenant hardware with root access.'],
            ['name' => 'DreamCompute cloud','from' => '$4.50/mo',  'note' => 'OpenStack instances billed hourly, developer oriented.'],
        ],
        'specs' => [
            'Control panel'  => 'Custom DreamHost panel (no cPanel)',
            'Web server'     => 'Apache or NGINX depending on plan',
            'Storage'        => 'SSD across shared and DreamPress',
            'PHP versions'   => 'PHP 7.4 through 8.2',
            'Bandwidth'      => 'Unmetered, with no published fair-use ceiling',
            'Backups'        => 'Daily automated, self-service restore from the panel',
            'Staging'        => 'One-click on DreamPress',
            'SSH access'     => 'Yes, with SFTP and WP-CLI',
            'Free migration' => 'Automated WordPress migration plugin; manual transfer is paid',
            'Domain privacy' => 'Free and permanent on all registrations',
            'Email'          => 'Paid add-on on Starter, included on Unlimited',
            'Uptime SLA'     => '100% uptime guarantee with service credits',
        ],
        'performance' => 'Two United States data centres, in California and Virginia, mean DreamHost is fastest for a North American audience and merely adequate elsewhere unless you put a CDN in front. DreamPress is the performance story worth paying for: because each site gets its own isolated virtual machine with a dedicated memory allocation and built-in object caching, it holds up under traffic far better than any shared plan, and it does not suffer the neighbour problem at all. On plain shared hosting, expect competent mid-table numbers rather than benchmark wins.',
        'security' => [
            'Free Let\'s Encrypt SSL on every domain including subdomains',
            'Free lifetime WHOIS domain privacy, not an upsell',
            'Automated daily backups with one-click restore',
            'Multi-factor authentication and per-user panel privileges',
            'A published record of resisting overbroad government data requests',
            'Optional DreamShield malware scanning as a paid add-on',
        ],
        'pricing_notes' => [
            'Month-to-month billing is available at a higher rate, unusual among budget hosts.',
            'The three-year term gets the headline price; renewal increases are milder than at most competitors.',
            'Email hosting is a separate charge on the Starter plan.',
            'The 97-day money-back guarantee applies to shared plans paid by credit card.',
        ],
        'migration' => 'A free automated plugin moves WordPress sites in, and DreamPress includes a migration path with staging so you can validate before cutting over. Non-WordPress migrations are a paid professional service. DreamHost does not offer unlimited free manual migrations the way Verpex or ChemiCloud do.',
        'not_for' => [
            'Anyone who wants to pick up a phone and reach support without paying for a callback',
            'cPanel-dependent workflows or agencies handing servers to clients',
            'Audiences concentrated outside North America',
            'Buyers who want a polished, modern control panel experience',
        ],
        'verdict' => 'The host to choose on principle as much as on specification: employee-owned, privacy-forward, honest about what is included, and backed by a 97-day guarantee that removes all risk from trying it. Take DreamPress rather than shared if the site matters, and accept that support is chat and tickets only.',
    ],

    'a2-hosting' => [
        'overview' => 'A2 Hosting, founded in Ann Arbor, Michigan in 2001 as Iniquinet, built its identity around a single claim: speed. The Turbo plans that headline the range put fewer accounts on each server, add LiteSpeed with LSCache in place of Apache, and enable an aggressive caching layer the company calls Turbo Boost and Turbo Max. The marketing says up to twenty times faster page loads. The reality is that Turbo plans genuinely are among the quickest shared hosting you can buy, and the non-Turbo plans are ordinary.

That split runs through the whole company. A2 is developer-friendly in ways budget hosts usually are not: SSH on every plan, staging, Git, Node.js, Python and Ruby support, a choice of PHP versions going back years for legacy applications, and free Cloudflare CDN. It also keeps cPanel, which makes it a comfortable landing spot for anyone migrating off a traditional host.

The friction is commercial. The anytime money-back guarantee is prorated rather than full after the first 30 days, renewal pricing climbs steeply, and the entry-level plans are slow enough that buying A2 without Turbo somewhat defeats the point of buying A2.',
        'company' => [
            'Ownership'    => 'Privately held, independent',
            'Headquarters' => 'Ann Arbor, Michigan, United States',
            'Founded'      => '2001 (as Iniquinet)',
            'Scale'        => 'Hundreds of thousands of sites across four global data centres',
            'Notable'      => 'Carbon-neutral through green energy matching since 2007',
        ],
        'timeline' => [
            ['year' => 2001, 'event' => 'Founded in Ann Arbor as Iniquinet.'],
            ['year' => 2003, 'event' => 'Rebrands to A2 Hosting after the Ann Arbor area code.'],
            ['year' => 2007, 'event' => 'Commits to carbon-neutral operation through renewable energy matching.'],
            ['year' => 2014, 'event' => 'Introduces Turbo Servers built on LiteSpeed with reduced account density.'],
            ['year' => 2021, 'event' => 'Adds Turbo Boost and Turbo Max tiers with NVMe storage and higher resource ceilings.'],
        ],
        'hosting_types' => [
            ['name' => 'Shared hosting',    'from' => '$2.99/mo',  'note' => 'Startup through Turbo Max, cPanel on every tier.'],
            ['name' => 'Managed WordPress', 'from' => '$11.99/mo', 'note' => 'Preconfigured WordPress with A2 Optimized plugin and staging.'],
            ['name' => 'VPS hosting',       'from' => '$2.99/mo',  'note' => 'Unmanaged, managed and core VPS tiers with root access.'],
            ['name' => 'Dedicated servers', 'from' => '$105.99/mo','note' => 'Unmanaged or fully managed bare metal with hardware choice.'],
            ['name' => 'Reseller hosting',  'from' => '$18.99/mo', 'note' => 'WHM-based reseller accounts with white-label branding.'],
        ],
        'specs' => [
            'Control panel'  => 'cPanel on shared and reseller, WHM on VPS',
            'Web server'     => 'Apache on entry plans, LiteSpeed on Turbo',
            'Storage'        => 'SSD standard, NVMe on Turbo Boost and Turbo Max',
            'PHP versions'   => 'PHP 5.6 through 8.3, useful for legacy applications',
            'Runtimes'       => 'Node.js, Python, Ruby, Perl in addition to PHP',
            'Backups'        => 'Free automatic backups on all plans, restorable from cPanel',
            'Staging'        => 'Yes, one-click on WordPress plans',
            'SSH access'     => 'Yes, on every plan including entry level',
            'Free migration' => 'Free site migration on all plans, handled by the team',
            'CDN'            => 'Free Cloudflare CDN integration',
            'Uptime SLA'     => '99.9% commitment with credit policy',
        ],
        'performance' => 'Turbo is the whole story. On a Turbo plan, LiteSpeed plus LSCache plus roughly a third the account density of the entry tier produces cached time to first byte in the 150 to 350 millisecond band, putting it in the same conversation as managed WordPress hosts at five times the price. On the Startup and Drive plans you get Apache, higher density and results indistinguishable from any other cheap shared host. Four data centres — Michigan, Arizona, Amsterdam and Singapore — give reasonable global coverage, and the Cloudflare integration fills the gaps.',
        'security' => [
            'HackScan proactive scanning included on all plans at no charge',
            'Free Let\'s Encrypt SSL with automatic renewal',
            'Dual firewall with kernel-level hardening and brute-force protection',
            'Free automatic backups with self-service cPanel restore',
            'Two-factor authentication on the customer portal',
            'Reinforced DDoS protection at the network edge',
        ],
        'pricing_notes' => [
            'Headline pricing needs a three-year prepayment; shorter terms cost substantially more.',
            'Renewal typically lands two to three times higher than the introductory rate.',
            'The anytime guarantee is full only within 30 days; after that it is prorated on unused time.',
            'Turbo tiers cost roughly double the entry plan and are the reason to choose A2 at all.',
        ],
        'migration' => 'A2 migrates sites free on every plan, including multiple sites on higher tiers, and the team handles cPanel-to-cPanel transfers cleanly. Because cPanel is on both ends for most moves, this is one of the lower-friction migrations in the market.',
        'not_for' => [
            'Buyers who will not pay for a Turbo plan, since the entry tiers are unremarkable',
            'Anyone expecting a full refund after the first month',
            'Sites needing a modern custom dashboard rather than cPanel',
            'Global audiences needing more than four origin regions',
        ],
        'verdict' => 'Buy the Turbo tier or buy something else. With Turbo, A2 is one of the fastest cPanel hosts available and unusually generous on developer tooling, SSH, legacy PHP and free migrations. Without it, you are paying A2 prices for ordinary performance.',
    ],

    'inmotion-hosting' => [
        'overview' => 'InMotion Hosting is a 2001 California company that has stayed independent while most of its contemporaries were absorbed into holding groups, and that independence shows in how it sells. The 90-day money-back guarantee is triple the industry standard. Support is United States based and includes phone, chat, tickets and, unusually, a remote-desktop assistance option where an engineer will connect to your machine. The company publishes its data centre locations, its hardware and its network peering in more detail than almost any competitor at its price point.

The product range is unusually complete for a mid-market host: shared, WordPress-optimised, VPS with both managed and unmanaged options, reseller with WHM, and dedicated bare metal. That makes it a host you can stay with as a project grows rather than one you outgrow. The platform itself is conservative — cPanel, Apache with NGINX caching, SSD storage — but well-maintained, with free SSL, free backups and a well-regarded UltraStack tuned stack on WordPress plans.

The trade-offs are geographic and cosmetic. The two data centres are both in the United States, so an international audience needs a CDN, and the marketing site and dashboard feel dated next to Hostinger or SiteGround.',
        'company' => [
            'Ownership'    => 'Privately held, independent, employee-friendly reputation',
            'Headquarters' => 'Virginia Beach, Virginia, United States',
            'Founded'      => '2001',
            'Scale'        => 'More than 300,000 customers and 700,000 domains',
            'Facilities'   => 'Owns and operates its Los Angeles and Ashburn data centre footprints',
        ],
        'timeline' => [
            ['year' => 2001, 'event' => 'Founded in Los Angeles by Todd Robinson and Sunil Saxena.'],
            ['year' => 2008, 'event' => 'Opens an East Coast data centre presence in Virginia.'],
            ['year' => 2015, 'event' => 'Introduces the 90-day money-back guarantee, the longest among major United States hosts at the time.'],
            ['year' => 2019, 'event' => 'Launches UltraStack, a tuned NGINX, Redis and PHP-FPM stack for WordPress.'],
            ['year' => 2022, 'event' => 'Expands managed VPS range with NVMe storage and cPanel bundled.'],
        ],
        'hosting_types' => [
            ['name' => 'Shared hosting',    'from' => '$2.29/mo',  'note' => 'Core through Pro, with free domain and SSL included.'],
            ['name' => 'WordPress hosting', 'from' => '$3.49/mo',  'note' => 'UltraStack tuning, staging and automatic core updates.'],
            ['name' => 'VPS hosting',       'from' => '$14.99/mo', 'note' => 'Managed or unmanaged, NVMe storage, free cPanel on managed.'],
            ['name' => 'Dedicated servers', 'from' => '$139.99/mo','note' => 'Bare metal with managed options and hardware RAID.'],
            ['name' => 'Reseller hosting',  'from' => '$19.99/mo', 'note' => 'WHM, free WHMCS billing licence on higher tiers.'],
        ],
        'specs' => [
            'Control panel'  => 'cPanel and WHM',
            'Web server'     => 'Apache with NGINX caching; UltraStack on WordPress plans',
            'Storage'        => 'SSD on shared, NVMe on current VPS range',
            'PHP versions'   => 'PHP 7.x through 8.x, selectable per account',
            'Backups'        => 'Free automatic backups, included on all shared plans',
            'Staging'        => 'Yes, on WordPress plans',
            'SSH access'     => 'Yes, on all plans',
            'Free migration' => 'Free website transfer included, handled by staff',
            'Email'          => 'Unlimited mailboxes with spam filtering included',
            'Support extras' => 'Remote desktop assistance and United States based phone support',
            'Uptime SLA'     => '99.99% with service credits',
        ],
        'performance' => 'UltraStack is the piece that matters: NGINX in front, PHP-FPM tuned, Redis object caching, and the result is WordPress performance well above what a cPanel shared host usually manages. Both data centres sit in the United States, Los Angeles and Ashburn, which gives good coast-to-coast coverage and nothing else, so international traffic depends on a CDN you add yourself. Managed VPS plans with NVMe are where the platform is genuinely strong, and they are competitively priced against Liquid Web and Hostwinds.',
        'security' => [
            'Free SSL on all domains and unlimited subdomains',
            'Free automatic backups with retention on every shared plan',
            'Custom firewall rules and DDoS protection at the network edge',
            'Malware and hack protection included rather than sold separately',
            'Two-factor authentication on the account management portal',
        ],
        'pricing_notes' => [
            'The lowest advertised rate requires a multi-year term paid up front.',
            'Renewal roughly doubles to triples depending on plan, in line with the sector.',
            'A free domain is included on annual and longer terms.',
            'The 90-day money-back guarantee covers shared hosting and is genuinely honoured.',
        ],
        'migration' => 'Free website transfers are included on all plans and performed by the support team rather than a plugin, which means a human checks the result. cPanel-to-cPanel migrations are straightforward, and the team will schedule the cutover with you rather than moving it unannounced.',
        'not_for' => [
            'Audiences concentrated outside North America',
            'Buyers who want a modern custom control panel rather than cPanel',
            'Anyone looking for the absolute cheapest introductory rate',
            'Teams needing edge deployment or serverless workflows',
        ],
        'verdict' => 'The most complete mid-market United States host, and the safest first purchase in the category because of the 90-day guarantee and staffed migrations. Take the WordPress tier for UltraStack, or the managed VPS if the project has any real traffic. Add a CDN if your readers are not American.',
    ],

    'greengeeks' => [
        'overview' => 'GreenGeeks was founded in 2008 with a specific premise: hosting consumes electricity, and the company would buy three times the renewable energy credits its infrastructure draws from the grid, making each site hosted a net positive rather than merely neutral. That claim is the marketing, but it is also independently verifiable through the Bonneville Environmental Foundation and the Green Power Partnership, and GreenGeeks has held to it for over fifteen years.

Strip away the environmental story and what remains is a competent, mid-priced shared and WordPress host running LiteSpeed with LSCache, NVMe storage on current plans, cPanel, free nightly backups and a free CDN. It is not the cheapest, not the fastest, and not the most feature-dense, but it is consistently good at all three, and the support team has a better reputation than most hosts in its price band.

Where it shows its size is in scale limits. Three data centres, no enterprise tier, and a VPS range that is functional rather than compelling. GreenGeeks is a place to host a blog, a small business site or a modest store well, with a clean conscience, not a platform to build a high-traffic application on.',
        'company' => [
            'Ownership'      => 'Privately held, independent',
            'Headquarters'   => 'Agoura Hills, California, United States',
            'Founded'        => '2008',
            'Scale'          => 'Over 600,000 websites hosted',
            'Sustainability' => 'Matches 300% of energy used with renewable energy credits',
        ],
        'timeline' => [
            ['year' => 2008, 'event' => 'Founded with a 300% renewable energy matching commitment.'],
            ['year' => 2012, 'event' => 'Recognised as an EPA Green Power Partner.'],
            ['year' => 2017, 'event' => 'Moves the shared platform to LiteSpeed with LSCache.'],
            ['year' => 2020, 'event' => 'Opens a European data centre in Amsterdam.'],
            ['year' => 2022, 'event' => 'Migrates current plans to NVMe storage and adds a free CDN.'],
        ],
        'hosting_types' => [
            ['name' => 'Shared hosting',    'from' => '$2.49/mo',  'note' => 'Lite, Pro and Premium, all with LiteSpeed and free CDN.'],
            ['name' => 'WordPress hosting', 'from' => '$2.49/mo',  'note' => 'Same stack with LSCache preconfigured and managed updates.'],
            ['name' => 'VPS hosting',       'from' => '$39.95/mo', 'note' => 'Managed KVM VPS with cPanel and root access.'],
            ['name' => 'Reseller hosting',  'from' => '$19.95/mo', 'note' => 'WHM with white-label branding and client billing.'],
        ],
        'specs' => [
            'Control panel'  => 'cPanel',
            'Web server'     => 'LiteSpeed with LSCache',
            'Storage'        => 'NVMe SSD with RAID-10 redundancy',
            'PHP versions'   => 'PHP 7.4 through 8.2 with per-account switching',
            'Backups'        => 'Free nightly backups with self-service restore',
            'Staging'        => 'Yes, on Pro and Premium',
            'SSH access'     => 'Yes, on all plans',
            'Free migration' => 'One free migration per account',
            'CDN'            => 'Free CDN included on all plans',
            'Email'          => 'Unlimited mailboxes with spam protection',
            'Uptime SLA'     => '99.9% with credit policy',
        ],
        'performance' => 'LiteSpeed with LSCache puts GreenGeeks comfortably into the upper half of shared hosting benchmarks, with cached WordPress responses usually in the 250 to 450 millisecond range from a nearby region. The three data centres — Chicago, Montreal and Amsterdam — cover North America and Western Europe adequately and Asia-Pacific not at all, so the free CDN does real work for anyone outside those regions. Resource limits on the Lite plan are tight enough that a growing site will feel them.',
        'security' => [
            'Free Let\'s Encrypt wildcard SSL on all plans',
            'Container-based account isolation to limit cross-account risk',
            'Real-time security scanning and automatic kernel patching',
            'Free nightly backups with 30-day retention on higher tiers',
            'Brute-force protection and custom firewall rules',
            'Free domain privacy included rather than upsold',
        ],
        'pricing_notes' => [
            'The advertised rate requires a 36-month prepayment.',
            'Renewal increases to roughly three times the introductory price.',
            'Free domain registration for the first year on annual and longer terms.',
            '30-day money-back guarantee on hosting, excluding domain fees.',
        ],
        'migration' => 'One free migration is included with a new account and handled by the support team. Additional sites are transferred for a fee. cPanel on both ends makes most moves routine, and the team will coordinate timing rather than acting unannounced.',
        'not_for' => [
            'Sites with an Asia-Pacific audience, given no regional data centre',
            'High-traffic applications that need more than shared or a small VPS',
            'Buyers who will not commit to a three-year term for the headline rate',
            'Anyone who needs a custom, modern control panel',
        ],
        'verdict' => 'A genuinely good mid-market host whose environmental commitment is real and verifiable rather than a badge. Take the Pro tier for staging and better resource limits, and treat the green story as a tiebreaker rather than the reason to buy. For a North American or European small business site, it is a sound, unexciting choice in the best sense.',
    ],

    'namecheap' => [
        'overview' => 'Namecheap has been selling domains since 2000 and is now the second-largest ICANN-accredited registrar in the world, with well over ten million domains under management. Hosting came later and has always been the secondary business, which shapes everything about it: pricing is aggressive, the feature set is adequate, and the real reason most people are there is that they already own their domain at Namecheap and adding hosting is one click.

The company earned genuine goodwill by being early and loud on customer-side issues that the registrar industry mostly ignored: free WhoisGuard privacy for life when competitors charged for it, a public stand against SOPA, and transparent pricing without the renewal cliffs that define the shared hosting sector. Namecheap hosting renewals do rise, but nothing like three times.

The hosting itself runs cPanel on shared plans with a choice of a United States or United Kingdom data centre, includes unmetered bandwidth and free automatic SSL, and adds a supercharged EasyWP managed WordPress product that is unusually cheap for what it is. What you do not get is speed leadership, deep support expertise on complex problems, or phone support of any kind.',
        'company' => [
            'Ownership'    => 'Privately held, founder-led by Richard Kirkendall',
            'Headquarters' => 'Phoenix, Arizona, United States',
            'Founded'      => '2000',
            'Scale'        => 'Over 17 million domains under management, 2 million+ customers',
            'Notable'      => 'Second-largest ICANN-accredited domain registrar globally',
        ],
        'timeline' => [
            ['year' => 2000, 'event' => 'Founded as a domain registrar by Richard Kirkendall.'],
            ['year' => 2012, 'event' => 'Leads a high-profile registrar campaign against the SOPA legislation.'],
            ['year' => 2016, 'event' => 'Makes WhoisGuard domain privacy free for life on eligible domains.'],
            ['year' => 2019, 'event' => 'Launches EasyWP, a container-based managed WordPress platform.'],
            ['year' => 2022, 'event' => 'Passes 17 million domains under management.'],
        ],
        'hosting_types' => [
            ['name' => 'Shared hosting',     'from' => '$1.58/mo',  'note' => 'Stellar, Stellar Plus and Stellar Business on cPanel.'],
            ['name' => 'EasyWP WordPress',   'from' => '$2.91/mo',  'note' => 'Container-based managed WordPress, no cPanel, very cheap.'],
            ['name' => 'VPS hosting',        'from' => '$6.88/mo',  'note' => 'Unmanaged KVM VPS, cPanel licence optional.'],
            ['name' => 'Dedicated servers',  'from' => '$48.88/mo', 'note' => 'Bare metal with unmanaged and managed tiers.'],
            ['name' => 'Reseller hosting',   'from' => '$19.88/mo', 'note' => 'cPanel and WHM with white-label options.'],
        ],
        'specs' => [
            'Control panel'  => 'cPanel on shared, custom dashboard on EasyWP',
            'Web server'     => 'Apache with LiteSpeed on selected plans',
            'Storage'        => 'SSD across the shared range',
            'PHP versions'   => 'PHP 7.x through 8.x, switchable',
            'Bandwidth'      => 'Unmetered on shared plans',
            'Backups'        => 'Twice-weekly automatic on shared, AutoBackup on EasyWP',
            'Staging'        => 'Available on EasyWP higher tiers',
            'SSH access'     => 'Yes, on Stellar Plus and Business',
            'Free migration' => 'Free migration assistance on request',
            'SSL'            => 'Free automatic SSL, plus its own SSL retail business',
            'Domain privacy' => 'Free for life on eligible domains',
            'Uptime SLA'     => '100% uptime guarantee with credits',
        ],
        'performance' => 'Namecheap hosting is average and honest about it. Two data centre choices, Phoenix in the United States and Nottingham in the United Kingdom, cover two markets and no others, so an Asian or Australian audience should look elsewhere or commit to a CDN. EasyWP is the surprise: because each site runs in its own container with a built-in cache rather than on a packed shared server, it consistently outperforms the cPanel shared plans at a similar price. For a low-traffic brochure site or blog, either is fine. For anything demanding, the ceiling arrives early.',
        'security' => [
            'Free WhoisGuard domain privacy for life on eligible registrations',
            'Free automatic SSL provisioning and renewal on hosting plans',
            'Two-factor authentication with app, SMS and hardware key support',
            'Twice-weekly automatic backups on shared plans',
            'A long public record of resisting overbroad takedown and data requests',
        ],
        'pricing_notes' => [
            'Introductory pricing is genuinely cheap and the renewal increase is modest by industry standards.',
            'Domain renewal pricing is where registrars make their margin — check year-two domain rates.',
            'EasyWP tiers are priced per site, so multiple sites multiply the cost.',
            '30-day money-back guarantee on hosting; domains are non-refundable as usual.',
        ],
        'migration' => 'Namecheap will migrate sites free on request through its support team, and cPanel-to-cPanel moves are routine. Moving into EasyWP uses a plugin-based import that works well for standard WordPress sites and less well for anything heavily customised.',
        'not_for' => [
            'Anyone needing phone support or deep technical escalation',
            'Sites with an Asia-Pacific or African audience',
            'High-traffic or resource-heavy applications',
            'Agencies needing rich staging, Git deploys and team roles',
        ],
        'verdict' => 'The natural choice if your domains already live here and the site is modest: cheap, honest about pricing, and backed by a company with a genuinely good track record on customer rights. Prefer EasyWP over the cPanel shared plans for WordPress, and do not expect speed records or expert support.',
    ],

    'hostgator' => [
        'overview' => 'HostGator started in a Florida Atlantic University dorm room in 2002, grew into one of the loudest brands in shared hosting on the back of unmetered storage and bandwidth marketing, sold to Endurance International in 2012, and now sits inside Newfold Digital alongside Bluehost. Its identity is volume: cheap plans, unmetered resources on paper, a 45-day money-back window that is longer than most, and constant promotional pricing.

The platform is conservative and stable. cPanel, Apache, SSD storage, free SSL, a free domain for the first year, and a website builder bundled in. Support is available by phone and chat around the clock, which still separates it from a number of budget competitors. What has eroded over the years is technical ambition: there is no LiteSpeed, no NVMe across the board, no modern custom dashboard, and no staging on the base tiers.

Unmetered is the word to interrogate. Storage and bandwidth are unmetered under a fair-use policy bounded by inode counts and CPU limits, and a site that grows into real traffic will meet those limits long before it meets a storage cap. HostGator is best understood as a competent, cheap, well-supported home for a small site rather than a platform to scale on.',
        'company' => [
            'Ownership'     => 'Newfold Digital (formerly Endurance International Group)',
            'Headquarters'  => 'Houston, Texas, United States',
            'Founded'       => '2002',
            'Scale'         => 'Around 2 million hosted domains',
            'Sister brands' => 'Bluehost, Network Solutions, Web.com, Domain.com',
        ],
        'timeline' => [
            ['year' => 2002, 'event' => 'Founded by Brent Oxley in a university dorm room in Florida.'],
            ['year' => 2006, 'event' => 'Moves headquarters to Houston and expands into reseller and dedicated hosting.'],
            ['year' => 2012, 'event' => 'Acquired by Endurance International Group.'],
            ['year' => 2021, 'event' => 'Becomes part of Newfold Digital after the Endurance buyout.'],
            ['year' => 2023, 'event' => 'Refreshes the shared range with a bundled builder and updated caching.'],
        ],
        'hosting_types' => [
            ['name' => 'Shared hosting',    'from' => '$2.75/mo',  'note' => 'Hatchling, Baby and Business with unmetered storage and bandwidth.'],
            ['name' => 'WordPress hosting', 'from' => '$5.95/mo',  'note' => 'Managed tier with caching, malware removal and a CDN.'],
            ['name' => 'VPS hosting',       'from' => '$23.95/mo', 'note' => 'Managed VPS with cPanel, root access and snapshot backups.'],
            ['name' => 'Dedicated servers', 'from' => '$89.98/mo', 'note' => 'Linux or Windows bare metal with managed support tiers.'],
            ['name' => 'Reseller hosting',  'from' => '$19.95/mo', 'note' => 'WHM with WHMCS billing and white-label branding.'],
        ],
        'specs' => [
            'Control panel'  => 'cPanel and WHM',
            'Web server'     => 'Apache with caching layer',
            'Storage'        => 'SSD, unmetered under fair-use limits',
            'PHP versions'   => 'PHP 7.x and 8.x, selectable',
            'Bandwidth'      => 'Unmetered under a fair-use policy',
            'Backups'        => 'Weekly courtesy backups; CodeGuard sold as an add-on',
            'Staging'        => 'On managed WordPress plans only',
            'SSH access'     => 'Yes, on Business and above',
            'Free migration' => 'Free transfer within the first 30 days of signup',
            'Email'          => 'Unlimited mailboxes on shared plans',
            'Support'        => '24/7 phone, live chat and ticketing',
            'Uptime SLA'     => '99.9% with a one-month credit policy',
        ],
        'performance' => 'Middle of the road and unapologetic about it. Two Texas and Utah data centres put the origin in the United States only, the web stack is Apache rather than LiteSpeed, and cached WordPress responses typically land in the 400 to 800 millisecond range for North American visitors. HostGator will host a brochure site, a small blog or a low-traffic store perfectly well. It will not win a speed comparison against Hostinger, A2 Turbo or SiteGround, and it is not trying to.',
        'security' => [
            'Free SSL certificate on every domain',
            'Free domain privacy included on some tiers, otherwise an add-on',
            'SiteLock malware scanning and CodeGuard backups sold separately',
            'DDoS mitigation at the network level',
            'Two-factor authentication on the customer portal',
        ],
        'pricing_notes' => [
            'The lowest rate needs a 36-month prepayment; monthly billing is far more expensive.',
            'Renewal is roughly two to three times the introductory rate.',
            'Backups and malware scanning are paid add-ons, not included — price them in.',
            'The 45-day money-back guarantee is longer than the sector norm and is honoured.',
        ],
        'migration' => 'A free transfer is included if requested within the first 30 days of signup, performed by the migrations team. Outside that window, transfers are billed per site. Plan the request early — the window is the catch.',
        'not_for' => [
            'Performance-sensitive sites or anything with real traffic growth ahead',
            'Non-United States audiences without an added CDN',
            'Buyers who want backups and security included rather than upsold',
            'Developers wanting Git, WP-CLI-first workflows or modern staging',
        ],
        'verdict' => 'A cheap, stable, phone-supported home for a small site, with a 45-day guarantee that makes trying it low-risk. Request the free migration inside the 30-day window, add your own backup solution, and move on to a faster host before the site outgrows shared limits.',
    ],

    'kinsta' => [
        'overview' => 'Kinsta launched in 2013 with an argument that sounded expensive and turned out to be right: managed WordPress hosting should run on the same infrastructure that serves Google itself, isolated per site, with no shared resource pool anywhere in the stack. Every Kinsta site is a Linux container on Google Cloud Platform running NGINX, PHP-FPM and its own MariaDB instance, fronted by a Cloudflare Enterprise edge with a free web application firewall and DDoS protection.

That architecture buys two things money usually cannot. The first is genuine isolation, so one site being attacked or running a runaway query cannot touch another. The second is placement: you pick from 37 Google Cloud regions, so the origin can sit in Sydney or Sao Paulo rather than Virginia. The MyKinsta dashboard is the best in the category, with per-site analytics, one-click staging, a built-in APM profiler for finding slow plugins, and self-service backups with restore.

The price is the whole objection. Entry is around thirty-five dollars a month for one site and a modest visit allowance, and overage on visits is billed. Kinsta is not a host you buy for a hobby project. It is the one you buy when downtime costs more than the invoice.',
        'company' => [
            'Ownership'    => 'Privately held, independent, remote-first',
            'Headquarters' => 'Los Angeles, California, with a globally distributed team',
            'Founded'      => '2013',
            'Scale'        => 'Serving customers in 128 countries',
            'Infrastructure' => 'Google Cloud Platform premium tier plus Cloudflare Enterprise',
        ],
        'timeline' => [
            ['year' => 2013, 'event' => 'Founded by Mark Gavalda as a premium managed WordPress host.'],
            ['year' => 2016, 'event' => 'Moves entirely onto Google Cloud Platform with per-site container isolation.'],
            ['year' => 2019, 'event' => 'Ships the Kinsta APM profiler for diagnosing slow WordPress code.'],
            ['year' => 2021, 'event' => 'Adds free Cloudflare Enterprise integration with edge caching and WAF for every site.'],
            ['year' => 2023, 'event' => 'Expands beyond WordPress with application, database and static site hosting.'],
        ],
        'hosting_types' => [
            ['name' => 'Managed WordPress',   'from' => '$35/mo',  'note' => 'Single through enterprise tiers, priced by sites and monthly visits.'],
            ['name' => 'Application hosting', 'from' => '$7/mo',   'note' => 'Node, Python, PHP, Ruby, Go and Java apps deployed from Git.'],
            ['name' => 'Database hosting',    'from' => '$18/mo',  'note' => 'Managed MariaDB, MySQL, PostgreSQL and Redis instances.'],
            ['name' => 'Static site hosting', 'from' => 'Free',    'note' => 'Up to 100 static sites built from a Git repository at no cost.'],
        ],
        'specs' => [
            'Control panel'  => 'MyKinsta (custom dashboard, no cPanel)',
            'Web server'     => 'NGINX with PHP-FPM, per-site containers',
            'Storage'        => 'Google Cloud SSD persistent disks',
            'PHP versions'   => 'PHP 8.0 through 8.3, switchable per site',
            'Caching'        => 'Server-level page cache, Redis object cache as a paid add-on, Cloudflare edge cache',
            'CDN'            => 'Cloudflare Enterprise included free with 260+ points of presence',
            'Backups'        => 'Automatic daily, 14 to 30 day retention, plus manual and downloadable backups',
            'Staging'        => 'One-click staging on every plan, premium staging environments available',
            'Developer tools'=> 'SSH, WP-CLI, Git, Composer, local development via DevKinsta',
            'Regions'        => '37 Google Cloud regions to choose from',
            'APM'            => 'Built-in application performance monitoring for WordPress',
            'Uptime SLA'     => '99.9% with monitoring every two minutes',
        ],
        'performance' => 'This is as fast as WordPress hosting gets without rearchitecting the site. Cloudflare Enterprise edge caching serves most page views from a location near the visitor, and when a request does reach the origin it lands on a dedicated container on Google Cloud premium-tier networking. Cached time to first byte under 100 milliseconds is common worldwide, and uncached responses stay fast because nothing is shared. The APM tool is the underrated part: it tells you which plugin or query is costing you 800 milliseconds, which usually beats any hosting upgrade.',
        'security' => [
            'Cloudflare Enterprise web application firewall and DDoS protection included free',
            'Hardware firewalls, active and passive intrusion detection, and uptime checks every two minutes',
            'Per-site Linux container isolation with no shared processes',
            'Automatic daily backups with one-click restore, plus hourly backups as an add-on',
            'Free malware removal — Kinsta cleans a hacked site at no charge, no time limit',
            'Two-factor authentication, SSO and granular company user roles',
            'SOC 2 Type 2 audited, with GDPR compliance documentation',
        ],
        'pricing_notes' => [
            'Plans are metered by monthly visits and disk; overage is billed per thousand visits.',
            'Annual billing gives two months free versus monthly.',
            'Redis object caching and hourly backups are paid add-ons on top of the plan.',
            '30-day money-back guarantee, and no long-term contract is required.',
        ],
        'migration' => 'Kinsta includes free migrations on every plan, performed by its engineers, with unlimited free migrations from certain hosts and premium migrations on higher tiers. The team schedules the cutover with you, tests on staging first, and does the DNS change at an agreed time. It is the smoothest migration process in the industry.',
        'not_for' => [
            'Hobby sites and low-budget projects — the floor price is high',
            'Anyone who needs email hosting, which Kinsta does not provide',
            'Sites that need cPanel or want to resell hosting under their own brand',
            'Unpredictable viral traffic on a low visit tier, where overage charges add up',
        ],
        'verdict' => 'The benchmark for managed WordPress, and worth the money for any site where an hour of downtime costs more than a month of hosting. Budget for the visit tier honestly, use the APM to fix your own slow plugins, and remember you will need email hosting somewhere else.',
    ],

    'wp-engine' => [
        'overview' => 'WP Engine invented the managed WordPress category in 2010 and remains its largest player, hosting well over one and a half million sites for agencies, publishers and enterprises. Its business is not really hosting so much as an opinionated WordPress platform: environments for development, staging and production on every plan, a global edge network, an automated plugin update service that visually regression-tests your pages before shipping the update, and a security posture that includes free hack fixes for life.

The company has also spent a decade acquiring the ecosystem around it. StudioPress and the Genesis framework, Flywheel, Local (the most widely used local WordPress development tool), Array Themes and Delicious Brains all sit under the WP Engine umbrella now, which means an agency can run its entire WordPress workflow inside one vendor.

The cost of that completeness is price and rigidity. Plans are metered by visits and bandwidth with overage fees, a long list of plugins is disallowed for performance or security reasons, and there is no email hosting. For an agency billing clients, none of that matters. For a solo site owner, it usually does.',
        'company' => [
            'Ownership'     => 'Majority investment from Silver Lake, privately held',
            'Headquarters'  => 'Austin, Texas, United States',
            'Founded'       => '2010',
            'Scale'         => '1.5 million+ sites across 150 countries, 120,000+ customers',
            'Sister brands' => 'Flywheel, StudioPress/Genesis, Local, Delicious Brains, Array Themes',
        ],
        'timeline' => [
            ['year' => 2010, 'event' => 'Founded in Austin by Jason Cohen, defining the managed WordPress category.'],
            ['year' => 2018, 'event' => 'Acquires StudioPress and the Genesis framework.'],
            ['year' => 2019, 'event' => 'Acquires Flywheel and takes over Local, the desktop WordPress development app.'],
            ['year' => 2021, 'event' => 'Launches Headless WordPress with the Atlas platform and Faust.js.'],
            ['year' => 2022, 'event' => 'Acquires Delicious Brains, adding WP Migrate and Advanced Custom Fields.'],
        ],
        'hosting_types' => [
            ['name' => 'Managed WordPress',   'from' => '$25/mo',   'note' => 'Startup through Scale, priced by sites, visits and storage.'],
            ['name' => 'eCommerce hosting',   'from' => '$45/mo',   'note' => 'WooCommerce-tuned stack with instant store search and cart fragments handling.'],
            ['name' => 'Headless WordPress',  'from' => 'Custom',   'note' => 'Atlas platform for decoupled front ends built with Faust.js and Next.js.'],
            ['name' => 'Enterprise hosting',  'from' => 'Custom',   'note' => 'Dedicated infrastructure, custom SLAs and a named account team.'],
        ],
        'specs' => [
            'Control panel'  => 'WP Engine User Portal (custom)',
            'Web server'     => 'NGINX with PHP-FPM on Google Cloud and AWS',
            'PHP versions'   => 'PHP 8.1 through 8.3',
            'Environments'   => 'Development, staging and production on every plan',
            'Caching'        => 'EverCache page and object caching, plus a global edge cache',
            'CDN'            => 'Global edge network included on all plans',
            'Backups'        => 'Automated daily backups with one-click restore and manual restore points',
            'Developer tools'=> 'SSH gateway, WP-CLI, Git and SFTP push, Local for development',
            'Smart Plugin Manager' => 'Automated plugin updates with visual regression testing',
            'Disallowed plugins' => 'A published list of blocked plugins for performance and security',
            'Uptime SLA'     => '99.95% on standard plans, 99.99% on enterprise',
        ],
        'performance' => 'EverCache, WP Engine\'s custom page and object caching layer, plus a global edge network, keeps cached WordPress responses in the sub-200 millisecond band for most visitors. The platform runs on Google Cloud and AWS with regions across North America, Europe and Asia-Pacific, so origin placement is good. Where WP Engine really differentiates is consistency under load: the architecture is designed for publishers with traffic spikes, and it degrades gracefully rather than falling over. Uncached WooCommerce traffic is where the eCommerce tier and its specialised caching rules earn their premium.',
        'security' => [
            'Managed WordPress core updates with automated compatibility testing',
            'Free hack fixes for life — WP Engine cleans compromised sites at no charge',
            'Global edge security layer with a managed web application firewall and DDoS mitigation',
            'Daily automated backups plus on-demand restore points before every deploy',
            'Disallowed-plugin policy blocking known-vulnerable and performance-destroying plugins',
            'SOC 2 Type 2, ISO 27001 and PCI DSS compliance, with GDPR tooling',
            'Two-factor authentication and role-based portal access for teams',
        ],
        'pricing_notes' => [
            'Plans meter monthly visits, storage and bandwidth, with overage billed per thousand visits.',
            'Annual billing includes two months free; month-to-month is available at list price.',
            'The 60-day money-back guarantee is among the longest in managed hosting.',
            'Enterprise pricing is quoted rather than published, and negotiable at volume.',
        ],
        'migration' => 'The WP Engine Automated Migration plugin handles most sites without assistance, and higher plans include white-glove managed migrations performed by the team. Because every plan has a staging environment, you can migrate into staging, verify, then promote to production before touching DNS.',
        'not_for' => [
            'Budget-conscious site owners — the floor is well above shared hosting',
            'Anyone needing email hosting, which is not offered',
            'Sites that depend on a plugin on the disallowed list',
            'Non-WordPress projects, which the platform simply does not host',
        ],
        'verdict' => 'The agency and enterprise default, and the right answer when WordPress is a business system rather than a website. Buy it for the three environments, the Smart Plugin Manager and the free hack fixes, budget for visit overage, and arrange email elsewhere.',
    ],

    'cloudways' => [
        'overview' => 'Cloudways solved a specific problem: cloud servers from DigitalOcean, AWS, Google Cloud, Linode and Vultr are cheap and fast, and configuring and maintaining one is a job. Cloudways sits between you and those providers, provisions the server, installs a tuned stack of NGINX, Apache, PHP-FPM, MySQL, Redis and Varnish, and gives you a dashboard to manage applications, backups, staging, SSL and team access without ever touching a terminal.

You pay a management fee on top of the underlying compute. A two-gigabyte DigitalOcean droplet that costs twelve dollars direct is around twenty-six through Cloudways, and for most people the difference buys back several hours a month. Because billing is hourly and servers are resizable, you can scale up for a launch and back down after, which no shared host allows.

DigitalOcean acquired Cloudways in 2022, which raised reasonable questions about the future of the multi-cloud promise. So far the other providers remain available. The main limitations are structural: no email hosting, no domain registration, and support that is good on platform issues and thinner on application-level debugging.',
        'company' => [
            'Ownership'    => 'Acquired by DigitalOcean in 2022',
            'Headquarters' => 'Malta, with teams across Europe and Asia',
            'Founded'      => '2011',
            'Scale'        => 'Tens of thousands of businesses, hundreds of thousands of applications',
            'Model'        => 'Managed layer over DigitalOcean, AWS, Google Cloud, Linode and Vultr',
        ],
        'timeline' => [
            ['year' => 2011, 'event' => 'Founded in Malta as a managed cloud platform.'],
            ['year' => 2016, 'event' => 'Adds AWS and Google Cloud alongside DigitalOcean and Vultr.'],
            ['year' => 2019, 'event' => 'Ships Breeze caching plugin and the CloudwaysCDN.'],
            ['year' => 2022, 'event' => 'Acquired by DigitalOcean.'],
            ['year' => 2023, 'event' => 'Launches Autonomous, an autoscaling managed WordPress product.'],
        ],
        'hosting_types' => [
            ['name' => 'Managed DigitalOcean', 'from' => '$11/mo',  'note' => 'The cheapest entry point, premium droplets with NVMe available.'],
            ['name' => 'Managed Vultr',        'from' => '$13/mo',  'note' => 'High-frequency compute options in 30+ locations.'],
            ['name' => 'Managed Linode',       'from' => '$12/mo',  'note' => 'Akamai-backed compute with predictable pricing.'],
            ['name' => 'Managed AWS',          'from' => '$36.51/mo','note' => 'EC2 instances with the full AWS region footprint.'],
            ['name' => 'Managed Google Cloud', 'from' => '$33.30/mo','note' => 'GCP compute with premium-tier networking.'],
            ['name' => 'Autonomous WordPress', 'from' => '$35/mo',  'note' => 'Kubernetes-backed autoscaling WordPress, hands-off.'],
        ],
        'specs' => [
            'Control panel'  => 'Cloudways Platform dashboard (custom)',
            'Web stack'      => 'NGINX in front of Apache, PHP-FPM, MySQL or MariaDB',
            'Caching'        => 'Varnish, Redis, Memcached and the Breeze plugin, all preconfigured',
            'PHP versions'   => 'PHP 7.x through 8.3, switchable per application',
            'Backups'        => 'Automated on-demand and scheduled backups, off-server storage',
            'Staging'        => 'One-click staging with selective push to live',
            'Developer tools'=> 'SSH and SFTP, WP-CLI, Git deployment, Composer, cron manager',
            'Scaling'        => 'Vertical server resize in minutes with no migration',
            'CDN'            => 'CloudwaysCDN billed per site, Cloudflare Enterprise add-on available',
            'Team access'    => 'Role-based team members with per-server and per-app scoping',
            'Billing'        => 'Hourly, pay-as-you-go, no contract',
        ],
        'performance' => 'Because you choose the underlying provider and region, Cloudways performance is really the performance of the cloud you pick, tuned properly. A Vultr high-frequency instance with Varnish and Redis in front of WordPress will beat nearly every shared host and most managed WordPress plans on uncached requests, because you get dedicated vCPU and memory rather than a slice. The Cloudflare Enterprise add-on brings edge caching into the same range as Kinsta or Rocket.net. The one thing you cannot do is scale horizontally without moving to the Autonomous product.',
        'security' => [
            'Dedicated firewalls per server with IP whitelisting for SSH and database access',
            'Free Let\'s Encrypt SSL with automatic renewal, wildcard supported',
            'Automated patching of the operating system and stack by the platform',
            'Two-factor authentication and scoped team roles',
            'Off-server automated backups with one-click restore',
            'Bot protection add-on and optional Cloudflare Enterprise web application firewall',
        ],
        'pricing_notes' => [
            'You pay a management premium over buying the cloud server directly — roughly double at small sizes.',
            'Billing is hourly with no contract, so scaling up temporarily is genuinely cheap.',
            'There is no money-back guarantee, but a free trial lets you test before paying.',
            'The CDN, bot protection and premium support tiers are all separate line items.',
        ],
        'migration' => 'A free WordPress migration plugin moves sites automatically, and Cloudways includes one free migration per account handled by its team. Because staging exists on every server, the standard practice is to migrate into a staging application, validate, then promote and switch DNS.',
        'not_for' => [
            'Anyone who needs email hosting or domain registration in the same place',
            'Absolute beginners who want a one-click site and no server concept at all',
            'Buyers who want the cheapest possible cloud, since going direct is cheaper',
            'Applications needing horizontal autoscaling outside the Autonomous product',
        ],
        'verdict' => 'The best middle ground between a shared host and running your own server: real cloud performance, no sysadmin work, hourly billing and easy vertical scaling. Start on a Vultr high-frequency or DigitalOcean premium instance, add Cloudflare Enterprise if the audience is global, and plan for email hosting elsewhere.',
    ],

    'digitalocean' => [
        'overview' => 'DigitalOcean launched in 2011 with a proposition that reshaped the low end of cloud computing: a virtual server with a predictable monthly price, an SSD, a clear dashboard and documentation good enough to learn from. The Droplet became the default unit of small-scale cloud compute, and DigitalOcean\'s tutorials became, for a decade, the way a generation of developers learned Linux administration.

The platform has since grown well past virtual machines. Managed Kubernetes, managed PostgreSQL, MySQL and Redis, Spaces object storage with a built-in CDN, load balancers, a container registry, and App Platform, a Heroku-style push-to-deploy service, all sit alongside Droplets under the same flat, readable pricing. In 2022 it acquired Cloudways, adding a managed WordPress layer on top of its own infrastructure.

What DigitalOcean is not is a web host. There is no cPanel, no email hosting, no one-click site builder, and support on the basic plan is a ticket queue. You are responsible for your own operating system updates, firewall, backups and stack. For a developer that is the point. For a small business owner who wants a website, it is the wrong product entirely.',
        'company' => [
            'Ownership'    => 'Public company, NYSE: DOCN',
            'Headquarters' => 'New York City, United States',
            'Founded'      => '2011',
            'Scale'        => 'Over 600,000 customers, millions of developers using its documentation',
            'Sister brands'=> 'Cloudways, Paperspace (GPU cloud)',
        ],
        'timeline' => [
            ['year' => 2011, 'event' => 'Founded with SSD-backed virtual machines called Droplets.'],
            ['year' => 2016, 'event' => 'Adds load balancers, block storage and monitoring, becoming a full cloud.'],
            ['year' => 2018, 'event' => 'Launches managed Kubernetes and managed databases.'],
            ['year' => 2021, 'event' => 'Goes public on the New York Stock Exchange.'],
            ['year' => 2022, 'event' => 'Acquires Cloudways, adding a managed hosting layer.'],
            ['year' => 2023, 'event' => 'Acquires Paperspace to move into GPU and AI workloads.'],
        ],
        'hosting_types' => [
            ['name' => 'Droplets (VPS)',       'from' => '$4/mo',   'note' => 'Basic, premium Intel and AMD, CPU-optimised and memory-optimised.'],
            ['name' => 'App Platform',         'from' => '$5/mo',   'note' => 'Push-to-deploy PaaS for containers and static sites, free static tier.'],
            ['name' => 'Managed Kubernetes',   'from' => '$12/mo',  'note' => 'Free control plane, you pay only for worker nodes.'],
            ['name' => 'Managed databases',    'from' => '$15/mo',  'note' => 'PostgreSQL, MySQL, Redis, MongoDB, Kafka and OpenSearch.'],
            ['name' => 'Spaces object storage','from' => '$5/mo',   'note' => 'S3-compatible storage with 250GB and a built-in CDN included.'],
        ],
        'specs' => [
            'Control panel'  => 'DigitalOcean cloud console, plus a full REST API and doctl CLI',
            'Virtualisation' => 'KVM with dedicated or shared vCPU options',
            'Storage'        => 'NVMe SSD on premium Droplets, expandable block storage volumes',
            'Operating systems' => 'Ubuntu, Debian, CentOS, Rocky, AlmaLinux, Fedora, FreeBSD and marketplace images',
            'Marketplace'    => 'One-click images for WordPress, LAMP, Docker, GitLab and hundreds more',
            'Networking'     => 'Free VPC, cloud firewalls, floating IPs and 1Gbps to 10Gbps ports',
            'Backups'        => 'Optional automated weekly backups at 20% of the Droplet price, plus snapshots',
            'Monitoring'     => 'Free metrics, alerting and uptime checks',
            'Infrastructure as code' => 'Terraform provider, Pulumi support and a documented API',
            'Support'        => 'Free ticket support, paid business and premium tiers with response SLAs',
            'Uptime SLA'     => '99.99% on Droplets with service credits',
        ],
        'performance' => 'Premium Droplets on NVMe with dedicated Intel or AMD cores are fast and, more importantly, consistent — the shared-CPU basic tier is where variability lives. The network is strong and the 14 data centres across North America, Europe, Asia and Australia cover most markets, though Africa and South America are gaps. For a tuned WordPress or Laravel stack, a four-dollar Droplet outperforms most shared hosting; the work you do to tune it is the price you pay instead of money.',
        'security' => [
            'Free cloud firewalls with tag-based rules across fleets of Droplets',
            'Private VPC networking between resources at no cost',
            'SSH key authentication by default, with password login disabled on request',
            'Optional automated backups and unlimited on-demand snapshots',
            'SOC 2 Type 2 and SOC 3 attestation, ISO 27001, PCI DSS and GDPR readiness',
            'You are responsible for operating system patching and application security',
        ],
        'pricing_notes' => [
            'Pricing is flat, published and hourly-billed with a monthly cap — no surprise egress like the hyperscalers.',
            'Every Droplet includes a generous bandwidth allowance, pooled across the account.',
            'Automated backups cost 20% of the Droplet price on top.',
            'New accounts usually get a free credit for the first 60 days.',
        ],
        'migration' => 'There is no migration service — you move sites yourself, or you use Cloudways, which DigitalOcean owns, to manage the move and the server for you. Snapshots make cloning and region transfers straightforward once you are on the platform.',
        'not_for' => [
            'Anyone who wants cPanel, email hosting or a managed website experience',
            'Non-technical users who do not want to maintain a server',
            'Workloads needing the breadth of AWS or Azure service catalogues',
            'Audiences in Africa or South America, where there is no region',
        ],
        'verdict' => 'The best developer cloud at the small end: predictable pricing, excellent documentation, and enough managed services to grow into. Use premium NVMe Droplets rather than the shared-CPU basic tier, turn on backups, and if you do not want to be a systems administrator, buy Cloudways on top instead.',
    ],

    'linode' => [
        'overview' => 'Linode predates almost every cloud provider that people now think of as established. Founded in 2003, it pioneered the idea of a self-service Linux virtual server with an hourly price and an API, and it stayed independent and profitable for nineteen years before Akamai acquired it in 2022 for around nine hundred million dollars. The product is now branded Akamai Connected Cloud, but the Linode name, pricing and ergonomics remain.

The Akamai acquisition changed the strategic picture more than the day-to-day one. Linode compute is now attached to one of the largest edge networks on earth, with plans to place compute in far more locations than a standalone provider could justify. For customers, the immediate benefits are more regions, better transit, and an easier path to Akamai\'s CDN and security products.

The core offering remains what it was: simple, well-documented Linux instances with flat pricing, generous included transfer, dedicated CPU options, managed Kubernetes, block and object storage, and support that answers tickets quickly and does not charge extra for basic help. Like DigitalOcean, it is infrastructure rather than hosting — bring your own stack.',
        'company' => [
            'Ownership'    => 'Akamai Technologies, acquired 2022',
            'Headquarters' => 'Philadelphia, Pennsylvania, United States',
            'Founded'      => '2003 by Christopher Aker',
            'Scale'        => 'Around 800,000 customers, part of Akamai Connected Cloud',
            'Notable'      => 'One of the oldest independent cloud providers before acquisition',
        ],
        'timeline' => [
            ['year' => 2003, 'event' => 'Founded by Christopher Aker, one of the first self-service Linux VPS providers.'],
            ['year' => 2009, 'event' => 'Introduces an hourly-billed API-driven control plane ahead of most competitors.'],
            ['year' => 2018, 'event' => 'Adds dedicated CPU instances and block storage.'],
            ['year' => 2020, 'event' => 'Launches managed Kubernetes (LKE) and object storage.'],
            ['year' => 2022, 'event' => 'Acquired by Akamai for approximately $900 million.'],
            ['year' => 2023, 'event' => 'Rebranded as Akamai Connected Cloud with aggressive region expansion.'],
        ],
        'hosting_types' => [
            ['name' => 'Shared CPU instances',   'from' => '$5/mo',   'note' => 'Nanode and standard plans for general workloads.'],
            ['name' => 'Dedicated CPU instances','from' => '$36/mo',  'note' => 'Guaranteed cores for databases, CI and production apps.'],
            ['name' => 'High memory instances',  'from' => '$60/mo',  'note' => 'Memory-heavy workloads such as in-memory caches.'],
            ['name' => 'Managed Kubernetes',     'from' => '$12/mo',  'note' => 'Free control plane, pay for nodes; HA control plane optional.'],
            ['name' => 'Object storage',         'from' => '$5/mo',   'note' => 'S3-compatible, 250GB storage and 1TB transfer included.'],
        ],
        'specs' => [
            'Control panel'  => 'Cloud Manager, plus a full API, CLI and Terraform provider',
            'Virtualisation' => 'KVM with shared, dedicated, high-memory and GPU plans',
            'Storage'        => 'NVMe-backed local storage, resizable block storage volumes',
            'Operating systems' => 'Ubuntu, Debian, AlmaLinux, Rocky, CentOS, Arch, Gentoo and custom images',
            'Marketplace'    => 'One-click apps for WordPress, cPanel, Plesk, Docker, GitLab and more',
            'Networking'     => 'VPC, cloud firewall, NodeBalancers, private networking and DDoS protection at no extra cost',
            'Backups'        => 'Optional Linode Backup Service with daily, weekly and biweekly snapshots',
            'Transfer'       => 'Generous pooled outbound transfer included with every instance',
            'Managed service'=> 'Optional Linode Managed with 24/7 incident response for a monthly fee',
            'Support'        => 'Free 24/7 ticket and phone support, no paid support tier required for basics',
            'Uptime SLA'     => '99.99% with service credits',
        ],
        'performance' => 'Dedicated CPU instances deliver consistent, predictable performance that shared-core plans cannot, and the NVMe-backed storage is quick. The eleven-plus regions across North America, Europe, Asia-Pacific and South America were already broad and are expanding rapidly on Akamai transit, which is some of the best-peered network capacity in existence. Included outbound transfer is more generous than DigitalOcean or the hyperscalers, which matters a great deal for media-heavy workloads.',
        'security' => [
            'Free DDoS protection on all instances, inherited from Akamai scrubbing capability',
            'Cloud firewall and VPC private networking at no additional charge',
            'SSH key management and two-factor authentication on the account',
            'Optional managed backup service with configurable schedules',
            'SOC 2 Type 2, ISO 27001, PCI DSS and HIPAA-eligible configurations',
            'You retain responsibility for operating system and application hardening',
        ],
        'pricing_notes' => [
            'Flat published pricing, billed hourly and capped monthly.',
            'Outbound transfer allowances are pooled across the account and unusually generous.',
            'Backups add roughly 20 to 25% of the instance price.',
            'There is no money-back guarantee, but hourly billing means a test costs pennies.',
        ],
        'migration' => 'No managed migration service on standard plans. You move workloads yourself, or buy Linode Managed for incident response. The Marketplace images and Terraform provider make rebuilding a stack quick, and cross-region clones are supported natively.',
        'not_for' => [
            'Anyone wanting a managed website product with cPanel and email',
            'Non-technical buyers who do not want to run a Linux server',
            'Enterprises needing the very wide managed service catalogues of AWS or Azure',
            'Teams requiring dedicated account management on small spend',
        ],
        'verdict' => 'The most engineer-respected small cloud, now with Akamai\'s network behind it. Pick dedicated CPU instances for anything production, take advantage of the large included transfer, and treat it as infrastructure you will administer yourself.',
    ],

    'vultr' => [
        'overview' => 'Vultr is the scrappy third option in the developer cloud triangle alongside DigitalOcean and Linode, and it competes on two things: locations and raw clock speed. With 32 data centres spanning six continents, including places the bigger names ignore such as Johannesburg, Bangalore, Osaka, Melbourne, Mexico City and Tel Aviv, it is often the only way to put a cheap virtual machine physically near a specific audience.

The second differentiator is the High Frequency Compute range, which runs on 3GHz-plus processors with NVMe storage. For single-threaded workloads — which is to say PHP, and therefore WordPress — clock speed matters more than core count, and a High Frequency instance regularly beats larger instances from competitors on real page-generation time.

Vultr also offers bare metal by the hour, GPU instances fractionalised down to small slices, managed Kubernetes, block and object storage, and a serverless inference product. Support is ticket-based and competent on infrastructure but does not help with your application. As with the rest of this category, you are the systems administrator.',
        'company' => [
            'Ownership'    => 'Privately held, part of The Constant Company',
            'Headquarters' => 'West Palm Beach, Florida, United States',
            'Founded'      => '2014 by David Aninowsky',
            'Scale'        => 'Over 1.5 million customers served, 32 cloud data centre locations',
            'Notable'      => 'Bootstrapped without venture capital until a 2024 funding round',
        ],
        'timeline' => [
            ['year' => 2014, 'event' => 'Founded as a bootstrapped alternative to DigitalOcean.'],
            ['year' => 2018, 'event' => 'Launches bare metal servers billed hourly.'],
            ['year' => 2019, 'event' => 'Introduces High Frequency Compute on 3GHz+ processors with NVMe.'],
            ['year' => 2021, 'event' => 'Adds managed Kubernetes, block storage and a marketplace.'],
            ['year' => 2023, 'event' => 'Expands into GPU cloud with fractionalised NVIDIA instances for AI workloads.'],
        ],
        'hosting_types' => [
            ['name' => 'Cloud Compute',         'from' => '$2.50/mo', 'note' => 'Shared vCPU instances, the cheapest entry point in the market.'],
            ['name' => 'High Frequency Compute','from' => '$6/mo',    'note' => '3GHz+ cores and NVMe, the best choice for PHP and WordPress.'],
            ['name' => 'Optimized Cloud',       'from' => '$28/mo',   'note' => 'Dedicated general purpose, CPU, memory and storage optimised.'],
            ['name' => 'Bare Metal',            'from' => '$120/mo',  'note' => 'Single-tenant hardware provisioned in minutes, billed hourly.'],
            ['name' => 'Cloud GPU',             'from' => 'Varies',   'note' => 'Fractional and full NVIDIA GPUs for AI and rendering.'],
        ],
        'specs' => [
            'Control panel'  => 'Vultr customer portal, full API, CLI and Terraform provider',
            'Virtualisation' => 'KVM across regular, high frequency, optimised and bare metal',
            'Storage'        => 'NVMe on High Frequency, SSD elsewhere, plus block storage volumes',
            'Operating systems' => 'Ubuntu, Debian, Rocky, AlmaLinux, CentOS, FreeBSD, Windows Server and custom ISO upload',
            'Marketplace'    => 'One-click apps including WordPress, cPanel, Plesk, Docker and OpenLiteSpeed',
            'Networking'     => 'Free VPC, firewall, DDoS protection optional per instance, IPv6 included',
            'Backups'        => 'Automatic backups as a paid option, plus free-to-take snapshots',
            'Custom ISO'     => 'Yes — you can upload and boot any operating system image',
            'Locations'      => '32 data centres across six continents',
            'Billing'        => 'Hourly with a monthly cap, no contract',
            'Uptime SLA'     => '100% uptime guarantee with service credits',
        ],
        'performance' => 'High Frequency Compute is the reason to choose Vultr. WordPress spends most of its time executing single-threaded PHP, so a 3GHz-plus core with NVMe behind it produces noticeably faster page generation than a larger instance with slower cores. Combined with the unusually wide location list, it lets you put a fast origin within a few dozen milliseconds of almost any audience on earth. The basic Cloud Compute tier, by contrast, uses shared cores and behaves like every other cheap shared-vCPU instance.',
        'security' => [
            'Free private networking and VPC isolation between instances',
            'Firewall groups manageable across fleets of servers',
            'Optional per-instance DDoS protection with scrubbing',
            'Snapshots free to create, automatic backups available as a paid add-on',
            'SOC 2 Type 2, PCI DSS, ISO 27001 and GDPR compliance across the platform',
            'Operating system hardening and patching remain your responsibility',
        ],
        'pricing_notes' => [
            'Among the lowest entry prices in cloud compute, with hourly billing and no commitment.',
            'Bandwidth allowances are per-instance rather than pooled, so check the numbers on media-heavy sites.',
            'Automatic backups add roughly 20% to the instance cost.',
            'No money-back guarantee, but hourly billing makes a trial almost free.',
        ],
        'migration' => 'Self-service only. Custom ISO support and snapshot restore make it one of the easiest clouds to move an existing server image into, which is a real advantage if you are leaving a provider that lets you export a disk image.',
        'not_for' => [
            'Anyone who wants managed hosting, cPanel bundled or email service',
            'Non-technical users — there is no hand-holding',
            'Workloads requiring an extensive managed-service catalogue',
            'Media-heavy sites that would benefit from pooled bandwidth allowances',
        ],
        'verdict' => 'The location and clock-speed specialist. If your audience is somewhere the big providers do not have a region, or your workload is single-threaded PHP, a Vultr High Frequency instance is very hard to beat for the money. Bring your own systems administration skills.',
    ],

    'ovhcloud' => [
        'overview' => 'OVHcloud is Europe\'s largest cloud provider and one of the very few hosts anywhere that designs and builds its own servers, its own water-cooling systems and its own data centres. Founded in Roubaix, France in 1999 by Octave Klaba, it now operates more than thirty data centres on four continents and over 450,000 physical servers, and it owns its fibre backbone rather than renting transit.

That vertical integration is why OVHcloud dedicated servers cost a fraction of what the same hardware costs elsewhere, and it is also why the company can credibly offer a sovereign European cloud that is not subject to the United States CLOUD Act. For GDPR-sensitive workloads and European public sector buyers, that distinction is the entire purchase decision.

The weakness is service. Support is ticket-first, documentation is uneven in English, the control panel is functional rather than friendly, and the 2021 Strasbourg data centre fire — which destroyed a building and damaged another — exposed how many customers had assumed backups were automatic when they were not. OVHcloud is excellent value and it expects you to know what you are doing.',
        'company' => [
            'Ownership'    => 'Publicly listed on Euronext Paris, Klaba family remains majority holder',
            'Headquarters' => 'Roubaix, France',
            'Founded'      => '1999 by Octave Klaba',
            'Scale'        => '450,000+ servers, 1.6 million customers in 140 countries',
            'Notable'      => 'Builds its own servers, water cooling and fibre backbone',
        ],
        'timeline' => [
            ['year' => 1999, 'event' => 'Founded in Roubaix by Octave Klaba.'],
            ['year' => 2003, 'event' => 'Pioneers low-cost dedicated servers with in-house water cooling.'],
            ['year' => 2016, 'event' => 'Launches a public cloud built on OpenStack.'],
            ['year' => 2021, 'event' => 'A fire destroys the SBG2 data centre in Strasbourg, prompting an industry-wide rethink of backup assumptions.'],
            ['year' => 2021, 'event' => 'Lists on Euronext Paris as Europe\'s sovereign cloud champion.'],
        ],
        'hosting_types' => [
            ['name' => 'Web hosting',        'from' => '$3.50/mo', 'note' => 'Shared plans with a free domain, aimed at European small business.'],
            ['name' => 'VPS',                'from' => '$5.50/mo', 'note' => 'KVM instances with anti-DDoS included as standard.'],
            ['name' => 'Public cloud',       'from' => 'Hourly',   'note' => 'OpenStack compute, object storage, managed Kubernetes and databases.'],
            ['name' => 'Dedicated servers',  'from' => '$65/mo',   'note' => 'Rise, Advance, Scale and High Grade ranges, often the cheapest bare metal in Europe.'],
            ['name' => 'Hosted Private Cloud','from' => 'Custom',  'note' => 'VMware, Nutanix and SAP HANA on dedicated infrastructure.'],
        ],
        'specs' => [
            'Control panel'  => 'OVHcloud Manager, plus API and Terraform provider; cPanel/Plesk optional on dedicated',
            'Storage'        => 'NVMe and SSD depending on range, plus object and block storage',
            'Anti-DDoS'      => 'Included free on every product, with multi-terabit scrubbing capacity',
            'Networking'     => 'Owned fibre backbone with 100Tbps+ capacity and private vRack networking',
            'Operating systems' => 'Linux distributions, Windows Server, VMware and custom images on dedicated',
            'Backups'        => 'Backup storage and snapshots available, mostly opt-in rather than default',
            'Compliance'     => 'ISO 27001, SOC 1/2, HDS health data, PCI DSS, GDPR by design',
            'Sovereignty'    => 'European-owned and operated, outside United States CLOUD Act reach',
            'Support'        => 'Ticket-based standard support, paid premium and enterprise tiers',
            'Uptime SLA'     => '99.9% to 99.99% depending on product',
        ],
        'performance' => 'On dedicated servers OVHcloud is exceptional value — you get real hardware, a huge bandwidth allowance and a well-peered network for a price that undercuts almost everyone. Public cloud and VPS performance is solid rather than class-leading, and the shared web hosting tier is the weakest part of the catalogue. The owned backbone means European latency is excellent; North American and Asian coverage exists but is thinner than the hyperscalers.',
        'security' => [
            'Unmetered anti-DDoS protection included on every product at no cost',
            'Private vRack networking between servers across data centres',
            'European data sovereignty with GDPR-aligned contracts and no CLOUD Act exposure',
            'ISO 27001, SOC 2, PCI DSS and HDS certifications across facilities',
            'Backup and snapshot services are available but must be configured deliberately',
        ],
        'pricing_notes' => [
            'Dedicated server pricing is among the lowest in the market for equivalent hardware.',
            'Setup fees apply to some dedicated ranges — check before ordering.',
            'Public cloud is billed hourly with published rates and generous included bandwidth in Europe.',
            'There is no blanket money-back guarantee; consumer web hosting has a statutory withdrawal period in the EU.',
        ],
        'migration' => 'No managed migration service for most products. Dedicated and VPS customers move their own workloads, though OVHcloud provides IP failover and vRack tooling that makes cutovers easier than average. Professional services are available on enterprise contracts.',
        'not_for' => [
            'Beginners who need guided support and a friendly panel',
            'Anyone who assumes backups are automatic — they must be configured',
            'Workloads that need deep managed-service catalogues',
            'Buyers whose audience is primarily in Asia or Latin America',
        ],
        'verdict' => 'The best value in European infrastructure, especially on bare metal, and the obvious answer when data sovereignty is a requirement rather than a preference. Configure your own backups on day one, and be comfortable operating without hand-holding.',
    ],

    'hetzner' => [
        'overview' => 'Hetzner is a German hosting company founded in 1997 that has quietly become the price-to-performance benchmark that every other provider is measured against. A Hetzner cloud instance with two dedicated vCPU, four gigabytes of RAM, forty gigabytes of NVMe and twenty terabytes of traffic costs about five euros a month. The equivalent at a hyperscaler costs five to ten times as much, largely because of egress pricing that Hetzner simply does not charge at those rates.

The company operates its own data centres in Falkenstein, Nuremberg and Helsinki, added Ashburn and Hillsboro in the United States in 2021, and Singapore in 2024. It builds its own racks, runs a large auction market for used dedicated servers at even lower prices, and invests heavily in renewable energy — the German and Finnish sites run on hydroelectric and wind power.

What you trade for the price is polish and hand-holding. Support is email-based and competent but not instant, the account verification process is stricter than most and can delay signup, there is no managed WordPress product, and the documentation assumes Linux competence. Hetzner is for people who know what they want.',
        'company' => [
            'Ownership'    => 'Privately held, founder-led by Martin Hetzner',
            'Headquarters' => 'Gunzenhausen, Germany',
            'Founded'      => '1997',
            'Scale'        => 'Hundreds of thousands of servers across Germany, Finland, the United States and Singapore',
            'Energy'       => 'German and Finnish facilities run on renewable hydro and wind power',
        ],
        'timeline' => [
            ['year' => 1997, 'event' => 'Founded by Martin Hetzner in Bavaria.'],
            ['year' => 2010, 'event' => 'Opens the Falkenstein data centre park, later one of Europe\'s largest.'],
            ['year' => 2018, 'event' => 'Launches Hetzner Cloud with per-hour billing and an API.'],
            ['year' => 2021, 'event' => 'Opens United States regions in Ashburn, Virginia and Hillsboro, Oregon.'],
            ['year' => 2024, 'event' => 'Adds a Singapore region, its first in Asia-Pacific.'],
        ],
        'hosting_types' => [
            ['name' => 'Cloud servers',      'from' => '$4.15/mo', 'note' => 'Shared and dedicated vCPU, ARM and x86, 20TB traffic included.'],
            ['name' => 'Dedicated servers',  'from' => '$39/mo',   'note' => 'Enterprise-grade hardware at prices well below the market.'],
            ['name' => 'Server auction',     'from' => '$28/mo',   'note' => 'Used dedicated hardware at steep discounts, available immediately.'],
            ['name' => 'Storage boxes',      'from' => '$3.60/mo', 'note' => 'Cheap bulk storage over SMB, WebDAV, SSH and rsync.'],
            ['name' => 'Managed web hosting','from' => '$5/mo',    'note' => 'Simple shared hosting with a control panel, German market focused.'],
        ],
        'specs' => [
            'Control panel'  => 'Hetzner Cloud Console and Robot, plus API, CLI and Terraform provider',
            'Virtualisation' => 'KVM with shared vCPU, dedicated vCPU and ARM64 Ampere options',
            'Storage'        => 'NVMe SSD local storage, network volumes, and S3-compatible object storage',
            'Traffic'        => '20TB included on most cloud plans, with very low overage rates',
            'Networking'     => 'Free private networks, cloud firewalls, floating IPs, IPv6',
            'Backups'        => 'Automatic backups at 20% of server price, plus free snapshots',
            'Load balancers' => 'Managed load balancers available from a few euros a month',
            'Locations'      => 'Germany, Finland, United States (two regions), Singapore',
            'Energy'         => 'Renewable power in the European facilities',
            'Support'        => 'Email and ticket support in German and English',
            'Uptime SLA'     => '99.9% with credits on cloud products',
        ],
        'performance' => 'Dedicated vCPU Hetzner cloud instances on NVMe are among the fastest euro-for-euro machines you can rent anywhere, and the included twenty terabytes of traffic removes the egress anxiety that shapes architecture decisions on AWS. European latency is excellent. The United States and Singapore regions are newer and have fewer instance types. The shared vCPU tier is genuinely shared, so production databases belong on the dedicated variants.',
        'security' => [
            'Free cloud firewalls and private networks between instances',
            'ISO 27001 certified data centres with biometric access control',
            'German and EU data protection law, with a strong privacy track record',
            'DDoS protection included at the network edge at no charge',
            'Automatic backups and free snapshots, both opt-in',
            'Strict identity verification at signup, which is a security feature and a friction point',
        ],
        'pricing_notes' => [
            'Prices are quoted in euros and include VAT handling for EU customers.',
            'No long-term contract on cloud; dedicated servers may carry a one-off setup fee.',
            'Automatic backups add 20% to the instance price.',
            'The server auction market is where the deepest dedicated discounts live.',
        ],
        'migration' => 'Self-service. Snapshots, rescue system boot and custom image support make moving in straightforward for anyone comfortable with Linux, but there is no migration team and no managed WordPress import.',
        'not_for' => [
            'Beginners or anyone needing managed hosting and phone support',
            'Buyers who need a managed WordPress or cPanel product out of the box',
            'Workloads requiring many global regions',
            'Accounts that cannot complete the identity verification process quickly',
        ],
        'verdict' => 'The best raw value in hosting, full stop, and the reason many agencies run their own infrastructure instead of buying managed plans. Choose dedicated vCPU instances for production, enable backups, and only buy here if you are comfortable being your own systems administrator.',
    ],

    'ionos' => [
        'overview' => 'IONOS is the hosting arm of United Internet, a German public company, and traces its origins to 1&1 in 1988 — which makes it one of the oldest hosting businesses still operating. It serves over eight million customers, mostly in Germany, the wider EU and the United States, and it operates its own data centres in Europe and North America rather than reselling capacity.

The product range is unusually wide for a company that markets to small businesses: shared hosting from about a dollar a month, managed WordPress, VPS, dedicated servers, an OpenStack-based Compute Engine cloud, managed Kubernetes, a domain registrar business, email, and an office productivity suite. Every account also gets a named personal consultant, which is genuinely unusual and genuinely useful for non-technical buyers.

The complaints are consistent across markets: introductory pricing that renews sharply higher, a contract structure with minimum terms and automatic renewal that European consumers are used to and American buyers often are not, and support quality that varies substantially by region. Read the contract terms carefully before purchase; the product itself is technically sound.',
        'company' => [
            'Ownership'    => 'United Internet AG, publicly listed in Germany',
            'Headquarters' => 'Montabaur, Germany',
            'Founded'      => '1988 as 1&1, rebranded IONOS in 2018',
            'Scale'        => '8 million+ customers, 22 million domains under management',
            'Facilities'   => 'Owned data centres in Germany, the UK, Spain, France and the United States',
        ],
        'timeline' => [
            ['year' => 1988, 'event' => 'Founded as 1&1 in Montabaur, Germany.'],
            ['year' => 1998, 'event' => 'Expands into the United States and United Kingdom markets.'],
            ['year' => 2018, 'event' => 'Merges with ProfitBricks and rebrands the hosting business as IONOS.'],
            ['year' => 2021, 'event' => 'Launches IONOS Cloud with OpenStack-based Compute Engine and managed Kubernetes.'],
            ['year' => 2023, 'event' => 'Lists separately on the Frankfurt Stock Exchange.'],
        ],
        'hosting_types' => [
            ['name' => 'Web hosting',        'from' => '$1/mo',    'note' => 'Essential through Expert, with a free domain and email included.'],
            ['name' => 'Managed WordPress',  'from' => '$1/mo',    'note' => 'WordPress with automatic updates and a starter assistant.'],
            ['name' => 'VPS',                'from' => '$2/mo',    'note' => 'Full root access, unlimited traffic, NVMe storage.'],
            ['name' => 'Dedicated servers',  'from' => '$45/mo',   'note' => 'Bare metal billed by the minute, no minimum term.'],
            ['name' => 'IONOS Cloud',        'from' => 'Hourly',   'note' => 'Enterprise compute, block storage and managed Kubernetes.'],
        ],
        'specs' => [
            'Control panel'  => 'IONOS custom panel, with Plesk available on VPS and dedicated',
            'Web server'     => 'NGINX and Apache depending on product',
            'Storage'        => 'NVMe SSD across the current VPS and dedicated ranges',
            'PHP versions'   => 'PHP 7.x through 8.x with per-site selection',
            'Backups'        => 'Daily backups included on most web hosting tiers',
            'Email'          => 'Mailboxes included with hosting plans, plus a separate email product',
            'Personal consultant' => 'A named advisor assigned to every account',
            'Networking'     => 'Unlimited traffic on most VPS and dedicated products',
            'Compliance'     => 'ISO 27001, GDPR-aligned, EU data residency options',
            'Support'        => '24/7 phone and chat in local languages',
            'Uptime SLA'     => '99.9% on shared, up to 99.99% on cloud',
        ],
        'performance' => 'Solid and unremarkable, which at a dollar a month is a compliment. European data centres give good regional latency, the United States facilities cover North America, and NVMe storage on newer plans keeps things responsive. The dedicated and cloud products are enterprise-grade; the cheapest shared tiers are resource-constrained in the way a one-dollar plan must be.',
        'security' => [
            'Free Wildcard SSL included on most hosting plans',
            'DDoS protection across the network at no extra charge',
            'Daily backups with restore included on standard web hosting',
            'ISO 27001 certified facilities with EU data residency guarantees',
            'Two-factor authentication and a site scanning tool on higher tiers',
        ],
        'pricing_notes' => [
            'The one-dollar headline rate is an introductory term; renewal is several times higher.',
            'Contracts carry minimum terms with automatic renewal — note the cancellation window.',
            'Domains renew at standard registry rates after the free first year.',
            'A 30-day money-back guarantee applies in most markets.',
        ],
        'migration' => 'IONOS offers free migration assistance through support and a WordPress import tool, and the assigned personal consultant will coordinate the move. It is not a white-glove engineering service, but it is more help than most budget hosts offer.',
        'not_for' => [
            'Buyers who dislike minimum-term contracts and automatic renewal',
            'Developers wanting modern Git-based workflows and staging on cheap plans',
            'Anyone who wants transparent flat pricing with no introductory discounting',
            'Support-sensitive customers outside the core European markets',
        ],
        'verdict' => 'A serious, long-established European host with a genuinely broad catalogue and the unusual benefit of a named human advisor. Buy it for a European small business site or a cheap dedicated server, read the contract term carefully, and treat the introductory price as a first-year offer rather than the real cost.',
    ],

    'hostwinds' => [
        'overview' => 'Hostwinds is a Seattle-based host founded in 2010 that has built a loyal following on two things: a very wide product ladder that runs from three-dollar shared hosting to enterprise dedicated servers, and support that customers consistently describe as the best part of the company. Live chat answers in seconds, tickets get technical answers rather than scripts, and phone support exists on every tier.

The technical offering is generous rather than cutting-edge. Unlimited bandwidth and disk on shared plans, cPanel included, nightly backups, free dedicated IP and SSL, and an unusually cheap unmanaged VPS range that starts around five dollars with full root and a choice of Linux or Windows. The cloud product is really hourly-billed VPS with snapshot and resize features rather than a full cloud platform.

Where it falls short is geography and performance leadership. Three data centres — Seattle, Dallas and Amsterdam — is thin for a global audience, and the stack is Apache-based rather than LiteSpeed, so it does not compete with Hostinger or A2 Turbo on raw benchmarks. What it competes on is being helpful.',
        'company' => [
            'Ownership'    => 'Privately held, independent',
            'Headquarters' => 'Seattle, Washington, United States',
            'Founded'      => '2010',
            'Scale'        => 'Tens of thousands of customers across shared, VPS and dedicated',
            'Notable'      => 'Consistently rated top-tier for support responsiveness',
        ],
        'timeline' => [
            ['year' => 2010, 'event' => 'Founded in Oklahoma, later headquartered in Seattle.'],
            ['year' => 2013, 'event' => 'Adds unmanaged and managed VPS with hourly billing.'],
            ['year' => 2016, 'event' => 'Opens a European data centre in Amsterdam.'],
            ['year' => 2019, 'event' => 'Introduces cloud portal features including snapshots and instant resize.'],
            ['year' => 2022, 'event' => 'Refreshes the dedicated range with NVMe and higher bandwidth allowances.'],
        ],
        'hosting_types' => [
            ['name' => 'Shared hosting',    'from' => '$3.29/mo',  'note' => 'Basic, Advanced and Ultimate with unlimited disk and bandwidth.'],
            ['name' => 'Business hosting',  'from' => '$8.99/mo',  'note' => 'Lower density shared with a free dedicated IP and SSL.'],
            ['name' => 'VPS hosting',       'from' => '$4.99/mo',  'note' => 'Managed or unmanaged, Linux or Windows, hourly or monthly.'],
            ['name' => 'Cloud servers',     'from' => '$4.99/mo',  'note' => 'Hourly-billed instances with snapshots and instant resize.'],
            ['name' => 'Dedicated servers', 'from' => '$106/mo',   'note' => 'Custom hardware configuration with managed options.'],
            ['name' => 'Reseller hosting',  'from' => '$4.99/mo',  'note' => 'cPanel and WHM with white-label branding and billing.'],
        ],
        'specs' => [
            'Control panel'  => 'cPanel and WHM, with a custom cloud portal for VPS',
            'Web server'     => 'Apache with caching, LiteSpeed available on some plans',
            'Storage'        => 'SSD standard, NVMe on newer dedicated hardware',
            'Bandwidth'      => 'Unlimited on shared, generous metered allowances on VPS',
            'Backups'        => 'Nightly backups included on Business plans, optional elsewhere',
            'SSH access'     => 'Yes, across shared and VPS',
            'Operating systems' => 'Linux distributions and Windows Server on VPS and dedicated',
            'Free extras'    => 'Dedicated IP and SSL on Business tier, free website transfer',
            'Support'        => '24/7 phone, live chat and tickets, rated highly by customers',
            'Uptime SLA'     => '99.9999% claimed on the network, with credits',
        ],
        'performance' => 'Adequate on shared, strong on VPS for the money. The three data centres cover the United States west and central regions plus Western Europe, leaving Asia, Oceania, Africa and South America dependent on a CDN. The unmanaged VPS range is the sweet spot: for five to ten dollars a month you get real root access with more resources than competitors at the same price, and support that will still help you when something breaks.',
        'security' => [
            'Free SSL certificates, with a dedicated IP included on Business plans',
            'Nightly backups on Business tier with restore assistance from support',
            'Network-level DDoS protection included',
            'Server monitoring with proactive alerting on managed plans',
            'Two-factor authentication on the client area',
        ],
        'pricing_notes' => [
            'Introductory discounting is steep; renewal roughly doubles.',
            'Unmanaged VPS pricing is honest and does not carry an introductory cliff.',
            'Managed VPS adds a monthly management fee over the unmanaged price.',
            'A 60-day money-back guarantee applies to shared hosting, longer than most.',
        ],
        'migration' => 'Free website transfers are included and handled by the support team, with cPanel-to-cPanel moves being routine. The team will coordinate timing, which fits the company\'s general support-forward posture.',
        'not_for' => [
            'Audiences in Asia-Pacific, Africa or South America without a CDN',
            'Sites chasing benchmark-leading speed on shared hosting',
            'Buyers who want a modern custom panel instead of cPanel',
            'Anyone needing a managed WordPress product with staging and Git',
        ],
        'verdict' => 'Buy Hostwinds for the support and the cheap, generous VPS range rather than for benchmark performance. The 60-day guarantee and month-to-month options make it a low-risk place to land, and the unmanaged VPS tier is one of the better values in the market.',
    ],

    'liquid-web' => [
        'overview' => 'Liquid Web sells to a narrow audience and sells to it very well: businesses for whom hosting is a cost of doing business rather than a line item to minimise. Founded in Michigan in 1997, it operates its own data centres, employs its own engineers around the clock — it calls them the Most Helpful Humans in Hosting and backs the claim with a 59-second live chat and 59-second phone response guarantee — and offers a 100% uptime SLA on power and network with real financial compensation of ten times the affected downtime.

There is no cheap tier. The floor is around twenty-nine dollars a month for managed WordPress and climbs steeply through managed VPS, cloud dedicated, and fully managed bare metal. In exchange, every plan is fully managed: the team patches your operating system, tunes your stack, monitors your services and will get on the phone at two in the morning.

The family includes Nexcess, its managed WordPress and WooCommerce brand, and StellarWP, which owns a substantial portfolio of WordPress plugins including The Events Calendar, LearnDash, GiveWP and Kadence. That plugin ownership gives Liquid Web unusual visibility into how WordPress behaves at scale.',
        'company' => [
            'Ownership'     => 'Privately held, backed by Madison Dearborn Partners',
            'Headquarters'  => 'Lansing, Michigan, United States',
            'Founded'       => '1997',
            'Scale'         => '45,000+ customers in 150 countries, 500,000+ sites managed',
            'Sister brands' => 'Nexcess, StellarWP, iThemes, The Events Calendar, LearnDash',
        ],
        'timeline' => [
            ['year' => 1997, 'event' => 'Founded by Matthew Hill in Lansing, Michigan.'],
            ['year' => 2015, 'event' => 'Acquires Rackspace\'s cloud sites business and expands managed hosting.'],
            ['year' => 2019, 'event' => 'Acquires Nexcess, adding managed WordPress and WooCommerce.'],
            ['year' => 2021, 'event' => 'Forms StellarWP, consolidating a large WordPress plugin portfolio.'],
            ['year' => 2023, 'event' => 'Expands cloud VPS with NVMe storage and a refreshed managed WordPress stack.'],
        ],
        'hosting_types' => [
            ['name' => 'Managed WordPress',  'from' => '$29/mo',   'note' => 'Fully managed with staging, iThemes Security Pro and image compression.'],
            ['name' => 'Managed WooCommerce','from' => '$49/mo',   'note' => 'Store-tuned stack with performance testing and sales analytics.'],
            ['name' => 'Cloud VPS',          'from' => '$25/mo',   'note' => 'Managed KVM instances with cPanel, Plesk or InterWorx.'],
            ['name' => 'Cloud dedicated',    'from' => '$169/mo',  'note' => 'Single-tenant hardware provisioned like a cloud instance.'],
            ['name' => 'Dedicated servers',  'from' => '$199/mo',  'note' => 'Fully managed bare metal with hardware choice and RAID.'],
            ['name' => 'Managed hosting for agencies','from' => 'Custom','note' => 'White-label reseller programmes with dedicated account teams.'],
        ],
        'specs' => [
            'Control panel'  => 'cPanel, Plesk or InterWorx included on most plans',
            'Management'     => 'Fully managed: operating system patching, stack tuning, monitoring and incident response',
            'Support SLA'    => '59-second initial response on chat and phone, 30-minute ticket response',
            'Uptime SLA'     => '100% power and network uptime with 10x downtime compensation',
            'Storage'        => 'NVMe and SSD with hardware RAID on dedicated',
            'Backups'        => 'Acronis Cyber Backup included or available on all plans',
            'Security'       => 'ServerSecure hardening applied to every managed server',
            'Compliance'     => 'PCI DSS, HIPAA and SOC readiness with compliance-ready hosting tiers',
            'Data centres'   => 'Lansing and Phoenix in the United States, plus Amsterdam',
            'Monitoring'     => '24/7 proactive monitoring with automatic incident escalation',
        ],
        'performance' => 'Performance is a function of dedicated resources rather than clever caching. Because nothing is shared and the team tunes the stack for your workload, Liquid Web servers behave predictably under sustained load in a way shared and even most managed WordPress hosts do not. The three data centre locations are a limitation for a global audience, but the target customer usually pairs the origin with a commercial CDN anyway.',
        'security' => [
            'ServerSecure hardening applied to every managed server as standard',
            'Included Acronis Cyber Backup with off-site retention and restore testing',
            'PCI DSS and HIPAA compliant hosting configurations with signed business associate agreements',
            'DDoS protection and managed firewall included on all plans',
            'Integrated malware scanning and remediation performed by the support team',
            'SOC 2 audited facilities that Liquid Web owns and operates',
        ],
        'pricing_notes' => [
            'There is no budget tier; entry is around $29 a month and climbs quickly.',
            'Annual billing carries a meaningful discount over month-to-month.',
            'Fully managed means labour is included — compare against unmanaged cost plus your own time.',
            'A 30-day money-back guarantee applies to managed WordPress and WooCommerce plans.',
        ],
        'migration' => 'Free, engineer-performed migrations are included on every plan, with a scheduled cutover, pre-migration testing and rollback available. This is a white-glove process comparable to Kinsta and WP Engine, and it extends to complex non-WordPress applications.',
        'not_for' => [
            'Personal sites, hobby projects or anything price-sensitive',
            'Developers who want raw unmanaged infrastructure at cloud prices',
            'Global audiences needing many origin regions without a CDN',
            'Buyers who do not value included management labour',
        ],
        'verdict' => 'The right host when downtime has a dollar figure attached and you want engineers on call rather than a knowledge base. Expensive by design, genuinely fully managed, and the compliance-ready tiers make it one of the few practical options for HIPAA or PCI workloads on a mid-size budget.',
    ],

    'hostpapa' => [
        'overview' => 'HostPapa is a Canadian company founded in Toronto in 2006 that markets specifically to small businesses, with a support model built around that audience: every new customer is offered a one-on-one onboarding session with a support representative who walks through the control panel and helps get the first site live. For a segment of buyers who find hosting genuinely intimidating, that is worth more than a faster server.

The platform itself is conventional cPanel shared hosting with LiteSpeed on newer plans, SSD storage, free domain registration, unlimited bandwidth on most tiers, and a bundled website builder. HostPapa also matches 100% of its energy consumption with renewable energy credits, which puts it in the same green bracket as GreenGeeks and A2.

The company has grown substantially by acquisition, absorbing Canadian and European hosts including Deluxe Hosting and parts of the former Host Nordic group, which means the customer experience varies depending on which platform your account sits on. Renewal pricing follows the usual industry pattern of roughly tripling.',
        'company' => [
            'Ownership'    => 'Privately held, Canadian owned',
            'Headquarters' => 'Burlington, Ontario, Canada',
            'Founded'      => '2006 by Jamie Opalchuk',
            'Scale'        => 'Over 500,000 websites hosted worldwide',
            'Sustainability' => 'Matches 100% of energy use with renewable energy credits',
        ],
        'timeline' => [
            ['year' => 2006, 'event' => 'Founded in Ontario with a small business focus.'],
            ['year' => 2011, 'event' => 'Commits to matching energy consumption with green energy credits.'],
            ['year' => 2018, 'event' => 'Expands into Europe with acquisitions and EU data centre capacity.'],
            ['year' => 2021, 'event' => 'Adds LiteSpeed and NVMe to the refreshed shared hosting range.'],
            ['year' => 2023, 'event' => 'Expands managed WordPress and small business marketing services.'],
        ],
        'hosting_types' => [
            ['name' => 'Shared hosting',    'from' => '$2.95/mo',  'note' => 'Starter, Plus and Pro with a free domain and builder.'],
            ['name' => 'WordPress hosting', 'from' => '$3.95/mo',  'note' => 'Optimised WordPress with automatic updates and caching.'],
            ['name' => 'VPS hosting',       'from' => '$19.99/mo', 'note' => 'Managed VPS with cPanel and root access.'],
            ['name' => 'Reseller hosting',  'from' => '$29.99/mo', 'note' => 'WHM with white-label branding for agencies.'],
        ],
        'specs' => [
            'Control panel'  => 'cPanel',
            'Web server'     => 'Apache, with LiteSpeed on current plans',
            'Storage'        => 'SSD, NVMe on newer hardware',
            'PHP versions'   => 'PHP 7.x through 8.x with per-account switching',
            'Backups'        => 'Automated backups on Plus and Pro tiers',
            'SSH access'     => 'Yes, on higher shared tiers',
            'Free migration' => 'Free site transfer included with new accounts',
            'Onboarding'     => 'One-on-one setup session with a support representative',
            'Email'          => 'Included mailboxes with spam filtering',
            'Data centres'   => 'Canada, United States, Europe and Asia through partners',
            'Uptime SLA'     => '99.9% with credit policy',
        ],
        'performance' => 'Middle of the pack. LiteSpeed on the current generation of plans lifts WordPress performance above the Apache-era baseline, and the Canadian and European data centre options are useful for local audiences. It will not win benchmark comparisons against Hostinger or SiteGround, and the Starter tier is resource-limited enough that a growing site should start at Plus.',
        'security' => [
            'Free Let\'s Encrypt SSL on all domains',
            'Server firewall, brute-force protection and intrusion detection',
            'Automated backups on Plus and Pro with restore support',
            'Free domain privacy on higher tiers',
            'Two-factor authentication on the customer dashboard',
        ],
        'pricing_notes' => [
            'The advertised price needs a 36-month term; shorter terms cost substantially more.',
            'Renewal is roughly three times the introductory rate.',
            'Backups are only included from the Plus tier upward.',
            'A 30-day money-back guarantee applies to hosting but not domains.',
        ],
        'migration' => 'Free migration is included with new accounts and performed by the support team, with the onboarding call available to walk through the result. It is a friendly process rather than a technically sophisticated one.',
        'not_for' => [
            'Performance-critical or high-traffic sites',
            'Developers wanting Git workflows, staging and modern tooling',
            'Buyers unwilling to commit to a three-year term',
            'Anyone who wants included backups on the cheapest plan',
        ],
        'verdict' => 'A friendly, green, small-business host whose one-on-one onboarding genuinely helps non-technical owners get started. Buy the Plus tier so backups are included, expect competent rather than fast performance, and plan for the renewal increase.',
    ],

    'fastcomet' => [
        'overview' => 'FastComet is a Bulgarian-founded, San Francisco-registered host that competes on two unusual promises. The first is a price-lock: the rate you sign up at is the rate you renew at, for as long as you stay, which removes the single most common complaint about the entire shared hosting industry. The second is geography: eleven data centre locations spanning North America, Europe, Asia and Australia, which is far more than any competitor at its price.

The stack is cPanel on SSD with a free Cloudflare CDN, free daily and weekly backups retained for 7 to 30 days, free domain transfer for life on annual plans, and free migrations. On the cloud VPS side, FastComet sells managed instances with the same panel and support model, which makes upgrading from shared straightforward.

The catch is resource limits. Entry plans cap concurrent connections, processes and inodes tightly, and FastComet enforces those limits rather than quietly overselling. That honesty is good practice and means a busy site needs a higher tier sooner than the marketing implies.',
        'company' => [
            'Ownership'    => 'Privately held, independent',
            'Headquarters' => 'San Francisco, California, with engineering in Sofia, Bulgaria',
            'Founded'      => '2013',
            'Scale'        => 'Tens of thousands of customers across 11 global data centres',
            'Notable'      => 'Price-lock guarantee — no renewal increase, ever',
        ],
        'timeline' => [
            ['year' => 2013, 'event' => 'Founded with a global multi-region shared hosting model.'],
            ['year' => 2016, 'event' => 'Introduces the price-lock guarantee on renewals.'],
            ['year' => 2018, 'event' => 'Expands to data centres in Asia and Australia.'],
            ['year' => 2020, 'event' => 'Adds free daily backups and a free Cloudflare CDN to all plans.'],
            ['year' => 2022, 'event' => 'Refreshes the cloud VPS range with NVMe storage.'],
        ],
        'hosting_types' => [
            ['name' => 'Shared hosting',   'from' => '$2.19/mo',  'note' => 'FastCloud, FastCloud Plus and FastCloud Extra on cPanel.'],
            ['name' => 'WordPress hosting','from' => '$2.19/mo',  'note' => 'Same plans preconfigured with WordPress and caching.'],
            ['name' => 'Cloud VPS',        'from' => '$59.95/mo', 'note' => 'Managed VPS with cPanel, dedicated resources and root access.'],
            ['name' => 'Dedicated CPU servers','from' => '$111/mo','note' => 'Fully managed dedicated resources across the same regions.'],
        ],
        'specs' => [
            'Control panel'  => 'cPanel',
            'Web server'     => 'Apache with NGINX reverse proxy and caching',
            'Storage'        => 'SSD on shared, NVMe on current cloud VPS',
            'PHP versions'   => 'PHP 5.6 through 8.x for legacy compatibility',
            'Backups'        => 'Free daily and weekly backups, 7 to 30 day retention',
            'CDN'            => 'Free Cloudflare CDN on every plan',
            'SSH access'     => 'Yes, on all shared plans',
            'Free migration' => 'Free unlimited website transfers, handled by the team',
            'Domain'         => 'Free domain transfer for life on annual plans',
            'Locations'      => '11 data centres across 4 continents',
            'Price lock'     => 'Renewal at the signup rate, guaranteed',
            'Uptime SLA'     => '99.9% with credits',
        ],
        'performance' => 'The multi-region footprint is the performance advantage. Putting a shared hosting origin in Tokyo, Singapore, Mumbai, Sydney, Frankfurt, Amsterdam, London, Toronto, Dallas, Chicago or Newark, and layering a free Cloudflare CDN on top, means visitors almost anywhere get a short round trip. The stack itself is Apache with NGINX caching rather than LiteSpeed, so raw benchmarks are good rather than exceptional, and the tight resource caps on the entry plan are the practical ceiling.',
        'security' => [
            'Free SSL on all domains with automatic renewal',
            'Free daily and weekly backups with self-service restore',
            'Multi-layer firewall with real-time malware scanning',
            'Free Cloudflare integration for DDoS mitigation',
            'Account isolation between shared hosting tenants',
            'Two-factor authentication on the client portal',
        ],
        'pricing_notes' => [
            'The price-lock guarantee means no renewal increase, which is genuinely rare.',
            'Longer terms still carry a discount, but the renewal rate matches the signup rate.',
            'Resource limits on the entry tier are enforced rather than oversold.',
            'A 45-day money-back guarantee applies, longer than the sector norm.',
        ],
        'migration' => 'Free unlimited migrations on every plan, handled by the support team including cPanel and non-cPanel sources. This is one of the more generous migration policies in shared hosting, matched only by Verpex and ChemiCloud.',
        'not_for' => [
            'High-traffic sites that will hit concurrent-process limits quickly',
            'Buyers who want LiteSpeed-level shared hosting benchmarks',
            'Anyone needing a large managed WordPress feature set with staging and Git',
            'Cloud VPS shoppers on a budget — the VPS range starts high',
        ],
        'verdict' => 'The price-lock and the eleven-region footprint together make FastComet one of the most honest offers in shared hosting, especially for audiences outside North America and Europe. Size the plan for your actual traffic rather than the headline rate, because the resource limits are real.',
    ],

    'interserver' => [
        'overview' => 'InterServer has been running since 1999 out of New Jersey, is still owned by its two founders, and has built its reputation on a single commercial idea taken seriously: the price you sign up at never goes up. Its standard shared plan is a flat monthly rate with unlimited storage, bandwidth, email accounts and sites, and that rate is locked for the life of the account. No introductory discount, no renewal cliff, no three-year prepayment.

The technical platform is quietly competent. cPanel or DirectAdmin, an in-house security product called InterShield that blocks web attacks and scans for malware, free migrations, a choice of United States data centres in Secaucus and Los Angeles, and a VPS range priced per slice so you can buy exactly the resources you need and scale in single-dollar increments.

What you do not get is polish, a global footprint or a managed WordPress experience. InterServer is a no-nonsense host for people who want a predictable bill and a server that works, and it has kept that promise for a quarter of a century.',
        'company' => [
            'Ownership'    => 'Privately held, owned by founders Mike Lavrik and John Quaglieri',
            'Headquarters' => 'Secaucus, New Jersey, United States',
            'Founded'      => '1999',
            'Scale'        => 'Operates its own data centre facilities in New Jersey and Los Angeles',
            'Notable'      => 'Price-lock guarantee honoured since founding',
        ],
        'timeline' => [
            ['year' => 1999, 'event' => 'Founded in New Jersey by two high-school friends.'],
            ['year' => 2010, 'event' => 'Opens its own Secaucus data centre facility.'],
            ['year' => 2014, 'event' => 'Introduces InterShield, an in-house web attack and malware protection layer.'],
            ['year' => 2018, 'event' => 'Adds a Los Angeles West Coast facility and slice-based VPS pricing.'],
            ['year' => 2021, 'event' => 'Expands storage and dedicated ranges while maintaining flat pricing.'],
        ],
        'hosting_types' => [
            ['name' => 'Shared hosting',    'from' => '$2.50/mo',  'note' => 'One flat plan: unlimited sites, storage, bandwidth and email.'],
            ['name' => 'WordPress hosting', 'from' => '$2.50/mo',  'note' => 'Same plan with WordPress preinstalled and managed updates.'],
            ['name' => 'VPS hosting',       'from' => '$6/mo',     'note' => 'Slice-based pricing, Linux or Windows, managed or unmanaged.'],
            ['name' => 'Dedicated servers', 'from' => '$50/mo',    'note' => 'Bare metal with a wide hardware catalogue and quick provisioning.'],
            ['name' => 'Colocation',        'from' => 'Custom',    'note' => 'Rack space in its own New Jersey and Los Angeles facilities.'],
        ],
        'specs' => [
            'Control panel'  => 'cPanel on shared, DirectAdmin or cPanel on VPS',
            'Web server'     => 'Apache with caching; LiteSpeed available on some plans',
            'Storage'        => 'SSD across shared and VPS ranges',
            'Bandwidth'      => 'Unlimited on shared hosting under fair use',
            'Backups'        => 'Weekly backups included, with paid daily options',
            'Security'       => 'InterShield in-house web attack protection and malware scanning',
            'SSH access'     => 'Yes, on shared and VPS',
            'Free migration' => 'Free migrations on all plans',
            'Scaling'        => 'VPS sold in slices so you buy exactly what you need',
            'Price lock'     => 'Signup rate guaranteed for the life of the account',
            'Uptime SLA'     => '99.9% with credits',
        ],
        'performance' => 'Solid mid-table performance from two well-connected United States facilities that InterServer owns rather than rents. For a North American audience that is perfectly good; for anyone else the lack of international locations is the limiting factor and a CDN is essential. The VPS range is the better value, because slice-based pricing lets you buy dedicated resources cheaply and scale precisely.',
        'security' => [
            'InterShield protection, an in-house layer blocking web attacks and scanning for malware',
            'Free SSL certificates on all hosted domains',
            'Weekly backups included, with paid daily backup options',
            'Machine-learning firewall rules maintained in-house',
            'Owned data centres with physical access control',
        ],
        'pricing_notes' => [
            'No introductory pricing games — the signup rate is the permanent rate.',
            'A coupon often makes the first month near-free, after which the standard rate applies.',
            'VPS pricing is linear per slice, so costs scale predictably.',
            'A 30-day money-back guarantee applies to shared hosting.',
        ],
        'migration' => 'Free migrations on every plan, handled by the support team. cPanel-to-cPanel is routine and the team will handle more complex moves on request without an extra charge, which is unusual at this price.',
        'not_for' => [
            'Non-United States audiences without a CDN',
            'Buyers who want a modern dashboard and managed WordPress polish',
            'Sites needing staging environments and Git-based deploys',
            'Anyone who values brand and design over substance',
        ],
        'verdict' => 'The most honest pricing in hosting, backed by twenty-five years of actually honouring it. Plain, fast enough, well-secured and completely free of renewal games. Choose the VPS range if you need dedicated resources, and add a CDN if your readers are not in North America.',
    ],

    'scala-hosting' => [
        'overview' => 'Scala Hosting is a Bulgarian-American company that made an unusual bet: rather than license cPanel like everyone else, it spent years building SPanel, a complete control panel and server management suite of its own, and then gave it away free with its managed VPS plans. Because a cPanel licence costs a VPS owner real money every month, that single decision makes Scala managed VPS meaningfully cheaper than equivalent offerings.

SPanel is more than a cPanel clone. It includes SShield, a machine-learning security monitor that Scala claims blocks 99.998% of attacks and that will automatically block an attacker and notify you, plus SWordPress Manager for one-click security locking, automatic updates and staging. The company also runs self-healing infrastructure that detects a failing service and restarts or migrates it without human intervention.

Shared hosting exists and is fine, but the managed VPS product is the reason to look at Scala at all. It puts dedicated resources, a real control panel, managed support and free migrations at a price point that usually only buys a shared plan.',
        'company' => [
            'Ownership'    => 'Privately held, independent',
            'Headquarters' => 'Dallas, Texas, with engineering in Sofia, Bulgaria',
            'Founded'      => '2007',
            'Scale'        => 'Around 700,000 websites hosted',
            'Notable'      => 'Built and owns SPanel, a full cPanel alternative given free with VPS plans',
        ],
        'timeline' => [
            ['year' => 2007, 'event' => 'Founded in Bulgaria as a shared and VPS host.'],
            ['year' => 2016, 'event' => 'Begins development of SPanel as a cPanel replacement.'],
            ['year' => 2019, 'event' => 'Launches SShield, a machine-learning security monitor bundled with SPanel.'],
            ['year' => 2021, 'event' => 'Ships self-healing managed VPS with automatic service recovery.'],
            ['year' => 2023, 'event' => 'Expands SPanel availability and adds more global VPS locations.'],
        ],
        'hosting_types' => [
            ['name' => 'Shared hosting',    'from' => '$3.95/mo',  'note' => 'cPanel-based entry plans with free SSL and daily backups.'],
            ['name' => 'Managed VPS',       'from' => '$29.95/mo', 'note' => 'Dedicated resources with free SPanel, SShield and full management.'],
            ['name' => 'WordPress hosting', 'from' => '$3.95/mo',  'note' => 'SWordPress Manager with security locking and staging.'],
            ['name' => 'Reseller hosting',  'from' => '$19.95/mo', 'note' => 'White-label accounts with unlimited SPanel licences.'],
        ],
        'specs' => [
            'Control panel'  => 'SPanel (in-house) on VPS, cPanel on shared',
            'Security'       => 'SShield machine-learning attack blocking, included free',
            'Web server'     => 'Apache with NGINX and OpenLiteSpeed options',
            'Storage'        => 'NVMe SSD on current VPS hardware',
            'Backups'        => 'Daily off-site backups with self-service restore',
            'Staging'        => 'Yes, through SWordPress Manager',
            'Self-healing'   => 'Automatic detection and recovery of failed services',
            'SSH access'     => 'Yes, with full root on VPS',
            'Free migration' => 'Free unlimited migrations on managed VPS',
            'Licences'       => 'Unlimited free SPanel accounts, no per-account fee',
            'Uptime SLA'     => '99.9% with credits',
        ],
        'performance' => 'The managed VPS product is where Scala performs. Dedicated vCPU and RAM on NVMe, with a tuned web stack and no shared neighbours, comfortably outruns any shared plan and holds up under sustained traffic. Shared hosting is ordinary. Data centre choice spans the United States and Europe with Asian options through partners, so global audiences should still add a CDN.',
        'security' => [
            'SShield real-time attack blocking with automated response and email alerts',
            'Free SSL with automatic installation and renewal through SPanel',
            'Daily automated off-site backups with one-click restore',
            'Account isolation on shared, full resource isolation on VPS',
            'SWordPress Manager security lock, which makes core files unwritable to block injection',
            'Self-healing services that restart automatically after a failure',
        ],
        'pricing_notes' => [
            'Managed VPS pricing undercuts competitors largely because there is no cPanel licence fee.',
            'Shared plans use standard introductory discounting with a renewal increase.',
            'SPanel accounts are unlimited and free, which matters for resellers and agencies.',
            'A 30-day money-back guarantee applies across the range.',
        ],
        'migration' => 'Free unlimited migrations on managed VPS, performed by the support team, including cPanel-to-SPanel conversions which the team handles routinely. Shared plans include a free transfer as well.',
        'not_for' => [
            'Buyers who require cPanel specifically and will not use an alternative panel',
            'Very high traffic applications needing multi-server architecture',
            'Audiences in Asia-Pacific or Africa wanting a local origin',
            'Anyone wanting the absolute cheapest shared hosting',
        ],
        'verdict' => 'Skip the shared plans and buy the managed VPS. Free SPanel plus SShield plus real dedicated resources plus free migrations at around thirty dollars a month is one of the strongest value propositions in managed hosting, provided you are comfortable leaving cPanel behind.',
    ],

    'contabo' => [
        'overview' => 'Contabo is a German provider founded in Munich in 2003 that sells one thing better than anyone: quantity. For the price of a small instance elsewhere, a Contabo VPS gives you four or eight vCPU cores, eight to thirty gigabytes of RAM and hundreds of gigabytes of storage. For workloads that need headroom more than they need peak single-thread speed — game servers, development environments, media libraries, self-hosted applications, backup targets — the value is hard to argue with.

The trade-offs are consistent and well documented by its users. The CPU cores are shared and can be contended during busy periods, storage is often SATA or slower NVMe rather than the fastest tier unless you pay for the NVMe option, provisioning can take hours rather than seconds, and support is email-based with a slower cadence than a cloud provider. Snapshots and backups are extras.

Contabo is not a cloud in the modern sense, and it is not trying to be. It is cheap, large virtual machines from a company that owns its own data centres in Germany and rents capacity in nine other regions worldwide.',
        'company' => [
            'Ownership'    => 'Backed by Oakley Capital since 2019',
            'Headquarters' => 'Munich, Germany',
            'Founded'      => '2003',
            'Scale'        => 'Hundreds of thousands of servers across 10+ global regions',
            'Notable'      => 'Among the lowest cost per gigabyte of RAM in the industry',
        ],
        'timeline' => [
            ['year' => 2003, 'event' => 'Founded in Munich as a dedicated server provider.'],
            ['year' => 2012, 'event' => 'Launches the low-cost VPS range that defines its reputation.'],
            ['year' => 2019, 'event' => 'Receives investment from Oakley Capital and begins global expansion.'],
            ['year' => 2021, 'event' => 'Opens data centres in the United States, Singapore, Japan and Australia.'],
            ['year' => 2023, 'event' => 'Adds S3-compatible object storage and NVMe storage options.'],
        ],
        'hosting_types' => [
            ['name' => 'Cloud VPS',        'from' => '$4.99/mo',  'note' => 'Large shared-core instances with generous RAM and storage.'],
            ['name' => 'VDS',              'from' => '$29.99/mo', 'note' => 'Dedicated cores for consistent performance.'],
            ['name' => 'Dedicated servers','from' => '$49/mo',    'note' => 'Bare metal from its own German facilities.'],
            ['name' => 'Object storage',   'from' => '$2.99/mo',  'note' => 'S3-compatible storage priced well below hyperscaler rates.'],
            ['name' => 'Web hosting',      'from' => '$3.99/mo',  'note' => 'Basic shared hosting, a minor part of the catalogue.'],
        ],
        'specs' => [
            'Control panel'  => 'Customer control panel; cPanel, Plesk and Webmin available as options',
            'Virtualisation' => 'KVM, with shared cores on VPS and dedicated cores on VDS',
            'Storage'        => 'SSD standard, NVMe optional, very large capacities included',
            'Traffic'        => '32TB included per month on most VPS plans in Europe',
            'Operating systems' => 'All major Linux distributions plus Windows Server licences',
            'Backups'        => 'Auto-backup available as a paid add-on, snapshots included on newer plans',
            'Locations'      => 'Germany, United States, United Kingdom, Singapore, Japan, Australia, India',
            'Provisioning'   => 'Can take hours rather than minutes, especially on first order',
            'Support'        => 'Email and ticket support, no live chat',
            'Uptime SLA'     => '99.9% network availability',
        ],
        'performance' => 'Generous on paper and variable in practice. RAM and storage are exactly as advertised and enormous for the money; CPU is shared on the standard VPS range and can be contended, which shows up as inconsistent response times under load. The VDS range with dedicated cores fixes this and still undercuts most competitors. Storage speed depends on which tier you buy, so specify NVMe if input and output matters.',
        'security' => [
            'DDoS protection included at the network level',
            'ISO 27001 certified German data centres owned by the company',
            'Snapshots on newer plans and paid automatic backups',
            'Private networking available between instances in the same region',
            'Operating system patching and hardening are entirely your responsibility',
        ],
        'pricing_notes' => [
            'A one-off setup fee applies to many plans — factor it into the first month.',
            'Prices are among the lowest per gigabyte of RAM anywhere.',
            'Backups and some storage upgrades are paid add-ons.',
            'Billing is monthly with no long contract, but no money-back guarantee.',
        ],
        'migration' => 'Self-service only. Custom ISO and rescue system support make moving an existing image in straightforward for a competent administrator, but there is no migration assistance.',
        'not_for' => [
            'Latency-sensitive or CPU-bound production workloads on the shared-core tier',
            'Anyone needing fast provisioning or live chat support',
            'Managed hosting buyers — everything here is self-administered',
            'Workloads that need a rich managed service catalogue',
        ],
        'verdict' => 'Unbeatable for cheap bulk compute and storage: development environments, self-hosted applications, media servers and backup targets. Pay for the VDS dedicated-core tier if the workload is production, specify NVMe if disk speed matters, and do not expect cloud-grade provisioning or support.',
    ],

    'godaddy' => [
        'overview' => 'GoDaddy is the largest domain registrar on earth, with more than eighty million domains under management and over twenty million customers, and hosting is one of many products it sells around that core. Founded in 1997 and publicly traded since 2015, it is the company most people encounter first when buying a domain, and its hosting business is built on converting that traffic.

The hosting itself has improved considerably from its low reputation a decade ago. Shared plans run cPanel on reasonable hardware, the managed WordPress product includes automatic core updates, daily backups, staging on higher tiers and a genuinely useful one-click migration tool, and the network is fast in North America and Europe. GoDaddy also owns Media Temple, Sucuri and a large portfolio of small business tools.

The persistent criticisms are commercial rather than technical: an aggressive upsell flow at checkout, add-ons for things competitors include, renewal pricing well above the introductory rate, and support that varies widely. Buy deliberately, uncheck the extras, and it is a perfectly serviceable host.',
        'company' => [
            'Ownership'     => 'Publicly traded, NYSE: GDDY',
            'Headquarters'  => 'Tempe, Arizona, United States',
            'Founded'       => '1997 by Bob Parsons',
            'Scale'         => '84 million+ domains under management, 20 million+ customers',
            'Sister brands' => 'Media Temple, Sucuri, Poynt, Dan.com',
        ],
        'timeline' => [
            ['year' => 1997, 'event' => 'Founded by Bob Parsons as Jomax Technologies, later renamed GoDaddy.'],
            ['year' => 2005, 'event' => 'Becomes the world\'s largest ICANN-accredited registrar.'],
            ['year' => 2013, 'event' => 'Acquires Media Temple, adding a premium hosting brand.'],
            ['year' => 2015, 'event' => 'Goes public on the New York Stock Exchange.'],
            ['year' => 2017, 'event' => 'Acquires Sucuri, a leading website security and WAF company.'],
        ],
        'hosting_types' => [
            ['name' => 'Shared hosting',     'from' => '$5.99/mo',  'note' => 'Economy through Maximum, cPanel based with free domain.'],
            ['name' => 'Managed WordPress',  'from' => '$6.99/mo',  'note' => 'Automatic updates, daily backups and staging on higher tiers.'],
            ['name' => 'VPS hosting',        'from' => '$9.99/mo',  'note' => 'Self-managed or fully managed KVM with root access.'],
            ['name' => 'Dedicated servers',  'from' => '$129.99/mo','note' => 'Bare metal with managed options and DDoS protection.'],
            ['name' => 'Website builder',    'from' => '$9.99/mo',  'note' => 'Websites + Marketing, an all-in-one hosted builder.'],
        ],
        'specs' => [
            'Control panel'  => 'cPanel on shared, custom dashboard on managed WordPress',
            'Web server'     => 'Apache and NGINX depending on product',
            'Storage'        => 'SSD across current plans',
            'PHP versions'   => 'PHP 7.x and 8.x, selectable',
            'Backups'        => 'Daily backups on managed WordPress; paid add-on on shared',
            'Staging'        => 'Available on higher managed WordPress tiers',
            'SSH access'     => 'Yes, on higher shared tiers and VPS',
            'CDN'            => 'Included on managed WordPress plans',
            'Security'       => 'Sucuri-powered options available as paid add-ons',
            'Support'        => '24/7 phone and chat in many languages',
            'Uptime SLA'     => '99.9% with credit policy',
        ],
        'performance' => 'Competent. GoDaddy runs a large global network with data centres in North America, Europe and Asia, and the managed WordPress product with its bundled CDN performs respectably, typically in the 300 to 600 millisecond band for cached pages. It is not a performance leader and the shared tiers are resource-limited, but the days of GoDaddy being slow by reputation alone are over.',
        'security' => [
            'Free SSL included on managed WordPress and higher shared tiers',
            'Sucuri web application firewall and malware removal available as add-ons',
            'Daily backups with one-click restore on managed WordPress',
            'Two-factor authentication and domain transfer locking',
            'DDoS protection at the network edge',
        ],
        'pricing_notes' => [
            'Introductory pricing renews substantially higher — often two to three times.',
            'SSL, backups and privacy are add-ons on the cheapest tiers.',
            'Checkout preselects extras; review the cart line by line before paying.',
            'A 30-day money-back guarantee applies to annual plans, 48 hours on monthly.',
        ],
        'migration' => 'The managed WordPress product includes a one-click migration tool that works well for standard sites. Other migrations are self-service or handled through a paid professional service.',
        'not_for' => [
            'Buyers who find upsell-heavy checkouts unacceptable',
            'Developers wanting Git workflows and modern deployment tooling',
            'Anyone optimising strictly for price or performance per dollar',
            'Sites that need included security rather than Sucuri as an add-on',
        ],
        'verdict' => 'Fine if you are already there for domains and want everything in one account, with the managed WordPress tier the part worth buying. Uncheck the add-ons at checkout, budget for renewal, and recognise you are paying for convenience and brand rather than value.',
    ],

    'mochahost' => [
        'overview' => 'MochaHost is a California company founded in 2001 whose defining feature is the longest money-back guarantee in the industry: 180 days, six months, on shared hosting. It pairs that with a lifetime price-lock promise and a lifetime free SSL, and the combination makes it one of the lowest-risk hosts to try even though the brand is far less known than its competitors.

The plans themselves are aggressively specified: unlimited domains, unlimited bandwidth, unlimited email, a free domain for life on annual plans, free website transfer and a bundled builder. MochaHost also supports both Linux and Windows hosting with ASP.NET, which is unusual at this price and makes it a rare budget option for Microsoft-stack sites.

The reservations are the usual ones for a smaller host. Performance is average, the control panel and marketing site feel dated, support is competent but not fast, and "unlimited" is bounded by resource policies that the higher tiers relax. The guarantee, though, means you can find out for yourself with almost no risk.',
        'company' => [
            'Ownership'    => 'Privately held, independent',
            'Headquarters' => 'San Jose, California, United States',
            'Founded'      => '2001',
            'Scale'        => 'Serving customers across North America, Europe and Asia',
            'Notable'      => '180-day money-back guarantee, the longest in the sector',
        ],
        'timeline' => [
            ['year' => 2001, 'event' => 'Founded in California offering Linux and Windows shared hosting.'],
            ['year' => 2009, 'event' => 'Introduces the 180-day money-back guarantee.'],
            ['year' => 2014, 'event' => 'Adds a lifetime price-lock promise on renewals.'],
            ['year' => 2018, 'event' => 'Expands data centre coverage into Europe and Asia.'],
            ['year' => 2022, 'event' => 'Refreshes plans with SSD storage and free lifetime SSL.'],
        ],
        'hosting_types' => [
            ['name' => 'Shared hosting',    'from' => '$2.49/mo',  'note' => 'Soho, Business and Mocha tiers, Linux or Windows.'],
            ['name' => 'WordPress hosting', 'from' => '$2.49/mo',  'note' => 'WordPress preinstalled with automatic updates.'],
            ['name' => 'Cloud VPS',         'from' => '$8.99/mo',  'note' => 'Managed or self-managed instances with root access.'],
            ['name' => 'Dedicated servers', 'from' => '$59.95/mo', 'note' => 'Bare metal with Linux or Windows Server options.'],
            ['name' => 'Reseller hosting',  'from' => '$21.95/mo', 'note' => 'White-label reseller accounts with billing tools.'],
        ],
        'specs' => [
            'Control panel'  => 'cPanel on Linux, Plesk on Windows',
            'Platforms'      => 'Linux and Windows with ASP.NET, a rare combination at this price',
            'Storage'        => 'SSD across current plans',
            'Bandwidth'      => 'Unlimited under fair-use policy',
            'Backups'        => 'Included on higher tiers, paid on entry plans',
            'SSL'            => 'Free lifetime SSL on all plans',
            'Domain'         => 'Free domain for life on annual plans',
            'Free migration' => 'Free website transfer included',
            'Price lock'     => 'Lifetime price-lock on renewals',
            'Support'        => '24/7 chat and ticket support',
            'Uptime SLA'     => '99.9% with credits',
        ],
        'performance' => 'Average and consistent. Data centres in the United States, Europe and Asia give reasonable global coverage for a host this size, and SSD storage keeps things acceptable, but there is no LiteSpeed, no NVMe across the board and no advanced caching layer. Expect a competent small-site experience rather than a fast one.',
        'security' => [
            'Free lifetime SSL on every domain with automatic renewal',
            'Server-level firewall and malware scanning',
            'Backups included from the mid tier upward',
            'DDoS mitigation at the network edge',
            'Two-factor authentication on the client portal',
        ],
        'pricing_notes' => [
            'The lifetime price-lock means no renewal increase, unusual and valuable.',
            'The 180-day money-back guarantee removes essentially all purchase risk.',
            'Annual and longer terms include a free domain for the life of the account.',
            'Unlimited resources are bounded by fair-use limits that rise with the tier.',
        ],
        'migration' => 'Free website transfer is included with a new account and handled by support. cPanel-to-cPanel is routine; Windows and ASP.NET migrations are also supported, which few competitors offer.',
        'not_for' => [
            'Performance-sensitive or high-traffic sites',
            'Buyers who want a modern dashboard and polished experience',
            'Developers wanting staging, Git and modern workflow tooling',
            'Anyone needing fast, deeply technical support escalation',
        ],
        'verdict' => 'A genuinely low-risk budget host thanks to the 180-day guarantee and lifetime price lock, and one of the few cheap options that properly supports Windows and ASP.NET. Average performance, but you get six months to decide whether that matters for your site.',
    ],

    'bigrock' => [
        'overview' => 'BigRock is an Indian hosting and domain brand launched in 2010 by Directi and now part of the Newfold Digital group. It was built specifically for the Indian market — rupee pricing, local payment methods including UPI and net banking, Hindi-language support, and a data centre presence that keeps latency low for Indian visitors — and it became one of the most recognised hosting brands in the country on that basis.

The product range covers shared Linux and Windows hosting, managed WordPress, VPS, dedicated servers, reseller accounts and a large domain registration business, all through cPanel or Plesk. Pricing is very low, the feature set is adequate, and the onboarding is straightforward for someone building a first site.

As with its Newfold siblings, the pattern is low introductory pricing with a steep renewal, add-ons at checkout, and support that is available around the clock but not deeply technical. For an Indian small business site or a first blog, it is a reasonable, locally-adapted choice. For anything demanding, look further.',
        'company' => [
            'Ownership'     => 'Newfold Digital, originally launched by Directi',
            'Headquarters'  => 'Mumbai, India',
            'Founded'       => '2010',
            'Scale'         => 'Hundreds of thousands of Indian domains and websites',
            'Sister brands' => 'ResellerClub, Bluehost India, Newfold Digital group brands',
        ],
        'timeline' => [
            ['year' => 2010, 'event' => 'Launched by Directi as an India-focused hosting and domain brand.'],
            ['year' => 2014, 'event' => 'Directi web presence business sold to Endurance International Group.'],
            ['year' => 2018, 'event' => 'Adds local Indian data centre capacity to reduce latency.'],
            ['year' => 2021, 'event' => 'Becomes part of Newfold Digital following the Endurance buyout.'],
            ['year' => 2023, 'event' => 'Refreshes plans with SSD storage and updated PHP support.'],
        ],
        'hosting_types' => [
            ['name' => 'Shared hosting',    'from' => '$1.49/mo',  'note' => 'Linux and Windows plans with cPanel or Plesk.'],
            ['name' => 'WordPress hosting', 'from' => '$2.49/mo',  'note' => 'Preinstalled WordPress with automatic updates.'],
            ['name' => 'VPS hosting',       'from' => '$9.99/mo',  'note' => 'KVM instances with root access and cPanel option.'],
            ['name' => 'Dedicated servers', 'from' => '$89/mo',    'note' => 'Bare metal with managed support options.'],
            ['name' => 'Reseller hosting',  'from' => '$8.99/mo',  'note' => 'WHM-based reseller with white-label branding.'],
        ],
        'specs' => [
            'Control panel'  => 'cPanel on Linux, Plesk on Windows',
            'Platforms'      => 'Linux and Windows with ASP.NET support',
            'Storage'        => 'SSD across current plans',
            'Local payments' => 'UPI, net banking, Indian cards and rupee billing',
            'PHP versions'   => 'PHP 7.x and 8.x',
            'Backups'        => 'Weekly courtesy backups, paid daily options',
            'Free migration' => 'Free transfer assistance on request',
            'Email'          => 'Mailboxes included with most plans',
            'Support'        => '24/7 chat, phone and tickets with Hindi language support',
            'Uptime SLA'     => '99.9% target',
        ],
        'performance' => 'Good for Indian visitors thanks to local data centre capacity, ordinary elsewhere. The stack is conventional Apache with cPanel and SSD storage, so expect mid-table numbers. For a site whose audience is in India, the local origin matters more than the stack, and BigRock is competitive there.',
        'security' => [
            'Free SSL on most current plans',
            'Server-level firewall and malware scanning',
            'SiteLock and CodeGuard offered as paid add-ons',
            'DDoS mitigation at the network level',
            'Two-factor authentication on the account panel',
        ],
        'pricing_notes' => [
            'Rupee pricing with local payment methods, a real convenience in India.',
            'Introductory rates renew two to three times higher.',
            'Backups and security tools are add-ons rather than included.',
            'A 30-day money-back guarantee applies to hosting.',
        ],
        'migration' => 'Free transfer assistance is available on request through support. cPanel-to-cPanel moves are routine; there is no scheduled white-glove cutover service.',
        'not_for' => [
            'Audiences outside India, who would be better served locally',
            'Performance-critical or high-traffic projects',
            'Developers wanting staging, Git and modern tooling',
            'Buyers who dislike renewal increases and checkout add-ons',
        ],
        'verdict' => 'A sensible first host for an Indian small business or blogger: local pricing, local payments, local latency and around-the-clock support in familiar languages. Treat the introductory rate as a first-year offer and move up-market if the site grows.',
    ],

    'zoho' => [
        'overview' => 'Zoho is best known as a business software company — CRM, mail, office suite, accounting, projects, and around fifty other applications used by over a hundred million people — and its hosting products exist to serve that ecosystem rather than to compete with general web hosts. Zoho Sites is a hosted website builder, Zoho Mail is one of the most widely used business email platforms outside Google and Microsoft, and Zoho Catalyst is a serverless application platform for developers building on the Zoho stack.

The company is unusual in the software industry: privately held, profitable, based in Chennai with a deliberate policy of building offices in rural India, and vocally opposed to venture capital and the growth-at-all-costs model. It runs its own data centres and is one of the few software companies that does not monetise customer data.

If you are looking for a place to put a WordPress site, Zoho is the wrong answer. If you are already running your business on Zoho One and want the website, email, forms and CRM in one place with one bill and one login, it is a coherent and inexpensive choice.',
        'company' => [
            'Ownership'    => 'Privately held, bootstrapped, no outside investment',
            'Headquarters' => 'Chennai, India, with United States operations in Austin, Texas',
            'Founded'      => '1996 as AdventNet',
            'Scale'        => '100 million+ users across 55+ business applications',
            'Notable'      => 'Runs its own data centres and refuses advertising-based monetisation',
        ],
        'timeline' => [
            ['year' => 1996, 'event' => 'Founded as AdventNet, a network management software company.'],
            ['year' => 2005, 'event' => 'Launches Zoho CRM and the Zoho office suite.'],
            ['year' => 2009, 'event' => 'Renames the company Zoho Corporation.'],
            ['year' => 2017, 'event' => 'Launches Zoho One, bundling the whole application suite.'],
            ['year' => 2019, 'event' => 'Introduces Catalyst, a serverless platform for developers.'],
        ],
        'hosting_types' => [
            ['name' => 'Zoho Sites',      'from' => '$4/mo',   'note' => 'Hosted website builder with templates, forms and CRM integration.'],
            ['name' => 'Zoho Mail',       'from' => '$1/user', 'note' => 'Business email hosting with a custom domain, ad-free.'],
            ['name' => 'Zoho Catalyst',   'from' => 'Usage',   'note' => 'Serverless functions, hosting and data store for developers.'],
            ['name' => 'Zoho Commerce',   'from' => '$19/mo',  'note' => 'Hosted online store with payments and inventory built in.'],
        ],
        'specs' => [
            'Model'          => 'Fully hosted SaaS — no server access, no cPanel, no FTP',
            'Custom domains' => 'Supported across Sites, Mail and Commerce',
            'Integrations'   => 'Native connection to Zoho CRM, Campaigns, Forms, Desk and Analytics',
            'Email'          => 'Zoho Mail with IMAP, POP, ActiveSync and a generous free tier',
            'Storage'        => 'Plan-based quotas rather than disk allocations',
            'Developer tools'=> 'Catalyst CLI, serverless functions, NoSQL data store and authentication',
            'Data centres'   => 'Company-owned facilities in the United States, Europe, India, China and Australia',
            'Compliance'     => 'GDPR, SOC 2 Type 2, ISO 27001 and regional data residency',
            'Support'        => 'Email, chat and phone depending on plan tier',
            'Uptime SLA'     => '99.9% on paid business plans',
        ],
        'performance' => 'As a hosted platform, performance is managed entirely by Zoho and is consistently good, with a global data centre footprint and regional data residency options. There is no tuning to do and no way to tune. Zoho Sites will not match a well-configured WordPress install on a fast host for complex pages, but for brochure sites and forms it is fast and entirely maintenance-free.',
        'security' => [
            'No advertising and no data mining — a published, long-standing policy',
            'Company-owned data centres with regional data residency choices',
            'GDPR, SOC 2 Type 2, ISO 27001 and HIPAA-ready configurations',
            'Two-factor authentication and enterprise single sign-on',
            'Encryption at rest and in transit across the suite',
        ],
        'pricing_notes' => [
            'Per-user pricing on Mail, per-site pricing on Sites, usage-based on Catalyst.',
            'Zoho One bundles the entire suite per employee and is far cheaper than buying apps individually.',
            'A free Zoho Mail tier exists for small teams on a custom domain.',
            'Annual billing reduces the monthly rate meaningfully.',
        ],
        'migration' => 'Zoho Mail has well-documented migration tooling for moving mailboxes from Google Workspace, Microsoft 365 and IMAP sources, and the team assists on business plans. There is no migration path for an existing WordPress site because the platform does not host WordPress.',
        'not_for' => [
            'WordPress, Drupal or any self-hosted application',
            'Developers wanting server access, SSH or a database of their own',
            'Anyone who needs a general-purpose web host',
            'Sites requiring deep custom code beyond what Catalyst supports',
        ],
        'verdict' => 'Not a web host in the conventional sense, and excellent at what it actually is. If your business already runs on Zoho, keeping the website, store and email inside the same suite is cheap, integrated and maintenance-free. If you want to host a CMS, look elsewhere.',
    ],

    'crazy-domains' => [
        'overview' => 'Crazy Domains is the retail brand of Dreamscape Networks, an Australian company founded in Perth in 2003 and later listed on the Australian Securities Exchange before being taken private. It is one of the largest registrars in Australia and New Zealand and sells hosting, email, website builders and digital marketing services alongside domains, with local support hours and Australian dollar billing.

Local presence is the whole proposition. Australian businesses buying hosting from a United States provider pay a 150 to 200 millisecond latency penalty on every uncached request, and dealing with support in a compatible time zone matters. Crazy Domains solves both, with data centre capacity in Australia and a Perth-based support operation.

The criticisms are familiar: heavy upselling through the purchase flow, renewal pricing well above the introductory rate, and a feature set that is adequate rather than generous. The hosting is conventional cPanel and Plesk shared hosting with the usual ladder up to VPS and dedicated.',
        'company' => [
            'Ownership'    => 'Dreamscape Networks, privately held after an ASX listing',
            'Headquarters' => 'Perth, Western Australia',
            'Founded'      => '2003',
            'Scale'        => 'One of the largest registrars in Australia and New Zealand',
            'Sister brands'=> 'Dreamscape Networks brands across Asia-Pacific',
        ],
        'timeline' => [
            ['year' => 2003, 'event' => 'Founded in Perth as an Australian domain registrar.'],
            ['year' => 2014, 'event' => 'Expands into hosting, email and digital marketing services.'],
            ['year' => 2016, 'event' => 'Parent company Dreamscape Networks lists on the Australian Securities Exchange.'],
            ['year' => 2020, 'event' => 'Taken private following an acquisition.'],
            ['year' => 2022, 'event' => 'Refreshes hosting plans with SSD storage and updated panels.'],
        ],
        'hosting_types' => [
            ['name' => 'Shared hosting',    'from' => '$2.99/mo',  'note' => 'Starter through Business, cPanel or Plesk, Australian billing.'],
            ['name' => 'WordPress hosting', 'from' => '$4.99/mo',  'note' => 'Managed WordPress with automatic updates and caching.'],
            ['name' => 'VPS hosting',       'from' => '$19.99/mo', 'note' => 'Virtual servers with root access and managed options.'],
            ['name' => 'Dedicated servers', 'from' => '$99/mo',    'note' => 'Bare metal with Australian data centre placement.'],
            ['name' => 'Email hosting',     'from' => '$2.99/mo',  'note' => 'Business email on a custom domain, sold separately.'],
        ],
        'specs' => [
            'Control panel'  => 'cPanel on Linux, Plesk on Windows',
            'Platforms'      => 'Linux and Windows hosting both available',
            'Storage'        => 'SSD across current plans',
            'Local presence' => 'Australian data centre capacity and AUD billing',
            'PHP versions'   => 'PHP 7.x and 8.x',
            'Backups'        => 'Available, included on higher tiers',
            'Free migration' => 'Migration assistance available through support',
            'Domains'        => 'Large .au domain registration business',
            'Support'        => 'Australian business hours plus 24/7 chat',
            'Uptime SLA'     => '99.9% target',
        ],
        'performance' => 'Good for Australian and New Zealand visitors because the origin is local, ordinary by global standards. The stack is conventional shared hosting on SSD without LiteSpeed or advanced caching, so the advantage is geography rather than engineering. For an ANZ audience that advantage is substantial and worth more than a faster stack located overseas.',
        'security' => [
            'Free SSL included on most current plans',
            'Server firewall and malware scanning',
            'Backups included on higher tiers, paid on entry plans',
            'DDoS mitigation at the network level',
            'Two-factor authentication on the customer account',
        ],
        'pricing_notes' => [
            'Prices are quoted in Australian dollars including GST for local buyers.',
            'Introductory pricing renews substantially higher.',
            'The purchase flow presents many optional add-ons — review the cart carefully.',
            'A 30-day money-back guarantee applies to hosting.',
        ],
        'migration' => 'Migration assistance is available through support on request. It is a standard cPanel transfer process rather than a managed engineering service.',
        'not_for' => [
            'Audiences outside Australia and New Zealand',
            'Performance-focused buyers who want LiteSpeed or NVMe',
            'Developers wanting staging, Git and modern deployment tooling',
            'Anyone averse to upsell-heavy checkout flows',
        ],
        'verdict' => 'The convenient local option for an Australian or New Zealand small business that wants domain, hosting, email and support in one place and in one time zone. Buy for the geography, not the technology, and read the cart before paying.',
    ],

    'siteworx-africa' => [
        'overview' => 'Truehost is a Kenyan company founded in 2013 that has become one of the largest hosting providers on the African continent, with operations in Kenya, Nigeria, Uganda, Tanzania, Rwanda, Zambia and beyond. Its significance is structural rather than technical: for most of the internet era, an African business wanting a website bought hosting in Europe or the United States and accepted both the latency and the foreign-currency billing.

Truehost changed that equation with local data centre presence, local currency pricing, local payment rails including M-Pesa and other mobile money systems, and support staff in the same time zone speaking the same languages. It also runs a large local domain registration business covering country-code domains such as .ke, .ng, .co.tz and .ug that international registrars handle poorly or not at all.

The platform itself is conventional cPanel shared hosting with SSD storage, plus VPS and dedicated options and a reseller programme that a large number of small African web agencies build on. It is not a performance leader globally, and it is not competing to be one.',
        'company' => [
            'Ownership'    => 'Privately held, African owned',
            'Headquarters' => 'Nairobi, Kenya',
            'Founded'      => '2013',
            'Scale'        => 'Operations across Kenya, Nigeria, Uganda, Tanzania, Rwanda and Zambia',
            'Notable'      => 'Among the largest indigenous hosting providers in Africa',
        ],
        'timeline' => [
            ['year' => 2013, 'event' => 'Founded in Nairobi to serve the Kenyan web market.'],
            ['year' => 2016, 'event' => 'Becomes an accredited registrar for .ke and other African country-code domains.'],
            ['year' => 2018, 'event' => 'Expands into Nigeria, Uganda and Tanzania.'],
            ['year' => 2020, 'event' => 'Adds mobile money payment rails including M-Pesa across markets.'],
            ['year' => 2022, 'event' => 'Grows the reseller programme used by local web agencies.'],
        ],
        'hosting_types' => [
            ['name' => 'Shared hosting',    'from' => '$1.99/mo',  'note' => 'cPanel plans with local currency billing and mobile money payment.'],
            ['name' => 'WordPress hosting', 'from' => '$2.99/mo',  'note' => 'WordPress preinstalled with automatic updates.'],
            ['name' => 'VPS hosting',       'from' => '$9.99/mo',  'note' => 'Virtual servers with root access and local support.'],
            ['name' => 'Cloud hosting',     'from' => '$5.99/mo',  'note' => 'Resource-isolated cloud plans for growing sites.'],
            ['name' => 'Reseller hosting',  'from' => '$14.99/mo', 'note' => 'White-label WHM accounts used widely by African agencies.'],
        ],
        'specs' => [
            'Control panel'  => 'cPanel and WHM',
            'Storage'        => 'SSD across current plans',
            'Local payments' => 'M-Pesa and regional mobile money, local bank transfer, local cards',
            'Domains'        => 'Accredited for .ke, .ng, .co.tz, .ug and other African ccTLDs',
            'PHP versions'   => 'PHP 7.x and 8.x',
            'Backups'        => 'Regular backups with restore on request',
            'Email'          => 'Mailboxes included with hosting plans',
            'Free migration' => 'Free transfer assistance from other hosts',
            'Support'        => 'Local-language support in African business hours plus tickets',
            'Uptime SLA'     => '99.9% target',
        ],
        'performance' => 'The advantage is proximity. For a Kenyan, Nigerian or Tanzanian audience, a locally-hosted site avoids the several-hundred-millisecond round trip to Europe that a comparable international host imposes, and that difference is far larger than any stack optimisation. Outside Africa, performance is unremarkable and an international host would serve better.',
        'security' => [
            'Free SSL on hosting plans with automatic renewal',
            'Server-level firewall and malware scanning',
            'Regular backups with restore assistance from support',
            'DDoS mitigation at the network level',
            'Local data residency for organisations with in-country requirements',
        ],
        'pricing_notes' => [
            'Pricing is available in local currencies, avoiding foreign exchange fees and card issues.',
            'Mobile money payment removes the credit card barrier that blocks many African buyers.',
            'Introductory and renewal rates are both low by international standards.',
            'Refund terms vary by market — check the local terms page.',
        ],
        'migration' => 'Free transfer assistance from other hosts is offered through support, including moves from international providers. cPanel-to-cPanel transfers are routine.',
        'not_for' => [
            'Audiences outside Africa',
            'High-traffic applications needing advanced caching and scaling',
            'Developers wanting Git-based deploys and staging environments',
            'Buyers expecting the polish of a large international brand',
        ],
        'verdict' => 'The right choice for a business whose customers are in East or West Africa: local latency, local currency, mobile money payments and support that answers during your working day. Those advantages outweigh any stack comparison against an overseas host.',
    ],

    'ucloud' => [
        'overview' => 'This listing covers Alibaba Cloud\'s international business, the arm that sells outside mainland China from regions in Singapore, Hong Kong, Tokyo, Seoul, Sydney, Jakarta, Kuala Lumpur, Mumbai, Frankfurt, London, Dubai, Virginia and Silicon Valley. It is the largest cloud provider in Asia-Pacific by market share and the fourth largest worldwide, and for workloads serving Southeast Asian users it frequently has better regional coverage than AWS or Azure.

The catalogue mirrors the hyperscaler pattern: Elastic Compute Service instances, ApsaraDB managed databases, Object Storage Service, Server Load Balancer, container services, a CDN with a large Asian point-of-presence footprint, and a growing machine learning platform. Pricing is aggressive, particularly on subscription commitments, and the free tier is generous by hyperscaler standards.

The considerations are governance and support. Documentation quality in English is uneven compared with AWS, the console has a learning curve shaped by different design conventions, and some organisations have policy constraints about Chinese-headquartered providers. For an Asia-Pacific audience with no such constraints, the price and regional latency are compelling.',
        'company' => [
            'Ownership'    => 'Alibaba Group, publicly traded',
            'Headquarters' => 'Singapore for international operations, Hangzhou for group',
            'Founded'      => '2009',
            'Scale'        => 'Largest cloud provider in Asia-Pacific, top four globally',
            'Regions'      => '28+ regions and 85+ availability zones worldwide',
        ],
        'timeline' => [
            ['year' => 2009, 'event' => 'Founded as Aliyun to serve Alibaba Group infrastructure needs.'],
            ['year' => 2014, 'event' => 'Opens its first international region in Silicon Valley.'],
            ['year' => 2016, 'event' => 'Expands aggressively across Southeast Asia, Europe and the Middle East.'],
            ['year' => 2021, 'event' => 'Becomes the clear market share leader in Asia-Pacific cloud.'],
            ['year' => 2023, 'event' => 'Moves international headquarters functions to Singapore.'],
        ],
        'hosting_types' => [
            ['name' => 'Elastic Compute Service', 'from' => '$3/mo',  'note' => 'General purpose, compute and memory optimised instances.'],
            ['name' => 'Simple Application Server','from' => '$2.50/mo','note' => 'Preconfigured application stacks, the closest thing to a VPS product.'],
            ['name' => 'ApsaraDB',                'from' => 'Usage',  'note' => 'Managed MySQL, PostgreSQL, Redis and MongoDB.'],
            ['name' => 'Object Storage Service',  'from' => 'Usage',  'note' => 'S3-compatible storage with a large Asian CDN footprint.'],
            ['name' => 'Container Service',       'from' => 'Usage',  'note' => 'Managed Kubernetes and serverless container workloads.'],
        ],
        'specs' => [
            'Control panel'  => 'Alibaba Cloud console, API, CLI and Terraform provider',
            'Virtualisation' => 'Custom hypervisor with dedicated and shared instance families',
            'Storage'        => 'ESSD cloud disks with configurable performance tiers',
            'Regions'        => 'Strongest coverage in Southeast Asia, plus Europe, Middle East and the Americas',
            'CDN'            => 'Global CDN with an unusually dense Asian point-of-presence network',
            'Free tier'      => 'Generous new-account free tier across many services',
            'Compliance'     => 'ISO 27001, SOC, PCI DSS, MTCS and regional certifications',
            'Support'        => 'Free basic support, paid developer, business and enterprise tiers',
            'Uptime SLA'     => '99.95% single instance, 99.995% multi-zone',
        ],
        'performance' => 'Excellent in Asia-Pacific, where the region density and CDN footprint are the best of any provider. Latency to users in Indonesia, Malaysia, Thailand, the Philippines and Vietnam is consistently lower than from AWS or Google Cloud regions serving the same users. Outside Asia the network is competitive but not distinctive, and European and American coverage is thinner than the top three hyperscalers.',
        'security' => [
            'Anti-DDoS Basic included free, with Pro and Premium scrubbing tiers available',
            'Cloud Firewall, WAF and Security Center for threat detection',
            'Identity and access management with fine-grained policies and roles',
            'Encryption at rest and in transit with a managed key service',
            'ISO 27001, SOC 1/2/3, PCI DSS and regional compliance certifications',
            'Organisations with policy restrictions on Chinese-owned providers should check internal rules',
        ],
        'pricing_notes' => [
            'Subscription commitments cut hourly rates substantially — often 40% or more.',
            'Egress bandwidth is billed and can dominate the bill on media-heavy workloads.',
            'A generous free tier covers many services for new accounts.',
            'Pricing is typically lower than AWS for equivalent Asia-Pacific instances.',
        ],
        'migration' => 'Alibaba Cloud provides a Server Migration Center for lifting virtual machines from other clouds and on-premises environments, plus database transmission services for live database moves. Enterprise accounts get architect assistance.',
        'not_for' => [
            'Buyers whose organisation restricts Chinese-headquartered vendors',
            'Teams that need the deepest English-language documentation and community',
            'Simple website hosting — this is infrastructure, not managed hosting',
            'Workloads concentrated in Europe or North America, where rivals have more regions',
        ],
        'verdict' => 'The strongest cloud for a Southeast Asian audience on price and latency together, with a catalogue that covers everything a hyperscaler should. Expect a steeper documentation learning curve than AWS, and check your organisation\'s vendor policy before committing.',
    ],

    'siteground-asia' => [
        'overview' => 'BigScoots is a small Chicago-based host, founded in 2011, that has built a disproportionate reputation among professional bloggers and content publishers on one thing: support that behaves like a retained systems administrator rather than a helpdesk. Its fully managed WordPress plans come with what the company calls truly managed support, meaning the team will debug your plugin conflict, tune your database, fix your caching configuration and optimise your Core Web Vitals, not just confirm the server is up.

Technically the platform is well-built — NVMe storage, LiteSpeed or NGINX depending on the plan, Redis object caching, per-site isolation, free CDN and daily backups — but the architecture is not what customers rave about. They rave about tickets answered in minutes by someone who then actually fixes the problem.

The company stays deliberately small, which is both the product and the limitation. There is no enterprise tier, no global data centre network beyond a handful of United States and European locations, and pricing starts well above shared hosting. For a mid-size content site earning real money from advertising, it is one of the highest-rated hosts anywhere.',
        'company' => [
            'Ownership'    => 'Privately held, independent, deliberately small',
            'Headquarters' => 'Chicago, Illinois, United States',
            'Founded'      => '2011',
            'Scale'        => 'A focused customer base of publishers, bloggers and small businesses',
            'Notable'      => 'Consistently top-rated for support among professional blogging communities',
        ],
        'timeline' => [
            ['year' => 2011, 'event' => 'Founded in Chicago as a boutique managed hosting provider.'],
            ['year' => 2016, 'event' => 'Introduces fully managed WordPress plans with hands-on support.'],
            ['year' => 2019, 'event' => 'Becomes a widely recommended host in professional blogging communities.'],
            ['year' => 2021, 'event' => 'Moves the fleet to NVMe storage with Redis object caching.'],
            ['year' => 2023, 'event' => 'Expands managed plan tiers for high-traffic advertising-funded publishers.'],
        ],
        'hosting_types' => [
            ['name' => 'Fully managed WordPress', 'from' => '$34.95/mo', 'note' => 'The flagship product, with hands-on optimisation support included.'],
            ['name' => 'Managed VPS',             'from' => '$24.95/mo', 'note' => 'Dedicated resources with full management by the BigScoots team.'],
            ['name' => 'Shared hosting',          'from' => '$5.95/mo',  'note' => 'Entry cPanel plans, a secondary part of the business.'],
            ['name' => 'Dedicated servers',       'from' => '$179/mo',   'note' => 'Single-tenant hardware, fully managed.'],
        ],
        'specs' => [
            'Control panel'  => 'Custom managed dashboard, cPanel on shared plans',
            'Web server'     => 'NGINX or LiteSpeed depending on plan, tuned per site',
            'Storage'        => 'NVMe SSD',
            'Caching'        => 'Redis object caching and server-level page caching, configured for you',
            'Backups'        => 'Daily automated backups with retention and free restores',
            'Staging'        => 'Yes, on managed plans',
            'CDN'            => 'Free CDN included on managed plans',
            'Support model'  => 'Truly managed — the team fixes application-level problems, not just server issues',
            'Migration'      => 'Free white-glove migration performed by engineers',
            'Data centres'   => 'United States and Europe',
            'Uptime SLA'     => '99.9% with proactive monitoring',
        ],
        'performance' => 'Fast, and more importantly tuned. Because the team configures caching, object caching and PHP settings for your specific site rather than shipping a generic default, real-world Core Web Vitals on BigScoots plans are often better than on technically similar platforms. NVMe storage and per-site isolation keep things consistent under advertising-driven traffic spikes, which is the workload the company is built around.',
        'security' => [
            'Daily automated backups with free restores performed by support',
            'Per-site isolation preventing cross-account contamination',
            'Server hardening, firewall and malware scanning managed by the team',
            'Free SSL with automatic renewal',
            'Hands-on remediation if a site is compromised, included in the support model',
        ],
        'pricing_notes' => [
            'Managed plans start around $35 a month — well above shared hosting, well below enterprise.',
            'Pricing is transparent with no introductory cliff.',
            'Support labour is included rather than billed, which is the main value.',
            'Month-to-month billing is available without a long contract.',
        ],
        'migration' => 'Free white-glove migrations performed by BigScoots engineers, including scheduling, testing and post-migration optimisation. This is one of the smoothest migration experiences available at any price.',
        'not_for' => [
            'Budget buyers or hobby projects',
            'Sites needing many global origin regions',
            'Enterprise procurement requiring formal SLAs and account management',
            'Non-WordPress applications, which are not the focus',
        ],
        'verdict' => 'The host to buy when you want a systems administrator on retainer for the price of hosting. For a mid-size WordPress publisher, the hands-on support routinely pays for itself in avoided downtime and improved performance. Small, focused and very highly rated by the people who use it.',
    ],

    'raidboxes' => [
        'overview' => 'RAIDBOXES is a German managed WordPress host, founded in Münster in 2015, built specifically for agencies and freelancers working in the German-speaking market. Everything about it is shaped by that: GDPR compliance is the default rather than an add-on, data stays in German and EU data centres, contracts and support are in German, and a data processing agreement is available as standard.

The platform runs each site in an isolated container with NVMe storage, server-level caching, free SSL, daily backups with thirty-day retention, staging with one-click sync, and a well-designed agency dashboard that supports client billing handover, team permissions and white-labelling. There is no cPanel and no email hosting, in line with the modern managed WordPress pattern.

It is more expensive than mass-market hosting and cheaper than Kinsta or WP Engine, and its natural customer is an agency that needs airtight European data protection and a dashboard that makes managing forty client sites practical. For anyone outside Europe, the proposition is much weaker.',
        'company' => [
            'Ownership'    => 'Privately held, German owned',
            'Headquarters' => 'Münster, Germany',
            'Founded'      => '2015',
            'Scale'        => 'Tens of thousands of WordPress sites, agency-focused',
            'Sustainability' => 'Runs on green electricity in German data centres',
        ],
        'timeline' => [
            ['year' => 2015, 'event' => 'Founded in Münster as a managed WordPress host for the German market.'],
            ['year' => 2018, 'event' => 'Builds GDPR compliance tooling and standard data processing agreements into the product.'],
            ['year' => 2020, 'event' => 'Launches agency features including white-labelling and client billing handover.'],
            ['year' => 2022, 'event' => 'Moves the platform to NVMe storage with improved container isolation.'],
            ['year' => 2023, 'event' => 'Expands EU data centre choice and adds performance monitoring tools.'],
        ],
        'hosting_types' => [
            ['name' => 'Managed WordPress', 'from' => '$19/mo',  'note' => 'Per-site plans sized by traffic and resources.'],
            ['name' => 'Agency plans',      'from' => 'Custom',   'note' => 'Multi-site bundles with white-labelling and client billing.'],
            ['name' => 'WooCommerce hosting','from' => '$29/mo', 'note' => 'Store-tuned configuration with higher resource ceilings.'],
        ],
        'specs' => [
            'Control panel'  => 'Custom RAIDBOXES dashboard (no cPanel)',
            'Web server'     => 'NGINX with PHP-FPM in isolated containers',
            'Storage'        => 'NVMe SSD',
            'Data residency' => 'German and EU data centres only, GDPR by design',
            'Backups'        => 'Daily automated with 30-day retention and one-click restore',
            'Staging'        => 'One-click staging with selective sync to live',
            'Caching'        => 'Server-level page caching plus object caching',
            'Agency tools'   => 'White-labelling, team roles, client billing handover',
            'Compliance'     => 'Standard data processing agreement (AVV) provided',
            'Support'        => 'German and English support, weekday-focused',
            'Uptime SLA'     => '99.9%',
        ],
        'performance' => 'Strong within Europe. German and EU data centres with NVMe storage and container isolation give consistently fast responses to European visitors, with cached pages typically in the 150 to 350 millisecond band. There is no global edge network included, so audiences outside Europe will see the distance. The platform is sized per plan, so traffic growth means an upgrade rather than a slowdown.',
        'security' => [
            'GDPR compliance built in, with a standard data processing agreement supplied',
            'Data stored exclusively in German and EU data centres',
            'Daily backups with 30-day retention and self-service restore',
            'Free Let\'s Encrypt SSL with automatic renewal and HTTPS enforcement',
            'Container isolation per site and managed platform patching',
            'Malware scanning with support-assisted remediation',
        ],
        'pricing_notes' => [
            'Priced per site, so an agency with many small sites should compare bundle plans.',
            'Prices are quoted in euros with German VAT handling.',
            'No introductory discount cliff — the rate you see is the rate you pay.',
            'A free trial period is offered rather than a money-back guarantee.',
        ],
        'migration' => 'Free migration service performed by the RAIDBOXES team, with staging available to validate before the DNS cutover. Agency plans include bulk migration assistance for moving a portfolio of client sites.',
        'not_for' => [
            'Audiences outside Europe, given no global edge network',
            'Anyone needing email hosting or cPanel',
            'Non-WordPress applications',
            'Buyers looking for the cheapest possible managed WordPress',
        ],
        'verdict' => 'The clear choice for a German or EU agency that needs GDPR compliance as a default and a dashboard built for managing client sites. Outside Europe the case is much weaker, but inside it this is a well-engineered, well-supported platform at a fair price.',
    ],

    'siteground-uk' => [
        'overview' => '20i is a British host founded in 2011 by the team behind Stack Group, which also runs the long-established reseller platform Heart Internet and the wholesale brand TSOHost. It operates its own cloud infrastructure from United Kingdom data centres, and its distinguishing feature is that almost every plan is effectively unlimited: unlimited websites, unlimited bandwidth, unlimited email, unlimited free SSL, and no fixed disk quota on many tiers.

The second distinguishing feature is the reseller platform. 20i is one of the most capable white-label hosting platforms in Europe, with a well-built control panel, automated billing integration, per-client resource management, free migrations of entire portfolios and a genuinely good API. A large number of United Kingdom web agencies run their client hosting on it.

The platform includes a proprietary caching layer, StackCache, a free global CDN, malware scanning and a one-click WordPress toolkit. Support is United Kingdom based and available around the clock. The limitations are geographic: the infrastructure is British, so audiences elsewhere depend on the CDN.',
        'company' => [
            'Ownership'     => 'Stack Group, privately held, British owned',
            'Headquarters'  => 'Nottingham, United Kingdom',
            'Founded'       => '2011',
            'Scale'         => 'Hundreds of thousands of websites, large reseller base',
            'Sister brands' => 'Heart Internet, TSOHost, Stack Group',
        ],
        'timeline' => [
            ['year' => 2011, 'event' => 'Founded as part of Stack Group in Nottingham.'],
            ['year' => 2016, 'event' => 'Launches its own cloud platform with StackCache caching.'],
            ['year' => 2019, 'event' => 'Becomes a leading white-label reseller platform for UK agencies.'],
            ['year' => 2021, 'event' => 'Adds a free global CDN and expanded WordPress tooling to all plans.'],
            ['year' => 2023, 'event' => 'Consolidates Heart Internet and TSOHost customers onto the 20i platform.'],
        ],
        'hosting_types' => [
            ['name' => 'Shared hosting',    'from' => '$2.49/mo',  'note' => 'Unlimited websites, bandwidth, email and SSL on one plan.'],
            ['name' => 'WordPress hosting', 'from' => '$2.49/mo',  'note' => 'Managed WordPress tooling with staging and one-click cloning.'],
            ['name' => 'Reseller hosting',  'from' => '$14.99/mo', 'note' => 'Full white-label platform with billing integration and API.'],
            ['name' => 'Managed cloud VPS', 'from' => '$29.99/mo', 'note' => 'Dedicated cloud resources with managed support.'],
            ['name' => 'Email hosting',     'from' => '$1/mo',     'note' => 'Standalone business email with a custom domain.'],
        ],
        'specs' => [
            'Control panel'  => 'My20i (custom platform, no cPanel)',
            'Web server'     => 'NGINX with StackCache proprietary caching',
            'Storage'        => 'SSD with no fixed quota on many plans',
            'Bandwidth'      => 'Unlimited on all hosting plans',
            'SSL'            => 'Unlimited free SSL certificates, automatically issued',
            'CDN'            => 'Free global CDN included on every plan',
            'Backups'        => 'Automatic backups with self-service restore',
            'Staging'        => 'One-click staging and site cloning',
            'Reseller tools' => 'White-label panel, automated billing integration, full REST API',
            'Free migration' => 'Free migrations including bulk portfolio transfers',
            'Support'        => 'UK-based 24/7 support',
            'Uptime SLA'     => '99.9% with credits',
        ],
        'performance' => 'Good for a United Kingdom and European audience. StackCache plus the free global CDN produces fast cached responses, and the platform runs on modern hardware in British data centres rather than resold capacity. Because plans have no hard disk quota and unlimited bandwidth, there is no artificial ceiling on a growing site — the limits are CPU and memory, applied per account.',
        'security' => [
            'Unlimited free SSL certificates issued and renewed automatically',
            'Malware scanning with automatic quarantine',
            'Web application firewall and DDoS protection at the edge',
            'Automatic backups with self-service restore',
            'Two-factor authentication and granular reseller sub-account permissions',
            'UK data residency for organisations with local requirements',
        ],
        'pricing_notes' => [
            'Pricing is flat and transparent with no aggressive renewal cliff.',
            'Unlimited sites on a single plan makes it unusually cheap for anyone running many small sites.',
            'Reseller pricing is per-package and scales predictably.',
            'A 30-day money-back guarantee applies.',
        ],
        'migration' => 'Free migrations including bulk transfers of entire reseller portfolios, handled by the 20i team. This is a genuine strength — moving a hundred client sites is a supported, routine operation rather than a project.',
        'not_for' => [
            'Audiences far outside Europe wanting a local origin',
            'Buyers who require cPanel specifically',
            'Enterprise workloads needing formal account management',
            'Anyone wanting email and hosting bundled with a large brand name',
        ],
        'verdict' => 'The best reseller and multi-site platform in the United Kingdom, and a very good value for anyone hosting more than a couple of sites. Unlimited everything, free CDN, free SSL, free bulk migrations and honest pricing. Look elsewhere only if you need cPanel or a non-European origin.',
    ],

    'nexcess' => [
        'overview' => 'Nexcess is the managed application hosting arm of Liquid Web, and it specialises in the thing most managed WordPress hosts handle badly: online stores. WooCommerce and Magento are uncachable in large parts — carts, checkouts, account pages and product filters all bypass a page cache — so store performance depends on the origin being genuinely fast, and on the platform understanding commerce-specific behaviour.

Nexcess builds for that. Plans include auto-scaling that adds resources during traffic spikes rather than throttling, built-in image compression, a plugin performance monitor that tells you which plugin is slowing checkout, sales performance monitoring, and a store-specific caching configuration that knows what not to cache. It also hosts Magento, Drupal, Craft, ExpressionEngine and Sylius alongside WordPress, which is a broader application range than its competitors.

Because it sits inside Liquid Web, support is the same well-regarded 24/7 team, and the infrastructure is the same owned data centre footprint. Prices start around nineteen dollars and scale up through serious store-grade plans.',
        'company' => [
            'Ownership'     => 'Liquid Web family, backed by Madison Dearborn Partners',
            'Headquarters'  => 'Southfield, Michigan, United States',
            'Founded'       => '2000',
            'Scale'         => 'Part of a group hosting 500,000+ sites for 45,000+ customers',
            'Sister brands' => 'Liquid Web, StellarWP, iThemes',
        ],
        'timeline' => [
            ['year' => 2000, 'event' => 'Founded in Michigan as a managed hosting provider.'],
            ['year' => 2012, 'event' => 'Specialises in managed Magento and WordPress application hosting.'],
            ['year' => 2019, 'event' => 'Acquired by Liquid Web.'],
            ['year' => 2020, 'event' => 'Launches auto-scaling and store-specific performance tooling for WooCommerce.'],
            ['year' => 2022, 'event' => 'Adds a plugin performance monitor and sales performance monitoring.'],
        ],
        'hosting_types' => [
            ['name' => 'Managed WordPress',   'from' => '$19/mo',  'note' => 'Plans sized by sites, storage and bandwidth with auto-scaling.'],
            ['name' => 'Managed WooCommerce', 'from' => '$26/mo',  'note' => 'Store-tuned stack with commerce-aware caching and analytics.'],
            ['name' => 'Managed Magento',     'from' => '$79/mo',  'note' => 'Magento 2 optimised hosting with dedicated resources.'],
            ['name' => 'Managed Drupal',      'from' => '$79/mo',  'note' => 'Drupal-specific stack with staging and deployment tooling.'],
            ['name' => 'Cloud auto-scaling',  'from' => 'Included','note' => 'Automatic temporary resource increases during traffic spikes.'],
        ],
        'specs' => [
            'Control panel'  => 'Nexcess Client Portal (custom)',
            'Web server'     => 'NGINX with PHP-FPM, tuned per application',
            'Storage'        => 'SSD and NVMe depending on plan',
            'Caching'        => 'Commerce-aware page caching, Redis or Memcached object caching, Varnish',
            'Auto-scaling'   => 'Automatic resource scaling during spikes, included on all plans',
            'Backups'        => 'Daily automated backups with 30-day retention',
            'Staging'        => 'One-click staging and development sites',
            'Developer tools'=> 'SSH, WP-CLI, Git, PHP version switching',
            'Monitoring'     => 'Plugin performance monitor and sales performance monitoring',
            'Support'        => '24/7 support from the Liquid Web team',
            'Uptime SLA'     => '100% network and power uptime with credits',
        ],
        'performance' => 'The differentiator is uncached performance. A WooCommerce checkout cannot be served from a page cache, so what matters is how quickly the origin executes PHP and queries the database, and Nexcess tunes for exactly that with Redis object caching, PHP-FPM tuning and dedicated resources. Auto-scaling means a Black Friday spike adds capacity instead of queueing requests. For catalogue browsing and static content, the built-in CDN and page cache handle the rest.',
        'security' => [
            'Daily automated backups with 30-day retention and one-click restore',
            'PCI DSS compliant hosting configurations for stores taking card payments',
            'Free SSL with automatic provisioning and renewal',
            'Managed platform patching, firewall and intrusion detection',
            'Malware scanning with support-assisted remediation',
            'Two-factor authentication and role-based portal access',
        ],
        'pricing_notes' => [
            'Plans are sized by sites, storage and bandwidth with overage billed on excess.',
            'Auto-scaling is included rather than an extra charge, unusual in the category.',
            'Annual billing carries a meaningful discount.',
            'A 30-day money-back guarantee applies.',
        ],
        'migration' => 'Free migrations included on all plans, performed by the team, including complex Magento and WooCommerce stores with live databases. Staging environments let you validate the store before switching DNS, and the team will schedule the cutover outside trading hours.',
        'not_for' => [
            'Simple brochure sites, where the commerce tooling is wasted',
            'Budget buyers — entry pricing is well above shared hosting',
            'Anyone needing email hosting, which is not included',
            'Non-supported applications outside the managed platform list',
        ],
        'verdict' => 'The best mainstream choice for a WooCommerce or Magento store that has outgrown shared hosting. Commerce-aware caching, included auto-scaling and Liquid Web support are exactly what a store needs and exactly what generic managed WordPress hosting lacks.',
    ],

    'pressable' => [
        'overview' => 'Pressable is a managed WordPress host owned by Automattic, the company behind WordPress.com, WooCommerce, Jetpack and a large share of the WordPress ecosystem itself. That ownership is the product: Pressable runs on Automattic\'s own infrastructure, the same platform that serves WordPress.com, and it comes with Jetpack Security bundled at no extra cost.

The plans are notable for allowing multiple sites on every tier rather than charging per site, which makes Pressable unusually economical for agencies and freelancers managing a portfolio. Every plan includes staging, automatic daily backups with thirty-day retention, a global CDN, free SSL, automatic core updates, and malware scanning through Jetpack.

The limitations follow from the specialisation. Only WordPress is hosted, there is no email service, no cPanel, and a small list of disallowed plugins for security and performance reasons. Traffic is metered by monthly visits, with overage charges. For an agency deeply invested in the Automattic ecosystem, it is a natural and well-priced home.',
        'company' => [
            'Ownership'     => 'Automattic, the company behind WordPress.com and WooCommerce',
            'Headquarters'  => 'Distributed, with Automattic headquartered in San Francisco',
            'Founded'       => '2010, acquired by Automattic in 2016',
            'Scale'         => 'Runs on the same infrastructure that serves WordPress.com',
            'Sister brands' => 'WordPress.com, WooCommerce, Jetpack, WPVIP, Tumblr',
        ],
        'timeline' => [
            ['year' => 2010, 'event' => 'Founded as a managed WordPress host.'],
            ['year' => 2016, 'event' => 'Acquired by Automattic.'],
            ['year' => 2019, 'event' => 'Migrates onto Automattic\'s own global infrastructure.'],
            ['year' => 2021, 'event' => 'Bundles Jetpack Security into every plan at no extra cost.'],
            ['year' => 2023, 'event' => 'Expands agency programme with multi-site plans and partner tooling.'],
        ],
        'hosting_types' => [
            ['name' => 'Managed WordPress', 'from' => '$25/mo',  'note' => 'Plans include multiple sites, priced by visits and storage.'],
            ['name' => 'Agency plans',      'from' => 'Custom',   'note' => 'Higher site counts with partner pricing and account support.'],
            ['name' => 'Enterprise',        'from' => 'Custom',   'note' => 'High-traffic configurations with dedicated resources.'],
        ],
        'specs' => [
            'Control panel'  => 'Pressable custom dashboard (no cPanel)',
            'Platform'       => 'Automattic infrastructure, the same platform behind WordPress.com',
            'Included'       => 'Jetpack Security bundled free on every plan',
            'Backups'        => 'Automatic daily backups with 30-day retention and one-click restore',
            'Staging'        => 'One-click staging on every plan',
            'CDN'            => 'Global CDN included',
            'Multiple sites' => 'Every plan includes more than one site, unusual in the category',
            'Developer tools'=> 'SFTP, SSH, WP-CLI, Git, phpMyAdmin access',
            'Collaboration'  => 'Team collaborator accounts with scoped permissions',
            'Support'        => '24/7 WordPress-specialist support',
            'Uptime SLA'     => '100% uptime guarantee with credits',
        ],
        'performance' => 'Built on infrastructure proven at WordPress.com scale, with a global CDN and server-level caching. Cached responses are consistently fast worldwide, and the platform handles traffic spikes gracefully because it is architected for a network serving enormous volumes of WordPress traffic. Uncached performance is good rather than class-leading, and very heavy WooCommerce stores are better served by a commerce specialist.',
        'security' => [
            'Jetpack Security included free: malware scanning, brute-force protection and downtime monitoring',
            'Automatic daily backups with 30-day retention through Jetpack VaultPress',
            'Automatic WordPress core updates with compatibility handling',
            'Free SSL on all domains with automatic renewal',
            'Web application firewall and DDoS mitigation at the platform edge',
            'A disallowed-plugin list blocking known-insecure and performance-damaging plugins',
        ],
        'pricing_notes' => [
            'Plans meter monthly visits, with overage billed if you exceed the allowance.',
            'Multiple sites are included on every tier, so per-site cost falls quickly.',
            'Jetpack Security included free is worth a meaningful amount on its own.',
            'A 30-day money-back guarantee applies.',
        ],
        'migration' => 'Free migrations are included, with a plugin-based automated path and team assistance for complex sites. Staging environments allow validation before the DNS switch.',
        'not_for' => [
            'Anything other than WordPress',
            'Sites depending on a plugin from the disallowed list',
            'Buyers needing email hosting in the same account',
            'Very large WooCommerce stores needing commerce-specific tuning',
        ],
        'verdict' => 'A strong, well-priced managed WordPress host with the unusual benefit of multiple sites per plan and Jetpack Security included. The Automattic ownership means the platform tracks WordPress itself closely. Best suited to agencies and freelancers with a portfolio of sites rather than one large store.',
    ],

    'wpx-hosting' => [
        'overview' => 'WPX is a Bulgarian-founded managed WordPress host, launched in 2013 by Terry Kyle, that competes on two specific and measurable claims. The first is support response time: it targets under thirty seconds on live chat, staffed by WordPress specialists rather than tier-one script readers. The second is its own content delivery network, WPX Cloud, with points of presence worldwide, included free rather than resold from Cloudflare.

The plans are simple. Three tiers, each allowing a set number of sites with generous storage and bandwidth, all including free unlimited site migrations performed by the team, free SSL, daily backups with twenty-eight day retention, staging, and free malware removal if a site is compromised. There is no confusing per-visit metering.

The trade-offs are that pricing starts around twenty-five dollars a month with no cheap entry point, the dashboard is functional rather than beautiful, and the feature set is narrower than Kinsta or WP Engine on developer tooling — Git-based deployment in particular is limited.',
        'company' => [
            'Ownership'    => 'Privately held, independent',
            'Headquarters' => 'Sofia, Bulgaria, with a United Kingdom registered entity',
            'Founded'      => '2013 by Terry Kyle',
            'Scale'        => 'Tens of thousands of WordPress sites',
            'Notable'      => 'Operates its own CDN, WPX Cloud, rather than reselling one',
        ],
        'timeline' => [
            ['year' => 2013, 'event' => 'Founded as Traffic Planet Hosting, later renamed WPX.'],
            ['year' => 2017, 'event' => 'Rebrands to WPX Hosting with a managed WordPress focus.'],
            ['year' => 2019, 'event' => 'Launches WPX Cloud, its own global CDN, included free with all plans.'],
            ['year' => 2021, 'event' => 'Expands data centre presence across the United States, Europe and Australia.'],
            ['year' => 2023, 'event' => 'Adds more CDN points of presence and improved staging tooling.'],
        ],
        'hosting_types' => [
            ['name' => 'Business plan',    'from' => '$24.99/mo', 'note' => 'Five sites, 10GB storage, unmetered bandwidth.'],
            ['name' => 'Professional plan','from' => '$49.99/mo', 'note' => 'Fifteen sites, 20GB storage, higher resource ceilings.'],
            ['name' => 'Elite plan',       'from' => '$99/mo',    'note' => 'Thirty-five sites, 40GB storage, priority support.'],
        ],
        'specs' => [
            'Control panel'  => 'Custom WPX dashboard (no cPanel)',
            'CDN'            => 'WPX Cloud, its own global CDN, included free',
            'Storage'        => 'SSD with per-plan allocations',
            'Bandwidth'      => 'Unmetered on all plans',
            'Backups'        => 'Daily automated backups with 28-day retention',
            'Staging'        => 'One-click staging on all plans',
            'Support SLA'    => 'Under 30-second target response on live chat',
            'Migrations'     => 'Free unlimited site migrations performed by the team',
            'Malware removal'=> 'Free malware removal if a site is compromised',
            'Data centres'   => 'United States, United Kingdom and Australia',
            'Uptime SLA'     => '99.95% with monitoring',
        ],
        'performance' => 'WPX Cloud is the reason the company can claim sub-second load times. Because the CDN is its own rather than a resold tier, cached content is served from a nearby point of presence with settings tuned for WordPress, and the origin servers sit in three well-connected regions. In independent speed comparisons WPX consistently places near the top, though the margin over other well-configured managed hosts is smaller than the marketing implies.',
        'security' => [
            'Free malware removal by the support team if a site is compromised, with no time limit',
            'Daily automated backups with 28-day retention and self-service restore',
            'Free SSL with automatic installation and renewal',
            'Enterprise-grade DDoS protection through WPX Cloud',
            'Automatic WordPress core updates with rollback available',
            'Isolated site environments preventing cross-contamination',
        ],
        'pricing_notes' => [
            'Entry is around $25 a month — there is no budget tier.',
            'Plans are priced by site count and storage rather than visits, so traffic spikes do not generate overage bills.',
            'Annual billing includes a substantial discount, often two months free.',
            'A 30-day money-back guarantee applies.',
        ],
        'migration' => 'Free unlimited migrations performed by the WPX team on every plan, typically completed within 24 hours. This is one of the most generous migration policies in managed WordPress hosting.',
        'not_for' => [
            'Budget buyers or single small sites',
            'Developers who need Git-based deployment workflows',
            'Non-WordPress applications',
            'Buyers needing email hosting alongside the sites',
        ],
        'verdict' => 'A no-nonsense managed WordPress host with genuinely fast support, its own CDN and unlimited free migrations, priced by sites rather than visits so your bill does not spike with your traffic. Excellent for someone running several sites who values responsiveness over developer tooling.',
    ],

    'flywheel' => [
        'overview' => 'Flywheel was founded in Omaha in 2012 with a specific customer in mind: the designer or small agency who builds WordPress sites for clients and does not want to think about servers. Everything in the product is shaped around that workflow — a clean dashboard, one-click staging, collaboration tools, blueprints for reusable site setups, and a billing transfer feature that hands a finished site over to the client with the invoice attached.

WP Engine acquired Flywheel in 2019 and, crucially, also took over Local, the free desktop application that Flywheel built and that has become the most widely used local WordPress development environment in the world. The brands remain separate, with Flywheel positioned as the designer-friendly option and WP Engine as the enterprise one.

The platform includes free SSL, nightly backups, a global CDN, caching, malware monitoring with free hack fixes, and staging on all plans. As with the category generally, there is no email hosting, no cPanel, plugin restrictions apply, and plans are metered by visits.',
        'company' => [
            'Ownership'     => 'WP Engine, acquired 2019',
            'Headquarters'  => 'Omaha, Nebraska, United States',
            'Founded'       => '2012',
            'Scale'         => 'Hundreds of thousands of sites, designer and agency focused',
            'Sister brands' => 'WP Engine, Local, StudioPress, Delicious Brains',
        ],
        'timeline' => [
            ['year' => 2012, 'event' => 'Founded in Omaha with a focus on designers and small agencies.'],
            ['year' => 2016, 'event' => 'Releases Local (originally Local by Flywheel), a free desktop WordPress development app.'],
            ['year' => 2019, 'event' => 'Acquired by WP Engine, with Local moving under the same ownership.'],
            ['year' => 2021, 'event' => 'Adds global CDN and improved collaboration tooling across plans.'],
            ['year' => 2023, 'event' => 'Integrates more closely with the WP Engine platform while keeping a separate product identity.'],
        ],
        'hosting_types' => [
            ['name' => 'Managed WordPress', 'from' => '$15/mo',  'note' => 'Tiny through Freelance and Agency, priced by sites and visits.'],
            ['name' => 'Agency plans',      'from' => '$115/mo', 'note' => 'Multiple sites with bulk management and billing transfer.'],
            ['name' => 'Enterprise',        'from' => 'Custom',   'note' => 'High-traffic configurations with dedicated support.'],
        ],
        'specs' => [
            'Control panel'  => 'Flywheel dashboard (custom, no cPanel)',
            'Local development' => 'Local, the free desktop app, integrates directly with hosting',
            'Backups'        => 'Nightly automated backups with one-click restore',
            'Staging'        => 'One-click staging on every plan',
            'CDN'            => 'Global CDN included on all plans',
            'Blueprints'     => 'Reusable site templates for repeatable client builds',
            'Billing transfer' => 'Hand a finished site and its invoice to the client in one step',
            'Collaboration'  => 'Team member accounts with scoped access',
            'Free hack fixes'=> 'Malware cleanup performed free if a site is compromised',
            'Support'        => '24/7 chat support, phone on higher tiers',
            'Uptime SLA'     => '99.9%',
        ],
        'performance' => 'Good and consistent rather than record-breaking. Server-level caching plus the bundled global CDN keeps cached WordPress responses fast for most audiences, and the platform is sized per plan so traffic is predictable. The design-agency workload — moderate traffic, heavy page builders, many images — is what it is tuned for, and it handles that well. Very high traffic sites belong on WP Engine proper.',
        'security' => [
            'Free hack fixes — Flywheel cleans a compromised site at no charge',
            'Nightly automated backups with one-click restore',
            'Free SSL with automatic provisioning and renewal',
            'Managed WordPress core updates and platform patching',
            'Web application firewall and DDoS mitigation at the platform edge',
            'A disallowed-plugin list for performance and security reasons',
        ],
        'pricing_notes' => [
            'Plans are metered by monthly visits with overage charges above the allowance.',
            'Annual billing includes two months free.',
            'Agency plans reduce the per-site cost substantially over individual plans.',
            'A 30-day money-back guarantee applies.',
        ],
        'migration' => 'Free migrations are included, handled by a plugin for standard sites and by the team on request. Local makes the reverse direction easy too: pulling a live site down to your desktop for development is a two-click operation.',
        'not_for' => [
            'Non-WordPress projects',
            'High-traffic publishers, who fit WP Engine better',
            'Anyone needing email hosting or cPanel',
            'Sites relying on plugins from the disallowed list',
        ],
        'verdict' => 'The friendliest managed WordPress host for designers and small agencies, and the client billing transfer plus Local integration genuinely change how a freelance workflow feels. Buy it for the workflow, not for benchmark performance, and move to WP Engine if traffic grows past the category.',
    ],

    'rocket-net' => [
        'overview' => 'Rocket.net launched in 2020 with an architecture nobody else was offering at its price: every site sits behind Cloudflare Enterprise, included free, with full page caching at the edge across more than 270 points of presence. Because pages are served from the edge rather than the origin for the vast majority of requests, time to first byte is typically under 100 milliseconds anywhere in the world, and the origin server is barely touched.

That design also changes the security picture. Cloudflare Enterprise brings a managed web application firewall, bot management, DDoS mitigation and Argo smart routing, all at the edge, so attacks are absorbed before they reach WordPress. Rocket.net adds automatic malware removal, daily backups, one-click staging, and a dashboard built around site management rather than server management.

The company was acquired in 2024 by a group that also holds several WordPress product brands. Plans start around thirty dollars a month for a single site with a modest visit allowance, and traffic is metered, so this is a premium product aimed at sites where speed is a business metric.',
        'company' => [
            'Ownership'    => 'Privately held, acquired 2024 by a WordPress-focused group',
            'Headquarters' => 'Fort Lauderdale, Florida, United States',
            'Founded'      => '2020',
            'Scale'        => 'Rapid growth among performance-focused WordPress site owners',
            'Notable'      => 'Cloudflare Enterprise with full page caching included on every plan',
        ],
        'timeline' => [
            ['year' => 2020, 'event' => 'Founded with Cloudflare Enterprise edge caching built into every plan.'],
            ['year' => 2021, 'event' => 'Adds automatic malware removal and one-click staging.'],
            ['year' => 2022, 'event' => 'Expands origin infrastructure across more global regions.'],
            ['year' => 2023, 'event' => 'Introduces agency and reseller tooling for multi-site management.'],
            ['year' => 2024, 'event' => 'Acquired by a group holding several WordPress product brands.'],
        ],
        'hosting_types' => [
            ['name' => 'Managed WordPress', 'from' => '$30/mo',  'note' => 'Single-site through multi-site plans, metered by visits.'],
            ['name' => 'Agency plans',      'from' => 'Custom',   'note' => 'Bulk site management with white-label options.'],
            ['name' => 'Enterprise',        'from' => 'Custom',   'note' => 'High-traffic configurations with dedicated resources.'],
        ],
        'specs' => [
            'Control panel'  => 'Rocket.net custom dashboard',
            'Edge network'   => 'Cloudflare Enterprise with 270+ points of presence, included free',
            'Caching'        => 'Full page caching at the edge, plus Redis object caching at origin',
            'Storage'        => 'NVMe SSD on enterprise-grade hardware',
            'Backups'        => 'Daily automated backups with 14-day retention and one-click restore',
            'Staging'        => 'One-click staging with push to live',
            'Security'       => 'Cloudflare WAF, bot management and DDoS mitigation at the edge',
            'Malware'        => 'Automatic malware scanning and removal included',
            'Developer tools'=> 'SFTP, SSH, WP-CLI and phpMyAdmin access',
            'Support'        => '24/7 WordPress-specialist support',
            'Uptime SLA'     => '99.99%',
        ],
        'performance' => 'This is the fastest architecture available for a standard WordPress site, and the numbers are not marketing. Full page caching at Cloudflare Enterprise edge means a visitor in Sydney is served from Sydney, not from a United States origin, and sub-100 millisecond time to first byte worldwide is the normal result rather than a best case. Uncached requests — logged-in users, carts, forms — still hit the origin, which is fast NVMe hardware with Redis object caching, so the fallback path is good too.',
        'security' => [
            'Cloudflare Enterprise web application firewall and bot management on every site',
            'Enterprise-grade DDoS mitigation absorbing attacks at the edge',
            'Automatic malware scanning and removal, included',
            'Daily automated backups with 14-day retention',
            'Free SSL with automatic provisioning and renewal',
            'Isolated containers per site',
        ],
        'pricing_notes' => [
            'Plans are metered by monthly visits; overage applies above the allowance.',
            'Cloudflare Enterprise alone typically costs hundreds a month bought directly — it is included here.',
            'Annual billing carries a discount.',
            'A 30-day money-back guarantee applies.',
        ],
        'migration' => 'Free migrations included on every plan, handled by the team, typically completed within hours. Staging lets you verify before switching DNS, and the team assists with the Cloudflare nameserver change.',
        'not_for' => [
            'Budget projects — the floor is around $30 a month for one site',
            'Non-WordPress applications',
            'Sites needing email hosting in the same place',
            'Highly dynamic sites where almost nothing is cacheable, since the edge advantage shrinks',
        ],
        'verdict' => 'The fastest way to make a WordPress site quick everywhere on earth, and the included Cloudflare Enterprise is worth more than the hosting fee on its own. Buy it when global page speed is a business metric; skip it if your traffic is local and modest.',
    ],

    'upcloud' => [
        'overview' => 'UpCloud is a Finnish cloud provider founded in Helsinki in 2012 that built its reputation on a single technical claim: MaxIOPS, its proprietary block storage architecture, is faster than the storage offered by competing clouds. Independent benchmarks have repeatedly supported that, showing UpCloud storage input and output substantially ahead of comparable instances at DigitalOcean, Linode and Vultr.

For database-heavy workloads, storage speed is often the actual bottleneck rather than CPU, which makes UpCloud a specific and defensible choice for anyone running MySQL, PostgreSQL or a write-heavy application. The platform also offers per-second billing, a 100% uptime SLA with real credits, private networking, floating IPs, managed databases, load balancers and a clean API.

The company is smaller than its competitors and prices slightly above them, with eleven or so data centres against DigitalOcean\'s fourteen and Vultr\'s thirty-two. Support is included and responsive, but as with every provider in this category, you are the systems administrator.',
        'company' => [
            'Ownership'    => 'Privately held, Finnish owned',
            'Headquarters' => 'Helsinki, Finland',
            'Founded'      => '2012',
            'Scale'        => 'Data centres across Europe, North America, Asia and Australia',
            'Notable'      => 'MaxIOPS storage architecture, independently benchmarked as category-leading',
        ],
        'timeline' => [
            ['year' => 2012, 'event' => 'Founded in Helsinki with a focus on storage performance.'],
            ['year' => 2015, 'event' => 'Introduces MaxIOPS distributed block storage.'],
            ['year' => 2018, 'event' => 'Expands into Asia-Pacific and North America.'],
            ['year' => 2021, 'event' => 'Launches managed databases and managed load balancers.'],
            ['year' => 2023, 'event' => 'Adds managed Kubernetes and expands the object storage product.'],
        ],
        'hosting_types' => [
            ['name' => 'Cloud servers',      'from' => '$5/mo',   'note' => 'General purpose, high CPU and high memory plans with MaxIOPS storage.'],
            ['name' => 'Managed databases',  'from' => '$18/mo',  'note' => 'Managed MySQL, PostgreSQL and Redis with automatic failover.'],
            ['name' => 'Managed Kubernetes', 'from' => 'Usage',   'note' => 'Free control plane, pay for worker nodes.'],
            ['name' => 'Object storage',     'from' => '$5/mo',   'note' => 'S3-compatible storage with regional placement.'],
            ['name' => 'Load balancers',     'from' => 'Usage',   'note' => 'Managed layer four and seven load balancing.'],
        ],
        'specs' => [
            'Control panel'  => 'UpCloud control panel, full API, CLI and Terraform provider',
            'Storage'        => 'MaxIOPS distributed block storage, independently benchmarked as fastest in class',
            'Virtualisation' => 'KVM with dedicated and general purpose plans',
            'Billing'        => 'Per-second billing with no minimum commitment',
            'Networking'     => 'Private SDN networking, floating IPs, IPv6 included',
            'Backups'        => 'Manual and scheduled backups, plus snapshots',
            'Operating systems' => 'Linux distributions, Windows Server, and custom image upload',
            'Locations'      => 'Helsinki, London, Amsterdam, Frankfurt, Madrid, Warsaw, Chicago, New York, San Jose, Singapore, Sydney',
            'Support'        => '24/7 support included at no extra charge',
            'Uptime SLA'     => '100% uptime SLA with 50x compensation for downtime',
        ],
        'performance' => 'MaxIOPS is the reason to be here. In benchmark after benchmark, UpCloud storage delivers several times the input and output operations of standard cloud block storage, which translates directly into faster database queries and quicker page generation for anything write-heavy. CPU performance is competitive rather than exceptional, and the network is well-peered across its regions. If your bottleneck is disk, this is the provider that fixes it.',
        'security' => [
            'Private SDN networking isolating traffic between your servers',
            'Firewall rules configurable per server through the panel and API',
            'ISO 27001 certified and GDPR compliant, with EU data residency',
            'Scheduled backups and snapshots with restore',
            'Two-factor authentication on the account',
            'Operating system hardening remains your responsibility',
        ],
        'pricing_notes' => [
            'Slightly more expensive than DigitalOcean or Hetzner for equivalent specifications.',
            'Per-second billing means short-lived workloads cost almost nothing.',
            'The 100% uptime SLA pays 50 times the value of affected downtime, which is unusually strong.',
            'A free trial credit is available for new accounts.',
        ],
        'migration' => 'Self-service, with custom image upload and snapshot restore making moves from other clouds straightforward. There is no managed migration service.',
        'not_for' => [
            'Anyone wanting managed hosting, cPanel or email',
            'Buyers optimising purely on price, where Hetzner and Contabo are cheaper',
            'Workloads needing many global regions',
            'Non-technical users',
        ],
        'verdict' => 'The cloud to pick when disk speed is your bottleneck, which for database-driven applications it very often is. Pay a small premium over DigitalOcean and get storage that is measurably faster, plus a 100% SLA that actually compensates. Bring your own systems administration.',
    ],

    'kamatera' => [
        'overview' => 'Kamatera has been operating since 1995, which makes it older than almost every cloud provider, and its product reflects a different philosophy from the fixed-size-instance model that DigitalOcean popularised. On Kamatera you configure a server the way you would specify a physical machine: choose the exact number of CPU cores, the exact amount of RAM, the exact disk size and type, the CPU class, and the data centre, and pay for precisely that combination by the hour.

That flexibility is genuinely useful for workloads that do not fit standard shapes — a machine with two cores and sixty-four gigabytes of RAM, or twenty cores and four gigabytes, is trivial here and impossible at most competitors. Kamatera also offers managed services as an add-on, so you can buy systems administration alongside the infrastructure, which most of this category does not provide.

The footprint is broad, with over twenty data centres across North America, Europe, Asia and the Middle East, including Israel where the company is based. The control panel is dated, documentation is thinner than the big clouds, and the brand is much less known than its age would suggest.',
        'company' => [
            'Ownership'    => 'Privately held, Israeli owned',
            'Headquarters' => 'Petah Tikva, Israel, with a New York presence',
            'Founded'      => '1995',
            'Scale'        => '20+ data centres across four continents',
            'Notable'      => 'Fully configurable server specifications rather than fixed instance sizes',
        ],
        'timeline' => [
            ['year' => 1995, 'event' => 'Founded as an infrastructure provider, predating the modern cloud era.'],
            ['year' => 2010, 'event' => 'Launches a cloud platform with fully configurable server specifications.'],
            ['year' => 2016, 'event' => 'Expands to data centres across North America, Europe and Asia.'],
            ['year' => 2020, 'event' => 'Adds managed service tiers and a marketplace of preconfigured images.'],
            ['year' => 2023, 'event' => 'Grows to more than twenty global data centre locations.'],
        ],
        'hosting_types' => [
            ['name' => 'Cloud servers',      'from' => '$4/mo',   'note' => 'Fully configurable cores, RAM, disk and CPU class.'],
            ['name' => 'Managed cloud',      'from' => 'Add-on',  'note' => 'Systems administration bought alongside the infrastructure.'],
            ['name' => 'Block storage',      'from' => 'Usage',   'note' => 'SSD and NVMe volumes attached to any server.'],
            ['name' => 'Load balancers',     'from' => 'Usage',   'note' => 'Managed load balancing across servers.'],
            ['name' => 'Private cloud',      'from' => 'Custom',  'note' => 'Dedicated infrastructure with a private network.'],
        ],
        'specs' => [
            'Control panel'  => 'Kamatera console with API access',
            'Configuration'  => 'Any combination of cores, RAM and storage — not fixed instance sizes',
            'CPU classes'    => 'Availability, General Purpose, Dedicated and Dedicated Extra tiers',
            'Storage'        => 'SSD and NVMe block storage, resizable',
            'Operating systems' => 'Linux distributions, Windows Server, and a marketplace of application images',
            'Billing'        => 'Hourly with monthly caps, scale up or down at any time',
            'Managed options'=> 'Optional managed services including monitoring and administration',
            'Locations'      => 'North America, Europe, Asia, Middle East including Israel',
            'Networking'     => 'Private networks, firewalls and public IP management',
            'Support'        => '24/7 support included, managed tiers available',
            'Uptime SLA'     => '99.95% with credits',
        ],
        'performance' => 'Depends entirely on the CPU class you buy. The Availability tier is cheap and best-effort; Dedicated and Dedicated Extra give consistent performance comparable to other clouds. Because you specify the exact configuration, you can eliminate the waste of buying an instance shape that does not match your workload. The wide data centre footprint, including Israel and the Middle East, covers regions many competitors skip.',
        'security' => [
            'Configurable firewalls and private networking between servers',
            'Daily backup and snapshot options',
            'ISO 27001 certified facilities',
            'Two-factor authentication on the management console',
            'Managed security services available as a paid add-on',
            'Operating system patching is yours unless you buy the managed tier',
        ],
        'pricing_notes' => [
            'Pay only for the exact specification you configure, billed hourly.',
            'The Availability CPU class is the cheapest and the least consistent.',
            'Managed services are an add-on with their own monthly fee.',
            'A 30-day free trial is offered for new accounts.',
        ],
        'migration' => 'Self-service, with image upload and snapshot tooling. Managed service customers can have Kamatera engineers assist with the move, which is unusual for a cloud provider at this price.',
        'not_for' => [
            'Buyers who want the polish and documentation depth of a major cloud',
            'Anyone wanting managed WordPress or cPanel hosting out of the box',
            'Teams that prefer standard instance shapes and predictable catalogue pricing',
            'Non-technical users, unless buying the managed tier',
        ],
        'verdict' => 'The cloud for workloads that do not fit standard instance shapes, with an unusually wide data centre footprint and the rare option to buy managed administration alongside. Specify a Dedicated CPU class for production, and accept a dated console in exchange for genuine configuration freedom.',
    ],

    'fasthosts' => [
        'overview' => 'Fasthosts is a British host founded in Gloucester in 1999 and owned since 2006 by United Internet, the German group that also owns IONOS. Its proposition is straightforward: hosting run from United Kingdom data centres that Fasthosts owns, with United Kingdom-based support, United Kingdom billing, and data that never leaves the country unless you choose otherwise.

For British businesses with data residency requirements, or simply a preference for local support hours and pound sterling invoices, that matters. The product range is complete — shared hosting on Plesk or a custom panel, managed WordPress, VPS with a choice of Linux or Windows, dedicated servers, a CloudNX platform with virtual data centre features, email, and a large domain registration business including .uk domains.

The platform is conventional and competent rather than innovative, and pricing follows the usual introductory-then-renewal pattern. Where Fasthosts stands out is the reseller and partner programme, which a substantial number of United Kingdom agencies and IT consultancies build on.',
        'company' => [
            'Ownership'     => 'United Internet AG, the same group as IONOS',
            'Headquarters'  => 'Gloucester, United Kingdom',
            'Founded'       => '1999',
            'Scale'         => 'Hundreds of thousands of UK domains and websites',
            'Facilities'    => 'Owns and operates its own UK data centres',
        ],
        'timeline' => [
            ['year' => 1999, 'event' => 'Founded in Gloucester as a United Kingdom hosting provider.'],
            ['year' => 2006, 'event' => 'Acquired by United Internet, parent of IONOS.'],
            ['year' => 2014, 'event' => 'Launches CloudNX, a virtual data centre platform.'],
            ['year' => 2019, 'event' => 'Expands the partner and reseller programme for UK agencies.'],
            ['year' => 2022, 'event' => 'Refreshes hosting plans with NVMe storage and updated panels.'],
        ],
        'hosting_types' => [
            ['name' => 'Web hosting',       'from' => '$2.99/mo',  'note' => 'Shared plans on UK infrastructure with a free domain.'],
            ['name' => 'WordPress hosting', 'from' => '$4.99/mo',  'note' => 'Managed WordPress with automatic updates and caching.'],
            ['name' => 'VPS hosting',       'from' => '$9.99/mo',  'note' => 'Linux or Windows virtual servers with full root access.'],
            ['name' => 'Dedicated servers', 'from' => '$99/mo',    'note' => 'Bare metal in UK data centres with managed options.'],
            ['name' => 'CloudNX',           'from' => 'Usage',     'note' => 'Virtual data centre with configurable compute and storage.'],
        ],
        'specs' => [
            'Control panel'  => 'Custom Fasthosts panel, with Plesk available on VPS and dedicated',
            'Data residency' => 'UK data centres owned and operated by Fasthosts',
            'Storage'        => 'SSD and NVMe on current plans',
            'Platforms'      => 'Linux and Windows Server both supported',
            'PHP versions'   => 'PHP 7.x and 8.x',
            'Backups'        => 'Included on most hosting plans with restore',
            'Email'          => 'Mailboxes included, plus a separate Exchange-style product',
            'Reseller'       => 'Established partner programme for UK agencies',
            'Support'        => 'UK-based 24/7 phone and chat support',
            'Compliance'     => 'ISO 27001, UK GDPR aligned',
            'Uptime SLA'     => '99.9% with credits',
        ],
        'performance' => 'Good within the United Kingdom, where the owned data centres give short round trips and local peering. Internationally it is unremarkable and depends on a CDN you configure yourself. The stack is conventional — no LiteSpeed, no edge caching included — so the value is the geography, the local support and the data residency rather than benchmark speed.',
        'security' => [
            'UK data residency with ISO 27001 certified owned facilities',
            'Free SSL on current hosting plans',
            'Backups included with restore on most plans',
            'DDoS protection at the network edge',
            'Two-factor authentication on the control panel',
        ],
        'pricing_notes' => [
            'Pricing is in pounds sterling with UK VAT handling.',
            'Introductory rates renew higher, following the standard industry pattern.',
            'Minimum contract terms apply on some products — check before ordering.',
            'A 30-day money-back guarantee applies to most hosting products.',
        ],
        'migration' => 'Migration assistance is available through support, with standard transfer tooling. Reseller partners get help moving client portfolios.',
        'not_for' => [
            'Audiences outside the United Kingdom',
            'Performance-focused buyers wanting LiteSpeed or edge caching',
            'Developers wanting Git-based workflows and modern staging',
            'Anyone averse to minimum contract terms',
        ],
        'verdict' => 'A solid, long-established British host for businesses that want their data, their support and their invoices in the United Kingdom. Buy it for the data residency and the local support, not for technical leadership, and check the contract term before ordering.',
    ],

    'sitehost' => [
        'overview' => 'SiteHost is a New Zealand company founded in Auckland in 2008 that hosts almost exclusively on New Zealand infrastructure and sells to New Zealand and Australian businesses. That narrow focus is the point: an Auckland business hosting in Sydney adds around thirty milliseconds, and hosting in the United States adds close to two hundred, which is felt on every uncached request.

The product is more sophisticated than most local hosts. SiteHost offers container-based cloud hosting alongside traditional VPS and dedicated servers, with a well-built control panel, per-container resource allocation, staging, Git deployment, and a managed option where the team handles patching and monitoring. It is a genuine cloud platform rather than a reseller of someone else\'s.

Support is local, technical and well-regarded, and the company has a reputation in the New Zealand web industry for being the host that agencies recommend. Pricing is higher than international commodity hosting, which is the cost of local infrastructure in a small market.',
        'company' => [
            'Ownership'    => 'Privately held, New Zealand owned',
            'Headquarters' => 'Auckland, New Zealand',
            'Founded'      => '2008',
            'Scale'        => 'A leading independent host in the New Zealand market',
            'Facilities'   => 'New Zealand data centres with local peering',
        ],
        'timeline' => [
            ['year' => 2008, 'event' => 'Founded in Auckland serving the New Zealand web industry.'],
            ['year' => 2014, 'event' => 'Launches a cloud platform with its own control panel.'],
            ['year' => 2018, 'event' => 'Introduces container-based hosting with per-container resource control.'],
            ['year' => 2021, 'event' => 'Adds managed service tiers with patching and monitoring included.'],
            ['year' => 2023, 'event' => 'Expands developer tooling including Git deployment and staging.'],
        ],
        'hosting_types' => [
            ['name' => 'Cloud containers', 'from' => '$8/mo',   'note' => 'Container-based hosting with per-site resource allocation.'],
            ['name' => 'Cloud servers',    'from' => '$20/mo',  'note' => 'Virtual servers with root access, managed or unmanaged.'],
            ['name' => 'Managed hosting',  'from' => 'Custom',  'note' => 'Patching, monitoring and incident response included.'],
            ['name' => 'Dedicated servers','from' => 'Custom',  'note' => 'Single-tenant hardware in New Zealand facilities.'],
        ],
        'specs' => [
            'Control panel'  => 'SiteHost custom control panel with API',
            'Architecture'   => 'Container-based cloud with per-container CPU and memory allocation',
            'Data residency' => 'New Zealand data centres with local peering',
            'Storage'        => 'SSD storage across the platform',
            'Developer tools'=> 'Git deployment, SSH, staging environments, PHP version control',
            'Backups'        => 'Automated backups with restore',
            'Managed options'=> 'Patching, monitoring and incident response on managed tiers',
            'Support'        => 'New Zealand based technical support in local hours',
            'Compliance'     => 'Local data residency for New Zealand regulatory requirements',
            'Uptime SLA'     => '99.9% with credits',
        ],
        'performance' => 'For a New Zealand audience this is the fastest practical option, because the origin is in the country and peering with local networks is direct. Container-based allocation means resources are yours rather than shared with unknown neighbours. For an audience outside Australasia the geography works against you, and an international host would serve better.',
        'security' => [
            'New Zealand data residency for organisations with local requirements',
            'Per-container isolation between hosted sites',
            'Automated backups with restore',
            'Free SSL with automatic renewal',
            'Managed patching and monitoring on managed tiers',
            'Local support able to respond during New Zealand business hours',
        ],
        'pricing_notes' => [
            'Pricing is in New Zealand dollars and is higher than international commodity hosting.',
            'That premium buys local infrastructure, local support and local data residency.',
            'Managed tiers add a monthly fee over the unmanaged price.',
            'No long-term contract is required.',
        ],
        'migration' => 'Migration assistance is provided by the local support team, and the container platform with staging makes validating a migrated site before cutover straightforward.',
        'not_for' => [
            'Audiences outside New Zealand and Australia',
            'Buyers seeking the lowest possible price',
            'Anyone wanting cPanel or a mass-market managed WordPress product',
            'Global applications needing many regions',
        ],
        'verdict' => 'The host New Zealand agencies recommend to each other, and the right answer for any business whose customers are in New Zealand. Local latency, local data, local support and a genuinely modern container platform, at a price that reflects a small market.',
    ],

    'hostarmada' => [
        'overview' => 'HostArmada launched in 2019, which makes it one of the youngest hosts in the directory, and it built its platform on an architecture that older competitors retrofitted: every shared hosting account runs in an isolated cloud container on SSD storage rather than on a packed physical server. That means a resource spike from a neighbour does not reach you, and a hardware failure moves your container rather than taking your site down.

The plans are generous for the price. Free daily backups with seven-day retention, free unlimited migrations, free SSL, free domain on annual plans, a choice of nine data centres spanning four continents, cPanel, and support that responds quickly and technically. The company also bundles a web application firewall and malware scanning rather than selling them as add-ons.

Being young is both the appeal and the risk. HostArmada has grown quickly on strong reviews, but it lacks the two-decade track record of its competitors, and its VPS and dedicated ranges are less developed than its shared hosting.',
        'company' => [
            'Ownership'    => 'Privately held, independent',
            'Headquarters' => 'Dover, Delaware, United States, with engineering in Bulgaria',
            'Founded'      => '2019',
            'Scale'        => 'Rapid growth on strong customer reviews since launch',
            'Notable'      => 'Cloud container isolation on every shared hosting account',
        ],
        'timeline' => [
            ['year' => 2019, 'event' => 'Founded with a cloud-container shared hosting architecture.'],
            ['year' => 2020, 'event' => 'Expands to multiple global data centre locations.'],
            ['year' => 2021, 'event' => 'Adds free daily backups and unlimited free migrations to all plans.'],
            ['year' => 2022, 'event' => 'Grows to nine data centres across four continents.'],
            ['year' => 2023, 'event' => 'Expands cloud VPS and reseller ranges.'],
        ],
        'hosting_types' => [
            ['name' => 'Shared hosting',    'from' => '$2.49/mo',  'note' => 'Start Dock, Web Warp and Speed Reaper on cloud containers.'],
            ['name' => 'WordPress hosting', 'from' => '$2.49/mo',  'note' => 'Same platform with WordPress preinstalled and optimised.'],
            ['name' => 'Cloud VPS',         'from' => '$41.29/mo', 'note' => 'Managed VPS with cPanel and dedicated resources.'],
            ['name' => 'Dedicated CPU',     'from' => '$110/mo',   'note' => 'Dedicated cloud resources, fully managed.'],
            ['name' => 'Reseller hosting',  'from' => '$25.29/mo', 'note' => 'WHM with white-label branding for agencies.'],
        ],
        'specs' => [
            'Control panel'  => 'cPanel',
            'Architecture'   => 'Isolated cloud containers with automatic failover',
            'Storage'        => 'SSD and NVMe depending on plan tier',
            'Web server'     => 'Apache with NGINX reverse proxy; LiteSpeed on higher tiers',
            'Backups'        => 'Free daily backups with 7-day retention on all plans',
            'Free migration' => 'Unlimited free migrations performed by the team',
            'CDN'            => 'Free Cloudflare integration',
            'Security'       => 'Web application firewall and malware scanning included',
            'Locations'      => 'Nine data centres across North America, Europe, Asia and Australia',
            'Support'        => '24/7 chat, phone and ticket support',
            'Uptime SLA'     => '99.9% with credits',
        ],
        'performance' => 'Better than most shared hosting because of the container architecture. Isolated resources mean consistent response times rather than the variability that defines packed shared servers, and the Speed Reaper tier with NVMe and LiteSpeed is genuinely fast. Nine data centres across four continents is excellent coverage at this price and lets you put the origin near your audience rather than relying on a CDN.',
        'security' => [
            'Isolated cloud containers preventing cross-account contamination',
            'Free daily backups with 7-day retention and self-service restore',
            'Web application firewall and malware scanning included, not upsold',
            'Free SSL with automatic installation and renewal',
            'Automatic failover if the underlying host fails',
            'Two-factor authentication on the client area',
        ],
        'pricing_notes' => [
            'The advertised rate needs a three-year term; shorter terms cost more.',
            'Renewal roughly doubles to triples, in line with the sector.',
            'Backups, WAF and migrations are included rather than charged, which offsets the renewal.',
            'A 45-day money-back guarantee applies, longer than the norm.',
        ],
        'migration' => 'Unlimited free migrations on every plan, performed by the support team, including non-cPanel sources. This is among the most generous migration policies available and a genuine reason to consider the host.',
        'not_for' => [
            'Buyers who want a long, proven track record',
            'High-traffic applications needing enterprise-grade scaling',
            'Developers wanting Git deploys and modern staging workflows',
            'Anyone unwilling to prepay three years for the headline rate',
        ],
        'verdict' => 'The best-architected young host in shared hosting: container isolation, nine global regions, free daily backups and unlimited free migrations at a budget price. The only real caveat is youth, and the 45-day guarantee makes testing that concern cheap.',
    ],

    'chemicloud' => [
        'overview' => 'ChemiCloud is a small host founded in 2016 by a team with roots in Romania and the United States, and it competes almost entirely on service. Support responds in minutes, on chat, with technical answers, and the company\'s reviews are dominated by people describing problems being solved rather than tickets being closed. For a category where support is usually the first cost cut, that is the product.

The technical platform is modern and generous: LiteSpeed with LSCache, NVMe storage, cPanel, free daily backups, free unlimited migrations, free domain for life on annual plans, a free CDN, and eight data centres across four continents. Resource allocations on the entry plan are modest, but the middle tier is well-specified for a small business site.

The limits are scale. There is no enterprise tier, the VPS range is small, and the company is not trying to host a high-traffic application. It is trying to host your small business site well and answer the phone when something breaks.',
        'company' => [
            'Ownership'    => 'Privately held, independent',
            'Headquarters' => 'United States registered, with operations in Romania',
            'Founded'      => '2016',
            'Scale'        => 'A small, service-focused customer base with very high review scores',
            'Notable'      => 'Free domain for life on annual plans, unusual in the market',
        ],
        'timeline' => [
            ['year' => 2016, 'event' => 'Founded with a support-first positioning in shared hosting.'],
            ['year' => 2018, 'event' => 'Moves the platform to LiteSpeed with LSCache.'],
            ['year' => 2020, 'event' => 'Expands to data centres across four continents.'],
            ['year' => 2021, 'event' => 'Adds free daily backups and unlimited free migrations.'],
            ['year' => 2023, 'event' => 'Migrates the fleet to NVMe storage.'],
        ],
        'hosting_types' => [
            ['name' => 'Shared hosting',    'from' => '$2.95/mo',  'note' => 'Starter, Pro and Turbo on LiteSpeed with NVMe.'],
            ['name' => 'WordPress hosting', 'from' => '$2.95/mo',  'note' => 'Same stack with WordPress preinstalled and LSCache configured.'],
            ['name' => 'Cloud VPS',         'from' => '$29.95/mo', 'note' => 'Managed VPS with cPanel and dedicated resources.'],
            ['name' => 'Reseller hosting',  'from' => '$19.95/mo', 'note' => 'WHM with white-label branding and client tools.'],
        ],
        'specs' => [
            'Control panel'  => 'cPanel',
            'Web server'     => 'LiteSpeed with LSCache',
            'Storage'        => 'NVMe SSD',
            'PHP versions'   => 'PHP 7.x through 8.x with per-account switching',
            'Backups'        => 'Free daily backups with restore, retained on all plans',
            'Staging'        => 'Yes, on Pro and Turbo tiers',
            'Free migration' => 'Unlimited free migrations performed by the team',
            'Domain'         => 'Free domain for life on annual plans',
            'CDN'            => 'Free CDN included',
            'Locations'      => 'Eight data centres across four continents',
            'Support'        => '24/7 chat with fast, technical responses',
            'Uptime SLA'     => '99.9% with credits',
        ],
        'performance' => 'LiteSpeed plus LSCache plus NVMe puts ChemiCloud in the upper tier of shared hosting performance, with cached WordPress pages typically responding in the 200 to 400 millisecond band from a nearby region. Eight data centres including options in Europe, Asia and Australia mean the origin can sit near your audience. The entry plan is resource-limited enough that the Pro tier is the sensible starting point for a business site.',
        'security' => [
            'Free daily backups with self-service restore on every plan',
            'Free SSL with automatic installation and renewal',
            'Account isolation with server-level firewall and malware scanning',
            'Free domain privacy on eligible registrations',
            'DDoS protection at the network edge',
            'Two-factor authentication on the client portal',
        ],
        'pricing_notes' => [
            'The headline rate needs a three-year term; renewal is roughly two to three times higher.',
            'The free-domain-for-life offer on annual plans is worth real money over time.',
            'Backups, CDN and migrations are included rather than charged.',
            'A 45-day money-back guarantee applies, longer than the norm.',
        ],
        'migration' => 'Unlimited free migrations on every plan, handled by the support team, with the same responsiveness that defines the company. Migrations from cPanel and non-cPanel sources are both supported.',
        'not_for' => [
            'High-traffic applications or enterprise workloads',
            'Developers wanting Git deploys and modern CI workflows',
            'Buyers who want a large, established brand behind them',
            'Anyone unwilling to commit to a multi-year term for the best rate',
        ],
        'verdict' => 'A small host that does the basics unusually well and answers quickly when something goes wrong. LiteSpeed, NVMe, free daily backups, unlimited migrations and a free domain for life make the Pro tier a strong value for a small business site.',
    ],

    'verpex' => [
        'overview' => 'Verpex launched in 2018 and built its offer around removing the friction that stops people switching hosts. Migrations are unlimited and free, performed by the team, from any host, at any time — not just at signup. That alone solves the problem that keeps most people stuck on a slow host they dislike.

The rest of the plan list is similarly generous: fifteen data centre locations spanning six continents, LiteSpeed with LSCache, NVMe storage, free daily backups retained for up to ninety days on higher tiers, free SSL, a free CDN, and Imunify360 security included rather than upsold. Prices are low and the 45-day money-back guarantee is longer than the sector standard.

The company is young and small, the VPS range is limited, and the entry plan\'s resource ceiling arrives quickly. But for a small site with an international audience, the combination of fifteen origin locations and free unlimited migrations is genuinely hard to match at the price.',
        'company' => [
            'Ownership'    => 'Privately held, independent',
            'Headquarters' => 'United States registered, with a distributed team',
            'Founded'      => '2018',
            'Scale'        => 'Growing fast on strong reviews, 15 global data centre locations',
            'Notable'      => 'Unlimited free migrations at any time, not just at signup',
        ],
        'timeline' => [
            ['year' => 2018, 'event' => 'Founded with a multi-region shared hosting platform.'],
            ['year' => 2020, 'event' => 'Adds LiteSpeed with LSCache across all plans.'],
            ['year' => 2021, 'event' => 'Expands to more than a dozen global data centre locations.'],
            ['year' => 2022, 'event' => 'Bundles Imunify360 security and free daily backups on all plans.'],
            ['year' => 2023, 'event' => 'Migrates the fleet to NVMe storage.'],
        ],
        'hosting_types' => [
            ['name' => 'Shared hosting',    'from' => '$2.50/mo',  'note' => 'Bronze, Silver and Gold on LiteSpeed with NVMe.'],
            ['name' => 'WordPress hosting', 'from' => '$2.50/mo',  'note' => 'Same stack preconfigured with WordPress and LSCache.'],
            ['name' => 'Cloud VPS',         'from' => '$24/mo',    'note' => 'Managed VPS with dedicated resources and cPanel.'],
            ['name' => 'Reseller hosting',  'from' => '$14.99/mo', 'note' => 'White-label WHM accounts for agencies.'],
        ],
        'specs' => [
            'Control panel'  => 'cPanel',
            'Web server'     => 'LiteSpeed with LSCache',
            'Storage'        => 'NVMe SSD',
            'Locations'      => '15 data centres across six continents',
            'Backups'        => 'Free daily backups, retention up to 90 days on higher tiers',
            'Security'       => 'Imunify360 included on all plans',
            'Free migration' => 'Unlimited free migrations, at any time, from any host',
            'CDN'            => 'Free CDN included',
            'PHP versions'   => 'PHP 7.x through 8.x',
            'Support'        => '24/7 chat and ticket support',
            'Uptime SLA'     => '99.9% with credits',
        ],
        'performance' => 'The fifteen-location footprint is the standout. Being able to place a cheap shared hosting origin in Sao Paulo, Johannesburg, Mumbai, Sydney, Tokyo or Toronto rather than always in the United States removes hundreds of milliseconds for audiences outside the usual regions. LiteSpeed with LSCache on NVMe puts cached WordPress responses in the 200 to 400 millisecond band. Resource limits on the entry Bronze plan are the practical ceiling.',
        'security' => [
            'Imunify360 malware detection, firewall and proactive defence included on all plans',
            'Free daily backups with up to 90-day retention on higher tiers',
            'Free SSL with automatic installation and renewal',
            'Account isolation between shared tenants',
            'DDoS protection at the network edge',
            'Two-factor authentication on the client area',
        ],
        'pricing_notes' => [
            'The advertised rate requires a multi-year term; renewal roughly doubles.',
            'Imunify360, backups, CDN and migrations are all included rather than charged.',
            'A 45-day money-back guarantee applies, longer than the sector norm.',
            'Monthly billing is available at a higher rate without a long commitment.',
        ],
        'migration' => 'Unlimited free migrations from any host, at any time, performed by the team — not limited to the first 30 days like most competitors. This is the single most customer-friendly migration policy in shared hosting.',
        'not_for' => [
            'High-traffic sites that will outgrow shared resource limits',
            'Buyers who want a long-established brand with a decade of history',
            'Developers wanting staging, Git and modern CI tooling',
            'Enterprise workloads needing formal SLAs and account management',
        ],
        'verdict' => 'The most generous small host in the market: fifteen origin locations, LiteSpeed on NVMe, Imunify360 security, free daily backups and unlimited free migrations forever. Pick the Silver tier for a real business site, and enjoy the fact that leaving is free if you change your mind.',
    ],

    'krystal' => [
        'overview' => 'Krystal is a British host founded in 2002 that became, in 2020, the United Kingdom\'s first certified B Corporation hosting provider. That certification is not marketing decoration: it requires audited standards on environmental impact, worker treatment and governance, and Krystal backs it with 100% renewable energy across its infrastructure, a tree-planting programme, and published sustainability reporting.

The hosting itself is genuinely good. Krystal runs its own cloud platform, Katapult, from United Kingdom data centres, with NVMe storage, LiteSpeed on shared plans, free daily backups, free migrations, DirectAdmin or cPanel depending on product, and a support team based in the United Kingdom that has a strong reputation among British agencies. The Onyx and Katapult ranges give a clean path from shared hosting up to configurable cloud servers.

Prices are above budget commodity hosting, which is the cost of running ethically in an expensive market. For a British business that cares where its money goes and wants its data and support in the country, it is a rare combination.',
        'company' => [
            'Ownership'    => 'Privately held, British owned, employee-friendly B Corp',
            'Headquarters' => 'Sussex, United Kingdom',
            'Founded'      => '2002',
            'Scale'        => 'Tens of thousands of UK websites, agency-heavy customer base',
            'Certification'=> 'Certified B Corporation, 100% renewable energy',
        ],
        'timeline' => [
            ['year' => 2002, 'event' => 'Founded in the United Kingdom as an independent host.'],
            ['year' => 2017, 'event' => 'Moves fully to renewable energy across its infrastructure.'],
            ['year' => 2020, 'event' => 'Becomes the UK\'s first B Corp certified hosting provider.'],
            ['year' => 2021, 'event' => 'Launches Katapult, its own cloud compute platform.'],
            ['year' => 2023, 'event' => 'Expands Katapult regions and adds managed WordPress tooling.'],
        ],
        'hosting_types' => [
            ['name' => 'Shared hosting',    'from' => '$6.99/mo',  'note' => 'Onyx range on LiteSpeed with NVMe and free migrations.'],
            ['name' => 'WordPress hosting', 'from' => '$6.99/mo',  'note' => 'Managed WordPress tooling with staging and caching.'],
            ['name' => 'Katapult cloud',    'from' => '$5/mo',     'note' => 'Configurable cloud servers on its own platform.'],
            ['name' => 'Reseller hosting',  'from' => '$24.99/mo', 'note' => 'White-label accounts for UK agencies.'],
            ['name' => 'Managed hosting',   'from' => 'Custom',    'note' => 'Fully managed solutions with account support.'],
        ],
        'specs' => [
            'Control panel'  => 'DirectAdmin on shared, Katapult console on cloud',
            'Web server'     => 'LiteSpeed with caching on shared plans',
            'Storage'        => 'NVMe SSD throughout',
            'Data residency' => 'UK data centres, 100% renewable powered',
            'Backups'        => 'Free daily backups with self-service restore',
            'Free migration' => 'Free migrations performed by the UK team',
            'Staging'        => 'Yes, on WordPress plans',
            'Developer tools'=> 'SSH, Git, WP-CLI and PHP version control',
            'Ethics'         => 'B Corp certified, renewable energy, tree-planting programme',
            'Support'        => 'UK-based support with a strong agency reputation',
            'Uptime SLA'     => '100% uptime guarantee with credits',
        ],
        'performance' => 'Strong within the United Kingdom and Europe. LiteSpeed on NVMe in UK data centres with good local peering gives fast responses to British visitors, and the Katapult cloud platform provides dedicated resources when a site outgrows shared. There is no global edge network included, so an international audience needs a CDN added.',
        'security' => [
            'Free daily backups with self-service restore',
            'Free SSL with automatic installation and renewal',
            'UK data residency with GDPR-aligned contracts',
            'Server-level firewall, malware scanning and DDoS mitigation',
            'Two-factor authentication on the control panel',
            'A 100% uptime guarantee backed by credits',
        ],
        'pricing_notes' => [
            'Priced above budget commodity hosting — you pay for UK infrastructure and B Corp practices.',
            'No aggressive renewal cliff; pricing is comparatively honest.',
            'Prices are in pounds sterling with UK VAT handling.',
            'A 60-day money-back guarantee applies, unusually long.',
        ],
        'migration' => 'Free migrations performed by the United Kingdom team, including bulk moves for agencies transferring client portfolios. Staging environments let you validate before switching DNS.',
        'not_for' => [
            'Buyers looking for the cheapest possible hosting',
            'Audiences far outside Europe without a CDN',
            'Anyone needing cPanel specifically on shared plans',
            'Enterprise workloads needing multi-region architecture',
        ],
        'verdict' => 'The ethical choice in British hosting that also happens to be technically good: B Corp certified, renewable powered, NVMe and LiteSpeed, UK support and a 60-day guarantee. Worth the premium if your audience is British and your values are part of the purchase.',
    ],

    'xneelo' => [
        'overview' => 'xneelo, formerly Hetzner South Africa, is the largest hosting provider on the African continent, founded in Cape Town in 1996. It separated from the German Hetzner brand in 2017 and rebranded, but it retained the engineering culture and the owned data centre infrastructure in Cape Town and Johannesburg that made it dominant in the South African market.

Local infrastructure is the entire point. A South African site hosted in Europe pays roughly 160 to 200 milliseconds on every request, and international bandwidth in the region is expensive. xneelo eliminates both, with local peering into the major South African internet exchanges, rand billing, and support staff in local time zones and languages.

The product range covers shared hosting, managed WordPress, VPS, dedicated servers and domain registration including .co.za, which xneelo has registered at scale for decades. The platform is conservative and stable rather than innovative, and reliability is what the company sells.',
        'company' => [
            'Ownership'    => 'Privately held, South African owned since the 2017 separation',
            'Headquarters' => 'Cape Town, South Africa',
            'Founded'      => '1996, as Hetzner South Africa until 2017',
            'Scale'        => 'The largest hosting provider in Africa by customer base',
            'Facilities'   => 'Owned data centres in Cape Town and Johannesburg',
        ],
        'timeline' => [
            ['year' => 1996, 'event' => 'Founded in Cape Town as a South African hosting provider.'],
            ['year' => 2000, 'event' => 'Becomes a major .co.za registrar and grows the local hosting market.'],
            ['year' => 2012, 'event' => 'Opens a second owned data centre in Johannesburg.'],
            ['year' => 2017, 'event' => 'Separates from the German Hetzner brand and rebrands as xneelo.'],
            ['year' => 2021, 'event' => 'Modernises the platform with SSD storage and updated control panels.'],
        ],
        'hosting_types' => [
            ['name' => 'Web hosting',       'from' => '$4.50/mo', 'note' => 'Shared plans with local data centre placement and email.'],
            ['name' => 'WordPress hosting', 'from' => '$6/mo',    'note' => 'Managed WordPress with automatic updates.'],
            ['name' => 'VPS hosting',       'from' => '$15/mo',   'note' => 'Virtual servers in South African facilities with root access.'],
            ['name' => 'Dedicated servers', 'from' => '$99/mo',   'note' => 'Bare metal in owned Cape Town and Johannesburg data centres.'],
            ['name' => 'Domains',           'from' => 'Varies',   'note' => 'Large .co.za and international domain registration business.'],
        ],
        'specs' => [
            'Control panel'  => 'konsoleH, xneelo\'s own control panel',
            'Data residency' => 'South African data centres owned and operated by xneelo',
            'Peering'        => 'Direct peering into major South African internet exchanges',
            'Storage'        => 'SSD across current plans',
            'Email'          => 'Mailboxes included with hosting, a significant local product',
            'Backups'        => 'Regular backups with restore on request',
            'Billing'        => 'South African rand billing with local payment methods',
            'Support'        => 'Local-language support in South African business hours',
            'Domains'        => 'Accredited .co.za registrar at scale',
            'Uptime SLA'     => '99.9% target',
        ],
        'performance' => 'For a South African audience this is as fast as hosting gets, because the origin is in-country and peered directly with local networks. The difference against a European or American host is 150 milliseconds or more on every uncached request, which dwarfs any stack optimisation. Outside southern Africa the geography works against you.',
        'security' => [
            'South African data residency for organisations with local requirements',
            'Owned data centres with physical access control',
            'Free SSL on current hosting plans',
            'Server-level firewall and malware protection',
            'Regular backups with restore assistance',
        ],
        'pricing_notes' => [
            'Pricing is in South African rand with local payment methods and no foreign exchange fees.',
            'Rates are higher than international commodity hosting, reflecting local bandwidth costs.',
            'Renewal pricing is comparatively stable rather than sharply increasing.',
            'Refund terms follow South African consumer law.',
        ],
        'migration' => 'Migration assistance is available through local support, including transfers from international hosts. The team works in South African business hours, which makes coordinating a cutover practical.',
        'not_for' => [
            'Audiences outside southern Africa',
            'Buyers wanting the newest stack features such as LiteSpeed and edge caching',
            'Developers wanting Git workflows and modern staging',
            'Anyone seeking the lowest international price',
        ],
        'verdict' => 'The default and correct answer for a South African business: local data centres, local peering, rand billing and local support from a company that has been doing it since 1996. Buy it for the geography, which matters far more here than anywhere else.',
    ],

    'aws' => [
        'overview' => 'Amazon Web Services is the largest cloud platform in the world, with roughly a third of global market share, over thirty-four geographic regions, more than a hundred availability zones and a catalogue of over two hundred services. It effectively invented the public cloud in 2006 with S3 and EC2, and it remains the default choice for enterprises, startups with venture funding, and anyone whose architecture needs a service that does not exist anywhere else.

For hosting a website specifically, AWS is powerful and indirect. There is no cPanel, no email hosting in the traditional sense, and no one-click WordPress that a beginner would recognise. What there is: EC2 virtual machines, Lightsail for simple fixed-price instances, S3 with CloudFront for static sites, RDS for managed databases, Elastic Beanstalk and App Runner for application deployment, and Amplify for modern front ends.

The two things to understand before committing are cost and complexity. AWS pricing is usage-based across dozens of dimensions, egress bandwidth is expensive, and a misconfigured resource can generate a large bill silently. The learning curve is real, and the certification industry that surrounds AWS exists because of it.',
        'company' => [
            'Ownership'    => 'Amazon.com, publicly traded (NASDAQ: AMZN)',
            'Headquarters' => 'Seattle, Washington, United States',
            'Founded'      => '2006',
            'Scale'        => '34+ regions, 108+ availability zones, ~31% global cloud market share',
            'Notable'      => 'The service that created the modern public cloud market',
        ],
        'timeline' => [
            ['year' => 2006, 'event' => 'Launches S3 and EC2, creating the modern public cloud.'],
            ['year' => 2009, 'event' => 'Introduces RDS managed databases and CloudFront CDN.'],
            ['year' => 2014, 'event' => 'Launches Lambda, popularising serverless computing.'],
            ['year' => 2016, 'event' => 'Introduces Lightsail, a simplified fixed-price VPS product.'],
            ['year' => 2021, 'event' => 'Passes $60 billion in annual revenue, the largest cloud business in the world.'],
        ],
        'hosting_types' => [
            ['name' => 'Lightsail',          'from' => '$3.50/mo', 'note' => 'Fixed-price virtual servers with bundled bandwidth, the simplest entry point.'],
            ['name' => 'EC2',                'from' => 'Usage',    'note' => 'Full virtual machines with hundreds of instance types.'],
            ['name' => 'S3 + CloudFront',    'from' => 'Usage',    'note' => 'Static site hosting served from a global CDN.'],
            ['name' => 'Amplify',            'from' => 'Usage',    'note' => 'Git-based deployment for modern front-end frameworks.'],
            ['name' => 'RDS / Aurora',       'from' => 'Usage',    'note' => 'Managed relational databases with automatic failover.'],
            ['name' => 'Elastic Beanstalk',  'from' => 'Usage',    'note' => 'Managed application deployment on EC2 without managing servers directly.'],
        ],
        'specs' => [
            'Control panel'  => 'AWS Management Console, CLI, SDKs, CloudFormation and Terraform',
            'Regions'        => '34+ geographic regions and 108+ availability zones worldwide',
            'Service count'  => 'Over 200 services spanning compute, storage, data, AI and networking',
            'Storage'        => 'EBS block storage, S3 object storage, EFS shared file systems',
            'Networking'     => 'VPC, Route 53 DNS, CloudFront CDN, Global Accelerator, Direct Connect',
            'Compliance'     => 'Effectively every major certification: SOC, ISO, PCI DSS, HIPAA, FedRAMP, IRAP',
            'Free tier'      => '12-month free tier plus always-free allowances on many services',
            'Support'        => 'Basic free, with Developer, Business and Enterprise tiers priced as a percentage of spend',
            'Marketplace'    => 'Thousands of third-party machine images and SaaS integrations',
            'Uptime SLA'     => '99.99% on most compute services with service credits',
        ],
        'performance' => 'Exceptional, if you configure it well. The region and availability zone footprint is the largest in the industry, CloudFront is one of the strongest CDNs, and instance types exist for every workload shape from burstable micro instances to bare-metal machines with hundreds of cores. Performance problems on AWS are almost always architecture problems rather than platform limits. Lightsail, the simplified product, is competent but noticeably less flexible than EC2.',
        'security' => [
            'Identity and Access Management with fine-grained, policy-based permissions',
            'Shield Standard DDoS protection free, Shield Advanced for large-scale attacks',
            'WAF, GuardDuty threat detection, Inspector vulnerability scanning and Security Hub',
            'Encryption at rest and in transit with KMS-managed keys',
            'The broadest compliance portfolio in the industry including FedRAMP and HIPAA',
            'A shared responsibility model: AWS secures the cloud, you secure what you run in it',
        ],
        'pricing_notes' => [
            'Usage-based across many dimensions — compute, storage, requests, egress and more.',
            'Egress bandwidth is expensive and is the most common source of bill surprises.',
            'Reserved Instances and Savings Plans cut compute costs substantially for steady workloads.',
            'Set billing alarms on day one; a misconfigured resource can run up costs unnoticed.',
        ],
        'migration' => 'AWS provides extensive migration tooling including Application Migration Service, Database Migration Service and the Migration Hub, plus a large partner ecosystem. For a single website this is overkill; for an enterprise estate it is the most complete toolset available.',
        'not_for' => [
            'Simple websites where a managed host would cost less and take an hour to set up',
            'Anyone without cloud engineering skills or budget to hire them',
            'Cost-sensitive workloads with heavy outbound bandwidth',
            'Buyers who want predictable flat monthly pricing',
        ],
        'verdict' => 'The right platform when your requirements exceed what a managed host can do, and the wrong one when they do not. For a WordPress site, Lightsail or a managed host is the sensible path. For anything that needs to scale, integrate and comply at enterprise level, nothing else has the breadth.',
    ],

    'azure' => [
        'overview' => 'Microsoft Azure is the second-largest cloud platform and the default choice for organisations already invested in Microsoft technology. If your company runs Active Directory, Microsoft 365, SQL Server, .NET applications or Windows Server, Azure is the platform where those things work with the least friction and the most favourable licensing, and that integration advantage is the principal reason enterprises choose it over AWS.

For web hosting, the relevant services are App Service, a fully managed platform for .NET, Node, Python, PHP and Java applications with deployment slots and autoscaling built in; Virtual Machines for full control; Static Web Apps for Jamstack front ends; and Azure SQL or Database for MySQL and PostgreSQL on the data side. App Service in particular is one of the better managed application platforms in the market and is often underrated.

Azure covers more geographic regions than any competitor, which matters for data residency requirements, and it has the deepest hybrid cloud story through Azure Arc and Azure Stack. Pricing is complex, Windows licensing can be favourable through existing agreements, and the portal has a steeper learning curve than its rivals.',
        'company' => [
            'Ownership'    => 'Microsoft Corporation, publicly traded (NASDAQ: MSFT)',
            'Headquarters' => 'Redmond, Washington, United States',
            'Founded'      => '2010 (announced 2008 as Windows Azure)',
            'Scale'        => '60+ announced regions, more than any other cloud provider',
            'Notable'      => 'Deepest integration with Microsoft 365, Active Directory and Windows Server',
        ],
        'timeline' => [
            ['year' => 2008, 'event' => 'Announced as Windows Azure at Microsoft PDC.'],
            ['year' => 2010, 'event' => 'Commercially launched.'],
            ['year' => 2014, 'event' => 'Renamed Microsoft Azure and broadens beyond Windows workloads.'],
            ['year' => 2019, 'event' => 'Launches Azure Arc for hybrid and multi-cloud management.'],
            ['year' => 2023, 'event' => 'Becomes the primary cloud for OpenAI workloads, driving AI service growth.'],
        ],
        'hosting_types' => [
            ['name' => 'App Service',        'from' => 'Free tier', 'note' => 'Managed web app hosting for .NET, Node, Python, PHP and Java.'],
            ['name' => 'Virtual Machines',   'from' => 'Usage',     'note' => 'Full Linux and Windows VMs across every region.'],
            ['name' => 'Static Web Apps',    'from' => 'Free tier', 'note' => 'Git-based deployment for front-end frameworks with serverless APIs.'],
            ['name' => 'Azure SQL',          'from' => 'Usage',     'note' => 'Managed SQL Server with automatic tuning and failover.'],
            ['name' => 'Container Apps / AKS','from' => 'Usage',    'note' => 'Serverless containers and managed Kubernetes.'],
        ],
        'specs' => [
            'Control panel'  => 'Azure Portal, CLI, PowerShell, ARM and Bicep templates, Terraform',
            'Regions'        => '60+ announced regions worldwide, the broadest geographic coverage',
            'Identity'       => 'Microsoft Entra ID (formerly Azure AD) integration for enterprise single sign-on',
            'Hybrid'         => 'Azure Arc and Azure Stack for on-premises and multi-cloud management',
            'Licensing'      => 'Azure Hybrid Benefit reuses existing Windows Server and SQL licences',
            'Storage'        => 'Blob, Files, Disks and Data Lake storage tiers',
            'Compliance'     => 'The largest compliance portfolio alongside AWS, including FedRAMP High and government clouds',
            'Free tier'      => '12 months of free services plus always-free tiers and a starting credit',
            'Support'        => 'Basic free, with Developer, Standard, Professional Direct and Premier tiers',
            'Uptime SLA'     => 'Up to 99.99% on App Service and VMs in availability zones',
        ],
        'performance' => 'Strong and globally consistent, with the widest region footprint of any provider and a well-peered backbone. App Service is genuinely good for managed application hosting, with deployment slots that make zero-downtime releases straightforward. Windows workloads run better here than anywhere else. The main performance trap is undersizing App Service plans, where cold starts and CPU throttling on the lower tiers surprise people.',
        'security' => [
            'Microsoft Entra ID for enterprise identity, conditional access and single sign-on',
            'Microsoft Defender for Cloud providing posture management and threat detection',
            'DDoS Protection Basic free, Standard for enterprise-grade mitigation',
            'Key Vault for secrets, certificates and encryption key management',
            'FedRAMP High, HIPAA, PCI DSS, ISO 27001 and dedicated government cloud regions',
            'Shared responsibility model applies as with every hyperscaler',
        ],
        'pricing_notes' => [
            'Complex usage-based pricing; the calculator is essential before committing.',
            'Azure Hybrid Benefit can substantially reduce costs if you already own Windows or SQL licences.',
            'Reserved instances and savings plans cut steady-state compute costs meaningfully.',
            'Enterprise agreements negotiate discounts at volume — list price is rarely what large customers pay.',
        ],
        'migration' => 'Azure Migrate provides assessment and migration tooling for servers, databases and applications, with strong support for moving Windows Server and SQL Server estates. Microsoft partner networks handle large migrations, and the tooling is the most mature for Microsoft-stack workloads.',
        'not_for' => [
            'Simple websites, where a managed host is cheaper and faster to set up',
            'Small teams without cloud engineering capacity',
            'Organisations with no Microsoft technology footprint, where the integration advantage disappears',
            'Buyers wanting simple flat pricing',
        ],
        'verdict' => 'The obvious cloud if your organisation already runs on Microsoft: identity, licensing and tooling all line up in a way no competitor matches. App Service is an underrated managed platform for web applications. For a plain website with no Microsoft ties, it is more platform than you need.',
    ],

    'gcp' => [
        'overview' => 'Google Cloud Platform is the third-largest public cloud and the one with the strongest technical story in three specific areas: networking, data analytics and Kubernetes. The network is Google\'s own global backbone, the same fibre that serves Search and YouTube, and premium-tier routing keeps traffic on it from end to end rather than handing off to the public internet early. BigQuery remains the benchmark serverless data warehouse. And Kubernetes was invented at Google, which shows in how good GKE is.

For web hosting, the relevant products are Compute Engine virtual machines, Cloud Run for containerised applications billed per request, App Engine for managed application hosting, Cloud Storage with Cloud CDN for static content, and Cloud SQL for managed databases. Cloud Run in particular is one of the best serverless container platforms available and is a genuinely good fit for modern web applications.

Google Cloud is also the infrastructure underneath a number of the managed WordPress hosts in this directory, including SiteGround and Kinsta, which is a meaningful endorsement of the platform for web workloads. Pricing is usage-based with sustained-use discounts applied automatically.',
        'company' => [
            'Ownership'    => 'Alphabet Inc., publicly traded (NASDAQ: GOOGL)',
            'Headquarters' => 'Mountain View, California, United States',
            'Founded'      => '2008 (App Engine), Compute Engine in 2012',
            'Scale'        => '40+ regions and 121+ zones on Google\'s own global network',
            'Notable'      => 'Underpins several major managed WordPress hosts including Kinsta and SiteGround',
        ],
        'timeline' => [
            ['year' => 2008, 'event' => 'Launches App Engine, an early managed application platform.'],
            ['year' => 2012, 'event' => 'Launches Compute Engine, entering infrastructure as a service.'],
            ['year' => 2014, 'event' => 'Open-sources Kubernetes, which becomes the industry container standard.'],
            ['year' => 2019, 'event' => 'Launches Cloud Run, serverless containers billed per request.'],
            ['year' => 2023, 'event' => 'Expands AI infrastructure with TPU availability and Vertex AI.'],
        ],
        'hosting_types' => [
            ['name' => 'Compute Engine',   'from' => '$4.28/mo',  'note' => 'Virtual machines including cheap e2-micro shared-core instances.'],
            ['name' => 'Cloud Run',        'from' => 'Per request','note' => 'Serverless containers that scale to zero, excellent for web apps.'],
            ['name' => 'App Engine',       'from' => 'Usage',     'note' => 'Fully managed application platform with automatic scaling.'],
            ['name' => 'Cloud Storage + CDN','from' => 'Usage',   'note' => 'Static site hosting served from Google\'s edge network.'],
            ['name' => 'Cloud SQL',        'from' => 'Usage',     'note' => 'Managed MySQL, PostgreSQL and SQL Server.'],
            ['name' => 'GKE',              'from' => 'Usage',     'note' => 'Managed Kubernetes from the team that created it.'],
        ],
        'specs' => [
            'Control panel'  => 'Cloud Console, gcloud CLI, Deployment Manager and Terraform',
            'Network'        => 'Google\'s private global backbone with premium-tier routing',
            'Regions'        => '40+ regions and 121+ zones worldwide',
            'Storage'        => 'Persistent Disk, Local SSD, Filestore and Cloud Storage classes',
            'Discounts'      => 'Sustained-use discounts applied automatically, plus committed-use contracts',
            'Data platform'  => 'BigQuery, Dataflow and Looker, the strongest analytics stack of the three hyperscalers',
            'Kubernetes'     => 'GKE, widely considered the best managed Kubernetes',
            'Free tier'      => 'Always-free tier including an e2-micro instance, plus a starting credit',
            'Compliance'     => 'SOC, ISO 27001, PCI DSS, HIPAA, FedRAMP and regional certifications',
            'Support'        => 'Basic free, with Standard, Enhanced and Premium paid tiers',
            'Uptime SLA'     => '99.99% on regional compute configurations',
        ],
        'performance' => 'The network is the differentiator. Premium-tier routing keeps packets on Google fibre from the edge nearest the user all the way to the region, which measurably reduces latency and jitter compared with standard internet transit. That is precisely why managed WordPress hosts building for speed choose Google Cloud as their substrate. Compute performance is competitive across instance families, and Cloud Run cold starts are among the fastest in serverless.',
        'security' => [
            'Identity and Access Management with fine-grained, resource-level policies',
            'Cloud Armor web application firewall and DDoS protection at the edge',
            'Confidential Computing with encrypted memory on supported instance types',
            'Encryption at rest by default with customer-managed key options',
            'Security Command Center for posture management and threat detection',
            'SOC, ISO, PCI DSS, HIPAA and FedRAMP compliance coverage',
        ],
        'pricing_notes' => [
            'Sustained-use discounts apply automatically without any commitment, unlike AWS Reserved Instances.',
            'Committed-use contracts give deeper discounts for predictable workloads.',
            'Egress is billed and, as with all hyperscalers, is a common source of bill surprises.',
            'The always-free tier includes a small Compute Engine instance indefinitely.',
        ],
        'migration' => 'Migrate to Virtual Machines handles server lifts, Database Migration Service moves live databases, and Transfer Service handles bulk storage. Partner and professional services support large migrations. For a single site, this tooling is far more than required.',
        'not_for' => [
            'Simple websites that a managed host would handle for a fraction of the effort',
            'Teams without cloud engineering skills',
            'Buyers wanting predictable flat monthly billing',
            'Windows-heavy estates, which fit Azure better',
        ],
        'verdict' => 'The best network and the best Kubernetes of the three hyperscalers, and the substrate that several premium WordPress hosts build on for good reason. Cloud Run is an excellent, underused option for modern web applications. Overkill for a brochure site.',
    ],

    'vercel' => [
        'overview' => 'Vercel is the company behind Next.js, the most widely used React framework, and its hosting platform is built to run Next.js better than anywhere else. Push to a Git branch and Vercel builds the project, deploys it to a global edge network, and gives you a unique preview URL for that branch — a workflow that has become the expected standard for front-end teams and that Vercel largely invented.

The platform handles static generation, incremental static regeneration, server-side rendering, edge functions running close to the user, serverless functions, image optimisation, analytics and web vitals monitoring. For a React, Next.js, SvelteKit, Nuxt or Astro project, the developer experience is close to frictionless and the free tier is genuinely usable for personal projects.

The considerations are cost at scale and lock-in. Usage-based pricing on bandwidth, function invocations and build minutes can escalate sharply for a site that becomes popular, and several Next.js features work best or only on Vercel. There is no database, no traditional server and no PHP, so this is a platform for modern JavaScript applications rather than a general web host.',
        'company' => [
            'Ownership'    => 'Privately held, venture backed',
            'Headquarters' => 'San Francisco, California, United States',
            'Founded'      => '2015 as ZEIT, renamed Vercel in 2020',
            'Scale'        => 'Millions of deployments, creator and maintainer of Next.js',
            'Notable'      => 'Defined the Git-push preview deployment workflow for front-end teams',
        ],
        'timeline' => [
            ['year' => 2015, 'event' => 'Founded as ZEIT by Guillermo Rauch.'],
            ['year' => 2016, 'event' => 'Releases Next.js, which becomes the dominant React framework.'],
            ['year' => 2020, 'event' => 'Rebrands to Vercel and focuses on the front-end cloud.'],
            ['year' => 2022, 'event' => 'Launches Edge Functions and Edge Middleware running at the network edge.'],
            ['year' => 2023, 'event' => 'Adds Vercel Storage products including Postgres, KV and Blob.'],
        ],
        'hosting_types' => [
            ['name' => 'Hobby',        'from' => 'Free',     'note' => 'Personal projects with generous limits and no credit card.'],
            ['name' => 'Pro',          'from' => '$20/user', 'note' => 'Teams, with usage-based billing above included allowances.'],
            ['name' => 'Enterprise',   'from' => 'Custom',    'note' => 'SLAs, SSO, dedicated support and isolated infrastructure.'],
            ['name' => 'Vercel Storage','from' => 'Usage',   'note' => 'Serverless Postgres, key-value store and blob storage.'],
        ],
        'specs' => [
            'Deployment'     => 'Git-push deploys from GitHub, GitLab and Bitbucket with automatic builds',
            'Preview URLs'   => 'Every branch and pull request gets its own deployed preview environment',
            'Frameworks'     => 'Next.js, React, Svelte, Nuxt, Astro, Remix, Vue and 35+ more',
            'Edge network'   => 'Global edge with edge functions and middleware running near the user',
            'Rendering'      => 'Static generation, incremental static regeneration, SSR and streaming',
            'Image optimisation' => 'Automatic resizing, format conversion and caching',
            'Analytics'      => 'Real-user web vitals monitoring and traffic analytics',
            'Storage'        => 'Serverless Postgres, KV, Blob and Edge Config',
            'Rollbacks'      => 'Instant rollback to any previous deployment',
            'Support'        => 'Community on free, email on Pro, dedicated on Enterprise',
            'Uptime SLA'     => '99.99% on Enterprise plans',
        ],
        'performance' => 'Excellent for the workloads it targets. Static and incrementally regenerated pages are served from the edge worldwide with very low latency, and edge middleware lets you run logic such as authentication checks or A/B routing without a round trip to an origin. Server-rendered pages depend on serverless function cold starts, which Vercel has optimised heavily but which still exist. For a content-heavy Next.js site, the numbers are as good as anything available.',
        'security' => [
            'Automatic HTTPS with managed certificates on every domain and preview URL',
            'DDoS mitigation and a web application firewall at the edge',
            'Environment variable encryption and per-environment secrets',
            'SAML single sign-on and audit logs on Enterprise plans',
            'SOC 2 Type 2 compliance and GDPR data processing agreements',
            'Deployment protection with password or SSO gating on preview environments',
        ],
        'pricing_notes' => [
            'The Hobby tier is free and genuinely usable for personal projects.',
            'Pro is per-seat plus usage; bandwidth and function invocation overage can escalate quickly.',
            'Set spend limits and monitor usage — viral traffic on a Pro plan has produced large bills.',
            'Enterprise pricing is negotiated and includes committed usage.',
        ],
        'migration' => 'Connect a Git repository and deploy — there is no migration service because there is nothing to migrate in the traditional sense. Moving off Vercel is harder than moving on, because some Next.js features have Vercel-specific implementations.',
        'not_for' => [
            'WordPress, PHP or any traditional server application',
            'Projects needing a persistent server or long-running processes',
            'High-bandwidth sites where usage-based pricing becomes expensive',
            'Teams wanting to avoid platform-specific framework features',
        ],
        'verdict' => 'The best place to run a Next.js application and the reference implementation for modern front-end deployment workflows. Start free, watch the usage meters as you grow, and go in aware that some of the convenience comes with platform-specific dependencies.',
    ],

    'netlify' => [
        'overview' => 'Netlify coined the term Jamstack and built the platform that popularised it: connect a Git repository, let Netlify run the build, and have the result deployed to a global edge network as static assets with serverless functions handling anything dynamic. Founded in 2014, it made continuous deployment for front-end projects something you configure once and then forget about.

The platform is framework-agnostic in a way its closest competitor is not. React, Vue, Svelte, Astro, Hugo, Eleventy, Jekyll and Gatsby all work equally well, and Netlify has no framework of its own to favour. Around the deployments sit a set of genuinely useful services: Netlify Forms for form handling without a backend, Identity for authentication, Edge Functions built on Deno, split testing, and deploy previews on every pull request.

The trade-offs are the same as the category: usage-based billing on bandwidth and build minutes that can escalate, no database, no persistent server and no PHP. For a documentation site, marketing site, blog or front-end application, the free tier is generous and the workflow is excellent.',
        'company' => [
            'Ownership'    => 'Privately held, venture backed',
            'Headquarters' => 'San Francisco, California, United States',
            'Founded'      => '2014 by Mathias Biilmann and Chris Bach',
            'Scale'        => 'Millions of developers and websites deployed',
            'Notable'      => 'Coined and popularised the Jamstack architecture',
        ],
        'timeline' => [
            ['year' => 2014, 'event' => 'Founded as BitBalloon, later renamed Netlify.'],
            ['year' => 2016, 'event' => 'Coins the term Jamstack and defines the category.'],
            ['year' => 2018, 'event' => 'Launches Netlify Functions, bringing serverless to the platform.'],
            ['year' => 2021, 'event' => 'Introduces Edge Functions built on Deno.'],
            ['year' => 2023, 'event' => 'Acquires Gatsby, consolidating Jamstack tooling.'],
        ],
        'hosting_types' => [
            ['name' => 'Starter',      'from' => 'Free',     'note' => 'Personal projects with 100GB bandwidth and 300 build minutes monthly.'],
            ['name' => 'Pro',          'from' => '$19/user', 'note' => 'Teams with higher limits, password protection and analytics.'],
            ['name' => 'Enterprise',   'from' => 'Custom',    'note' => 'SLAs, SSO, dedicated support and compliance controls.'],
            ['name' => 'Add-on services','from' => 'Usage',  'note' => 'Forms, Identity, Large Media and Analytics billed separately.'],
        ],
        'specs' => [
            'Deployment'     => 'Git-push deploys from GitHub, GitLab, Bitbucket and Azure DevOps',
            'Deploy previews'=> 'Every pull request gets a unique preview URL with collaboration comments',
            'Frameworks'     => 'Framework-agnostic — any static site generator or front-end framework',
            'Edge network'   => 'Global CDN with instant cache invalidation on deploy',
            'Functions'      => 'Serverless Functions on AWS Lambda plus Edge Functions on Deno',
            'Forms'          => 'Built-in form handling with spam filtering, no backend required',
            'Identity'       => 'Authentication service with social login providers',
            'Split testing'  => 'Branch-based A/B testing at the edge',
            'Rollbacks'      => 'Atomic deploys with instant rollback to any prior version',
            'Support'        => 'Community on free, email on Pro, dedicated on Enterprise',
            'Uptime SLA'     => '99.99% on Enterprise plans',
        ],
        'performance' => 'Very fast for static content, which is most of what it hosts. Atomic deploys mean the whole site version switches at once with instant cache invalidation across the edge, so there is no partial-deploy inconsistency. Serverless function latency depends on cold starts; Edge Functions on Deno start faster and run closer to the user. For a documentation or marketing site, response times are excellent worldwide with no configuration.',
        'security' => [
            'Automatic HTTPS with managed certificates on all domains and previews',
            'DDoS mitigation at the edge network level',
            'Password protection and role-based access on preview deployments',
            'SAML single sign-on and audit logs on Enterprise plans',
            'SOC 2 Type 2 compliance and GDPR data processing agreements',
            'Environment variable encryption with per-context scoping',
        ],
        'pricing_notes' => [
            'The free Starter tier includes 100GB bandwidth and 300 build minutes per month.',
            'Pro is per-seat plus usage; bandwidth and build-minute overage is billed.',
            'Forms, Identity and Analytics are separately priced add-ons.',
            'Monitor usage on high-traffic sites — bandwidth overage is the usual cost surprise.',
        ],
        'migration' => 'Connect a Git repository and deploy. There is no migration service in the traditional sense. Moving a WordPress site here means converting it to a static or headless architecture first, which is a rebuild rather than a migration.',
        'not_for' => [
            'WordPress, PHP or any server-rendered traditional application',
            'Applications needing a persistent server or long-running processes',
            'Sites with very high bandwidth where usage pricing becomes costly',
            'Teams wanting a bundled database',
        ],
        'verdict' => 'The most framework-neutral of the modern front-end platforms and an excellent home for documentation, marketing sites and Jamstack applications. Generous free tier, superb deploy workflow, and no framework agenda. Not a web host in the traditional sense at all.',
    ],

    'render' => [
        'overview' => 'Render positions itself as the modern replacement for Heroku, and the comparison is fair. It hosts web services, static sites, background workers, cron jobs, private services and managed PostgreSQL and Redis, all from a Git repository, all with automatic deploys, all with a pricing model that is far more predictable than the hyperscalers and cheaper than Heroku.

The distinguishing feature against Vercel and Netlify is that Render runs persistent servers, not just serverless functions. That means Django, Rails, Laravel, Express, FastAPI and any long-running process work natively, with a real filesystem and real background jobs, which the Jamstack platforms cannot offer. Databases are managed and included in the same account rather than being a separate vendor.

The free tier spins services down after inactivity, which makes it useful for demos and hobby projects but not production. Paid plans start around seven dollars a month per service, and costs add up when an application needs a web service, a worker, a database and Redis. Regions are fewer than the major clouds.',
        'company' => [
            'Ownership'    => 'Privately held, venture backed',
            'Headquarters' => 'San Francisco, California, United States',
            'Founded'      => '2019 by Anurag Goel',
            'Scale'        => 'Hundreds of thousands of developers and services',
            'Notable'      => 'The most commonly recommended Heroku replacement',
        ],
        'timeline' => [
            ['year' => 2019, 'event' => 'Founded as a unified cloud for developers.'],
            ['year' => 2020, 'event' => 'Adds managed PostgreSQL and Redis.'],
            ['year' => 2022, 'event' => 'Grows rapidly as Heroku retires its free tier.'],
            ['year' => 2023, 'event' => 'Adds private networking, autoscaling and more regions.'],
            ['year' => 2024, 'event' => 'Expands enterprise features including SOC 2 compliance and dedicated infrastructure.'],
        ],
        'hosting_types' => [
            ['name' => 'Static sites',      'from' => 'Free',    'note' => 'Unlimited static sites with global CDN and automatic HTTPS.'],
            ['name' => 'Web services',      'from' => '$7/mo',   'note' => 'Persistent servers for any language or framework, deployed from Git.'],
            ['name' => 'Background workers','from' => '$7/mo',   'note' => 'Long-running job processors without a public endpoint.'],
            ['name' => 'Cron jobs',         'from' => '$1/mo',   'note' => 'Scheduled tasks with logging and failure alerts.'],
            ['name' => 'Managed PostgreSQL','from' => '$7/mo',   'note' => 'Managed database with daily backups and point-in-time recovery.'],
            ['name' => 'Managed Redis',     'from' => 'Free tier','note' => 'Managed key-value store for caching and queues.'],
        ],
        'specs' => [
            'Deployment'     => 'Git-push deploys from GitHub and GitLab with automatic builds',
            'Runtimes'       => 'Node, Python, Ruby, Go, Rust, Elixir, PHP, Docker and any custom image',
            'Persistent servers' => 'Real long-running processes with a filesystem, unlike serverless platforms',
            'Databases'      => 'Managed PostgreSQL with point-in-time recovery, plus managed Redis',
            'Preview environments' => 'Pull request previews including database branching on higher plans',
            'Autoscaling'    => 'Horizontal autoscaling on paid instance types',
            'Private networking' => 'Services communicate over a private network at no cost',
            'Infrastructure as code' => 'render.yaml blueprints define an entire environment',
            'Regions'        => 'Oregon, Ohio, Virginia, Frankfurt and Singapore',
            'Support'        => 'Community and email, with priority tiers on paid plans',
            'Uptime SLA'     => '99.95% on paid plans',
        ],
        'performance' => 'Good for application workloads. Persistent servers avoid the cold-start penalty that serverless platforms carry, static sites are served from a global CDN, and managed databases sit in the same region as your services with private networking between them. The region list is short compared with a hyperscaler, so a globally distributed audience needs a CDN in front or a different platform.',
        'security' => [
            'Automatic HTTPS with managed certificates on every service',
            'Private networking between services with no public exposure required',
            'DDoS protection at the edge',
            'Environment variable and secret file encryption',
            'SOC 2 Type 2 compliance and GDPR data processing agreements',
            'Automatic security patching of the underlying platform',
        ],
        'pricing_notes' => [
            'The free tier spins services down after inactivity — fine for demos, not for production.',
            'Each service is billed separately, so a full application stack adds up.',
            'Pricing is flat per instance type rather than usage-metered, which makes bills predictable.',
            'Managed PostgreSQL free tier expires after a set period; plan for the paid tier.',
        ],
        'migration' => 'Migrating from Heroku is well documented and straightforward because the deployment model is similar. Docker support means almost any containerised application moves with little change. There is no managed migration service.',
        'not_for' => [
            'WordPress and traditional PHP hosting with cPanel expectations',
            'Applications needing many global regions',
            'Teams wanting the deepest managed service catalogue',
            'Cost-sensitive stacks with many separate services',
        ],
        'verdict' => 'The best Heroku replacement and a genuinely pleasant platform for deploying real applications with real databases and background jobs. Predictable flat pricing, persistent servers and a good developer experience. Use a paid instance for anything production.',
    ],

    'scaleway' => [
        'overview' => 'Scaleway is a French cloud provider, part of the Iliad group that also owns the telecoms operator Free, and it has been building developer-focused infrastructure since 2013. It is best known for two things: aggressive pricing on small instances, including a long-running range of ARM-based servers, and a genuine commitment to European data sovereignty with facilities in Paris, Amsterdam and Warsaw.

The catalogue covers virtual instances, bare metal, managed Kubernetes, managed PostgreSQL and MySQL, S3-compatible object storage, serverless containers and functions, and an IoT hub. The console and API are well-designed, the Terraform provider is solid, and documentation is good in both French and English.

Scaleway is also unusually serious about sustainability: its DC5 data centre near Paris uses adiabatic cooling with no air conditioning, achieving a power usage effectiveness figure among the best in Europe. For a European team that wants hyperscaler-style services without American ownership and without hyperscaler pricing, it is one of the strongest options.',
        'company' => [
            'Ownership'    => 'Iliad Group, the French telecoms company behind Free',
            'Headquarters' => 'Paris, France',
            'Founded'      => '2013, with roots in Online.net dating to 1999',
            'Scale'        => 'Data centres in France, the Netherlands and Poland',
            'Sustainability' => 'DC5 uses adiabatic cooling with no air conditioning, among Europe\'s most efficient',
        ],
        'timeline' => [
            ['year' => 1999, 'event' => 'Predecessor Online.net founded as a French hosting provider.'],
            ['year' => 2013, 'event' => 'Scaleway launched with ARM-based bare metal servers.'],
            ['year' => 2018, 'event' => 'Opens DC5, an adiabatically cooled data centre with exceptional energy efficiency.'],
            ['year' => 2021, 'event' => 'Expands managed Kubernetes, databases and serverless products.'],
            ['year' => 2023, 'event' => 'Adds GPU instances and positions as a European sovereign cloud alternative.'],
        ],
        'hosting_types' => [
            ['name' => 'Instances',         'from' => '$4.35/mo', 'note' => 'Development, general purpose and cost-optimised virtual machines.'],
            ['name' => 'Elastic Metal',     'from' => '$40/mo',   'note' => 'Bare metal servers provisioned in minutes.'],
            ['name' => 'Kubernetes Kapsule','from' => 'Usage',    'note' => 'Managed Kubernetes with a free control plane.'],
            ['name' => 'Managed databases', 'from' => 'Usage',    'note' => 'PostgreSQL, MySQL and Redis with automatic backups.'],
            ['name' => 'Object storage',    'from' => 'Usage',    'note' => 'S3-compatible storage with a generous free tier.'],
            ['name' => 'Serverless',        'from' => 'Usage',    'note' => 'Containers and functions billed per invocation.'],
        ],
        'specs' => [
            'Control panel'  => 'Scaleway console, CLI, API and Terraform provider',
            'Data residency' => 'France, Netherlands and Poland — European owned and operated',
            'Architectures'  => 'x86 and ARM instances, plus GPU options',
            'Storage'        => 'Local NVMe, block storage and S3-compatible object storage',
            'Networking'     => 'Private networks, load balancers, public gateways and IPv6',
            'Sovereignty'    => 'French owned, outside United States CLOUD Act jurisdiction',
            'Sustainability' => 'Adiabatic cooling and renewable energy in French facilities',
            'Compliance'     => 'ISO 27001, SOC 2, HDS health data hosting and GDPR by design',
            'Free tier'      => 'Free allowances on object storage and some serverless products',
            'Support'        => 'Free basic support with paid advanced and business tiers',
            'Uptime SLA'     => '99.9% to 99.99% depending on product',
        ],
        'performance' => 'Competitive across the range, with good European latency from well-peered facilities backed by Iliad\'s own network. Cost-optimised instances are cheap and adequate; general purpose instances with dedicated resources are consistent. Elastic Metal bare metal provisioning in minutes is a genuine advantage over traditional dedicated server ordering. Coverage outside Europe is minimal, so this is a European platform.',
        'security' => [
            'European data sovereignty with no United States CLOUD Act exposure',
            'Private networks and security groups included at no cost',
            'ISO 27001, SOC 2 and HDS health data certifications',
            'DDoS protection included at the network level',
            'Identity and access management with project-scoped permissions',
            'Operating system hardening remains the customer\'s responsibility',
        ],
        'pricing_notes' => [
            'Pricing is published, hourly-billed and generally below the hyperscalers.',
            'Egress within Europe is comparatively cheap; check rates for high-bandwidth workloads.',
            'Free tiers exist on object storage and serverless products.',
            'No money-back guarantee, but hourly billing makes testing inexpensive.',
        ],
        'migration' => 'Self-service, with image import and snapshot tooling. Professional services are available for enterprise customers. There is no managed website migration service.',
        'not_for' => [
            'Audiences outside Europe, given the regional footprint',
            'Anyone wanting managed WordPress, cPanel or email hosting',
            'Non-technical buyers',
            'Workloads needing the service breadth of AWS or Azure',
        ],
        'verdict' => 'The strongest French cloud and a credible sovereign alternative for European teams that want modern managed services without American ownership. Good pricing, genuinely impressive sustainability engineering, and a clean developer experience. European focus is both the strength and the limit.',
    ],

    'strato' => [
        'overview' => 'STRATO is one of Germany\'s largest hosting providers, founded in Berlin in 1997 and owned since 2017 by United Internet, the group behind IONOS. It serves around two million customers and four million domains, almost entirely in the German-speaking market, and its proposition is straightforward: cheap, reliable hosting from German data centres, with German data protection, German support and German invoicing.

The product range covers shared hosting, managed WordPress, VPS, dedicated servers, a website builder, email and the HiDrive cloud storage product that is popular in Germany as a Dropbox alternative. Everything is priced aggressively, with introductory offers that renew at higher rates in the usual pattern.

Technically it is conservative. The control panel is proprietary and functional, the stack is conventional, and there is no LiteSpeed, edge caching or modern developer tooling. What there is, reliably, is German data residency with ISO-certified facilities, TÜV-audited operations, and a company that has been running since the beginning of the commercial web in Germany.',
        'company' => [
            'Ownership'    => 'United Internet AG, the group behind IONOS',
            'Headquarters' => 'Berlin, Germany',
            'Founded'      => '1997',
            'Scale'        => 'Around 2 million customers and 4 million domains',
            'Facilities'   => 'German data centres with TÜV-audited operations',
        ],
        'timeline' => [
            ['year' => 1997, 'event' => 'Founded in Berlin at the start of the German commercial web.'],
            ['year' => 2009, 'event' => 'Launches HiDrive cloud storage, a popular German alternative to Dropbox.'],
            ['year' => 2017, 'event' => 'Acquired by United Internet, joining the IONOS group.'],
            ['year' => 2020, 'event' => 'Modernises hosting plans with SSD storage and updated PHP support.'],
            ['year' => 2023, 'event' => 'Refreshes the website builder and managed WordPress products.'],
        ],
        'hosting_types' => [
            ['name' => 'Web hosting',       'from' => '$1.10/mo', 'note' => 'Shared plans with domains, email and a builder included.'],
            ['name' => 'WordPress hosting', 'from' => '$4/mo',    'note' => 'Managed WordPress with automatic updates.'],
            ['name' => 'VPS',               'from' => '$5/mo',    'note' => 'Virtual servers with root access, Linux or Windows.'],
            ['name' => 'Dedicated servers', 'from' => '$45/mo',   'note' => 'Bare metal in German data centres.'],
            ['name' => 'HiDrive storage',   'from' => '$2/mo',    'note' => 'Cloud storage with German data residency.'],
        ],
        'specs' => [
            'Control panel'  => 'STRATO custom customer panel',
            'Data residency' => 'German data centres with ISO 27001 certification and TÜV audits',
            'Storage'        => 'SSD across current plans',
            'PHP versions'   => 'PHP 7.x and 8.x',
            'Backups'        => 'Included on most hosting plans with restore',
            'Email'          => 'Mailboxes included with hosting plans',
            'Domains'        => 'Large German domain registration business including .de',
            'Extras'         => 'HiDrive cloud storage and a website builder in the same account',
            'Support'        => 'German-language phone and email support',
            'Compliance'     => 'German data protection law, GDPR aligned',
            'Uptime SLA'     => '99.9% target',
        ],
        'performance' => 'Adequate and stable. German data centres give good latency for a German-speaking audience and nothing special for anyone else. The stack is conventional with no caching layer beyond the basics, so expect ordinary shared hosting numbers. STRATO sells reliability and price rather than speed.',
        'security' => [
            'German data residency with ISO 27001 certified, TÜV-audited facilities',
            'Free SSL included on current hosting plans',
            'DDoS protection at the network level',
            'Backups included with restore on most plans',
            'German and EU data protection law compliance',
        ],
        'pricing_notes' => [
            'Very low introductory pricing that renews substantially higher.',
            'Minimum contract terms apply — note the cancellation notice period.',
            'Prices are in euros with German VAT.',
            'Statutory EU withdrawal rights apply to consumer purchases.',
        ],
        'migration' => 'Migration assistance is offered through support with standard transfer tooling. There is no white-glove engineering service.',
        'not_for' => [
            'Audiences outside German-speaking Europe',
            'Developers wanting SSH, Git, staging and modern tooling',
            'Performance-focused buyers',
            'Anyone averse to minimum contract terms and notice periods',
        ],
        'verdict' => 'A cheap, dependable German host for a German audience, with data residency and local support as the main draw. Technically unambitious, commercially conventional. Check the contract term and the renewal rate before buying.',
    ],

    'pantheon' => [
        'overview' => 'Pantheon is a WebOps platform rather than a host, and the distinction matters. It was built in 2010 specifically for Drupal and later WordPress teams that practise proper software development: every site gets three environments — development, test and live — with a defined workflow for moving code up and content down, Git-based deployment, a container-based architecture that scales, and integrated tooling for performance testing and quality checks.

The customers are universities, government agencies, media companies and large agencies running dozens or hundreds of sites where governance, repeatability and team workflow matter more than the monthly price. The multidev feature, which spins up a full environment per feature branch, is the reason many of them choose it.

Pantheon runs on Google Cloud with a global CDN, includes automatic core updates, and provides an Autopilot service that applies updates with automated visual regression testing. It does not host anything other than WordPress and Drupal, there is no cPanel, no email, and the entry price of around thirty-four dollars a month for a single production site puts it out of reach for hobby projects.',
        'company' => [
            'Ownership'    => 'Privately held, venture backed',
            'Headquarters' => 'San Francisco, California, United States',
            'Founded'      => '2010',
            'Scale'        => '300,000+ sites including major universities, agencies and media brands',
            'Notable'      => 'Defined the WebOps category for Drupal and WordPress teams',
        ],
        'timeline' => [
            ['year' => 2010, 'event' => 'Founded as a Drupal platform with a three-environment workflow.'],
            ['year' => 2014, 'event' => 'Adds WordPress support alongside Drupal.'],
            ['year' => 2016, 'event' => 'Launches Multidev, a full environment per feature branch.'],
            ['year' => 2020, 'event' => 'Introduces Autopilot for automated updates with visual regression testing.'],
            ['year' => 2022, 'event' => 'Expands enterprise WebOps tooling and integrations.'],
        ],
        'hosting_types' => [
            ['name' => 'Basic',        'from' => '$34/mo',  'note' => 'One production site with dev, test and live environments.'],
            ['name' => 'Performance',  'from' => '$134/mo', 'note' => 'Higher traffic tiers with more containers and resources.'],
            ['name' => 'Elite',        'from' => 'Custom',   'note' => 'Enterprise scale with dedicated support and SLAs.'],
            ['name' => 'Agency plans', 'from' => 'Custom',   'note' => 'Portfolio management for agencies running many client sites.'],
        ],
        'specs' => [
            'Platforms'      => 'WordPress and Drupal only',
            'Environments'   => 'Dev, test and live on every plan, with a defined promotion workflow',
            'Multidev'       => 'A full environment per feature branch on higher tiers',
            'Deployment'     => 'Git-based with Terminus CLI and a web dashboard',
            'Architecture'   => 'Container-based on Google Cloud with automatic scaling',
            'CDN'            => 'Global CDN included, with Advanced Global CDN available',
            'Caching'        => 'Edge caching plus Redis object caching on higher plans',
            'Autopilot'      => 'Automated updates with visual regression testing before deploy',
            'Backups'        => 'Automated daily backups with on-demand snapshots',
            'Compliance'     => 'SOC 2 Type 2, HIPAA-ready configurations, VPAT accessibility documentation',
            'Uptime SLA'     => '99.9% standard, higher on Elite',
        ],
        'performance' => 'Strong and, importantly, consistent under governance. The container architecture scales containers under load rather than throttling, the global CDN handles cached delivery, and Redis object caching on higher plans keeps dynamic pages quick. Where Pantheon really earns its price is not raw speed but predictable behaviour across environments — what passes in test behaves the same in live.',
        'security' => [
            'Three-environment workflow preventing untested code reaching production',
            'Automated daily backups with on-demand snapshots and restore',
            'SOC 2 Type 2 compliance with HIPAA-ready configurations available',
            'Free SSL via Let\'s Encrypt with automatic renewal, plus custom certificate support',
            'Platform-level WAF and DDoS mitigation through the CDN',
            'Role-based team permissions and single sign-on on enterprise plans',
        ],
        'pricing_notes' => [
            'Entry is around $34 a month for a single production site — not a hobby platform.',
            'Plans are sized by traffic and container resources with overage on high tiers.',
            'Development environments are free, so agencies can build before paying for production.',
            'Annual and multi-site agency contracts are negotiated.',
        ],
        'migration' => 'Pantheon provides migration tooling and guided support, and the free development environment means you can build and validate the migrated site fully before paying for or launching production. Enterprise migrations get professional services assistance.',
        'not_for' => [
            'Anything other than WordPress or Drupal',
            'Individual site owners and hobby projects',
            'Teams wanting cPanel, email or traditional hosting features',
            'Buyers who do not need a governed multi-environment workflow',
        ],
        'verdict' => 'The platform for teams that treat websites as software: real environments, real workflow, real governance. Expensive for one site and excellent value for an agency or institution running many. If your team does not practise dev-test-live discipline, you are paying for something you will not use.',
    ],

    'acquia' => [
        'overview' => 'Acquia was founded in 2007 by Dries Buytaert, the creator of Drupal, and Jay Batson, explicitly to be the enterprise company behind the open-source project. That origin defines it: Acquia is where large organisations run Drupal when the site is a governed enterprise system with compliance obligations, integration requirements and a procurement process.

The platform is Acquia Cloud Platform, built on AWS, with a full enterprise toolkit around it: Cloud IDE, continuous delivery pipelines, Acquia Site Factory for running hundreds of Drupal sites from one codebase, Content Hub for syndicating content across properties, a customer data platform, personalisation, and a marketing automation suite. Support includes named technical account managers and formal SLAs.

Pricing starts in the hundreds per month and typically runs into five and six figures annually for the enterprise tiers, which tells you who it is for. Governments, universities, global brands and media groups use it. An individual Drupal site does not need it and should not buy it.',
        'company' => [
            'Ownership'    => 'Vista Equity Partners, majority investment since 2019',
            'Headquarters' => 'Boston, Massachusetts, United States',
            'Founded'      => '2007 by Dries Buytaert and Jay Batson',
            'Scale'        => 'Enterprise customers including governments, universities and global brands',
            'Notable'      => 'Founded by the creator of Drupal',
        ],
        'timeline' => [
            ['year' => 2007, 'event' => 'Founded by Drupal creator Dries Buytaert as the enterprise Drupal company.'],
            ['year' => 2013, 'event' => 'Launches Acquia Cloud Site Factory for multi-site Drupal management.'],
            ['year' => 2019, 'event' => 'Vista Equity Partners takes a majority stake at a $1 billion valuation.'],
            ['year' => 2021, 'event' => 'Expands the digital experience platform with a customer data platform and personalisation.'],
            ['year' => 2023, 'event' => 'Adds Acquia Cloud Next, a Kubernetes-based platform generation.'],
        ],
        'hosting_types' => [
            ['name' => 'Acquia Cloud Platform', 'from' => '$235/mo', 'note' => 'Managed Drupal hosting on AWS with enterprise tooling.'],
            ['name' => 'Site Factory',          'from' => 'Custom',   'note' => 'Hundreds or thousands of Drupal sites from one codebase.'],
            ['name' => 'Acquia CDP',            'from' => 'Custom',   'note' => 'Customer data platform for unified profiles and segmentation.'],
            ['name' => 'Campaign Studio',       'from' => 'Custom',   'note' => 'Marketing automation integrated with the content platform.'],
        ],
        'specs' => [
            'Platform'       => 'Drupal-focused, built on AWS infrastructure',
            'Environments'   => 'Development, staging and production with continuous delivery pipelines',
            'Cloud IDE'      => 'Browser-based development environment for Drupal teams',
            'Site Factory'   => 'Centralised management of large multi-site Drupal estates',
            'Compliance'     => 'FedRAMP authorised, SOC 2, HIPAA, PCI DSS and GDPR',
            'CDN'            => 'Integrated CDN with edge caching and WAF',
            'Support'        => 'Enterprise support with named technical account managers and formal SLAs',
            'Migration'      => 'Professional services led migrations included in enterprise engagements',
            'Monitoring'     => 'Acquia Insight code and performance analysis for Drupal best practice',
            'Uptime SLA'     => '99.95% to 99.99% depending on contract tier',
        ],
        'performance' => 'Engineered for enterprise Drupal at scale, with edge caching, Varnish, Memcached and horizontally scalable infrastructure on AWS. Performance is a contractual matter rather than a benchmark question: Acquia sizes the environment to the traffic profile and commits to it in the SLA. For very large content estates with authenticated users and complex integrations, this is what the platform is designed around.',
        'security' => [
            'FedRAMP authorisation, which very few web platforms hold',
            'SOC 2, HIPAA, PCI DSS and GDPR compliance programmes',
            'Integrated web application firewall and DDoS mitigation',
            'Drupal security update management with coordinated patching',
            'Single sign-on, role-based access control and audit logging',
            'Named security contacts and formal incident response processes',
        ],
        'pricing_notes' => [
            'Entry pricing is in the hundreds per month; enterprise contracts run far higher.',
            'Pricing is quoted rather than published and negotiated at contract level.',
            'Professional services and migrations are typically part of the engagement.',
            'This is enterprise procurement, not self-service signup.',
        ],
        'migration' => 'Migrations are professional-services led, with Acquia architects planning and executing the move as part of the engagement. For the estates this platform serves, migration is a project with a timeline rather than a plugin.',
        'not_for' => [
            'WordPress, which is not the focus',
            'Individual sites and small organisations — the cost is prohibitive',
            'Teams wanting self-service signup and month-to-month billing',
            'Anyone not running Drupal',
        ],
        'verdict' => 'The enterprise Drupal platform, founded by Drupal\'s creator, holding compliance certifications that almost no competitor has. Correct for a government agency, university or global brand with a large Drupal estate. Wildly excessive for anything smaller.',
    ],

    'fly-io' => [
        'overview' => 'Fly.io takes a different approach from every other platform-as-a-service: instead of running your application in one region and putting a CDN in front, it runs your actual application in many regions at once and routes each user to the nearest instance over an Anycast network. Your Postgres can be replicated to read replicas in each region too, so a user in Sydney talks to a Sydney application server and a Sydney database replica.

The unit of deployment is a Firecracker microVM — the same technology behind AWS Lambda — which starts in milliseconds and can scale to zero when idle. You package the application as a Docker image or let Fly build one, define regions in a configuration file, and deploy with a single command. It supports any language, persistent volumes, private networking between apps, and GPU instances for machine learning workloads.

The platform is aimed squarely at developers and expects competence: there is no dashboard-driven hand-holding, documentation assumes you understand networking and containers, and debugging a distributed deployment is harder than debugging one server. Pricing is usage-based with a small free allowance.',
        'company' => [
            'Ownership'    => 'Privately held, venture backed',
            'Headquarters' => 'Chicago, Illinois, United States',
            'Founded'      => '2017',
            'Scale'        => '30+ regions worldwide running application instances, not just cache nodes',
            'Notable'      => 'Runs full applications at the edge rather than caching in front of one origin',
        ],
        'timeline' => [
            ['year' => 2017, 'event' => 'Founded with an edge application delivery model.'],
            ['year' => 2020, 'event' => 'Pivots to running full applications in Firecracker microVMs globally.'],
            ['year' => 2021, 'event' => 'Adds persistent volumes and globally replicated Postgres.'],
            ['year' => 2023, 'event' => 'Introduces GPU instances and expands machine learning support.'],
            ['year' => 2024, 'event' => 'Ships Fly Machines API for fine-grained programmatic VM control.'],
        ],
        'hosting_types' => [
            ['name' => 'Fly Machines',     'from' => '$1.94/mo', 'note' => 'Firecracker microVMs that start in milliseconds and scale to zero.'],
            ['name' => 'Fly Postgres',     'from' => 'Usage',    'note' => 'Managed Postgres with global read replicas.'],
            ['name' => 'Fly Volumes',      'from' => 'Usage',    'note' => 'Persistent NVMe storage attached to machines.'],
            ['name' => 'GPU machines',     'from' => 'Usage',    'note' => 'NVIDIA GPUs for inference and training workloads.'],
        ],
        'specs' => [
            'Architecture'   => 'Firecracker microVMs with millisecond cold starts',
            'Global routing' => 'Anycast network routing each user to the nearest running instance',
            'Regions'        => '30+ regions running real application instances',
            'Deployment'     => 'Docker images or buildpacks, deployed with the flyctl CLI',
            'Languages'      => 'Any — if it runs in a container, it runs here',
            'Databases'      => 'Managed Postgres with regional read replicas, plus Redis via Upstash',
            'Storage'        => 'Persistent NVMe volumes attached per machine',
            'Networking'     => 'Private WireGuard mesh between applications, IPv6 native',
            'Scale to zero'  => 'Machines stop when idle and start on request, cutting costs',
            'Support'        => 'Community forum, email support on paid plans',
            'Uptime SLA'     => 'Available on higher support plans',
        ],
        'performance' => 'Outstanding for globally distributed applications, because the application itself is close to the user rather than only the cache. A request from Tokyo hits a Tokyo machine and a Tokyo database replica, which removes the transcontinental round trip that dominates latency for conventional architectures. Firecracker cold starts are measured in milliseconds, so scaling to zero costs very little in responsiveness. The complexity of reasoning about a multi-region deployment is the price.',
        'security' => [
            'Private WireGuard mesh networking between applications by default',
            'Automatic HTTPS with managed certificates',
            'Hardware-virtualised isolation through Firecracker microVMs',
            'Secrets management with encrypted environment variables',
            'SOC 2 Type 2 compliance',
            'Application-level security and patching remain your responsibility',
        ],
        'pricing_notes' => [
            'Usage-based on compute time, memory, storage and bandwidth.',
            'Scale-to-zero means idle applications cost almost nothing.',
            'Multi-region deployment multiplies compute cost by the number of regions.',
            'A small free allowance exists; beyond it, billing is pay-as-you-go.',
        ],
        'migration' => 'Containerise the application and deploy — there is no migration service. Moving a stateful application with a database requires planning the data layer, and Fly documents the Postgres replication patterns well.',
        'not_for' => [
            'WordPress and traditional PHP hosting workflows',
            'Non-technical users or teams without container experience',
            'Applications that do not benefit from geographic distribution',
            'Buyers wanting a polished dashboard-driven experience',
        ],
        'verdict' => 'The most interesting architecture in modern application hosting: real application instances near every user rather than a cache in front of one origin. Excellent for latency-sensitive global applications, and genuinely demanding of the developer operating it.',
    ],

    'railway' => [
        'overview' => 'Railway is a deployment platform built around the idea that infrastructure should be something you draw rather than configure. Its canvas interface shows your application, database, cache and cron jobs as connected nodes, and adding a Postgres instance or a Redis cache is a right-click. Behind that, it is a competent container platform: deploy from a Git repository or a Docker image, get automatic HTTPS, private networking between services, environment-based configuration and usage-based billing.

Founded in 2020, it grew quickly as Heroku wound down its free tier, and it appeals particularly to small teams and side projects that want a database and a web service running in five minutes without touching a cloud console. Templates let you deploy common stacks — a Django app with Postgres, a Next.js app with Redis — in a single click.

The considerations are cost predictability and scale. Usage-based billing on compute-seconds and memory means an idle service is cheap and a busy one can surprise you, and Railway is not built for large-scale production estates with compliance requirements. For prototypes, internal tools and small production applications, it is one of the pleasantest platforms available.',
        'company' => [
            'Ownership'    => 'Privately held, venture backed',
            'Headquarters' => 'San Francisco, California, United States',
            'Founded'      => '2020',
            'Scale'        => 'Hundreds of thousands of developers and deployed projects',
            'Notable'      => 'Canvas-based infrastructure interface, unusual in the category',
        ],
        'timeline' => [
            ['year' => 2020, 'event' => 'Founded as a simpler alternative to configuring cloud infrastructure.'],
            ['year' => 2022, 'event' => 'Grows rapidly as Heroku retires its free tier.'],
            ['year' => 2023, 'event' => 'Ships the canvas interface for visual infrastructure composition.'],
            ['year' => 2024, 'event' => 'Adds more regions and improved private networking between services.'],
        ],
        'hosting_types' => [
            ['name' => 'Hobby',      'from' => '$5/mo',   'note' => 'Includes usage credit, suitable for side projects.'],
            ['name' => 'Pro',        'from' => '$20/user','note' => 'Teams with higher limits, more regions and priority support.'],
            ['name' => 'Enterprise', 'from' => 'Custom',   'note' => 'Dedicated resources, SLAs and compliance controls.'],
            ['name' => 'Databases',  'from' => 'Usage',    'note' => 'Postgres, MySQL, Redis and MongoDB provisioned in one click.'],
        ],
        'specs' => [
            'Deployment'     => 'Git-push from GitHub, Docker images, or one-click templates',
            'Interface'      => 'Canvas view showing services, databases and their connections',
            'Databases'      => 'Postgres, MySQL, Redis and MongoDB with automatic backups',
            'Languages'      => 'Any language via Nixpacks build detection or a custom Dockerfile',
            'Environments'   => 'Multiple environments per project with variable inheritance',
            'Private networking' => 'Services communicate internally without public exposure',
            'Cron jobs'      => 'Scheduled tasks as first-class services',
            'Observability'  => 'Built-in logs, metrics and deployment history',
            'Billing'        => 'Usage-based on compute-seconds, memory and egress',
            'Support'        => 'Community Discord, email and priority tiers on paid plans',
            'Uptime SLA'     => 'Available on enterprise plans',
        ],
        'performance' => 'Good for small and medium application workloads. Containers run on well-provisioned hardware with fast startup, private networking keeps service-to-service latency low, and databases sit alongside the services that use them. Region choice is more limited than the major clouds, so a globally distributed audience needs a CDN or a different platform.',
        'security' => [
            'Automatic HTTPS with managed certificates on every service',
            'Private networking between services with no public exposure required',
            'Encrypted environment variables and per-environment secrets',
            'Automatic platform patching of the underlying infrastructure',
            'Two-factor authentication and team role permissions',
            'SOC 2 compliance work on enterprise tiers',
        ],
        'pricing_notes' => [
            'Usage-based on compute-seconds and memory, so idle services are cheap.',
            'The Hobby plan includes a monthly usage credit that covers small projects.',
            'Watch the usage dashboard — a memory leak or busy loop generates real cost.',
            'Databases bill for storage and compute separately.',
        ],
        'migration' => 'Deploy from a Git repository or Docker image; Heroku migrations are well documented and usually straightforward. There is no managed migration service.',
        'not_for' => [
            'WordPress and traditional PHP hosting',
            'Large production estates with strict compliance requirements',
            'Workloads needing many global regions',
            'Teams that need firm, predictable monthly billing',
        ],
        'verdict' => 'The friendliest way to get an application and its database running quickly, with an interface that makes infrastructure legible rather than abstract. Excellent for prototypes, internal tools and small production services. Watch the usage meter as traffic grows.',
    ],

    'rackspace' => [
        'overview' => 'Rackspace built its business on a phrase it trademarked: Fanatical Support. Founded in San Antonio in 1998, it became one of the largest managed hosting companies in the world by selling the labour around infrastructure rather than the infrastructure itself, and by answering the phone when other providers did not.

The company has since repositioned. Rather than competing with AWS and Azure on raw infrastructure, Rackspace Technology now sells managed services on top of them: it will run your AWS, Azure, Google Cloud or VMware environment, handle the architecture, security, cost optimisation and 24/7 operations, and remain accountable for it. It still offers its own dedicated servers, private cloud and a managed hosting business alongside.

That makes Rackspace a services company with hosting attached rather than a host in the conventional sense. Pricing starts high and is generally quoted rather than published. For an enterprise with a complex multi-cloud estate and no desire to staff a platform team, it is a legitimate answer. For a website, it is not.',
        'company' => [
            'Ownership'    => 'Rackspace Technology, publicly traded (NASDAQ: RXT)',
            'Headquarters' => 'San Antonio, Texas, United States',
            'Founded'      => '1998',
            'Scale'        => 'Thousands of enterprise customers across multi-cloud estates',
            'Notable'      => 'Coined and trademarked Fanatical Support',
        ],
        'timeline' => [
            ['year' => 1998, 'event' => 'Founded in San Antonio as a managed hosting company.'],
            ['year' => 2010, 'event' => 'Co-founds OpenStack with NASA, open-sourcing its cloud platform.'],
            ['year' => 2016, 'event' => 'Taken private by Apollo Global Management and pivots to multi-cloud services.'],
            ['year' => 2020, 'event' => 'Returns to public markets as Rackspace Technology.'],
            ['year' => 2022, 'event' => 'Focuses on managed services across AWS, Azure, Google Cloud and VMware.'],
        ],
        'hosting_types' => [
            ['name' => 'Managed public cloud', 'from' => 'Custom',  'note' => 'Rackspace operates your AWS, Azure or Google Cloud environment.'],
            ['name' => 'Dedicated servers',    'from' => '$50/mo',  'note' => 'Single-tenant hardware with managed support.'],
            ['name' => 'Managed private cloud','from' => 'Custom',   'note' => 'VMware and OpenStack private cloud, fully operated.'],
            ['name' => 'Managed applications', 'from' => 'Custom',   'note' => 'Managed hosting for specific applications and databases.'],
            ['name' => 'Professional services','from' => 'Custom',   'note' => 'Architecture, migration and cost optimisation engagements.'],
        ],
        'specs' => [
            'Model'          => 'Managed services layered over public clouds, private cloud and dedicated hardware',
            'Support'        => 'Fanatical Support with named teams and formal response SLAs',
            'Multi-cloud'    => 'AWS, Azure, Google Cloud, VMware and OpenStack all supported',
            'Certifications' => 'One of the largest pools of certified cloud engineers among service providers',
            'Compliance'     => 'PCI DSS, HIPAA, SOC, ISO 27001 and FedRAMP-supporting engagements',
            'Operations'     => '24/7 monitoring, incident response and change management',
            'Cost management'=> 'Cloud cost optimisation as a service line',
            'Security'       => 'Managed detection and response offerings',
            'Data centres'   => 'Global facilities plus operations in customer cloud accounts',
            'Uptime SLA'     => 'Contractual, varies by engagement',
        ],
        'performance' => 'Performance is whatever the underlying platform provides, engineered and operated by Rackspace. The value is not speed but operational competence: correct architecture, capacity planning, patching, monitoring and someone accountable at three in the morning. Judged as a host, it is unremarkable; judged as an operations partner, it is one of the largest and most experienced available.',
        'security' => [
            'Managed security services including detection and response',
            'Compliance support for PCI DSS, HIPAA, SOC 2 and government frameworks',
            '24/7 security operations centre monitoring',
            'Patch management and vulnerability remediation as a managed service',
            'Formal change management and audit trails',
            'Named security contacts within the engagement team',
        ],
        'pricing_notes' => [
            'Pricing is quoted per engagement rather than published.',
            'Managed service fees sit on top of the underlying cloud spend.',
            'Contracts are typically annual or multi-year with committed volumes.',
            'Compare against the cost of hiring an equivalent internal platform team.',
        ],
        'migration' => 'Migrations are professional-services engagements with assessment, planning, execution and post-migration optimisation. This is one of the company\'s main service lines and is done at enterprise scale.',
        'not_for' => [
            'Individual websites and small businesses',
            'Buyers wanting self-service signup and published pricing',
            'Teams with their own platform engineering capability',
            'Anyone optimising for the lowest monthly cost',
        ],
        'verdict' => 'A managed services company rather than a host, and a credible one for an enterprise that wants someone accountable for a complex multi-cloud estate. Buy the operations, not the infrastructure. Entirely the wrong shape for a website.',
    ],

    'oracle-cloud' => [
        'overview' => 'Oracle Cloud Infrastructure is worth attention for one reason above all others: its Always Free tier is the most generous in the industry by a wide margin. Four ARM-based Ampere cores, twenty-four gigabytes of memory, two hundred gigabytes of block storage, ten terabytes of monthly egress and a load balancer, free permanently, not for twelve months. That is enough to run a real production application, and a great many small projects do exactly that.

Beyond the free tier, OCI is a serious enterprise cloud built on a second-generation architecture with a flat, non-blocking network, bare metal instances, and RDMA cluster networking for high-performance computing. Oracle Autonomous Database is genuinely differentiated technology. Egress pricing is dramatically cheaper than AWS, Azure or Google Cloud, which for bandwidth-heavy workloads changes the arithmetic entirely.

The reservations are ecosystem and experience. Documentation and community are thinner than the big three, the console has its own conventions, Always Free capacity is sometimes unavailable in popular regions, and Oracle\'s commercial reputation makes some buyers wary. Technically, the platform is far better than its reputation.',
        'company' => [
            'Ownership'    => 'Oracle Corporation, publicly traded (NYSE: ORCL)',
            'Headquarters' => 'Austin, Texas, United States',
            'Founded'      => '2016 for the current generation OCI platform',
            'Scale'        => '48+ cloud regions with aggressive expansion',
            'Notable'      => 'The most generous permanent free tier of any cloud provider',
        ],
        'timeline' => [
            ['year' => 2016, 'event' => 'Launches second-generation Oracle Cloud Infrastructure.'],
            ['year' => 2019, 'event' => 'Introduces the Always Free tier with permanent allowances.'],
            ['year' => 2021, 'event' => 'Adds Ampere ARM instances, substantially expanding the free tier.'],
            ['year' => 2022, 'event' => 'Signs major AI infrastructure deals and expands GPU capacity.'],
            ['year' => 2023, 'event' => 'Passes 45 cloud regions with multi-cloud interconnects to Azure and Google Cloud.'],
        ],
        'hosting_types' => [
            ['name' => 'Always Free compute', 'from' => 'Free',  'note' => '4 ARM cores, 24GB RAM, 200GB storage, 10TB egress — permanently free.'],
            ['name' => 'Compute instances',   'from' => 'Usage', 'note' => 'ARM and x86 virtual machines plus bare metal.'],
            ['name' => 'Autonomous Database', 'from' => 'Usage', 'note' => 'Self-tuning, self-patching Oracle database with a free tier.'],
            ['name' => 'Object storage',      'from' => 'Usage', 'note' => 'S3-compatible storage with very low egress rates.'],
            ['name' => 'Kubernetes (OKE)',    'from' => 'Usage', 'note' => 'Managed Kubernetes with a free control plane.'],
        ],
        'specs' => [
            'Control panel'  => 'OCI Console, CLI, SDKs, Terraform and Resource Manager',
            'Free tier'      => 'Always Free: 4 Ampere ARM cores, 24GB RAM, 200GB block storage, 10TB egress monthly',
            'Architectures'  => 'ARM Ampere, AMD, Intel and bare metal instance shapes',
            'Networking'     => 'Flat non-blocking network, RDMA cluster networking for HPC',
            'Egress pricing' => 'Substantially cheaper than AWS, Azure and Google Cloud',
            'Database'       => 'Autonomous Database with self-tuning and self-patching',
            'Regions'        => '48+ regions including sovereign and government clouds',
            'Multi-cloud'    => 'Direct interconnects to Azure and Google Cloud',
            'Compliance'     => 'FedRAMP, SOC, ISO 27001, PCI DSS, HIPAA and regional certifications',
            'Support'        => 'Free basic support; paid tiers for production workloads',
            'Uptime SLA'     => '99.95% with performance and manageability SLAs as well as availability',
        ],
        'performance' => 'Strong, particularly on the ARM Ampere instances that also power the free tier — four Ampere cores is real compute, not a burstable fraction. The network architecture is flat and non-blocking, which gives consistent throughput between instances, and bare metal options remove the hypervisor entirely. The main practical constraint is Always Free capacity availability in busy regions, which can require patience or a different home region.',
        'security' => [
            'Security zones enforcing policy-based configuration guardrails',
            'Cloud Guard for automated threat detection and remediation',
            'Encryption at rest and in transit by default with customer-managed keys',
            'Identity and access management with compartment-based isolation',
            'FedRAMP, HIPAA, PCI DSS and sovereign cloud regions for regulated workloads',
            'Shared responsibility model as with all clouds',
        ],
        'pricing_notes' => [
            'The Always Free tier is permanent, not a 12-month trial — a genuine outlier.',
            'Egress is priced far below the other hyperscalers, often the deciding factor for media workloads.',
            'Paid compute is competitively priced, particularly ARM instances.',
            'Always Free capacity can be unavailable in popular regions; choosing a quieter home region helps.',
        ],
        'migration' => 'Oracle provides migration tooling for databases and virtual machines, plus professional services for enterprise moves. For a small project, you deploy directly rather than migrating.',
        'not_for' => [
            'Buyers who want the largest community and deepest third-party ecosystem',
            'Simple website hosting where a managed host is far easier',
            'Organisations with policy objections to Oracle as a vendor',
            'Teams that need the broadest managed service catalogue',
        ],
        'verdict' => 'Technically much better than its reputation, and the Always Free tier is the single best free offer in cloud computing — enough to run a genuine production application at no cost. Cheap egress makes it compelling for bandwidth-heavy workloads. Accept thinner documentation and a smaller community.',
    ],

    'ibm-cloud' => [
        'overview' => 'IBM Cloud is built for a specific customer: the large, regulated enterprise with existing IBM relationships, mainframe or Power systems in the estate, and a hybrid architecture that will never be fully public cloud. Its strategy since the 2019 acquisition of Red Hat has been to make OpenShift the consistent layer across on-premises, IBM Cloud and other public clouds, so workloads move without rewriting.

The catalogue includes virtual servers, bare metal, VPC networking, managed OpenShift and Kubernetes, IBM Cloud Databases, Watson AI services and, uniquely among the major clouds, quantum computing access. The compliance posture is exceptional, with IBM Cloud for Financial Services offering controls designed specifically for banks and insurers, and Hyper Protect services providing confidential computing backed by hardware security modules that even IBM cannot access.

For general web hosting it is an awkward fit: expensive relative to commodity providers, complex, and aimed at a procurement process rather than a signup form. Its virtual server and bare metal products are competent but unremarkable next to their equivalents elsewhere.',
        'company' => [
            'Ownership'    => 'IBM Corporation, publicly traded (NYSE: IBM)',
            'Headquarters' => 'Armonk, New York, United States',
            'Founded'      => '2011, substantially rebuilt after the 2013 SoftLayer acquisition',
            'Scale'        => '60+ data centres across six regions worldwide',
            'Notable'      => 'Red Hat OpenShift as the hybrid cloud layer, plus quantum computing access',
        ],
        'timeline' => [
            ['year' => 2013, 'event' => 'Acquires SoftLayer, forming the basis of IBM Cloud infrastructure.'],
            ['year' => 2016, 'event' => 'Integrates Watson AI services into the cloud platform.'],
            ['year' => 2019, 'event' => 'Acquires Red Hat for $34 billion, making OpenShift the hybrid strategy.'],
            ['year' => 2020, 'event' => 'Launches IBM Cloud for Financial Services with sector-specific controls.'],
            ['year' => 2022, 'event' => 'Expands Hyper Protect confidential computing and quantum access.'],
        ],
        'hosting_types' => [
            ['name' => 'Virtual servers',   'from' => '$8/mo',  'note' => 'Public and dedicated virtual instances in VPC.'],
            ['name' => 'Bare metal',        'from' => 'Usage',  'note' => 'Single-tenant hardware with extensive configuration options.'],
            ['name' => 'OpenShift / IKS',   'from' => 'Usage',  'note' => 'Managed Red Hat OpenShift and Kubernetes services.'],
            ['name' => 'Cloud Databases',   'from' => 'Usage',  'note' => 'Managed PostgreSQL, MongoDB, Redis, Db2 and more.'],
            ['name' => 'Hyper Protect',     'from' => 'Usage',  'note' => 'Confidential computing with hardware security modules.'],
        ],
        'specs' => [
            'Hybrid strategy' => 'Red Hat OpenShift as a consistent layer across on-premises and multiple clouds',
            'Compliance'     => 'IBM Cloud for Financial Services with controls designed for banking and insurance',
            'Confidential computing' => 'Hyper Protect services with FIPS 140-2 Level 4 hardware security modules',
            'Quantum'        => 'IBM Quantum access, unique among major cloud providers',
            'AI'             => 'watsonx platform for enterprise AI and data governance',
            'Bare metal'     => 'Deep hardware configuration options inherited from SoftLayer',
            'Regions'        => '60+ data centres across six global regions',
            'Networking'     => 'VPC with private global backbone between IBM facilities',
            'Support'        => 'Basic free, with Advanced and Premium paid tiers',
            'Uptime SLA'     => 'Up to 99.99% on multi-zone configurations',
        ],
        'performance' => 'Competent rather than distinctive for general workloads. Bare metal is a genuine strength, with configuration depth inherited from SoftLayer and consistent single-tenant performance. The private backbone between IBM facilities is good. For web hosting specifically, there is nothing here that a cheaper provider does not do as well.',
        'security' => [
            'Hyper Protect confidential computing with FIPS 140-2 Level 4 hardware security modules',
            'Keep Your Own Key encryption where IBM cannot access customer keys',
            'IBM Cloud for Financial Services with sector-specific compliance controls',
            'SOC 2, ISO 27001, PCI DSS, HIPAA, FedRAMP and GDPR coverage',
            'Security and Compliance Center for continuous posture monitoring',
            'Identity and access management with fine-grained resource policies',
        ],
        'pricing_notes' => [
            'Generally more expensive than commodity cloud providers for equivalent compute.',
            'Enterprise agreements and committed spend negotiate meaningful discounts.',
            'A free tier exists across a number of services, including a small Kubernetes cluster.',
            'Egress is billed, as with all hyperscalers.',
        ],
        'migration' => 'IBM provides migration tooling and, more relevantly, large professional services and consulting practices that handle enterprise estate migrations. This is typically a consulting engagement rather than a self-service operation.',
        'not_for' => [
            'Websites and small applications, where it is expensive and complex',
            'Startups and developers wanting a fast self-service experience',
            'Buyers without an existing IBM or Red Hat relationship',
            'Cost-sensitive workloads',
        ],
        'verdict' => 'A hybrid cloud and compliance platform for large regulated enterprises, with genuinely differentiated confidential computing and an unmatched Red Hat story. If you are a bank running OpenShift across on-premises and cloud, it makes sense. For hosting a website, it does not.',
    ],

    'alibaba-cloud' => [
        'overview' => 'Alibaba Cloud is the largest cloud provider in Asia-Pacific and the only practical route for most foreign companies to serve mainland China properly. That is its defining characteristic: it operates licensed regions inside mainland China, it can help customers navigate the ICP filing that Chinese law requires for any site hosted domestically, and it offers a China-accelerated CDN that makes a site usable from behind the Great Firewall.

Outside China it operates a full hyperscaler catalogue — Elastic Compute Service, ApsaraDB managed databases, object storage, container services, serverless functions and a large machine learning platform — from regions across Southeast Asia, Japan, Korea, Australia, India, Europe, the Middle East and the United States. Pricing undercuts AWS in most comparable configurations.

The considerations are governance, documentation and support. English documentation lags the Chinese original, the console follows different conventions, and many Western organisations have vendor policies restricting Chinese-headquartered providers. For an Asian audience with no such constraint, the price and regional performance are very strong.',
        'company' => [
            'Ownership'    => 'Alibaba Group, publicly traded (NYSE: BABA, HKEX: 9988)',
            'Headquarters' => 'Hangzhou, China, with international operations based in Singapore',
            'Founded'      => '2009 as Aliyun',
            'Scale'        => '28+ regions, 85+ availability zones, the leading cloud in Asia-Pacific',
            'Notable'      => 'The main practical route to hosting legally and fast inside mainland China',
        ],
        'timeline' => [
            ['year' => 2009, 'event' => 'Founded as Aliyun to serve Alibaba Group infrastructure.'],
            ['year' => 2014, 'event' => 'Opens its first international region in Silicon Valley.'],
            ['year' => 2017, 'event' => 'Becomes the clear cloud market leader across Asia-Pacific.'],
            ['year' => 2020, 'event' => 'Expands European and Middle East regions.'],
            ['year' => 2023, 'event' => 'Restructures with international headquarters functions in Singapore.'],
        ],
        'hosting_types' => [
            ['name' => 'Elastic Compute Service',  'from' => '$3/mo',   'note' => 'General purpose, compute and memory optimised instances.'],
            ['name' => 'Simple Application Server','from' => '$2.50/mo','note' => 'Fixed-price preconfigured application instances.'],
            ['name' => 'ApsaraDB',                 'from' => 'Usage',   'note' => 'Managed RDS, PolarDB, Redis and MongoDB.'],
            ['name' => 'Object Storage Service',   'from' => 'Usage',   'note' => 'S3-compatible storage with China-accelerated delivery.'],
            ['name' => 'China CDN',                'from' => 'Usage',   'note' => 'Content delivery inside mainland China, requiring ICP filing.'],
        ],
        'specs' => [
            'Control panel'  => 'Alibaba Cloud console, API, CLI and Terraform provider',
            'China access'   => 'Licensed mainland China regions with ICP filing assistance',
            'Regions'        => '28+ regions worldwide with the densest Asia-Pacific coverage',
            'Storage'        => 'ESSD cloud disks with configurable performance tiers',
            'CDN'            => 'Global CDN with exceptional Asian point-of-presence density',
            'Databases'      => 'PolarDB, RDS and analytic databases at hyperscaler scale',
            'Security'       => 'Anti-DDoS, WAF, Cloud Firewall and Security Center',
            'Compliance'     => 'ISO 27001, SOC, PCI DSS, MTCS and Chinese regulatory compliance',
            'Free tier'      => 'Generous new-account free tier across many services',
            'Support'        => 'Free basic support with paid developer, business and enterprise tiers',
            'Uptime SLA'     => '99.95% single instance, 99.995% multi-zone',
        ],
        'performance' => 'The best available for mainland China and Southeast Asia. Inside China, a domestically hosted and ICP-filed site with the local CDN is dramatically faster than anything served from outside, where cross-border traffic is filtered and throttled. Across Southeast Asia the region density beats AWS and Google Cloud for most users. Elsewhere it is competitive but not distinctive.',
        'security' => [
            'Anti-DDoS Basic free, with Pro and Premium scrubbing services available',
            'Cloud Firewall, WAF and Security Center for posture and threat management',
            'Identity and access management with fine-grained role policies',
            'Encryption at rest and in transit with a managed key service',
            'ISO 27001, SOC, PCI DSS and MTCS certifications',
            'Organisations with restrictions on Chinese-owned vendors should confirm internal policy',
        ],
        'pricing_notes' => [
            'Subscription commitments cut costs substantially against pay-as-you-go rates.',
            'Generally cheaper than AWS for comparable Asia-Pacific configurations.',
            'Egress is billed and can be significant on media-heavy workloads.',
            'Hosting inside mainland China requires an ICP licence, which takes weeks to obtain.',
        ],
        'migration' => 'Server Migration Center lifts virtual machines from other clouds and on-premises environments, and Data Transmission Service handles live database migration. For China deployments, the ICP filing process is the long pole, not the technical migration.',
        'not_for' => [
            'Organisations with vendor policies restricting Chinese-headquartered providers',
            'Teams needing the deepest English documentation and community support',
            'Simple website hosting, where a managed host is far easier',
            'Workloads focused entirely on Europe or North America',
        ],
        'verdict' => 'The necessary choice for serving mainland China legally and quickly, and a strong, cheaper alternative to AWS across Southeast Asia. Budget time for ICP filing if you are going into China, and check your organisation\'s vendor policy first.',
    ],

    'media-temple' => [
        'overview' => 'Media Temple was, for most of the 2000s, the host that designers and creative agencies used. Founded in Los Angeles in 1998, it built a brand around design-led marketing, a distinctive grid hosting product, and a customer base of studios, agencies and creative professionals who wanted hosting that felt like it was made by people who understood their work.

GoDaddy acquired it in 2013 and, for a decade, ran it as a separate premium brand with its own support team and products: managed WordPress, VPS, dedicated servers and the legacy grid service. In 2023 GoDaddy began consolidating Media Temple customers onto GoDaddy infrastructure and retiring the brand as a separate offering, which is the most important fact for anyone considering it now.

What remains is a well-regarded managed hosting product with a support reputation built over two decades, increasingly administered as part of GoDaddy. Prospective customers should check the current status of the brand and the migration path before committing, and existing customers should understand what platform their account now sits on.',
        'company' => [
            'Ownership'    => 'GoDaddy, acquired 2013, brand consolidated from 2023',
            'Headquarters' => 'Culver City, California, United States',
            'Founded'      => '1998',
            'Scale'        => 'Historically hundreds of thousands of sites, agency and designer focused',
            'Status'       => 'Being consolidated into GoDaddy — verify current offering before purchase',
        ],
        'timeline' => [
            ['year' => 1998, 'event' => 'Founded in Los Angeles serving designers and creative agencies.'],
            ['year' => 2006, 'event' => 'Launches Grid hosting, a distinctive clustered shared platform.'],
            ['year' => 2013, 'event' => 'Acquired by GoDaddy and operated as a separate premium brand.'],
            ['year' => 2019, 'event' => 'Focuses on managed WordPress and VPS for agencies.'],
            ['year' => 2023, 'event' => 'GoDaddy begins consolidating Media Temple customers onto its own platform.'],
        ],
        'hosting_types' => [
            ['name' => 'Managed WordPress', 'from' => '$19.50/mo', 'note' => 'Managed WordPress with staging and automatic updates.'],
            ['name' => 'VPS hosting',       'from' => '$30/mo',    'note' => 'Managed and self-managed virtual servers with root access.'],
            ['name' => 'Dedicated servers', 'from' => 'Custom',     'note' => 'Single-tenant hardware with managed support.'],
            ['name' => 'Grid hosting',      'from' => 'Legacy',     'note' => 'The original clustered shared platform, legacy status.'],
        ],
        'specs' => [
            'Control panel'  => 'Media Temple account center, with Plesk on some VPS products',
            'Platform'       => 'Increasingly GoDaddy infrastructure following consolidation',
            'Storage'        => 'SSD across current plans',
            'Backups'        => 'Automated backups with restore on managed plans',
            'Staging'        => 'Available on managed WordPress',
            'SSH access'     => 'Yes, on VPS and managed WordPress',
            'Support'        => 'Historically a key differentiator, now aligned with GoDaddy support',
            'Brand status'   => 'Being retired as a standalone brand — confirm current terms before buying',
            'Uptime SLA'     => '99.9% with credits',
        ],
        'performance' => 'Historically good for its category, with United States data centres and a well-run managed WordPress product. As accounts consolidate onto GoDaddy infrastructure, performance converges with GoDaddy managed WordPress, which is competent mid-table. The distinctive Grid architecture that defined the brand is legacy.',
        'security' => [
            'Free SSL on managed plans with automatic renewal',
            'Automated backups with restore on managed products',
            'Malware scanning available, with Sucuri options through GoDaddy',
            'DDoS protection at the network level',
            'Two-factor authentication on the account',
        ],
        'pricing_notes' => [
            'Priced above mass-market shared hosting, reflecting the managed positioning.',
            'Brand consolidation means current pricing and terms should be verified directly.',
            'Existing customers should check which platform their account has been moved to.',
            'A money-back guarantee applies, with terms varying by product.',
        ],
        'migration' => 'Migration assistance has historically been available through support. Given the ongoing consolidation into GoDaddy, prospective customers should confirm the migration path and the destination platform before committing.',
        'not_for' => [
            'Buyers wanting long-term certainty about the platform they are joining',
            'Anyone seeking the lowest price',
            'Developers wanting modern Git-based workflows',
            'New customers who would be better served by choosing GoDaddy directly or a dedicated managed WordPress host',
        ],
        'verdict' => 'A storied brand in its consolidation phase. The historical reputation among designers was well earned, but GoDaddy is absorbing the products into its own platform. Verify what you are actually buying before signing up, and consider a dedicated managed WordPress host instead.',
    ],

    'heart-internet' => [
        'overview' => 'Heart Internet is a British host founded in Nottingham in 2003 that built a large customer base among United Kingdom small businesses, freelancers and web designers, particularly through its reseller platform. It was acquired by Host Europe Group and later by GoDaddy, before its customer base and platform came under the Stack Group umbrella alongside 20i and TSOHost.

That corporate history is the main thing a prospective customer should understand. Heart Internet has been through multiple ownership changes, and its customers have been migrated between platforms more than once, most recently onto infrastructure operated alongside 20i. The brand persists with shared hosting, managed WordPress, VPS, dedicated servers and reseller accounts aimed at the United Kingdom market.

The product itself is conventional: United Kingdom data centres, free domain on annual plans, unlimited bandwidth, cPanel or a custom panel depending on product, and a 30-day money-back guarantee. For a British small business it is a reasonable option, though 20i, which shares the same infrastructure operator, is generally the stronger product of the pair.',
        'company' => [
            'Ownership'     => 'Stack Group, following earlier Host Europe and GoDaddy ownership',
            'Headquarters'  => 'Nottingham, United Kingdom',
            'Founded'       => '2003',
            'Scale'         => 'Historically hundreds of thousands of UK domains and sites',
            'Sister brands' => '20i, TSOHost, Stack Group',
        ],
        'timeline' => [
            ['year' => 2003, 'event' => 'Founded in Nottingham serving UK small businesses and designers.'],
            ['year' => 2011, 'event' => 'Acquired by Host Europe Group.'],
            ['year' => 2017, 'event' => 'Passes to GoDaddy through the Host Europe acquisition.'],
            ['year' => 2021, 'event' => 'Customer base and platform move under Stack Group alongside 20i.'],
            ['year' => 2023, 'event' => 'Consolidation onto shared infrastructure with the 20i platform continues.'],
        ],
        'hosting_types' => [
            ['name' => 'Shared hosting',    'from' => '$3.99/mo',  'note' => 'UK-hosted plans with a free domain on annual terms.'],
            ['name' => 'WordPress hosting', 'from' => '$5.99/mo',  'note' => 'Managed WordPress with automatic updates.'],
            ['name' => 'VPS hosting',       'from' => '$19.99/mo', 'note' => 'Virtual servers with root access in UK data centres.'],
            ['name' => 'Dedicated servers', 'from' => '$99/mo',    'note' => 'Bare metal with managed support options.'],
            ['name' => 'Reseller hosting',  'from' => '$14.99/mo', 'note' => 'White-label accounts, historically a core product.'],
        ],
        'specs' => [
            'Control panel'  => 'Custom control panel, with cPanel on some products',
            'Data residency' => 'United Kingdom data centres',
            'Storage'        => 'SSD across current plans',
            'Bandwidth'      => 'Unlimited on shared hosting under fair use',
            'PHP versions'   => 'PHP 7.x and 8.x',
            'Backups'        => 'Available, included on higher tiers',
            'Email'          => 'Mailboxes included with hosting plans',
            'Reseller'       => 'Established white-label platform for UK designers',
            'Support'        => 'UK-based support with 24/7 availability',
            'Uptime SLA'     => '99.9% target',
        ],
        'performance' => 'Adequate for a United Kingdom audience, with local data centres providing short round trips. The stack is conventional with no LiteSpeed or edge caching included, so performance is ordinary shared hosting. Since the platform now shares infrastructure operation with 20i, the technical gap between the two brands has narrowed.',
        'security' => [
            'Free SSL included on current hosting plans',
            'UK data residency for organisations with local requirements',
            'Server-level firewall and malware scanning',
            'DDoS protection at the network level',
            'Backups with restore on higher tiers',
        ],
        'pricing_notes' => [
            'Pricing is in pounds sterling with UK VAT.',
            'Introductory rates renew higher, following the standard pattern.',
            'A free domain is included on annual and longer terms.',
            'A 30-day money-back guarantee applies.',
        ],
        'migration' => 'Migration assistance is available through support with standard transfer tooling. Given the platform consolidation history, confirm which infrastructure your account will sit on before migrating in.',
        'not_for' => [
            'Audiences outside the United Kingdom',
            'Buyers who want stability of ownership and platform',
            'Performance-focused sites wanting LiteSpeed or edge caching',
            'Developers wanting Git workflows and modern staging',
        ],
        'verdict' => 'A long-established British brand that has changed hands repeatedly and now shares an operator with 20i. Fine for a United Kingdom small business site, but compare it directly against 20i, which generally offers more for the money on the same infrastructure family.',
    ],
];

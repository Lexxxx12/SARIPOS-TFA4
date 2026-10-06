<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="hero">
    <div class="container hero-grid">
        <div>
            <p class="eyebrow">Simple sales, better service</p>
            <h1>Your store, organized in one place.</h1>
            <p class="hero-copy">Meet SariPOS—the friendly command center for your growing store. Keep customer and staff information organized, accessible, and ready when you need it.</p>
            <div class="actions">
                <a class="button primary" href="<?= site_url('customers') ?>">View customers</a>
                <a class="button secondary" href="<?= site_url('users') ?>">View staff</a>
            </div>
        </div>
        <div class="hero-card" aria-label="POS overview">
            <div class="receipt-top">
                <span>Today’s overview</span>
                <span class="status"><i></i> System ready</span>
            </div>
            <div class="metric">
                <span>Account directories</span>
                <strong>02</strong>
            </div>
            <div class="mini-grid">
                <div><span>Customers</span><strong>6</strong></div>
                <div><span>Staff users</span><strong>6</strong></div>
            </div>
        </div>
    </div>
</section>

<section class="container section">
    <div class="section-heading">
        <div><p class="eyebrow">Quick access</p><h2>Manage your records</h2></div>
        <p>Customer and staff records are loaded from the SariPOS database.</p>
    </div>
    <div class="feature-grid">
        <a class="feature-card" href="<?= site_url('customers') ?>">
            <span class="icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg></span>
            <h3>Customer Accounts</h3>
            <p>Browse customer names, contact emails, and phone numbers.</p>
            <span class="card-link">Open directory <span>&rarr;</span></span>
        </a>
        <a class="feature-card" href="<?= site_url('users') ?>">
            <span class="icon amber" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2M12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8"/></svg></span>
            <h3>User Accounts</h3>
            <p>Review staff usernames, full names, and account creation dates.</p>
            <span class="card-link">Open directory <span>&rarr;</span></span>
        </a>
        <a class="feature-card" href="<?= site_url('about') ?>">
            <span class="icon blue" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg></span>
            <h3>About the Project</h3>
            <p>Learn about the purpose and technology behind this POS.</p>
            <span class="card-link">Learn more <span>&rarr;</span></span>
        </a>
    </div>
</section>
<?= $this->endSection() ?>

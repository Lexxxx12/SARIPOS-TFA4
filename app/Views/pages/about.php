<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="page-hero">
    <div class="container narrow">
        <p class="eyebrow">About the project</p>
        <h1>A practical foundation for a better checkout experience.</h1>
        <p>SariPOS is a laboratory project built to demonstrate routing, controllers, views, and dynamic PHP templates in CodeIgniter 4.</p>
    </div>
</section>

<section class="container section narrow">
    <div class="about-grid">
        <article class="content-card">
            <h2>TFA3 release</h2>
            <p>This release adds complete create and edit workflows for customer and user accounts, with server-side validation and clear feedback when a form needs attention.</p>
            <p>User profile pictures are validated, prepared for display, and stored safely while account data remains organized in MySQL through CodeIgniter models.</p>
        </article>
        <aside class="stack-card">
            <p class="eyebrow">Technology</p>
            <ul>
                <li><span>Framework</span><strong>CodeIgniter 4</strong></li>
                <li><span>Language</span><strong>PHP</strong></li>
                <li><span>Data source</span><strong>MySQL</strong></li>
                <li><span>Forms</span><strong>Validated</strong></li>
            </ul>
        </aside>
    </div>
</section>
<?= $this->endSection() ?>

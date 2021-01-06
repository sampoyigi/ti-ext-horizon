<div class="container">
    <p class="text-right">
        <a
            target="_blank"
            href="<?= url('horizon') ?>">
            Standalone page <i class="fa fa-external-link"></i>
        </a>
    </p>
</div>

<iframe id="horizon-iframe" src="<?= url('horizon') ?>"></iframe>

<style>
    #horizon-iframe {
        width: 100%;
        height: 100%;
        border: 0 none;
    }

    .page-wrapper .page-content {
        padding-top: 0;
        padding-bottom: 0;
        height: 90vh;
    }
</style>

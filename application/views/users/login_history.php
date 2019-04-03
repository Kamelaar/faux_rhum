<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">


        <h1>
            <?= $title ?>
                <small class="text-muted"><?= $subtitle ?></small>
        </h1> <br />

    </section>

    <!-- Main content -->
    <section class="content">

        <!--Table of a member's login history-->
        <table id="table" class="table table-bordered table-striped">

            <thead>
                <tr>
                    <td>Date et heure</td>
                    <td>Adresse IP</td>
                    <td>Système d'exploitation</td>
                    <td>Agent utilisateur</td>
                    <td>Données de session</td>
                    <td>Agent utilisateur complet</td>
                </tr>
            </thead>
            <tbody>

                <!--Loop for browsing $login_history array-->
                <?php foreach($login_history as $history) : ?>

                <tr>

                    <td>
                        <?= $history['createdDtm'] ?>
                    </td>
                    <td>
                        <?= $history['machineIp'] ?>
                    </td>
                    <td>
                        <?= $history['platform'] ?>
                    </td>
                    <td>
                        <?= $history['userAgent'] ?>
                    </td>
                    <td style="word-wrap: break-word;min-width: 160px;max-width: 160px;">
                        <?= $history['sessionData'] ?>
                    </td>
                    <td>
                        <?= $history['agentString'] ?>
                    </td>


                </tr>

                <?php endforeach; ?>

            </tbody>

        </table> <br />

        <hr>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- page script -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#table').DataTable({
            
            // French translation
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            
            // Elements position
            dom:// Line 1: 'l' = length of the table, 'f' = filter of research
                "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
                // Line 2: 'tr' = table
                "<'row'<'col-sm-12'tr>>" +
                // Line 3: i = informations, p = pages, 'B' = buttons
                "<'row'<'col-sm-6'ip><'col-sm-6'B>>",
            
            // Ordering by column 0 of the table and desc
            aaSorting: [
                [0, 'desc']
            ],
            
            // Export buttons
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                // Configuration of the pdf export
                {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'LEGAL'
                },
                'print',
            ],
            
            // Number of results by table pages
            pageLength: 3,

        });
    });

</script>

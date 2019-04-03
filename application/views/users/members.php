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

        <table id="table" class="table table-bordered table-striped ">

            <thead>
                <tr>
                    <td>Nom</td>
                    <td>Code postal</td>
                    <td>Email</td>
                    <td>Pseudo</td>
                    <td>Date d'inscription</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>

                <!--Loop for browsing $all_members array-->
                <?php foreach($all_members as $member) : ?>

                <tr>
                    <td>
                        <?php echo $member['name'] ?> </td>
                    <td>
                        <?php echo $member['zipcode'] ?> </td>
                    <td>
                        <?php echo $member['email'] ?> </td>
                    <td>
                        <?php echo $member['username'] ?> </td>
                    <td>
                        <!--This function formates the date-->
                        <?php echo date("d/m/Y | H:i:s",strtotime($member['register_date'])); ?> </td>
                    <td>

                        <!--Member history button-->
                        <a href="<?php echo base_url(); ?>users/loginHistory/<?php echo $member['id'];?>"><span class='glyphicon glyphicon-time'></span></a> |

                        <!--Member edition button-->
                        <a href="<?php echo base_url(); ?>users/editMember/<?php echo $member['id'];?>"><span class='glyphicon glyphicon-pencil'></span></a> |

                        <!--Member deletion button-->
                        <a href="<?php echo base_url(); ?>users/deleteAMember/<?php echo $member['id'];?>"><span class='glyphicon glyphicon-trash'></span></a>
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
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json",
                buttons: {
                    copyTitle: 'Tableau copié dans le presse-papier',
                    copySuccess: {
                        _: '- %d lignes copiées -',
                        1: '- 1 ligne copiée -'
                    }
                }
            },

            // Elements position
            dom: // Line 1: 'l' = length of the table, 'f' = filter of research
                "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
                // Line 2: 'tr' = table
                "<'row'<'col-sm-12'tr>>" +
                // Line 3: i = informations, p = pages, 'B' = buttons
                "<'row'<'col-sm-6'ip><'col-sm-6'B>>",

            // Ordering by column 0 of the table and desc
            aaSorting: [
                [4, 'desc']
            ],

            // Export buttons
            buttons: [
                // Pdf export configuration
                {
                    extend: 'pdfHtml5',
                    text: 'Pdf',
                    orientation: 'portrait',
                    pageSize: 'LEGAL',
                    title: "Liste des membres du Faux Rhum",
                    filename: "DonnéesMembres",
                    // This function aligns center the table
                    customize: function(doc) {
                        console.dir(doc)
                        //left, top, right, bottom margin
                        doc.content[1].margin = [55, 0, 55, 0]
                    },
                    exportOptions: {
                        //Show only these columns
                        columns: [0, 1, 2, 3, 4]
                    }
                },

                // Excel export configuration
                {
                    extend: 'excelHtml5',
                    orientation: 'portrait',
                    pageSize: 'LEGAL',
                    title: "Liste des membres du Faux Rhum",
                    filename: "DonnéesMembres",
                    exportOptions: {
                        //Show only these columns
                        columns: [0, 1, 2, 3, 4]
                    }
                },

                // Csv export Configuration
                {
                    extend: 'csvHtml5',
                    orientation: 'portrait',
                    pageSize: 'LEGAL',
                    filename: "DonnéesMembres",
                    text: 'Csv',
                    exportOptions: {
                        //Show only these columns
                        columns: [0, 1, 2, 3, 4]
                    }
                },

                // Copy Configuration
                {
                    extend: 'copyHtml5',
                    title: "Liste des membres du Faux Rhum",
                    text: "Copie",
                    exportOptions: {
                        //Show only these columns
                        columns: [0, 1, 2, 3, 4]
                    },
                },

                // Print configuration
                {
                    extend: 'print',
                    orientation: 'portrait',
                    pageSize: 'LEGAL',
                    title: "Liste des membres du Faux Rhum",
                    text: 'Impression',
                    exportOptions: {
                        //Show only these columns
                        columns: [0, 1, 2, 3, 4]
                    },
                    customize: function(doc) {
                        //Page style
                        $(doc.document.body).css({
                            'margin-left': '50px',
                            'margin-right': '50px',
                            'font-size': '15px'
                        });

                        //h1 style
                        $(doc.document.body).find('h1').css({
                            'text-align': 'center',
                            'paddingBottom': '50px'
                        });

                        //Table style
                        $(doc.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                },
            ],

            // Number of results by table pages
            pageLength: 3,

        });
    });

</script>

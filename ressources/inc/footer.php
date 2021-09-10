<!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
       <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<script src="ressources/assets/js/jquery.min.js"></script>
<script src="ressources/assets/js/bootstrap.min.js"></script>
<script src="ressources/assets/js/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="ressources/assets/js/fastclick.js"></script>
<script src="ressources/assets/dist/js/adminlte.min.js"></script>
<script src="ressources/assets/dist/js/demo.js"></script>

<!-- DataTables -->
<script src="ressources/assets/js/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="ressources/assets/js/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script src="ressources/assets/bower_components/chart.js/Chart.js"></script>

        <script>
            /* Jour/Mois/Annee select */
            $("select#dateSystemSelected").change(function(){
                document.getElementById("dateSystemForm").submit();
            });

            $("select#moisSystemSelected").change(function(){
                document.getElementById("moisSystemForm").submit();
            });

            $("select#anneeSystemSelected").change(function(){
                document.getElementById("anneeSystemForm").submit();
            });
        </script>


    <script type="text/javascript">
        /*search table js*/
        var dataTable = $('#tatimTable').DataTable({
            'paging'      : false,
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : false,
            'info'        : false,
            'autoWidth'   : true
        });
        $('#tatimSearch').on('keyup',function(){
            dataTable.search($(this).val()).draw();
        });

    </script>

    <?php
        if(isset($_GET["m"]) && !empty($_GET["m"])):
            $getUrl = explode(".", $_GET["m"]);
            if(isset($getUrl[1]) && $getUrl[1]=="printed"):
                //Code d'impression, s'execute seulement sur lage concernee par l'impression du certificat
    ?>
                <script src="./ressources/assets/js/printThis.js"></script>
                <script>
                    //$('#print').click(function(){
                    $('.certificatPrinted').printThis({
                        debug: false,           // show the iframe for debugging
                        importCSS: true,        // import parent page css
                        importStyle: true,     // import style tags
                        printContainer: true,   // print outer container/$.selector
                        loadCSS: [
                            "http://pdevlab/project/2020/nuru_labo/ressources/assets/css/bootstrap.min.css",
                            "http://pdevlab/project/2020/nuru_labo/ressources/assets/js/font-awesome/css/font-awesome.min.css",
                            "http://pdevlab/project/2020/nuru_labo/ressources/assets/css/ionicons.min.css",
                            "http://pdevlab/project/2020/nuru_labo/ressources/assets/dist/css/AdminLTE.css",
                        ],      // load an additional css file - load multiple stylesheets with an array []
                        pageTitle: "nuruLAB",          // add title to print page
                        removeInline: false,    // remove all inline styles
                        printDelay: 333,        // variable print delay
                        header: "",           // prefix to html
                        footer: null,           // postfix to html
                        formValues: true,       // preserve input/form values
                        canvas: false,          // copy canvas content (experimental)
                        base: false,            // preserve the BASE tag, or accept a string for the URL
                        doctypeString: '<!DOCTYPE html>', // html doctype
                        removeScripts: false,   // remove script tags before appending
                        copyTagClasses: false,   // copy classes from the html & body tag
                        defaultEvent:true, //remove a default event
                    });
                    //})
                </script>
            <?php
                endif;
                endif;
            ?>

</body>
</html>


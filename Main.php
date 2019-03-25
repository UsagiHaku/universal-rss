<?php require "NewsController.php"; ?>
<?php require "Header.php"; ?>

<?php $controller = new NewsController(); ?>

<div class="container-fluid">
    <div class="row">
        <div class="visible-lg visible-md container col-lg-2">
            <div class="card" style="margin-top: 30px;">
                <div class="card-header">Ordenar por</div>
                <a id="orderDate" class="list-group-item" href="./Main.php?orderBy=date">Fecha</a>
                <a id="orderName" class="list-group-item" href="./Main.php?orderBy=title">Nombre</a>
                <a id="orderType" class="list-group-item" href="./Main.php?orderBy=description">Descripcion</a>
            </div>
        </div>

        <form class="container col-lg-10" style="border:0; margin-top:10px;" action="DeleteNews.php" id="tablas" method="post">

            <div>
                <div class="table-responsive">

                    <table id="tabla" class="table table-hover " >
                        <tr>
                            <td id="titulo" colspan="6"> Noticias</td>
                        </tr>
                        <tr id="encabezado">
                            <th scope="col">Imprimir</th>
                            <th scope="col">Titulo</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Contenido</th>
                            <th scope="col">Fecha</th>
                        </tr>
                        <tbody>

                        <?php

                        $news = $controller->get_news();

                        for($i = 0; $i<count($news); $i++) {
                            $currentNew = $news[$i];
                            echo  "<tr>"
                                . "<td><input type='checkbox'></td>"
                                . "<td>" . $currentNew->title . "</td> " . "<td>". $currentNew->description . "</td>"
                                . "<td><a href=". $currentNew->link .">" . $currentNew->link . "</a></td>" . "<td>" . $currentNew->date
                                . "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
</div>

<input type="button" onclick="tableToExcel('tabla', 'Datos')" value="Export to Excel">

<script>

    var tableToExcel = (function() {
        var uri = 'data:application/vnd.ms-excel;base64,'
            , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
            , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
            , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
        return function(table, name) {
            if (!table.nodeType) {
                table = document.getElementById(table)
            }

            // Entender esto
            var filteredTable = document.createElement('tbody');
            var rows = table.getElementsByTagName('tr');

            filteredTable.appendChild(rows[0]);

            for(var i = 1; i<rows.length; i++) {
                var row = rows[i];

                if(row.getElementsByTagName('input')[0].checked === true) {
                    filteredTable.appendChild(rows[i]);
                    i--;
                }
            }

            var ctx = {worksheet: name || 'Worksheet', table: filteredTable.innerHTML};
            window.location.href = uri + base64(format(template, ctx))

            setTimeout(function () {
                location.reload();
            }, 1000)
        }
    })()
</script>

</body>
</html>
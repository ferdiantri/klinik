<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js">
    var doc = new jsPDF();
</script>
<?php
/* @var $this PasienController */
/* @var $model Pasien */

?>



<div id="content">
    <h3>Untuk atas nama <?php echo $model['nama'];?> harus membayar sejumlah Rp.<?php echo $model['total'];?> dengan rincian sebagai berikut.</h3>
    <table border="1">
        <tr>
            <td>Field</td>
            <td>Keterangan</td>
        </tr>
        <tr>
            <td>Tanggal Daftar</td>
            <td><?php echo $model['tanggal_daftar'];?></td>
        </tr>
        <tr>
            <td>Tanggal Tindakan</td>
            <td><?php echo $model['tanggal_tindakan'];?></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td><?php echo $model['nama'];?></td>
        </tr>
        <tr>
            <td>Wilayah</td>
            <td><?php echo $model['wilayah'];?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td><?php echo $model['alamat'];?></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td><?php echo $model['jenis_kelamin'];?></td>
        </tr>
        <tr>
            <td>Umur</td>
            <td><?php echo $model['umur'];?></td>
        </tr>
        <tr>
            <td>Keluhan</td>
            <td><?php echo $model['keluhan'];?></td>
        </tr>
        <tr>
            <td>status</td>
            <td><?php echo $model['status'];?></td>
        </tr>
        <tr>
            <td>Tindakan</td>
            <td><?php echo $model['tindakan'];?></td>
        </tr>
        <tr>
            <td>Nama Obat</td>
            <td><?php echo $model['nama_obat'];?></td>
        </tr>
        <tr>
            <td>Dibuat Oleh</td>
            <td><?php echo $model['dibuat_oleh'];?></td>
        </tr>
        <tr>
            <td>Harga Obat</td>
            <td><?php echo $model['harga_obat'];?></td>
        </tr>
        <tr>
            <td>Total</td>
            <td><?php echo $model['total'];?></td>
        </tr>
    </table>
</div>
<a href="javascript:demoFromHTML()" class="button">Cetak</a>


<script>
    function demoFromHTML() {
        var pdf = new jsPDF('p', 'pt', 'letter');
        // source can be HTML-formatted string, or a reference
        // to an actual DOM element from which the text will be scraped.
        source = $('#content')[0];

        // we support special element handlers. Register them with jQuery-style 
        // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
        // There is no support for any other type of selectors 
        // (class, of compound) at this time.
        specialElementHandlers = {
            // element with id of "bypass" - jQuery style selector
            '#bypassme': function (element, renderer) {
                // true = "handled elsewhere, bypass text extraction"
                return true
            }
        };
        margins = {
            top: 80,
            bottom: 60,
            left: 40,
            width: 522
        };
        // all coords and widths are in jsPDF instance's declared units
        // 'inches' in this case
        pdf.fromHTML(
            source, // HTML string or DOM elem ref.
            margins.left, // x coord
            margins.top, { // y coord
                'width': margins.width, // max width of content on PDF
                'elementHandlers': specialElementHandlers
            },

            function (dispose) {
                // dispose: object with X, Y of the last line add to the PDF 
                //          this allow the insertion of new lines after html
                pdf.save('<?php echo $model['nama']; echo $model['id']; ?>');
            }, margins
        );
    }
</script>


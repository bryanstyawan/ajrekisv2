<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/datatables/dataTables.bootstrap.css'; ?>");</style>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<table class="table table-bordered table-striped table-view">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>%</th>
            <th>Jumlah</th>
        </tr>
        <tfoot>
            <tr>
        		<td colspan="4">Total Pemotongan</td>
        		<td id="total"></td>
            </tr>
            <tr>
                <td colspan="4">Total Tunjangan Aspek Disiplin</td>
                <td id="total_aspek"></td>
            </tr>
        	<tr>
        		<td colspan="4">Total Tunjangan Aspek Disiplin Yang Dibayarkan</td>
        		<td id="total_disiplin" style="font-weight: bold;"></td>
        	</tr>	
        </tfoot>
    </thead>
    <tbody id="show_data">
 
    </tbody>
</table>
<script>
function formatRupiah(num) {
    var p = num.toFixed(2).split(".");
    return "Rp." + p[0].split("").reverse().reduce(function(acc, num, i, orig) {
        return  num=="-" ? acc : num + (i && !(i % 3) ? "," : "") + acc;
    }, "") + "." + p[1];
}

 $(document).ready(function(){
        tampil_data_barang();   //pemanggilan fungsi tampil barang.
         
        //$('#mydata').dataTable();
        $(".table-view").DataTable({
            "oLanguage": {
                "sSearch": "Pencarian :",
                "sSearchPlaceholder" : "Ketik untuk mencari",
                "sLengthMenu": "Menampilkan data&nbsp; _MENU_ &nbsp;Data",
                "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "sZeroRecords": "Data tidak ditemukan"
            },
            "dom": "<'row'<'col-sm-6'f><'col-sm-6'l>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "bSort": false

            // "dom": '<"top"f>rt'
            // "dom": '<"top"fl>rt<"bottom"ip><"clear">'
        });
          
        //fungsi tampil barang
        function tampil_data_barang(){
            $.ajax({
                type  : 'ajax',
                url   : '<?php echo base_url()?>ro_peg/index',
                async : false,
                dataType : 'json',
                success : function(object){
                    var html = '';
                    var i = "";
                    var j = "";
                    var k = "";
                    var sum_jumlah = 0;
                    var total_tunjangan="";

                    //for(i in object)
                    console.log('lengthnya adalah ' + object.results.data.length);

                    for(j=0;j < object.results.data.length;j++) {

                            k = object.results.data[j].jumlah;
                            sum_jumlah = sum_jumlah + k;

                        }

                        console.log('sum_jumlah nya adlaah ' + sum_jumlah);

                    for(i=0; i<object.results.data.length; i++){
                        var ii = i+1; 
                        html += '<tr>'+
                                 '<td>'+ii+'</td>'+
                                '<td>'+object.results.data[i].tgl+'</td>'+
                                '<td>'+object.results.data[i].status+'</td>'+
                                '<td>'+object.results.data[i].persentase+'</td>'+
                                '<td>'+object.results.data[i].jumlah+'</td>'+
//                                '<td>'+formatRupiah(object.results.data[i].tunjangan)+'</td>'+
                                '</tr>';
                    }

                    total_tunjangan = object.results.info_pegawai[0].tunjangan - sum_jumlah;

                    var tunjangan =  object.results.info_pegawai[0].tunjangan;
                    $('#show_data').html(html);
                    document.getElementById("total").innerHTML = formatRupiah(sum_jumlah);
                    document.getElementById("total_aspek").innerHTML = formatRupiah(tunjangan);
                    document.getElementById("total_disiplin").innerHTML = formatRupiah(total_tunjangan);
                }
            });
        }
    });
</script>
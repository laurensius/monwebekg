    <main role="main" class="container">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <table class="table table-striped table-hover table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama Pasien</th>
                  <th>Umur</th>
                  <th>Jenis Kelamin</th>
                  <th>Alamat</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody id="tabel_data">
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </main>
    <script>
    function riwayat(){
      $.ajax({
          url: "<?php echo site_url(); ?>/api/patient_riwayat/",
          type: 'GET',
          dataType : 'json',
          success: function(response) {
              console.log(response);
              if(response.severity == "success"){
                if(response.content.patient.length > 0){
                  var str = '';
                  var idx = 1;
                  for(var a=0;a<response.content.patient.length;a++){
                    str += '<tr>';
                    str += '<td>' + idx + '</td>';
                    str += '<td>' + response.content.patient[a].name + '</td>';
                    str += '<td>' + response.content.patient[a].age + '</td>';
                    str += '<td>' + response.content.patient[a].gender + '</td>';
                    str += '<td>' + response.content.patient[a].address + '</td>';
                    str += '<td><a class="btn btn-primary form-control" href="<?php echo site_url('apps/download/'); ?>' + response.content.patient[a].id + '/" target="_blank">Download</a></td>';
                    str += '</tr>';
                    idx++;
                  }
                  $("#tabel_data").html(str);  
                }else{
                  $("#tabel_data").html('<tr><td colspan="6">Tidak ada data</td></tr>');
                }
              }else{
                $("#tabel_data").html('<tr><td colspan="6">Load data failed</td></tr>');
              }
          },
          error: function(response){
            alert("Load data failed!");
            $("#tabel_data").html('<tr><td colspan="6">Load data failed</td></tr>');
          },
          cache: false,
          contentType: false,
          processData: false
      });
    }
    
    riwayat();
    </script>
    <!-- /.container -->

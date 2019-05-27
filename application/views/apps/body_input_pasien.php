    <main role="main" class="container">
      <div class="container">
        <div class="row">
          <div class="col-lg-2"></div>
          <div class="col-lg-8">
            <form id="my_form" role="form" method="post" enctype="multipart/form-data">
              <table class="table table-striped table-bordered">
                <tr>
                  <td>Nama Pasien</td>
                  <td>:</td>
                  <td><input class="form-control" type="text" name="patient_name" id="patient_name" required></td>
                </tr>
                <tr>
                  <td>Umur</td>
                  <td>:</td>
                  <td><input class="form-control" type="number" name="patient_age" id="patient_age" required></td>
                </tr>
                <tr>
                  <td>Jenis Kelamin</td>
                  <td>:</td>
                  <td><input class="form-control" type="text" name="patient_gender" id="patient_gender" required></td>
                </tr>
                <tr>
                  <td>Alamat</td>
                  <td>:</td>
                  <td><textarea class="form-control" name="patient_address" id="patient_address" required></textarea></td>
                </tr>
                <tr>
                  <td colspan="3">
                    <button type="submit" id="btn_simpan" value="simpan" class="btn btn-primary form-control">Simpan Data Pasien</button>
                  </td>
                </tr>
                
              </table>
            </form>
          </div>
          <div class="col-lg-2"></div>
        </div>
      </div>
    </main>
    <script>
      $("form#my_form").submit(function(e) {
        var konfirmasi = confirm("Apakah Anda yakin akan menyimpan Data Pasien?");
        if(konfirmasi){
          e.preventDefault();    
          var formData = new FormData(this);
          $.ajax({
              url: "<?php echo site_url(); ?>/api/patient_insert/",
              type: 'POST',
              dataType : 'json',
              data: formData,
              success: function(response) {
                  console.log(response);
                  if(response.severity == "success"){
                    alert(response.message);
                    location.reload(); 
                  }else{
                    alert(response.message);
                  }
              },
              error: function(response){
                alert("Save data failed!");
              },
              cache: false,
              contentType: false,
              processData: false
          });
        }
      });
    </script>
    <!-- /.container -->

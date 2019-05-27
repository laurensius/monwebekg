    <main role="main" class="container">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <div id="box_link">
              <a div class="btn btn-primary form-control" href="<?php echo site_url('apps/input_pasien/') ?>">Input Pasien</a>
            </div>
            <div id="box_patient">
              <label>Nama Pasien</label>
              <h4><span id="name"></h4>
              <br>
              <label>Umur</label>
              <h4><span id="age"></h4>
              <br>
              <label>Jenis Kelamin</label>
              <h4><span id="gender"></h4>
              <br>
              <label>Alamat</label>
              <h4><span id="address"></h4>
              <br>
              <div id="start">
                <Button class="btn btn-primary form-control" onclick="start();" > Start EKG</button>
              </div>
              <br>
              <div id="stop">
                <Button class="btn btn-danger form-control" onclick="stop();" > Stop EKG</button>
              </div>
            </div>
          </div>
          <div class="col-lg-9">
          <div id="suhu_chart"></div>
          </div>
        </div>
      </div>
    </main>
    <script>
      var id_patient = "";
      var data_ = null;
      var grafik_suhu;

      function load_data_patient(){
        $.ajax({
            url: "<?php echo site_url(); ?>/api/patient_process/",
            type: 'GET',
            dataType : 'json',
            success: function(response) {
                console.log(response);
                if(response.severity == "success"){
                  if(response.content.patient.length > 0){
                    $("#box_patient").show();
                    $("#box_link").hide();
                    $("#name").html(response.content.patient[0].name);
                    $("#age").html(response.content.patient[0].age);
                    $("#gender").html(response.content.patient[0].gender);
                    $("#address").html(response.content.patient[0].address);    
                    id_patient = response.content.patient[0].id;
                  

                    if(response.content.patient[0].status == "PROCESS"){
                      setInterval(function(){monitoring();},1000);
                    }

                    if(response.content.patient[0].status == "OPEN"){
                      $("#start").show();
                      $("#stop").hide();
                    }else{
                      $("#start").hide();
                      $("#stop").show();
                    }
                  }else{
                    $("#box_patient").hide();
                    $("#box_link").show();
                  }
                }else{
                  $("#box_patient").hide();
                  $("#box_link").show();
                  alert(response.message);
                }
            },
            error: function(response){
              console.log(response);
              $("#box_patient").hide();
              $("#box_link").show();
              alert("Load data failed!");
            },
            cache: false,
            contentType: false,
            processData: false
        });
      }

      grafik_suhu = Morris.Area({
            element: 'suhu_chart',
            data: data_,
            xkey: 'datetime',
            ykeys: ['bpm'],
            labels: ['BPM'],
            parseTime: false,
            fillOpacity: 0.4,
            hideHover: 'auto',
            behaveLikeLine: true,
            resize: true,
            pointFillColors: ['#ffffff'],
            pointStrokeColors: ['black'],
            lineColors: ['red', 'blue']
            }).on('click', function(i, row){
            console.log(i, row);
        });

      function monitoring(){
        $.ajax({
            url : '<?php echo site_url("api/bpm_monitoring/") ?>' + id_patient + "/" + Math.random() + "/" ,
            type : 'GET',
            dataType : 'json',
            cache: false,
            contentType: false,
            processData: false,
            success : function(response){
                console.log("monitoring");
                if(response.severity == "success"){
                  if(response.content.BPM.length > 0){
                    grafik_suhu.setData(response.content.BPM);
                  }
                }
            },
            error : function(response){
                console.log(response);
            },
        });
      }
    
      function start(){
        update_status("start","PROCESS");
        location.reload();
      }

      function stop(){
        update_status("stop","CLOSE");
        location.reload();
      }

      function update_status(next, status){
        var konfirmasi = confirm("Apakah Anda yakin akan " + next + " proses monitoring?");
        if(konfirmasi){
          $.ajax({
              url: "<?php echo site_url("/api/patient_status_update/"); ?>" + id_patient + "/" + status + "/",
              type: 'GET',
              dataType : 'json',
              success: function(response) {
                  console.log(response);
                  if(response.severity == "success"){
                    if(next == "start"){
                      setInterval(function(){monitoring();},1000);
                      $("#start").hide();
                      $("#stop").show();
                    }else
                    if(next == "stop"){
                      $("#start").hide();
                      $("#stop").hide();
                    }
                  }else{
                    alert("Proses gagal. Silakan coba lagi");
                  }
              },
              error: function(response){
                alert("Proses gagal. Silakan coba lagi");
              },
              cache: false,
              contentType: false,
              processData: false
          });
        }
      }

      load_data_patient();
    </script>
    <!-- /.container -->

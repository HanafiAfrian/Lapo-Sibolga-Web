<div class="ps-page--single">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="#">Members</a></li>
                <li><?php echo $title; ?></li>
            </ul>
        </div>
    </div>
</div>
<div class="ps-vendor-dashboard pro" style='margin-top:10px'>
  <div class="container">
    <div class="ps-section__content"><br>
      <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 ">
          <?php
          $attributes = array('id' => 'formku');
          echo form_open_multipart('members/edit_profil_toko',$attributes); 
            $row = $this->db->query("SELECT * FROM rb_konsumen where id_konsumen='".$this->session->id_konsumen."'")->row_array();
            if (trim($rows['foto'])==''){ $foto_user = 'toko.jpg'; }else{ $foto_user = $rows['foto']; } 
            echo "<img class='rounded-circle' style='width:100%' src='".base_url()."asset/foto_user/$foto_user'>
            <input class='required number form-control form-mini' type='file' name='gg'><small><center>Allowed : gif, jpg, png, jpeg (Max 1 MB)</center></small><br>
                    <button type='submit' id='assign' name='submit' class='ps-btn btn-block spinnerButton'><center><i class='icon-pen'></i> Simpan Perubahan</center></button>
          <div style='clear:both'><br></div>";
          ?>
        </div>

        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 ">
            <figure class="ps-block--vendor-status biodata">
            <?php 
              echo "<p style='font-size:17px'>Hai <b>$row[nama_lengkap]</b>, selamat datang di halaman Informasi Toko anda! <br>
                                              Pastikan data toko anda sudah benar dan lengkap untuk kemudahan dalam bertransaksi.</p><br>

              <div class='form-group row' style='margin-bottom:5px'>
              <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Nama Toko</b></label>
                <div class='col-sm-9'>
                  <input class='form-control form-mini' type='text' name='c' value='$rows[nama_reseller]'>
                </div>
              </div>
              
              <div class='form-group row' style='margin-bottom:5px'>
              <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Daerah Pengiriman</b></label>
              <div class='col-sm-9'>
                <div class='row'>
                  <div class='col'>
                    <select class='form-control form-mini' name='provinsi_id' id='list_provinsi' required>";
                    echo "<option value=0>- Pilih Provinsi -</option>";
                      $provinsi = $this->db->query("SELECT * FROM tb_ro_provinces ORDER BY province_name ASC");
                      foreach ($provinsi->result_array() as $row) {
                        if ($rows['provinsi_id']==$row['province_id']){
                          echo "<option value='$row[province_id]' selected>$row[province_name]</option>";
                        }else{
                          echo "<option value='$row[province_id]'>$row[province_name]</option>";
                        }
                      }
                    echo "</select>
                  </div>
                  <div class='col'>
                    <select class='form-control form-mini' name='kota_id' id='list_kotakab' required>";
                    echo "<option value=0>- Pilih Kota / Kabupaten -</option>";
                      $kota = $this->db->query("SELECT * FROM tb_ro_cities where province_id='$rows[provinsi_id]' ORDER BY city_name ASC");
                      foreach ($kota->result_array() as $row) {
                        if ($rows['kota_id']==$row['city_id']){
                          echo "<option value='$row[city_id]' selected>$row[city_name]</option>";
                        }else{
                          echo "<option value='$row[city_id]'>$row[city_name]</option>";
                        }
                      }
                    echo "</select>
                  </div>
                  <div class='col'>
                    <select class='form-control form-mini' name='kecamatan_id' id='list_kecamatan' required>";
                    echo "<option value=0>- Pilih Kecamatan -</option>";
                      $subdistrict = $this->db->query("SELECT * FROM tb_ro_subdistricts where city_id='$rows[kota_id]' ORDER BY subdistrict_name ASC");
                      foreach ($subdistrict->result_array() as $row) {
                        if ($rows['kecamatan_id']==$row['subdistrict_id']){
                          echo "<option value='$row[subdistrict_id]' selected>$row[subdistrict_name]</option>";
                        }else{
                          echo "<option value='$row[subdistrict_id]'>$row[subdistrict_name]</option>";
                        }
                      }
                    echo "</select>
                  </div>
                </div>
              </div>
              </div>
              
              <div class='form-group row' style='margin-bottom:5px'>
              <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Alamat Lengkap</b></label>
                <div class='col-sm-9'>
                <input type='text' name='e' class='form-control form-mini' value='$rows[alamat_lengkap]'>
                </div>
              </div>
              
              <div class='form-group row' style='margin-bottom:5px'>
              <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Kontak Toko</b></label>
                <div class='col-sm-9'>
                  <input type='text' name='f' class='form-control form-mini' value='$rows[no_telpon]'>
                </div>
              </div>
              
              <div class='form-group row' style='margin-bottom:5px'>
              <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Kurir Anda Support</b></label>
                <div class='col-sm-9'>
                  <select class='form-mini' id='multiple_select' multiple='multiple'>";
                      $no = 0;
                      $kurir_data = $this->model_app->view_ordering('rb_kurir','id_kurir','ASC');
                      $kurir_terpilih = explode(',',$rows['pilihan_kurir']);
                      foreach ($kurir_data as $rowk) {
                        $print_selected = ''; 
                        foreach ($kurir_terpilih as $select_option){
                          if($rowk['id_kurir'] == $select_option) {
                            $print_selected = 'selected';
                            // break `foreach` as you found the right item
                            break;
                          }
                        }
                        echo "<option value='$rowk[id_kurir]' $print_selected>$rowk[nama_kurir]</option>";
                        $no++;
                      }
                  echo "</select>
                  <input type='hidden' name='pilihan_kurir' value=''>
              </div>
              </div>
              
              <div class='form-group row' style='margin-bottom:5px'>
              <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Keterangan</b></label>
                <div class='col-sm-9'>
                  <textarea class='form-control' style='height:140px' name='i'>$rows[keterangan]</textarea>
                </div>
              </div>
              
              <div class='form-group row' style='margin-bottom:5px'>
              <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Kordinat Lokasi</b></label>
                <div class='col-sm-9'>
                  <input type='text' class='form-control form-mini btn-geolocationx' value='$rows[kordinat]' name='lokasi' id='lokasi' autocomplete='off' />
                  <label class='switch mr-1 mt-2'>
                      <input type='checkbox' name='alamat_lainx' id='alamat_lain'> Cari Kordinat dari Peta
                  </label>
                </div>
              </div>
              
              <div class='show-map'>
                  <div id='mapid' class='shadow-sm'></div>
              </div>";
              echo form_close();
            ?>
            </figure>
          </div>
        </div>
      </div>
    </div>
</div>
<script>
$('document').ready(function(){
    $('#assign').click(function(){
    var ag = $('#multiple_select').val();
        $('[name="pilihan_kurir"]').val(ag);
    });

    $("body").on("click", "input[name='alamat_lainx']", function () {
      if ($('#alamat_lain').is(':checked')) {
        $(".show-map").show();
        showMapsx();
      }else{
        $(".btn-geolocationx").val('');
        $(".show-map").hide();
      }
    });
});

function showMapsx() {
  // MAPS
  var mymap = L.map("mapid").setView(
    [<?php echo ($rows['kordinat']==''?config('kordinat'):$rows['kordinat']); ?>],
    15
  );
  L.tileLayer(
    "https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw", {
      maxZoom: 18,
      attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
      id: "mapbox/streets-v11",
      tileSize: 512,
      zoomOffset: -1,
    }
  ).addTo(mymap);

  L.marker([<?php echo ($rows['kordinat']==''?config('kordinat'):$rows['kordinat']); ?>])
    .addTo(mymap)
    .bindPopup("Silahkan klik map untuk mendapatkan koordinat.")
    .openPopup();

  var popup = L.popup();

  function onMapClick(e) {
    popup
      .setLatLng(e.latlng)
      .setContent(
        "Map yang anda klik berada di " + e.latlng.lat + ", " + e.latlng.lng
      )
      .openOn(mymap);
    document.getElementById("lokasi").value =
      e.latlng.lat + ", " + e.latlng.lng;
  }

  mymap.on("click", onMapClick);
}

$(window).ready(function () {
  $(".btn-geolocationx").click(findLocationx);
});

function findLocationx() {
  navigator.geolocation.getCurrentPosition(getCoordsx, handleErrorsx);
}

function getCoordsx(position) {
  $(".btn-geolocationx").val(
    position.coords.latitude + "," + position.coords.longitude
  );
}

function handleErrorsx(error) {
  switch (error.code) {
    case error.PERMISSION_DENIED:
      alert("You need to share your geolocation data.");
      break;

    case error.POSITION_UNAVAILABLE:
      alert("Current position not available.");
      break;

    case error.TIMEOUT:
      alert("Retrieving position timed out.");
      break;

    default:
      alert("Error");
      break;
  }
}
</script>

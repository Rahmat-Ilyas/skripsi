<!doctype html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
        <link rel="stylesheet" href="assets/toastr/toastr.min.css">

        <title>Aplikasi Sinkronisai Data - Macca Mart</title>

        <style type="text/css">
            .preloader {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 9999;
                background-color: #fff;
            }
            .loading {
                position: absolute;
                left: 50%;
                top: 45%;
                transform: translate(-50%,-50%);
                font: 18px;
            }
            .progres {
                width: 45%;
                position: relative;
                left: 50%;
                top: 51%;
                transform: translate(-50%,-50%);
                font-size: 14px;
            }
        </style>
    </head>
    <body>
        <!-- Just an image -->
        <nav class="navbar navbar-primary bg-primary">
            <a class="navbar-brand" href="#">
                <img src="assets/img/logo.png" height="75" alt="">
            </a>
            <div class="text-center pr-2">
                <h4 class="text-white">Sinkronisasi Data Penjualan</h4>
                <h4 class="text-white">Sistem Forecasting Macca Mart</h4>
            </div>
        </nav>

        <div class="container pt-5 mt-5">
            <div class="row justify-content-center mb-5">
                <div class="col-7">
                    <input type="hidden" id="tanggal-sinkron">
                    <button class="btn btn-lg btn-success btn-block font-weight-bold" style="border-radius: 30px; font-size: 20px;" id="sinkron-act"><i class="fa fa-lg fa-sync"></i>&nbsp; Sinkronkan Data</button>
                    <label class="mb-0 mt-2">Sinkron Otomatis:</label>
                    <select class="form-control form-control-sm">
                        <option value="false">Tidak Aktif</option>
                        <option value="15">Setiap 15 Menit</option>
                        <option value="30">Setiap 30 Menit</option>
                        <option value="60">Setiap 1 Jam</option>
                        <option value="120">Setiap 2 Jam</option>
                        <option value="720">Setiap 12 Jam</option>
                        <option value="1440">Setiap 1 Hari</option>
                    </select>
                </div>
            </div>
            <div>
                <h5>Riwayat Sinkronisasi</h5>
                <div style="height: 170px; overflow: scroll; overflow-x: hidden;">
                    <table class="table table-bordered" style="font-size: 12px;">
                        <thead class="sticky-top bg-secondary text-white">
                            <tr>
                                <th width="10">No</th>
                                <th>Tanggal Sinkron</th>
                                <th>Jam</th>
                                <th>Jumlah Data</th>
                            </tr>
                        </thead>
                        <tbody id="data-sinkron">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->

        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/toastr/toastr.min.js"></script>
    </body>
    <div class="preloader">
        <div class="loading">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div class="progres text-center">
            <span>Mengsinkronkan data...</span>
        </div>
    </div>
    <script>
        jQuery(document).ready(function($) {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "positionClass": "toast-bottom-right",
                "fadeIn": 300,
            };

            $(".preloader").hide();

            var url = "http://macca-mart.com/api";
            var headers = {
                "Authorization": "Bearer ftFN0jVwPHnzuuraiUwnyKafrd2dcErZHzYW3IHlSBFw0Ak0lTp9DwCoV1XiuwwNCJCGhFJD9uxisvQE",
                "Content-Type": "application/json; charset=utf-8",
            };

            getData();

            $('#sinkron-act').click(function(e) {
                e.preventDefault();

                $(".preloader").fadeIn("slow");

                pushData();
            });

            function pushData() {
                $.ajax({
                    type: "GET",
                    url: url + "/get-count-data",
                    headers: headers,
                    crossDomain: true,
                    dataType: "json",
                    data: {},
                    success: function (data) {
                        $.ajax({
                            type: "POST",
                            url: "controller.php",
                            dataType: "json",
                            data: {
                                get_data: true,
                                data: data,
                            },
                            success: function (data) {
                                var loop = data.loop;
                                $.ajax({
                                    type: "POST",
                                    url: url + "/sinkron",
                                    headers: headers,
                                    crossDomain: true,
                                    dataType: "json",
                                    data: JSON.stringify(data.data),
                                    success: function (datax, status, jqXHR) {
                                        if (loop) {
                                            pushData()
                                        } else {   
                                            $(".preloader").fadeOut("slow");
                                            toastr.success("Sinkronisasi berhasil dilakukan pada <?= date('d/m/Y H:i') ?>");
                                            getData();
                                        }
                                    },
                                    error: function (jqXHR, status) {
                                        toastr.error("Sinkronisasi tidak berhasil. Terjadi kesalahan");
                                        $(".preloader").fadeOut("slow");
                                    }
                                });
                            }
                        });                           
                    }
                });
            }

            function getData() {
                $.ajax({
                    type: "GET",
                    url: url + "/get-data-sinkron",
                    headers: headers,
                    crossDomain: true,
                    dataType: "json",
                    data: {},
                    success: function (data, status, jqXHR) {
                        if (data.length > 0) {
                            var htmldata = '';
                            var no = 1;
                            $.each(data, function(key, val) {
                                var dt = new Date(val.created_at);
                                if (month < 10) month = '0'+month;
                                if (dt.getDate() < 10) date = '0'+dt.getDate();
                                var date = dt.getDate() < 10 ? '0' + dt.getDate() : dt.getDate();
                                var month = dt.getMonth() < 10 ? '0' + dt.getMonth() : dt.getMonth();
                                var tggl = date + '/' + month + '/' + dt.getFullYear();

                                var jam = dt.getHours() < 10 ? '0' + dt.getHours() : dt.getHours();
                                var mnt = dt.getMinutes() < 10 ? '0' + dt.getMinutes() : dt.getMinutes();
                                var waktu = jam + ':' + mnt;

                                htmldata += '<tr>';
                                htmldata += '<td>' + no + '</td>';
                                htmldata += '<td>' + tggl + '</td>';
                                htmldata += '<td>' + waktu + '</td>';
                                htmldata += '<td>' + val.jumlah_data + ' Data</td>';
                                htmldata += '</tr>';
                                no++;
                            });

                        } else {
                            var htmldata = '<tr><td colspan="4" class="text-center">Belum ada data</td></tr>';
                        }

                        $('#data-sinkron').html(htmldata);                        
                    }
                });
            }
        });
    </script>
    </html>

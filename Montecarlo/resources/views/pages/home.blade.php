@extends('layouts.admin-area')

@section('title')
    Simulasi Monte Carlo
@endsection

@section('admincontent')
<body>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Simulasi Monte Carlo</h1>
        </div>

        <div class="section-body">
            
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="col">
                                <div class="row">
                                    <h4>Apa itu Simulasi Montecarlo?</h4>
                                </div>
                            </div>
                            
                        </div>
                        <div class="card-body">
                            <p>Simulasi Monte Carlo adalah metode yang digunakan dalam memodel dan menganalisa sistem 
                                yang mengandung resiko dan ketidak-pastian. Pada bidang manajemen proyek, simulasi Monte 
                                Carlo dapat mengkuantifikasi akibat-akibat dari resiko dan ketidak-pastian yang umum terjadi 
                                dalam jadwal dan biaya sebuah proyek.
                            </p>
                            <a href="https://media.neliti.com/media/publications/221544-aplikasi-simulasi-monte-carlo-dalam-esti.pdf">Fadjar, A. (2008).<em>APLIKASI SIMULASI MONTE CARLO DALAM ESTIMASI BIAYA PROYEK.</em></a>    
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="col">
                                <div class="row">
                                    <h4>Penggunaan Simulasi Monte Carlo</h4>
                                </div>
                            </div>
                            
                        </div>
                        <div class="card-body">
                            <li>
                                Merupakan simulasi yang bersifat probabilistik, dimana suatu solusi dari suatu masalah diberikan berdasarkan proses randomisasi
                            </li>
                            <li>
                                Metode yang digunakan untuk memodelkan dan menganalisa sistem yang mengandung unsur resiko dan ketidakpastian.
                            </li>    
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="col">
                                <div class="row">
                                    <h4>Mulai Simulasi</h4>
                                </div>
                            </div>
                            
                        </div>
                        <div class="card-body">
                            <p>Sebelum memulai simulasi perhatikan hal berikut ini:</p>
                            <li>
                                File yang diunggah hanya mendukung format <b>.csv</b>
                            </li>
                            <li>
                                Buat tabel seperti gambar berikut:
                            </li>
                            <ul><img src="/Image/1.jpg" style="text-align: center"></ul>
                            <ul>
                                <li><b>Kolom A</b> diisi oleh nama Bulan <br></li>
                                <li><b>Nama Bulan</b> hanya bisa diisi sebanyak <b>12</b></li>
                                <li><b>Kolom B</b> diisi oleh jumlah tok Darah</li>
                            </ul>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-12 col-sm-12" style="margin-top: 6cm">
                    <div class="card">
                        <div class="col-12">
                            <div class="card">
                              <div class="card-header">
                                <h4>Upload File</h4>
                              </div>
                              <div class="card-body">
                                <a class="btn btn-success" href="javascript:void(0)" id="import"> Tambah Data</a>
                            </form>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
        </div>
    </section>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="montecarloModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalHeading">Import CSV</h4>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">
                <form action="import" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="input-group mb-3">
                        <input type="file" name="file" class="form-control">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
@endsection

@push('prepend-script')
    <script>
        $('#import').click(function(){
            $('#montecarloModal').modal('show');
        });

        @if (session('success')){
            swal('Data Berhasil Disimpan!', '', 'success');
            // $('#montecarloTable tbody').append('"');
        }
        @endif

        $('#delete').click(function(){
            swal({
                text: "Apakah kamu yakin akan menghapus data ini?",
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete){
                    $.ajax({
                        type: "GET",
                        url: "/delete/",
                        success: function() 
                        {
                            swal("Poof! Your imaginary file has been deleted!", 
                            {
                                icon: "success",
                            })
                            .then(okay => {
                                if (okay){
                                    window.location.href = "/home";
                                }
                            })
                        },
                    });
                } 
                else {
                }
            });
        });
    </script>
@endpush
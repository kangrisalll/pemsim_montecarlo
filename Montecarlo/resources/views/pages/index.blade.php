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

                <div class="row" >
                    <div class="col-lg-5 col-md-12 col-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="col">                               
                                    <div class="row" style="margin-top: 5px">
                                        <h3>Data Persediaan Darah</h3>
                                    </div>
                                    <div class="row" style="margin-top: 10px">
                                        <a class="btn btn-danger" href="javascript:void(0)" id="delete" style="margin-left: 10px"> Hapus Data</a>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-md" id="montecarloTable">
                                        <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Bulan</th>
                                            <th>Persediaan Darah</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($montecarlo as $key => $item)
                                                <tr>
                                                    <th scope="row">{{ ++$key }}</th>
                                                    <td>{{ $item->bulan}}</td>
                                                    <td style="text-align: center">{{  number_format($item->nilai),2 }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <th colspan="2" style="vertical-align : middle;text-align:center;">Total</th>
                                                <td style="text-align: center">{{ number_format($nilaisum,0) }}</td>
                                            </tr>    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="col-lg-7 col-md-12 col-12 col-sm-12" style="margin-top: 4cm">
                        <div class="card">
                          <div class="card-body">
                              <div class="chartjs-size-monitor">
                                  <div class="chartjs-size-monitor-expand"><div class="">
                                      </div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class="">
                                            </div>
                                        </div>
                                    </div>
                            <canvas id="myChart" height="384" style="display: block; width: 633px; height: 384px;" width="633"></canvas>
                          </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="col">
                                <div class="row" style="margin-top: 5px">
                                    <h3>Menghitung Nilai Probabilitas</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md" id="categoryTable">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Bulan</th>
                                        <th>Frekuensi</th>
                                        <th>Probabilitas</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($montecarlo as $key => $item)
                                            <tr>
                                                <th scope="row">{{ ++$key }}</th>
                                                <td>{{ $item->bulan}}</td>
                                                <td>{{  number_format($item['nilai']),2 }}</td>
                                                <td>{{number_format ($item['nilai']/$item->sum('nilai'),3)}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="col">
                                <div class="row" style="margin-top: 5px">
                                    <h3>Menghitung Nilai Kumulatif</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md" id="categoryTable">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Bulan</th>
                                        <th>Frekuensi</th>
                                        <th>Probabilitas</th>
                                        <th>Kumulatif</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $k = 0;
                                        @endphp
                                        @for ($i = 0; $i<=11; $i++) 
                                            <tr>
                                                <th scope="row">{{$i+1}}</th>
                                                <td>
                                                    @foreach ($bulanscnd[$i] as $item)
                                                        {{$item}}    
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($nilaiscnd[$i] as $nilai)
                                                        {{ number_format($nilai,0) }}    
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($nilaiscnd[$i] as $nilaiprob)
                                                        {{number_format($a=$nilaiprob/$nilaisum,3) }}    
                                                    @endforeach
                                                </td>
                                                <td>{{number_format($k=$a+$k,3)}}</td>
                                            </tr>    
                                        @endfor                                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <form action="{{route('interval')}}" method="post">
                        <div class="card-header">
                            
                                <div class="col">
                                    <div class="row" style="margin-top: 5px">
                                        <h3>Menentukan Nilai Interval</h3>
                                    </div>
                                    <div class="row" style="margin-top: 10px">
                                        <a class="btn btn-success" type="submit" style="margin-left: 10px">Simpan data Interval</a>
                                    </div>
                                </div>
                        </div>
                        <div class="card-body">
                            
                            <div class="table-responsive">
                                <table class="table table-bordered table-md" id="categoryTable">
                                    <thead>
                                    <tr>
                                        <th rowspan="2" style="vertical-align : middle;text-align:center;">No.</th>
                                        <th rowspan="2" style="vertical-align : middle;text-align:center;">Bulan</th>
                                        <th rowspan="2" style="vertical-align : middle;text-align:center;">Frekuensi</th>
                                        <th rowspan="2" style="vertical-align : middle;text-align:center;">Probabilitas</th>
                                        <th rowspan="2" style="vertical-align : middle;text-align:center;">Komulatif</th>
                                        <th colspan="8" style="vertical-align : middle;text-align:center;">Interval</th>

                                    </tr>
                                    <tr>
                                        <th style="vertical-align : middle;text-align:center;">Min</th>
                                        <th style="vertical-align : middle;text-align:center;">Max</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $k = 0;
                                            $intervalmax = 0;
                                            $intervalmin = 1;
                                        @endphp
                                        @for ($i = 0; $i<=11; $i++) 
                                            <tr>
                                                <th scope="row">{{$i+1}}</th>
                                                <td>
                                                    @foreach ($bulanscnd[$i] as $item)
                                                        {{$item}}    
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($nilaiscnd[$i] as $nilai)
                                                        {{ number_format($nilai,0) }}    
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($nilaiscnd[$i] as $nilaiprob)
                                                        {{ number_format($a=$nilaiprob/$nilaisum,3) }}    
                                                    @endforeach
                                                </td>
                                                <td>{{ number_format($k=$a+$k,3) }}</td>
                                                <td>{{ $intervalmin = intval($intervalmax+1)  }}</td>
                                                <td>{{ $intervalmax = intval($k*100) }}</td>
                                            </tr>    
                                        @endfor                                                        
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </form>
                    </div>
                </div>

                <section id="randomnumber">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="col">                               
                                        <div class="row" style="margin-top: 5px">
                                            <h3>Angka Acak (Random)</h3>
                                        </div>
                                        <div class="row" style="margin-top: 10px">
                                            <a class="btn btn-success" onClick="window.location.reload();" href="/proses#randomnumber" id="generate" style="margin-left: 10px">Generate</a>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-md" id="montecarloTable">
                                            <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Angka Random</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $range = range($intervalmin, $intervalmax);
                                                    $numberrandom = 0;
                                                    
                                                @endphp
                                                @for ($i = 0; $i<=11; $i++)
                                                    <tr>
                                                        <td>{{$i+1}}</td>
                                                        <td>
                                                            @foreach ($nilairandom[$i] as $nilairand)
                                                            {{ $nilairand }}    
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                        
                                                @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="col">
                                        <div class="row" style="margin-top: 5px">
                                            <h3>Hasil Simulasi</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-md" id="categoryTable">
                                            <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Bulan</th>
                                                <th>Angka Acak</th>
                                                <th>Frekuensi</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @for ($i = 0; $i<=11; $i++) 
                                                    <tr>
                                                        <th scope="row">{{$i+1}}</th>
                                                        <td>
                                                            @foreach ($bulanscnd[$i] as $item)
                                                                {{$item}}    
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach ($nilairandom[$i] as $nilairand)
                                                                {{ $nilairand }}    
                                                            @endforeach  
                                                        </td>
                                                        <td>
                                                            @foreach ($hasil[$i] as $nilaihasil)
                                                                {{ $nilaihasil }}    
                                                            @endforeach
                                                        </td>
                                                    </tr>    
                                                @endfor                                                        
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
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

{{-- <div class="modal fade" tabindex="-1" id="categoriesModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="modalHeading"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="categoriesForm" name="categoriesForm" class="form-horizontal">
                <div class="row">
                    <div class="col-12 col-md-6 col-sm-6" id="showerror">
                        
                    </div>
                </div>
                <input type="hidden" name="categories_id" id="categories_id">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-file"></i>
                        </div>
                    </div>
                    <input type="text" id="categories_name" name="categories_name" placeholder="Nama Kategori" value="" class="form-control" required>
                    @if ($errors->has('categories_name'))
                        <span class="text-danger">{{ $errors->first('categories_name') }}</span>
                    @endif
                    
                    @error('categories_name')
                        <span class="text-danger">TESSSTTTT</span>
                    @enderror
                    
                </div>
                <span class="text-danger" id="categories_nameError"></span>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="submit" class="btn btn-primary" id="saveBtn" value="">Save changes</button>
            </div>
            </form>
      </div>
    </div>
</div> --}}

</body>
{{-- @livewire('admin.categories') --}}

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
    <script>
        const labels = [
            @foreach ($montecarlo as $key => $item)
                '{{$item->bulan}}', 
            @endforeach                                
        ];
      
        const data = {
          labels: labels,
          datasets: [{
            label: 'Persediaan Darah',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [
                @foreach ($montecarlo as $key => $item)
                '{{$item->nilai}}', 
                @endforeach
            ],
          }]
        };
      
        const config = {
          type: 'line',
          data: data,
          options: {}
        };
      </script>

      <script>
        const myChart = new Chart(
          document.getElementById('myChart'), config
        );
      </script>
@endpush

{{-- @include('pages.admin.categories.edit') --}}


{{-- @push('prepend-script')
    <script>

        $(function () {
        
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        var table = $('#categoryTable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            paging: false, 
            info: false,
            // ordering: false,
            searching: false,
            order:  [[ 0, 'desc' ]],
            ajax: "{{ route('categories.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'categories_name', name:'categories_name'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            
        });

        $('#createNewCategories').click(function(){
            $('#saveBtn').val("create-categories");
            $('#categories_id').val('');
            $('#categoriesForm').trigger("reset");
            $('#modalHeading').html("Tambah Category");
            $('#categoriesModal').modal('show');
            $('#saveBtn').html('Save Changes');
            $('#categories_nameError').text('');
            $("#categories_name").removeClass('is-invalid');
        });
        
        $('body').on('click', '.editCategories', function () {
            var categories_id = $(this).data('id');
            $.get("{{ route('categories.index') }}" +'/' + categories_id +'/edit', function (data) {
                $('#modalHeading').html("Edit Category");
                $('#saveBtn').val("edit-categories");
                $('#saveBtn').html('Save Changes');
                $('#categoriesModal').modal('show');
                $('#categories_nameError').text('');
                $("#categories_name").removeClass('is-invalid');
                $('#categories_id').val(data.id);
                $('#categories_name').val(data.categories_name);
            })
        });
        
        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Sending..');
        
            $.ajax({
                data: $('#categoriesForm').serialize(),
                url: "{{ route('categories.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    // $('#categories_nameError').text(data.responseJSON.errors.categories_name);
                    $('#categoriesForm').trigger("reset");
                    $('#categoriesModal').modal('hide');
                    // $('#categories_nameError').text(data.responseJSON.errors.categories_name);
                    table.draw();
                    swal('Data Berhasil Disimpan!', '', 'success');
                    // console.log('form: '+result);  
                    $('#saveBtn').html('Save Changes');
                },
                error: function (data) {
                    $("#categories_name").addClass('is-invalid');
                    // console.log(errors.categories_name);
                    // $('#categories_nameError').text(data.responseJSON.errors.categories_name);
                    $('#categories_nameError').text(data.responseJSON.errors.categories_name);
                    // $('#categories_nameError').text(xhr.responseText);
                    // console.log('Error:', data);
                    // swal(data, $errors, 'error');
                    $('#saveBtn').html('Save Changes');
                }
            });
            
        });
    
        $('body').on('click', '.deleteCategories', function (){
            var categories_id = $(this).data("id");
            // var text = (this).prop("categories_name");
            swal({
                text: "Apakah kamu yakin akan menghapus kategori ini?",
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete){
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('categories.store') }}"+'/'+ categories_id,
                    
                    success: function (data) {
                        table.draw();
                        swal('Data berhasil dihapus!', {
                        icon: 'success',
                        });
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            } 
            else {
            }
            });

        });
    });
    </script>
@endpush --}}

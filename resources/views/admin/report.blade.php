@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-4">
            <div class="card-header border-bottom">
                <h5 class="mb-0">
                    Profits
                </h5>
            </div>
            <div class="card-body p-4">
                <div id="profit" style="width: 100%;"></div>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    Stock Barang
                </h5>
                {{-- <a href="{{route('admin.transactions.index')}}" class="d-flex align-items-center">View all transactions <i class="ti ms-2 ti-chevron-right"></i></a> --}}
            </div>
            <div class="card-body p-4 border-top">
                <table class="table table-striped datatable">
                    <thead>
                    <tr>
                        <td>#</td>
                        <td>Nama Barang</td>
                        <td>Brand</td>
                        <td>Price</td>
                        <td>Model Barang</td>
                        <td>Stock</td>
                        

                    </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Models\Barang::all() as $i => $barang)
                        <tr>
                            <td>{{$i+1}}</td>
                            <td>{{$barang->product_name}}</td>
                            <td>{{$barang->brand}}</td>
                            <td>{{$barang->price}}</td>
                            <td>{{$barang->model_no}}</td>
                            <td>{{\App\Models\SerialNumber::where('product_id', $barang->id)->where('used', 0)->count()}}</td>  
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var profitOptions = {
            series: [ {
                name: "Profit",
                data: {!! $profits->values() !!}
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            colors: [
                '#353535'
            ],
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 8
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: {!! $profits->keys() !!},
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val.toLocaleString('id-ID', {
                            style: 'currency',
                            currency: 'IDR',
                            minimumFractionDigits: 0,
                            maximumFractionDigits: 0,
                        })
                    }
                }
            }
        };

        var profit = new ApexCharts(document.querySelector("#profit"), profitOptions);
        profit.render();
    </script>
@endsection

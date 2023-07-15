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

        <div class="card mb-4">
            <div class="card-header border-bottom">
                <h5 class="mb-0">
                    Products Sold by Brand
                </h5>
            </div>
            <div class="card-body p-4">
                <div id="brand" style="width: 100%;"></div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header border-bottom">
                <h5 class="mb-0">
                    Products Sold by Category
                </h5>
            </div>
            <div class="card-body p-4">
                <div id="category" style="width: 100%;"></div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header border-bottom">
                <h5 class="mb-0">
                    Most Popular Products
                </h5>
            </div>
            <div class="card-body p-4">

                <div class="row">
                    @foreach($popular_products as $product)
                        <div class="col-md-3">
                            <div class="card shadow-none bg-transparent border-1">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{$product->brand->logo}}" alt="{{$product->brand->name}}" style="height: 32px;" class="me-2">
                                    </div>
                                    <h5 class="card-title">{{$product->name}}</h5>
                                    <img class="img-fluid d-flex mx-auto my-3 rounded" src="{{ $product->image }}" alt="{{ $product->name }}">
                                    <div class="mb-3">
                                        <h4 class="card-text mb-0">
                                            {{$product->sold}} <span class="fw-normal">items sold</span>
                                        </h4>
                                    </div>
                                    <div class="row align-items-center d-flex">
                                        <div class="col-12">
                                            <a href="javascript:void(0);" class="btn btn-outline-primary card-link w-100 text-center">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header border-bottom">
                <h5 class="mb-0">
                    Least Popular Products
                </h5>
            </div>
            <div class="card-body p-4">

                <div class="row">
                    @foreach($unpopular_products as $product)
                        <div class="col-md-3">
                            <div class="card shadow-none bg-transparent border-1">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{$product->brand->logo}}" alt="{{$product->brand->name}}" style="height: 32px;" class="me-2">
                                    </div>
                                    <h5 class="card-title">{{$product->name}}</h5>
                                    <img class="img-fluid d-flex mx-auto my-3 rounded" src="{{ $product->image }}" alt="{{ $product->name }}">
                                    <div class="mb-3">
                                        <h4 class="card-text mb-0">
                                            {{$product->sold}} <span class="fw-normal">items sold</span>
                                        </h4>
                                    </div>
                                    <div class="row align-items-center d-flex">
                                        <div class="col-12">
                                            <a href="javascript:void(0);" class="btn btn-outline-primary card-link w-100 text-center">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var brandOptions = {
            series: [
                {
                    name: 'Sold',
                    data: {!! $brands->values() !!}
                },
            ],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: {!! $brands->keys() !!},
            },
            yaxis: {
                title: {
                    text: 'Items Sold'
                }
            },
            colors: [
                '#353535'
            ],
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val + " items"
                    }
                }
            }
        };

        var brand = new ApexCharts(document.querySelector("#brand"), brandOptions);
        brand.render();

        var categoryOptions = {
            series: [
                {
                    name: 'Sold',
                    data: {!! $categories->values() !!}
                },
            ],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: {!! $categories->keys() !!},
            },
            yaxis: {
                title: {
                    text: 'Items Sold'
                }
            },
            fill: {
                opacity: 1
            },
            colors: [
                '#353535'
            ],
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val + " items"
                    }
                }
            }
        };

        var category = new ApexCharts(document.querySelector("#category"), categoryOptions);
        category.render();


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

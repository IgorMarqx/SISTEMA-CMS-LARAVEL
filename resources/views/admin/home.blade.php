@extends('adminlte::page')

@section('plugins.Chartjs', true)

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@endsection

@section('content')
    <div class="row">

        <a href="#" class="col-md-6">
            <div class="info-box bg-white ">
                <span class="info-box-icon bg-info elevation-1">
                    <i class="fa-solid fa-eye text-white text-lg"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text text-info">Acessos</span>
                    <span class="info-box-number text-info text-lg">{{ $visitsCount }}</span>
                </div>
            </div>
        </a>

        <a href="#" class="col-md-6">
            <div class="info-box bg-white">
                <span class="info-box-icon bg-warning elevation-1">
                    <i class="fa-solid fa-file text-white"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text text-warning">Páginas</span>
                    <span class="info-box-number text-warning text-lg">{{ $pageCount }}</span>
                </div>
            </div>
        </a>


    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Páginas mais visitadas
                    </h3>
                </div>

                <div class="card-body" style="height: 42vh; width: 40vh">
                    <canvas id="myChart2" style="display: flex; align-items: center;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Situação do Sistema
                    </h3>
                </div>

                <div class="card-body ">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <a href="#" class="col-md-6">
            <div class="info-box bg-white ">
                <span class="info-box-icon bg-success elevation-1">
                    <i class="fa-solid fa-heart text-white"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text text-success">Usuários online</span>
                    <span class="info-box-number text-success text-lg">{{ $onlineCount }}</span>
                </div>
            </div>
        </a>

        <a href="#" class="col-md-6">
            <div class="info-box bg-white">
                <span class="info-box-icon bg-danger elevation-1">
                    <i class="fa-solid fa-users text-white"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text text-danger">Usuários</span>
                    <span class="info-box-number text-danger text-lg">{{ $userCount }}</span>
                </div>
            </div>
        </a>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Páginas mais visitadas
                    </h3>
                </div>

                <div class="card-body" style="height: 42vh; width: 40vh">
                    <canvas id="pieChart" style="display: flex; align-items: center;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Situação do Sistema
                    </h3>
                </div>

                <div class="card-body">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.0/chart.umd.js"
        integrity="sha512-CMF3tQtjOoOJoOKlsS7/2loJlkyctwzSoDK/S40iAB+MqWSaf50uObGQSk5Ny/gfRhRCjNLvoxuCvdnERU4WGg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{ 'assets/js/scripts.js' }}"></script>

    <script>
        const bar = document.getElementById('myChart').getContext('2d')

        new Chart(bar, {
            type: 'bar',
            data: {
                labels: {!! $pageLabels !!},
                datasets: [{
                    label: '/',
                    data: {!! $pageValues !!},
                    backgroundColor: [
                        '#28A7',
                    ],
                }],
            },
            options: {
                responsive: true,
            }
        });


        const doughnut = document.getElementById('myChart2');

        new Chart(doughnut, {
            type: 'doughnut',
            data: {
                labels: {!! $pageLabels !!},
                datasets: [{
                    label: '/',
                    data: {!! $pageValues !!},
                    backgroundColor: [
                        '#28A746',
                        '#286',
                        '#28A7',
                    ],
                }],
            },
            options: {
                maintainAspectRatio: true,
                responsive: true,
                legend: {
                    display: false,
                }
            }
        });
    </script>

    <script>
        const pie = document.getElementById('pieChart').getContext('2d')

        new Chart(pie, {
            type: 'pie',
            data: {
                labels: ['teste'],
                datasets: [{
                    label: '/',
                    data: [1, 2],
                    backgroundColor: [
                        '#28A746',
                    ],
                }],
            },
            options: {
                responsive: true,
            }
        });

        const chart = document.getElementById('barChart').getContext('2d')

        new Chart(chart, {
            type: 'bar',
            data: {
                labels: {!! $userLabels !!},
                datasets: [{
                    label: '/',
                    data: {!! $userValues !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                    ],
                }],
            },
            options: {
                responsive: true,
            }
        });
    </script>


@endsection

@extends('KhachHang.Share.master')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="row">
    <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="text-white mb-0">
                    <i class="fas fa-filter me-2"></i>Bộ Lọc
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label>Từ Ngày</label>
                        <input id="begin" type="date" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>Đến Ngày</label>
                        <input id="end" type="date" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <button id="searchBtn" class="btn btn-primary mt-4">
                            <i class="fas fa-search me-2"></i>Tìm Kiếm
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mb-3">
        <div class="row">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5>Tổng Số Sân</h5>
                        <h3 id="tong_san">0</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5>Tổng Mặt Bằng</h5>
                        <h3 id="tong_mat_bang">0</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h5>Tổng Đặt Sân</h5>
                        <h3 id="tong_dat_san">0</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5>Tổng Doanh Thu</h5>
                        <h3 id="tong_doanh_thu">0 đ</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="text-white mb-0">
                    <i class="fas fa-chart-bar me-2"></i>Thống Kê Số Lượng Đặt Sân
                </h5>
            </div>
            <div class="card-body">
                <canvas id="bookingChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-header bg-success">
                <h5 class="text-white mb-0">
                    <i class="fas fa-money-bill-wave me-2"></i>Thống Kê Doanh Thu
                </h5>
            </div>
            <div class="card-body">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-warning">
                <h5 class="text-white mb-0">
                    <i class="fas fa-newspaper me-2"></i>Thống Kê Bài Viết
                </h5>
            </div>
            <div class="card-body">
                <canvas id="postChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-info">
                <h5 class="text-white mb-0">
                    <i class="fas fa-building me-2"></i>Thống Kê Mặt Bằng
                </h5>
            </div>
            <div class="card-body">
                <canvas id="matBangChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var bookingChart, revenueChart, postChart, matBangChart;

        var today = new Date();
        var last7Days = new Date(today);
        last7Days.setDate(today.getDate() - 7);

        $('#begin').val(last7Days.toISOString().split('T')[0]);
        $('#end').val(today.toISOString().split('T')[0]);

        function initCharts(data) {
            if (bookingChart) bookingChart.destroy();
            if (revenueChart) revenueChart.destroy();
            if (postChart) postChart.destroy();
            if (matBangChart) matBangChart.destroy();

            bookingChart = new Chart(document.getElementById('bookingChart'), {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Số lượng đặt sân',
                        data: data.bookings,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgb(54, 162, 235)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });

            revenueChart = new Chart(document.getElementById('revenueChart'), {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Doanh thu (VNĐ)',
                        data: data.revenues,
                        backgroundColor: 'rgba(75, 192, 192, 0.5)',
                        borderColor: 'rgb(75, 192, 192)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return new Intl.NumberFormat('vi-VN').format(value) + ' đ';
                                }
                            }
                        }
                    }
                }
            });

            postChart = new Chart(document.getElementById('postChart'), {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Số lượng bài viết',
                        data: data.posts,
                        backgroundColor: 'rgba(255, 159, 64, 0.5)',
                        borderColor: 'rgb(255, 159, 64)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });

            matBangChart = new Chart(document.getElementById('matBangChart'), {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Số lượng mặt bằng',
                        data: data.mat_bangs,
                        backgroundColor: 'rgba(153, 102, 255, 0.5)',
                        borderColor: 'rgb(153, 102, 255)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        }

        function updateTongQuan(tong_quan) {
            $('#tong_san').text(tong_quan.tong_san);
            $('#tong_mat_bang').text(tong_quan.tong_mat_bang);
            $('#tong_dat_san').text(tong_quan.tong_dat_san);
            $('#tong_doanh_thu').text(new Intl.NumberFormat('vi-VN').format(tong_quan.tong_doanh_thu) + ' đ');
        }

        function loadData() {
            var begin = $('#begin').val();
            var end = $('#end').val();

            $.ajax({
                url: '/khach-hang/thong-ke/data',
                type: 'POST',
                data: {
                    begin: begin,
                    end: end
                },
                success: function(res) {
                    initCharts(res.data);
                    updateTongQuan(res.tong_quan);
                },
                error: function(err) {
                    console.log(err);
                    toastr.error('Đã có lỗi xảy ra');
                }
            });
        }

        loadData();

        $('#searchBtn').click(function() {
            loadData();
        });
    });
</script>
@endsection

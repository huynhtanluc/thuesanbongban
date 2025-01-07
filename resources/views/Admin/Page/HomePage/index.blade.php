@extends('Admin.Share.master')
@section('content')
<div class="row">
    <div class="col-md-12 mb-3">
        <div class="row">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="text-white">Tổng Số Chủ Sân</h5>
                        <h3 class="text-white" id="tong_chu_san">0</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="text-white">Tổng Doanh Thu</h5>
                        <h3 class="text-white" id="tong_doanh_thu">0 đ</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h5 class="text-white">Tổng Khách Hàng</h5>
                        <h3 class="text-white" id="tong_khach_hang">0</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="text-white">Tổng Mặt Bằng</h5>
                        <h3 class="text-white" id="tong_mat_bang">0</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="text-white mb-0">
                    <i class="fas fa-users me-2"></i>Thống Kê Chủ Sân Mới
                </h5>
            </div>
            <div class="card-body">
                <canvas id="chuSanChart"></canvas>
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

    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-warning">
                <h5 class="text-white mb-0">
                    <i class="fas fa-user-plus me-2"></i>Thống Kê Khách Hàng Mới
                </h5>
            </div>
            <div class="card-body">
                <canvas id="khachHangChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function() {
        var chuSanChart, revenueChart, khachHangChart;

        function initCharts(data) {
            if (chuSanChart) chuSanChart.destroy();
            if (revenueChart) revenueChart.destroy();
            if (khachHangChart) khachHangChart.destroy();

            chuSanChart = new Chart(document.getElementById('chuSanChart'), {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Số chủ sân mới',
                        data: data.chu_sans,
                        borderColor: 'rgb(54, 162, 235)',
                        tension: 0.1
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
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Doanh thu (VNĐ)',
                        data: data.revenues,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
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

            khachHangChart = new Chart(document.getElementById('khachHangChart'), {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Số khách hàng mới',
                        data: data.khach_hangs,
                        borderColor: 'rgb(255, 159, 64)',
                        tension: 0.1
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
            $('#tong_chu_san').text(tong_quan.tong_chu_san);
            $('#tong_doanh_thu').text(new Intl.NumberFormat('vi-VN').format(tong_quan.tong_doanh_thu) + ' đ');
            $('#tong_khach_hang').text(tong_quan.tong_khach_hang);
            $('#tong_mat_bang').text(tong_quan.tong_mat_bang);
        }

        function loadData() {
            $.ajax({
                url: '/admin/thong-ke/data',
                type: 'GET',
                success: function(res) {
                    if(res.status) {
                        initCharts(res.data);
                        updateTongQuan(res.tong_quan);
                    }
                },
                error: function(err) {
                    console.log(err);
                    toastr.error('Đã có lỗi xảy ra');
                }
            });
        }

        loadData();
    });
</script>
@endsection


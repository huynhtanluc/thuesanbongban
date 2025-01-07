@extends('KhachHang.Share.master')
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card border-primary border-bottom border-3 border-0">
            <div class="card-body">
                <!-- Tiêu đề bài viết -->
                <h2 class="text-primary mb-3">{{ $data->ten_bai_viet }}</h2>

                <!-- Thông tin bài viết -->
                <div class="d-flex align-items-center text-muted mb-4">
                    <div class="me-4">
                        <i class="far fa-calendar-alt me-2"></i>
                        {{ $data->ngay_dang }}
                    </div>
                    <div class="me-4">
                        <i class="far fa-user me-2"></i>
                        {{ $data->ten_khach_hang }}
                    </div>
                </div>

                <!-- Ảnh bài viết -->
                <div class="text-center mb-4">
                    <img src="{{ $data->hinh_anh }}" class="img-fluid rounded" alt="Sân bóng mới">
                </div>

                <!-- Nội dung bài viết -->
                <div class="content">
                    <div class="article-content">
                        {!! $data->noi_dung !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <!-- Bài viết nổi bật -->
        <div class="card border-warning border-bottom border-3 border-0 mb-4">
            <div class="card-header bg-transparent">
                <h5 class="text-warning mb-0">Bài Viết Nổi Bật</h5>
            </div>
            <div class="card-body">
                @foreach($bai_viet_noi_bat as $item)
                    <a href="/chi-tiet-bai-viet/{{ $item->id }}">
                        <div class="d-flex mb-3 border-bottom pb-3">
                            <img src="{{ $item->hinh_anh }}" class="rounded" style="width: 70px !important; height: 70px !important; object-fit: cover;">
                            <div class="ms-3">
                                <h6 class="mb-1">{{ $item->ten_bai_viet }}</h6>
                                <small class="text-muted">
                                    <i class="far fa-calendar-alt me-1"></i>
                                    {{ $item->ngay_dang }}
                                </small>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Chủ sân tiêu biểu -->
        <div class="card border-success border-bottom border-3 border-0">
            <div class="card-header bg-transparent">
                <h5 class="text-success mb-0">Tác Giả Tiêu Biểu</h5>
            </div>
            <div class="card-body">
                @foreach($chu_san_tieu_bieu as $item)
                    <div class="d-flex align-items-center mb-3 border-bottom pb-3">
                        <div class="flex-shrink-0">
                            @if($item->anh_dai_dien)
                                <img src="{{ $item->anh_dai_dien }}" class="rounded-circle" width="50" height="50">
                            @else
                                <div class="avatar avatar-lg">
                                    <i class="fas fa-user-circle fa-3x text-success"></i>
                                </div>
                            @endif
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1">{{ $item->ten_chu_san }}</h6>
                            <small class="text-muted">{{ $item->so_bai_viet }} bài viết</small>
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
new Vue({
    el: '#app',
    data: {
        list_bai_viet: [],
        list_bai_viet_noi_bat: [],
        list_chu_san: [],
        chiTiet: {},
    },
    created() {
        this.loadData();
    },
    methods: {
        formatContent(content) {
            if(content.length > 200) {
                return content.substring(0, 200) + '...';
            }
            return content;
        },
    }
});
</script>
@endsection

<style>
.article-content h4 {
    color: #2b3d4c;
    margin-top: 1.5rem;
    margin-bottom: 1rem;
}

.article-content ul {
    padding-left: 1.5rem;
    margin-bottom: 1rem;
}

.article-content p {
    margin-bottom: 1rem;
    line-height: 1.6;
}

.article-content .alert {
    margin: 1.5rem 0;
}

.article-content .table {
    margin: 1rem 0;
}
</style>

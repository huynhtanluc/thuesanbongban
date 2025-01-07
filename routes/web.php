<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\BaiViet\BaiVietController;
use App\Http\Controllers\BinhLuan\BinhLuanController;
use App\Http\Controllers\CauHinhNganHangController;
use App\Http\Controllers\ChuSanController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\KhachHang\KhachHangController;
use App\Http\Controllers\KhuVuc\KhuVucController;
use App\Http\Controllers\LichDatSanController;
use App\Http\Controllers\LichThueSanController;
use App\Http\Controllers\MatBangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SanBong\SanBongController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ThongKeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;



Route::get("/admin/login", [AdminController::class, 'viewLogin']);
Route::post("/admin/login", [AdminController::class, 'actionLogin']);

Route::group(['prefix' => '/admin', 'middleware' => 'adminMiddleware'],function() {
    Route::get("/", [HomePageController::class, 'indexAdmin']);
    Route::get('/thong-ke/data', [HomePageController::class, 'getThongKeData']);

    Route::group(['prefix' => '/khach-hang'], function() {
        Route::get('/index', [KhachHangController::class, 'index']);
        Route::post('/create', [KhachHangController::class, 'store']);
        Route::get('/data', [KhachHangController::class, 'data']);
        Route::get('/change-status/{id}', [KhachHangController::class, 'changeStatus']);
        Route::post('/delete', [KhachHangController::class, 'delete']);
        Route::post('/update', [KhachHangController::class, 'update']);
    });

    Route::group(['prefix' => '/bai-viet'], function() {
        Route::get('/index', [BaiVietController::class, 'index']);
        Route::post('/create', [BaiVietController::class, 'store']);
        Route::get('/data', [BaiVietController::class, 'data']);
        Route::get('/change-status/{id}', [BaiVietController::class, 'changeStatus']);
        Route::post('/delete', [BaiVietController::class, 'delete']);
        Route::post('/update', [BaiVietController::class, 'update']);
    });

    Route::group(['prefix' => '/san-bong'], function() {
        Route::get('/index', [SanBongController::class, 'index']);
        Route::post('/create', [SanBongController::class, 'store']);
        Route::get('/data', [SanBongController::class, 'data']);
        Route::get('/change-status/{id}', [SanBongController::class, 'changeStatus']);
        Route::post('/delete', [SanBongController::class, 'delete']);
        Route::post('/update', [SanBongController::class, 'update']);
    });

    Route::group(['prefix' => '/khu-vuc'], function() {
        Route::get('/index', [KhuVucController::class, 'index']);
        Route::post('/create', [KhuVucController::class, 'store']);
        Route::get('/data', [KhuVucController::class, 'data']);
        Route::get('/change-status/{id}', [KhuVucController::class, 'changeStatus']);
        Route::post('/delete', [KhuVucController::class, 'delete']);
        Route::post('/update', [KhuVucController::class, 'update']);
    });

    Route::group(['prefix' => '/chu-san'], function() {
        Route::get('/index', [ChuSanController::class, 'index']);
        Route::get('/data', [ChuSanController::class, 'data']);
        Route::post('/duyet', [ChuSanController::class, 'duyetDonDangKy']);

    });

    Route::get('/logout', [AdminController::class, 'logout']);

});

Route::get("/", [HomePageController::class, 'index']);

Route::get("/lien-he", [HomePageController::class, 'indexLienHe']);
Route::get("/data-home-khach-hang", [HomePageController::class, 'dataHomeKhachHang']);
Route::get("/chi-tiet-san-bong/{id}", [SanBongController::class, 'chiTietSan']);
Route::get("/chi-tiet-bai-viet/{id}", [BaiVietController::class, 'indexChiTietBaiViet']);
Route::get("/login", [KhachHangController::class, 'viewLogin']);
Route::get("/register", [KhachHangController::class, 'viewRegister']);
Route::post("/login", [KhachHangController::class, 'actionLogin']);
Route::post("/register", [KhachHangController::class, 'actionRegister']);

Route::get("/quen-mat-khau", [KhachHangController::class, 'quetMatKhau']);
Route::post("/action-quen-mat-khau", [KhachHangController::class, 'actionQuenMatKhau']);

Route::get("/kich-hoat-tai-khoan/{token}", [KhachHangController::class, 'kichHoatTaiKhoan']);

Route::get("/xac-nhan-code", [KhachHangController::class, 'indexXacNhanCode']);
Route::post("/xac-nhan-code", [KhachHangController::class, 'actionXacNhanCode']);

Route::get("/reset-mat-khau", [KhachHangController::class, 'indexResetMatKhau']);
Route::post("/reset-mat-khau", [KhachHangController::class, 'actionResetMatKhau']);


Route::group(['prefix' => '/khach-hang', 'middleware' => 'khachHangMiddleware'],function() {
    Route::group(['prefix' => '/san-bong'],function() {
        Route::get("/", [SanBongController::class, 'indexKhachHang']);
        Route::get("/data", [SanBongController::class, 'dataSanKhachHang']);
        Route::post("/dang-ki", [SanBongController::class, 'dangKiSan']);
        Route::post("/dat-san", [SanBongController::class, 'datSan']);

        Route::get("/cau-hinh-dia-chi", [SanBongController::class, 'indexCauHinhDiaChi']);
        Route::post("/cau-hinh-dia-chi", [SanBongController::class, 'cauHinhDiaChi']);
        Route::get("/data-san-bong-mat-bang-cau-hinh", [SanBongController::class, 'dataSanBongMatBangCauHinh']);
        Route::get("/data-san-bong-cau-hinh", [SanBongController::class, 'dataSanBongCauHinh']);
        Route::post("/huy-cau-hinh", [SanBongController::class, 'huyCauHinh']);

    });

    Route::group(['prefix' => '/chu-san'],function() {
        Route::get("/", [ChuSanController::class, 'viewSanDaLamChuKhachHang']);
        Route::get("/data", [ChuSanController::class, 'dataSanDaLamChuKhachHang']);
        Route::post("/tra-san", [ChuSanController::class, 'traSan']);
        Route::post("/cap-nhat-cau-hinh", [ChuSanController::class, 'capNhatCauHinh']);
        Route::post("/huy-dang-ky", [ChuSanController::class, 'huyDangKy']);
        Route::post("/get-list-khung-gio", [ChuSanController::class, 'getListKhungGio']);
        Route::get('/lich-thue-khach-hang', [ChuSanController::class, 'lichThueKhachHang']);
        Route::get('/calendar', [ChuSanController::class, 'indexCalendar']);
        Route::get('/data-calendar', [ChuSanController::class, 'dataCalendar']);
    });

    Route::group(['prefix' => '/lich-dat-san'],function() {
        Route::get("/", [LichDatSanController::class, 'index']);
        Route::get("/data", [LichDatSanController::class, 'dataLichDatSanKhachHang']);
        Route::post('/huy', [LichDatSanController::class, 'huyLich']);
        Route::post('/thong-tin-chuyen-khoan', [LichDatSanController::class, 'thongTinChuyenKhoan']);
    });

    Route::group(['prefix' => '/lich-thue-san-khach-hang'],function() {
        Route::get("/data", [LichThueSanController::class, 'dataLichThueSanKhachHang']);
        Route::post("/xac-nhan-dat-san", [LichThueSanController::class, 'xacNhanDatSan']);
        Route::post("/huy-dat-san", [LichThueSanController::class, 'huyDatSan']);
        Route::post("/thanh-toan-hoan-tat", [LichThueSanController::class, 'thanhToanHoanTat']);
    });

    Route::group(['prefix' => '/bai-viet'],function() {
        Route::get("/", [BaiVietController::class, 'indexKhachHang']);
        Route::get("/data", [BaiVietController::class, 'dataKhachHang']);
        Route::post("/create", [BaiVietController::class, 'storeKhachHang']);
        Route::post("/upload", [BaiVietController::class, 'uploadAnh']);
        Route::post("/update", [BaiVietController::class, 'updateKhachHang']);
        Route::post("/delete", [BaiVietController::class, 'deleteKhachHang']);
    });

    Route::group(['prefix' => '/thong-ke'],function() {
        Route::get('/', [ThongKeController::class, 'index']);
        Route::post('/data', [ThongKeController::class, 'getData']);
    });

    Route::group(['prefix' => '/profile'],function() {
        Route::get('/', [ProfileController::class, 'index']);
        Route::post('/update-avatar', [ProfileController::class, 'updateAvatar']);
        Route::post('/update-profile', [ProfileController::class, 'updateProfile']);
    });

    Route::group(['prefix' => '/khach-hang'],function() {
        Route::get('/', [KhachHangController::class, 'indexKhachHangQuanLy']);
        Route::post('/create', [KhachHangController::class, 'store']);
        Route::get('/data', [KhachHangController::class, 'data']);
        Route::get('/change-status/{id}', [KhachHangController::class, 'changeStatus']);
        Route::post('/delete', [KhachHangController::class, 'delete']);
        Route::post('/update', [KhachHangController::class, 'update']);
        Route::post('/change-password', [KhachHangController::class, 'changePassword']);
    });

    Route::group(['prefix' => '/ngan-hang'],function() {
        Route::get('/', [CauHinhNganHangController::class, 'index']);
        Route::post('/', [CauHinhNganHangController::class, 'cauHinhNganHang']);
    });

    Route::group(['prefix' => '/mat-bang'],function() {
        Route::get('/', [MatBangController::class, 'index']);
        Route::get('/data', [MatBangController::class, 'getData']);
        Route::get('/thanh-pho', [MatBangController::class, 'getThanhPho']);
        Route::get('/quan-huyen/{id}', [MatBangController::class, 'getQuanHuyen']);
        Route::get('/phuong-xa/{id}', [MatBangController::class, 'getPhuongXa']);
        Route::post('/create', [MatBangController::class, 'store']);
        Route::post('/update', [MatBangController::class, 'update']);
        Route::post('/delete', [MatBangController::class, 'destroy']);
        Route::get('/change-status/{id}', [MatBangController::class, 'changeStatus']);
    });

    Route::get('/logout', [ProfileController::class, 'logout']);
});

Route::group(['prefix' => '/khach-hang/khu-vuc'],function() {
    Route::get("/data", [KhuVucController::class, 'dataKhuVucKhachHang']);
});

Route::get("/test", [TestController::class, 'test']);

Route::post('ckeditor/upload', function(Request $request) {
    if($request->hasFile('upload')) {
        $originName = $request->file('upload')->getClientOriginalName();
        $fileName = pathinfo($originName, PATHINFO_FILENAME);
        $extension = $request->file('upload')->getClientOriginalExtension();
        $fileName = $fileName . '_' . time() . '.' . $extension;

        $request->file('upload')->move(public_path('images'), $fileName);

        $CKEditorFuncNum = $request->input('CKEditorFuncNum');
        $url = asset('images/' . $fileName);
        $msg = 'Tải ảnh lên thành công!';
        $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

        @header('Content-type: text/html; charset=utf-8');
        echo $response;
    }
})->name('ckeditor.upload');

Route::post("/khach-hang/xac-nhan-code", [KhachHangController::class, 'actionXacNhanCode']);

Route::get('/kich-hoat-tai-khoan/{token}', [KhachHangController::class, 'kichHoatTaiKhoan']);






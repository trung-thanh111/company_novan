<div class="row">
    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-success pull-right">Tháng</span>
                <h5>Liên hệ mới</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins">{{ $stats['currentMonthVR'] }}</h1>
                <div class="stat-percent font-bold text-success">{{ $stats['growth'] }}% <i class="fa fa-level-up"></i></div>
                <small>Yêu cầu liên hệ trong tháng</small>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-info pull-right">Tổng số</span>
                <h5>Đội ngũ nhân sự</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins">{{ $stats['teamCount'] }}</h1>
                <small>Thành viên trong công ty</small>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-primary pull-right">Total</span>
                <h5>Dịch vụ cung cấp</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins">{{ $stats['serviceCount'] }}</h1>
                <small>Dịch vụ đang hoạt động</small>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-danger pull-right">Trust</span>
                <h5>Đối tác & Thành tựu</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins">{{ $stats['partnerCount'] + $stats['achievementCount'] }}</h1>
                <small>Ghi nhận từ khách hàng</small>
            </div>
        </div>
    </div>
</div>

<section class="bn-section bn-process" id="PROCESS">
    <div class="bn-container">
        <div class="bn-process__grid">
            <div class="bn-process__left bn-sec-head">
                <span class="bn-pill-label bn-pill-label--outline">{{ $system['home_process_label'] ?? 'Quy trình làm việc' }}</span>
                <h2 class="bn-sec-title">{{ $system['home_process_title'] ?? 'Quy trình chuyên nghiệp' }}</h2>
                <div class="bn-sec-desc">{{ $system['home_process_desc'] ?? 'Một quy trình đã được chứng minh để hiện thực hóa các ý tưởng của bạn, từ khái niệm đến thực tế thông qua việc lập kế hoạch và thực thi chiến lược.' }}</div>
            </div>
            
            <div class="bn-process__right bn-process-steps">
                @if(isset($workProcesses) && count($workProcesses))
                    @php
                        $totalSteps = count($workProcesses);
                    @endphp
                    @foreach($workProcesses as $key => $item)
                        @php
                            $name = $item->name ?? 'N/A';
                            $description = $item->description ?? '';
                            
                            // Vietize defaults if matching English names
                            if ($name == 'Consultation & Planning') {
                                $name = 'Tư vấn & Lập kế hoạch';
                                $description = 'Việc hiểu rõ nhu cầu, ngân sách và tầm nhìn của bạn sẽ đảm bảo dự án bám sát mục tiêu, đồng thời phản ánh đúng ý tưởng của bạn.';
                            } elseif ($name == 'Design & Architecture') {
                                $name = 'Thiết kế & Kiến trúc';
                                $description = 'Hình ảnh hóa dự án với những bản thiết kế thực tế sẽ hiện thực hoá các ý tưởng của bạn, tập trung vào cả công năng lẫn thẩm mỹ.';
                            } elseif ($name == 'Construction & Management') {
                                $name = 'Thi công & Quản lý';
                                $description = 'Việc xây dựng với sự chính xác và giám sát của chuyên gia đảm bảo mọi chi tiết được thực hiện đúng chuẩn, duy trì chất lượng cao.';
                            }
                            
                            $stepNum = str_pad($key + 1, 2, '0', STR_PAD_LEFT);
                            $isLast = ($key == $totalSteps - 1);
                        @endphp
                        <div class="bn-process-step">
                            <div class="bn-process-step__inner">
                                <div class="bn-process-step__num">
                                    {{ $stepNum }}<span class="num-separator">/({{ str_pad($totalSteps, 2, '0', STR_PAD_LEFT) }})</span> 
                                    <i class="fa fa-arrow-right step-arrow"></i>
                                </div>
                                <h3 class="bn-process-step__title">{{ $name }}</h3>
                                <div class="bn-process-step__body">
                                    <p class="bn-process-step__desc">{{ $description }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>

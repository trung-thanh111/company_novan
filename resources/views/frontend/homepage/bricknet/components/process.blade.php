<section class="bn-section bn-process">
    <div class="bn-container">
        <div class="bn-process__grid" style="display: grid; grid-template-columns: 1fr 1.8fr; gap: 80px; align-items: start;">
            <div class="bn-process__left bn-sec-head" style="position: sticky; top: 120px;">
                <span class="bn-pill-label bn-pill-label--outline">{{ $system['home_process_label'] ?? 'Quy trình làm việc' }}</span>
                <h2 class="bn-sec-title">{{ $system['home_process_title'] ?? 'Quy trình chuyên nghiệp' }}</h2>
                <div class="bn-sec-desc">{{ $system['home_process_desc'] ?? 'Một quy trình đã được chứng minh để hiện thực hóa các ý tưởng của bạn, từ khái niệm đến thực tế thông qua việc lập kế hoạch và thực thi chiến lược.' }}</div>
            </div>
            
            <div class="bn-process__right bn-process-steps" style="border-top: 1px solid var(--bn-border);">
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
                            
                            // All steps aligned Left as requested
                            $align = 'left';
                            $margin = '0 auto 0 0';
                        @endphp
                        <div class="bn-process-step" style="text-align: {{ $align }}; padding: 45px 0; border-bottom: 1px solid var(--bn-border);">
                            <div class="bn-process-step__inner" style="display: inline-block; text-align: {{ $align }}; max-width: 100%; width: 100%;">
                                <div class="bn-process-step__num" style="margin-bottom: 20px; font-size: 20px; font-weight: 600; font-family: var(--bn-font-display); color: var(--bn-title);">
                                    {{ $stepNum }}<span style="color: var(--bn-text-light);">/({{ str_pad($totalSteps, 2, '0', STR_PAD_LEFT) }})</span> 
                                    <i class="fa fa-arrow-right" style="margin-left: 15px; font-size: 16px; opacity: 0.6;"></i>
                                </div>
                                <h3 class="bn-process-step__title" style="font-size: 2.25rem; margin-bottom: 20px; line-height: 1.2; font-weight: 700; color: #27303c;">{{ $name }}</h3>
                                <div class="bn-process-step__body" style="margin: {{ $margin }};">
                                    <p class="bn-process-step__desc" style="font-size: 16px; color: var(--bn-text-main); line-height: 1.6;">{{ $description }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>

<section class="bn-section bn-about">
    <div class="bn-container">
        <div class="bn-sec-head bn-sec-head--split">
            <div style="flex: 1;">
                <span class="bn-pill-label bn-pill-label--outline">{{ $system['home_about_label'] ?? 'Về Chúng Tôi' }}</span>
                <h2 class="bn-sec-title">
                    {!! $system['home_about_title'] ?? 'Biến ý tưởng thành <span>các công trình vững chãi</span> với thời gian.' !!}
                </h2>
                <div class="bn-sec-desc" style="margin-top: 20px;">
                    {!! $system['home_about_desc'] ?? 'Chúng tôi tự hào là đơn vị tiên phong mang đến các giải pháp kiến trúc và xây dựng đẳng cấp, kết hợp giữa sự đổi mới, tính thẩm mỹ và độ bền vững trong từng dự án.' !!}
                </div>
            </div>
            <div style="flex-shrink: 0;">
                <a href="/gioi-thieu.html" class="bn-btn bn-btn--shiny-outline">{{ $system['home_about_btn'] ?? 'Tìm Hiểu Thêm' }} <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>
        
        <div class="bn-about__stats">
            <div class="bn-about__stat">
                <div class="bn-about__stat-num" style="color: var(--bn-accent);">{{ $system['home_stat_1_num'] ?? '10+' }}</div>
                <div class="bn-about__stat-label">{{ $system['home_stat_1_label'] ?? 'Năm Kinh Nghiệm' }}</div>
            </div>
            <div class="bn-about__stat">
                <div class="bn-about__stat-num" style="color: var(--bn-title);">{{ $system['home_stat_2_num'] ?? '1500+' }}</div>
                <div class="bn-about__stat-label">{{ $system['home_stat_2_label'] ?? 'Dự Án Hoàn Thành' }}</div>
            </div>
            <div class="bn-about__stat">
                <div class="bn-about__stat-num" style="color: var(--bn-accent);">{{ $system['home_stat_3_num'] ?? '4.8/5' }}</div>
                <div class="bn-about__stat-label">{{ $system['home_stat_3_label'] ?? 'Điểm Hài Lòng Khách Hàng' }}</div>
            </div>
            <div class="bn-about__stat">
                <div class="bn-about__stat-num" style="color: var(--bn-title);">{{ $system['home_stat_4_num'] ?? '98%' }}</div>
                <div class="bn-about__stat-label">{{ $system['home_stat_4_label'] ?? 'Tỉ lệ Thành Công' }}</div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const statsSection = document.querySelector('.bn-about__stats');
        if (!statsSection) return;
        
        const statNums = statsSection.querySelectorAll('.bn-about__stat-num');
        let hasAnimated = false;
        
        const animateValue = (element, start, end, duration, formatData) => {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                
                // easeOutQuad
                const easeProgress = progress * (2 - progress);
                
                let currentVal = start + easeProgress * (end - start);
                
                if (formatData.isFloat) {
                    element.innerHTML = currentVal.toFixed(1) + formatData.suffix;
                } else {
                    element.innerHTML = Math.floor(currentVal) + formatData.suffix;
                }
                
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                } else {
                    element.innerHTML = formatData.original; // ensure exact final string
                }
            };
            window.requestAnimationFrame(step);
        };

        const startAnimation = () => {
            if (hasAnimated) return;
            hasAnimated = true;
            
            statNums.forEach(stat => {
                const originalText = stat.innerText.trim();
                // Extract number parts (including decimals)
                const numMatch = originalText.match(/[0-9.]+/);
                if (!numMatch) return; // if no number, skip animation
                
                let endVal = parseFloat(numMatch[0]);
                if (isNaN(endVal)) endVal = 0;
                
                const isFloat = originalText.includes('.');
                // Remove the number to get the suffix string (works for simple suffix like "+", "/5", "%")
                const suffix = originalText.replace(/[0-9.]/g, '');
                
                // Start with 0 (or 0.0) and suffix
                stat.innerHTML = isFloat ? `0.0${suffix}` : `0${suffix}`;
                
                animateValue(stat, 0, endVal, 2000, {
                    original: originalText,
                    suffix: suffix,
                    isFloat: isFloat
                });
            });
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    startAnimation();
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        
        observer.observe(statsSection);
    });
</script>

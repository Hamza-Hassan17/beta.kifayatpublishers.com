<div class="video-container">
    <div class="carousel-wrapper">
        <!-- Slider Buttons on Left and Right -->
        <button class="header-nav header-prev slider-btn-left">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button class="header-nav header-next slider-btn-right">
            <i class="fas fa-chevron-right"></i>
        </button>
        <div class="carousel-track" id="carouselTrack">
            @foreach (range('A', 'Z') as $letter)
                <div class="product-card">
                    <div class="video-card">
                        <div class="video-thumb position-relative"
                            data-video="{{ asset("assets/videos/work-books/{$letter}-1.m4v") }}">
                            <img src="{{ asset('assets/images/video-thumbnails/latter-' . strtolower($letter) . '.png') }}"
                                alt="{{ $letter }}" class="img-fluid">
                            <i class="fa-solid fa-play play-icon"
                                style="position:absolute; top:50%; left:50%; transform:translate(-50%, -50%); font-size:2rem; color:white;"></i>
                        </div>
                        <div class="video-content p-3">
                            <h6>{{ $letter }}</h6>
                            <small class="video-content-para">Learning letters of the alphabets with
                                examples</small>
                            <div class="video-content-btn">
                                <small class="text-muted">For Pre Primary</small>
                                <button class="btn btn-sm btn-info mt-2 text-white">Watch</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="carousel-dots" id="carouselDots">
        <!-- Dots will be added by JavaScript -->
    </div>
</div>

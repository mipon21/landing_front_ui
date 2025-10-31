<!-- Footer-Section start -->
<footer>
    <div class="top_footer" id="contact">
        <div class="blure_shape bs_1"></div>
        <div class="blure_shape bs_2"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6 col-12">
                    <div class="abt_side">
                        <div class="logo">
                            @if($footerLogo)
                                <img src="{{ asset('storage/' . $footerLogo) }}" alt="Logo">
                            @else
                                <img src="{{ asset('images/logo_white.webp') }}" alt="image">
                            @endif
                        </div>
                        <p>{{ $footerDetails }}</p>
                        @if(isset($footerAppStoreButtons))
                            <ul class="app_btn">
                                @if($footerAppStoreButtons['show_app_store'])
                                    <li>
                                        <a href="{{ $footerAppStoreButtons['app_store_url'] }}">
                                            <img src="{{ asset('images/appstorebtn.webp') }}" alt="App Store">
                                        </a>
                                    </li>
                                @endif
                                @if($footerAppStoreButtons['show_google_play'])
                                    <li>
                                        <a href="{{ $footerAppStoreButtons['google_play_url'] }}">
                                            <img src="{{ asset('images/googleplay.webp') }}" alt="Google Play">
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        @else
                            <ul class="app_btn">
                                <li><a href="#"><img src="{{ asset('images/appstorebtn.webp') }}" alt="image"></a></li>
                                <li><a href="#"><img src="{{ asset('images/googleplay.webp') }}" alt="image"></a></li>
                            </ul>
                        @endif
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-12">
                    <div class="links">
                        <h5>Quick Links</h5>
                        <ul>
                            @forelse($footerQuickLinks as $link)
                                <li><a href="{{ $link->url ? $link->url : '#' }}">{{ $link->label }}</a></li>
                            @empty
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="{{ route('about') }}">About us</a></li>
                                <li><a href="{{ route('contact') }}">Contact us</a></li>
                            @endforelse
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-12">
                    <div class="links">
                        <h5>Support</h5>
                        <ul>
                            @forelse($footerSupportMenus as $menu)
                                <li><a href="{{ $menu->url ? $menu->url : '#' }}">{{ $menu->label }}</a></li>
                            @empty
                                <li><a href="#">FAQs</a></li>
                                <li><a href="#">Support</a></li>
                                <li><a href="#">How it works</a></li>
                                <li><a href="#">Terms & conditions</a></li>
                                <li><a href="#">Privacy policy</a></li>
                            @endforelse
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <h5>Subscribe us</h5>
                    <div class="news_letter">
                        <p>Subscribe our newsleter to receive latest updates regularly from us!</p>
                        <form id="newsletterForm" action="{{ route('newsletter.subscribe') }}" method="POST">
                            @csrf
                            <div id="newsletter-message" style="display: none; margin-bottom: 10px; padding: 10px; border-radius: 5px; font-size: 14px;"></div>
                            <div class="form-group">
                                <input type="email" name="email" id="newsletter_email" class="form-control" placeholder="Enter your email" required>
                                <button type="submit" class="btn" aria-label="subscribe" id="newsletterSubmitBtn">
                                    <span id="newsletterBtnText"><i class="icofont-paper-plane"></i></span>
                                    <span id="newsletterBtnLoader" style="display: none;">Submitting...</span>
                                </button>
                            </div>
                            <p class="note">By clicking send link you agree to receive message.</p>
                        </form>
                        <script>
                            document.getElementById('newsletterForm').addEventListener('submit', function(e) {
                                e.preventDefault();
                                
                                const form = this;
                                const submitBtn = document.getElementById('newsletterSubmitBtn');
                                const submitBtnText = document.getElementById('newsletterBtnText');
                                const submitBtnLoader = document.getElementById('newsletterBtnLoader');
                                const messageDiv = document.getElementById('newsletter-message');
                                const emailInput = document.getElementById('newsletter_email');
                                const formData = new FormData(form);
                                
                                // Disable submit button and show loader
                                submitBtn.disabled = true;
                                submitBtnText.style.display = 'none';
                                submitBtnLoader.style.display = 'inline';
                                
                                // Hide previous messages
                                messageDiv.style.display = 'none';
                                messageDiv.className = '';
                                messageDiv.textContent = '';
                                
                                // Submit via AJAX
                                fetch(form.action, {
                                    method: 'POST',
                                    body: formData,
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest',
                                        'Accept': 'application/json'
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    // Show message
                                    messageDiv.style.display = 'block';
                                    messageDiv.textContent = data.message;
                                    
                                    if (data.success) {
                                        // Success message
                                        messageDiv.style.backgroundColor = '#d4edda';
                                        messageDiv.style.color = '#155724';
                                        messageDiv.style.border = '1px solid #c3e6cb';
                                        
                                        // Reset form
                                        form.reset();
                                    } else {
                                        // Error message
                                        messageDiv.style.backgroundColor = '#f8d7da';
                                        messageDiv.style.color = '#721c24';
                                        messageDiv.style.border = '1px solid #f5c6cb';
                                    }
                                })
                                .catch(error => {
                                    // Show error message
                                    messageDiv.style.display = 'block';
                                    messageDiv.style.backgroundColor = '#f8d7da';
                                    messageDiv.style.color = '#721c24';
                                    messageDiv.style.border = '1px solid #f5c6cb';
                                    messageDiv.textContent = 'An error occurred. Please try again later.';
                                })
                                .finally(() => {
                                    // Re-enable submit button
                                    submitBtn.disabled = false;
                                    submitBtnText.style.display = 'inline';
                                    submitBtnLoader.style.display = 'none';
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom_footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <p>{{ isset($footerCopyrightText) ? str_replace('%Y', date('Y'), $footerCopyrightText) : '© Copyrights ' . date('Y') . '. All rights reserved.' }}</p>
                    </div>
                    <div class="col-md-4">
                        <ul class="social_media">
                            @if(isset($footerSocialLinks) && $footerSocialLinks->count() > 0)
                                @foreach($footerSocialLinks as $socialLink)
                                    <li>
                                        <a href="{{ $socialLink->url }}" aria-label="{{ $socialLink->label ?? $socialLink->platform . ' page' }}" target="_blank" rel="noopener noreferrer">
                                            <i class="{{ $socialLink->icon_class }}"></i>
                                        </a>
                                    </li>
                                @endforeach
                            @else
                                <li><a href="#" aria-label="facebook page"><i class="icofont-facebook"></i></a></li>
                                <li><a href="#" aria-label="twitter page"><i class="icofont-twitter"></i></a></li>
                                <li><a href="#" aria-label="instagram page"><i class="icofont-instagram"></i></a></li>
                                <li><a href="#" aria-label="pinterest page"><i class="icofont-pinterest"></i></a></li>
                            @endif
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <p class="developer_text">Design & developed by <a href="http://skylon-it.com/" target="blank">Skylon-IT</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer-Section end -->

<div class="go_top" id="Gotop">
    <span><i class="icofont-arrow-up"></i></span>
</div>

<!-- VIDEO MODAL -->
<div class="modal fade youtube-video" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button id="close-video" type="button" class="button btn btn-default text-right" data-dismiss="modal">
                <i class="icofont-close-line-circled"></i>
            </button>
            <div class="modal-body">
                <div id="video-container" class="video-container">
                    <iframe id="youtubevideo" width="640" height="360" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/aos.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>


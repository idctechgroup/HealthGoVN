/**
 * Main JavaScript file for HealthGoVietNam
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        
        // Mobile menu toggle
        $('.menu-toggle').on('click', function() {
            $(this).toggleClass('active');
            $('.main-navigation ul').slideToggle();
        });

        // Smooth scroll for anchor links
        $('a[href*="#"]').not('[href="#"]').not('[href="#0"]').click(function(event) {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && 
                location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    event.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top - 100
                    }, 1000);
                }
            }
        });

        // Back to top button
        $(window).scroll(function() {
            if ($(this).scrollTop() > 300) {
                $('.back-to-top').fadeIn();
            } else {
                $('.back-to-top').fadeOut();
            }
        });

        $('.back-to-top').click(function() {
            $('html, body').animate({scrollTop: 0}, 800);
            return false;
        });

    });

    document.addEventListener('click', function(e) {

        if (!document.body.classList.contains('home')) return;

        const el = e.target.closest('[data-home-service-link]');
        if (!el) return;

        const url = el.dataset.homeServiceLink;
        if (url) window.location.href = url;

    });

    // FAQ Accordion/Collapse functionality
    $(document).on('click', '.faq-question', function() {
        const $faqItem = $(this).closest('.faq-item');
        const $faqAnswer = $faqItem.find('.faq-answer');
        const $toggle = $(this).find('.faq-toggle');
        
        // Toggle current item
        $faqItem.toggleClass('active');
        $faqAnswer.slideToggle(300);
        
        // Change toggle icon
        if ($faqItem.hasClass('active')) {
            $toggle.text('−');
        } else {
            $toggle.text('+');
        }
        
        // Optional: Close other FAQ items (uncomment for accordion behavior)
        // $faqItem.siblings('.faq-item').removeClass('active')
        //     .find('.faq-answer').slideUp(300);
        // $faqItem.siblings('.faq-item').find('.faq-toggle').text('+');
    });

    // Hospital Gallery functionality
    function switchGalleryImage(index) {
        const $wrapper = $('.hospital-gallery-wrapper');
        const $mainImage = $wrapper.find('.main-image');
        const $thumbs = $wrapper.find('.gallery-thumb');
        const $targetThumb = $thumbs.eq(index);
        
        if (!$targetThumb.length) return;
        
        // Get full-size image URL from data attribute
        const fullImageUrl = $targetThumb.data('full-url');
        
        // Update main image
        $mainImage.fadeOut(200, function() {
            $mainImage.attr('src', fullImageUrl).attr('data-index', index);
            $mainImage.fadeIn(200);
        });
        
        // Update active thumbnail
        $thumbs.removeClass('active');
        $targetThumb.addClass('active');
        
        // Update counter
        $wrapper.find('.gallery-counter .current').text(index + 1);
    }
    
    // Click thumbnail to switch
    $(document).on('click', '.gallery-thumb', function() {
        const index = $(this).data('index');
        switchGalleryImage(index);
    });
    
    // Previous button
    $(document).on('click', '.gallery-prev', function() {
        const $mainImage = $(this).siblings('.main-image');
        const currentIndex = parseInt($mainImage.attr('data-index'));
        const $wrapper = $(this).closest('.hospital-gallery-wrapper');
        const totalImages = $wrapper.find('.gallery-thumb').length;
        const newIndex = currentIndex > 0 ? currentIndex - 1 : totalImages - 1;
        switchGalleryImage(newIndex);
    });
    
    // Next button
    $(document).on('click', '.gallery-next', function() {
        const $mainImage = $(this).siblings('.main-image');
        const currentIndex = parseInt($mainImage.attr('data-index'));
        const $wrapper = $(this).closest('.hospital-gallery-wrapper');
        const totalImages = $wrapper.find('.gallery-thumb').length;
        const newIndex = currentIndex < totalImages - 1 ? currentIndex + 1 : 0;
        switchGalleryImage(newIndex);
    });
    
    // Keyboard navigation
    $(document).on('keydown', function(e) {
        if ($('.hospital-gallery-wrapper').length) {
            if (e.key === 'ArrowLeft') {
                $('.gallery-prev').click();
            } else if (e.key === 'ArrowRight') {
                $('.gallery-next').click();
            }
        }
    });

    // Thumbnail slider functionality with loop
    function updateThumbSlider() {
        const $container = $('.gallery-thumbnails');
        const $thumbs = $container.find('.gallery-thumb');
        
        if ($thumbs.length <= 4) {
            // Hide navigation if all thumbs visible
            $('.thumb-nav').hide();
        } else {
            $('.thumb-nav').show();
        }
    }
    
    // Scroll thumbnails left with loop
    $(document).on('click', '.thumb-prev', function() {
        const $container = $('.gallery-thumbnails');
        const $thumbs = $container.find('.gallery-thumb');
        const thumbWidth = $thumbs.first().outerWidth(true);
        const scrollLeft = $container.scrollLeft();
        const containerWidth = $container.width();
        const totalWidth = thumbWidth * $thumbs.length;
        const scrollAmount = thumbWidth * 4;
        
        if (scrollLeft <= 0) {
            // Loop to end
            $container.animate({
                scrollLeft: totalWidth - containerWidth
            }, 300);
        } else {
            $container.animate({
                scrollLeft: scrollLeft - scrollAmount
            }, 300);
        }
    });
    
    // Scroll thumbnails right with loop
    $(document).on('click', '.thumb-next', function() {
        const $container = $('.gallery-thumbnails');
        const $thumbs = $container.find('.gallery-thumb');
        const thumbWidth = $thumbs.first().outerWidth(true);
        const scrollLeft = $container.scrollLeft();
        const containerWidth = $container.width();
        const totalWidth = thumbWidth * $thumbs.length;
        const scrollAmount = thumbWidth * 4;
        
        if (scrollLeft >= totalWidth - containerWidth - 10) {
            // Loop to start
            $container.animate({
                scrollLeft: 0
            }, 300);
        } else {
            $container.animate({
                scrollLeft: scrollLeft + scrollAmount
            }, 300);
        }
    });
    
    // Initialize thumbnail slider
    if ($('.hospital-gallery-wrapper').length) {
        updateThumbSlider();
        $(window).on('resize', updateThumbSlider);
    }

})(jQuery);

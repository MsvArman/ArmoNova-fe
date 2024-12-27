<?php

namespace Panel\Controllers;

class ServicesController
{

    
    public function SocialMediaMarketing() {

        return view('services/smm-websites-list', 'SMM', '', '<script src="../assets/js/services/main.js?v=1.1.8"></script><script src="../assets/js/services/smm/smm.js"></script>');

    }
    public function SocialMediaMarketingOption() {

        return view('services/smm-option', 'SMM - Options', '', '<script src="../assets/js/services/component.js"></script><script src="../assets/js/services/smm/smm-option.js"></script>');

    }
    public function Scraper() {

        return view('services/scraper-websites-list', 'Social Fetch Data', '', '<script src="../assets/js/services/main.js?v=1.1.8"></script><script src="../assets/js/services/scraper/scraper.js"></script>');

    }
    public function ScraperOption() {

        return view('services/scraper-option', 'Social Fetch Data - Options', '', '<script src="../assets/js/services/component.js"></script><script src="../assets/js/services/scraper/scraper-option.js"></script>');

    }
    public function Payment() {

        return view('services/payment-websites-list', 'Payment', '', '<script src="../assets/js/services/main.js?v=1.1.8"></script><script src="../assets/js/services/payment/payment.js"></script>');

    }
    public function PaymentOption() {

        return view('services/payment-option', 'Payment - Options', '', '<script src="../assets/js/services/component.js"></script><script src="../assets/js/services/payment/payment-option.js"></script>');

    }
    public function Ai() {

        return view('ai_content/ai', 'AI', '', '<script src="assets/js/aiContent/ai.js"></script>');

    }
    public function AiView() {

        return view('ai_content/view', 'view', '<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" /><script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>', '<script src="assets/js/aiContent/ai_view.js"></script>');

    }
    public function AiContentCreation() {

        return view('ai_content/content_creation', 'Content Creation', '', '');

    }
    public function AiBlogCreation() {

        return view('ai_content/blog_creation', 'Blog Creation', '', '<script src="assets/js/aiContent/blog_creation.js"></script>');

    }
    public function AiProductContentCreation() {

        return view('ai_content/product_content_creation', 'Product Content Creation', '', '');

    }


}
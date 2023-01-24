/* Add your custom template javascript here */

function finnaCustomInit() {
    // Tracks clicks of floating feedback button
    var feedbackBtn = $('.floating-feedback-btn');
    feedbackBtn.click(function countClick() {
        var _paq = window._paq || []; 
        window._paq = _paq;
        _paq.push(['trackEvent', 'Feedback', 'Click Floating Button', 'Click']);
    });
    // Track clicks of footer feedback button
    var feedbackBtn1 = $('#link_to_feedback_form');
    feedbackBtn1.click(function countClick() {
        var _paq = window._paq || []; 
        window._paq = _paq;
        _paq.push(['trackEvent', 'Feedback', 'Click Footer Button', 'Click']);
    });
    // Track feedback form submissions
    var feedbackSent = $('#form_FeedbackSite_submit');
    feedbackSent.click(function feedbackFormSent() {
        var _paq = window._paq || []; 
        window._paq = _paq;
        _paq.push(['trackEvent', 'Feedback', 'Send Form', 'Click']);
    });
}

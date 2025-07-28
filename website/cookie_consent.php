<?php
// Check if consent cookie is already set
if (!isset($_COOKIE['consent'])):
?>
<div id="cookie-consent-banner" style="position: fixed; bottom: 0; width: 100%; background-color: #1B263B; color: #DBA858; padding: 15px; text-align: center; z-index: 1000;">
    <p style="margin: 0;">
        This site uses cookies to enhance your experience. By continuing to browse the site, you agree to our use of cookies.<br><br>
        <button id="accept-cookie" style="background-color: #DBA858; color: #112233; border: none; padding: 8px 16px; border-radius: 5px; font-weight: bold; cursor: pointer;">
            Accept
        </button>
    </p>
</div>

<script>
// JavaScript to handle cookie consent
document.getElementById('accept-cookie').onclick = function() {
    document.cookie = "consent=accepted; path=/; max-age=" + (60 * 60 * 24 * 30); // 30 days expiry
    document.getElementById('cookie-consent-banner').style.display = 'none';
};
</script>
<?php
endif;
?>

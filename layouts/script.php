<!-- jquery latest version -->
<script src="js/vendor/jquery-3.1.1.min.js"></script>
<!-- Bootstrap framework js -->
<script src="js/bootstrap.min.js"></script>
<!-- jquery.nivo.slider js -->
<script src="lib/js/jquery.nivo.slider.js"></script>
<!-- Google Map js -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIAZelGKDKE52MugeMbh--BpQR6VcxoxM"></script>
<script src="js/map.js"></script>

<!-- ajax-mail js -->
<script src="js/ajax-mail.js"></script>
<!-- All js plugins included in this file. -->
<script src="js/plugins.js"></script>
<!-- Main js file that contents all jQuery plugins activation. -->
<script src="js/main.js"></script>

<script>
    $(document).ready(function() {
    //Preloader
    $(window).on("load", function() {
        preloaderFadeOutTime = 500;
        function hidePreloader() {
            var preloader = $('.loader-wrapper');
            preloader.fadeOut(preloaderFadeOutTime);
        }
        hidePreloader();
        });
    });
</script>

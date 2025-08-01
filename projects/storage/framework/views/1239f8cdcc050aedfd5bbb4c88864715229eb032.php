
<!-- slick js file -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" ></script>
      <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<!-- Bootstrao 5 cdn js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<!-- main js -->
<script type="text/javascript" src="<?php echo e(asset('front')); ?>/js/main.js"></script>
<script src="<?php echo e(asset('front')); ?>/js/script.js"></script>
<script src="<?php echo e(asset('toastr/toastr.js')); ?>"></script>

<script>
$(document).ready(function(){

  $(".gst").click(function(){
    $("#guestsss").css("display", "block");
  });
   $(".close1").click(function(){
    $("#guestsss").css("display", "none");
  });

    <?php if(Session::has("success")): ?>
        toastr.success("<?php echo e(Session::get('success')); ?>");
    <?php endif; ?>
    <?php if(Session::has("danger")): ?>
        toastr.error("<?php echo e(Session::get('danger')); ?>");
    <?php endif; ?>

      $("#pause").click(function(){
        $("#play").css("display", "block");
         $("#pause").css("display", "none");
      });
      $("#play").click(function(){
        $("#pause").css("display", "block");
         $("#play").css("display", "none");
      });
      $(".review-sec li").click(function(){
        $("li.active").removeClass("active");
        $(this).addClass("active");
      });
      $('a.btn_photos').on('click', function(event) {
        event.preventDefault();
        
        var gallery = $(this).attr('href');
        
        $(gallery).magnificPopup({
          delegate: 'a',
          type:'image',
          gallery: {
            enabled: true
          }
        }).magnificPopup('open');
      });
});
$('#reload').click(function () {
    $.ajax({
        type: 'GET',
        url: "<?php echo e(url('reload-captcha')); ?>",
        success: function (data) {
            $(".captcha span").html(data.captcha);
        }
    });
});
function playVideo() {
    $('#mob').trigger('play');
}
function pauseVideo() {
    $('#mob').trigger('pause');
}
        

</script>

<script>

  </script>
  <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js"></script>
  <script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.js"></script>
  <script>
      // external js: masonry.pkgd.js, imagesloaded.pkgd.js
  
  // init Masonry
  var $grid = $('.cruise').masonry({
    itemSelector: '.grid-item',
    percentPosition: true,
    columnWidth: '.grid-sizer'
  });
  // layout Masonry after each image loads
  $grid.imagesLoaded().progress( function() {
    $grid.masonry();
  });  
  </script><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/front/layouts/js.blade.php ENDPATH**/ ?>
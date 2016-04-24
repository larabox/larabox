<!-- Root element of PhotoSwipe. Must have class pswp. -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

    <!-- Background of PhotoSwipe.
         It's a separate element, as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>

    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">

        <!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory. -->
        <div class="pswp__container">
            <!-- don't modify these 3 pswp__item elements, data is added later on -->
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">

                <!--  Controls are self-explanatory. Order can be changed. -->

                <div class="pswp__counter"></div>

                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                <button class="pswp__button pswp__button--share" title="Share"></button>

                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                <!-- element will get class pswp__preloader--active when preloader is running -->
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>

            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>

            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>

            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>

        </div>

    </div>

</div>


<link rel="stylesheet" href="/css/photoswipe/photoswipe.css">
<!-- Skin CSS file (styling of UI - buttons, caption, etc.)
     In the folder of skin CSS file there are also:
     - .png and .svg icons sprite,
     - preloader.gif (for browsers that do not support CSS animations) -->
<link rel="stylesheet" href="/css/photoswipe/default-skin.css">
<!-- Core JS file -->
<script src="/js/photoswipe/photoswipe.min.js"></script>
<!-- UI JS file -->
<script src="/js/photoswipe/photoswipe-ui-default.min.js"></script>

<script>
    var jetPhotoSwipe = function(name) {

        var _initPhotoSwipe = function ( gallery ){

            gallery.listen('gettingData', function(index, item) {
                var img = new Image();
                img.src = item.src;
                item.w = img.width;
                item.h = img.height;
            });
            gallery.init();
        }
        var openPhotoSwipe = function(items,index) {
            var pswpElement = document.querySelectorAll('.pswp')[0];

            var options = {
                // history & focus options are disabled on CodePen
                index: index,
                history: true,
                focus: true,
                shareEl: false,
                fullscreenEl: false,
                zoomEl :true,
                bgOpacity: 0.90,
                showAnimationDuration: 0,
                hideAnimationDuration: 0

            };

            var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
            _initPhotoSwipe(gallery);
        };

        var initPhotoSwipe = function(name){
            var images = [];
            var gallery = document.getElementsByClassName(name);

            var index, len;
            for (index = 0, len = gallery.length; index < len; ++index) {
                images.push({src:gallery[index].href});
            }

            var index, len;
            for (index = 0, len = gallery.length; index < len; ++index) {
                document.getElementsByClassName(name)[index].onclick = function () {
                    var i;
                    var index2, len2;

                    var complit = 0;

                    var loaded = function(images,i,length) {
                        complit = complit+1;
                        if (complit == length) {
                            openPhotoSwipe(images, i);
                        }
                    }

                    var loadImage2 = function(images, i,img,length) {
                        setTimeout(function(){
                            if (img.complete) {
                                loaded(images, i,length);
                            }else {
                                loadImage2(images, i,img,length);
                            }
                        }, 10);
                    }

                    var loadImage = function(images, i,src,length) {
                        var img = new Image();
                        img.src = src;

                        if (img.complete) {
                            loaded(images, i,length);
                        }else {
                            loadImage2(images, i,img,length);
                        }

                        img.addEventListener('error', function() {
                            alert('error load img | '+img.src);
                        });
                    }

                    for (index2 = 0, len2 = gallery.length; index2 < len2; ++index2) {

                        if (gallery[index2].href == this.href){
                            i = index2;
                        }
                        loadImage(images, i,gallery[index2].href,gallery.length);
                    }
                    return false;
                }
            }
        }

        initPhotoSwipe(name);
    }
</script>
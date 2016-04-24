<script src="{{asset('js/jquery.lazyload.min.js')}}"></script>
<script>
    $(function() {
        $("img.lazy").lazyload({
            effect : "fadeIn",
            failure_limit : 10
        });
    });
</script>
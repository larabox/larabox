<script>
    var yaParams = {
        referal: '{{config('metrika.referal','')}}',
        ip: '{{config('metrika.ip','')}}',
        retarget: '{{config('metrika.retarget','')}}',
        tarp: '{{config('metrika.tarp','')}}'
    }
</script>

@if(!Session::has('admin'))
        <!-- Yandex.Metrika counter --> <script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push
    (function() { try { w.metrika.yaCounter = new Ya.Metrika({
        id:36708280,
        clickmap:true,
        params: window.yaParams,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/36708280" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
@endif
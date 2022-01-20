<link rel="stylesheet" href="/css/style.css">
<div id="hellopreloader">
    <div id="hellopreloader_preload"></div>
    <p>
        <a href="http://hello-site.ru">Hello-Site.ru. Бесплатный конструктор сайтов.</a>
    </p>
</div>
<script type="text/javascript">
var hellopreloader = document.getElementById("hellopreloader_preload");
function fadeOutnojquery(el)
{
    el.style.opacity = 1;
    var interhellopreloader = setInterval(function()
    {
        el.style.opacity = el.style.opacity - 0.05;
        if (el.style.opacity <=0.05)
        { 
            clearInterval(interhellopreloader);
            hellopreloader.style.display = "none";
        }
    },
    16);
}
window.onload = function()
{
    setTimeout(function()
    {
        fadeOutnojquery(hellopreloader);
    },
    400);
};
</script>

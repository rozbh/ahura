 function countdown_init(el)
{
    var mainDate = el.attr('mm-date');
    var countDownDate = new Date(parseInt(mainDate)).getTime();
    var x = setInterval(function() {
        var now = new Date().getTime();
        var distance = parseInt(countDownDate) - parseInt(now);
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        el.find('#mwtimercountdown').html("<li>" + days + "<span>روز</span></li><li>" + hours + "<span>ساعت</span></li><li>"
         + minutes + "<span>دقیقه</span></li><li>" + seconds + "<span>ثانیه</span></li>")
        if (distance < 0) {
            clearInterval(x);
            el.find("#mwtimercountdown").html("به اتمام رسیده!");
        }
    }, 1000);
}
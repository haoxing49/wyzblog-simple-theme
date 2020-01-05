layui.use('util', function() {
    var util = layui.util;
    util.fixbar({
        css: { right: 15, bottom: 60 }
    });
});
layui.use('code', function() {
    layui.code();
    //实际使用时， 执行该方法即可。 而此处注释是因为修饰器在别的js中已经执行过了
});
$(".nav-mobile-open,.nav-mobile-close").click(function() {
    $("#div_navigation").toggleClass('layui-show');
    $("#nav-mobile-open").toggleClass('layui-hide');
    $("#nav-mobile-close").toggleClass('layui-show');
});
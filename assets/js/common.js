layui.use('util', function() {
    var util = layui.util;
    util.fixbar({
        css: { right: 50, bottom: 100 }
    });
});
layui.use('code', function() {

    layui.code();
    //实际使用时， 执行该方法即可。 而此处注释是因为修饰器在别的js中已经执行过了
});
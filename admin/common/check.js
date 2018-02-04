/**
 * Created by 小新 on 2018/1/19.
 */
var thc = $("thead :checkbox");
var tbc = $("tbody :checkbox");
thc.click(function () {
    tbc.prop('checked', $(this).prop('checked'));
});
tbc.click(function () {
    var len = $("tbody :checkbox").length;
    var checkedLen = $("tbody :checkbox:checked").length;
    if (len == checkedLen) {
        thc.prop('checked', 'checked');
    } else {
        thc.prop('checked', '');
    }
});
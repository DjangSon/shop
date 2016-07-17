function pageBack() {
    var a = window.location.href;
    if (/#top/.test(a)) {
        window.history.go(-2);
        window.location.load(window.location.href)
    } else {
        window.history.back();
        window.location.load(window.location.href)
    }
}

function settab_zzjsnet(name, cursel, n) {
				for (i = 1; i <= n; i++) {
					var menu = document.getElementById(name + i);
					var zzjs = document.getElementById("zzjs_" + name + "_" + i);
					menu.className = i == cursel ? "hover" : ""; //修改css样式
					zzjs.style.display = i == cursel ? "block" : "none"; //隐藏、显示
				}
			}
function BoxModule(i) {
	var sh = $('#module').val();
	if (sh == i) return;
	$('#sh' + sh).removeClass('on');
	$('#module' + sh).css('display', 'none');
	$('#module').val(i);
	$('#sh' + i).addClass('on');
	$('#module' + i).css('display', 'block');
	BoxModule_Info(i);
}
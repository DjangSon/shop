function settab_zzjsnet(name, cursel, n) {
	for (i = 1; i <= n; i++) {
	var menu = document.getElementById(name + i);
	var zzjs = document.getElementById("zzjs_" + name + "_" + i);
	menu.className = i == cursel ? "hover" : "";//修改css样式
	zzjs.style.display = i == cursel ? "block" : "none";//隐藏、显示
//	menu.style.color = i == cursel ? "#3BAEFF":"";
	}
}



<div id="lib_zzjs_1">
	<div class="lib_menu_zzjsnet">
		<ul>
			<li id="zzjs_11" onclick="settab_zzjsnet('zzjs_1',1,2)" class="hover">我的购物车</li>
			<li id="zzjs_12" onclick="settab_zzjsnet('zzjs_1',2,2)">确定订单</li>
		</ul>
	</div>
	<div class="lib_Contentbox_zzjs lib_border_zzjs">
		<div id="zzjs_zzjs_1_1">
			内容1
		</div>
		<div id="zzjs_zzjs_1_2" style="display: none">
			内容2
		</div>
	</div>
</div>


.lib_menu_zzjsnet { height: 28px; line-height: 28px; position: relative; background-color: #EDE6DB; }
.lib_menu_zzjsnet ul { margin: 0px 10px 0px 10px; padding: 0px; list-style: none; position: absolute; top: 3px; left: 0; height: 25px; text-align: center; width: 96%; }
.lib_menu_zzjsnet li { float: left; display: block; cursor: pointer; width: 32%; color: #FFFFFF; font-weight: bold; margin-right: 2px; height: 25px; line-height: 25px; background-color: #C0C0C0; font-size: 14px; }
.lib_menu_zzjsnet li.hover { padding: 0px; background: #EDE6DB; width: 32%; border-left: 1px solid #95C9E1; border-top: 1px solid #95C9E1; border-right: 1px solid #95C9E1; color: #DC2949; height: 25px; line-height: 25px; border-top-color: #DACEA8; border-right-color: #DACEA8; border-left-color: #DACEA8; }
.lib_Contentbox_zzjs { padding: 8px 20px 8px 20px; clear: both; margin-top: 0px; border-top: none; text-align: center; }
.lib_border_zzjs { border: 1px solid #DACEA8; }
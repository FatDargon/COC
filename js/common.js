var my_storage = window.localStorage;

function openCate(tag) {
	var id = CateActive(tag)
	$(".content-main").empty();
	getArti(id);
}

function CateActive(tag) {
	tag = $(tag)
	var id = tag.attr('data-id');
	my_storage.setItem("cate-id", id);
	var cname = tag.innerHTML;
	$(".categories li.active").removeClass('active');
	tag.parent().addClass('active');
	return id;
}

// 对Date的扩展，将 Date 转化为指定格式的String 
// 月(M)、日(d)、小时(h)、分(m)、秒(s)、季度(q) 可以用 1-2 个占位符， 
// 年(y)可以用 1-4 个占位符，毫秒(S)只能用 1 个占位符(是 1-3 位的数字) 
// 例子： 
// (new Date()).Format("yyyy-MM-dd hh:mm:ss.S") ==> 2006-07-02 08:09:04.423 
// (new Date()).Format("yyyy-M-d h:m:s.S")      ==> 2006-7-2 8:9:4.18 
Date.prototype.Format = function(fmt) { //author: meizz 
	var o = {
		"M+": this.getMonth() + 1, //月份 
		"d+": this.getDate(), //日 
		"h+": this.getHours(), //小时 
		"m+": this.getMinutes(), //分 
		"s+": this.getSeconds(), //秒 
		"q+": Math.floor((this.getMonth() + 3) / 3), //季度 
		"S": this.getMilliseconds() //毫秒 
	};
	if(/(y+)/.test(fmt))
		fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
	for(var k in o)
		if(new RegExp("(" + k + ")").test(fmt))
			fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
	return fmt;
}

function getArti(id) {
	var channel_id = id || 0;
	$.getJSON("http://115.29.39.186/tp5/public/index.php/index/isouji/article?id=" + channel_id, null, function(data) {
		var cont = $(".content-main");
		json =JSON.parse(data)
		$.each(json, function(i) {
			var arti_date = new Date(this.time).Format("yyyy-MM-dd");
			var arti_short = "";
			var flag = 0;
			var l = 0;
			for(var i = 0; i < this.content.length && l <= 45; i++) {
				if(this.content[i] == '<') {
					flag = 1;
				} else if(this.content[i] == '>') {
					flag = 0;
					continue;
				}
				if(flag == 1) {
					continue;
				}
				arti_short = arti_short + this.content[i];
				l++;
			}
			//var arti_short = this.content.match(/[^\u0000-\u00FF\[\]]+|[^\[]+?(?=\])/g).toString().substring(0,45)+'……';
			//alert(arti_short)
			//alert(typeof(arti_short));
			//alert(this.imgs);
			//' + this.title + '
			var ht =
				'<div class="content-grid-sec">' +
				'	<div class="content-sec-info">' +
				'		<h3><a href="javascript:void(0);" onclick="openArti(this)" data-id="' + this.id + '">' + this.title + '</a></h3>' +
				'		<h4>' + arti_date + ', Posted by : <a href="#">Admin</a></h4>' +
				'		<p>' + arti_short + '......</p>' +
				'   	<img src="' + this.imgs + '" alt="" />' +
				'		<a class="bttn" href="javascript:void(0);" onclick="openArti(this)"  data-id="' + this.id + '">MORE</a>' +
				'	</div>' +
				'</div>';
			cont.prepend(ht);
		});
	});
}

function openArti(tag) {
	tag = $(tag);
	var id = tag.attr('data-id');
	my_storage.setItem("article-id", id);
	window.location.href = 'single.html?if_clear=1';
}

function getCate() {
	if(my_storage.getItem('Cate')) {
		readCate(my_storage.getItem('Cate'));
	} else {
		$.getJSON("http://115.29.39.186/tp5/public/index.php/index/isouji/channel", null, function(json) {
			var cate = $(".categories");
			my_storage.setItem("Cate", JSON.stringify(json));
			readCate(json);
		});
	}
}

function readCate(data_json) {
	data_json = JSON.parse(data_json);
	//alert(data_json[0].id);
	var cate = $(".categories");
	$.each(data_json, function(i) {
		//alert(i)
		if(i == 0) {
			var ht = '<li class="active"><a href="javascript:void(0);" onclick="openCate(this)" data-id="' + this.id + '"> ' + this.title + '</a></li>'
		} else {
			var ht = '<li><a href="javascript:void(0);" onclick="openCate(this)" data-id="' + this.id + '"> ' + this.title + '</a></li>'
		}
		cate.append(ht);
	});
}

function getArtiDetail(id) {
	$.getJSON("http://115.29.39.186/tp5/public/index.php/index/isouji/artDetail?id=" + id, null, function(json) {
		readAticle(json);
	});
}

function readAticle(data_json) {
	if(typeof data_json === 'string') {
		data_json = JSON.parse(data_json);
	}
	if(data_json[0].content.length <= 100) {
		ht = '数据错误！';
	}
	//alert(JSON.stringify(data_json))
	//'+data_json.title+'
	var arti_date = new Date(data_json[0].time).Format("yyyy-MM-dd");
	var cate_id = my_storage.getItem('cate-id');
	var cate = JSON.parse(my_storage.getItem('Cate'))
	var cate_name = '';
	$.each(cate, function(i) {
		if(this.id == cate_id)
			cate_name = this.title;
	});
	var ht =
		'<div class="content-grid-head">' +
		'<h3>' + cate_name + '</h3>' +
		'<h4>' + arti_date + ',Posted by: <a href="#">Admin</a></h4>' +
		'<div class="clearfix"></div>' +
		'</div>';
	var cont = $(".content-grid-head");
	cont.empty();
	cont.prepend(ht);
	$(".content-grid-single h3:first").html(data_json[0].title);
	$(".content-grid-single img:first").attr('src', data_json[0].imgs);
	$(".content-grid-single p:first").html(data_json[0].content);
}

function StorageClear(flag) {
	if(!flag) {
		//alert('all clear')
		my_storage.clear();
	} else if(flag == 1) {
		//		alert('in 1')
		return;
	} else if(flag == 2) {
		my_storage.removeItem('Cate');
	} else if(flag == 3) {
		my_storage.removeItem('article-id');
	} else if(flag == 4) {
		my_storage.removeItem('cate-id');
	} else if(flag == 5) {
		my_storage.removeItem('login');
	}
}

function getQueryString(name) {
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
	var r = window.location.search.substr(1).match(reg);
	if(r != null) return unescape(r[2]);
	return null;
}

function logout() {
	StorageClear(5);
	location.reload();
}
function search(html_name)
{
	if (html_name=='index')
	{
		window.location.href='html/search.html';
	}

}

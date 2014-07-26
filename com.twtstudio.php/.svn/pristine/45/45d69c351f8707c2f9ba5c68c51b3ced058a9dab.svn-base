var TWTManageUI=function(){
	this.menu=new function(){
		this.expand=function(o){
			$(o).children('a').children('i').hide();
			$(o).find('.nav').show(200);
		};
		this.collapse=function(o){
			$(o).children('a').children('i').show();
			$(o).find('.nav').hide(200);
		};
	};

	this.form=new function(){
		this.ajaxFill=function(o,container){
			eval('var data='+$(o).attr('data'));
			$(container).addClass('disabled').html('请等待...');
			$.ajax({
				url:$(o).attr('href')+"&inajax=1",
				type:$(o).attr('method'),
				data:data,
				dataType:'html',
				success:function(data){
					$(container).html(data);
					$(container).removeClass('disabled');
				}
			});
			return false;
		};

		this.post=function(o){
			eval('var data='+$(o).attr('data'));
			var href=$(o).attr('href');
			ui.form.build('post',href,data).submit();
			return false;
		};

		this.get=function(o){
			eval('var data='+$(o).attr('data'));
			var href=$(o).attr('href');
			ui.form.build('get',href,data).submit();
			return false;
		};

		this.build=function(method,action,inputs){
			var form=$('<form/>')
				.attr({method:method,action:action});
			for(var i in inputs)
				form.append($('<input type=hidden />')
					.attr({name:i,value:inputs[i]}));
			return form;
		};
	};
	return this;
};
var ui=new TWTManageUI();

$('body').ready(function(){
	$('#sidenav > li').each(function(){
		if($(this).hasClass('active'))
		{
			ui.menu.expand(this);
			return;
		}
		$(this).click(function(){
			if($(this).hasClass('opened'))
				ui.menu.collapse(this);
			else
				ui.menu.expand(this);
			$(this).toggleClass('opened');
		});
		if($(this).find('.nav').length>0)
		{
			$(this).children('a').append('<i class=icon-plus></i>');
			$(this).find('.nav').hide();
		}
		else
		{
			$(this).children('a').append('<i class=icon-chevron-right></i>');
		}
	});
});
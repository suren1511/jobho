$(document).ready(function () {
	if (!$('.bx-pagination').length) $('.more__btn').hide();
	$('.more__btn').on('click', function(e) {
		e.preventDefault();
	
		var url = location.href;
		var cur_page = $('.bx-pagination-container ul').find('li.bx-active span').html();
		
		url = url.replace('PAGEN_2='+cur_page,'');
		cur_page++;
		if ( url.indexOf('?') != -1 ) url = url+'&';
		else url = url + '?';
		url = url + 'PAGEN_2=' + cur_page + '&AJAX_PAGE=Y';
		console.log(url);
		$.ajax({
			url: url,
			beforeSend: function () {$('#show-more-1 img').fadeIn();},
			success: function (data) {
				console.log(data);
				$('#show-more-1 img').fadeOut();
				var pagenavi = $('.bx-pagination-container ul li');
				var total = $(pagenavi[pagenavi.length-3]).find('span').html();

				if (cur_page>=total) $('.more__btn').fadeOut(500);
	
				if (cur_page < 5 || cur_page >= total-1) {
					$('#fake_points').remove();
					pagenavi.each(function (i, val) {
						if ($(val).hasClass('bx-active')) {
							$(val).removeClass('bx-active');
							$(pagenavi[i + 1]).addClass('bx-active');
							return false;
						}
					})
				}
				else if (cur_page < total-1) {
					pagenavi.each(function (index, value) {
						if (index==2) $(value).find('span').html('...');
						else if (index>2 && index<=5) {
							var num = cur_page-4+index;
							$(value).html('<a href="/index.php?PAGEN_2='+num+'"><span>'+num+'</span></a>');
						}
						else if ( (index==pagenavi.length-3) && !($('#fake_points').length) )
							$(value).before('<li id="fake_points"><span>...</span></li>');
					})
				}
	
				$('#show-more-1').before(data);
	
				var titleRows = $('.title');
				if (titleRows.length > 1) {
					titleRows.each( function (i, val) {
						var text = $(val).find('a').html();
						var sameText = $("div.title:contains('"+text+"')");
						for (index = 1; index < sameText.length; ++index) {
							$(sameText[index]).remove();
						}
					})
				}
			}
		})
	});

	var yourClick = true;
	$(document).bind('click.myEvent', function (e) {
		if (!yourClick && $(e.target).closest('.ajax_ulica').length == 0) {
			$('.ajax_ulica').fadeOut(100);
			$(document).unbind('click.myEvent');
		}
		yourClick = false;
	});

  
	var parentDiv = $('div.form.form_bug2_ie7');
	if (($('#selectedStations').height() > 0) && ($(window).width()>648)) parentDiv.height(60+$('#selectedStations').height());

	$('#selectedStations').bind("DOMSubtreeModified",function(){
		if ($(window).width()>648) {
			var newH = $(this).height();
			parentDiv.height(60 + newH);
		}
	});

	$('.pseudo_select').click( function (e) {
		if ($(this).height()<30) {
			if ($(this).hasClass('metro')) $(this).css({'height':'auto','overflow-y':'scroll'});
			else $(this).css({'height':'auto','width':'auto'});
		}
		else {
			if (e.target != $('input')) $(this).attr('style','');
		}
	});

	$(".pseudo_select input[type=checkbox]").change( function () {
		var val = $(this).val();
		var id = $(this).attr('id');
		var sid = '#'+id;

		if (this.checked) {
			if (!$('#selectedStations').find( $(sid) ).length)
				$('#selectedStations').append('<div class="station" id="'+id+'">' +
				val + '<img src="/img/close.png" style="cursor:hand;cursor:pointer"' +
				'onclick="$(\'div'+sid+'\').remove(); $(\'input'+sid+'\').attr(\'checked\',false); ">' +
				'</div>');
		}
		else{
			$('#selectedStations').find('div').remove(sid);
		}
	});
});

$(document).click( function (e) {
	var select = $('.pseudo_select');
	if (!select.is(e.target) && select.has(e.target).length === 0 && select.css('height') != '25px') select.attr('style', '');
});

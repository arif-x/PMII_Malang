function getAllCategory(){
	$.getJSON('data.json', function (data){
		let menu = data.menu;
		$.each(menu, function (i, data){
			$('#all-menu').append('<div class="col-md-4"><div class="card mb-4"><img src="' + data.image + 
				'"><div class="card-body"><div class="card-title"><h5>'+ data.name +
				'</h5></div><div class="card-text"><p>' + data.description +
				'</p></div><div class="card-title"><h6>' + data.cost +
				'</h6></div><a href="#" class="btn btn-success width-100">Order Now</a></div></div></div>');
		});
	});
}

getAllCategory();

$('.nav-link').on('click', function(){
	$('.nav-link').removeClass('active');
	$(this).addClass('active');

	let categories = $(this).html();
	$('h1').html(categories);

	if(categories == 'All'){
		getAllCategory();
		return;
	}

	$.getJSON('data.json', function (data){
		let menu = data.menu;
		let content = '';		
		$.each(menu, function (i, data){
			if(data.category == categories.toLowerCase()){
				content += '<div class="col-md-4"><div class="card mb-4"><img src="' + data.image + 
				'"><div class="card-body"><div class="card-title"><h5>'+ data.name +
				'</h5></div><div class="card-text"><p>' + data.description +
				'</p></div><div class="card-title"><h6>' + data.cost +
				'</h6></div><a href="#" class="btn btn-success width-100">Order Now</a></div></div></div>'
			}
		});
		$('#all-menu').html(content);	
	});
});


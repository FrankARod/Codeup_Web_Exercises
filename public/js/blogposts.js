var posts = [
	{
		'author' : 'Frank',
		'title' : 'This is a Test',
		'date' : '19721031',
		'image' : '',
		'body' : 'Pellentesque sodales, justo sed egestas tristique, nunc justo posuere turpis, ac vestibulum erat sem sit amet sem. Mauris hendrerit augue dui. Nunc sit amet purus nec dolor porttitor hendrerit vel non neque. Quisque eu pellentesque dui. In varius pretium nisi, a sagittis lacus viverra vitae. Sed et elit interdum, rutrum est ut, porttitor nisl. Suspendisse potenti. In sit amet ligula ut justo facilisis tempus. Nullam id quam sed justo tristique commodo. Duis lobortis sem a pulvinar euismod. Praesent dictum risus sed ligula rhoncus, sit amet laoreet mi congue. Nullam tincidunt orci et ligula auctor, sit amet sodales nulla eleifend. Ut sit amet viverra magna, vitae aliquam tellus. Curabitur ultricies nunc sit amet diam pharetra, non viverra dui vulputate. Nullam imperdiet, dolor ut lobortis maximus, nunc tellus maximus quam, sit amet finibus metus tortor scelerisque sem. Aenean vestibulum mollis neque eu ultrices. Nullam sit amet dolor mauris. Nam fermentum ipsum nec risus accumsan, bibendum eleifend sapien ultrices. Duis lacinia eros sit amet risus egestas faucibus. Proin at pretium orci. Duis nec lectus urna. Donec vitae cursus quam, accumsan tempus lacus. Aenean nec erat eu ex sagittis sagittis ut eget risus. Donec commodo mattis libero. Suspendisse potenti. Proin posuere sagittis convallis. Ut hendrerit sapien in neque facilisis, nec hendrerit nunc maximus. Suspendisse vestibulum suscipit nisi et varius. Curabitur laoreet tristique tellus. Aliquam ligula arcu, hendrerit et ex eget, accumsan pulvinar lectus. Donec pretium erat eu velit convallis, ut iaculis nunc ultrices. Aenean blandit eros mollis nunc tristique, quis bibendum felis commodo. Aliquam interdum, velit id placerat dapibus, libero nisi tristique sem, ut congue nunc lacus in sem. Fusce vitae nulla non nisl volutpat accumsan. Suspendisse quis purus neque. Praesent ut arcu in nunc iaculis laoreet. Nulla rutrum lacus ipsum, ac tristique nunc pretium ac. Nunc commodo velit sed urna viverra mollis. Phasellus ac ultricies dui, a tempus magna. Maecenas id odio eu felis posuere pellentesque. Aliquam erat volutpat. Praesent egestas luctus posuere. In ut lorem facilisis, vestibulum sem eget, luctus sapien. Aliquam dignissim velit quis massa suscipit rhoncus. Sed hendrerit enim lectus, ut accumsan nulla rutrum id. Maecenas ultricies pharetra ligula, ac consequat tortor commodo cursus. Suspendisse sollicitudin imperdiet odio, eu iaculis velit bibendum a. Suspendisse tincidunt, est at malesuada gravida, mi orci facilisis nisl, nec tempor urna lacus pharetra leo. Duis nec ipsum imperdiet, aliquet tortor nec, facilisis enim. Quisque molestie nisl quis dolor rutrum rhoncus. Vivamus et lorem orci. In dictum mollis enim ut ultrices. Morbi porttitor sagittis quam in consequat. Vivamus non urna eget felis aliquam vestibulum ut lacinia odio. Donec ultrices erat sit amet aliquet mollis. Praesent sagittis augue eu nisi dictum, a faucibus dui laoreet. Aliquam ac ex sit amet enim elementum volutpat.'
	},
	{
		'author' : 'Frank Rodriguez',
		'title' : 'My Birthday',
		'date' : '19960316',
		'image' : 'img/cake.jpg',
		'body' : 'It rained the day I was born.'
	},
	{
		'author' : 'lastAuthor',
		'title' : 'lastTitle',
		'date' : 'lastDate',
		'image' : '',
		'body' : 'lastBody'
	}
];


var mainBody = document.getElementById('mainBody');
posts.forEach(function(element, index, array) {
	var div = document.createElement('div');
	div.setAttribute('id', 'post' + ++index);
	div.setAttribute('class', 'blogPost');
	console.log(element.iamge);

	div.innerHTML += "<h1>" + element.title + "</h1>\n"
				  + "<h2> By " + element.author + "</h2>\n"
				  + "<h3>" + moment(element.date, 'YYYYMMDD').fromNow() + "</h3>\n"
				  + "<p>" + element.body + "</p>\n"
				  + "<img src='" + element.image + "'>";
	mainBody.appendChild(div);

});


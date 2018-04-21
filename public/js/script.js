
/**
 *	Сортировка задач
 */
function sort(name) {
	Cookies.set('sort', name);
	location.reload();
}	

/**
 *	Предварительный просмотр
 */
function view() {
	$('.username').text( $('#username').val() );
	$('.email').text( $('#email').val() );
	$('.text').text( $('#text').val() );
}	
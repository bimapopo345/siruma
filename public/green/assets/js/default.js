 document.addEventListener('keydown', function(event) {
 	if (event.ctrlKey && (event.key === 'u' || event.key === 'U')) {
 		event.preventDefault();
 	}
 });
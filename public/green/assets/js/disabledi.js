document.addEventListener('keydown', function(event) {
	if (event.ctrlKey && event.shiftKey && (event.key === 'i' || event.key === 'I')) {
		event.preventDefault();
	}
});
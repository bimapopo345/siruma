@if(session('add'))
<script type="text/javascript">
	document.getElementById('top-right');
	Toastify({
		text: "{{session('add')}}",
		duration: 3000,
		close:true,
		gravity:"top",
		position: "right",
		backgroundColor: "#4fbe87",
	}).showToast();
</script>
@endif
@if(session('up'))
<script type="text/javascript">
	document.getElementById('top-right');
	Toastify({
		text: "{{session('up')}}",
		duration: 3000,
		close:true,
		gravity:"top",
		position: "right",
		backgroundColor: "#4fbe87",
	}).showToast();
</script>
@endif
@if(session('del'))
<script type="text/javascript">
	document.getElementById('top-right');
	Toastify({
		text: "{{session('del')}}",
		duration: 3000,
		close:true,
		gravity:"top",
		position: "right",
		backgroundColor: "red",
	}).showToast();
</script>
@endif
@if(session('email'))
<script type="text/javascript">
	document.getElementById('warning');
	Swal.fire({
		icon: "warning",
		title: "Email sama",
		text: "Email sudah di gunakan, mohon gunakan Email lain.",
	});
</script>
@endif
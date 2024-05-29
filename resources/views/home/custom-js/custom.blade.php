	<script type="text/javascript">
		function masuk() {
			Swal.fire({
				title: 'Masuk ke Desa',
				html: `
				<input type="text" id="title_user_web" autocomplete="off" title="Kode Akses Desa" class="swal2-input" placeholder="Kode Akses">
				<a href="javascript:void(0)" onclick="kirim()" class="btn text-white" style="background: #435ebe;">Masuk Sekarang</a>
				`,
				showConfirmButton: false,
			});
		}
	</script>
	<script type="text/javascript">
		function masuk_langsung() {
			Swal.fire({
				title: 'Masuk ke Desa',
				html: `
				<input type="text" id="title_user_web" value="WPLKG7TIAHJF" autocomplete="off" title="Kode Akses Desa" class="swal2-input" placeholder="Kode Akses">
				<a href="javascript:void(0)" onclick="kirim()" class="btn text-white" style="background: #435ebe;">Masuk Sekarang</a>
				`,
				showConfirmButton: false,
			});
		}
	</script>
	<script type="text/javascript">
		function mail() {
			Swal.fire({
				title: 'Buat Kode Akses Pendaftaran',
				// html: `
				// <span class="text text-danger"><sup><small id="validasi_email"></small></sup></span>
				// <input type="email" id="email" autocomplete="off" title="E-mail anda" class="swal2-input email" placeholder="E-Mail anda ...">
				// <a href="javascript:void(0)" onclick="add()" class="btn text-white" style="background: #435ebe;">Kirim</a>
				// `,
				html: `
				<a href="https://wa.me/6285748275403" target="_blank" class="btn text-white bg-success" style=""><i class="bi bi-whatsapp"></i> Hubungi Admin</a>
				`,
				showConfirmButton: false,
			});
		}
	</script>
</body>
<script type="text/javascript">
	var email = document.getElementById('email');
	$(document).on('keyup','.email',function() {
		var mail=$('#email').val();
		var atps=mail.indexOf("@");
		var dots=mail.lastIndexOf(".");
		if (mail !== '') {
			if (atps<1 || dots<atps+2 || dots+2>=mail.length || !document.getElementById("email").checkValidity())
			{
				document.getElementById('validasi_email').innerHTML = "Masukkan Email dengan benar";
			}
			else
			{
				document.getElementById('validasi_email').innerHTML = "";
			}
		}else{
			document.getElementById('validasi_email').innerHTML = "";
		}
		
	})
</script>
<script type="text/javascript">
	function kirim() {
		var kode=$('#title_user_web').val();
		$.ajax({
			url : "{{route('masuk')}}",
			type : 'POST',
			data : {
				'_method' : 'POST',
				'_token' : '{{ csrf_token() }}',
				'kode' : kode
			},
			success: function(response) {
				if (response.masuk) {
					window.location = "{{url('/')}}"+"/"+kode;
				}
				if (response.notmasuk) {
					Swal.fire({
						icon: 'error',
						title: 'Kode Salah',
						text: 'Kode Akses anda tidak sesuai',
						showConfirmButton: false,
						timer: 1500
					}).then((result) => {
						masuk();
					});
				}
				if (response.kosong) {
					Swal.fire({
						icon: 'warning',
						title: 'Input Kode',
						text: 'Harap masukkan Kode Akses anda.',
						showConfirmButton: false,
						timer: 1300
					}).then((result) => {
						masuk();
					});
				}
			}
		});     
	}
</script>
<script>
	function send() {
		var kode=$('#title_user').val();
		$.ajax({
			url : "{{route('masuk')}}",
			type : 'POST',
			data : {
				'_method' : 'POST',
				'_token' : '{{ csrf_token() }}',
				'kode' : kode
			},
			success: function(response) {
				if (response.masuk) {
					window.location = "{{url('/')}}"+"/"+kode;
				}
				if (response.notmasuk) {
					Swal.fire({
						icon: 'error',
						title: 'Kode Salah',
						text: 'Kode Akses anda tidak sesuai',
						showConfirmButton: false,
						timer: 1500
					});
					$('#title_user').val('');

				}
				if (response.kosong) {
					Swal.fire({
						icon: 'warning',
						title: 'Input Kode',
						text: 'Harap masukkan Kode Akses anda.',
						showConfirmButton: false,
						timer: 1300
					});
				}
			}
		});     
	}
</script>
<script type="text/javascript">
	function add() {
		var email=$('#email').val();
		var atps=email.indexOf("@");
		var dots=email.lastIndexOf(".");
		if (email=='') {
			Swal.fire({
				icon: 'info',
				title: 'Input Email',
				text: 'Harap masukkan Email anda.',
				showConfirmButton: false,
				timer: 1300
			}).then((result) => {
				mail();
			});
		}else{
			if (atps<1 || dots<atps+2 || dots+2>=email.length || !document.getElementById("email").checkValidity()) {
				Swal.fire({
					icon: 'info',
					title: 'Tidak Valid',
					text: 'Masukkan Email anda dengan Benar dan Valid.',
					showConfirmButton: false,
					timer: 1800
				}).then((result) => {
					mail();
				});
			}else{
				$.ajax({
					url : "{{route('buat_kode')}}",
					type : 'POST',
					data : {
						'_method' : 'POST',
						'_token' : '{{ csrf_token() }}',
						'email' : email
					},
					success: function(response) {
						if (response.yes) {
							Swal.fire({
								icon: 'success',
								title: 'Kode Terkirim',
								text: 'Cek E-mail anda untuk Kode Akses Pendaftaran.',
								showConfirmButton: false,
								timer: 1800
							});
						}
						if (response.repeat) {
							Swal.fire({
								icon: 'warning',
								title: 'Kode Sudah di Buat',
								text: 'Anda sudah melakukan Registrasi Kode Pendaftaran Kantor Kelurahan/Desa.',
							});
						}
					}
				});     
			}
		}
	}
</script>
<script type="text/javascript">
	function onScanSuccess(decodedText, decodedResult) {
		var result = $("#result").val(decodedText);
		let keyword = decodedText
		html5QrcodeScanner.clear();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		csrf_token = $('meta[name="csrf-token"]').attr('content');
		let timerInterval
		Swal.fire({
			timer: 3000,
			didOpen: () => {
				Swal.showLoading()
				const b = Swal.getHtmlContainer().querySelector('b')
				timerInterval = setInterval(() => {
					b.textContent = Swal.getTimerLeft()
				}, 400)
			},
			willClose: () => {
				clearInterval(timerInterval)
			},
			backdrop:`
			left top
			no-repeat
			`
		}).then((result) => {
			$.ajax({
				url : "{{route('validasiqrcode')}}",
				type : 'POST',
				data : {
					'_method' : 'POST',
					'_token' : '{{ csrf_token() }}',
					'keyword' : keyword
				},
				success: function(response) {
					if (response.status_error) {
						Swal.fire({
							icon: "error",
							title: "Gagal Masuk",
							text: "Maaf QR CODE Tidak di temukan",
							showConfirmButton: false,
							timer: 1500
						}).then((result) => {
							new Html5QrcodeScanner(
								"reader", { fps: 10, qrbox: 250 });
							html5QrcodeScanner.render(onScanSuccess);
						});
					}
					if (response.berhasil) {    
						window.location = "{{url('/')}}"+"/"+keyword;
					}
				},
				error: function(xhr) {
					Swal.fire({
						icon: "error",
						type: "error",
						title: "Gagal Scan!",
						text: "Silahkan mengulangi Scan anda"
					});
				}
			});     
		})
		$(".swal2-modal").css('background', 'transparent');
	}
	var html5QrcodeScanner = new Html5QrcodeScanner(
		"reader", { fps: 10, qrbox: 250 }, {facingMode: "user"});
	html5QrcodeScanner.render(onScanSuccess);

</script>

@if(session('yes'))
<script type="text/javascript">
	document.getElementById('success');
	Swal.fire({
		icon: "success",
		title: "Register Berhasil",
		text: "Tunggu Konfirmasi dari Pihak Admin melalui Email.",
	});
</script>
@endif
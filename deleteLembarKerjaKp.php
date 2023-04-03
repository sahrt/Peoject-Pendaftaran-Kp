<?php 
require 'function.php';
	class deletePendaftaranKp {
		//deklarasikan variable
		public $conn;

		// buat method hapus
		function hapus($id) {
			global $conn;
			mysqli_query($conn,"DELETE FROM lembar_kerja_kp WHERE id = $id");

			//cek apakah berhasil sintaksnya
			return mysqli_affected_rows($conn);
		}



	}

	// buat objek
	$hapus = new deletePendaftaranKp ();
	//jalankan fungsi hapus sesuai index yang dinginkan
	$dataHapus =  $hapus -> hapus($_GET['id']);
	//cke apakah data berhasil dihapus
	if ($dataHapus > 0) {
			echo "
				<script>
					alert('data berhasil dihapus');
					document.location.href = 'readLembarKp.php';

				</script>
			";
		}else{
			echo "
					<script>
						alert('data gagal dihapus');
						document.location.href = 'readLembarKp.php';

					</script>
			";
	}





 ?>
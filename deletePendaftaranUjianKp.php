<?php 
require'function.php';
	class deleteDataUjianKp {
		//deklarasikan atribut objek
		public $conn;

	//jalankan fungsi hapus
		function hapus($id) {
			global $conn;
			//jalan kan fungsi mysqli query untuk menakses database melakukan perintah yang kita minta untuk menghapus data sesuai dengan id yang kita minta
			mysqli_query($conn,"DELETE FROM pendaftaran_ujian_kp WHERE id = $id");

			//cek apakah berhasil sintaksnya
			return mysqli_affected_rows($conn);
		}


	}

	$hapus = new deleteDataUjianKp ();
	$dataHapus =  $hapus -> hapus($_GET['id']);

	if ($dataHapus > 0) {
			echo "
				<script>
					alert('data berhasil dihapus');
					document.location.href = 'readUjianKp.php';

				</script>
			";
		}else{
			echo "
					<script>
						alert('data gagal dihapus');
						

					</script>
				";


		}



 ?>
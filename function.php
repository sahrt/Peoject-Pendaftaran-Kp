<?php 
//kita koneksikan web server ke database
require 'connect.php';


function query ($query){
	global $conn;
// kita ambil data dari database
	$result = mysqli_query($conn,$query);
	if(!$result){
		echo "
				<script> 
					 alert('daftarkan terlebih dahulu ');
				</script>
			 ";
		header("Location:daftarKelompok.php");
	}
// tempat penampungan data
    $rows = [];
	while ($data = mysqli_fetch_assoc($result)) {
		$rows[] = $data;
	}
	return $rows;
}


function tambahData ($data,$file){ // data user sama file
	global $conn;
	$TempatKp = htmlspecialchars ($data["TempKp"]);
	$AlamatKp = htmlspecialchars ($data["almatKp"]);
	$TanggalMulai = htmlspecialchars ($data["tglMulai"]);
	$TanggalSelesai = htmlspecialchars ($data["tglSelesai"]);
	$idAnggotaKel = htmlspecialchars ($data["anggtKelompok"]);
	$DosenID = htmlspecialchars ($data["dosenId"]);
	$PerusahaanId = htmlspecialchars ($data["persId"]);
	// file
	// uploud proposal

	$NamaProposal = uploud($file,"img");
	// cek keberasilan
	if (!$NamaProposal) {
		return false;
	}



	// masukan sintak querrnya
	$query = "INSERT INTO mahasiswa
			  VALUES (
			  '',
			  '$TempatKp',
			  '$AlamatKp',
			  '$TanggalMulai',
			  '$TanggalSelesai',
			  '$idAnggotaKel',
			  '$NamaProposal',
			  '$DosenID',
			  '$PerusahaanId'
			  )	
			";
	//kita masukan kedalam databases
			mysqli_query($conn,$query);
	//kemudian kita cek apakah datanya berhasil masuk database jika berhasil true tidak false
			//bertujuan untuk mengtifkan feedback
			$cek = mysqli_affected_rows($conn);
			return $cek;

}


function tambahdataUjianKp ($data, $file) {
	global $conn;
	// dibaca id dosen jadwalnya kapan
	$accUjianKp = htmlspecialchars ($data["accUjianKp"]);
	//ambil jadwal ujian kp
	$jadwalUji = mysqli_query($conn,"SELECT Jadwal_Ujian FROM acc_ujian WHERE id = $accUjianKp");
	$result = mysqli_fetch_assoc($jadwalUji);
	$jadUji = join($result);
	$pendafKp = htmlspecialchars ($data["pendafKp"]);
	
	// file
	// uploud proposal

	$NamaLaporan = uploud($file,"laporan");
	// cek keberasilan
	if (!$NamaLaporan) {
		return false;
	}
	// masukan sintak querrnya
	$query = "INSERT INTO pendaftaran_ujian_kp
			  VALUES (
			  '',
			  '$NamaLaporan',
			  '$jadUji',
			  '$pendafKp',
			  '$accUjianKp'
			  )	
			";
	//kita masukan kedalam databases
			mysqli_query($conn,$query);
	//kemudian kita cek apakah datanya berhasil
		$cek = mysqli_affected_rows($conn);
		return $cek;
}

function UploudLembarKp($data,$file){
	global $conn;
	//masukan semua inputan user kedalam masing-masing variabel 
	$tanggal = htmlspecialchars($data['tanggal']);
	$kelompokId =htmlspecialchars($data['anggota']);
	$namaFile = uploud($file,"lembar");
	if (!$namaFile) {
		return false;
	}
	//masukan sintak querynya
	$query1 = "INSERT INTO  lembar_kerja_kp
			  VALUES (
			  '',
			  '$tanggal',
			  '$namaFile',
			  '$kelompokId'
			 )
			";
	//masukan kedalam database
			mysqli_query($conn,$query1);
	//cek apakah connectsi berhasil
			$cek = mysqli_affected_rows($conn);
			return $cek;

}
function tambahKetua ($ketua) {
	global $conn;
	//data ketua
	var_dump($ketua);
	$namaKetua = htmlspecialchars ($ketua ['namaKetua']);
	$Nim = htmlspecialchars ($ketua['NimKetua']);
	//masukan kedalam query
	$query = " INSERT INTO anggota_kelompok
			   VALUES (
			   	'',
			   	'$namaKetua',
			   	'$Nim'
			   	)

			"; 
	// masukan kedalam database
			mysqli_query ($conn, $query);
	// cek apakah berhasil 
			$cek =  mysqli_affected_rows($conn);
			return $cek;


}

function tambahAnggota($anggota) {
	global $conn;
	//data anggota
	$namaAnggota = $anggota['namaKelompok'];
	$nim = $anggota['nim'];
	$kelas = $anggota['kelas'];
	$email = $anggota['email'];
	$alamat = $anggota['alamat'];
	$userId = $anggota['userId'];
	$anggotaId = $anggota['anggotaId'];

		$query = "INSERT INTO user_mahasiswa
			   VALUES (
			   	'',
			   	'$namaAnggota',
			   	'$nim',
			   	'$kelas',
			   	'$email',
			   	'$alamat',
			   	'$userId',
			   	'$anggotaId'
			   	)
			"; 

	// masukan kedalam database
			mysqli_query ($conn, $query);
	// cek apakah berhasil 
			$cek =  mysqli_affected_rows($conn);
			return $cek;


}


function gantiOrNo($dataInput,$oldFile){
	if ($dataInput === null) {
	// jika user tidak menganti data maka mengunakan nama yang lama
		$dataInput= $oldFile;
	
	} else {
		// jika user menganti file proposal maka akan digantikan file baru
		$dataInput = htmlspecialchars ($dataInput);
	}
	return $dataInput;
}


function ubahDataPendaftaran_Kp($data,$file){

 	global$conn;
 	//AMBIL DATA FROM
 	$id = $data["id"];
	$TempatKp = htmlspecialchars ($data["TempKp"]);
	$AlamatKp = htmlspecialchars ($data["almatKp"]);
	$TanggalMulai  = htmlspecialchars($data["tglMulai"]);
	$TanggalSelesai = htmlspecialchars($data["tglSelesai"]);

	// CEK APAKAH USER MENGANTI FILE
	$NamaProposalLama = htmlspecialchars($data["fileLama"]);

	//cek apakah user pilih file baru atau tidak
	if ($file['error'] === 4) {
	// jika user tidak menganti file proposal maka mengunakan nama yang lama
		$NamaProposal = $NamaProposalLama;
	} else {
		// jika user menganti file proposal maka akan digantikan file baru
		$NamaProposal = uploud($file,"img");
	}

	$idAnggotaKel = htmlspecialchars ($data["anggtKelompok"]);
	$DosenID = htmlspecialchars ($data["dosenId"]);
	$PerusahaanId = htmlspecialchars ($data["persId"]);

	// masukan sintak querrnya
	$query = "UPDATE mahasiswa 
			  SET
			  Tempat_KP ='$TempatKp',
			  Alamat_KP ='$AlamatKp',
			  Tanggal_Mulai ='$TanggalMulai',
			  Tanggal_Selesai ='$TanggalSelesai',
			  Proposal ='$NamaProposal',
			  anggota_Kelompok_Id  ='$idAnggotaKel',
			  Dosen_Id ='$DosenID',
			  Perusahaan_Id ='$PerusahaanId'
			  WHERE id =$id
			";
	//kita masukan kedalam databases
			mysqli_query($conn,$query);
	//kemudian kita cek apakah datanya berhasil
			$cek = mysqli_affected_rows($conn);
			echo mysqli_error($conn);
			return $cek;
}

function UbahPendaftarUjianKp ($data , $file){
	global $conn;
	// dibaca id dosen jadwalnya kapan
	$id = $data ["id"];
	$accUjianKp = htmlspecialchars ($data["accUjianKp"]);
	//ambil jadwal ujian kp
	$jadwalUji = mysqli_query($conn,"SELECT Jadwal_Ujian FROM acc_ujian WHERE id = $accUjianKp");
	$result = mysqli_fetch_assoc($jadwalUji);
	$jadUji = join($result);
	$pendafKp = htmlspecialchars ($data["pendafKp"]);
	
	
	//cek user paakah mengati file
	$laporanLama = htmlspecialchars ($data["laporanLama"]);
	if ($file['error'] === 4) {
	// jika user tidak menganti file proposal maka mengunakan nama yang lama
		$NamaLaporan = $laporanLama;
	} else {
		// jika user menganti file proposal maka akan digantikan file baru
		$NamaLaporan = uploud($file,"laporan");
	}
	//masukan sintak querry nya
	$query = "UPDATE pendaftaran_ujian_kp
			  SET
			  Laporan_KP ='$NamaLaporan',
			  Jadwal_Ujian ='$jadUji',
			  Pendaftaran_Kp_Id ='$pendafKp',
			  Acc_Ujian_id ='$accUjianKp'
			  WHERE Id = $id	
				
			";
	//kita masukan kedalam databases
			mysqli_query($conn,$query);
	//kemudian kita cek apakah datanya berhasil
		$cek = mysqli_affected_rows($conn);
		return $cek;

}

function ubahDataKp ($data, $file){
	//ambil semua user
	global $conn;
	$id = $data['Id'];
	$tanggal =  $data['tanggal'];
	$idAnggotaKel = $data['anggota'];
	$lembarLama = $data['lembarLama'];

	// penetuan ada file baru ngak
	if ($file['error']===4) {
		$namaFile = $lembarLama;
	}else{
		$namaFile = uploud($file,"lembar");

	}
	//masuka sintak querynya
	$queryq = " UPDATE lembar_kerja_kp
			   SET
			   Tanggal ='$tanggal',
			   NamaFile ='$namaFile',
			   Anggota_Kelompok_Id = '$idAnggotaKel'
			   WHERE Id = $id ";

	//masukan kedalam database
	mysqli_query($conn, $queryq);
	//cek apakah data berhasul masuk
	$cek = mysqli_affected_rows($conn);
	return $cek;	
}


// MENGUNAKAN LIKE DAN (WHILE CARD %) DIMANA MNECARI YANG DEPANYA  DAN BELAKANG MIRIP KEYWORD
function search($keyword,$table, $field1, $field2 , $field3) {
	$query1 = "SELECT * FROM $table
			  WHERE
			  $field1 LIKE '%$keyword%' OR 
			  $field2 LIKE '%$keyword%' OR 
			  $field3 LIKE '%$keyword%'
			 ";
	return query ($query1);
}

function uploud ($file, $tempat){
	// ambil isi semua array$_files
	// uploud1 didiapat dari name fromnya
	$namaFile = $file['namafile'];
	$typeFile = $file['type'];
	$ukuranfile = $file['size'];
	$error= $file['error'];
	$tmpName= $file['temp_name'];
	
	//cek apakah tidak ada file yang diuploud
	// angka 4 menandakan tidak ada file yang diuploud
	if ($error === 4) {
		echo "
			<script>
				alert('pilih File terlebih dahulu');
				
			</script>
		";
		
		return false;
	}
	 // menentukan file yang diberikan ektensi gambar apa yang ynag diijinkan
	$ekstensiFileValid=['pdf','doc'];
	// explode yaitu fungsi yang digunakan untuk memecah sebuah string menjadi arry mengunakan delaimiter (karakter)
	$ekstensiGambar = explode('.', $namaFile);
	// mengambil yang terakhir dengan mengunakan fungsi php END/end ()dan diubah semuany menjadi huruf kecil dengan fungsi /strtolower()/
	// untuk menyesuaikan array
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	//fungsi /in_array digunakan untuk mengecek data apakah ada dalam array
 	// artinya neeedle jarum
 	//haystack jerami yang artinya mencari jarum dalam jerami, mencari jarum dalam jerami hasilnya adalah bolean
	if (!in_array($ekstensiGambar, $ekstensiFileValid)) {
		echo "
			<script>
				alert('yang anda upload belum sama dengan format');
			
			</script>
		";
		// program langsung di hentikan
	
	return false;
	}

	//cek jika ukuran filenya terlalu besar
	if ($ukuranfile > 5000000) {
		echo "
			<script>
				alert('ukuran file terlalu besar');
				
			</script>
		";
		return false;
	}
	// lolos pengecekan, gambar siap uploud dengan mengunakan fungsi move_uploded_file dengan argument( filename/ tempName, Tujuan filenya );
	// generate nama baru untuk mencegah kesamaan data
	// fungsi uniqid() memberikan nama secara random kepada file
	// membentuk nama uniq.ekstensi filenya
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;
	$berhasilUploud = move_uploaded_file($tmpName, "$tempat/".$namaFileBaru);

	return $namaFileBaru;


} 


function registrasi ($data){
	
	global $conn;
	// stripcslashes membersikan user karakter tertentu dengan cara menghilangkan karakter tertentu
	$username = strtolower (stripcslashes($data["username"]));
	// untuk memungkinkan user ada tandakutip tanda kutip
	$password = mysqli_real_escape_string($conn,$data["password"]);
	$password2 = mysqli_real_escape_string ($conn,$data["password2"]);
	// cek username sudah ada atau tidak
	$userRole = htmlspecialchars ($data['userRole']);
	$result = mysqli_query($conn, "SELECT username FROM user WHERE username  ='$username'");
	if (mysqli_fetch_assoc ($result)) {
			echo "<script>
				alert('username sudah terdaftar masukan username lain');
			  </script>
			";
			//stoped program
			return false;
	}
	//cek konfirmasi pasword 
	if ($password !== $password2) {
		echo "<script>
				alert('konfirmasi password  dan password tidak sesuai');
			  </script>
			";
		return false;
	} 
	//kita enkripsi
	//md 5 akan sangat berbahaya karena bisa dilihat passwordnya
	// untuk keamanan kita enkripsi password dengan password_hash(file, alogaritma);
	$password = password_hash($password, PASSWORD_DEFAULT);

	//tambahkan user baruu ke database user
	mysqli_query($conn, "INSERT INTO user VALUES('','$username','$password','$userRole')");
	// kita cek apakah data berhasil ditambahakan dengan mengunakan mysqli_affected_rows($dataHubungan) ini akan mengebalikan nilai data bolean
	return mysqli_affected_rows($conn);



}


?>
<?php 
// cek dulu apakah ada sessionnya ngak ?

// class model yang digunakan mendaftar lembar kp
class Lembar_Kp{
	//dekalarisikan atribut objek
	public $tanggal;
	public $nameFile;
	public $type;
	public $temp;
	public $error;
	public $size;
	private $anggotaKelompokId;

	public function setArtribut () {
		$this ->anggotaKelompokId;
	}
	public function getAtribut () {
		return $this ->anggotaKelompokId;
	}

	//ambil data yang dimputkan user
	public function ambilUser ($data){
		$data1 = $this ->tanggal =  $data ['tanggal'];
		$idAnggota = $this ->anggotaKelompokId = $data ['anggota'];
		//menyipan array
		$arrayInputan =[
						"tanggal" => $data1,
						"anggota" => $idAnggota
					   ];
		return $arrayInputan;
	}



	// ambil semua data dalam variabel gelobal $_FILES
	public function ambilFile ($file){
		foreach ($file as $item) {
			$nama = $this->nameFile = $item['name'];
			$type = $this->type = $item ['type'];
			$temp_name = $this ->temp = $item['tmp_name'];
			$error = $this ->error =$item['error'];
			$size = $this ->size =$item['size'];
		}
		//meyimpan mengunakan array asosiatif
		$arrayFiles = [
					 	"namafile" => $nama,
					 	"type" => $type, 
					 	"temp_name" => $temp_name, 
					 	"error" => $error, 
					 	"size" => $size
					 ];

		return $arrayFiles;
	}


}


 ?>
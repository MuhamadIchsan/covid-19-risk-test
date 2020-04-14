<?php
include '../config/koneksi.php';
if (isset($_POST['done'])) {
    echo "<script>alert('Terimakasih Telah Melakukan Pengisian');document.location.href='../index.php'</script>";
}


       if(isset($_POST['submit'])){
            $pilihan=$_POST["pilihan"];
            $id_soal=$_POST["id"];
            $jumlah=$_POST['jumlah'];
            
            $score=0;
            $benar=0;
            $salah=0;
            $kosong=0;
            
            for ($i=0;$i<$jumlah;$i++){
                //id nomor soal
                $nomor=$id_soal[$i];
                
                //jika user tidak memilih jawaban
                if (empty($pilihan[$nomor])){
                    $kosong++;
                }else{
                    //jawaban dari user
                    $jawaban=$pilihan[$nomor];
                    
                    //cocokan jawaban user dengan jawaban di database
                    $query=mysqli_query($con, "SELECT * FROM tbl_soal WHERE id_soal='$nomor' and knc_jawaban='$jawaban'");
                    
                    $cek=mysqli_num_rows($query);
                    
                    if($cek){
                        //jika jawaban cocok (benar)
                        $benar++;
                    }else{
                        //jika salah
                        $salah++;
                    }
                    
                } 
                /*RUMUS
                Jika anda ingin mendapatkan Nilai 100, berapapun jumlah soal yang ditampilkan 
                hasil= 100 / jumlah soal * jawaban yang benar
                */
                
                $result=mysqli_query($con, "SELECT * FROM tbl_soal WHERE aktif='Y'");
                $jumlah_soal=mysqli_num_rows($result);
                $score = 100/$jumlah_soal*$benar;
                $hasil = number_format($score,1);
            }
        }

        //Lakukan Penyimpanan Kedalam Database
     
         if ( $benar <= 7) {
                $resiko = "Rendah";
        }elseif($benar<=14){
               $resiko = "Sedang";
                    
        }else{
            $resiko = "Tinggi";
        }
        ?>
        
        <!DOCTYPE html>
   <html>
   <head>
    <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
    <title>COVID-19 RISK TEST</title>
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="../img/covid_12.jpg" />
   </head>
   <body background="../img/covid_13.jpg">
    <center>
   <div class="col-lg-6">
    
                <div class="p-5">
                  <div class="text-center">
                    
                    <h1 class="h1 text-gray-900 mb-1">COVID-19 RISK TEST</h1>
                    <h3 class="h1 text-gray-900 mb-1">HASIL TEST</h3>
                  </div>
                  
                  <form method="post" class="user">
                    <div class="form-group">
                      
      <div class="form-group">
      <table >
        <div class="row">
         
         <div class="col">
            <p>Jumlah Jawaban : Ya</p>
            <input type="text" name="" class="form-control"  value="<?php echo $benar ?>" disabled>
         </div>
         <div class="col">
            <p>Jumlah Jawaban : Tidak</p>
            <input type="text" name="" class="form-control" value="<?php echo $salah ?>"disabled >
         </div>
         <div class="col">
            <p>Resiko Tertular</p>
            <input type="text" name="" class="form-control" value="<?php echo $resiko ?>" disabled>
         </div>
         
        </div>
         

        </table></div>
        
                    </div>
                    <input type="submit" name="done" value="Selesai" class="btn btn-primary btn-user btn-block">
                  </form>
                  
                  
                </div>
              </div>
              </center>
   </body>
   </html>
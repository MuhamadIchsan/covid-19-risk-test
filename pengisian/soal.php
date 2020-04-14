<?php

include '../config/koneksi.php';



    echo "<center>
    <h2><b>PERTANYAAN</b></h2>
    </center>";
echo "<div style='width:100%; border: 1px solid #EBEBEB; overflow:scroll;height:700px;'>";
 echo '<table width="100%" border="0">';

        $hasil=mysqli_query($con, "SELECT * FROM tbl_soal WHERE aktif='Y' ORDER BY RAND ()");
        $jumlah=mysqli_num_rows($hasil);
        $urut=0;
        while($row =mysqli_fetch_array($hasil))
        {
            $id=$row["id_soal"];
            $pertanyaan=$row["soal"];
            $pilihan_a=$row["a"];
            $pilihan_b=$row["b"];
            
            
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

                <title>COVID-19 RISK TEST</title>
                 <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="../img/covid_12.jpg" />
            </head>

            <body background="../img/covid_13.jpg">
                
                    <div>
             <form name="form1" method="post" action="jawab.php">
                <table>
            <div class="form-group">
            <input type="hidden" name="id[]" value="<?php echo $id; ?>" >
            <input  type="hidden" name="jumlah" value="<?php echo $jumlah; ?>"  >
            
            <tr>
                  <td class=""><h5 ><?php echo $urut=$urut+1; ?></h5>

                  </td>
                  <td>.</td>
                  <td class="col-9">
                      <input class="form-control" value="<?php echo $pertanyaan ?>" disabled>
                  </td>
            </tr>
            
            <tr>
                <td></td>
                 
                  <td height="21"><font color="#000000">&nbsp;</font></td>
                <td><font color="#000000">
                 <input name="pilihan[<?php echo $id; ?>]" type="radio" value="A"> 
                <?php echo "$pilihan_a";?></font> </td>
            </tr>
            <tr>
                 <td></td>
                 
                 <td><font color="#000000">&nbsp;</font></td>
                <td><font color="#000000">
                <input name="pilihan[<?php echo $id; ?>]" type="radio" value="B"> 
                <?php echo "$pilihan_b";?></font> </td>
            </tr>
            <tr>
            </div>
        <?php
        }
        ?>

            <tr>
                <td>&nbsp;</td>
                  <td><input class="btn btn-primary btn-user" type="submit" name="submit" value="Jawab" onclick="return confirm('Apakah Anda yakin dengan jawaban Anda?')" ></td>
                  
            </tr>

            </table>
</form>
        </p>
</div>

</div>


            </body>
            </html>

           
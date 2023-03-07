<?php
$web_title="Biodata | Pemweb-A";
$judul="Bio.";
$kelas="Pemweb-A081";
$nama="M. Fihris Aldama";
$npm="21081010110";
$tanggal_lahir="2003-05-13";

// method 1 -> Manual String to time (detik)
$date_lahir=strtotime($tanggal_lahir);
$selisih_waktu=strtotime("now")-$date_lahir;
$umur=($selisih_waktu)/60/60/24/365;

//method 2 -> PHP Datetime Objek (diff)
// $date_lahir = new Datetime($tanggal_lahir);
// $date_now = new Datetime("Now");
// $objek_selisih_waktu = $date_now->diff($date_lahir);
// $umur = $objek_selisih_waktu->y;
// $umur_bulan = $objek_selisih_waktu->m;
// $umur_hari = $objek_selisih_waktu->d;

$jurusan="Informatika";
$about="My Name is Muhamad Fihris Aldama, they call me Aldam. Student from UPN
\"Veteran\" Jawa Timur. I am interested to Web Development especially
Front-End Development. Recently I studied HTML, CSS, Javascript, and
PHP.";
$social_url=array("instagram"=>"https://www.instagram.com/muhamadfihris/", "github"=>"https://github.com/fihrisaldama015/");
$sertif_1=array("judul"=>"Git Fundamental", "company"=>"Progate", "link"=>"https://progate.com/course_certificate/ddc975f1qzfeep");
$sertif_2=array("judul"=>"Belajar Membuat Font-End Web untuk Pemula", "company"=>"Dicoding Indonesia", "link"=>"https://www.dicoding.com/certificates/6RPNDN6D5Z2M");
$alamat="Jalan Medayu Selatan XV No.29, RW 04, Medokan Ayu, Rungkut, Surabaya, East Java, 60295, Indonesia"
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $web_title; ?></title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <nav class="nav">
      <div class="nav-hero">
        <img src="./upn.png" width="64" height="64" alt="upn" />
        <div class="red-1"></div>
        <h1><?= $title; ?></h1>
      </div>
      <div class="blue-container">
        <p class="kelas"><?= $kelas; ?></p>
        <div class="blue"></div>
        <hr />
      </div>
    </nav>
    <div class="hero">
      <div class="elemenFoto">
        <div class="social">
          <a href="<?= $social_url['instagram'] ?>" target="_blank">
            <img
              src="./pngkey.com-instagram-png-775860.png"
              alt=""
              width="24"
            />
          </a>
          <a href="<?= $social_url['github'] ?>" target="_blank">
            <img src="./github.png" alt="" width="24" />
          </a>
        </div>
        <img src="./foto.png" alt="profile-pic" class="hero-picture" />
      </div>
      <div class="info">
        <h1><?= $nama; ?></h1>
        <div class="red"></div>
        <p><?= $npm."//".$jurusan;?> | <b><?= round($umur,1) ?></b>  Tahun</p>
      </div>
    </div>
    <div class="about">
      <div class="card">
        <h3>Introduction</h3>
        <p><?= $about; ?></p>
        <h3>Certificate</h3>
        <div class="container-sertif">
          <div class="sertif">
            <img src="./progate.jpeg" alt="progate" />
            <div class="sertif-detail">
              <h5><?= $sertif_1['judul']; ?></h5>
              <p><?= $sertif_1['company'] ?></p>
              <div class="credential">
                <a
                  href="<?= $sertif_1['link'] ?>"
                  target="_blank"
                >
                  <span>
                    Show Credential <img src="./credential.svg" alt="arrow" />
                  </span>
                </a>
              </div>
            </div>
          </div>
          <div class="sertif">
            <img src="./dicoding.jpeg" alt="progate" />
            <div class="sertif-detail">
              <h5><?= $sertif_2['judul'] ?></h5>
              <p><?= $sertif_2['company'] ?></p>
              <div class="credential">
                <a
                  href="<?= $sertif_2['link'] ?>"
                  target="_blank"
                >
                  <span>
                    Show Credential <img src="./credential.svg" alt="arrow" />
                  </span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="maps">
      <iframe
        frameborder="0"
        scrolling="no"
        marginheight="0"
        marginwidth="0"
        src="https://www.openstreetmap.org/export/embed.html?bbox=112.79854327440263%2C-7.3316778579201785%2C112.80059784650804%2C-7.330366338255132&amp;layer=mapnik&amp;marker=-7.331022098570438%2C112.79957056045532"
      ></iframe>
      <div class="viewMap">
        <a
          href="https://www.openstreetmap.org/?mlat=-7.33102&amp;mlon=112.79957#map=19/-7.33102/112.79957"
          target="_blank"
        >
          Lihat Detail.
        </a>
      </div>
      <div class="address">
        <p>
          <?= $alamat; ?>
        </p>
      </div>
    </div>
  </body>
</html>

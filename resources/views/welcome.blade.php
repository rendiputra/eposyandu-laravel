@extends('layouts.front')
@section('title','E-Posyandu')
@section('css')
<style>
.card
{
    margin-bottom: 25px;
}
.card-img-top 
{
    width: 100%;
    height: 300px;
    object-fit: cover;
}

.card-img-top-bottom
{
  border-bottom-left-radius: calc(0.625rem - 2px);
  border-bottom-right-radius: calc(0.625rem - 2px);
}
</style>
@endsection
@section('content')

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" data-navbar-on-scroll="data-navbar-on-scroll">
        <div class="container"><a class="navbar-brand d-flex align-items-center fw-bold fs-2" href="{{url('/')}}"><img class="d-inline-block me-3" src="{{asset('asset/img/icons/logo.png')}}" alt="" />E-Posyandu</a>
          <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
          <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto pt-2 pt-lg-0">
              <li class="nav-item"><a class="nav-link fw-bold active" aria-current="page" href="#">Home</a></li>
              <li class="nav-item"><a class="nav-link" href="#tentang">Tentang E-Posyandu</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ route('infografik_balita') }}">Info Grafik</a></li>
              <li class="nav-item"><a class="nav-link" href="#tka">Tumbuh Kembang Anak</a></li>
              <li class="nav-item"><a class="nav-link" href="#artikel">Artikel</a></li>
              <li class="nav-item"><a class="nav-link" href="#alamat">Alamat</a></li>
              <li class="nav-item"><a class="nav-link" href="#galeri">Galeri</a></li>
            @guest
              <li class="nav-item"><a class="nav-link" href="{{route('login')}}">Masuk</a></li>
            @else
              <li class="nav-item"><a class="nav-link" href="{{route('home')}}">Dashboard</a></li>
            @endguest
            </ul>
          </div>
        </div>
      </nav>
      <section class="pt-0 pb-8">
        <div class="bg-holder" style="background-image:url({{asset('asset/img/illustrations/dot.png')}});background-position:left;background-size:auto;margin-top:-105px;">
        </div>

        <!--/.bg-holder-->

        <div class="container position-relative">
          <div class="row align-items-center">
            <div class="col-md-5 col-lg-6 order-md-1 pt-8">
              <img class="img-fluid" src="{{asset('asset/img/illustrations/hero-header.webp')}}" alt="" />
            </div>
            <div class="col-md-7 col-lg-6 text-center text-md-start pt-5 pt-md-9">
			        <p class="mt-3 mb-4 fs-1">Selamat datang di website</p>
              <h1 class="mb-4 display-3 fw-bold">E-Posyandu</h1>
			        <a class="btn btn-lg btn-primary rounded-pill hover-top" href="#tentang" role="button">Eksplor</a>
            </div>
          </div>
        </div>
      </section>
      <section class="py-5" id="tentang">
        <div class="bg-holder" style="background-image:url({{asset('asset/img/illustrations/dot-2.png')}});background-position:center right;background-size:auto;margin-left:-180px;margin-top:20px;">
        </div>
        <!--/.bg-holder-->

        <div class="container-lg">
          <div class="row justify-content-center">
            <div class="col-auto text-center">
              <h2 class="fw-bold">Tentang E-Posyandu</h2>
              <hr class="w-25 mx-auto text-dark" style="height:2px;" />
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="pb-3"></div>
            <div class="col-sm-10 col-xl-10 text-center">
            <p align="justify">
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. At, dicta repellendus cumque veritatis voluptatum quae, magnam pariatur in suscipit perspiciatis eligendi? Dolores beatae voluptas perferendis eum id doloribus quia quaerat?
            </p>
            <p align="justify">
              Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nam tenetur adipisci et possimus enim quam quaerat sint dolorem. Provident quibusdam laboriosam eius fuga sunt quis. Minus odio provident nulla architecto, praesentium ullam id assumenda commodi aut, dolores eveniet neque tenetur iusto ipsum dolore ipsam aperiam! Aspernatur sunt repellendus dolor. Veritatis quas illum quia tempore sapiente cum quo facilis amet perspiciatis.
            </p>
            </div>
          </div>
		</section>

      <section class="py-5" id="tka">
        <div class="bg-holder" style="background-image:url({{asset('asset/img/illustrations/dot-2.png')}});background-position:center right;background-size:auto;margin-left:-180px;margin-top:20px;">
        </div>
        <!--/.bg-holder-->

        <div class="container-lg">
          <div class="row justify-content-center">
            <div class="col-auto text-center">
              <h2 class="fw-bold">Stimulasi, Deteksi dan Intervensi Dini Tumbuh Kembang Anak</h2>
              <hr class="w-25 mx-auto text-dark" style="height:2px;" />
            </div>
          </div>
          <div class="row justify-content-start">
            <div class="pb-3"></div>
            <div class="col-12">

          <p><strong style="font-size: 1.2em"> Mengenal perkembangan pertumbuhan anak  </strong></p>
          <p>Keberhasilan anak dalam mencapai pertumbuhan dan perkembangan yang optimal akan mempengaruhi masa depan suatu bangsa. Tahun-tahun pertama merupakan periode terpenting dalam pertumbuhan dan perkembangan baik positif maupun negatif. Nutrisi yang cukup, status kesehatan yang baik, pengasuhan yang benar dan stimulasi yang tepat akan membantu anak untuk tumbuh dan berkembang untuk mencapai kemampuan optimal.</p>
          <p><strong style="font-size: 1.2em">Pengertian pertumbuhan dan perkembangan</strong></p>
          <p> Pertumbuhan adalah bertambahnya ukuran dan jumlah sel serta jaringan interseluler, berarti bertambahnya ukuran fisik dan struktur tubuh sebagian atau keseluruhan. Perkembangan adalah bertambahnya struktur dan fungsi tubuh yang lebih kompleks dalam kemampuan gerak, bicara, sosialisasi dan kemandirian. Pertumbuhan terjadi secara simultan dengan perkembangan. </p>
          <p><strong style="font-size: 1.2em">Faktor mempengaruhi tumbuh kembang anak</strong></p>
          <p>Kualitas tumbuh kembang anak merupakan hasil interaksi berbagai faktor yang mempengaruhi mulai dari faktor internal maupun eksternal. </p>
				
        <div class="collapse" id="collapseExample">
          <p>
          <ol type="a">
            <li>
              Faktor internal yang mempengaruhi tumbuh kembang anak seperti: ras/etnik, keluarga, umur, jenis kelamin, dan genetik. 
            </li>
            <li>
              Faktor eksternal yang mempengaruhi tumbuh kembang anak dibagi menjadi tiga yaitu faktor prenatal, persalinan dan pasca persalinan. 
              <ol>
                <li>
                  Faktor prenatal (sebelum kelahiran) seperti: gizi, mekanis, toksin/zat kimia, endokrin, radiasi, infeksi, kelainan imunologi, anoksia embrio, dan psikologi ibu. 
                </li>
                <li>
                  Faktor persalinan (sewaktu kelahiran) seperti komplikasi persalinan yang terjadi pada bayi seperti trauma kepala, asfiksia yang dapat merusak jaringan otak. 
                </li>
                <li>
                  Faktor pasca persalinan (sesudah kelahiran) seperti: gizi, penyakit kronis, lingkungan fisis dan kimia, psikologis, endokrin, sosio-ekonomi, lingkungan pengasuhan, stimulasi, dan obat-obatan.
                </li>
              </ol>
            </li>
          </ol>
          </p>
          <p><strong style="font-size: 1.2em">Tahapan perkembangan anak menurut umur</strong></p>
          <p>
          <ol>
            <li>
              Umur 0-3 bulan
              <br>
              Mengangkat kepala setinggi 45*
              <br>
              Menggerakkan kepala dari kiri/kanan ke tengah.
              <br>
              Melihat dan menatap wajah anda.
              <br>
              Mengoceh spontan atau bereaksi dengan mengoceh.
              <br>
              Suka tertawa keras.
              <br>
              Beraksi terkejut terhadap suara keras.
              <br>
              Membalas tersenyum ketika diajak bicara/tersenyum.
              <br>
              Mengenal ibu dengan penglihatan penciuman, pendengaran, kontak.
              <br>
            </li>
            <li>
              Umur 3-6 bulan
              <br>
              Berbalik dari telungkup ke terlentang.
              <br>
              Mengangkat kepala setinggi 90*
              <br>
              Mempertahankan posisi kepala tetap tegak dan stabil.
              <br>
              Menggenggam pensil.
              <br>
              Meraih benda yang ada dalam jangkauannya. 
              <br>
              Memegang tangannya sendiri. 
              <br>
              Berusaha memperluas pandangan.
              <br>
              Mengarahkan matanya pada benda-benda kecil.
              <br>
              Mengeluarkan suara gembira bernada tinggi atau memekik. 
              <br>
              Tersenyum ketika melihat mainan/gambar yang menarik saat bermain sendiri.
              <br>
            </li>
            <li>
              Umur 6-9 bulan
              <br>
              Duduk (sikap tripoid - sendiri)
              <br>
              Belajar berdiri, kedua kakinya menyangga sebagian berat badan.
              <br>
              Merangkak meraih mainan atau mendekati seseorang.
              <br>
              Memindahkan benda dari tangan satu ke tangan yang lain.
              <br>
              Memungut 2 benda, masing-masing lengan pegang 1 benda pada saat yang bersamaan. 
              <br>
              Memungut benda sebesar kacang dengan cara meraup. 
              <br>
              Bersuara tanpa arti, mamama, bababa, dadada, tatata. 
              <br>
              Mencari mainan/benda yang dijatuhkan.
              <br>
              Bermain tepuk tangan/ciluk baa. 
              <br>
              Bergembira dengan melempar benda. 
              <br>
              Makan kue sendiri
              <br>
            </li>
            <li>
              Umur 9-12 bulan
              <br>
              Mengangkat benda ke posisi berdiri.
              <br>
              Belajar berdiri selama 30 detik atau berpegangan di kursi.
              <br>
              Dapat berjalan dengan dituntun.
              <br>
              Mengulurkan lengan/badan untuk meraih mainan yang diinginkan.
              <br>
              Menggenggam erat pensil. 
              <br>
              Memasukkan benda ke mulut.
              <br>
              Mengulang menirukan bunyi yang didengarkan. 
              <br>
              Menyebut 2-3 suku kata yang sama tanpa arti.
              <br>
              Mengeksplorasi sekitar, ingin tau, ingin menyentuh apa saja.
              <br>
              Bereaksi terhadap suara yang perlahan atau bisikan.
              <br>
              Senang diajak bermain “CILUK BAA”.
              <br>
              Mengenal anggota keluarga, takut pada orang yang belum dikenali Umur 12-18 bulan
              <br>
            </li>
            <li>
              Umur 12-18 bulan
              <br>
              Berdiri sendiri tanpa berpegangan.
              <br>
              Membungkuk memungut mainan kemudian berdiri kembali.
              <br>
              Berjalan mundur 5 langkah. 
              <br>
              Memanggil ayah dengan kata “papa”. Memanggil ibu dengan kata “mama” 
              <br>
              Menumpuk 2 kubus. 
              <br>
              Memasukkan kubus di kotak.
              <br>
              Menunjuk apa yang diinginkan tanpa menangis/merengek, anak bisa mengeluarkan suara yang menyenangkan atau menarik tangan ibu.
              <br>
              Memperlihatkan rasa cemburu / bersaing.
              <br>
            </li>
            <li>
              Umur 18-24 bulan
              <br>
              Berdiri sendiri tanpa berpegangan selama 30 detik. 
              <br>
              Berjalan tanpa terhuyung-huyung. 
              <br>
              Bertepuk tangan, melambai-lambai. 
              <br>
              Menumpuk 4 buah kubus. 
              <br>
              Memungut benda kecil dengan ibu jari dan jari telunjuk. 
              <br>
              Menggelindingkan bola kearah sasaran. 
              <br>
              Menyebut 3-6 kata yang mempunyai arti.
              <br>
              Membantu/menirukan pekerjaan rumah tangga.
              <br>
              Memegang cangkir sendiri, belajar makan - minum sendiri
              <br>
            </li>
            <li>
              Umur 24-36 bulan
              <br>
              Jalan naik tangga sendiri.
              <br>
              Dapat bermain dengan sendal kecil. 
              <br>
              Mencoret-coret pensil pada kertas.
              <br>
              Bicara dengan baik menggunakan 2 kata. 
              <br>
              Dapat menunjukkan 1 atau lebih bagian tubuhnya ketika diminta. 
              <br>
              Melihat gambar dan dapat menyebut dengan benar nama 2 benda atau lebih.
              <br>
              Membantu memungut mainannya sendiri atau membantu mengangkat piring jika diminta. 
              <br>
              Makan nasi sendiri tanpa banyak tumpah.
              <br>
              Melepas pakaiannya sendiri.
              <br>
            </li>
            <li>
              Umur 36-48 bulan
              <br>
              Berdiri 1 kaki 2 detik.
              <br>
              Melompat kedua kaki diangkat.
              <br>
              Mengayuh sepeda roda tiga. 
              <br>
              Menggambar garis lurus. 
              <br>
              Menumpuk 8 buah kubus.
              <br>
              Mengenal 2-4 warna. 
              <br>
              Menyebut nama, umur, tempat. 
              <br>
              Mengerti arti kata di atas, dibawah, di depan. 
              <br>
              Mendengarkan cerita. 
              <br>
              Mencuci dan mengeringkan tangan sendiri.
              <br>
              Mengenakan celana panjang, kemeja baju
              <br>
            </li>
            <li>
              Umur 48-60 bulan
              <br>
              Berdiri 1 kaki 6 detik.
              <br>
              Melompat-lompat 1 kaki. 
              <br>
              Menari.
              <br>
              Menggambar tanda silang.
              <br>
              Menggambar Lingkaran. 
              <br>
              Menggambar orang dengan 3 bagian tubuh.
              <br>
              Mengancing baju atau pakaian boneka.
              <br>
              Menyebut nama lengkap tanpa dibantu. 
              <br>
              Senang menyebut kata-kata baru. 
              <br>
              Senang bertanya tentang sesuatu.
              <br>
              Menjawab pertanyaan dengan kata-kata yang benar.
              <br>
              Bicara mudah dimengerti. 
              <br>
              Bisa membandingkan/membedakan sesuatu dari ukuran dan bentuknya. 
              <br>
              Menyebut angka, menghitung jari.
              <br>
              Menyebut nama-nama hari. 
              <br>
              Berpakaian sendiri tanpa dibantu. 
              <br>
              Bereaksi tenang dan tidak rewel ketika ditinggal ibu.
              <br>
            </li>
            <li>
              Umur 60-72 bulan
              <br>
              Berjalan lurus. 
              <br>
              Berdiri dengan 1 kaki selama 11 detik.
              <br>
              Menggambar dengan 6 bagian, menggambar orang lengkap 
              <br>
              Menangkap bola kecil dengan kedua tangan. 
              <br>
              Menggambar segi empat. 
              <br>
              Mengerti arti lawan kata. 
              <br>
              Mengerti pembicaraan yang menggunakan 7 kata atau lebih.
              <br>
              Menjawab pertanyaan tentang benda terbuat dari apa dan kegunaannya. 
              <br>
              Mengenal angka, bisa menghitung angka 5-10 
              <br>
              Mengenal warna-warni 
              <br>
              Mengungkapkan simpati. 
              <br>
              Mengikuti aturan permainan.
              <br>
              Berpakaian sendiri tanpa dibantu.
              <br>
            </li>
          </ol>
         </p>
          <p><strong style="font-size: 1.2em">Masalah/Gangguan yang mempengaruhi tumbuh kembang anak</strong></p>
          <p>
          <ol>
            <li>
              Gangguan bicara dan bahasa
              <br>
              Kemampuan berbahasa sensitif terhadap keterlambatan atau kerusakan pada sistem lainnya, sebab melibatkan kemampuan kognitif, motor, psikologis, emosi dan lingkungan sekitar anak.
            </li>
            <li>
              Cerebral palsy
              <br>
              Merupakan kelainan gerakan dan postur tubuh yang tidak progresif, yang disebabkan oleh karena suatu kerusakan/gangguan pada sel-sel motorik pada susunan saraf pusat yang sedang tumbuh/belum selesai pertumbuhannya.
            </li>
            <li>
              Sindrom Down
              <br>
              Individu yang dapat dikenal dari fenotipnya dan mempunyai kecerdasan yang terbatas, yang terjadi akibat adanya jumlah kromosom 21 yang berlebih. Perkembangannya lebih lambat dari anak yang normal.
            </li>
            <li>
              Perawakan Pendek
              <br>
              Merupakan suatu terminologi mengenai tinggi badan yang berada di bawah persentil 3 atau -2 SD pada kurva pertumbuhan yang berlaku pada populasi tersebut. 
            </li>
            <li>
              Gangguan Autisme
              <br>
              Merupakan gangguan perkembangan pervasif pada anak yang gejalanya muncul sebelum anak berumur 3 tahun. Pervasif berarti meliputi seluruh aspek perkembangan yang ditemukan pada autisme yang mencakup bidang interaksi sosial, komunikasi dan perilaku.
            </li>
            <li>
              Retardasi Mental
              <br>
              Merupakan suatu kondisi yang ditandai oleh intelegensi yang rendah (IQ < 70) yang menyebabkan ketidakmampuan individu untuk belajar dan beradaptasi terhadap tuntutan masyarakat atas kemampuan yang dianggap normal.
            </li>
            <li>
              Gangguan Pemusatan Perhatian dan Hiperaktivitas (GPPH)
              <br>
              Merupakan gangguan dimana anak mengalami kesulitan untuk memusatkan perhatian yang seringkali disertai dengan hiperaktivitas.
            </li>
          </ol>
          </p>
         <p><strong style="font-size: 1.2em">Stimulasi tumbuh kembang balita</strong></p>
         <p>
          Stimulasi adalah kegiatan merangsang kemampuan dasar anak umur 0-6 tahun agar tumbuh dan berkembang secara optimal. Stimulasi tumbuh kembang anak dilakukan oleh orang terdekat (ibu dan ayah), pengasuh, anggota keluarga lain, maupun masyarakat sekitar. Kurangnya stimulasi dapat menyebabkan penyimpangan tumbuh kembang anak bahkan gangguan tetap. Kemampuan dasar anak seperti kemampuan gerak dan bicara perlu dirangsang dengan stimulasi terarah. Perkembangan kemampuan dasar anak mempunyai pola yang tetap dan berlangsung secara berurutan. Ada prinsip yang perlu diperhatikan dalam melakukan stimulasi, yaitu:
        </p>
        <p>
          <ol>
            <li>
              Stimulasi dilakukan dengan dilandasi rasa cinta dan kasih sayang. 
            </li>
            <li>
              Selalu tunjukkan sikap dan perilaku yang baik karena anak akan meniru tingkah laku orang-orang yang terdekat dengannya.
            </li>
            <li>
              Berikan stimulasi sesuai dengan kelompok umur anak. 
            </li>
            <li>
              Lakukan stimulasi dengan cara mengajak anak bermain, bernyanyi, bervariasi, menyenangkan, tanpa paksaan dan tidak ada hukuman. 
            </li>
            <li>
              Lakukan stimulasi secara bertahap dan berkelanjutan sesuai umur anak, terhadap ke 4 aspek kemampuan dasar anak. 
            </li>
            <li>
              Gunakan alat bantu/permainan yang sederhana, aman dan ada di sekitar anak. 
            </li>
            <li>
              Berikan kesempatan yang sama pada anak laki-laki dan perempuan. 
            </li>
            <li>
              Anak selalu diberi pujian, bila perlu diberi hadiah atas keberhasilannya
            </li>
          </ol>
        </p>
        </div>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col text-center">
              <button type="button" class="btn btn-lg btn-outline-primary rounded-pill z-index-2 hover-top buka" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Baca Selanjutnya
              </button>
              <a href="#tka" class="btn btn-lg btn-outline-primary rounded-pill z-index-2 hover-top tutup" style="display: none;">
                Tutup
              </a>
            </div>
          </div>
		</section>

      <section id="artikel" class="py-5">
        <div class="bg-holder" style="background-image:url({{asset('asset/img/illustrations/article-bg.png')}});background-position:right center;background-size:auto;">
        </div>
        <!--/.bg-holder-->

        <div class="container-lg">
          <div class="bg-holder" style="background-image:url({{asset('asset/img/illustrations/dot-2.png')}});background-position:left top;background-size:initial;margin-top:120px;margin-left:-35px;">
          </div>
          <!--/.bg-holder-->

          <div class="row flex-center">
            <div class="col-auto text-center">
              <h2 class="fw-bold">Artikel</h2>
              <hr class="mx-auto text-dark" style="height:2px;width:50px" />
            </div>
          </div>
          <div class="row h-100 justify-content-center pt-6">
            @if(count($artikel) > 0)
            @foreach($artikel as $a)
            <div class="col-12 col-sm-9 col-md-4 mt-4">
              <div class="card rounded-3 shadow"><img class="card-img-top" src="{{asset('image/'.$a->image)}}" alt="" width="100%" loading="lazy"/>
                <div class="card-body p-4 text-center text-md-start">
                  <h5 class="fw-bold">{{ (strlen(strip_tags($a->title)) > 25 ) ? substr_replace(strip_tags($a->title),'...',25) : $a->title; }}</h5>
                  <p class="card-text">{{ (strlen(strip_tags($a->description)) > 45 ) ? substr_replace(strip_tags($a->description),'...',50) : $a->description; }}</p><a class="stretched-link text-decoration-none" href="{{route('article-detail',$a->slug)}}" role="button">Lihat Selengkapnya
                    <svg class="bi bi-arrow-right-short" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"></path>
                    </svg></a>
                </div>
              </div>
            </div>
            @endforeach
            @else
            <h4 class="text-center">Tidak ada artikel</h4>
            @endif
            </div>
            @if(count($artikel) > 0)
            <div class="text-center pt-4 z-index-2">
              <a href="{{ route('article') }}" class="btn btn-lg btn-outline-primary rounded-pill z-index-2 hover-top">Lihat Semua Artikel</a>
            </div>
            @endif
          </div>
        </div>
      </section>
    
       <section class="py-5" id="alamat">
    <style scoped>
      @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

      .btn:focus,
      .btn:active {
        outline: none !important;
      }

      .img-hero {
        width: 100%;
        margin-bottom: 3rem;
      }

      .right-column {
        width: 100%;
      }

      .title-text {
        margin-bottom: 2.5rem;
        letter-spacing: -0.025em;
        color: #121212;
      }

      .title-caption {
        margin-bottom: 1.25rem;
        color: #121212;
      }

      .circle {
        height: 3rem;
        width: 3rem;
        margin-bottom: 1.25rem;
        border-radius: 9999px;
        background-color: #458FF6;
      }

      .text-caption {
        letter-spacing: 0.025em;
        color: #565656;
      }

      .btn-learn {
        padding: 1rem 2.5rem;
        background-color: #458FF6;
        transition: 0.3s;
        letter-spacing: 0.025em;
        border-radius: 0.75rem;
      }

      .btn:hover {
        background-color: #2c7ef0;
        transition: 0.3s;
      }

      @media (min-width: 768px) {
        .title-text {
          font: 600 2.25rem/2.5rem Poppins, sans-serif;
        }
      }

      @media (min-width: 992px) {
        .img-hero {
          width: 50%;
          margin-bottom: 0;
        }

        .right-column {
          width: 50%;
        }

        .circle {
          margin-right: 1.25rem;
          margin-bottom: 0;
        }
      }
    </style>


        <div class="container">
          <div class="row justify-content-center">
            <div class="col-auto text-center">
              <h2 class="fw-bold">Alamat</h2>
              <hr class="w-25 mx-auto text-dark" style="height:2px;">
            </div>
          </div>
          <div class="row">
            <div class="pb-3"></div>
            <div class="col-md-6 py-4">
              <div class="text-center">
                <svg style="width: 80%;" xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 910.90802 704.99598" xmlns:xlink="http://www.w3.org/1999/xlink"><ellipse cx="697.31696" cy="542.77039" rx="48.50275" ry="98.96521" fill="#3f3d56"/><path d="M837.38391,802.26252c19.42584-116.55145.19556-232.68182-.00091-233.84027l-3.77869.64008c.19556,1.15289,19.31543,116.67309-.00092,232.57135Z" transform="translate(-144.54599 -97.50201)" fill="#cacaca"/><rect x="818.26998" y="607.54206" width="3.83319" height="49.73956" transform="translate(-268.85332 959.85926) rotate(-61.8584)" fill="#cacaca"/><rect x="841.60854" y="642.25327" width="49.74127" height="3.83319" transform="translate(-345.98446 387.63054) rotate(-28.15796)" fill="#cacaca"/><ellipse cx="813.85468" cy="386.14381" rx="94.86566" ry="193.56433" fill="#e6e6e6"/><path d="M947.83405,800.179c37.944-227.6604.38275-454.49169-.00092-456.75628l-3.77869.64007c.38275,2.259,37.83362,228.48017-.00091,455.48737Z" transform="translate(-144.54599 -97.50201)" fill="#cacaca"/><rect x="914.08784" y="419.62722" width="3.83319" height="97.28711" transform="translate(-73.4911 957.62642) rotate(-61.8584)" fill="#cacaca"/><rect x="957.90319" y="489.35201" width="97.28717" height="3.83319" transform="translate(-257.25314 435.62254) rotate(-28.15742)" fill="#cacaca"/><path d="M738.0755,800.78724H233.47931a7.00818,7.00818,0,0,1-7-7V474.94154a7.00785,7.00785,0,0,1,7-7H738.0755a7.00817,7.00817,0,0,1,7,7v318.8457A7.00848,7.00848,0,0,1,738.0755,800.78724Z" transform="translate(-144.54599 -97.50201)" fill="#e4e4e4"/><path d="M279.88361,506.57923a3.00328,3.00328,0,0,0-3,3V759.15052a3.00328,3.00328,0,0,0,3,3H691.6712a3.00328,3.00328,0,0,0,3-3V509.57923a3.00328,3.00328,0,0,0-3-3Z" transform="translate(-144.54599 -97.50201)" fill="#fff"/><path d="M695.67095,570.85921V555.04439H637.4373V505.57918H621.62236v49.46521H517.94707V505.57918H502.13262v49.46521H342.22685V505.57918H326.41191v49.46521H271.11748v15.81482h55.29443v61.50214H271.11748v15.81482h55.29443v65.89514H271.11748v15.81482h140.519V763.15h15.81494V729.88613h74.68116V763.15h15.81445V729.88613H695.67095V714.07131H517.94707V648.17617H695.67095V632.36135H637.4373V570.85921Zm-193.53833,0v19.32928H342.22685V570.85921Zm-159.90577,35.1441H502.13262v26.358H342.22685Zm0,108.068V648.17617h69.40967v65.89514Zm159.90577,0H427.45146V648.17617h74.68116Zm119.48974-81.71H517.94707V570.85921H621.62236Z" transform="translate(-144.54599 -97.50201)" fill="#e6e6e6"/><circle cx="365.49384" cy="544.76679" r="20.20782" fill="#458ff6"/><polygon points="910.513 704.996 0 704.996 0 702.814 910.908 702.814 910.513 704.996" fill="#cacaca"/><circle cx="367.91605" cy="300.06687" r="124.6554" fill="#458ff6"/><polygon points="369.135 502.707 329.753 435.433 290.371 368.159 368.323 367.69 446.275 367.221 407.705 434.964 369.135 502.707" fill="#458ff6"/><circle cx="368.91666" cy="299.28272" r="44.72449" fill="#fff"/><path d="M509.57867,98.14253s-26.67361-7.51371-34.563,28.92773-2.87842,31.85-2.87842,31.85l59.546-6.95017S549.58911,109.22521,509.57867,98.14253Z" transform="translate(-144.54599 -97.50201)" fill="#2f2e41"/><path d="M470.7874,258.01223s-40.24153,1.86275-33.27269,17.65871q.73892,1.67489,1.37584,3.13846a282.52157,282.52157,0,0,0,17.16391,33.22306l24.73294,40.97977,9-5-25.32671-65.837,22.76474-1.85834Z" transform="translate(-144.54599 -97.50201)" fill="#ffb6b6"/><path d="M576.89062,274.7418l13.00843,28.33978s9.75628,9.75632,20.44177,48.78159,13.00842,37.63153,13.00842,37.63153l-10.56184,3.51753-43.33025-78.78056-21.371-26.946,6.50421-14.40219Z" transform="translate(-144.54599 -97.50201)" fill="#ffb6b6"/><path d="M561.09473,242.22071l18.69267,34.79152s42.38015,83.27659,38,83c-4.92373-.31093-18.75364,5.42831-23,11-2.04957,2.68926-32-63-42.51988-77.68693L529.50275,275.671s-64.63613,10.8788-64.71535,7.34123c-.0388-1.73284,21.39973,39.8423,17,38-5.012-2.09867-16.80244,8.11375-22,6-2.14452-.87214-17.29757-37.61145-23.43159-52.6662a8.14809,8.14809,0,0,1,3.76974-10.31057c4.60991-2.39749,68.66185-17.02323,68.66185-17.02323l-1.12019-5.72066,4.6459-9.29174Z" transform="translate(-144.54599 -97.50201)" fill="#2f2e41"/><circle cx="504.87902" cy="136.75794" r="18.1189" transform="translate(144.46959 515.71005) rotate(-80.78268)" fill="#ffb6b6"/><path d="M562.7874,245.01223c1.00049,3.00146-5.47911,4.72554-14.51067,3.03908-7.81427-1.4588-16.36737-3.19171-23.11322-4.59476-7.2243-1.50525-12.3858-2.62954-12.3858-2.62954s-1.85834,11.61465-7.898,10.22088c-5.20334-1.19864-20.753-55.51343-24.95758-70.52423a5.2218,5.2218,0,0,1,2.309-5.86774l21.357-13.041s14.71811-5.05471,20.08408-5.19871,14.65772-1.53778,14.65772-1.53778,10.68548.92918,12.54388,8.82713,9.61285,54.72575,9.75629,65.9713C560.7874,242.01223,559.7874,236.01223,562.7874,245.01223Z" transform="translate(-144.54599 -97.50201)" fill="#cacaca"/><path d="M511.65363,113.48475s-7.51371,19.9113-25.92228,28.17636l-3.00546-17.65719Z" transform="translate(-144.54599 -97.50201)" fill="#2f2e41"/><ellipse cx="377.98804" cy="32.28878" rx="2.55524" ry="4.87816" fill="#ffb6b6"/><path d="M497.27629,357.65805l-35.91687,16.5124-.20887-.45428a15.38729,15.38729,0,0,1,7.5521-20.407l.00089-.00041,21.93684-10.08514Z" transform="translate(-144.54599 -97.50201)" fill="#2f2e41"/><path d="M607.43293,390.64713l22.03165-9.8763.00089-.0004a15.3873,15.3873,0,0,1,20.33383,7.74694l.20451.45627-36.07222,16.17022Z" transform="translate(-144.54599 -97.50201)" fill="#2f2e41"/><polygon points="403.241 104.51 399.035 150.771 406.512 151.124 403.241 104.51" opacity="0.2"/><path d="M518.46828,288.434a9.13591,9.13591,0,0,0-1.99925-13.8654L500.3102,192.94265l-18.55613,7.09923,21.71849,78.00329A9.1854,9.1854,0,0,0,518.46828,288.434Z" transform="translate(-144.54599 -97.50201)" fill="#ffb6b6"/><path d="M504.39837,206.69964,484.023,210.2884a4.09641,4.09641,0,0,1-4.80539-3.92235l-.56235-20.61872a11.37649,11.37649,0,0,1,22.41945-3.88108l6.49978,19.50525a4.0964,4.0964,0,0,1-3.17607,5.32814Z" transform="translate(-144.54599 -97.50201)" fill="#cacaca"/><path d="M534.09046,286.99792a9.13584,9.13584,0,0,0,2.55241-13.7743l10.86868-82.49709-19.8527.77413-4.441,80.84851a9.1854,9.1854,0,0,0,10.87258,14.64875Z" transform="translate(-144.54599 -97.50201)" fill="#ffb6b6"/><path d="M546.97251,205.068l-20.45025-3.13434a4.09642,4.09642,0,0,1-3.29389-5.25613l6.07895-19.71025a11.37649,11.37649,0,0,1,22.48008,3.5129l-.098,20.55948a4.09641,4.09641,0,0,1-4.71689,4.02834Z" transform="translate(-144.54599 -97.50201)" fill="#cacaca"/></svg>
              </div>
            </div>
            <div class="col-md-6">
              <div class="row">
                <ul style="margin: 0">
                  <li class="list-unstyled" style="margin-bottom: 2rem">
                    <h4 class="title-caption d-flex flex-lg-row flex-column align-items-center justify-content-lg-start justify-content-center">
                      <span class="circle text-white d-flex align-items-center justify-content-center">
                        1
                      </span>
                      Desa lorem
                    </h4>
                    <p class="text-caption">
                      Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corrupti, illum.
                    </p>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9085.162202952617!2d109.24615625307337!3d-7.405069954725307!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655ee57bce42c7%3A0xe4e07c9e1e4f89d3!2sGrendeng%2C%20Kec.%20Purwokerto%20Utara%2C%20Kabupaten%20Banyumas%2C%20Jawa%20Tengah!5e0!3m2!1sid!2sid!4v1687076511372!5m2!1sid!2sid" width="100%" height="300" style="border:0;" allowfullscreen="loading=lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                    </li>
                    {{-- <li class="list-unstyled" style="margin-bottom: 2rem">
                    <h4 class="title-caption d-flex flex-lg-row flex-column align-items-center justify-content-lg-start justify-content-center">
                      <span class="circle text-white d-flex align-items-center justify-content-center">
                        1
                      </span>
                      Posyandu 1
                    </h4>
                    <p class="text-caption">
                      Jl. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Incidunt, laborum.
                    </p>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.887490152004!2d109.27448201428037!3d-7.36650647453498!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655f4c33e3b0bb%3A0x7902a3f0b78369f1!2sSDN%20Ciberem!5e0!3m2!1sid!2sid!4v1651050760040!5m2!1sid!2sid" width="100%" height="200" style="border:0;" allowfullscreen="loading=lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                    </li><li class="list-unstyled" style="margin-bottom: 2rem">
                    <h4 class="title-caption d-flex flex-lg-row flex-column align-items-center justify-content-lg-start justify-content-center">
                      <span class="circle text-white d-flex align-items-center justify-content-center">
                        1
                      </span>
                      Posyandu 1
                    </h4>
                    <p class="text-caption">
                      Jl. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Incidunt, laborum.
                    </p>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.887490152004!2d109.27448201428037!3d-7.36650647453498!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655f4c33e3b0bb%3A0x7902a3f0b78369f1!2sSDN%20Ciberem!5e0!3m2!1sid!2sid!4v1651050760040!5m2!1sid!2sid" width="100%" height="200" style="border:0;" allowfullscreen="loading=lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                    </li><li class="list-unstyled" style="margin-bottom: 2rem">
                    <h4 class="title-caption d-flex flex-lg-row flex-column align-items-center justify-content-lg-start justify-content-center">
                      <span class="circle text-white d-flex align-items-center justify-content-center">
                        1
                      </span>
                      Posyandu 1
                    </h4>
                    <p class="text-caption">
                      Jl. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Incidunt, laborum.
                    </p>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.887490152004!2d109.27448201428037!3d-7.36650647453498!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655f4c33e3b0bb%3A0x7902a3f0b78369f1!2sSDN%20Ciberem!5e0!3m2!1sid!2sid!4v1651050760040!5m2!1sid!2sid" width="100%" height="200" style="border:0;" allowfullscreen="loading=lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                    </li><li class="list-unstyled" style="margin-bottom: 2rem">
                    <h4 class="title-caption d-flex flex-lg-row flex-column align-items-center justify-content-lg-start justify-content-center">
                      <span class="circle text-white d-flex align-items-center justify-content-center">
                        1
                      </span>
                      Posyandu 1
                    </h4>
                    <p class="text-caption">
                      Jl. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Incidunt, laborum.
                    </p>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.887490152004!2d109.27448201428037!3d-7.36650647453498!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655f4c33e3b0bb%3A0x7902a3f0b78369f1!2sSDN%20Ciberem!5e0!3m2!1sid!2sid!4v1651050760040!5m2!1sid!2sid" width="100%" height="200" style="border:0;" allowfullscreen="loading=lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                    </li> --}}
                    </ul>
                  
              </div>

    </section> 
      <section id="galeri" class="py-5">
        <div class="row flex-center">
          <div class="col-auto text-center">
            <h2 class="fw-bold">Galeri</h2>
            <hr class="mx-auto text-dark" style="height:2px;width:50px" />
            <p>Tidak ada foto</p>
          </div>
        </div>
        
        {{-- <div class="bg-holder" style="background-image:url({{asset('asset/img/illustrations/article-bg.png')}});background-position:right center;background-size:auto;">
        </div>
        <!--/.bg-holder-->

        <div class="container-lg">
          <div class="bg-holder" style="background-image:url({{asset('asset/img/illustrations/dot-2.png')}});background-position:left top;background-size:initial;margin-top:120px;margin-left:-35px;">
          </div>
          <!--/.bg-holder-->

          <div class="row flex-center">
            <div class="col-auto text-center">
              <h2 class="fw-bold">Galeri</h2>
              <hr class="mx-auto text-dark" style="height:2px;width:50px" />
            </div>
          </div>

          <div class="row h-100 justify-content-center pt-6">

            <div class="col-12 col-sm-9 col-md-4 ">
              <a href="{{asset('galeri')}}/IMG_1500.webp" target="_BLANK">
                <div class="card rounded-3 shadow"><img class="card-img-top card-img-top-bottom" src="{{asset('galeri')}}/IMG_1500.webp" alt="" width="100%" loading="lazy"/>
                </div>
              </a>
            </div>
            <div class="col-12 col-sm-9 col-md-4 ">
              <a href="{{asset('galeri')}}/IMG_1501.webp" target="_BLANK">
                <div class="card rounded-3 shadow"><img class="card-img-top card-img-top-bottom" src="{{asset('galeri')}}/IMG_1501.webp" alt="" width="100%" loading="lazy"/>
                </div>
              </a>
            </div>
            <div class="col-12 col-sm-9 col-md-4 ">
              <a href="{{asset('galeri')}}/IMG_1505.webp" target="_BLANK">
                <div class="card rounded-3 shadow"><img class="card-img-top card-img-top-bottom" src="{{asset('galeri')}}/IMG_1505.webp" alt="" width="100%" loading="lazy"/>
                </div>
              </a>
            </div>
            <div class="col-12 col-sm-9 col-md-4 ">
              <a href="{{asset('galeri')}}/posyandu budi rahayu 1.webp" target="_BLANK">
                <div class="card rounded-3 shadow"><img class="card-img-top card-img-top-bottom" src="{{asset('galeri')}}/posyandu budi rahayu 1.webp" alt="" width="100%" loading="lazy"/>
                </div>
              </a>
            </div>
            <div class="col-12 col-sm-9 col-md-4 ">
              <a href="{{asset('galeri')}}/posyandu budi rahayu.webp" target="_BLANK">
                <div class="card rounded-3 shadow"><img class="card-img-top card-img-top-bottom" src="{{asset('galeri')}}/posyandu budi rahayu.webp" alt="" width="100%" loading="lazy"/>
                </div>
              </a>
            </div>
            <div class="col-12 col-sm-9 col-md-4 ">
              <a href="{{asset('galeri')}}/posyandu budi rahayu2.webp" target="_BLANK">
                <div class="card rounded-3 shadow"><img class="card-img-top card-img-top-bottom" src="{{asset('galeri')}}/posyandu budi rahayu2.webp" alt="" width="100%" loading="lazy"/>
                </div>
              </a>
            </div>
            <div class="col-12 col-sm-9 col-md-4 ">
              <a href="{{asset('galeri')}}/posyandu ngudi rahayu 1.webp" target="_BLANK">
                <div class="card rounded-3 shadow"><img class="card-img-top card-img-top-bottom" src="{{asset('galeri')}}/posyandu ngudi rahayu 1.webp" alt="" width="100%" loading="lazy"/>
                </div>
              </a>
            </div>
            <div class="col-12 col-sm-9 col-md-4 ">
              <a href="{{asset('galeri')}}/posyandu ngudi rahayu.webp" target="_BLANK">
                <div class="card rounded-3 shadow"><img class="card-img-top card-img-top-bottom" src="{{asset('galeri')}}/posyandu ngudi rahayu.webp" alt="" width="100%" loading="lazy"/>
                </div>
              </a>
            </div>
            <div class="col-12 col-sm-9 col-md-4 ">
              <a href="{{asset('galeri')}}/posyandu sukmo sejati.webp" target="_BLANK">
                <div class="card rounded-3 shadow"><img class="card-img-top card-img-top-bottom" src="{{asset('galeri')}}/posyandu sukmo sejati.webp" alt="" width="100%" loading="lazy"/>
                </div>
              </a>
            </div>
            

          </div>

          <div class="row pt-6" data-masonry='{"percentPosition": true }'>
            <div class="col-sm-6 col-lg-4 mb-4">
              <a target="_BLANK" href="https://images.unsplash.com/photo-1493612276216-ee3925520721?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8cmFuZG9tfGVufDB8fDB8fA%3D%3D&w=1000&q=80">
                <div class="card rounded-3 shadow">
                  <img class="card-img" src="https://images.unsplash.com/photo-1493612276216-ee3925520721?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8cmFuZG9tfGVufDB8fDB8fA%3D%3D&w=1000&q=80" alt="">
                </div>
              </a>
            </div>
          </div>
        </div> --}}
      </section>
      <section class="py-6 pt-7 bg-primary-gradient">
        <div class="bg-holder" style="background-image:url({{asset('asset/img/illustrations/dot.png')}});background-position:left bottom;background-size:auto;filter:contrast(1.5);">
        </div>
        <!--/.bg-holder-->

        <div class="bg-holder" style="background-image:url({{asset('asset/img/illustrations/dot-2.png')}});background-position:right top;background-size:auto;margin-top:-75px;">
        </div>
        <!--/.bg-holder-->

        <div class="container">
          <div class="row">
            <div class="col-12 col-lg-4 order-0 order-sm-0 pe-6"><a class="text-decoration-none" href="#"><img class="img-fluid me-2" src="{{asset('asset/img/icons/footer-logo.png')}}" alt="" /><span class="fw-bold fs-1 text-light">E-Posyandu</span></a>
              <p class="mt-3 text-white">Posyandu provides progressive, and affordable healthcare, accessible on mobile and online for everyone</p>
            </div>
            <div class="col-4 col-md-4 col-lg mb-3 order-2 order-sm-1">
              <h6 class="lh-lg fw-bold text-light">Kontak</h6>
              <ul class="list-unstyled mb-md-4 mb-lg-0">
                <li class="lh-lg"><span class="text-light fs--1 text-decoration-none">Tel: (021)3892749823</span></li>
                <li class="lh-lg"><span class="text-light fs--1 text-decoration-none">WhatsApp: (0821)3989743</span></li>
              </ul>
            </div>
            <div class="col-4 col-md-4 col-lg mb-3 order-2 order-sm-1">
              <h6 class="lh-lg fw-bold text-light">Alamat</h6>
              <ul class="list-unstyled mb-md-4 mb-lg-0">
                <li class="lh-lg"><span class="text-light fs--1 text-decoration-none">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi, blanditiis!.</span></li>
                {{-- <li class="lh-lg"><span class="text-light fs--1 text-decoration-none">Posyandu 2: Jl. Lorem ipsum dolor sit amet consectetur.</span></li>
                <li class="lh-lg"><span class="text-light fs--1 text-decoration-none">Posyandu 3: Jl. Lorem ipsum dolor sit amet consectetur.</span></li> --}}
              </ul>
            </div>
          </div>
        </div>
        <div class="container pt-5">
          <div class="row">
            <div class="col-12">
              <div class="text-center">
                <p class="text-white mb-0">&copy; {{date('Y')}} All right reserved | INSTITUT TEKNOLOGI TELKOM PURWOKERTO
                </p>
              </div>
            </div>
          </div>
        </div><!-- end of .container-->

      </section>

    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Stimulasi, Deteksi dan Intervensi Dini Tumbuh Kembang Anak</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
				<p>
          Mengenal perkembangan pertumbuhan anak
          <br>
          Keberhasilan anak dalam mencapai pertumbuhan dan perkembangan yang optimal akan mempengaruhi masa depan suatu bangsa. Tahun-tahun pertama merupakan periode terpenting dalam pertumbuhan dan perkembangan baik positif maupun negatif. Nutrisi yang cukup, status kesehatan yang baik, pengasuhan yang benar dan stimulasi yang tepat akan membantu anak untuk tumbuh dan berkembang untuk mencapai kemampuan optimal.
          <br>
          Pengertian pertumbuhan dan perkembangan
          <br>
          Pertumbuhan adalah bertambahnya ukuran dan jumlah sel serta jaringan interseluler, berarti bertambahnya ukuran fisik dan struktur tubuh sebagian atau keseluruhan. Perkembangan adalah bertambahnya struktur dan fungsi tubuh yang lebih kompleks dalam kemampuan gerak, bicara, sosialisasi dan kemandirian. Pertumbuhan terjadi secara simultan dengan perkembangan. 
          <br>
          Faktor mempengaruhi tumbuh kembang anak
          <br>
          Kualitas tumbuh kembang anak merupakan hasil interaksi berbagai faktor yang mempengaruhi mulai dari faktor internal maupun eksternal. 
          <br>
          
				</p>
      </div>
    </div>
  </div>
</div>

@endsection
@section('js')
    <script>

      $(document).ready(function() {
        $('.buka').click(function(){
          $(this).hide();
          $('.tutup').show()
        });
        $('.tutup').click(function(){
          $(this).hide();
          $('.buka').show();
          $('#collapseExample').collapse('hide');
        });
      });
    </script>
@endsection

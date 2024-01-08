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
        <div class="container"><a class="navbar-brand d-flex align-items-center fw-bold fs-2" href="{{url('/')}}"><img class="d-inline-block me-3" src="{{ asset('asset/img/LogoEposyandu3.png') }}" alt="" style="height: 41px;"/>E-Posyandu</a>
          <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
          <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto pt-2 pt-lg-0">
              <li class="nav-item"><a class="nav-link fw-bold active" aria-current="page" href="#">Home</a></li>
              <li class="nav-item"><a class="nav-link" href="#tentang">Tentang Posyandu</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ route('infografik_balita') }}">Info Grafik</a></li>
              <li class="nav-item"><a class="nav-link" href="#tka">Tumbuh Kembang Anak</a></li>
              <li class="nav-item"><a class="nav-link" href="#artikel">Artikel</a></li>
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
              <h2 class="fw-bold">Tentang Posyandu</h2>
              <hr class="w-25 mx-auto text-dark" style="height:2px;" />
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="pb-3"></div>
            <div class="col-sm-10 col-xl-10 text-center">
            <p align="justify">
              Posyandu, singkatan dari Pos Pelayanan Terpadu, merupakan salah satu elemen penting dalam sistem pelayanan kesehatan masyarakat di Indonesia. Posyandu adalah unit pelayanan kesehatan yang berlokasi di tingkat desa atau kelurahan, dan menjadi tempat pelayanan kesehatan dasar yang terintegrasi untuk ibu dan balita. Di Posyandu, petugas kesehatan seperti bidan, kader kesehatan bekerja sama dalam memberikan layanan seperti pemeriksaan pertumbuhan balita, konsultasi ibu hamil, serta penyuluhan kesehatan kepada masyarakat setempat.
            </p>
            <p align="justify">
              Posyandu memiliki peran kunci dalam upaya meningkatkan kesehatan masyarakat, terutama di daerah pedesaan yang mungkin sulit dijangkau oleh fasilitas kesehatan yang lebih besar. Program-program kesehatan seperti imunisasi, pencegahan malnutrisi. Selain itu, Posyandu juga berfungsi sebagai pusat informasi kesehatan dan edukasi untuk masyarakat, membantu dalam peningkatan kesadaran tentang pentingnya perawatan kesehatan. Dengan demikian, Posyandu memainkan peran vital dalam meningkatkan status kesehatan masyarakat Indonesia.
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
                  <p class="card-text">{!! (strlen(strip_tags($a->description)) > 45 ) ? substr_replace(strip_tags($a->description),'...',50) : $a->description; !!}</p><a class="stretched-link text-decoration-none" href="{{route('article-detail',$a->slug)}}" role="button">Lihat Selengkapnya
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
    
   
      <section id="galeri" class="py-5">
        {{-- <div class="row flex-center">
          <div class="col-auto text-center">
            <h2 class="fw-bold">Galeri</h2>
            <hr class="mx-auto text-dark" style="height:2px;width:50px" />
            <p>Tidak ada foto</p>
          </div>
        </div> --}}
        
        <div class="bg-holder" style="background-image:url({{asset('asset/img/illustrations/article-bg.png')}});background-position:right center;background-size:auto;">
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

            @if(count($galeri) > 0)
            @foreach($galeri as $g)
            <div class="col-12 col-sm-9 col-md-4 ">
              <a href="{{asset('galeri')}}/{{ $g->image }}" target="_BLANK">
                <div class="card rounded-3 shadow"><img class="card-img-top card-img-top-bottom" src="{{asset('galeri')}}/{{ $g->image }}" alt="{{ $g->judul }}" width="100%" loading="lazy"/>
                </div>
              </a>
            </div>
            @endforeach
            @else
            <h4 class="text-center">Tidak ada foto</h4>
            @endif        

          </div>

          {{-- <div class="row pt-6" data-masonry='{"percentPosition": true }'>
            <div class="col-sm-6 col-lg-4 mb-4">
              <a target="_BLANK" href="https://images.unsplash.com/photo-1493612276216-ee3925520721?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8cmFuZG9tfGVufDB8fDB8fA%3D%3D&w=1000&q=80">
                <div class="card rounded-3 shadow">
                  <img class="card-img" src="https://images.unsplash.com/photo-1493612276216-ee3925520721?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8cmFuZG9tfGVufDB8fDB8fA%3D%3D&w=1000&q=80" alt="">
                </div>
              </a>
            </div>
          </div> --}}
        </div>
      </section>
      <section class="py-6 pt-4 bg-primary-gradient">
        <div class="bg-holder" style="background-image:url({{asset('asset/img/illustrations/dot.png')}});background-position:left bottom;background-size:auto;filter:contrast(1.5);">
        </div>
        <!--/.bg-holder-->

        <div class="bg-holder" style="background-image:url({{asset('asset/img/illustrations/dot-2.png')}});background-position:right top;background-size:auto;margin-top:-75px;">
        </div>
        <!--/.bg-holder-->

        {{-- <div class="container">
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
                <li class="lh-lg"><span class="text-light fs--1 text-decoration-none">Posyandu 2: Jl. Lorem ipsum dolor sit amet consectetur.</span></li>
                <li class="lh-lg"><span class="text-light fs--1 text-decoration-none">Posyandu 3: Jl. Lorem ipsum dolor sit amet consectetur.</span></li>
              </ul>
            </div>
          </div>
        </div> --}}
        {{-- <div class="container pt-5"> --}}
        <div class="container">
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

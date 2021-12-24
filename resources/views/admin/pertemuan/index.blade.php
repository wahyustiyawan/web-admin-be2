<x-app-layout>
  <div class="container-fluid">
    <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../../../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
      <span class="mask bg-gradient-primary opacity-6"></span>
    </div>
    <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
      <div class="row gx-4">
        <div class="col-auto my-auto">
          <div class="h-100">
            <h5 class="mb-1">
              Pertemuan Ke 1
            </h5>
            <p class="mb-0 font-weight-bold text-sm">
              Nama Kelas
            </p>
          </div>
        </div>

      </div>
    </div>
  </div>
  <div class="container-fluid py-4">
    <div class="row mt-3">
      <div class="col-12 col-md-6 col-xl-4">
        <div class="card h-100">
          <div class="card-header pb-0 p-3">
            <h6 class="mb-0">Konten Video</h6>
          </div>
          <div class="card-body p-3">
            @foreach ($kontenVideo as $item)
            <h6 class="text-uppercase text-body text-xs font-weight-bolder">{{$item->judul}}</h6>
            @endforeach
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-xl-4 mt-md-0 mt-4">
        <div class="card h-100">
          <div class="card-header pb-0 p-3">
            <div class="row">
              <div class="col-md-8 d-flex align-items-center">
                <h6 class="mb-0">Quiz</h6>
              </div>
              <div class="col-md-4 text-end">
                <a class="btn bg-gradient-dark mb-0" href="{{route('tambahKuis',$kelas->id)}}"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Quiz</a>
              </div>
            </div>
          </div>
          <div class="card-body p-3">
            <p class="text-sm">
              Masukin keterangan kuis nya deh
            </p>
            <hr class="horizontal gray-light my-4">
            <ul class="list-group">
              <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; Alec M. Thompson</li>
              <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong> &nbsp; (44) 123 1234 123</li>
              <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; alecthompson@mail.com</li>
              <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Location:</strong> &nbsp; USA</li>
              <li class="list-group-item border-0 ps-0 pb-0">
                <strong class="text-dark text-sm">Social:</strong> &nbsp;
                <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                  <i class="fab fa-facebook fa-lg"></i>
                </a>
                <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                  <i class="fab fa-twitter fa-lg"></i>
                </a>
                <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                  <i class="fab fa-instagram fa-lg"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-12 col-xl-4 mt-xl-0 mt-4">
        <div class="card h-100">
          <div class="card-header pb-0 p-3">
            <h6 class="mb-0">Konten Dokumen</h6>
          </div>
          @foreach ($kontenDokumen as $item)
          <h6 class="text-uppercase text-body text-xs font-weight-bolder">{{$item->judul}}</h6>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
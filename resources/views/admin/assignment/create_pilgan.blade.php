<x-app-layout> 
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-lg-6 col-12 mx-auto">
          <div class="card card-body mt-4">
            <h6 class="mb-0">Assignment Pilihan Ganda</h6>
            <hr class="horizontal dark my-3">
            <div class="card-body">
              <form role="form text-left" action="{{route('importAssignmentPilgan')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="mata_kuliah_id" value="{{$mata_kuliah->id}}" >
                <div class="mb-3">
                  <label for="exampleFormControlSelect1">Judul</label>
                  <input type="text" class="form-control" name="judul" placeholder="Nama" aria-label="Name" aria-describedby="email-addon" required>
                  {{-- <input type="hidden" class="form-control" name="kelas_id" value="{{$kelas->id}}"> --}}
                  <input type="hidden" class="form-control" name="assignment" value="text">
                </div>
                <div class="mb-3">
                  <label for="exampleFormControlSelect1">Pertemuan</label>
                  <select class="form-control" name="pertemuan_id" id="exampleFormControlSelect1">
                    @foreach ($pertemuan as $item)
                    <option value="{{$item->id}}">{{$item->pertemuan}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="mb-3">
                  <label for="exampleFormControlSelect1">File</label>
                  <input type="file" class="form-control" name="file" required>
                </div>
                <div class="mb-3">
                  <label for="exampleFormControlSelect1">Deskripsi Assignment</label>
                  <textarea class="form-control" aria-label="With textarea" name="deskripsi" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlSelect1">Deadline</label>
                    <input class="form-control datepicker" name="deadline" placeholder="Please select date" type="date" onfocus="focused(this)" onfocusout="defocused(this)">
                </div>
                <div class="text-end">
                        <a href="javascript:history.back()" class="btn bg-gradient-danger"><i class="ni ni-bold-left"></i>&nbsp;&nbsp;Batal</a> 
                  <button type="submit" class="btn bg-gradient-dark"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah</button>                
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  
    {{-- @push('scripts')
    <script>
      tinymce.init({
        selector: 'textarea',
        plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        toolbar_mode: 'floating',
     });
    </script>
    @endpush --}}
  </x-app-layout>
<x-app-layout>
  <div class="row">
    <div class="col-6">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h3 class="text-center">Detail {{$kelas->nama}}</h3>
        </div>
        <div class="row px-xl-5 px-sm-4 px-3">

          <div class="card-body">
            <div class="mb-3">
              <label for="exampleFormControlSelect1">Nama Kelas</label>
              <input type="text" class="form-control" name="nama" placeholder="Nama" value="{{$kelas->nama}}" readonly>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlSelect1">Deskripsi Kelas</label>
              <input type="text" class="form-control" name="deskripsi" placeholder="Deskripsi" value="{{$kelas->deskripsi}}" readonly>
            </div>
            <div class="mb-3" >

              <table>
                <thead>
                  <th class="text-left"> Konten Video </th>
                  <th> Konten Dokumen </th>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-right">
                      <ul>
                        @foreach ($kontenVideo as $item)
                        <li>{{$item->judul}}</li>
                        @endforeach
                      </ul>
                    </td>
                    <td>
                      <ul>
                        @foreach ($kontenDokumen as $item)
                        <li>{{$item->judul}}</li>
                        @endforeach
                      </ul>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>


          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
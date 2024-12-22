<x-layout>
    <x-slot:title>
        List Tiket
    </x-slot:title>
    <a href="/registrasi">mau kemana brow</a>
    <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Penumpang</th>
            <th>Asal</th>
            <th>Tujuan</th>
            <th>No Kursi</th>
            <th>Tanggal Berangkat</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($collection as $key => $value)
          <tr>
            <td>{{$key + 1}}</td>
            <td>{{$value->user->name}}</td>
            <td>{{$value->asal}}</td>
            <td>{{$value->tujuan}}</td>
            <td>{{$value->no_kursi}}</td>
            <td>{{$value->tgl_berangkat}}</td>
            
            
          </tr>
              
          @endforeach
        </tbody>
      </table>
</x-layout>

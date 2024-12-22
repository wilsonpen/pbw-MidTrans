<x-layout>
    <x-slot:title>
        Registrasi
    </x-slot:title>
    <form action="/registrasi" method="post">
        @csrf
        <div class="mb-3">
            <label for="userIdField" class="form-label">Nama Penumpang</label>
            <select class="form-select" id="userIdField" name="user_id">
            @foreach ($collection as $key => $value)
                <option value="{{$value->id}}">{{$value->name}}</option>
            @endforeach
            </select>
            @error('user_id')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="asalField" class="form-label">Asal</label>
            <input type="text" id="asalField" name="asal" class="form-control" value="{{ old('asal') }}" required>
            @error('asal')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
      <div class="mb-3">
        <label for="tujuanField" class="form-label">Tujuan</label>
        <input type="text" id="tujuanField" name="tujuan" class="form-control" value="{{ old('tujuan') }}" required>
        @error('tujuan')
                <p class="text-danger">{{$message}}</p>
            @enderror
      </div>

      <div class="mb-3">
        <label for="tglBerangkatField" class="form-label">Tanggal Berangkat</label>
        <input type="date" id="tglBerangkatField" name="tgl_berangkat" class="form-control"  value="{{ old('tgl_berangkat') }}" required>
        @error('tgl_berangkat')
                <p class="text-danger">{{$message}}</p>
            @enderror
      </div>
 
<div class="mb-3">
    <label for="noKursiField" class="form-label">Nomor Kursi</label>
    <input type="text" id="noKursiField" name="no_kursi" class="form-control" value="{{ old('no_kursi') }}" maxlength="3" required >
    @error('no_kursi')
                <p class="text-danger">{{$message}}</p>
            @enderror

</div>
     
        <button type="submit" class="btn btn-primary">Konfirmasi</button>


    </form>

   
</x-layout>
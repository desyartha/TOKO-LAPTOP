@extends('layouts.template')
@section('content')
    <section class="accomodation_area section_gap">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{asset('images/kamar/' . $data->foto)}}" class="d-block w-100" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <div class="card">
                            <div class="card-header">
                                Detail Kamar
                            </div>
                            <div class="card-body">
                                <h6 class="card-subtitle mb-2">{{'Tipe Kamar : ' . ' ' . $data->name}}</h6>
                                <h6 class="card-subtitle mb-2">{{'Fasilitas Kamar : ' . ' ' . $data->facilities}}</h6>
                                <h6 class="card-subtitle mb-2">{{'Kapasitas Kasur : ' . '2' }}</h6>
                                <h6 class="card-subtitle mb-2">{{'Harga Permalam : '}}@currency($data->price)</h6>
                                <h6 class="card-subtitle mb-2">{{'Kamar Tersedia : ' . ' ' . $jumlahTersedia}}</h6>
                                <h6 class="card-subtitle mb-2">{{'Keterangan Tipe Kamar : ' . ' ' }} <br>
                                    <p class="ml-3">{{ $data->information }}</p>
                                </h6>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="card">
                            <div class="card-header">
                                Form Booking
                            </div>
                            <div class="card-body">
                                @auth
                                    @if ($jumlahTersedia == 0)
                                        <div class="form-group">
                                            <label for="jumlah">Jumlah Pesanan</label>
                                            <input type="text" class="form-control" disabled value="Full Book">
                                        </div>
                                    @else
                                        <div id="form-booking">
                                            <input type="hidden" id="tipe_kamar" value="{{ $data->name }}">

                                            <div class="form-group">
                                                <label for="jumlah">Jumlah Pesanan</label>
                                                <input type="number" class="form-control" value="1" min="1"
                                                    max="{{ $jumlahTersedia }}" required name="jumlah" id="jumlah">
                                            </div>
                                            <div class="form-group">
                                                <label for="check_in">Check In</label>
                                                <input type="date" min="{{ date('Y-m-d') }}" class="form-control" required
                                                    name="check_in" id="check_in" onchange="checkout()">
                                            </div>
                                            <div class="form-group">
                                                <label for="check_out">Check Out</label>
                                                <input type="date" disabled min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                                    class="form-control" required name="check_out" id="check_out">
                                            </div>

                                            <div class="mt-2">
                                                <a href="#" onclick="sendWhatsApp()" class="btn btn-success float-right">Book Now
                                                    via WhatsApp</a>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <center>
                                        <a href="{{ route('login') }}" class="btn btn-warning">Login First</a>
                                    </center>
                                @endauth

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        function checkout() {
            var checkin = new Date($('#check_in').val());
            var dd = checkin.getDate() + 1;
            var mm = checkin.getMonth() + 1;
            var yyyy = checkin.getFullYear();
            var lastDayOfMonth = new Date(yyyy, mm, 0);
            if (dd > lastDayOfMonth.getDate()) {
                dd = 1;
                mm += 1;
            }
            if (dd < 10) dd = '0' + dd;
            if (mm < 10) mm = '0' + mm;
            today = yyyy + '-' + mm + '-' + dd;
            document.getElementById("check_out").setAttribute("min", today);
            document.getElementById("check_out").removeAttribute("disabled");
        }

        function sendWhatsApp() {
            let tipeKamar = document.getElementById("tipe_kamar").value;
            let jumlah = document.getElementById("jumlah").value;
            let checkIn = document.getElementById("check_in").value;
            let checkOut = document.getElementById("check_out").value;

            if (!checkIn || !checkOut) {
                alert("Silakan isi tanggal check-in dan check-out terlebih dahulu.");
                return;
            }

            let message = `Halo Admin, saya ingin booking kamar dengan detail berikut:%0A` +
                `- Tipe Kamar: ${tipeKamar}%0A` +
                `- Jumlah Kamar: ${jumlah}%0A` +
                `- Check In: ${checkIn}%0A` +
                `- Check Out: ${checkOut}%0A%0A` +
                `Mohon konfirmasi ketersediaan. Terima kasih.`;

            let phoneNumber = "6285765007174"; // Ganti dengan nomor WhatsApp admin
            let url = `https://wa.me/${phoneNumber}?text=${message}`;
            window.open(url, '_blank');
        }
    </script>

@endsection
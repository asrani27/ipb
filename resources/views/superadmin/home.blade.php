@extends('layouts.app')
@push('css')
<style>
  body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
  }
  #countdown {
      position: fixed;
      top: 2px;
      left: 50%;
      transform: translateX(-50%);
      background-color: #333;
      color: #fff;
      padding: 10px 20px;
      border-radius: 5px;
      box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
      font-size: 18px;
      z-index: 1050;
  }
</style>
@endpush
@section('content')

<div id="countdown">00 Hari 00 Jam 00 Menit 00 Detik</div>
<div class="row text-center">
    <img src="/logo/pemko.png" width="80px">
<h3>Selamat Datang di <br/>Aplikasi Kendali Administrasi Pembangunan (KENANGAN) </h3>
</div>
{{-- <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>150</h3>

          <p>New Orders</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3>53<sup style="font-size: 20px">%</sup></h3>

          <p>Bounce Rate</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>44</h3>

          <p>User Registrations</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3>65</h3>

          <p>Unique Visitors</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
</div> --}}
@endsection
@push('js')

<script>
  // Set target date and time
  console.log("{{ targetDate() }}")
        const targetDate = new Date("{{ targetDate() }}").getTime();

  function updateCountdown() {
      const now = new Date().getTime();
      const distance = targetDate - now;

      // Calculate time components
      const days = Math.floor(distance / (1000 * 60 * 60 * 24));
      const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((distance % (1000 * 60)) / 1000);

      // Display the result
      document.getElementById("countdown").textContent = 
          `${days.toString().padStart(2, '0')} Hari ` +
          `${hours.toString().padStart(2, '0')} Jam ` +
          `${minutes.toString().padStart(2, '0')} Menit ` +
          `${seconds.toString().padStart(2, '0')} Detik`;

      // If the countdown is over
      if (distance < 0) {
          clearInterval(interval);
          document.getElementById("countdown").textContent = "Waktu Habis!";
      }
  }

  // Update the countdown every second
  const interval = setInterval(updateCountdown, 1000);
</script>
@endpush

@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body text-center" style="background-image: url('https://i.imgur.com/Gk1LvBU.png'); background-size: cover; background-position: center; padding: 50px; border-radius: 15px;">
        <h4 class="card-title" style="color: white; font-size: 2rem;">
            <i class="bi bi-grid"></i> Dashboard
        </h4>
        <div>
            <h1 id="realTimeClock" 
                style="
                    font-size: 5rem; 
                    margin-top: 20px; 
                    color: white; 
                    background-color: #3ec6bf; 
                    padding: 20px; 
                    border-radius: 10px; 
                    display: inline-block;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                ">
            </h1>
        </div>
    </div>
</div>

<script>
    function updateClock() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        // Memperbaiki template literal dengan menggunakan backticks
        document.getElementById('realTimeClock').innerText = `${hours}:${minutes}:${seconds}`;
    }

    setInterval(updateClock, 1000);
    updateClock(); // Panggil fungsi segera untuk menghindari delay
</script>
@endsection

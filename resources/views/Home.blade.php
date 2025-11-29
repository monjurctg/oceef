<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>
    .marquee {
        animation: marquee 15s linear infinite;
    }

    @keyframes marquee {
        0% {
            transform: translateX(100%);
        }

        100% {
            transform: translateX(-100%);
        }
    }
    

@keyframes marquee {
  0% { transform: translateX(100%); }
  100% { transform: translateX(-100%); }
}
.animate-marquee {
  animation: marquee 15s linear infinite;
}


</style>

<body class="bg-[#FDFDFC] min-h-screen font-sans">

    <div>
        <img src="/public/images/landing1.jpg" alt="">
    </div>
<!-- Countdown Section -->
<section class="bg-[#800000] text-white py-2 px-4 flex flex-col md:flex-row items-center justify-between">

  <h2 class="text-2xl md:text-4xl font-semibold mb-6">পুনঃ ওয়েবসাইট চালু হবে:</h2>

  <div class="grid grid-cols-4 sm:grid-cols-4 gap-4 max-w-lg mx-auto">
    <!-- দিন -->
    <div class="flex flex-col items-center">
      <div class="bg-white text-[#800000] text-2xl font-bold rounded-lg w-16 h-16 flex items-center justify-center shadow-md">
        <span id="days">০</span>
      </div>
      <span class="mt-2 text-sm sm:text-base font-medium">দিন</span>
    </div>

    <!-- ঘন্টা -->
    <div class="flex flex-col items-center">
      <div class="bg-white text-[#800000] text-2xl font-bold rounded-lg w-16 h-16 flex items-center justify-center shadow-md">
        <span id="hours">০০</span>
      </div>
      <span class="mt-2 text-sm sm:text-base font-medium">ঘন্টা</span>
    </div>

    <!-- মিনিট -->
    <div class="flex flex-col items-center">
      <div class="bg-white text-[#800000] text-2xl font-bold rounded-lg w-16 h-16 flex items-center justify-center shadow-md">
        <span id="minutes">০০</span>
      </div>
      <span class="mt-2 text-sm sm:text-base font-medium">মিনিট</span>
    </div>

    <!-- সেকেন্ড -->
    <div class="flex flex-col items-center">
      <div class="bg-white text-[#800000] text-2xl font-bold rounded-lg w-16 h-16 flex items-center justify-center shadow-md">
        <span id="seconds">০০</span>
      </div>
      <span class="mt-2 text-sm sm:text-base font-medium">সেকেন্ড</span>
    </div>
  </div>
</section>

<!-- Registration CTA -->
<section class="bg-[#250082] text-white flex flex-col md:flex-row items-center justify-between gap-4 px-4 md:px-8 py-6">
  <h3 class="text-lg md:text-2xl font-semibold text-center md:text-left">
ওমরগনি এমইএস কলেজ এক্স ক্যাডেট রেজিস্ট্রেশন লিংকঃ
  </h3>
  <a href="/register"
     class="bg-white text-[#250082] font-semibold px-6 py-2 text-base md:text-lg rounded-lg shadow hover:bg-gray-200 transition duration-200">
    এখানে ক্লিক করুন
  </a>
</section>

<!-- News Marquee -->
<section class="w-full flex flex-col sm:flex-row overflow-hidden">
  <!-- Left red section -->
  <div class="bg-red-600 text-white text-base sm:text-xl font-bold flex items-center justify-center px-4 py-3 sm:py-0 sm:min-w-max">
 OCECF NEWS :
  </div>

  <!-- Scrolling Marquee Section -->
  <div class="bg-green-800 text-white w-full overflow-hidden relative">
    <div class="animate-marquee whitespace-nowrap py-2 px-4 text-sm sm:text-lg font-medium">
      👉 নতুন সদস্য রেজিস্ট্রেশন চলছে! 📝 বিস্তারিত জানতে ওয়েবসাইট দেখুন অথবা আমাদের ফেসবুক পেজে যুক্ত থাকুন। 🎉
    </div>
  </div>
</section>


    <!-- <div><img src="images/OCECF-Part-04.jpg" alt=""></div> -->
    <div><img src="/public/images/OCECF-Part-05.jpg" alt=""></div>
    <div><img src="/public/images/OCECF-Part-06.jpg" alt=""></div>
    <div><img src="/public/images/OCECF-Part-07.jpg" alt=""></div>
    <div><img src="/public/images/OCECF-Part-08.jpg" alt=""></div>
    <div><img src="/public/images/OCECF-Part-09.jpg" alt=""></div>
    <div><img src="/public/images/OCECF-Part-10.jpg" alt=""></div>
    <div><img src="/public/images/OCECF-Part-11.jpg" alt=""></div>
    <div><img src="/public/mages/OCECF-Part-12.jpg" alt=""></div>

    <!-- Countdown Script -->
    <script>
        const countdown = () => {
            const targetDate = new Date("2026-01-01T00:00:00").getTime(); // এখানে আপনার গন্তব্য সময় দিন
            const now = new Date().getTime();
            const gap = targetDate - now;

            const second = 1000;
            const minute = second * 60;
            const hour = minute * 60;
            const day = hour * 24;

            const days = Math.floor(gap / day);
            const hours = Math.floor((gap % day) / hour);
            const minutes = Math.floor((gap % hour) / minute);
            const seconds = Math.floor((gap % minute) / second);

            document.getElementById("days").innerText = toBn(days);
            document.getElementById("hours").innerText = toBn(hours.toString().padStart(2, '0'));
            document.getElementById("minutes").innerText = toBn(minutes.toString().padStart(2, '0'));
            document.getElementById("seconds").innerText = toBn(seconds.toString().padStart(2, '0'));
        };

        function toBn(number) {
            const bnNums = {
                '0': '০', '1': '১', '2': '২', '3': '৩', '4': '৪',
                '5': '৫', '6': '৬', '7': '৭', '8': '৮', '9': '৯'
            };
            return number.toString().split('').map(char => bnNums[char] || char).join('');
        }

        setInterval(countdown, 1000);
    </script>

</body>

</html>
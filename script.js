let isPlaying = false;
let currentAudioUrl = '';

// Variabel global untuk menyimpan elemen audio
let audioElement;

// Inisialisasi audio saat halaman dimuat
window.addEventListener('DOMContentLoaded', function() {
  audioElement = new Audio();
});

// Fungsi untuk memutar audio
function playAudio(audioUrl) {
	if (isPlaying && currentAudioUrl === audioUrl) {
	  // Lagu sedang diputar, lanjutkan pemutaran
	  audioElement.play();
	} else {
	  // Lagu baru, mulai pemutaran dari awal
	  currentAudioUrl = audioUrl;
	  audioElement.src = audioUrl;
	  audioElement.play();
	  isPlaying = true;

	}
}
playAudio2();

// Fungsi untuk memperbarui tampilan tombol play di komponen kedua
function playAudio2() {
	const playButton = document.querySelector('.play-track');
	if (isPlaying) {
	  playButton.innerHTML = '<i class="fa-solid fa-pause fa-2x"></i>';
	} else {
	  playButton.innerHTML = '<i class="fa-solid fa-play fa-2x"></i>';
	}
  }
  
  // Fungsi untuk menghentikan audio dan memperbarui status pemutaran
  function pauseAudio() {
	audioElement.pause();
	isPlaying = false;
	playAudio2();
  }

// Fungsi untuk menghentikan audio
function pauseAudio() {
  audioElement.pause();
}

// Fungsi untuk mengatur nilai volume pada audio
function setVolume(value) {
  audioElement.volume = value / 100;
}

window.addEventListener('scroll', function() {
	const navbar = document.querySelector('.floating-navbar');
	if (window.scrollY > 0) {
	  navbar.classList.add('show');
	} else {
	  navbar.classList.remove('show');
	}
  });
  

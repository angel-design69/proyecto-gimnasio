// Reproductor Electrónica
const electronicaPlayer = {
  audio: document.getElementById("song-electronica"),
  progress: document.getElementById("progress-electronica"),
  playPauseBtn: document.querySelector(".play-pause-electronica"),
  controlIcon: document.getElementById("control-electronica"),
  songName: document.getElementById("songName-electronica"),
  artistName: document.getElementById("artistName-electronica"),
  cover: document.getElementById("cover-electronica"),
  btnNext: document.querySelector(".siguiente-electronica"),
  btnBack: document.querySelector(".regresar-electronica"),
  songs: [
    {
      title: "Blah Blah Blah",
      name: "Armin van Buuren",
      source: "Armin van Buuren - Blah Blah Blah (Official Lyric Video).mp3",
      cover: "blah.jpg",
      background: "linear-gradient(135deg,rgb(0, 0, 0), #000000)"
    },
    {
      title: "Turn It Up",
      name: "Armin van Buuren",
      source: "Armin van Buuren - Turn It Up (Official Lyric Video).mp3",
      cover: "turn.jpg",
      background: "linear-gradient(135deg, rgba(218, 240, 20, 0.9), #000000)"
    },
    {
      title: "Great Spirit",
      name: "Armin van Buuren vs Vini Vici feat. Hilight Tribe",
      source: "Armin van Buuren vs Vini Vici feat. Hilight Tribe - Great Spirit (Extended Mix).mp3",
      cover: "great.jpg",
      background: "linear-gradient(135deg, rgba(81, 90, 90))"
    },
    {
      title: "I'm an Albatraoz",
      name: "AronChupa",
      source: "AronChupa - I'm an Albatraoz OFFICIAL VIDEO.mp3",
      cover: "albatraoz.jpg",
      background: "linear-gradient(135deg,rgb(134, 198, 214),rgb(131, 119, 119))"
    },
    {
      title: "Doppler",
      name: "Charlotte de Witte",
      source: "Charlotte de Witte - Doppler (Original Mix) [KNTXT010].mp3",
      cover: "doppler.jpg",
      background: "url('spa.jpg')"
    },
    {
      title: "Bad",
      name: "David Guetta & Showtek",
      source: "David Guetta & Showtek - Bad ft.Vassy (Lyrics Video).mp3",
      cover: "bad.jpg",
      background: "linear-gradient(135deg,rgb(120, 216, 131),rgb(0, 0, 0))"
    },
    {
      title: "El toro",
      name: "Timmy Trumpet",
      source: "El Toro (feat. Afandi).mp3",
      cover: "toro.jpg",
      background: "linear-gradient(135deg,rgb(82, 77, 77),rgb(82, 77, 77))"
    },
    {
      title: "Embalao",
      name: "Jochill",
      source: "Embalao (Original Mix).mp3",
      cover: "embalao.jpg",
      background: "linear-gradient(135deg,rgb(183, 194, 25),rgb(61, 143, 23), rgb(226, 181, 83))"
    },
    {
      title: "Space Jungle",
      name: "Eva Shaw",
      source: "Eva Shaw - Space Jungle (Showtek Edit) [Official Music Video].mp3",
      cover: "sapace.jpg",
      background: "linear-gradient(135deg, #000000, #000000)"
    },
    {
      title: "judgement Day",
      name: "D'devils",
      source: "Judgement Day (Radio Edit).mp3",
      cover: "devils.jpg",
      background: "linear-gradient(135deg, #000000,rgb(163, 15, 15), rgb(243, 28, 28))"
    },
    {
      title: "Animals",
      name: "Martin Garrix",
      source: "Martin Garrix - Animals (Official Video).mp3",
      cover: "animals.jpg",
      background: "linear-gradient(135deg, #000000, #000000)"
    },
    {
      title: "My Life",
      name: "Zatox",
      source: "Zatox - My Life (Official Videoclip).mp3",
      cover: "mylife.jpg",
      background: "linear-gradient(135deg, rgb(58, 49, 49), rgb(58, 49, 49))"
    },
    {
      title: "Rumble In the Jungle",
      name: "Zatox",
      source: "Zatox - Rumble In The Jungle (Official 4K Video).mp3",
      cover: "rumble.jpg",
      background: "linear-gradient(135deg,rgb(83, 124, 36), rgb(0, 0, 0))"
    },
    {
      title: "Tanz Electrik",
      name: "Zatox",
      source: "Zatox - Tanz Electrik (The R3bels Remix).mp3",
      cover: "tanz.jpg",
      background: "linear-gradient(135deg,rgb(107, 93, 93), rgb(107, 93, 93))"
    },
    {
      title: "Wolves",
      name: "Zatox",
      source: "Zatox - Wolves (Official Videoclip).mp3",
      cover: "wolves.jpg",
      background: "linear-gradient(135deg,rgb(35, 82, 136),rgb(7, 56, 102))"
    },
    {
      title: "Zombivilization",
      name: "Zatox",
      source: "Zatox vs HWS Origins - Zombivilization.mp3",
      cover: "zombie.jpg",
      background: "linear-gradient(135deg,rgb(206, 198, 198),rgb(206, 198, 198))"
    }
  ],
  currentSongIndex: 0
};
//rep REgueton//
const reguetonmexaPlayer = {
  audio: document.getElementById("song-reguetonmexa"),
  progress: document.getElementById("progress-reguetonmexa"),
  playPauseBtn: document.querySelector(".play-pause-reguetonmexa"),
  controlIcon: document.getElementById("control-reguetonmexa"),
  songName: document.getElementById("songName-reguetonmexa"),
  artistName: document.getElementById("artistName-reguetonmexa"),
  cover: document.getElementById("cover-reguetonmexa"),
  btnNext: document.querySelector(".siguiente-reguetonmexa"),
  btnBack: document.querySelector(".regresar-reguetonmexa"),
  songs: [
    {
      title: "Somos Ñeros",
      name: "El Bogueto",
      source: "El Bogueto , Barrio Verde - Somos Ñeros - No Hay Loco Que No Corone 👑 (Visualizer ).mp3",
      cover: "ñero.jpg",
      background: "linear-gradient(135deg, rgb(224, 35, 209),rgb(192, 8, 177))"
    },
    {
      title: "PA TI",
      name: "El Bogueto",
      source: "BBYBOY 100K - PA TI REMIX  -  @ElBogueto.mp3",
      cover: "pati.jpg",
      background: "linear-gradient(135deg,rgb(224, 35, 209),rgb(192, 8, 177))"
    },
    {
      title: "BEIBY REMIX",
      name: "El Malilla, Cachirula, Loojan",
      source: "BEIBY Remix - Cachirula, Loojan, El Malilla.mp3",
      cover: "baby.jpg",
      background: "linear-gradient(135deg,rgb(34, 173, 228),rgb(34, 173, 228))"
    },
    {
      title: "Fuga",
      name: "El Bogueto",
      source: "El Bogueto , Brand Randall - Fuga - No Hay Loco Que No Corone 👑 ( Visualizer ).mp3",
      cover: "nlnc.jpg",
      background: "linear-gradient(135deg,rgb(104, 87, 87),rgb(104, 87, 87))"
    },
    {
      title: "Pri",
      name: "El Bogueto",
      source: "Bogueto - Pri (Audio Oficial).mp3",
      cover: "pri.jpg",
      background: "linear-gradient(135deg,rgb(151, 5, 5),rgb(0, 80, 112))"
    },
    {
      title: "Dime",
      name: "El Malilla",
      source: "El Malilla - Dime (Audio Oficial).mp3",
      cover: "dime.png",
      background: "url(dimef.jpg)"
    },
    {
      title: "Tiki",
      name: "El Malilla",
      source: "El Malilla - Tiki (Lyric Video) ft Gitana, Yeri Mua, Dj Kiire & Dj Rockwell.mp3",
      cover: "tiki.jpg",
      background: "linear-gradient(135deg,rgb(0, 0, 0),rgb(0, 0, 0))"
    },
    {
      title: "Soltero",
      name: "El Malilla",
      source: "El Malilla - Soltero (Video Oficial).mp3",
      cover: "soltero.png",
      background: "linear-gradient(135deg,rgb(0, 0, 0),rgb(0, 0, 0))"
    },
    {
      title: "Mi Nena",
      name: "El Bogueto",
      source: "El Bogueto , Jory Boy , Uzielito mix - Mi nena - No Hay Loco Que No Corone 👑 ( Visualizer ).mp3",
      cover: "nlnc.jpg",
      background: "linear-gradient(135deg, rgb(104, 87, 87),rgb(104, 87, 87))"
    },
    {
      title: "Prendete",
      name: "El Malilla, Yeyo, Ezya",
      source: "El Malilla, Yeyo, Ezya - Préndete (Video Oficial).mp3",
      cover: "pre.jpg",
      background: "linear-gradient(135deg,rgb(0, 0, 0), rgb(0, 0, 0))"
    },
    {
      title: "La Mariconera",
      name: "El Bogueto",
      source: "El Bogueto , Uzielito mix - La mariconera - No Hay Loco Que No Corone 👑 ( Visualizer ).mp3",
      cover: "nlnc.jpg",
      background: "linear-gradient(135deg,rgb(104, 87, 87),rgb(104, 87, 87))"
    },
    {
      title: "Fumando",
      name: "El Malilla",
      source: "El Malilla, Sir Speedy, Lost Ñeros - Fumando (LyricsLetra) ÑEROSTARS.mp3",
      cover: "ñeros.jpg",
      background: "url('ñeros.jpg')"
    }
  ],
  currentSongIndex: 0
};
//rep Adolo//
const adoloridosPlayer = {
  audio: document.getElementById("song-adoloridos"),
  progress: document.getElementById("progress-adoloridos"),
  playPauseBtn: document.querySelector(".play-pause-adoloridos"),
  controlIcon: document.getElementById("control-adoloridos"),
  songName: document.getElementById("songName-adoloridos"),
  artistName: document.getElementById("artistName-adoloridos"),
  cover: document.getElementById("cover-adoloridos"),
  btnNext: document.querySelector(".siguiente-adoloridos"),
  btnBack: document.querySelector(".regresar-adoloridos"),
  songs: [
    {
      title: "Ya Es Muy Tarde",
      name: "La Arrolladora",
      source: "La Arrolladora Banda El Limón De René Camacho - Ya Es Muy Tarde (LETRA).mp3",
      cover: "yae.jpg",
      background: "linear-gradient(135deg, rgb(255, 255, 255),rgb(255, 255, 255))"
    },
    {
      title: "En Definitiva",
      name: "Alfredo Olivas",
      source: "En Definitiva - Alfredo Olivas (320).mp3",
      cover: "ende.jpg",
      background: "url('ende.jpg')"
    },
    {
      title: "Extssy Model",
      name: "Junior H",
      source: "Extssy Model - Junior H (Video Letra).mp3",
      cover: "ext.jpg",
      background: "url(ext.jpg)"
    },
    {
      title: "Neta",
      name: "Junior H, Gabito BAllesteros",
      source: "Gabito Ballesteros, Junior H - Neta (Official Lyric Video).mp3",
      cover: "nt.jpg",
      background: "url(nt.jpg)"
    },
    {
      title: "¿Porque Terminamos?",
      name: "Gerardo Ortiz",
      source: "Gerardo Ortiz - ¿Por Qué Terminamos (Audio).mp3",
      cover: "pq.jfif",
      background: "url(pq.jfif)"
    },
    {
      title: "Jueves 10",
      name: "Junior H",
      source: "Junior H - Jueves 10 (LetraLyric Video) 2020.mp3",
      cover: "j1.jpg",
      background: "url(j1.jpg)"
    },
    {
      title: "Y Lloro",
      name: "Junior H",
      source: "Junior H - Y LLORO.mp3",
      cover: "ll.jpg",
      background: "url(ll.jpg)"
    },
    {
      title: "El Final De Nuestra Historia",
      name: "La Arrolladora",
      source: "La Arrolladora Banda El Limón De René Camacho - El Final De Nuestra Historia (Visualizer).mp3",
      cover: "ef.jfif",
      background: "url(ef.jfif)"
    },
    {
      title: "Esa Mujer",
      name: "Los Buitres De Culiacan",
      source: "Los Buitres De Culiacán Sinaloa - Esa Mujer (Cover Audio Video).mp3",
      cover: "em.jfif",
      background: "url(em.jfif)"
    },
    {
      title: "Ya Acabo",
      name: "Marca MP",
      source: "ya-acabó-letra.mp3",
      cover: "yc.jpg",
      background: "url(yc.jpg)"
    }
  ],
  currentSongIndex: 0
};
function initPlayer(player) {
  function updateSong() {
    const current = player.songs[player.currentSongIndex];
    player.audio.src = current.source;
    player.cover.src = current.cover;
    player.songName.textContent = current.title;
    player.artistName.textContent = current.name;
    player.progress.value = 0;
    player.controlIcon.classList.replace("fa-pause", "fa-play");

    // 🔥 CAMBIO DE FONDO MEJORADO
    if (current.background.includes("url")) {
      // Para imágenes
      document.body.style.backgroundImage = `linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0)), ${current.background}`;
    } else if (current.background) {
      // Para gradientes/colores
      document.body.style.background = current.background;
    } else {
      // Fondo por defecto
      document.body.style.background = '#000000';
    }
  }

  player.playPauseBtn.addEventListener("click", () => {
    if (player.audio.paused) {
      player.audio.play();
      player.controlIcon.classList.replace("fa-play", "fa-pause");
    } else {
      player.audio.pause();
      player.controlIcon.classList.replace("fa-pause", "fa-play");
    }
  });

  player.btnNext.addEventListener("click", () => {
    player.currentSongIndex = (player.currentSongIndex + 1) % player.songs.length;
    updateSong();
    player.audio.play();
    player.controlIcon.classList.replace("fa-play", "fa-pause");
  });

  player.btnBack.addEventListener("click", () => {
    player.currentSongIndex = (player.currentSongIndex - 1 + player.songs.length) % player.songs.length;
    updateSong();
    player.audio.play();
    player.controlIcon.classList.replace("fa-play", "fa-pause");
  });

  player.audio.addEventListener("timeupdate", () => {
    if (!isNaN(player.audio.duration)) {
      player.progress.value = (player.audio.currentTime / player.audio.duration) * 100;
    }
  });

  player.progress.addEventListener("input", () => {
    player.audio.currentTime = (player.progress.value / 100) * player.audio.duration;
  });

  updateSong();
}

// Inicializar ambos reproductores
initPlayer(electronicaPlayer);
initPlayer(reguetonmexaPlayer);
initPlayer(adoloridosPlayer);
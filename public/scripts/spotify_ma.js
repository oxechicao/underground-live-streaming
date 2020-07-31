const refresh = document.getElementById('spotify-banner').dataset.refresh
const float = document.getElementById('spotify-banner').dataset.float
const baseURL = document.getElementById('spotify-banner').dataset.baseurl

document.getElementById('spotify-banner').style.float = float

const spotify = document.getElementById('spotify-full')
spotify.style.display = 'none'

var currentSong = ''
var currentArtist = ''

const animationOn = () => {
  document.getElementById('spotify-full-background').classList.remove('animate__fadeOut');
  document.getElementById('spotify-full-background').classList.add('animate__fadeIn');
  document.getElementById('spotify-full-text-content').classList.remove('animate__fadeOut');
  document.getElementById('spotify-full-text-content').classList.add('animate__fadeIn');
  document.getElementById('spotify-full-text-box').classList.remove('animate__slideOutLeft');
  document.getElementById('spotify-full-text-box').classList.add('animate__slideInLeft');

  document.getElementById('spotify-full').classList.remove('animate__flipOutX')
  document.getElementById('spotify-full').classList.add('animate__flipInX')

  spotify.style.display = 'block'
}

const animationOff = () => {
  document.getElementById('spotify-full-background').classList.remove('animate__fadeIn');
  document.getElementById('spotify-full-background').classList.add('animate__fadeOut');
  document.getElementById('spotify-full-text-content').classList.remove('animate__fadeIn');
  document.getElementById('spotify-full-text-content').classList.add('animate__fadeOut');
  document.getElementById('spotify-full-text-box').classList.remove('animate__slideInLeft');
  document.getElementById('spotify-full-text-box').classList.add('animate__slideOutLeft');
  document.getElementById('spotify-full').classList.remove('animate__flipOutX')
  document.getElementById('spotify-full').classList.add('animate__flipOutX')

  setTimeout(() => {
    document.getElementById('spotify-full').style.display = 'none'
  }, 500)
}

const showSpotify = ({
                       name,
                       nameArtist,
                       albumImage,
                       sizeBannerBg
                     }) => {
  animationOn()
  const artistFontSize = nameArtist.length > 50 ?
    '15pt' :
    '18pt'

  const musicFontSize = name.length > 70 ?
    '19pt' :
    '26pt'

  document.getElementById('spotify-full-background').style.background = `linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url(${albumImage})`
  document.getElementById('spotify-music-full-horizontal').innerHTML = name
  document.getElementById('spotify-music-full-horizontal').style.fontSize = musicFontSize
  document.getElementById('spotify-artist-full-horizontal').innerHTML = nameArtist
  document.getElementById('spotify-artist-full-horizontal').style.fontSize = artistFontSize
  document.getElementById('id-spotify-box-music').style.width = `${sizeBannerBg}px`
}

const noneSpotify = () => {
  animationOff()
}

const getSong = () => fetch(`${baseURL}/spotify/current-song/${refresh}/650`)
  .then(response => response.json())
  .then(result => {
    const {
      albumImage,
      songName,
      artists,
      sizeBannerBg
    } = result

    const nameArtist = artists
    const name = songName

    let changed = false

    if (currentSong !== name || currentArtist !== nameArtist) {
      currentSong = name
      currentArtist = nameArtist
      noneSpotify()
      changed = true
    }

    if (changed) {
      setTimeout(() => {
        showSpotify({
          name,
          nameArtist,
          albumImage,
          sizeBannerBg
        })
      }, 500)
    } else {
      showSpotify({
        name,
        nameArtist,
        albumImage,
        sizeBannerBg
      })
    }
  })
  .catch(error => console.log('error', error));

getSong()
setInterval(function() {
  getSong()
}, 15000)
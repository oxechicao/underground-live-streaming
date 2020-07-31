const baseURL = document.getElementById('base_data').dataset.baseurl
fetch(baseURL + '/spotify/playlist')
  .then(response => response.json())
  .then(artists => {
    document.getElementById('amount-artists').innerHTML = ` ${Object.keys(artists).length} `

    const divListArtist = document.getElementById('artists-list')
    Object.values(artists).forEach(artist => {
      const divArtist = document.createElement('span')
      divArtist.innerHTML = artist.name
      divArtist.classList.add('box-artist-name')

      const linkArtist = document.createElement('a')
      linkArtist.href = artist.url
      linkArtist.target = '_blank'
      linkArtist.classList.add('link-artist-name')
      linkArtist.appendChild(divArtist)

      divListArtist.appendChild(linkArtist)
    })

    document.getElementById('artists-counting').style.display = 'none'
    document.getElementById('box-artists').style.display = 'block'
  })

function copiarUrl(tipo) {
  let copy = ''
  if (tipo === 'ama') {
    copy = document.getElementById('ama-l-link').href
  }
  if (tipo === 'amar') {
    copy = document.getElementById('ama-r-link').href
  }
  if (tipo === 'ma') {
    copy = document.getElementById('ma-l-link').href
  }
  if (tipo === 'ma') {
    copy = document.getElementById('ma-r-link').href
  }

  let inputTest = document.createElement('input')
  inputTest.value = copy
  document.body.appendChild(inputTest)
  inputTest.select()
  document.execCommand('copy')
  document.body.removeChild(inputTest)

}

function upcoming(){
    $('#upcoming-list').html('');
    $.ajax({
        url: 'https://api.jikan.moe/v3/search/anime',
        type: 'get',
        dataType: 'json',
        data: {
            'order_by': 'start_date',
            'sort': 'desc'
        },
        success: function(result) {
            let anime = result.results
            $.each(anime, function (i, data) {
                $('#upcoming-list').append(`
                    <div class='col-md-4'>
                    <div class="card mb-4">
                        <img src=${data.image_url} class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title mb-4">${data.title}</h5>
                            <div class="row mb-3">
                                <h6 class="col card-subtitle mb-2 text-muted">Ratings ${data.score}</h6>
                                <h6 class="col text-right card-subtitle mb-2 text-muted">${data.episodes} Episode</h6>
                            </div>
                            <p class="card-subtitle text-justify mb-4 text-muted text-truncate d-block">${data.synopsis}</p>
                            <h6 class="col text-right card-subtitle mb-2 text-muted">${data.start_date}</h6>
                            <a href="${data.url}" class="see-detail card-link"  >
                                <button type="button" class="btn btn-dark">Lihat Detail</button>
                            </a>
                        </div>
                    </div>
                    </div>
                `)
            })
        }
    })
}

function cariAnime(){
    $('#anime-list').html('');
    $.ajax({
        url: 'https://api.jikan.moe/v3/search/anime',
        type: 'get',
        dataType: 'json',
        data: {
            'q': $('#search-input').val(),
        },
        success: function(result) {
            let anime = result.results
            $.each(anime, function (i, data) {
                $('#anime-list').append(`
                    <div class='col-md-4'>
                    <div class="card mb-4">
                        <img src=${data.image_url} class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title mb-4">${data.title}</h5>
                            <div class="row mb-3">
                                <h6 class="col card-subtitle mb-2 text-muted">Ratings ${data.score}</h6>
                                <h6 class="col text-right card-subtitle mb-2 text-muted">${data.episodes} Episode</h6>
                            </div>
                            <p class="card-subtitle text-justify mb-4 text-muted text-truncate d-block">${data.synopsis}</p>

                            <a href="${data.url}" class="see-detail card-link"  >
                                <button type="button" class="btn btn-dark">Lihat Detail</button>
                            </a>
                        </div>
                    </div>
                    </div>
                `)
            })

            $('#search-input').val('');
        }
    })
}

const container = document.getElementById('list');

$('#search-button').on('click', function() {
    container.classList.remove('d-none')
    cariAnime()
})

$('#search-input').on('keyup', function(e) {
    if (e.keyCode === 13) {
        container.classList.remove('d-none')    
        cariAnime()
    }
})


function cariAnimeSeason(){
    $('#anime-list-season').html('');
    $.ajax({
        url: 'https://api.jikan.moe/v3/season/'+ $('#search-season').val()+'/'+ $('#search-group').val(),
        type: 'get',
        dataType: 'json',
        success: function(result) {
            let anime = result.anime
            console.log(anime)

            $.each(anime, function (i, data) {
                $('#anime-list-season').append(`
                    <div class='col-md-4'>
                    <div class="card mb-4">
                        <img src=${data.image_url} class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title mb-4">${data.title}</h5>
                            <div class="row mb-3">
                                <h6 class="col card-subtitle mb-2 text-muted">Ratings ${data.score}</h6>
                                <h6 class="col text-right card-subtitle mb-2 text-muted">${data.episodes} Episode</h6>
                            </div>
                            <p class="row-4 card-subtitle text-justify mb-4 text-muted text-truncate d-block">${data.synopsis}</p>

                            <a href="${data.url}" class="see-detail card-link"  >
                                <button type="button" class="btn btn-dark">Lihat Detail</button>
                            </a>
                        </div>
                    </div>
                    </div>
                `)
            })

            $('#search-season').val('');
        }
    })
}


$('#search-button-season').on('click', function() {
    container.classList.remove('d-none')
    cariAnimeSeason()
})

function cariManga(){
    $('#manga-list').html('');
    $.ajax({
        url: 'https://api.jikan.moe/v3/search/manga',
        type: 'get',
        dataType: 'json',
        data: {
            'q': $('#search-manga').val(),
        },
        success: function(result) {
            let anime = result.results
            $.each(anime, function (i, data) {
                $('#manga-list').append(`
                    <div class='col-md-4'>
                    <div class="card mb-4">
                        <img src=${data.image_url} class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title mb-4">${data.title}</h5>
                            <div class="row mb-3">
                                <h6 class="col card-subtitle mb-2 text-muted">Ratings ${data.score}</h6>
                                <h6 class="col text-right card-subtitle mb-2 text-muted">${data.chapters} Chapter</h6>
                            </div>
                            <p class="card-subtitle text-justify mb-4 text-muted text-truncate d-block">${data.synopsis}</p>

                            <a href="${data.url}" class="see-detail card-link"  >
                                <button type="button" class="btn btn-dark">Lihat Detail</button>
                            </a>
                        </div>
                    </div>
                    </div>
                `)
            })

            $('#search-manga').val('');
        }
    })
}

$('#search-button-manga').on('click', function() {
    container.classList.remove('d-none')
    cariManga()
})

$('#search-manga').on('keyup', function(e) {
    if (e.keyCode === 13) {
        container.classList.remove('d-none')    
        cariManga()
    }
})

function cariAnimeGenre(){
    $('#anime-list-genre').html('');
    $.ajax({
        url: 'https://api.jikan.moe/v3/search/anime',
        type: 'get',
        dataType: 'json',
        data: {
            'genre': $('#search-genre').val(),
        },
        success: function(result) {
            let anime = result.results
            console.log(anime)

            $.each(anime, function (i, data) {
                $('#anime-list-genre').append(`
                    <div class='col-md-4'>
                    <div class="card mb-4">
                        <img src=${data.image_url} class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title mb-4">${data.title}</h5>
                            <div class="row mb-3">
                                <h6 class="col card-subtitle mb-2 text-muted">Ratings ${data.score}</h6>
                                <h6 class="col text-right card-subtitle mb-2 text-muted">${data.episodes} Episode</h6>
                            </div>
                            <p class="row-4 card-subtitle text-justify mb-4 text-muted text-truncate d-block">${data.synopsis}</p>

                            <a href="${data.url}" class="see-detail card-link"  >
                                <button type="button" class="btn btn-dark">Lihat Detail</button>
                            </a>
                        </div>
                    </div>
                    </div>
                `)
            })

            $('#search-genre').val('');
        }
    })
}



$('#search-button-genre').on('click', function() {
    container.classList.remove('d-none')
    cariAnimeGenre()
})







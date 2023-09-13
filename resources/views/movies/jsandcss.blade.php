<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
<style>
    .intro {
        text-align: center;
    }

    ul {
        list-style-type: none;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    p {
        font-weight: 400;
    }

    a {
        text-decoration: none;
        color: inherit;
    }

    a:hover {
        color: #6ABCEA;
    }

    .container-movie {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        max-width: 100%;
        margin-left: auto;
        margin-right: auto;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
    }

    .movie-form {
        margin-top: 60px;
        padding: 0 20px 0 20px;
    }

    .movie-card {
        background: #ffffff;
        box-shadow: 0px 6px 18px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 315px;
        margin: 2em;
        border-radius: 10px;
        margin-top: -10px;
        display: inline-block;
    }

    .movie-header {
        padding: 0;
        margin: 0;
        height: 367px;
        width: 100%;
        display: block;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }


    .header-icon-container {
        position: relative;
    }

    .header-icon {
        width: 100%;
        height: 367px;
        line-height: 367px;
        text-align: center;
        vertical-align: middle;
        margin: 0 auto;
        color: #ffffff;
        font-size: 54px;
        text-shadow: 0px 0px 20px #6abcea, 0px 5px 20px #6ABCEA;
        opacity: .85;
    }

    .header-icon:hover {
        background: rgba(0, 0, 0, 0.15);
        font-size: 74px;
        text-shadow: 0px 0px 20px #6abcea, 0px 5px 30px #6ABCEA;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        opacity: 1;
    }

    .movie-card:hover {
        -webkit-transform: scale(1.03);
        transform: scale(1.03);
        box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.08);
    }

    .movie-content {
        padding: 18px 18px 24px 18px;
        margin: 0;
    }

    .movie-content-header,
    .movie-info {
        display: table;
        width: 100%;
    }

    .movie-title {
        font-size: 24px;
        margin: 0;
        display: table-cell;
    }

    .imax-logo {
        width: 50px;
        height: 15px;
        background: url("https://6a25bbd04bd33b8a843e-9626a8b6c7858057941524bfdad5f5b0.ssl.cf5.rackcdn.com/media_kit/3e27ede823afbf139c57f1c78a03c870.jpg") no-repeat;
        background-size: contain;
        display: table-cell;
        float: right;
        position: relative;
        margin-top: 5px;
    }

    .movie-info {
        margin-top: 1em;
    }

    .info-section {
        display: table-cell;
        text-transform: uppercase;
        text-align: center;
    }

    .info-section:first-of-type {
        text-align: left;
    }

    .info-section:last-of-type {
        text-align: right;
    }

    .info-section label {
        display: block;
        color: rgba(0, 0, 0, 0.5);
        margin-bottom: .5em;
        font-size: 9px;
    }

    .info-section span {
        font-weight: 700;
        font-size: 11px;
    }

    @media screen and (max-width: 500px) {
        .movie-card {
            width: 95%;
            max-width: 95%;
            margin: 1em;
            display: block;
        }

        .container {
            padding: 0;
            margin: 0;
        }
    }
</style>

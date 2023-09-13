@extends('layouts.app')
@include('partials.meta_dynamic_movie')
@section('content')
    <style>
        @import url("https://fonts.googleapis.com/css?family=Roboto:400,400i,700");

        .upload {
            --btn-color: #3bafda;
            --progress-color: #2d334c;
            --ease-in-out-quartic: cubic-bezier(0.77, 0, 0.175, 1);
            position: relative;
            display: flex;
            background: white;
            border-radius: 10px;
            box-shadow: 0 1.7px 1.4px rgba(0, 0, 0, 0.02), 0 4px 3.3px rgba(0, 0, 0, 0.028), 0 7.5px 6.3px rgba(0, 0, 0, 0.035), 0 13.4px 11.2px rgba(0, 0, 0, 0.042), 0 25.1px 20.9px rgba(0, 0, 0, 0.05), 0 60px 50px rgba(0, 0, 0, 0.07);
            overflow: hidden;
            transform: rotate(0);
        }

        .upload__info {
            display: flex;
            align-items: center;
            padding: 16px;
            margin-right: 40px;
        }

        .upload__filename {
            padding-left: 8px;
        }

        .upload__button {
            position: relative;
            padding: 16px;
            margin: 0;
            font-size: 100%;
            font-family: inherit;
            color: white;
            background: none;
            border: none;
            border-radius: inherit;
            outline: none;
            cursor: pointer;
            transform: scale(0.9);
        }

        .upload__button::before {
            position: absolute;
            content: "";
            z-index: -1;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--btn-color);
            border-radius: inherit;
            transform-origin: right;
        }

        .upload__hint {
            position: absolute;
            top: 0;
            left: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            color: white;
            transform: translateY(100%);
        }

        .upload__progress {
            position: absolute;
            content: "";
            top: 90%;
            left: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            color: white;
            background: var(--progress-color);
            transform: scaleX(0);
            transform-origin: left;
        }

        .upload__progress .check {
            stroke-dasharray: 16px;
            stroke-dashoffset: 16px;
            margin-right: 6px;
        }

        .upload.uploading .upload__button {
            animation: expand 0.3s forwards;
        }

        .upload.uploading .upload__button::before {
            animation: fill-left 1.2s 0.4s var(--ease-in-out-quartic) forwards;
        }

        .upload.uploading .upload__info>*,
        .upload.uploading .upload__button__text {
            animation: fade-up-out 0.4s 0.4s forwards;
        }

        .upload.uploading .upload__hint {
            animation: fade-up-in 0.4s 0.8s forwards;
        }

        .upload.uploading .upload__progress {
            animation: fill-right 2s 1s var(--ease-in-out-quartic) forwards;
        }

        .upload.uploaded .upload__progress {
            animation: slide-up 1s var(--ease-in-out-quartic) forwards;
        }

        .upload.uploaded .upload__progress .check {
            animation: stroke-in 0.6s 0.4s var(--ease-in-out-quartic) forwards;
        }

        .upload.uploaded-after .upload__info {
            animation: slide-down-info 1s var(--ease-in-out-quartic) forwards;
        }

        .upload.uploaded-after .upload__button {
            animation: slide-down-button 1s var(--ease-in-out-quartic) forwards;
        }

        .upload.uploaded-after .upload__progress {
            animation: slide-down-progress 1s var(--ease-in-out-quartic) forwards;
        }

        @keyframes expand {
            to {
                transform: scale(1);
            }
        }

        @keyframes fill-left {
            to {
                transform: scale(4, 1.2);
            }
        }

        @keyframes fade-up-out {
            to {
                opacity: 0;
                transform: translateY(-40%);
            }
        }

        @keyframes fade-up-in {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fill-right {
            to {
                transform: scaleX(1);
            }
        }

        @keyframes slide-up {
            from {
                transform: scaleX(1) translateY(0);
            }

            to {
                transform: scaleX(1) translateY(-90%);
            }
        }

        @keyframes stroke-in {
            to {
                stroke-dashoffset: 0;
            }
        }

        @keyframes slide-down-info {
            from {
                transform: translateY(-100%);
            }

            to {
                transform: translateY(0);
            }
        }

        @keyframes slide-down-button {
            from {
                transform: scale(0.9) translateY(-100%);
            }

            to {
                transform: scale(0.9) translateY(0);
            }
        }

        @keyframes slide-down-progress {
            from {
                transform: scaleX(1) translateY(-90%);
            }

            to {
                transform: scaleX(1) translateY(10%);
            }
        }

        .card-v {
            transition: transform 0.2s;
            /* Add a smooth transition for the transform property */
        }

        .card-v:hover {
            transform: scale(1.10);
            /* Zoom in on hover */
        }

        /* Add any other custom styling as needed */
        .vr {
            border-left: 2px solid #0400ff;
            height: auto;
            margin: 0 5px;
        }

        .with-background {
            position: relative;
        }

        .with-background::before {
            content: "";
            background-image: url('{{ asset($movie->image) }}');
            background-size: cover;
            background-repeat: no-repeat;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.2;
            /* Adjust the opacity as needed */
            z-index: -1;
            /* Place the pseudo-element behind other content */
        }

        .card {
            position: relative;
            background-color: transparent;
            /* Make the card background transparent */
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
            font-size: 74px;
            text-shadow: 0px 0px 20px #6abcea, 0px 5px 30px #6ABCEA;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            opacity: 1;
        }
    </style>


    <div class="container" style="padding-top: 70px;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('movies.index') }}">Movies</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $movie->title }}</li>
            </ol>
        </nav>


        <div class="card card-white post mt-2 mb-4">
            <div class="card-header post-heading d-flex " style="background: white;">
                <div class="float-start image">
                    @if ($movie->user && $movie->user->photo)
                        <img src="{{ asset('storage/' . $movie->user->photo) }}" class="img-fluid rounded-circle avatar"
                            alt="user profile image">
                    @else
                        <img src="{{ asset('images/default_profile.jpg') }}" class="img-fluid rounded-circle avatar"
                            alt="default profile image">
                    @endif
                </div>
                @if ($movie->user)
                    <div class="float-start meta ms-2">
                        <div class="title h5">
                            <a style="text-decoration:none;"
                                href="{{ route('users.profile_show', $movie->user->username) }}">{{ strtoupper($movie->user->name) }}
                            </a>
                        </div>
                        <h6 class="text-muted time">{{ $movie->created_at->diffForHumans() }}</h6>
                    </div>
                @endif
            </div>

            <div class="with-background">

                <div class="card-body post-description">
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <div class="text-center">
                                <h2>{{ ucwords($movie->title) }} <div class="vr ms-2 me-2"></div> {{ $movie->year }}</h2>
                                <br>
                            </div>

                            <!-- Image -->
                            <!-- Image -->
                            <div class="d-flex">
                                <div class="row align-items-center"> <!-- Add align-items-center here -->
                                    <div class="col-md-3">
                                        {{-- added next  --}}
                                    </div>
                                    <div class="col-md-6 text-center">
                                        @php
                                            // Extract the file extension from the $movie->image URL
                                            $extension = pathinfo($movie->image, PATHINFO_EXTENSION);
                                        @endphp

                                        @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                            <!-- Display as an image -->
                                            <img src="{{ asset($movie->image) }}"
                                                alt="{{ Str::limit($movie->title, 25) }}" class="img-fluid"
                                                style="border: 2px solid #e3e9de9b; border-radius: 10px; height:auto; width:auto; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                                        @elseif (in_array($extension, ['mp4', 'webm', 'ogg']))
                                            <!-- Display as a video with controls -->
                                            <video controls class="img-fluid">
                                                <source src="{{ asset($movie->image) }}" type="video/{{ $extension }}">
                                                Your browser does not support the video tag.
                                            </video>
                                        @else
                                            <!-- Placeholder image for unsupported formats -->
                                            <img src="{{ asset('images/empty.png') }}"
                                                alt="{{ Str::limit($movie->title, 25) }}" class="img-fluid"
                                                style="border: 2px solid #e3e9de9b; border-radius: 10px; height:200px; width:500px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                                        @endif
                                    </div>

                                    <div class="col-md-3">
                                        {{-- added next  --}}
                                    </div>
                                </div>
                            </div>


                            <p style="text-align: justify;">{!! $movie->body !!}</p>
                        </div>
                    </div>

                    @if (Auth::user() &&
                            (Auth::user()->role_id === 1 || (Auth::user()->role_id === 2 && Auth::user()->id === $movie->user_id)))
                        <div class="card-footer " style="background: white;">
                            <div class="row">
                                <div class="col-md-6 col-6">
                                    <div class="d-flex justify-content-start">

                                        <a href="{{ route('movies.edit', ['id' => $movie->id, 'slug' => $movie->slug]) }}"
                                            type="button" class="btn btn-success me-2">Edit</a>
                                        <form action="{{ route('movies.destroy', $movie->id) }} " method="POST">
                                            @csrf
                                            <button class="btn btn-danger delete-btn" type="submit">Delete</button>
                                        </form>

                                    </div>
                                </div>
                                <div class="col-md-6 col-6">
                                    <div class="d-flex justify-content-end">
                                        @php
                                            $movie->increment('view_count');
                                        @endphp
                                        <span class="text-danger me-3">
                                            <i class="fas fa-eye me-1"></i>{{ $movie->view_count }}
                                        </span>
                                        <div class="vr me-2"></div>
                                        <span class="me-3">
                                            <a href="{{ $movie->link }}" target="_blank"
                                                onclick="incrementDownloadCount('{{ $movie->id }}')"
                                                style="text-decoration: none">
                                                <i class="fas fa-download me-1"></i>{{ $movie->download_count }}
                                            </a>
                                        </span>
                                        <div class="vr me-2"></div>
                                        <button class="btn btn-secondary share-button"
                                            data-url="{{ route('movies.show', ['id' => $movie->id, 'slug' => $movie->slug]) }}">
                                            <i class="fas fa-share"></i>Share
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card-footer"style="background: white;">
                            <div class="col-md-12 col-12">
                                <div class="d-flex justify-content-center">
                                    @php
                                        $movie->increment('view_count');
                                    @endphp
                                    <span class="text-danger me-3">
                                        <i class="fas fa-eye me-1"></i>{{ $movie->view_count }}
                                    </span>
                                    <div class="vr me-2"></div>
                                    <span class="me-3">
                                        <a href="{{ $movie->link }}" target="_blank"
                                            onclick="incrementDownloadCount('{{ $movie->id }}')"
                                            style="text-decoration: none">
                                            <i class="fas fa-download me-1"></i>{{ $movie->download_count }}
                                        </a>
                                    </span>
                                    <div class="vr me-2"></div>
                                    <button class="btn btn-secondary share-button"
                                        data-url="{{ route('movies.show', ['id' => $movie->id, 'slug' => $movie->slug]) }}">
                                        <i class="fas fa-share"></i>Share
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif



                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <div class="upload">
                <div class="upload__info">
                    <svg t="1581822650945" class="clip" viewBox="0 0 1024 1024" version="1.1"
                        xmlns="http://www.w3.org/2000/svg" p-id="3250" width="20" height="20">
                        <path
                            d="M645.51621918 141.21142578c21.36236596 0 41.79528808 4.04901123 61.4025879 12.06298852a159.71594214 159.71594214 0 0 1 54.26367236 35.87255836c15.84503198 16.07739258 27.76959252 34.13726783 35.78356909 54.13513184 7.86071778 19.30572486 11.76635766 39.80291724 11.76635767 61.53607177 0 21.68371583-3.90563989 42.22045875-11.76635767 61.54101586-8.01397729 19.99291992-19.95831275 38.02807617-35.78356909 54.08569313l-301.39672877 302.0839231c-9.21038818 9.22027564-20.15112281 16.48278832-32.74310277 21.77270508-12.29040503 4.81036401-24.54125953 7.19329834-36.82177783 7.19329834-12.29040503 0-24.56103516-2.38293433-36.85638427-7.19329834-12.63647461-5.28991675-23.53271461-12.55737281-32.7381587-21.77270508-9.55151367-9.58117675-16.69042992-20.44775367-21.50573731-32.57995583-4.7856443-11.61804223-7.15869117-23.91339135-7.15869188-36.9255979 0-13.14074708 2.37304688-25.55474854 7.16363524-37.19256639 4.81036401-11.94927954 11.94927954-22.78619408 21.50079395-32.55029274l278.11614966-278.46221923c6.45172119-6.51104737 14.22344971-9.75421118 23.27563501-9.75421119 8.8692627 0 16.54705787 3.24316383 23.03338622 9.75421119 6.47644019 6.49127173 9.73937964 14.18389916 9.73937964 23.08282495 0 9.0521853-3.26293945 16.81896972-9.73937964 23.32012891L366.97489888 629.73773218c-6.32812477 6.2935183-9.48724342 14.08007836-9.48724415 23.30529736 0 9.06701684 3.15417457 16.75964356 9.48724414 23.08776904 6.80273414 6.50610328 14.55963111 9.75915528 23.26574683 9.75915527 8.67150855 0 16.43334961-3.253052 23.27563501-9.76409935l301.37695313-302.04931665c18.93988037-18.96459937 28.40734887-42.04742432 28.40734814-69.25836158 0-27.16149926-9.4674685-50.26409912-28.40734815-69.22869849-19.44415283-19.13269043-42.55664086-28.72375464-69.31274438-28.72375536-26.97363258 0-49.99218727 9.59106422-69.1001587 28.72375536L274.3370815 536.89227319a159.99774146 159.99774146 0 0 0-35.80828883 54.33288526c-8.0337522 19.65179443-12.04321289 40.2824707-12.04321289 61.79809618 0 21.20910645 4.00451661 41.81011963 12.04321289 61.79809547 8.17218018 20.34393287 20.10168481 38.36920166 35.80828883 54.08569312 16.225708 16.06256104 34.30535888 28.13049292 54.23400854 36.15930176 19.91381813 8.0337522 40.47033667 12.06793189 61.64978002 12.0679326 21.13989281 0 41.70135474-4.03417969 61.63000513-12.0679326 19.91876221-8.02386474 38.01818872-20.09674073 54.2241211-36.15435768l300.86773656-301.53515601c6.47644019-6.50115991 14.23828125-9.76904273 23.28057912-9.76904344 8.88903833 0 16.56188941 3.26293945 23.04821776 9.76904344 6.48632836 6.48632836 9.7245481 14.17895508 9.7245481 23.06799269 0 9.09667992-3.23822046 16.8535769-9.7245481 23.37451172L552.40379244 815.35449242c-22.00012231 22.01989722-47.32745362 38.88336158-75.986938 50.49151564C449.10209565 877.14270043 420.37834101 882.78857422 390.21592671 882.78857422c-30.01904297 0-58.74279761-5.64587378-86.20587183-16.94256616-28.6842041-11.60815406-54.00659203-28.47161842-76.00671362-50.49151564a226.19586182 226.19586182 0 0 1-50.13061524-75.90289354A226.86328125 226.86328125 0 0 1 160.9697104 653.04797364c0-30.08331323 5.62115479-58.88122559 16.90795899-86.38385035 11.40545654-28.37768578 28.11566138-53.75939917 50.13061523-76.15997313h0.24719287L530.14164643 189.20135474c15.69177247-15.731323 33.68737817-27.70037818 53.98681641-35.89727735C604.09666377 145.26043701 624.55430562 141.23120141 645.51127583 141.23120141V141.21142578z"
                            p-id="3251"></path>
                    </svg>
                    <span class="upload__filename">{{ $movie->title }}.zip</span>
                </div>
                <button class="upload__button" onclick="simulateUpload()">
                    <div class="upload__button__text">Download</div>
                </button>
                <div class="upload__hint">Downloading...</div>
                <div class="upload__progress" id="uploadProgress">
                    <svg width="16" height="16" class="check" stroke="currentColor" fill="none"
                        viewBox="0 0 13 11">
                        <polyline points="1 5.5 5 9.5 12 1.5"></polyline>
                    </svg>
                    Completed / Thanks
                </div>
            </div>
        </div>


        {{-- you may like  --}}

        <div class="mb-2 mt-4 ubuntu-font p-2 "
            style="text-align: center; background-color: rgb(255, 255, 255); border-radius: 8px;">
            <h3 class="text-danger"><b>You May Like</b></h3>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4 ">
            @php
                $shuffledmovies = $allmovie->shuffle()->take(6);
            @endphp

            @foreach ($shuffledmovies as $movie)
                <div class="col">
                    <div class="card card-v h-100 border border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden"
                        style="background: white;">

                        @if ($movie->image)
                            <img class="card-img-top" src="{{ asset($movie->image) }}"
                                alt="{{ Str::limit($movie->title, 25) }}" class="img-fluid"
                                style="border: 2px solid #e3e9de9b; border-radius: 10px; height:400px; width:auto; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                            <a href="{{ route('movies.show', ['id' => $movie->id, 'slug' => $movie->slug]) }}">
                                <div style="position: absolute; top: 40%; left: 50%; transform: translate(-50%, -50%);">
                                    <i class="fas fa-play fa-3x header-icon"></i>
                                </div>
                            </a>
                        @else
                            <!-- Placeholder image when featured image is empty -->
                            <img class="card-img-top" src="{{ asset('images/empty.png') }}"
                                alt="{{ Str::limit($movie->title, 25) }}" class="img-fluid"
                                style="border: 2px solid #e3e9de9b; border-radius: 10px; height:400px; width:auto; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                            <a href="{{ route('movies.show', ['id' => $movie->id, 'slug' => $movie->slug]) }}">
                                <div style="position: absolute; top: 40%; left: 50%; transform: translate(-50%, -50%);">
                                    <i class="fas fa-play fa-3x header-icon"></i>
                                </div>
                            </a>
                        @endif

                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title text-lg fw-bold text-dark">
                                    <i class="fas fa-film"></i> {{ Str::limit(ucwords($movie->title), 70) }}
                                </h5>
                                <h5 class="card-title text-lg fw-bold text-dark">
                                    <i class="far fa-calendar"></i> {{ Str::limit(ucwords($movie->year), 70) }}
                                </h5>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="card-title text-lg fw-bold text-danger">
                                    <i class="fas fa-user"></i>
                                    {{ Str::limit(ucwords($movie->producer), 70) }}
                                </h6>
                                <h6 class="card-title text-lg fw-bold text-primary">
                                    <i class="fas fa-user-friends"></i>
                                    {{ Str::limit(ucwords($movie->actors), 70) }}
                                </h6>
                            </div>

                        </div>

                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <a href="{{ route('movies.show', ['id' => $movie->id, 'slug' => $movie->slug]) }}"
                                class="btn btn-primary">Movie Details</a>

                            <div class="vr me-2"></div>
                            <span class="text-danger">
                                <i class="fas fa-eye me-1"></i>{{ $movie->view_count }}
                            </span>
                            <div class="vr me-2"></div>
                            <span class="text-info">
                                <i class="fas fa-download me-1"></i>{{ $movie->download_count }}
                            </span>
                            <div class="vr me-2"></div>
                            <!-- Replace this with the appropriate share URL for movies -->
                            <button class="btn btn-secondary share-button"
                                data-url="{{ route('movies.show', ['id' => $movie->id, 'slug' => $movie->slug]) }}">
                                <i class="fas fa-share"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


        <a href="#" class="go-to-home">
            <i class="fas fa-home"></i>
        </a>
    </div>

    <script>
        function simulateUpload() {
            // Simulate an upload with a setTimeout for demonstration purposes.
            // In your actual code, replace this with your real upload logic.
            setTimeout(function() {
                // Upload is complete
                document.getElementById('uploadProgress').innerHTML = `
                    <svg width="16" height="16" class="check" stroke="currentColor" fill="none" viewBox="0 0 13 11">
                        <polyline points="1 5.5 5 9.5 12 1.5"></polyline>
                    </svg>
                    Completed
                `;

                // Redirect to the desired link after a delay (e.g., 2 seconds)
                setTimeout(function() {
                    window.location.href = "{{ $movie->link }}";
                    // Trigger the download count increment on click
                    incrementDownloadCount('{{ $movie->id }}');
                }, 2000);
            }, 3000); // Simulated upload time: 3 seconds
        }
    </script>

    <script>
        "use strict";
        let sleep = (time) => new Promise(resolve => setTimeout(resolve, time));
        let upload = document.querySelector(".upload");
        let uploadBtn = document.querySelector(".upload__button");
        uploadBtn.addEventListener("click", async () => {
            upload.classList.add("uploading");
            await sleep(3000);
            upload.classList.add("uploaded");
            await sleep(2000);
            upload.classList.remove("uploading");
            upload.classList.add("uploaded-after");
            await sleep(1000);
            upload.className = "upload";
        });
    </script>

    <script>
        document.querySelector(".go-to-home").addEventListener("click", function(event) {
            event.preventDefault();
            // Scroll to the top of the page
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    </script>

    <script>
        function incrementDownloadCount(movieId) {
            // Send an AJAX request to your server to increment the download count
            fetch('/movies/increment-download-count/' + movieId, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                })
                .then(response => {
                    if (response.ok) {
                        // If the request was successful, you can update the UI or perform other actions
                        window.location.href =
                            '{{ route('movies.show', ['id' => $movie->id, 'slug' => $movie->slug]) }}';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>




    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Share button click event
            const shareButtons = document.querySelectorAll('.share-button');
            shareButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const url = this.getAttribute('data-url');
                    showShareDialog(url);
                });
            });

            // Function to show the SweetAlert share dialog
            function showShareDialog(url) {
                Swal.fire({
                    title: 'Share This movie',
                    html: `
                <a href="https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}" target="_blank" rel="noopener noreferrer" style="text-decoration: none;">
                <i class="fab fa-facebook"></i> Share on Facebook
            </a>
            <br>
            <a href="https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}" target="_blank" rel="noopener noreferrer" style="text-decoration: none;">
                <i class="fab fa-twitter"></i> Share on Twitter
            </a>
            <br>
            <a href="https://www.linkedin.com/shareArticle?url=${encodeURIComponent(url)}" target="_blank" rel="noopener noreferrer" style="text-decoration: none;">
                <i class="fab fa-linkedin"></i> Share on LinkedIn
            </a>
            <br>
            <div class="input-group mt-2">
                <input type="text" class="form-control" value="${url}" id="share-url">
                <button class="btn btn-secondary copy-button">Copy</button>
            </div>
        `,
                    showCancelButton: true,
                    cancelButtonText: 'Close',
                    showConfirmButton: false,
                });

                const copyButton = document.querySelector('.copy-button');
                copyButton.addEventListener('click', function() {
                    const shareUrlInput = document.getElementById('share-url');
                    shareUrlInput.select();
                    document.execCommand('copy');
                    Swal.fire({
                        icon: 'success',
                        title: 'Link Copied',
                        showConfirmButton: false,
                        timer: 1500
                    });
                });
            }
        });
    </script>
@endsection

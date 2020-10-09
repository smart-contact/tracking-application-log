<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Information -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="robots" content="noindex, nofollow">

    <title>TrackingApplicationLog {{ config('app.name') ? ' - ' . config('app.name') : '' }}</title>

    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito';
            background-color: #edf1f3
        }
        .sidebar .nav-item span {
            color: #2a5164;
            padding: .5rem 0;
        }

        .icon {
            width: 1rem;
            height: 1rem;
            margin-top: auto;
            margin-bottom: auto;
            margin-right: 15px;
            fill: #c3cbd3
        }

        .logo {
            width: 1.7rem;
            height: 1.7rem;
        }

        .router-link-active {
            color: #00938c;
        }
        .router-link-active svg{
            fill: #00938c !important;
        }
    </style>
</head>
<body>
<div id="tracking-application-log" v-cloak class="">
    <div class="mb-5 mx-auto p-10 text-gray-800">
        <go-back destination="/" text="Home" icon="home"></go-back>
        <div class="flex align-items-center py-4 header">
            <h4 class="mb-0 ml-3"><strong>Tracking Application Log</strong></h4>
        </div>
        <hr>
        <div class="flex mt-4">
            <div class="w-1/5 sidebar">
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <router-link to="/logs" class="nav-link flex align-items-center pt-0" exact>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="icon">
                                <path d="M0 3c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3zm2 2v12h16V5H2zm8 3l4 5H6l4-5z"></path>
                            </svg>
                            <p>Logs</span>
                        </router-link>
                    </li>
                    <li class="nav-item mb-2">
                        <router-link to="/export-log" class="nav-link flex align-items-center pt-0" exact>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="icon">
                                <path d="M0 2h20v4H0V2zm0 8h20v2H0v-2zm0 6h20v2H0v-2z"></path>
                            </svg>
                            <p>Export</span>
                        </router-link>
                    </li>
                </ul>
            </div>

            <div class="w-4/5">
                <router-view></router-view>
            </div>
        </div>
    </div>
</div>
<script>
    window.authUser = {!! json_encode(auth()->user()) !!};
</script>
<script src="{{ asset('vendor/tracking-application-log/app.js') }}"></script>
</body>
</html>

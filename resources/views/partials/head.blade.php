<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="{{ $siteDescription }}">

@if($siteFavicon)
    @php
        $faviconPath = str_replace('storage/', '', $siteFavicon);
        $faviconUrl = asset('storage/' . $faviconPath);
        $faviconFile = storage_path('app/public/' . $faviconPath);
        $faviconTimestamp = file_exists($faviconFile) ? filemtime($faviconFile) : time();
        $extension = strtolower(pathinfo($faviconPath, PATHINFO_EXTENSION));
        $mimeTypes = [
            'ico' => 'image/x-icon',
            'png' => 'image/png',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'gif' => 'image/gif',
        ];
        $mimeType = $mimeTypes[$extension] ?? 'image/x-icon';
    @endphp
    <link rel="icon" type="{{ $mimeType }}" href="{{ $faviconUrl }}?v={{ $faviconTimestamp }}">
    <link rel="shortcut icon" type="{{ $mimeType }}" href="{{ $faviconUrl }}?v={{ $faviconTimestamp }}">
    <link rel="apple-touch-icon" href="{{ $faviconUrl }}?v={{ $faviconTimestamp }}">
@else
    <link rel="shortcut icon" href="{{ asset('images/favicon.webp') }}" type="image/x-icon">
    <link rel="icon" type="image/webp" href="{{ asset('images/favicon.webp') }}">
@endif

<link rel="stylesheet" href="{{ asset('css/icofont.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/aos.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">


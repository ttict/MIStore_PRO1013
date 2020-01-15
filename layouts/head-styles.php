<base href="<?= ASSET_URL ?>">
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Mi Store</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Favicon -->
<link rel="shortcut icon" type="image/x-icon" href="img/icon/favicon.png">

<!-- All CSS Files -->
<!-- Bootstrap fremwork main css -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<!-- Nivo-slider css -->
<link rel="stylesheet" href="lib/css/nivo-slider.css">
<!-- This core.css file contents all plugings css file. -->
<link rel="stylesheet" href="css/core.css">
<!-- Theme shortcodes/elements style -->
<link rel="stylesheet" href="css/shortcode/shortcodes.css">
<!-- Theme main style -->
<link rel="stylesheet" href="style.css">
<!-- Responsive css -->
<link rel="stylesheet" href="css/responsive.css">
<!-- Template color css -->
<link href="css/color/color-core.css" data-style="styles" rel="stylesheet">
<!-- User style -->
<link rel="stylesheet" href="css/custom.css">

<!-- Modernizr JS -->
<script src="js/vendor/modernizr-2.8.3.min.js"></script>

<style>
    .loader-wrapper {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #eee;
        z-index: 999999;
        overflow-x: hidden;
        overflow-y: hidden;
    }
    .loader {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 200px;
        height: 200px;
        margin-top: -100px;
        margin-left: -100px;
    }
    .loader > .dot {
        position: absolute;
        top: 50%;
        left: 50%;
        z-index: 10;
        width: 160px;
        height: 100px;
        margin-top: -50px;
        margin-left: -80px;
        border-radius: 5px;
        background-color: #1e3f57;
        transform-type: preserve-3d;
        animation: dot1 3s cubic-bezier(.55,.3,.24,.99) infinite;
    }

    .loader > .dot:nth-child(2) {
        z-index: 11;
        width: 150px;
        height: 90px;
        margin-top: -45px;
        margin-left: -75px;
        border-radius: 3px;
        background-color: #3c617d;
        animation-name: dot2;
    }

    .loader > .dot:nth-child(3) {
        z-index: 12;
        width: 40px;
        height: 20px;
        margin-top: 50px;
        margin-left: -20px;
        border-radius: 0 0 5px 5px;
        background-color: #6bb2cd;
        animation-name: dot3;
    }

    @keyframes dot1 {
        3%, 97% {
            width: 160px;
            height: 100px;
            margin-top: -50px;
            margin-left: -80px;
        }
        30%, 36% {
            width: 80px;
            height: 120px;
            margin-top: -60px;
            margin-left: -40px;
        }
        63%, 69% {
            width: 40px;
            height: 80px;
            margin-top: -40px;
            margin-left: -20px;
        }
    }

    @keyframes dot2 {
        3%, 97% {
            width: 150px;
            height: 90px;
            margin-top: -45px;
            margin-left: -75px;
        }
        30%, 36% {
            width: 70px;
            height: 96px;
            margin-top: -48px;
            margin-left: -35px;
        }
        63%, 69% {
            width: 32px;
            height: 60px;
            margin-top: -30px;
            margin-left: -16px;
        }
    }

    @keyframes dot3 {
        3%, 97% {
            width: 40px;
            height: 20px;
            margin-top: 50px;
            margin-left: -20px;
        }
        30%, 36% {
            width: 8px;
            height: 8px;
            margin-top: 49px;
            margin-left: -5px;
            border-radius: 8px;
        }
        63%, 69% {
            width: 16px;
            height: 4px;
            margin-top: -37px;
            margin-left: -8px;
            border-radius: 10px;
        }
    }
</style>
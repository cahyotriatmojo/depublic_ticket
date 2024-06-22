<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Depublic</title>
    <meta name="author" content="name">
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .font-family-karla {
            font-family: karla;
        }

        .bg-sidebar {
            background: #3d68ff;
        }

        .cta-btn {
            color: #3d68ff;
        }

        .upgrade-btn {
            background: #1947ee;
        }

        .upgrade-btn:hover {
            background: #0038fd;
        }

        .active-nav-link {
            background: #1947ee;
        }

        .nav-item:hover {
            background: #1947ee;
        }

        .account-link:hover {
            background: #3d68ff;
        }
    </style>

    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"
        integrity="sha256-xKeoJ50pzbUGkpQxDYHD7o7hxe0LaOGeguUidbq6vis=" crossorigin="anonymous"></script>

    @vite('resources/css/app.css')

</head>

<body class="bg-gray-800 font-sans leading-normal tracking-normal mt-12">

    <header>
        <!--Nav-->
        @include('layouts.admin.navbar')
    </header>

    <main>
        <div class="flex flex-col md:flex-row">
            @include('layouts.admin.sidenav')
            <section class="flex-1">
                <div id="main" class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">
                    @yield('content')
                </div>
            </section>
        </div>
    </main>

</body>
<!-- CDN jQuery -->
<script src="{{ asset('design-system/assets/js/jquery-3.7.1.min.js') }}"></script>
 <!-- CDN DataTables -->
 <script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
 <!-- Dropdown Script -->
 <script>
     /*Toggle dropdown list*/
     function toggleDD(myDropMenu) {
         document.getElementById(myDropMenu).classList.toggle("invisible");
     }

     /*Filter dropdown options*/
     function filterDD(myDropMenu, myDropMenuSearch) {
         var input, filter, ul, li, a, i;
         input = document.getElementById(myDropMenuSearch);
         filter = input.value.toUpperCase();
         div = document.getElementById(myDropMenu);
         a = div.getElementsByTagName("a");
         for (i = 0; i < a.length; i++) {
             if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
                 a[i].style.display = "";
             } else {
                 a[i].style.display = "none";
             }
         }
     }

     // Close the dropdown menu if the user clicks outside of it
     window.onclick = function(event) {
         if (!event.target.matches('.drop-button') && !event.target.matches('.drop-search')) {
             var dropdowns = document.getElementsByClassName("dropdownlist");
             for (var i = 0; i < dropdowns.length; i++) {
                 var openDropdown = dropdowns[i];
                 if (!openDropdown.classList.contains('invisible')) {
                     openDropdown.classList.add('invisible');
                 }
             }
         }
     }
 </script>

 @yield('script')
</html>
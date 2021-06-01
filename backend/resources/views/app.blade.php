<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">


        <title>Панель администратора</title>

    </head>
    <body class="font-sans">

    <div id="app">

        <div class="containe px-9">

            <header class="py-6 mb-8">

               <h1 class="font-bold text-4xl">Панель администратора</h1>

            </header>

            <main class="flex">

                <aside class="w-1/5 pt-8">

                    <section class="mb-10">

                        <router-link :to="{ name: 'admin'}">Главная</router-link>

                        <h5 class="uppercase font-semibold mb-5 text-base">Панель управления</h5>

                        <ul class="list-reset">
                            <li class="text-sm pb-4"><router-link :to="{ name: 'adminUsers'}">Пользователи</router-link></li>
                            <hr>
                            <li class="text-sm pb-4"><router-link :to="{ name: 'adminSeeds'}">Семена</router-link></li>
{{--                            <li class="text-sm pb-4"><router-link :to="{ name: 'adminSpecies'}">Виды</router-link></li>--}}
                            <li class="text-sm pb-4"><router-link :to="{ name: 'adminFamilies'}">Семейства</router-link></li>
                            <li class="text-sm pb-4"><router-link :to="{ name: 'adminPlants'}">Рассада</router-link></li>
                            <li class="text-sm pb-4"><router-link :to="{ name: 'adminCompanions'}">Компаньоны</router-link></li>
                            <hr>
                            <li class="text-sm pb-4"><router-link :to="{ name: 'adminManufacturers'}">Производители</router-link></li>

                            <hr>
                            <li class="text-sm pb-4"><router-link :to="{ name: 'adminStatistics'}">Статистика</router-link></li>
                            <li class="text-sm pb-4"><router-link :to="{ name: 'adminMarketing'}">Маркетинг</router-link></li>
                            <li class="text-sm pb-4"><router-link :to="{ name: 'adminFeedback'}">Обратная связь</router-link></li>
                        </ul>

                    </section>

                </aside>

                <div class="flex-1 primary w-4/5">

                    <router-view></router-view>

                </div>

            </main>

        </div>

    </div>

    <script src="/js/app.js"></script>

    </body>
</html>

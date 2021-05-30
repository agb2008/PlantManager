<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        

        <title>Менеджер растений</title>

    </head>
    <body class="font-sans">

    <div id="app">

        <div class="containe px-9">

            <header class="py-6 mb-8">

               <h1 class="font-bold text-4xl">Менеджер растений - веб портал</h1> 

            </header> 

            <main class="flex">

                <aside class="w-1/5 pt-8">

                    <section class="mb-10">

                        <h5 class="uppercase font-semibold mb-5 text-base">Модули</h5>

                        <ul class="list-reset">

                            <li class="text-sm pb-4"><router-link to="/inventory" exact>Инвентарный список</router-link></li>
                            <li class="text-sm pb-4"><router-link :to="{ name: 'seedling' }">Рассада</router-link></li>
                            <li class="text-sm pb-4"><router-link to="/garden-beds">Грядки</router-link></li>
                            <li class="text-sm pb-4"><router-link to="/stats">Статистика</router-link></li>

                        </ul>


                    </section>

                    <section class="mb-10">

                        <h5 class="uppercase font-semibold mb-5 text-base">Пользователь</h5>

                        <ul class="list-reset">

                            <li class="text-sm pb-4"><router-link to="/home">Личный кабинет</router-link></li>
                            <li class="text-sm pb-4"><router-link to="/logout">Выйти</router-link></li>


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

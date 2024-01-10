<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        <i class="fa-solid fa-utensils"></i> {{ __('Restaurant Manager') }}
        </h2>
    
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class="p-6 text-gray-900 dark:text-gray-100" id="loggedInMessage">
                    {{ __("You're logged in!") }}
                </div>

        <div class="center-container">
            <div class="center-content">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Main Functions</div>
                        </div> 
                    </div>
                </div> 
            </div> 
        </div> 

            <div class="container">
            <div class="row text-center"> 
                <div class="col-sm-4 management"> 
                <a href="/management">
                    <h4>
                    <i class="fa-solid fa-database"></i> Management
                    </h4>
                    <img width="50px"/>
                    </a>
                </div> 

                <div class="col-sm-4 cashier"> 
                <a href="/cashier">
                    <h4> 
                    <i class="fa-solid fa-money-bill-transfer"></i> Cashier
                    </h4>
                    <img width="50px"/>
                    </a>
                </div>

                <div class="col-sm-4 report">
                <a href="/report">
                    <h4>
                    <i class="fas fa-list-check"></i> Report
                    </h4>
                    <img width="50px"/>
                    </a>
                </div>

            </div>               
            </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const loggedInMessage = document.getElementById('loggedInMessage');

        const hideLoggedInMessage = () => {
            if (loggedInMessage) {
                setTimeout(() => {
                loggedInMessage.style.display = 'none';
            }, 3000);
        }
    };

        hideLoggedInMessage(); 
    });

    </script>
    </x-slot>
</x-app-layout>

<template>
    <div>
        <nav class="navbar navbar-dark bg-dark mb-2">
            <router-link class="navbar-brand" :to="{ name : 'home' }">Repunsitory</router-link>
            <div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name : 'login' }">Login</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name : 'register' }">Register</router-link>
                    </li>
                </ul>
            </div>
        </nav>
        <div>
            <router-view></router-view>
        </div>
    </div>
</template>
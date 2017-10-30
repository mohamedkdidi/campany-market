<template>
    <div id="root">
        <div class="navbar navbar-default">
            <div class="navbar-brand">
                <router-link to="/dashboard">Dashboard</router-link>
            </div>
            <ul class="nav navbar-nav navbar-left">
                <li><router-link to="/profile">Profile</router-link></li>
                <li><router-link to="/stock">Stock</router-link></li>
                <li><router-link to="/companie">Companies</router-link></li>
            </ul>
        </div>
        <router-view></router-view>
    </div>
</template>
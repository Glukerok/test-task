<template>
    <div>
        <header>
            <nav class="navbar navbar-light bg-light">
                <div class="container">
                    <router-link class="navbar-brand" to="/">Тестовое задание WorkHands</router-link>
                    <div class="">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <router-link to="/create">Создать обявление</router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <router-view v-slot="{ Component }">
            <transition name="fade" mode="out-in">
                <component :is="Component" />
            </transition>
        </router-view>
    </div>
</template>

<script>
export default {
    name: "Main",
}
</script>

<template>
    <b-navbar>
        <template #brand>
            <b-navbar-item tag="router-link" :to="{ path: '/' }">
                <img
                    src="https://raw.githubusercontent.com/buefy/buefy/dev/static/img/buefy-logo.png"
                    alt="Lightweight UI components for Vue.js based on Bulma"
                />
            </b-navbar-item>
        </template>
        <template #start>
            <b-navbar-dropdown label="ページ">
                <b-navbar-item tag="router-link" to="/create">
                    新規スレッド
                </b-navbar-item>
                <b-navbar-item
                    v-if="$route.params.id"
                    tag="router-link"
                    :to="'/edit/' + $route.params.id"
                    >編集</b-navbar-item
                >
            </b-navbar-dropdown>
        </template>

        <template #end>
            <b-navbar-item tag="div">
                <div class="buttons">
                    <a class="button is-primary">
                        <strong>Sign up</strong>
                    </a>
                    <a class="button is-light"> Log in </a>
                </div>
            </b-navbar-item>
        </template>
    </b-navbar>
</template>

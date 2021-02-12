<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-info p-3 mb-2">
    <div class="container-fluid">
      <router-link class="navbar-brand" to="/">Sanctum</router-link>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div>
        <ul class="navbar-nav mx-2">
          <li class="mx-2" style="font-size: 18px">
            <router-link
              active-class="text-white"
              class="nav-link text-dark"
              to="/dashboard"
              v-if="state.isLoggedIn"
              >Dashboard</router-link
            >
          </li>
          <li class="mx-2" style="font-size: 18px">
            <router-link
              v-if="!state.isLoggedIn"
              active-class="text-white"
              class="text-dark nav-link"
              to="/login"
              >Login</router-link
            >
          </li>
          <li class="mx-2" style="font-size: 18px">
            <router-link
              active-class="text-white"
              class="text-dark nav-link"
              to="/register"
              v-if="!state.isLoggedIn"
              >Register</router-link
            >
          </li>
          <li class="mx-2" style="font-size: 18px">
            <a
              active-class="text-white"
              class="text-dark nav-link"
              href="#"
              v-if="state.isLoggedIn"
              @click.prevent="logout"
              >Logout</a
            >
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import { computed, onMounted, reactive } from "vue";
import { useRouter } from "vue-router";
import User from "../apis/User";
import { useStore } from "vuex";

export default {
  setup() {
    const store = useStore();
    const state = reactive({
      isLoggedIn: computed(() => store.state.isLoggedIn),
    });
    const router = useRouter();
    onMounted(() => {
      if (!!localStorage.getItem("token")) store.commit("SET_IS_LOGGED_IN", true);
    });
    function logout() {
      User.logout().then(() => {
        localStorage.removeItem("token");
        router.push("/");
        store.commit("SET_IS_LOGGED_IN", false);
      });
    }
    return { logout, state };
  },
};
</script>

<style></style>

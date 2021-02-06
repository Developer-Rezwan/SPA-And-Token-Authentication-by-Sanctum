<template>
  <h2 class="text-center my-4">Login</h2>
  <div class="text-danger text-center" v-if="state.errors.error">
    {{ state.errors.error[0] }}
  </div>
  <div class="container col-md-4 shadow mb-5 border p-3">
    <form>
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input
          type="email"
          v-model="state.form.email"
          class="form-control"
          id="exampleInputEmail1"
          aria-describedby="emailHelp"
          placeholder="Enter email"
        />
        <span class="text-danger" v-if="state.errors.email">
          {{ state.errors.email[0] }}
        </span>
      </div>
      <br />
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input
          v-model="state.form.password"
          type="password"
          class="form-control"
          id="exampleInputPassword1"
          placeholder="Password"
        />
        <span class="text-danger" v-if="state.errors.password">
          {{ state.errors.password[0] }}
        </span>
      </div>
      <br />
      <div class="form-group">
        <input
          type="submit"
          @click.prevent="login"
          class="btn btn-info form-control"
          value="Login"
        />
      </div>
    </form>
  </div>
</template>

<script>
import { reactive } from "vue";
import User from "../apis/User";
import { useRouter } from "vue-router";
import { useStore } from "vuex";

export default {
  setup() {
    const store = useStore();
    const router = useRouter();
    const state = reactive({
      form: {
        email: "",
        password: "",
      },
      errors: "",
    });
    function login() {
      User.login(state.form)
        .then(() => {
          localStorage.setItem("auth", "true");
          router.push("/dashboard");
          store.commit("SET_IS_LOGGED_IN", true);
        })
        .catch((err) => {
          if (err.response.status == 422) {
            state.errors = err.response.data.errors;
          }
        });
    }
    //return all data
    return { state, login };
  },
};
</script>

<style></style>

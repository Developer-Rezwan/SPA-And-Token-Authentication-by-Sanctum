<template>
  <h2 class="text-center my-3">Register</h2>
  <div>
    <form class="container col-md-5 shadow mb-5 border p-3">
      <div class="form-row container">
        <div class="form-group">
          <label for="inputname4">Name</label>
          <input
            type="text"
            v-model="state.form.name"
            class="form-control"
            id="inputname4"
            placeholder="Name"
          />
          <span class="text-danger" v-if="state.errors.name">
            {{ state.errors.name[0] }}
          </span>
        </div>
        <br />
        <div class="form-group">
          <label for="inputEmail4">Email</label>
          <input
            type="email"
            v-model="state.form.email"
            class="form-control"
            id="inputEmail4"
            placeholder="Email"
          />
          <span class="text-danger" v-if="state.errors.email">
            {{ state.errors.email[0] }}
          </span>
        </div>
        <br />
        <div class="form-group">
          <label for="inputPassword4">Password</label>
          <input
            type="password"
            v-model="state.form.password"
            class="form-control"
            id="inputPassword4"
            placeholder="Password"
          />
          <span class="text-danger" v-if="state.errors.password">
            {{ state.errors.password[0] }}
          </span>
        </div>
        <br />
        <div class="form-group">
          <label for="inputPasswordConfirm">Confirmation Password</label>
          <input
            type="password"
            v-model="state.form.password_confirmation"
            class="form-control"
            id="inputPasswordConfirm"
            placeholder="Password confirmation"
          />
          <span class="text-danger" v-if="state.errors.password_confirmation">
            {{ state.errors.password_confirmation[0] }}
          </span>
        </div>
      </div>
      <br />
      <div class="form-group container">
        <input
          type="button"
          @click.prevent="submit"
          class="btn btn-info form-control"
          value="Register"
        />
      </div>
    </form>
  </div>
</template>

<script>
import User from "../apis/User";
import { reactive } from "vue";
import { useRouter } from "vue-router";
export default {
  setup() {
    const router = useRouter();
    const state = reactive({
      form: {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
      },
      errors: [],
    });
    function submit() {
      User.register(state.form)
        .then(() => {
          router.push("/login");
        })
        .catch((err) => {
          if (err.response.status == 422) {
            state.errors = err.response.data.errors;
          }
        });
    }
    // Return all the information
    return { state, submit };
  },
};
</script>

<style></style>

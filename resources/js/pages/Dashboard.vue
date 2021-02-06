<template>
  <div class="container col-md-8 mt-5 shadow card">
    <h2 class="card-header">Dashboard</h2>
    <div class="card-body">
      <h5>name : {{ user.name }}</h5>
      <p>email : {{ user.email }}</p>
    </div>
  </div>
</template>

<script>
import { onMounted, ref } from "vue";
import User from "../apis/User";
import { useRouter } from "vue-router";
export default {
  setup() {
    const router = useRouter();
    const user = ref({});
    onMounted(() => {
      User.user()
        .then((res) => {
          user.value = res.data;
        })
        .catch(() => {
          localStorage.removeItem("auth");
          User.logout();
          router.push("/login");
        });
    });
    return { user };
  },
};
</script>

<style></style>

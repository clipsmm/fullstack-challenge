import {ref, computed} from "vue";
import {defineStore} from "pinia";

export const useUsersStore = defineStore("users", () => {
    const users = ref([]);
    const bFetching = ref(false);
    const currentUser = ref(null);

    async function fetchUsers() {
        bFetching.value = true;
        const url = 'http://api.test/api/users';
        const response = await (await fetch(url)).json();
        users.value = response.data;
        bFetching.value = false;
    }

    async function fetchUserDetails(id: number | string) {
        bFetching.value = true;
        const url = `http://api.test/api/users/${id}`;
        currentUser.value = await (await fetch(url)).json()
        bFetching.value = false;
    }

    return {users, currentUser, fetchUsers, fetchUserDetails};
});

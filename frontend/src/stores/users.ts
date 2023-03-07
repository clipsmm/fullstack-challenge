import type { Ref } from "vue";
import {ref, computed} from "vue";
import {defineStore} from "pinia";

export const useUsersStore = defineStore("users", () => {
    const users: Ref<Array<User>> = ref([]);
    const bFetching = ref(false);
    const currentUser = ref(null);

    async function fetchUsers() {
        bFetching.value = true;
        const url = 'http://localhost/api/users';
        const response = await (await fetch(url)).json();
        users.value = response.data;
        bFetching.value = false;
    }

    async function fetchUserDetails(id: number | string) {
        bFetching.value = true;
        const url = `http://localhost/api/users/${id}`;
        currentUser.value = await (await fetch(url)).json()
        bFetching.value = false;
    }

    function updateUserWeatherForecast(id: number | string, weatherForecast: Weather) {
        users.value.forEach( (elem: User) => {
            if(elem.id === id) {
                elem.weather = weatherForecast;
            }
        })

        if(!!currentUser && currentUser.value.id === id) {
            currentUser.value.weather = weatherForecast;
        }
    }

    return {users, currentUser, fetchUsers, fetchUserDetails, updateUserWeatherForecast};
});

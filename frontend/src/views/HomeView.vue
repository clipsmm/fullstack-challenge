<script>
import { storeToRefs } from 'pinia'
import UserListItem from "@/components/UserListItem.vue";
import UserDetails from "@/components/UserDetails.vue";
import { Modal } from 'bootstrap'
import { useUsersStore } from "@/stores/users";
import useLaravelEcho from '@/commons/echo'
const store = useUsersStore();

const { users } = storeToRefs(useUsersStore())

const { laravelEcho } = useLaravelEcho();

export default {
    components: { UserListItem, UserDetails },
    data: () => ({
        store,
        bFetching: false,
    }),

    created() {
        store.fetchUsers();
    },

    mounted() {
        laravelEcho
            .channel("weather")
            .listen(".forecast.update", (forecast) => {
                store.updateUserWeatherForecast(forecast.userId, forecast)
            });
    },

    methods: {
        async showUserDetails(user) {
            this.bFetching = true;
            const modal = new Modal(document.getElementById("mainModal"));
            modal.show();

            await store.fetchUserDetails(user.id);
        }
    }
}
</script>

<template>
    <main>
        <div class="container">
            <h3 class="text-center py-3">FullStack Weather Challenge</h3>
            <div class="row">
                <div href="#" @click.prevent="showUserDetails(user)" class="col-lg-3 p-2 border-2 border-warning" v-for="(user, index) in store.users" :key="index">
                    <user-list-item
                        :user="user"
                        :key="index"
                    />
                </div>
            </div>
        </div>
        <div class="modal fade" ref="mainModal" id="mainModal" tabindex="-1" aria-labelledby="mainModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mainModalLabel">
                            Weather Details
                            <small v-if="!!store.currentUser" class="d-block text-muted">{{ store.currentUser.name }}</small>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <user-details v-if="store.currentUser" :user="store.currentUser" />
                        <span v-else>loading</span>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

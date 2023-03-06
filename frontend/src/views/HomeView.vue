<script>
import ApiTest from "@/components/ApiTest.vue";
import UserListItem from "@/components/UserListItem.vue";
import UserDetails from "@/components/UserDetails.vue";
import { Modal } from 'bootstrap'

export default {
    components: { UserListItem, UserDetails },
    data: () => ({
        apiResponse: null,
        users: [],
        currentUser: null,
        bFetching: false,
    }),

    created() {
        this.fetchUsers()
    },

    methods: {
        async fetchUsers() {
            const url = 'http://api.test/users';
            this.users = await (await fetch(url)).json()
        },
        async fetchUserDetails(id) {
            const url = `http://api.test/users/${id}`;
            this.currentUser = await (await fetch(url)).json()
        },
        setUser(user) {
            this.currentUser = user
        },
        async showUserDetails(user) {
            this.bFetching = true;
            const modal = new Modal(document.getElementById("mainModal"));
            modal.show();

            await this.fetchUserDetails(user.id);
        }
    }
}
</script>

<template>
    <main>
        <div class="container">
            <h3 class="text-center py-3">FullStack Weather Challenge</h3>
            <div class="row">
                <div href="#" @click.prevent="showUserDetails(user)" class="col-lg-3 p-2 border-2 border-warning" v-for="(user, index) in users" :key="index">
                    <user-list-item
                        :user="user"
                        :key="index"
                        @click.native="setUser(user)"
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
                            <small v-if="currentUser" class="d-block text-muted">{{ currentUser.name }}</small>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <user-details v-if="currentUser" :user="currentUser" />
                        <span v-else>loading</span>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

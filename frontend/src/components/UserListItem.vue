<script>
export default {
    props: {
        user: {
            type: Object,
            required: true
        }
    },
}
</script>
<template>
    <div class="card p-3">
        <div class="d-flex align-items-end">
            <div class="flex-shrink-0">
                <div class="">
                    <h4 class="mb-3">{{ user.weather ? user.weather.temp | parseInt : ''}} &deg F</h4>
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <img :src="user.avatar" height="30" class="rounded-circle" alt="User avatar">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <span class="">{{ user.name }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-grow-1 ms-3 text-end">
                <div v-if="user.weather" class="text-center">
                    <img class="" :src="user.weather.icon"  alt="Weather icon">
                    <span class="d-block text-muted">{{ user.weather.main }}</span>
                </div>
            </div>
        </div>
    </div>
</template>
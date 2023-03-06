<script>
export default {
    props: {user: {type: Object, required: true}}
}
</script>
<template>
    <div>
        <div v-if="user.weather" class="text-center">
            <img class="" :src="user.weather.icon"
                 alt="...">
            <h3 class="d-block">{{ user.weather.temp | parseInt }} &deg F</h3>
            <span class="d-block text-muted">{{ user.weather.main }}</span>
            <div class="row mt-3">
                <div class="col text-center">
                    <span class="d-block weather-detail__title">Wind</span>
                    <span class="d-block weather-detail__value">
                        {{ user.weather.windSpeed | parseInt }} mph
                        <span class="weather-detail__unit text-muted">mph</span>
                    </span>
                </div>
                <div class="col text-center">
                    <span class="d-block weather-detail__title">Humidity</span>
                    <span class="d-block weather-detail__value">
                        {{ user.weather.humidity }}
                        <span class="weather-detail__unit text-muted">%</span>
                    </span>
                </div>
                <div class="col text-center">
                    <span class="d-block weather-detail__title">Rain</span>
                    <span
                        class="d-block weather-detail__value">{{ user.weather.rain ? user.weather.rain : '0' }}</span>
                </div>
            </div>
        </div>
    </div>
</template>
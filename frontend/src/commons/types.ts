interface Weather {
    main: string;
    description: string;
    icon: string;
    temp: number;
    sunrise: number;
    sunset: number;
    humidity: number;
    windSpeed: number;
    rain: number;
    visibility: number;
    pressure: number;
}

interface User {
    id: number;
    name: string;
    email: string;
    avatar: string;
    latitude: number;
    longitude: number;
    weather: Weather;
}
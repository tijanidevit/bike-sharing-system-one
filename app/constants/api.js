const API_HOST = "http://192.168.43.148/2021/bika/api";

export const userAPI = {
    LOGIN_ENDPOINT: `${API_HOST}/users/login`,
    SIGNUP_ENDPOINT: `${API_HOST}/users/register`
};

export const bookingAPI = {
    USER_BOOKINGS_ENDPOINT: (userId) => {
        return `${API_HOST}/users/bookings/${userId}`
    },
}